@extends('layouts.app')

@section('title', 'Credit Card Payment')

@section('content')
<style>
.card-payment-page {
    max-width: 600px;
    margin: 0 auto;
}

.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 24px;
}

.page-header h1 {
    margin: 0;
    font-size: 26px;
    font-weight: 700;
    color: #0f172a;
    letter-spacing: -0.5px;
}

.page-header p {
    margin: 4px 0 0;
    color: #64748b;
    font-size: 14px;
}

.card-payment-container {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.card-payment-container .card-header {
    padding: 20px 24px;
    background: #f8fafc;
    border-bottom: 1px solid #f1f5f9;
}

.card-payment-container .card-header h2 {
    margin: 0;
    color: #1e293b;
    font-size: 16px;
    font-weight: 700;
}

.card-payment-container .card-header p {
    margin: 4px 0 0;
    color: #64748b;
    font-size: 13px;
}

.card-payment-container .card-body {
    padding: 24px;
}

.payment-meta-box {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 18px;
    background: #f0f9ff;
    border: 1px solid #bae6fd;
    border-radius: 10px;
    margin-bottom: 20px;
}

.payment-meta-box span {
    color: #0369a1;
    font-size: 13px;
    font-weight: 600;
}

.payment-meta-box strong {
    color: #0284c7;
    font-size: 20px;
    font-weight: 800;
}

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

/* Sửa lại CSS cho khung chứa field */
.card-field-container {
    width: 100%;
    min-height: 44px;
    height: auto;
    padding: 8px 12px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    background: #ffffff;
    box-sizing: border-box; /* Bắt buộc để padding không đẩy chiều rộng ra ngoài */
    transition: all .15s ease;
    display: flex;
    align-items: center;
}

/* Đảm bảo iframe do PayPal sinh ra luôn khống chế theo kích thước khung mẹ */
.card-field-container iframe {
    width: 100% !important;
    min-width: 100% !important;
    border: none !important;
    box-sizing: border-box !important;
}

.card-field-container:focus-within {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
}
.form-row-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

#card-errors {
    margin-bottom: 18px;
    display: none;
}

#card-errors .alert-danger {
    padding: 12px 16px;
    background-color: #fef2f2;
    border: 1px solid #fecaca;
    border-radius: 8px;
    color: #991b1b;
    font-size: 13px;
    line-height: 1.4;
}

.btn {
    min-height: 42px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all .15s ease;
    width: 100%;
}

.btn-primary {
    border: 1px solid #2563eb;
    background: #2563eb;
    color: #ffffff;
}

.btn-primary:hover:not(:disabled) {
    border-color: #1d4ed8;
    background: #1d4ed8;
}

.btn-primary:disabled {
    opacity: 0.65;
    cursor: not-allowed;
}

.btn-secondary {
    width: auto;
    min-height: 36px;
    padding: 0 14px;
    border: 1px solid #cbd5e1;
    background: #ffffff;
    color: #475569;
    font-size: 13px;
}

.btn-secondary:hover {
    background: #f8fafc;
    color: #1e293b;
}

@media (max-width: 576px) {
    .form-row-2 {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="card-payment-page">

    <div class="page-header">
        <div>
            <h1>Credit Card Payment</h1>
            <p>Complete your payment using Visa/Mastercard</p>
        </div>
        <div>
            <a href="{{ route('payments.create', $payment->invoice_id) }}" class="btn btn-secondary">
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

                <div class="form-group" style="margin-top: 10px; margin-bottom: 0;">
                    <button type="submit" id="submit-button" class="btn btn-primary">
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
        const errorBox = document.getElementById('card-errors');
        const submitBtn = document.getElementById('submit-button');

        if (!window.paypal || !paypal.CardFields) {
            showError('PayPal SDK failed to load. Please refresh the page.');
            return;
        }

        function showError(msg) {
            errorBox.style.display = 'block';
            errorBox.innerHTML = `<div class="alert alert-danger">${msg}</div>`;
        }

        const cardFields = paypal.CardFields({
            createOrder: function () {
                return "{{ $payment->provider_order_id }}";
            },
            onApprove: function (data) {
                submitBtn.innerText = 'Processing Payment...';
                submitBtn.disabled = true;

                window.location.href = "{{ route('payments.paypal.success') }}?token=" + data.orderID;
            },
            onError: function (err) {
                submitBtn.innerText = "Pay ${{ number_format($payment->amount, 2, '.', ',') }}";
                submitBtn.disabled = false;
                showError(err.message || 'Payment processing failed. Please check your card details.');
            }
        });

        if (cardFields.isEligible()) {
            cardFields.NumberField().render('#card-number');
            cardFields.ExpiryField().render('#expiration-date');
            cardFields.CVVField().render('#cvv');

            document.getElementById('card-form').addEventListener('submit', function (e) {
                e.preventDefault();
                errorBox.style.display = 'none';
                submitBtn.innerText = 'Submitting...';
                submitBtn.disabled = true;

                cardFields.submit().catch(function (err) {
                    submitBtn.innerText = "Pay ${{ number_format($payment->amount, 2, '.', ',') }}";
                    submitBtn.disabled = false;
                    showError('Failed to submit payment details. Please try again.');
                });
            });
        } else {
            showError('Credit Card Fields are not supported on this browser or region.');
            submitBtn.disabled = true;
        }
    });
</script>
@endsection