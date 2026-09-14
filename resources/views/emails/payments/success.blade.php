<h2>Payment Successful</h2>

<p>Dear {{ $payment->invoice->examination->appointment->patient->name }},</p>

<p>
    Your payment has been successfully completed.
</p>

<p>
    Invoice: #{{ $payment->invoice->id }}
</p>

<p>
    Amount: $ {{ number_format($payment->amount, 0) }}
</p>

<p>
    Payment method: {{ strtoupper($payment->method) }}
</p>

<p>
    Thank you for using our clinic.
</p>