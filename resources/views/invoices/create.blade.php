@extends('layouts.app')

@section('title', 'Create Invoice')

@section('content')

<style>
    /* =========================================
   INVOICE CREATE
========================================= */
.form-label {
    display: block;

    margin-bottom: 7px;

    color: #475569;

    font-size: 12px;
    font-weight: 600;

    line-height: 1.4;
}
.invoice-create-page {
    max-width: 1150px;
    margin: 0 auto;
}


/* HEADER */

.invoice-create-page .page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    margin-bottom: 20px;
}

.invoice-create-page .page-header h1 {
    margin: 0;

    color: #334155;

    font-size: 22px;
    font-weight: 700;
}

.invoice-create-page .page-header p {
    margin: 6px 0 0;

    color: #94a3b8;

    font-size: 12px;
}


/* INFO CARD */

.invoice-info-card {
    display: grid;

    grid-template-columns:
        1fr
        1fr
        220px;

    gap: 20px;

    padding: 21px 22px;
    margin-bottom: 20px;

    border: 1px solid #dbeafe;
    border-radius: 12px;

    background: #ffffff;
}

.invoice-info-label {
    margin-bottom: 10px;

    color: #94a3b8;

    font-size: 10px;
    font-weight: 700;

    letter-spacing: .07em;
}

.invoice-person {
    display: flex;
    align-items: center;

    gap: 11px;
}

.invoice-avatar {
    width: 40px;
    height: 40px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 50%;

    background: #eaf4ff;
    color: #3b82f6;

    font-size: 13px;
    font-weight: 700;
}

.invoice-avatar.doctor-avatar {
    background: #eafaf5;
    color: #10b981;
}

.invoice-person-name {
    color: #334155;

    font-size: 13px;
    font-weight: 650;
}

.invoice-person-meta {
    margin-top: 4px;

    color: #94a3b8;

    font-size: 11px;
}

.invoice-reference {
    display: flex;
    flex-direction: column;

    gap: 5px;
}

.invoice-reference strong {
    color: #3b82f6;

    font-size: 14px;
}

.invoice-reference span {
    color: #94a3b8;

    font-size: 11px;
}


/* MAIN CARD */

.invoice-card {
    margin-bottom: 20px;

    border-color: #dbeafe;
}

.invoice-card .card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.invoice-card .card-header h2 {
    margin: 0;

    color: #334155;

    font-size: 16px;
}

.invoice-card .card-header p {
    margin: 5px 0 0;

    color: #94a3b8;

    font-size: 11px;
}

.invoice-status-label {
    padding: 6px 10px;

    border-radius: 7px;

    background: #eff6ff;
    color: #3b82f6;

    font-size: 9px;
    font-weight: 700;

    letter-spacing: .06em;
}


/* FORM */

.invoice-form-grid {
    display: grid;

    grid-template-columns:
        1fr
        1fr;

    gap: 18px;
}
.invoice-number-input {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #dbe7f0;
    border-radius: 10px;
    background-color: #f8fbfd;
    color: #334155;
    font-size: 14px;
    font-weight: 500;
    outline: none;
    transition: all 0.2s ease;
}

.invoice-number-input::placeholder {
    color: #94a3b8;
}

.invoice-number-input:focus {
    border-color: #7dd3fc;
    background-color: #ffffff;
    box-shadow: 0 0 0 3px rgba(125, 211, 252, 0.15);
}

.invoice-number-input:hover {
    border-color: #bae6fd;
}

.invoice-input-wrapper {
   position: relative;
    min-height: 42px;
    display: flex;
    align-items: center;
    padding: 0 58px 0 13px;
    border: 1px solid #dbeafe;
    border-radius: 8px;
    background: #f8fbff;
}

.invoice-input-unit {
    position: absolute;

    top: 50%;
    right: 12px;

    transform: translateY(-50%);

    color: #94a3b8;

    font-size: 10px;
    font-weight: 600;

    pointer-events: none;
}

.invoice-note-group {
    margin-top: 20px;
}

.invoice-note-group textarea {
    resize: vertical;
}


/* TOTAL */

.invoice-summary-card {
    margin-bottom: 20px;

    padding: 20px 23px;

    border: 1px solid #bfdbfe;
    border-radius: 12px;

    background: #f0f7ff;
}

.invoice-summary-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.invoice-summary-label {
    margin-bottom: 6px;

    color: #64748b;

    font-size: 10px;
    font-weight: 700;

    letter-spacing: .07em;
}

.invoice-total {
    color: #2563eb;

    font-size: 25px;
    font-weight: 750;
}

.invoice-summary-icon {
    width: 46px;
    height: 46px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: #dbeafe;
    color: #3b82f6;

    font-size: 20px;
    font-weight: 700;
}


/* BUTTONS */

.invoice-form-actions {
    display: flex;
    justify-content: flex-end;

    gap: 10px;

    margin-bottom: 30px;
}

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
    color: #ffffff;
}

.invoice-btn-primary:hover {
    background: #3b82f6;
    border-color: #3b82f6;
}

.invoice-btn-secondary {
    border: 1px solid #dbe3ec;

    background: #ffffff;
    color: #64748b;
}

.invoice-btn-secondary:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
}


/* ERROR */

.field-error {
    margin-top: 5px;

    color: #dc2626;

    font-size: 11px;
}
.invoice-display-wrapper {
    position: relative;

    min-height: 42px;

    display: flex;
    align-items: center;

    padding: 0 58px 0 13px;

    border: 1px solid #dbeafe;
    border-radius: 8px;

    background: #f8fbff;
}

.invoice-display-value {
    color: #334155;

    font-size: 13px;
    font-weight: 650;
}

.invoice-display-wrapper .invoice-input-unit {
    color: #94a3b8;
}

.invoice-display-wrapper.subtotal {
    background: #eff6ff;
    border-color: #bfdbfe;
}

.invoice-display-wrapper.subtotal
.invoice-display-value {
    color: #2563eb;
}


/* RESPONSIVE */

@media (max-width: 900px) {

    .invoice-info-card {
        grid-template-columns: 1fr 1fr;
    }

    .invoice-info-section:last-child {
        grid-column: 1 / -1;
    }

}


@media (max-width: 650px) {

    .invoice-create-page .page-header {
        align-items: flex-start;
        flex-direction: column;

        gap: 14px;
    }

    .invoice-info-card {
        grid-template-columns: 1fr;
    }

    .invoice-info-section:last-child {
        grid-column: auto;
    }

    .invoice-form-grid {
        grid-template-columns: 1fr;
    }

    .invoice-form-actions {
        flex-direction: column-reverse;
    }

    .invoice-btn {
        width: 100%;
    }

}
</style>


<div class="invoice-create-page">

    {{-- PAGE HEADER --}}
    <div class="page-header">

        <div>
            <h1>Create Invoice</h1>

            <p>
                Create a new invoice for the patient.
            </p>
        </div>

    </div>


    {{-- PATIENT / EXAMINATION INFO --}}
    <div class="invoice-info-card">

        {{-- PATIENT --}}
        <div class="invoice-info-section">

            <div class="invoice-info-label">
                PATIENT
            </div>

            <div class="invoice-person">

                <div class="invoice-avatar">

                    {{ strtoupper(
                        substr(
                            $examination->appointment->patient->full_name,
                            0,
                            1
                        )
                    ) }}    

                </div>

                <div>

                    <div class="invoice-person-name">
                        {{ $examination->appointment->patient->full_name }}
                    </div>

                    <div class="invoice-person-meta">

                        {{ $examination->appointment->patient->code }}

                        @if($examination->appointment->patient->phone)
                            · {{ $examination->appointment->patient->phone }}
                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- DOCTOR --}}
        <div class="invoice-info-section">

            <div class="invoice-info-label">
                DOCTOR
            </div>

            <div class="invoice-person">

                <div class="invoice-avatar doctor-avatar">

                    {{ strtoupper(
                        substr(
                            $examination
                                ->appointment
                                ->doctor
                                ->user
                                ->name,
                            0,
                            1
                        )
                    ) }}

                </div>

                <div>

                    <div class="invoice-person-name">
                        Dr.
                        {{ $examination
                            ->appointment
                            ->doctor
                            ->user
                            ->name }}
                    </div>

                    <div class="invoice-person-meta">

                        {{ $examination
                            ->appointment
                            ->doctor
                            ->specialty
                            ->name }}
                    </div>
                </div>
            </div>
        </div>


        {{-- EXAMINATION --}}
        <div class="invoice-info-section">

            <div class="invoice-info-label">
                EXAMINATION
            </div>

            <div class="invoice-reference">

                <strong>
                    #{{ $examination->id }}
                </strong>

                <span>
                    {{ \Carbon\Carbon::parse(
                        $examination->examinated_at
                    )->format('d M Y, H:i') }}
                </span>

            </div>

        </div>

    </div>


    {{-- FORM --}}
    <form
    method="POST"
    action="{{ route('invoices.store') }}"
  
>
        @csrf

        {{-- HIDDEN EXAMINATION --}}
        <input
            type="hidden"
            name="examination_id"
            value="{{ $examination->id }}"
        >

        {{-- INVOICE DETAILS --}}
        <div class="card invoice-card">
            <div class="card-header">
                <div>
                    <h2>
                        Invoice Details
                    </h2>

                </div>

                <div class="invoice-status-label">
                    NEW INVOICE
                </div>

            </div>

            <div class="card-body">

                <div class="invoice-form-grid">

                    {{-- EXAMINATION FEE --}}
                    <div class="form-group">

                        <label class="form-label">
                            Examination Fee
                        </label>

                        <div class="invoice-display-wrapper">

                            <div class="invoice-display-value">
                                $ {{ number_format(
                                    $examination->examination_fee ?? 0,
                                    2,
                                    ',',
                                    '.'
                                ) }}
                            </div>


                        </div>

                    </div>


                    {{-- MEDICINE FEE --}}
                    <div class="form-group">

                        <label class="form-label">
                            Medicine Fee
                        </label>

                        <div class="invoice-display-wrapper">

                            @php
                                $medicineTotal = $examination
                                    ->prescription
                                    ?->items
                                    ->sum(function ($item) {
                                        return $item->quantity
                                            * $item->medicine->price;
                                    }) ?? 0;
                            @endphp

                            <div class="invoice-display-value">
                                $ {{ number_format(
                                    $medicineTotal ??
                                    0,2,
                                    ',',
                                    '.'
                                ) }}
                            </div>

                        </div>

                    </div>


                    {{-- SUBTOTAL --}}
                    <div class="form-group">

                        <label class="form-label">
                            Subtotal
                        </label>

                        @php
                            $subtotal =
                                ($examination->examination_fee ?? 0)
                                + $medicineTotal;
                        @endphp

                        <div class="invoice-display-wrapper subtotal">

                            <div class="invoice-display-value">
                                $ {{ number_format(
                                    $subtotal ??
                                    0,2,
                                    ',',
                                    '.'
                                ) }}
                            </div>

                        </div>

                    </div>


                    {{-- DISCOUNT --}}
                    <div class="form-group">

                        <label
                            for="discount"
                            class="form-label"
                        >
                            Discount
                        </label>

                        <div class="invoice-input-wrapper">

                            <input
                                type="number"
                                id="discount"
                                name="discount"
                                value="{{ old('discount', 0) }}"
                                min="0"
                                max="{{ $subtotal }}"
                                step="10000"
                                class="form-input invoice-number-input"
                                placeholder="0"
                                required
                            >

                            
                        </div>

                        @error('discount')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

            </div>

        </div>


        {{-- SUMMARY --}}
        <div class="invoice-summary-card">

            <div class="invoice-summary-content">

                <div>

                    <div class="invoice-summary-label">
                        TOTAL AMOUNT
                    </div>

                    <div
                        class="invoice-total"
                        id="invoice-total"
                    >
                        0 $
                    </div>

                </div>

            </div>

        </div>


        {{-- ACTIONS --}}
        <div class="invoice-form-actions">

            <a
                href="{{ route(
                    'examinations.show', $examination
                ) }}"
                class="invoice-btn invoice-btn-secondary"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="invoice-btn invoice-btn-primary"
            >
                Create Invoice
            </button>

        </div>

    </form>

</div>


{{-- TOTAL CALCULATION --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const discountInput =
        document.getElementById('discount');

    const totalElement =
        document.getElementById('invoice-total');

    const subtotal = {{ $subtotal }};

    function calculateTotal() {

        const discount =
            parseFloat(discountInput.value) || 0;

        const total =
            Math.max(0, subtotal - discount);

        totalElement.textContent ='$ '  + 
            new Intl.NumberFormat('vi-VN')
                .format(total)  ;
    }

    discountInput.addEventListener(
        'input',
        calculateTotal
    );

    calculateTotal();
});
</script>

@endsection