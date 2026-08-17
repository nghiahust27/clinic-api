<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\StorePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Invoice;
use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use RecursiveArrayIterator;

class PaymentController extends Controller
{
    public function __construct(
        private PaymentService $paymentService
    ) {
    }

    public function store(
        StorePaymentRequest $request,
        Invoice $invoice
    ) {
        $payment = $this->paymentService->create(
            $invoice,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Payment order created successfully.',
            'data' => [
                'payment_id' => $payment->id,
                'amount' => $payment->amount,
                'method' => $payment->method,
                'status' => $payment->status,
                'provider' => $payment->provider,
                'order_id' => $payment->provider_order_id,
                'approval_url' => $payment->approval_url,
            ],
        ], 201);
    }
    public function capture(Payment $payment)
    {
        $payment = $this->paymentService->capture($payment);

        if ($payment->status === 'failed') {
            return response()->json([
                'success' => false,
                'message' => 'PayPal payment failed.',
                'data' => new PaymentResource($payment),
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'PayPal payment captured successfully.',
            'data' => new PaymentResource($payment),
        ]);
    }
    public function paypalSuccess(Request $request)
    {
        $orderId = $request->query('token');
        $payerId = $request->query('PayerID');

        $payment = Payment::where(
            'provider_order_id',
            $orderId
        )->firstOrFail();

        $payment = $this->paymentService->capture($payment);

        if ($payment->status === 'completed') {
            return response()->json([
                'success' => true,
                'message' => 'PayPal payment completed successfully.',
                'token' => $orderId,
                'payer_id' => $payerId,
                'payment_id' => $payment->id,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'PayPal payment failed.',
            'token' => $orderId,
            'payer_id' => $payerId,
            'payment_id' => $payment->id,
        ], 422);
    }
    public function paypalCancel(Request $request)
    {
        $orderId = $request->query('token');

        $payment = Payment::where(
            'provider_order_id',
            $orderId
        )->first();

        if ($payment) {
            $payment->update([
                'status' => 'cancelled',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'PayPal payment cancelled.',
            'token' => $orderId,
        ], 422);
    }
}