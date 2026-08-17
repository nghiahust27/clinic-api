<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\StorePaymentRequest;
use App\Models\Invoice;
use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PaymentController extends Controller
{
    public function __construct(
        private PaymentService $paymentService
    ) {}

    public function index()
    {
        $payments = Payment::with('invoice')
            ->latest()
            ->paginate(15);

        return view('payments.index', compact('payments'));
    }

    public function create(Invoice $invoice)
    {
        $paidAmount = $invoice->payments()->where('status', 'completed')->sum('amount');
        $remainingAmount = max(0, $invoice->total - $paidAmount);

        return view('payments.create', compact('invoice', 'remainingAmount'));
    }

    public function store(StorePaymentRequest $request, Invoice $invoice)
    {
        try {
            $payment = $this->paymentService->create($invoice, $request->validated());

            if ($payment->method === 'paypal' && $payment->approval_url) {
                return redirect()->away($payment->approval_url);
            }

            if ($payment->method === 'visa') {
                return redirect()->route('payments.card', $payment->id);
            }

            return back()->with('error', 'Unable to initiate payment link.');

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            return back()->with('error', 'System error: ' . $e->getMessage())->withInput();
        }
    }

    public function showCardForm(Payment $payment)
    {
        if ($payment->status !== 'pending') {
            return redirect()->route('invoices.show', $payment->invoice_id)
                ->with('error', 'This transaction is no longer pending.');
        }

        return view('payments.card', compact('payment'));
    }

    public function paypalSuccess(Request $request)
    {
        $orderId = $request->query('token');

        if (!$orderId) {
            return redirect()->route('invoices.index')
                ->with('error', 'Invalid PayPal transaction token.');
        }

        $payment = Payment::where('provider_order_id', $orderId)->first();

        if (!$payment) {
            return redirect()->route('invoices.index')
                ->with('error', 'Transaction record not found in the system.');
        }

        try {
            $payment = $this->paymentService->capture($payment);

            if ($payment->status === 'completed') {
                return redirect()->route('invoices.show', $payment->invoice_id)
                    ->with('success', 'PayPal payment completed successfully.');
            }

            return redirect()->route('invoices.show', $payment->invoice_id)
                ->with('error', 'PayPal payment failed or was declined.');

        } catch (\Throwable $e) {
            return redirect()->route('invoices.show', $payment->invoice_id)
                ->with('error', 'An error occurred while confirming payment: ' . $e->getMessage());
        }
    }

    public function paypalCancel(Request $request)
    {
        $orderId = $request->query('token');

        if ($orderId) {
            $payment = Payment::where('provider_order_id', $orderId)->first();

            if ($payment && $payment->status === 'pending') {
                $payment->update(['status' => 'cancelled']);
            }

            if ($payment) {
                return redirect()->route('invoices.show', $payment->invoice_id)
                    ->with('warning', 'You have cancelled the PayPal payment process.');
            }
        }

        return redirect()->route('invoices.index')
            ->with('warning', 'Payment process was cancelled.');
    }
}