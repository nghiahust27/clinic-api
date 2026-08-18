@extends('layouts.app')

@section('title', 'Edit Prescription')

@section('content')

<style>
    /* =========================================
   PRESCRIPTION EDIT
========================================= */

.prescription-edit-page {
    max-width: 1150px;
    margin: 0 auto;
}


/* HEADER */

.header-actions {
    display: flex;
    align-items: center;
    gap: 9px;
}

.card {
        overflow: hidden;

        border: 1px solid #1e293b;
        border-radius: 14px;

        background: #ffffff;

        box-shadow:
            0 2px 8px rgba(15, 23, 42, 0.035);

        transition:
            box-shadow 0.2s ease,
            border-color 0.2s ease;
    }


    .card:hover {
        border-color: #d5dfe7;

        box-shadow:
            0 5px 18px rgba(15, 23, 42, 0.06);
    }


    .full-width {
        grid-column: 1 / -1;
    }


    /* =========================================================
       CARD HEADER
    ========================================================= */

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


/* INFO */

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


/* FORM */

.form-input {
    width: 100%;
    min-height: 40px;

    box-sizing: border-box;

    padding: 8px 11px;

    border: 1px solid #d9dee5;
    border-radius: 8px;

    background: #fff;
    color: #374151;

    font-size: 12px;

    outline: none;

    transition: .15s ease;
}

.form-input:focus {
    border-color: #60a5fa;

    box-shadow:
        0 0 0 3px rgba(59,130,246,.08);
}

.form-label {
    display: block;

    margin-bottom: 6px;

    color: #374151;
    font-size: 11px;
    font-weight: 650;
}

.form-group {
    min-width: 0;
}

.prescription-note {
    width: 100%;

    box-sizing: border-box;

    resize: vertical;
}

.field-error {
    margin-top: 5px;

    color: #dc2626;
    font-size: 11px;
}

.form-actions-right {
    display: flex;
    justify-content: flex-end;

    margin-top: 15px;
}


/* ADD MEDICINE */

.add-medicine-grid {
    display: grid;

    grid-template-columns:
        minmax(220px, 1.5fr)
        110px
        180px
        minmax(220px, 1.5fr);

    gap: 13px;
}


/* CURRENT MEDICINES */

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

    color: #9ca3af;
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


/* MEDICINE ITEM */

.edit-medicine-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.edit-medicine-item {
    padding: 16px;

    border: 1px solid #e5e7eb;
    border-radius: 10px;

    background: #fafbfc;
}

.edit-medicine-top {
    display: flex;
    align-items: center;
    justify-content: space-between;

    margin-bottom: 16px;
}

.edit-medicine-name {
    display: flex;
    align-items: center;
    gap: 10px;
}

.edit-medicine-name strong {
    display: block;

    color: #374151;

    font-size: 13px;
}

.edit-medicine-name span {
    display: block;

    margin-top: 3px;

    color: #9ca3af;

    font-size: 11px;
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


/* UPDATE FIELDS */

.edit-medicine-fields {
    display: grid;

    grid-template-columns:
        110px
        200px
        minmax(250px, 1fr)
        auto;

    align-items: end;

    gap: 13px;
}

.edit-item-action {
    display: flex;
    align-items: flex-end;
}


/* REMOVE */

.remove-medicine {
    width: 29px;
    height: 29px;

    display: flex;
    align-items: center;
    justify-content: center;

    border: 1px solid #fee2e2;
    border-radius: 7px;

    background: #fff;
    color: #ef4444;

    font-size: 18px;
    line-height: 1;

    cursor: pointer;

    transition: .15s ease;
}

.remove-medicine:hover {
    border-color: #fecaca;
    background: #fef2f2;
}


/* READONLY */

.edit-medicine-readonly {
    display: grid;

    grid-template-columns:
        110px
        200px
        1fr;

    gap: 15px;
}

.edit-medicine-readonly div {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.edit-medicine-readonly span {
    color: #9ca3af;

    font-size: 9px;
    font-weight: 700;
    text-transform: uppercase;
}

.edit-medicine-readonly strong {
    color: #4b5563;

    font-size: 12px;
}


/* BOTTOM */

.prescription-bottom-actions {
    display: flex;
    justify-content: flex-end;

    margin-top: 5px;
    margin-bottom: 25px;
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



/* RESPONSIVE */

@media (max-width: 1000px) {

    .prescription-info-card {
        grid-template-columns: 1fr 1fr;
    }

    .add-medicine-grid {
        grid-template-columns:
            1fr
            110px;
    }

    .edit-medicine-fields {
        grid-template-columns:
            110px
            1fr;
    }

    .edit-item-action {
        grid-column: 2;
    }

    .edit-medicine-readonly {
        grid-template-columns:
            1fr 1fr;
    }
}


@media (max-width: 650px) {

    .prescription-info-card {
        grid-template-columns: 1fr;
    }

    .page-header {
            align-items: flex-start;

            flex-direction: column;
        }
    .header-actions {
            width: 100%;
        }


        .header-actions .btn {
            flex: 1;
        }

    .add-medicine-grid {
        grid-template-columns: 1fr;
    }

    .edit-medicine-fields {
        grid-template-columns: 1fr;
    }

    .edit-item-action {
        grid-column: auto;
    }

    .edit-medicine-readonly {
        grid-template-columns: 1fr;
    }

    .prescription-header {
        align-items: flex-start;
        flex-direction: column;
        gap: 10px;
    }
}
</style>

<div class="prescription-edit-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div>
            <h1>Edit Prescription</h1>

            <p>
                Prescription #{{ $prescription->id }}
            </p>
        </div>

        <div class="header-actions">

            <a
                href="{{ route(
                    'prescriptions.show',
                    ['prescription' => $prescription->id]
                ) }}"
                class="prescription-btn prescription-btn-secondary"
            >
                ← Back
            </a>

        </div>

    </div>


    {{-- PATIENT / DOCTOR INFO --}}
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
                            ?? 'No phone number' }}
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


    {{-- NOTE --}}
    @if(auth()->user()->hasPermission('PRESCRIPTIONS.UPDATE'))

        <div class="card">

            <div class="card-header prescription-header">

                <div>
                    <h2>Prescription Note</h2>

                    <p>
                        Update the note of this prescription.
                    </p>
                </div>

            </div>

            <div class="card-body">

                <form
                    method="POST"
                    action="{{ route(
                        'prescriptions.update',
                        ['prescription' => $prescription->id]
                    ) }}"
                >

                    @csrf
                    @method('PUT')

                    <textarea
                        name="note"
                        rows="4"
                        class="form-input prescription-note"
                        placeholder="Enter prescription note..."
                    >{{ old('note', $prescription->note) }}</textarea>

                    @error('note')
                        <div class="field-error">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="form-actions-right">

                        <button
                            type="submit"
                            class="prescription-btn prescription-btn-primary"
                        >
                            Save Note
                        </button>

                    </div>

                </form>

            </div>

        </div>

    @endif


    {{-- ADD MEDICINE --}}
    @if(auth()->user()->hasPermission('PRESCRIPTIONS.ADDITEM'))

        <div class="card">

            <div class="card-header prescription-header">

                <div>
                    <h2>Add Medicine</h2>

                    <p>
                        Add a new medicine to this prescription.
                    </p>
                </div>

            </div>

            <div class="card-body">

                <form
                    method="POST"
                    action="{{ route(
                        'prescriptions.items.store',
                        ['prescription' => $prescription->id]
                    ) }}"
                >

                    @csrf

                    <div class="add-medicine-grid">

                        {{-- MEDICINE --}}
                        <div class="form-group">

                            <label class="form-label">
                                Medicine
                            </label>

                            <select
                                name="medicine_id"
                                class="form-input"
                                required
                            >

                                <option value="">
                                    Select medicine
                                </option>

                                @foreach($medicines as $medicine)

                                    <option
                                        value="{{ $medicine->id }}"
                                    >
                                        {{ $medicine->name }}
                                        ({{ $medicine->unit }})
                                        - Stock:
                                        {{ $medicine->stock }}
                                    </option>

                                @endforeach

                            </select>

                            @error('medicine_id')
                                <div class="field-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- QUANTITY --}}
                        <div class="form-group">

                            <label class="form-label">
                                Quantity
                            </label>

                            <input
                                type="number"
                                name="quantity"
                                min="1"
                                class="form-input"
                                required
                            >

                            @error('quantity')
                                <div class="field-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- DOUSAGE --}}
                        <div class="form-group">

                            <label class="form-label">
                                Dousage
                            </label>

                            <input
                                type="text"
                                name="dousage"
                                class="form-input"
                                placeholder="e.g. 1 tablet"
                                required
                            >

                            @error('dousage')
                                <div class="field-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- USAGE --}}
                        <div class="form-group">

                            <label class="form-label">
                                Usage Instruction
                            </label>

                            <input
                                type="text"
                                name="usage_instruction"
                                class="form-input"
                                placeholder="e.g. After meals, twice daily"
                                required
                            >

                            @error('usage_instruction')
                                <div class="field-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    <div class="form-actions-right">

                        <button
                            type="submit"
                            class="prescription-btn prescription-btn-primary"
                        >
                            + Add Medicine
                        </button>

                    </div>

                </form>

            </div>

        </div>

    @endif


    {{-- CURRENT MEDICINES --}}
    <div class="card">

        <div class="card-header prescription-header">

            <div>

                <h2>
                    Prescribed Medicines
                </h2>

                <p>
                    Update quantity, dosage or remove medicines.
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

                <div class="edit-medicine-list">

                    @foreach($prescription->items as $item)

                        <div class="edit-medicine-item">

                            <div class="edit-medicine-top">

                                <div class="edit-medicine-name">

                                    <div class="medicine-number">
                                        {{ $loop->iteration }}
                                    </div>

                                    <div>

                                        <strong>
                                            {{ $item->medicine->name }}
                                        </strong>

                                        <span>
                                            {{ $item->medicine->unit }}
                                        </span>

                                    </div>

                                </div>


                                @if(
                                    auth()->user()->hasPermission(
                                        'PRESCRIPTIONS.REMOVEITEM'
                                    )
                                )

                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'prescriptions.items.destroy',
                                            [
                                                'prescription' =>
                                                    $prescription->id,
                                                'item' =>
                                                    $item->id
                                            ]
                                        ) }}"
                                        onsubmit="return confirm(
                                            'Remove this medicine from the prescription?'
                                        )"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="remove-medicine"
                                        >
                                            ×
                                        </button>

                                    </form>

                                @endif

                            </div>


                            {{-- UPDATE ITEM --}}
                            @if(
                                auth()->user()->hasPermission(
                                    'PRESCRIPTIONS.UPDATEITEM'
                                )
                            )

                                <form
                                    method="POST"
                                    action="{{ route(
                                        'prescriptions.items.update',
                                        [
                                            'prescription' =>
                                                $prescription->id,
                                            'item' =>
                                                $item->id
                                        ]
                                    ) }}"
                                >

                                    @csrf
                                    @method('PUT')

                                    <div class="edit-medicine-fields">

                                        {{-- QUANTITY --}}
                                        <div class="form-group">

                                            <label class="form-label">
                                                Quantity
                                            </label>

                                            <input
                                                type="number"
                                                name="quantity"
                                                min="1"
                                                value="{{ old(
                                                    'quantity',
                                                    $item->quantity
                                                ) }}"
                                                class="form-input"
                                                required
                                            >

                                        </div>


                                        {{-- DOUSAGE --}}
                                        <div class="form-group">

                                            <label class="form-label">
                                                Dousage
                                            </label>

                                            <input
                                                type="text"
                                                name="dousage"
                                                value="{{ old(
                                                    'dousage',
                                                    $item->dousage
                                                ) }}"
                                                class="form-input"
                                                required
                                            >

                                        </div>


                                        {{-- USAGE --}}
                                        <div class="form-group">

                                            <label class="form-label">
                                                Usage Instruction
                                            </label>

                                            <input
                                                type="text"
                                                name="usage_instruction"
                                                value="{{ old(
                                                    'usage_instruction',
                                                    $item->usage_instruction
                                                ) }}"
                                                class="form-input"
                                                required
                                            >

                                        </div>


                                        <div class="edit-item-action">

                                            <button
                                                type="submit"
                                                class="prescription-btn prescription-btn-primary"
                                            >
                                                Save
                                            </button>

                                        </div>

                                    </div>

                                </form>

                            @else

                                <div class="edit-medicine-readonly">

                                    <div>
                                        <span>Quantity</span>
                                        <strong>
                                            {{ $item->quantity }}
                                        </strong>
                                    </div>

                                    <div>
                                        <span>Dousage</span>
                                        <strong>
                                            {{ $item->dousage }}
                                        </strong>
                                    </div>

                                    <div>
                                        <span>Usage</span>
                                        <strong>
                                            {{ $item->usage_instruction }}
                                        </strong>
                                    </div>

                                </div>

                            @endif

                        </div>

                    @endforeach

                </div>

            @else

                <div class="medical-placeholder">

                    <div class="medical-placeholder-icon">
                        ♡
                    </div>

                    <div>
                        No medicines have been added.
                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- BOTTOM ACTION --}}
    <div class="prescription-bottom-actions">

        <a
            href="{{ route(
                'prescriptions.show',
                ['prescription' => $prescription->id]
            ) }}"
            class="prescription-btn prescription-btn-secondary"
        >
            View Prescription
        </a>

    </div>

</div>

@endsection