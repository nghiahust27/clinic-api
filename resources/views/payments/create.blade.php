@extends('layouts.app')

@section('title', 'Process Payment')

@section('content')
<style>
.payment-page {
    max-width: 800px;
    margin: 0 auto;
}

.payment-card {
    margin-bottom: 20px;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}

.payment-card .card-header {
    padding: 20px 25px;
    border-bottom: 1px solid #f1f5f9;
}

.payment-card .card-header h2 {
    margin: 0;
    color: #172033;
    font-size: 18px;
    font-weight: 700;
}

.payment-card .card-header p {
    margin: 4px 0 0;
    color: #64748b;
    font-size: 12px;
}

.payment-card .card-body {
    padding: 25px;
}

/* BILLING SUMMARY BOX */
.billing-box {
    padding: 18px 20px;
    background: #f8fbff;
    border: 1px solid #bfdbfe;
    border-radius: 10px;
    margin-bottom: 24px;
}

.billing-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid #e2e8f0;
}

.billing-row:last-of-type {
    border-bottom: none;
}

.billing-row span {
    color: #64748b;
    font-size: 13px;
}

.billing-row strong {
    color: #334155;
    font-size: 13px;
}

.billing-row.discount-row strong {
    color: #ef4444;
}

.billing-total {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 10px;
    padding-top: 12px;
    border-top: 2px solid #bfdbfe;
}

.billing-total span {
    color: #172033;
    font-size: 15px;
    font-weight: 700;
}

.billing-total strong {
    color: #2563eb;
    font-size: 22px;
    font-weight: 800;
}

/* FORM ELEMENTS */
.form-group {
    margin-bottom: 20px;
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

.form-control {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: 14px;
    color: #1e293b;
    background-color: #fff;
    transition: border-color .15s ease;
}

.form-control:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

/* PAYMENT METHOD SELECTOR */
.payment-methods {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 24px;
}

.method-option {
    position: relative;
    display: flex;
    align-items: flex-start;
    padding: 16px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    cursor: pointer;
    transition: all .15s ease;
}

.method-option:hover {
    border-color: #93c5fd;
    background: #f8fbff;
}

.method-option input[type="radio"] {
    margin-top: 3px;
    margin-right: 12px;
    accent-color: #2563eb;
}

.method-option input[type="radio"]:checked + .option-content {
    color: #2563eb;
}

.method-option:has(input[type="radio"]:checked) {
    border-color: #2563eb;
    background: #eff6ff;
}

.option-content .method-title {
    display: block;
    font-size: 14px;
    font-weight: 700;
    color: #172033;
    margin-bottom: 2px;
}

.option-content .method-desc {
    display: block;
    font-size: 11px;
    color: #64748b;
}

/* ALERTS & BUTTONS */
.alert {
    padding: 12px 16px;
    border-radius: 8px;
    font-size: 13px;
    margin-bottom: 20px;
}

.alert-danger {
    background: #fef2f2;
    border: 1px solid #fca5a5;
    color: #dc2626;
}

.alert-success {
    background: #f0fdf4;
    border: 1px solid #86efac;
    color: #166534;
}

.text-danger {
    color: #dc2626;
    font-size: 11px;
    margin-top: 4px;
    display: block;
}

.payment-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 25px;
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

        font-size: 28px;
        font-weight: 700;

        color: #172033;
        letter-spacing: -0.5px;
    }


    .page-header p {
        margin: 7px 0 0;

        color: #64748b;
        font-size: 14px;
    }


    .header-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .back-header-actions {
    display: flex;
    align-items: center;
    gap: 9px;
}
.btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 42px;

        padding: 0 17px;

        border-radius: 9px;

        font-size: 14px;
        font-weight: 600;

        text-decoration: none;

        cursor: pointer;

        transition:
            background 0.2s ease,
            border-color 0.2s ease,
            color 0.2s ease,
            transform 0.15s ease;
    }


    .btn:hover {
        transform: translateY(-1px);
    }


    .btn-secondary {
        border: 1px solid #d8e1e8;

        background: #ffffff;

        color: #475569;
    }


    .btn-secondary:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }


    .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        height: 44px;
        padding: 0 20px;

        background: #13adb5;
        color: white;

        border-radius: 8px;
        text-decoration: none;

        font-size: 14px;
        font-weight: 600;

        transition: 0.2s;
    }

    .btn-primary:hover {
        background: #0d969d;
    }

@media (max-width: 600px) {
    .payment-methods {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="payment-page">

    <div class="page-header">
        <div>
            <h1>Payment Process</h1>
            <p>Invoice #{{ $invoice->invoice_code }}</p>
        </div>
        <div>
            <a href="{{ route('invoices.show', $invoice->id) }}" 
            class="btn btn-secondary">
                ← Back to Invoice
            </a>
        </div>
    </div>

    <div class="card payment-card">
        <div class="card-header">
            <h2>Invoice Summary</h2>
            <p>Review the invoice remaining amount before proceeding.</p>
        </div>

        <div class="card-body">
            
            <div class="billing-box">
                <div class="billing-row">
                    <span>Invoice Total</span>
                    <strong>${{ number_format($invoice->total, 2, '.', ',') }}</strong>
                </div>

                <div class="billing-row discount-row">
                    <span>Paid Amount</span>
                    <strong>- ${{ number_format($invoice->paid_amount, 2, '.', ',') }}</strong>
                </div>

                <div class="billing-total">
                    <span>Remaining Balance</span>
                    <strong>${{ number_format($invoice->remaining_amount, 2, '.', ',') }}</strong>
                </div>
            </div>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($invoice->remaining_amount > 0)
                <form action="{{ route('payments.store', $invoice->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="amount" class="form-label">Payment Amount ($)</label>
                        <input 
                            type="number" 
                            id="amount" 
                            name="amount" 
                            step="1" 
                            max="{{ $invoice->remaining_amount }}" 
                            value="{{ old('amount', $invoice->remaining_amount) }}" 
                            required 
                            class="form-control"
                        >
                        @error('amount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Select Payment Method</label>
                        <div class="payment-methods">
                            
                            <label class="method-option">
                                <input type="radio" name="method" value="paypal" {{ old('method', 'paypal') === 'paypal' ? 'checked' : '' }}>
                                <div class="option-content">
                                    <span class="method-title">PayPal</span>
                                    <span class="method-desc">Redirect to PayPal website</span>
                                </div>
                            </label>

                            <label class="method-option">
                                <input type="radio" name="method" value="visa" {{ old('method') === 'visa' ? 'checked' : '' }}>
                                <div class="option-content">
                                    <span class="method-title">Visa / Credit Card</span>
                                    <span class="method-desc">Pay directly with credit card</span>
                                </div>
                            </label>

                        </div>
                        @error('method')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="payment-actions">
                        <a href="{{ route('invoices.show', $invoice->id) }}" 
                        class="btn btn-secondary">
                            Cancel
                        </a>

                        <button type="submit" class="btn-primary">
                            Proceed to Pay →
                        </button>
                    </div>

                </form>
            @else
                <div class="alert alert-success">
                    This invoice has been fully paid.
                </div>
                <div class="payment-actions">
                    <a href="{{ route('invoices.show', $invoice->id) }}" class="invoice-btn invoice-btn-secondary">
                        ← Return to Invoice Details
                    </a>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection