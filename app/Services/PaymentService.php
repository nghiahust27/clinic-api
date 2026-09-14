<?php

namespace App\Services;

use App\Events\PaymentActivity;
use App\Events\PaymentStatusUpdated;
use App\Events\PaymentSucceeded;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PaymentService
{
    public function __construct(
        private PayPalService $paypalService
    ) {}

    public function create(Invoice $invoice, array $data): Payment 
    {
        $paidAmount = $invoice->payments()->where('status', 'completed')->sum('amount');
        $remainingAmount = $invoice->total - $paidAmount;
        $amount = (float) $data['amount'];
        $method = $data['method'];

        if ($invoice->status === 'cancelled') {
            throw ValidationException::withMessages([
                'invoice' => 'Cannot create payment for a cancelled invoice.'
            ]);
        }

        if ($remainingAmount <= 0) {
            throw ValidationException::withMessages([
                'invoice' => 'Invoice has already been fully paid.'
            ]);
        }

        if ($amount > $remainingAmount) {
            throw ValidationException::withMessages([
                'amount' => 'Payment amount cannot exceed the remaining invoice amount.'
            ]);
        }

        $paypalOrder = $this->paypalService->createOrder($amount, $invoice->invoice_code);

        $approvalUrl = collect($paypalOrder['links'] ?? [])
            ->firstWhere('rel', 'approve')['href'] ?? null;

        return DB::transaction(function () use ($invoice, $amount, $method, $paypalOrder, $approvalUrl) {
            $payment = Payment::create([
                'invoice_id' => $invoice->id,
                'amount' => $amount,
                'method' => $method,
                'status' => 'pending',
                'provider' => 'paypal',
                'provider_order_id' => $paypalOrder['id'],
            ]);

            $payment->approval_url = $approvalUrl;
            event(new PaymentActivity($payment, 'payment.created',
            [
                'invoice_id'=>$payment->invoice_id,
                'method'=>$payment->method
            ]));
            return $payment;
        });
    }

    public function capture(Payment $payment): Payment
    {
        if ($payment->status === 'completed') {
            return $payment;
        }

        if ($payment->status !== 'pending') {
            throw ValidationException::withMessages([
                'payment' => 'This payment cannot be captured because its status is '
                    . $payment->status
            ]);
        }

        $result = null;

        for ($attempt = 1; $attempt <= 3; $attempt++) {
            $result = $this->paypalService->captureOrder(
                $payment->provider_order_id
            );

            if ($result['success']) {
                break;
            }

            if ($attempt < 3) {
                sleep(2);
            }
        }

        $payment = DB::transaction(function () use ($payment, $result) {

            if (!$result['success']) {
                $payment->update([
                    'status' => 'failed'
                ]);

                $payment->paypal_error = $result['response'];

                event(new PaymentActivity(
                    $payment,
                    'payment.failed',
                    [
                        'invoice_id' => $payment->invoice_id,
                        'method' => $payment->method,
                        'reason' => $result['response'] ?? null,
                    ]
                ));

                return $payment->fresh();
            }

            $payment->update([
                'status' => 'completed',
                'provider_capture_id' => $result['capture_id'],
                'paid_at' => now(),
            ]);

            $invoice = Invoice::where(
                'id',
                $payment->invoice_id
            )
            ->lockForUpdate()
            ->first();

            if ($invoice) {
                $completedAmount = $invoice->payments()
                    ->where('status', 'completed')
                    ->sum('amount');

                if ($completedAmount >= $invoice->total) {
                    $invoice->update([
                        'status' => 'paid'
                    ]);
                }
            }

            event(new PaymentActivity(
                $payment,
                'payment.completed',
                [
                    'invoice_id' => $payment->invoice_id,
                    'method' => $payment->method
                ]
            ));

            return $payment->fresh();
        });


        if ($payment->status === 'completed') {
            event(new PaymentSucceeded($payment));
        }

        return $payment;
    }
}