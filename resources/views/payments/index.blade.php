@extends('layouts.app')

@section('title', 'Payment History')

@section('content')
<style>
/* =========================================
   PAYMENTS INDEX PAGE
========================================= */
.payments-index-page {
    max-width: 1150px;
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

/* CARD & TABLE CONTAINER */
.payments-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.payments-card .card-header {
    padding: 20px 25px;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.payments-card .card-header h2 {
    margin: 0;
    color: #334155;
    font-size: 16px;
    font-weight: 700;
}

/* TABLE STYLING */
.table-responsive {
    width: 100%;
    overflow-x: auto;
}

.payments-table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
}

.payments-table th {
    padding: 14px 20px;
    background: #f8fbff;
    color: #64748b;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .05em;
    border-bottom: 1px solid #e2e8f0;
}

.payments-table td {
    padding: 16px 20px;
    color: #334155;
    font-size: 13px;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}

.payments-table tbody tr:last-child td {
    border-bottom: none;
}

.payments-table tbody tr:hover {
    background: #f8fbff;
}

/* TABLE DATA STYLES */
.payment-id-link {
    color: #2563eb;
    font-weight: 700;
    text-decoration: none;
}

.payment-id-link:hover {
    text-decoration: underline;
}

.payment-amount {
    color: #2563eb;
    font-size: 14px;
    font-weight: 750;
}

.method-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 10px;
    border-radius: 6px;
    background: #f1f5f9;
    color: #475569;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
}

/* STATUS BADGES */
.payment-status {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .03em;
}

.payment-status-pending {
    background: #fef3c7;
    color: #b45309;
}

.payment-status-completed {
    background: #dcfce7;
    color: #15803d;
}

.payment-status-failed {
    background: #fee2e2;
    color: #dc2626;
}

.payment-status-cancelled {
    background: #f1f5f9;
    color: #64748b;
}

/* EMPTY STATE */
.payments-empty {
    padding: 40px 20px;
    text-align: center;
    color: #94a3b8;
}

.payments-empty-icon {
    font-size: 32px;
    margin-bottom: 8px;
    color: #cbd5e1;
}

    /* ================= PAGINATION ================= */

.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 28px;
    padding-bottom: 10px;
}

.pagination-wrapper nav {
    display: flex;
    align-items: center;
}

.pagination-wrapper nav > div:first-child {
    display: none;
}

.pagination-wrapper nav > div:last-child {
    display: flex;
    align-items: center;
}

.pagination-wrapper nav ul {
    display: flex;
    align-items: center;
    gap: 6px;

    margin: 0;
    padding: 0;

    list-style: none;
}

.pagination-wrapper nav li {
    margin: 0;
    padding: 0;
}


/* PAGINATION BUTTON */

.pagination-wrapper nav a,
.pagination-wrapper nav span {
    min-width: 36px;
    height: 36px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0 10px;

    box-sizing: border-box;

    border: 1px solid #e5e7eb;
    border-radius: 8px;

    background: #ffffff;
    color: #4b5563;

    font-size: 13px;
    font-weight: 600;

    text-decoration: none;

    transition:
        background .15s ease,
        border-color .15s ease,
        color .15s ease,
        box-shadow .15s ease;
}


/* HOVER */

.pagination-wrapper nav a:hover {
    border-color: #bfdbfe;
    background: #eff6ff;
    color: #2563eb;
}


/* ACTIVE PAGE */

.pagination-wrapper nav span[aria-current="page"] {
    border-color: #2563eb;
    background: #2563eb;
    color: #ffffff;

    box-shadow: 0 2px 6px rgba(37, 99, 235, .18);
}


/* DISABLED */

.pagination-wrapper nav span[aria-disabled="true"] {
    background: #f9fafb;
    color: #c4c9d0;
    border-color: #edf0f2;

    cursor: not-allowed;
}


/* ARROW */

.pagination-wrapper nav a[rel="prev"],
.pagination-wrapper nav a[rel="next"] {
    font-size: 15px;
}


/* DOTS */

.pagination-wrapper nav span:not([aria-current]):not([aria-disabled]) {
    min-width: 30px;

    border-color: transparent;
    background: transparent;
}

</style>

<div class="payments-index-page">

    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <h1>Payment Transactions</h1>
            <p>Manage and track all invoice payment records.</p>
        </div>
    </div>

    {{-- TABLE CARD --}}
    <div class="payments-card">
        <div class="card-header">
            <h2>Transaction Records</h2>
        </div>

        <div class="table-responsive">
            <table class="payments-table">
                <thead>
                    <tr>
                        <th>Payment ID</th>
                        <th>Invoice Code</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Provider Order ID</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                        <tr>
                            <td>
                                <span class="payment-id-link">
                                    #PAY-{{ str_pad($payment->id, 5, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('invoices.show', $payment->invoice_id) }}" class="payment-id-link">
                                    {{ $payment->invoice->invoice_code ?? 'N/A' }}
                                </a>
                            </td>

                            <td>
                                <span class="payment-amount">
                                    ${{ number_format($payment->amount, 2, '.', ',') }}
                                </span>
                            </td>

                            <td>
                                <span class="method-badge">
                                    @if($payment->method === 'paypal')
                                        🅿️ PayPal
                                    @elseif($payment->method === 'visa')
                                        💳 Visa / Card
                                    @else
                                        {{ strtoupper($payment->method) }}
                                    @endif
                                </span>
                            </td>

                            <td>
                                <span class="payment-status payment-status-{{ $payment->status }}">
                                    {{ strtoupper($payment->status) }}
                                </span>
                            </td>

                            <td>
                                <code style="font-size: 11px; color: #64748b;">
                                    {{ $payment->provider_order_id ?? '-' }}
                                </code>
                            </td>

                            <td>
                                {{ $payment->created_at ? $payment->created_at->format('d M Y, H:i') : '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="payments-empty">
                                    <div class="payments-empty-icon">💳</div>
                                    <div>No payment transactions found.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

         <!-- ================= PAGINATION ================= -->

        @if(method_exists($payments, 'links'))

            <div class="pagination-container">


                <div class="pagination-wrapper">

                    {{ $payments->withQueryString()->links() }}

                </div>

            </div>

        @endif
    </div>

</div>
@endsection