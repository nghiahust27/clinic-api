@extends('layouts.app')

@section('title', 'Credit Card Payment')

@section('content')
<style>
.card-payment-page {
    max-width: 650px;
    margin: 0 auto;
}

.card-payment-container {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}

.card-payment-container .card-header {
    padding: 20px 25px;
    border-bottom: 1px solid #f1f5f9;
}

.card-payment-container .card-header h2 {
    margin: 0;
    color: #172033;
    font-size: 18px;
    font-weight: 700;
}

.card-payment-container .card-header p {
    margin: 4px 0 0;
    color: #64748b;
    font-size: 12px;
}

.card-payment-container .card-body {
    padding: 25px;
}

.payment-meta-box {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 18px;
    background: #f8fbff;
    border: 1px solid #bfdbfe;
    border-radius: 10px;
    margin-bottom: 24px;
}

.payment-meta-box span {
    color: #64748b;
    font-size: 13px;
}

.payment-meta-box strong {
    color: #2563eb;
    font-size: 18px;
    font-weight: 750;
}

/* CARD FORM FIELD STYLES */
.form-group {
    margin-bottom: 18px;
}

.form-label {
    display: block;
    margin-bottom: 6px;
    color: #334155;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .03em;
}

.card-field-container {
    height: 42px;
    padding: 8px 12px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    background: #fff;
    transition: border-color .15s ease;
}

.card-field-container:focus-within {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.form-row-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

#card-errors {
    margin-bottom: 15px;
}

.payment-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 25px;
}
</style>

<div class="card-payment-page">

    <div class="page-header">
        <div>
            <h1>Credit Card Payment</h1>
            <p>Complete your payment using Visa/Mastercard</p>
        </div>
        <div>
            <a href="{{ route('payments.create', $payment->invoice_id) }}" class="invoice-btn invoice-btn-secondary">
                ← Back
            </a>
        </div>
    </div>

    <div class="card card-payment-container">
        <div class="card-header">
            <h2>Payment Information</h2>
            <p>Please enter your card details below to complete the transaction.</p>
        </div>

        <div class="card-body">

            <div class="payment-meta-box">
                <span>Transaction Amount</span>
                <strong>${{ number_format($payment->amount, 2, '.', ',') }}</strong>
            </div>

            <div id="card-errors"></div>

            <form id="card-form">
                <div class="form-group">
                    <label class="form-label">Card Number</label>
                    <div id="card-number" class="card-field-container"></div>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label class="form-label">Expiration Date</label>
                        <div id="expiration-date" class="card-field-container"></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Security Code (CVV)</label>
                        <div id="cvv" class="card-field-container"></div>
                    </div>
                </div>

                <div class="payment-actions">
                    <a href="{{ route('payments.create', $payment->invoice_id) }}" class="invoice-btn invoice-btn-secondary">
                        Cancel
                    </a>

                    <button type="submit" id="submit-button" class="invoice-btn invoice-btn-primary">
                        Pay ${{ number_format($payment->amount, 2, '.', ',') }}
                    </button>
                </div>
            </form>

        </div>
    </div>

</div>

{{-- PayPal JS SDK --}}
<script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&components=card-fields"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (!paypal.CardFields) {
            console.error('PayPal CardFields failed to load');
            return;
        }

        const cardFields = paypal.CardFields({
            createOrder: function () {
                return "{{ $payment->provider_order_id }}";
            },
            onApprove: function (data) {
                document.getElementById('submit-button').innerText = 'Processing...';
                document.getElementById('submit-button').disabled = true;

                // Redirect to success route after approval
                window.location.href = "{{ route('payments.paypal.success') }}?token=" + data.orderID;
            },
            onError: function (err) {
                const errorBox = document.getElementById('card-errors');
                errorBox.innerHTML = `<div class="alert alert-danger">${err.message || 'Payment processing failed.'}</div>`;
            }
        });

        if (cardFields.isEligible()) {
            cardFields.NumberField().render('#card-number');
            cardFields.ExpiryField().render('#expiration-date');
            cardFields.CVVField().render('#cvv');

            document.getElementById('card-form').addEventListener('submit', function (e) {
                e.preventDefault();
                cardFields.submit();
            });
        } else {
            document.getElementById('card-errors').innerHTML = 
                '<div class="alert alert-danger">Credit Card Fields are not supported on this browser or region.</div>';
        }
    });
</script>
@endsection