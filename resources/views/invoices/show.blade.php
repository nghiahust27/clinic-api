@extends('layouts.app')

@section('title', 'Invoice Details')

@section('content')

<style>
    /* =========================================
   INVOICE SHOW
========================================= */

.invoice-show-page {
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


    .header-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }


/* HEADER */

.invoice-header-actions {
    display: flex;
    align-items: center;
    gap: 9px;
}


/* MAIN INVOICE */

.invoice-main-card {
    margin-bottom: 20px;
    padding: 23px 25px;

    border: 1px solid #bfdbfe;
    border-radius: 12px;

    background: #f0f7ff;
}

.invoice-main-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.invoice-label {
    margin-bottom: 5px;

    color: #64748b;

    font-size: 9px;
    font-weight: 700;

    letter-spacing: .08em;
}

.invoice-code {
    color: #2563eb;

    font-size: 22px;
    font-weight: 750;
}

.invoice-issued {
    margin-top: 5px;

    color: #94a3b8;

    font-size: 11px;
}


/* STATUS */

.invoice-status {
    padding: 7px 12px;

    border-radius: 7px;

    font-size: 10px;
    font-weight: 700;
}

.invoice-status-unpaid {
    background: #fef3c7;
    color: #b45309;
}

.invoice-status-paid {
    background: #dcfce7;
    color: #15803d;
}

.invoice-status-cancelled {
    background: #fee2e2;
    color: #dc2626;
}


/* GRID */

.invoice-detail-grid {
    display: grid;

    grid-template-columns: 1fr 1fr;

    gap: 20px;
}


/* CARD */
.card-header {
    padding: 0px 28px;
    margin-bottom: 14px;
}

.card-body {
    padding: 28px;
}

.invoice-detail-card {
    margin-bottom: 20px;
}

.invoice-detail-card .card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.invoice-detail-card .card-header h2 {
    margin: 0;

    color: #334155;

    font-size: 15px;
}

.invoice-detail-card .card-header p {
    margin: 5px 0 0;

    color: #94a3b8;

    font-size: 11px;
}


/* PATIENT */

.invoice-patient {
    display: flex;
    align-items: center;

    gap: 12px;
}

.invoice-patient-avatar {
    width: 45px;
    height: 45px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 50%;

    background: #eaf4ff;
    color: #3b82f6;

    font-size: 14px;
    font-weight: 700;
}

.invoice-patient-name {
    color: #334155;

    font-size: 14px;
    font-weight: 650;
}

.invoice-patient-meta {
    margin-top: 4px;

    color: #94a3b8;

    font-size: 11px;
}


/* APPOINTMENT */

.invoice-appointment-list {
    display: flex;
    flex-direction: column;

    gap: 11px;
}

.invoice-detail-row {
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding-bottom: 10px;

    border-bottom: 1px solid #f1f5f9;
}

.invoice-detail-row:last-child {
    padding-bottom: 0;
    border-bottom: none;
}

.invoice-detail-row span:first-child {
    color: #94a3b8;

    font-size: 11px;
}

.invoice-detail-row strong {
    color: #475569;

    font-size: 11px;
}

.appointment-status {
    padding: 4px 8px;

    border-radius: 6px;

    background: #eff6ff;
    color: #3b82f6;

    font-size: 10px !important;
}


/* LINK */

.invoice-small-link {
    color: #3b82f6;

    font-size: 11px;
    font-weight: 600;

    text-decoration: none;
}

.invoice-small-link:hover {
    text-decoration: underline;
}


/* EXAMINATION */

.examination-content {
    display: grid;

    grid-template-columns: 1fr 1fr;

    gap: 20px;
}

.examination-field span {
    display: block;

    margin-bottom: 7px;

    color: #94a3b8;

    font-size: 10px;
    font-weight: 700;

    text-transform: uppercase;
}

.examination-field div {
    padding: 12px;

    border: 1px solid #e5eef8;
    border-radius: 8px;

    background: #f8fbff;

    color: #475569;

    font-size: 12px;
    line-height: 1.6;
}


/* MEDICINE */

.invoice-medicine-list {
    display: flex;
    flex-direction: column;
}

.invoice-medicine-row {
    display: grid;

    grid-template-columns:
        32px
        minmax(180px, 1fr)
        70px
        130px
        140px;

    align-items: center;

    gap: 12px;

    padding: 13px 0;

    border-bottom: 1px solid #eef2f7;
}

.invoice-medicine-row:first-child {
    padding-top: 0;
}

.invoice-medicine-row:last-child {
    padding-bottom: 0;
    border-bottom: none;
}

.medicine-index {
    width: 27px;
    height: 27px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 7px;

    background: #eff6ff;
    color: #3b82f6;

    font-size: 11px;
    font-weight: 700;
}

.medicine-name {
    color: #334155;

    font-size: 12px;
    font-weight: 650;
}

.medicine-meta {
    margin-top: 4px;

    color: #94a3b8;

    font-size: 10px;
}

.medicine-quantity {
    color: #64748b;

    font-size: 11px;
}

.medicine-price {
    color: #64748b;

    font-size: 11px;

    text-align: right;
}

.medicine-total {
    color: #2563eb;

    font-size: 12px;
    font-weight: 650;

    text-align: right;
}


/* EMPTY */

.invoice-empty {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;

    min-height: 120px;

    color: #94a3b8;

    font-size: 12px;
}

.invoice-empty-icon {
    margin-bottom: 8px;

    color: #cbd5e1;

    font-size: 26px;
}


/* BILLING */

.invoice-billing-card {
    border-color: #dbeafe;
}

.billing-summary {
    max-width: 550px;

    margin-right: auto;
}

.billing-row {
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 11px 0;

    border-bottom: 1px solid #eef2f7;
}

.billing-row span {
    color: #64748b;

    font-size: 12px;
}

.billing-row strong {
    color: #475569;

    font-size: 12px;
}

.discount-row strong {
    color: #ef4444;
}

.billing-total {
    display: flex;
    align-items: center;
    justify-content: space-between;

    margin-top: 8px;
    padding-top: 16px;

    border-top: 2px solid #dbeafe;
}

.billing-total span {
    color: #334155;

    font-size: 14px;
    font-weight: 700;
}

.billing-total strong {
    color: #2563eb;

    font-size: 20px;
    font-weight: 750;
}


/* NOTE */

.invoice-note {
    padding: 13px 15px;

    border: 1px solid #e5eef8;
    border-radius: 8px;

    background: #f8fbff;

    color: #64748b;

    font-size: 12px;
    line-height: 1.6;
}


/* FOOTER */

.invoice-footer-actions {
    display: flex;
    justify-content: flex-end;

    margin-bottom: 30px;
}


/* BUTTON */

.invoice-btn {
    min-height: 39px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0 16px;

    border-radius: 8px;

    font-size: 12px;
    font-weight: 650;

    text-decoration: none;

    cursor: pointer;

    transition: .15s ease;
}

.invoice-btn-primary {
    border: 1px solid #60a5fa;

    background: #60a5fa;
    color: #fff;
}

.invoice-btn-primary:hover {
    border-color: #3b82f6;
    background: #3b82f6;
}

.invoice-btn-secondary {
    border: 1px solid #dbe3ec;

    background: #fff;
    color: #64748b;
}

.invoice-btn-secondary:hover {
    background: #f8fafc;
}


/* RESPONSIVE */

@media (max-width: 800px) {

    .invoice-detail-grid {
        grid-template-columns: 1fr;
    }

    .examination-content {
        grid-template-columns: 1fr;
    }

    .invoice-medicine-row {
        grid-template-columns:
            32px
            1fr
            70px;
    }

    .medicine-price,
    .medicine-total {
        text-align: left;
    }

}


@media (max-width: 600px) {

    .invoice-main-top {
        align-items: flex-start;
        flex-direction: column;

        gap: 15px;
    }

    .invoice-header-actions {
        width: 100%;
    }

    .invoice-header-actions .invoice-btn {
        flex: 1;
    }

    .invoice-medicine-row {
        grid-template-columns:
            30px
            1fr;
    }

    .medicine-quantity,
    .medicine-price,
    .medicine-total {
        grid-column: 2;
    }

    .billing-summary {
        max-width: none;
    }

}
</style>

<div class="invoice-show-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div>
            <h1>Invoice Details</h1>

            <p>
                Invoice {{ $invoice->invoice_code }}
            </p>
        </div>

        <div class="invoice-header-actions">

            <a
                href="{{ route('invoices.index') }}"
                class="invoice-btn invoice-btn-secondary"
            >
                ← Back
            </a>

            @if(
                auth()->user()->hasPermission(
                    'INVOICES.UPDATE'
                )
            )
                <a
                    href="{{ route(
                        'invoices.edit',
                        ['invoice' => $invoice->id]
                    ) }}"
                    class="invoice-btn invoice-btn-primary"
                >
                    Edit
                </a>
            @endif

        </div>

    </div>


    {{-- INVOICE HEADER --}}
    <div class="invoice-main-card">

        <div class="invoice-main-top">

            <div>

                <div class="invoice-label">
                    INVOICE
                </div>

                <div class="invoice-code">
                    {{ $invoice->invoice_code }}
                </div>

                <div class="invoice-issued">
                    Issued:
                    {{ \Carbon\Carbon::parse(
                        $invoice->issued_at
                    )->format('d M Y, H:i') }}
                </div>

            </div>


            <div class="invoice-status
                invoice-status-{{ $invoice->status }}">

                {{ strtoupper($invoice->status) }}

            </div>

        </div>

    </div>


    {{-- PATIENT + APPOINTMENT --}}
    <div class="invoice-detail-grid">

        {{-- PATIENT --}}
        <div class="card invoice-detail-card">

            <div class="card-header">

                <div>
                    <h2>Patient</h2>
                </div>

            </div>

            <div class="card-body">

                <div class="invoice-patient">

                    <div class="invoice-patient-avatar">

                        {{ strtoupper(
                            substr(
                                $invoice
                                    ->examination
                                    ->appointment
                                    ->patient
                                    ->full_name,
                                0,
                                1
                            )
                        ) }}

                    </div>

                    <div>

                        <div class="invoice-patient-name">

                            {{ $invoice
                                ->examination
                                ->appointment
                                ->patient
                                ->full_name }}

                        </div>

                        <div class="invoice-patient-meta">

                            Patient Code:
                            {{ $invoice
                                ->examination
                                ->appointment
                                ->patient
                                ->code }}

                        </div>

                        @if(
                            $invoice
                                ->examination
                                ->appointment
                                ->patient
                                ->phone
                        )

                            <div class="invoice-patient-meta">

                                Phone:
                                {{ $invoice
                                    ->examination
                                    ->appointment
                                    ->patient
                                    ->phone }}

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- APPOINTMENT --}}
        <div class="card invoice-detail-card">

            <div class="card-header">

                <div>
                    <h2>Appointment</h2>
                </div>

            </div>

            <div class="card-body">

                <div class="invoice-appointment-list">

                    <div class="invoice-detail-row">

                        <span>
                            Date
                        </span>

                        <strong>

                            {{ \Carbon\Carbon::parse(
                                $invoice
                                    ->examination
                                    ->appointment
                                    ->scheduled_at
                            )->format('D, d M Y') }}

                        </strong>

                    </div>


                    <div class="invoice-detail-row">

                        <span>
                            Time
                        </span>

                        <strong>

                            {{ \Carbon\Carbon::parse(
                                $invoice
                                    ->examination
                                    ->appointment
                                    ->scheduled_at
                            )->format('H:i') }}

                        </strong>

                    </div>


                    <div class="invoice-detail-row">

                        <span>
                            Doctor
                        </span>

                        <strong>

                            Dr.
                            {{ $invoice
                                ->examination
                                ->appointment
                                ->doctor
                                ->user
                                ->name }}

                        </strong>

                    </div>


                    <div class="invoice-detail-row">

                        <span>
                            Status
                        </span>

                        <span class="appointment-status">

                            {{ ucfirst(
                                $invoice
                                    ->examination
                                    ->appointment
                                    ->status
                            ) }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- EXAMINATION --}}
    <div class="card invoice-detail-card">

        <div class="card-header">

            <div>

                <h2>Medical Examination</h2>

                <p>
                    Examination information related to this invoice.
                </p>

            </div>

            <a
                href="{{ route(
                    'examinations.show',
                    [
                        'examination' =>
                            $invoice->examination->id
                    ]
                ) }}"
                class="invoice-small-link"
            >
                View Examination
            </a>
        </div>

        <div class="card-body">

            <div class="examination-content">

                <div class="examination-field">

                    <span>
                        Diagnosis
                    </span>

                    <div>
                        {{ $invoice
                            ->examination
                            ->diagnosis
                            ?: 'No diagnosis provided.' }}
                    </div>

                </div>


                <div class="examination-field">

                    <span>
                        Note
                    </span>

                    <div>
                        {{ $invoice
                            ->examination
                            ->note
                            ?: 'No examination note.' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- PRESCRIPTION --}}
    <div class="card invoice-detail-card">

        <div class="card-header">
            <div>
                <h2>Prescription</h2>
                <p>
                    Medicines prescribed during this examination.
                </p>
            </div>

            @if(
                $invoice
                    ->examination
                    ->prescription
            )

                <a
                    href="{{ route(
                        'prescriptions.show',
                        [
                            'prescription' =>
                                $invoice
                                    ->examination
                                    ->prescription
                                    ->id
                        ]
                    ) }}"
                    class="invoice-small-link"
                >
                    View Prescription
                </a>

            @endif

        </div>


        <div class="card-body">

            @if(
                $invoice
                    ->examination
                    ->prescription
                    && $invoice
                        ->examination
                        ->prescription
                        ->items
                        ->count()
            )

                <div class="invoice-medicine-list">

                    @foreach(
                        $invoice
                            ->examination
                            ->prescription
                            ->items
                            as $item
                    )

                        @php

                            $medicineTotal =
                                $item->quantity
                                * $item->medicine->price;

                        @endphp


                        <div class="invoice-medicine-row">

                            <div class="medicine-index">

                                {{ $loop->iteration }}

                            </div>


                            <div class="medicine-info">

                                <div class="medicine-name">

                                    {{ $item
                                        ->medicine
                                        ->name }}

                                </div>

                                <div class="medicine-meta">

                                    {{ $item
                                        ->medicine
                                        ->unit }}

                                    ·

                                    {{ $item->dousage }}

                                    ·

                                    {{ $item
                                        ->usage_instruction }}

                                </div>

                            </div>


                            <div class="medicine-quantity">

                                × {{ $item->quantity }}

                            </div>


                            <div class="medicine-price">
                                $

                                {{ number_format(
                                    $item
                                        ->medicine
                                        ->price,
                                    0,
                                    ',',
                                    '.'
                                ) }}


                            </div>


                            <div class="medicine-total">
                                 $
                                {{ number_format(
                                    $medicineTotal,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="invoice-empty">

                    <div class="invoice-empty-icon">
                        ♡
                    </div>

                    <div>
                        No prescription medicines.
                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- BILLING --}}
    <div class="card invoice-detail-card invoice-billing-card">

        <div class="card-header">

            <div>

                <h2>Invoice Summary</h2>

                <p>
                    Payment information for this invoice.
                </p>

            </div>

        </div>

        <div class="card-body">

            <div class="billing-summary">

                <div class="billing-row">

                    <span>
                        Examination Fee
                    </span>

                    <strong>
                        $

                        {{ number_format(
                            $invoice
                                ->examination
                                ->examination_fee,
                            0,
                            ',',
                            '.'
                        ) }}

                    </strong>

                </div>


                <div class="billing-row">

                    <span>
                        Medicine Fee
                    </span>

                    <strong>
                        $


                        {{ number_format(
                            $invoice->subtotal
                            - $invoice
                                ->examination
                                ->examination_fee,
                            0,
                            ',',
                            '.'
                        ) }}


                    </strong>

                </div>


                <div class="billing-row">

                    <span>
                        Subtotal
                    </span>

                    <strong>
                        $

                        {{ number_format(
                            $invoice->subtotal,
                            0,
                            ',',
                            '.'
                        ) }}


                    </strong>

                </div>


                <div class="billing-row discount-row">

                    <span>
                        Discount
                    </span>

                    <strong>

                        -$
                        {{ number_format(
                            $invoice->discount,
                            0,
                            ',',
                            '.'
                        ) }}

                    </strong>

                </div>

                @if(isset($invoice->payments))
                    <div class="billing-row discount-row">

                        <span>
                            Paid
                        </span>

                        <strong>

                            - $
                            {{ number_format(
                                $invoice->paid_amount,
                                0,',','.'
                            ) }}

                        </strong>

                    </div>
                @endif


                <div class="billing-total">

                    <span>
                        Total
                    </span>

                    <strong>
                        $
                        {{ number_format(
                            $invoice->remaining_amount,
                            0,
                            ',',
                            '.'
                        ) }}

                    </strong>

                </div>

            </div>
        </div>
    </div>
    {{-- FOOTER --}}
    @if( auth()->user()->hasPermission('PAYMENTS.CREATE'))
        @if($invoice->status === 'unpaid')
            <div>
                <a
                    href="{{ route('payments.create', 
                    $invoice) }}"
                    class="invoice-btn invoice-btn-primary"
                >
                    Create Payments 
                </a>
            </div>
        @endif
    @endif
    <div class="invoice-footer-actions">
        <a
            href="{{ route('invoices.index') }}"
            class="invoice-btn invoice-btn-secondary"
        >
            ← Back to Invoices
        </a>
    </div>

</div>

@endsection