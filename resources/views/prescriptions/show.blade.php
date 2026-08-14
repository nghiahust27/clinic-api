@extends('layouts.app')

@section('title', 'Prescription Details')

@section('content')

<style>
    /* =========================================
   PRESCRIPTION SHOW
========================================= */

.prescription-show-page {
    max-width: 1150px;
    margin: 0 auto;
}


/* HEADER */

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


/* INFO CARD */

.prescription-info-card {
    display: grid;
    grid-template-columns: 1fr 1fr 220px;
    gap: 20px;

    padding: 21px 22px;
    margin-bottom: 20px;

    border: 1px solid #1e293b;
    border-radius: 12px;

    background: #fff;
}

.prescription-info-item {
    min-width: 0;
}

.prescription-info-label {
    margin-bottom: 10px;

    color: #9ca3af;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .07em;
}

.prescription-person {
    display: flex;
    align-items: center;
    gap: 11px;
}

.prescription-avatar {
    width: 40px;
    height: 40px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 50%;

    background: #eff6ff;
    color: #2563eb;

    font-size: 13px;
    font-weight: 700;
}

.doctor-avatar {
    background: #ecfdf5;
    color: #059669;
}

.prescription-person-name {
    color: #374151;
    font-size: 13px;
    font-weight: 650;
}

.prescription-person-meta {
    margin-top: 4px;

    color: #9ca3af;
    font-size: 11px;
}

.prescription-examination {
    display: flex;
    flex-direction: column;
    gap: 5px;

    color: #9ca3af;
    font-size: 12px;
}

.prescription-examination strong {
    color: #2563eb;
    font-size: 14px;
}

.small-link {
    margin-top: 3px;

    color: #2563eb;

    font-size: 11px;
    font-weight: 600;

    text-decoration: none;
}

.small-link:hover {
    text-decoration: underline;
}


/* CARD */

.prescription-card {
    margin-bottom: 20px;
}

.prescription-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.prescription-header h2 {
    margin: 0;
}

.prescription-header p {
    margin: 5px 0 0;

    color: #1e293b;
    font-size: 12px;
}

.medicine-count {
    padding: 7px 11px;

    border-radius: 7px;

    background: #eff6ff;
    color: #2563eb;

    font-size: 12px;
    font-weight: 600;
}


/* MEDICINE LIST */

.prescription-medicine-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.prescription-medicine {
    display: grid;

    grid-template-columns:
        34px
        minmax(190px, 1.4fr)
        100px
        110px
        minmax(230px, 1.7fr);

    align-items: center;

    gap: 15px;

    padding: 15px;

    border: 1px solid #0000AA;
    border-radius: 10px;

    background: #fafbfc;
}

.medicine-number {
    width: 29px;
    height: 29px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 7px;

    background: #eff6ff;
    color: #2563eb;

    font-size: 12px;
    font-weight: 700;
}

.medicine-main {
    min-width: 0;
}

.medicine-name {
    color: #374151;

    font-size: 13px;
    font-weight: 650;
}

.medicine-unit {
    margin-top: 4px;

    color: #9ca3af;

    font-size: 11px;
}

.medicine-detail {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.medicine-detail-label {
    color: #9ca3af;

    font-size: 9px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .05em;
}

.medicine-detail strong {
    color: #374151;

    font-size: 12px;
}

.medicine-instruction {
    min-width: 0;

    color: #4b5563;

    font-size: 12px;
    line-height: 1.5;
}


/* NOTE */

.prescription-note-display {
    padding: 14px 15px;
    border: 2px solid #CCFFCC;
    border-radius: 9px;
    background: #fafbfc;
    color: #000000;
    font-size: 13px;
    line-height: 1.6;
    white-space: pre-line;
}


/* EMPTY */

.medical-placeholder {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;

    min-height: 140px;

    color: #9ca3af;

    text-align: center;
    font-size: 12px;
}

.medical-placeholder-icon {
    margin-bottom: 8px;

    color: #cbd5e1;

    font-size: 27px;
}


/* META */

.prescription-meta {
    display: flex;
    justify-content: flex-end;
    gap: 18px;

    margin-top: -7px;
    margin-bottom: 25px;

    color: #9ca3af;

    font-size: 10px;
}


/* BUTTONS */

.prescription-btn {
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

.prescription-btn-primary {
    border: 1px solid #2563eb;

    background: #2563eb;
    color: #fff;
}

.prescription-btn-primary:hover {
    background: #1d4ed8;
}

.prescription-btn-secondary {
    border: 1px solid #e5e7eb;

    background: #fff;
    color: #4b5563;
}

.prescription-btn-secondary:hover {
    background: #f9fafb;
    border-color: #d1d5db;
}
.card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;

        min-height: 62px;

        padding: 0 20px;

        border-bottom: 1px solid #edf2f5;

        background: #ffffff;
    }


    .card-header h2 {
        margin: 0;

        color: #1e293b;

        font-size: 16px;
        font-weight: 700;
    }


    .card-body {
        padding: 20px;
    }


/* RESPONSIVE */

@media (max-width: 1000px) {

    .prescription-info-card {
        grid-template-columns: 1fr 1fr;
    }

    .prescription-medicine {
        grid-template-columns:
            34px
            1fr
            100px
            100px;
    }

    .medicine-instruction {
        grid-column: 2 / -1;
    }
}


@media (max-width: 650px) {

    .prescription-info-card {
        grid-template-columns: 1fr;
    }

    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 14px;
    }

    .header-actions {
        width: 100%;
    }

    .header-actions .prescription-btn {
        flex: 1;
    }

    .prescription-medicine {
        grid-template-columns: 34px 1fr;
    }

    .medicine-detail,
    .medicine-instruction {
        grid-column: 2;
    }

    .prescription-header {
        align-items: flex-start;
        flex-direction: column;
        gap: 10px;
    }

    .prescription-meta {
        flex-direction: column;
        align-items: flex-end;
        gap: 4px;
    }
}
</style>

<div class="prescription-show-page">

    {{-- PAGE HEADER --}}
    <div class="page-header">

        <div>
            <h1>Prescription Details</h1>

            <p>
                Prescription #{{ $prescription->id }}
            </p>
        </div>

        <div class="header-actions">

            <a
                href="{{ route('examinations.show',
                $prescription->examination) }}"
                class="prescription-btn prescription-btn-secondary"
            >
                ← Back
            </a>

            @if(
                auth()->user()->hasPermission(
                    'PRESCRIPTIONS.UPDATE'
                )
            )
                <a
                    href="{{ route(
                        'prescriptions.edit',
                        $prescription
                    ) }}"
                    class="prescription-btn prescription-btn-primary"
                >
                    Edit
                </a>
            @endif  
            @if(
                auth()->user()->hasPermission(
                    'INVOICES.CREATE'
                )
            )
                <a
                    href="{{ route(
                         'examinations.invoices.create',
                        [$prescription->examination]
                    ) }}"
                    class="prescription-btn prescription-btn-primary"
                >
                    Create Invoice
                </a>
            @endif

        </div>

    </div>


    {{-- PATIENT / DOCTOR / EXAMINATION --}}
    <div class="prescription-info-card">

        {{-- PATIENT --}}
        <div class="prescription-info-item">

            <div class="prescription-info-label">
                PATIENT
            </div>

            <div class="prescription-person">

                <div class="prescription-avatar">

                    {{ strtoupper(
                        substr(
                            $prescription
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

                    <div class="prescription-person-name">

                        {{ $prescription
                            ->examination
                            ->appointment
                            ->patient
                            ->full_name }}

                    </div>

                    <div class="prescription-person-meta">

                        {{ $prescription
                            ->examination
                            ->appointment
                            ->patient
                            ->phone
                            ?? 'No phone number'
                        }}

                    </div>

                </div>

            </div>

        </div>


        {{-- DOCTOR --}}
        <div class="prescription-info-item">

            <div class="prescription-info-label">
                DOCTOR
            </div>

            <div class="prescription-person">

                <div class="prescription-avatar doctor-avatar">

                    {{ strtoupper(
                        substr(
                            $prescription
                                ->doctor
                                ->user
                                ->name,
                            0,
                            1
                        )
                    ) }}

                </div>

                <div>

                    <div class="prescription-person-name">

                        Dr.
                        {{ $prescription
                            ->doctor
                            ->user
                            ->name }}

                    </div>

                    <div class="prescription-person-meta">

                        Attending Doctor

                    </div>

                </div>

            </div>

        </div>


        {{-- EXAMINATION --}}
        <div class="prescription-info-item">

            <div class="prescription-info-label">
                EXAMINATION
            </div>

            <div class="prescription-examination">

                <strong>
                    #{{ $prescription->examination_id }}
                </strong>

                <span>

                    {{ $prescription
                        ->examination
                        ->examinated_at
                        ? \Carbon\Carbon::parse(
                            $prescription
                                ->examination
                                ->examinated_at
                        )->format('d M Y, H:i')
                        : 'N/A'
                    }}

                </span>

                <a
                    href="{{ route(
                        'examinations.show',
                        [
                            'examination' =>
                                $prescription->examination_id
                        ]
                    ) }}"
                    class="small-link"
                >
                    View examination
                </a>

            </div>

        </div>

    </div>


    {{-- MEDICINES --}}
    <div class="card prescription-card">

        <div class="card-header prescription-header">

            <div>

                <h2>
                    Prescribed Medicines
                </h2>

                <p>
                    Medicines included in this prescription.
                </p>

            </div>

            <div class="medicine-count">

                {{ $prescription->items->count() }}

                {{ $prescription->items->count() === 1
                    ? 'medicine'
                    : 'medicines'
                }}

            </div>

        </div>


        <div class="card-body">

            @if($prescription->items->count())

                <div class="prescription-medicine-list">

                    @foreach(
                        $prescription->items as $index => $item
                    )

                        <div class="prescription-medicine">

                            {{-- NUMBER --}}
                            <div class="medicine-number">

                                {{ $index + 1 }}

                            </div>


                            {{-- MEDICINE --}}
                            <div class="medicine-main">

                                <div class="medicine-name">

                                    {{ $item
                                        ->medicine
                                        ->name }}

                                </div>

                                <div class="medicine-unit">

                                    Unit:
                                    {{ $item
                                        ->medicine
                                        ->unit }}

                                </div>

                            </div>


                            {{-- QUANTITY --}}
                            <div class="medicine-detail">

                                <span class="medicine-detail-label">
                                    Quantity
                                </span>

                                <strong>
                                    {{ $item->quantity }}
                                </strong>

                            </div>


                            {{-- DOUSAGE --}}
                            <div class="medicine-detail">

                                <span class="medicine-detail-label">
                                    Dousage
                                </span>

                                <strong>
                                    {{ $item->dousage }}
                                </strong>

                            </div>


                            {{-- INSTRUCTION --}}
                            <div class="medicine-instruction">

                                <span class="medicine-detail-label">
                                    Usage Instruction
                                </span>

                                <div>
                                    {{ $item->usage_instruction }}
                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="medical-placeholder">

                    <div class="medical-placeholder-icon">
                        ♡
                    </div>

                    <div>
                        No medicines have been added
                        to this prescription.
                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- PRESCRIPTION NOTE --}}
    <div class="card prescription-card">

        <div class="card-header">

            <div>

                <h2>
                    Prescription Note
                </h2>

            </div>

        </div>


        <div class="card-body">

            @if($prescription->note)

                <div class="prescription-note-display">

                    {{ $prescription->note }}

                </div>

            @else

                <div class="medical-placeholder">

                    <div class="medical-placeholder-icon">
                        ♡
                    </div>

                    <div>
                        No prescription note provided.
                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- TIMESTAMPS --}}
    <div class="prescription-meta">

        <span>
            Created:
            {{ $prescription->created_at
                ->format('d M Y, H:i')
            }}
        </span>

        <span>
            Updated:
            {{ $prescription->updated_at
                ->format('d M Y, H:i')
            }}
        </span>

    </div>

</div>

@endsection