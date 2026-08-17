<?php

namespace App\Services;

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
                'payment' => 'This payment cannot be captured because its status is ' . $payment->status
            ]);
        }

        $result = $this->paypalService->captureOrder($payment->provider_order_id);

        return DB::transaction(function () use ($payment, $result) {
            if (!$result['success']) {
                $payment->update(['status' => 'failed']);
                
                $payment = $payment->fresh();
                $payment->paypal_error = $result['response'];

                return $payment;
            }

            $payment->update([
                'status' => 'completed',
                'provider_capture_id' => $result['capture_id'],
                'paid_at' => now(),
            ]);

            $invoice = Invoice::where('id', $payment->invoice_id)->lockForUpdate()->first();

            if ($invoice) {
                $completedAmount = $invoice->payments()
                    ->where('status', 'completed')
                    ->sum('amount');

                if ($completedAmount >= $invoice->total) {
                    $invoice->update(['status' => 'paid']);
                }
            }

            return $payment->fresh();
        });
    }
}