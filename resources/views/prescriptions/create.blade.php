@extends('layouts.app')

@section('title', 'Create Prescription')

@section('content')

<style> 
    /* =========================================
   PRESCRIPTION CREATE
========================================= */

.prescription-create-page {
    max-width: 1150px;
    margin: 0 auto;
}


/* HEADER */

.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 22px;
}

.page-header h1 {
    margin: 0;

    color: #1f2937;
    font-size: 26px;
    font-weight: 700;
}

.page-header p {
    margin: 6px 0 0;

    color: #9ca3af;
    font-size: 13px;
}


/* PATIENT / DOCTOR INFO */

.prescription-info-card {
    display: grid;
    grid-template-columns: 1fr 1fr 220px;
    gap: 20px;

    padding: 21px 22px;
    margin-bottom: 20px;

    border: 1px solid #e5e7eb;
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


/* CARD */

.prescription-card {
    margin-bottom: 20px;
}


/* HEADER */

.prescription-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.prescription-header h2 {
    margin: 0;
}

.prescription-header p,
.card-header p {
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

.medicine-item {
    padding: 17px;

    border: 1px solid #e5e7eb;
    border-radius: 10px;

    background: #fafbfc;
}

.medicine-item + .medicine-item {
    margin-top: 13px;
}

.medicine-item-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    margin-bottom: 15px;
}

.medicine-item-title {
    display: flex;
    align-items: center;
    gap: 9px;

    color: #4b5563;
    font-size: 13px;
    font-weight: 650;
}

.medicine-number {
    width: 27px;
    height: 27px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 7px;

    background: #eff6ff;
    color: #2563eb;

    font-size: 12px;
    font-weight: 700;
}


/* REMOVE */

.remove-medicine {
    width: 28px;
    height: 28px;

    border: 1px solid #fee2e2;
    border-radius: 7px;

    background: #fff;
    color: #ef4444;

    font-size: 18px;
    line-height: 1;

    cursor: pointer;
}

.remove-medicine:hover {
    background: #fef2f2;
    border-color: #fecaca;
}


/* FIELDS */

.medicine-fields {
    display: grid;

    grid-template-columns:
        minmax(230px, 1.5fr)
        100px
        170px
        minmax(220px, 1.4fr);

    gap: 13px;
}

.form-group {
    min-width: 0;
}

.form-label {
    display: block;

    margin-bottom: 6px;

    color: #374151;
    font-size: 11px;
    font-weight: 650;
}

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

.form-input::placeholder {
    color: #a1a9b4;
}


/* ADD MEDICINE */

.add-medicine-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    margin-top: 16px;
    padding: 9px 13px;

    border: 1px dashed #bfdbfe;
    border-radius: 8px;

    background: #f8fbff;
    color: #2563eb;

    font-size: 12px;
    font-weight: 650;

    cursor: pointer;
}

.add-medicine-btn:hover {
    border-color: #60a5fa;
    background: #eff6ff;
}

.add-medicine-btn span {
    font-size: 17px;
}


/* NOTE */

.prescription-note {
    min-height: 95px;

    resize: vertical;
}


/* ERROR */

.prescription-error {
    margin-bottom: 14px;
    padding: 10px 12px;

    border: 1px solid #fecaca;
    border-radius: 7px;

    background: #fef2f2;
    color: #b91c1c;

    font-size: 12px;
}

.field-error {
    margin-top: 5px;

    color: #dc2626;
    font-size: 11px;
}


/* ACTIONS */

.prescription-actions {
    display: flex;
    justify-content: flex-end;
    gap: 9px;

    margin-top: 20px;
    margin-bottom: 25px;
}

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


/* RESPONSIVE */

@media (max-width: 1000px) {

    .prescription-info-card {
        grid-template-columns: 1fr 1fr;
    }

    .medicine-fields {
        grid-template-columns: 1fr 110px;
    }

    .medicine-select,
    .instruction-field {
        grid-column: span 1;
    }
}


@media (max-width: 650px) {

    .prescription-info-card {
        grid-template-columns: 1fr;
    }

    .page-header {
        align-items: flex-start;
        gap: 15px;
    }

    .medicine-fields {
        grid-template-columns: 1fr;
    }

    .prescription-header {
        align-items: flex-start;
        flex-direction: column;
        gap: 10px;
    }

    .prescription-actions {
        flex-direction: column-reverse;
    }

    .prescription-btn {
        width: 100%;
    }

}
</style>

<div class="prescription-create-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div>
            <h1>Create Prescription</h1>
            <p>
                Create a prescription for this examination.
            </p>
        </div>

        <a
            href="{{ route('examinations.show', ['examination' => $examination->id]) }}"
            class="prescription-btn prescription-btn-secondary"
        >
            Cancel
        </a>

    </div>


    {{-- PATIENT / DOCTOR INFORMATION --}}
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
                            $examination->appointment->patient->full_name,
                            0,
                            1
                        )
                    ) }}
                </div>

                <div>

                    <div class="prescription-person-name">
                        {{ $examination->appointment->patient->full_name }}
                    </div>

                    <div class="prescription-person-meta">
                        {{ $examination->appointment->patient->phone
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
                            $examination->appointment->doctor->user->name,
                            0,
                            1
                        )
                    ) }}
                </div>

                <div>

                    <div class="prescription-person-name">
                        Dr.
                        {{ $examination->appointment->doctor->user->name }}
                    </div>

                    <div class="prescription-person-meta">
                        {{ $examination->appointment->doctor->specialty->name
                            ?? 'Doctor'
                        }}
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
                    #{{ $examination->id }}
                </strong>

                <span>
                    {{ $examination->examinated_at
                        ? \Carbon\Carbon::parse(
                            $examination->examinated_at
                        )->format('d M Y, H:i')
                        : 'N/A'
                    }}
                </span>

            </div>

        </div>

    </div>


    {{-- FORM --}}
    <form
        method="POST"
        action="{{ route('prescriptions.store') }}"
    >

        @csrf

        {{-- SERVICE CREATE() NEEDS THIS --}}
        <input
            type="hidden"
            name="examination_id"
            value="{{ $examination->id }}"
        >


        {{-- MEDICINES --}}
        <div class="card prescription-card">

            <div class="card-header prescription-header">

                <div>
                    <h2>Prescribed Medicines</h2>

                    <p>
                        Add the medicines prescribed for this patient.
                    </p>
                </div>

                <div class="medicine-count">
                    <span id="medicineCount">1</span>
                    medicine
                </div>

            </div>


            <div class="card-body">

                @error('item')
                    <div class="prescription-error">
                        {{ $message }}
                    </div>
                @enderror


                <div id="medicineList">

                    {{-- MEDICINE ITEM --}}

                    <div class="medicine-item">

                        <div class="medicine-item-header">

                            <div class="medicine-item-title">

                                <span class="medicine-number">
                                    1
                                </span>

                                <span>
                                    Medicine
                                </span>

                            </div>

                            <button
                                type="button"
                                class="remove-medicine"
                                onclick="removeMedicine(this)"
                                style="display: none;"
                            >
                                ×
                            </button>

                        </div>


                        <div class="medicine-fields">

                            {{-- MEDICINE --}}

                            <div class="form-group medicine-select">

                                <label class="form-label">
                                    Medicine
                                </label>

                                <select
                                    name="item[0][medicine_id]"
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
                                            {{ $medicine->name }} ({{ $medicine->unit }}) — Stock: {{ $medicine->stock }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('item.0.medicine_id')
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
                                    name="item[0][quantity]"
                                    min="1"
                                    class="form-input"
                                    placeholder="0"
                                    value="{{ old('item.0.quantity') }}"
                                    required
                                >

                                @error('item.0.quantity')
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
                                    name="item[0][dousage]"
                                    class="form-input"
                                    placeholder="e.g. 1 tablet"
                                    value="{{ old('item.0.dousage') }}"
                                    required
                                >

                                @error('item.0.dousage')
                                    <div class="field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- USAGE INSTRUCTION --}}

                            <div class="form-group instruction-field">

                                <label class="form-label">
                                    Usage Instruction
                                </label>

                                <input
                                    type="text"
                                    name="item[0][usage_instruction]"
                                    class="form-input"
                                    placeholder="e.g. After meals, twice daily"
                                    value="{{ old(
                                        'item.0.usage_instruction'
                                    ) }}"
                                    required
                                >

                                @error('item.0.usage_instruction')
                                    <div class="field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ADD MEDICINE --}}

                <button
                    type="button"
                    class="add-medicine-btn"
                    onclick="addMedicine()"
                >
                    <span>+</span>
                    Add Medicine
                </button>

            </div>

        </div>


        {{-- NOTE --}}
        <div class="card prescription-card prescription-note-card">

            <div class="card-header">

                <div>
                    <h2>Prescription Note</h2>

                    <p>
                        Optional note for this prescription.
                    </p>
                </div>

            </div>

            <div class="card-body">

                <textarea
                    name="note"
                    rows="4"
                    class="form-input prescription-note"
                    placeholder="Enter prescription note..."
                >{{ old('note') }}</textarea>

                @error('note')
                    <div class="field-error">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>


        {{-- ACTIONS --}}
        <div class="prescription-actions">

            <a
                href="{{ route(
                    'examinations.show',
                    $examination
                ) }}"
                class="prescription-btn prescription-btn-secondary"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="prescription-btn prescription-btn-primary"
            >
                Create Prescription
            </button>

        </div>

    </form>

</div>


<script>

let medicineIndex = 1;

function addMedicine()
{
    const list =
        document.getElementById('medicineList');

    const item =
        document.createElement('div');

    item.className = 'medicine-item';

    item.innerHTML = `

        <div class="medicine-item-header">

            <div class="medicine-item-title">

                <span class="medicine-number">
                    ${medicineIndex + 1}
                </span>

                <span>
                    Medicine
                </span>

            </div>

            <button
                type="button"
                class="remove-medicine"
                onclick="removeMedicine(this)"
            >
                ×
            </button>

        </div>


        <div class="medicine-fields">

            <div class="form-group medicine-select">

                <label class="form-label">
                    Medicine
                </label>

                <select
                    name="item[${medicineIndex}][medicine_id]"
                    class="form-input"
                    required
                >

                    <option value="">
                        Select medicine
                    </option>

                    @foreach($medicines as $medicine)

                        <option value="{{ $medicine->id }}">
                            {{ $medicine->name }}
                            ({{ $medicine->unit }})
                        </option>

                    @endforeach

                </select>

            </div>


            <div class="form-group">

                <label class="form-label">
                    Quantity
                </label>

                <input
                    type="number"
                    name="item[${medicineIndex}][quantity]"
                    min="1"
                    class="form-input"
                    placeholder="0"
                    required
                >

            </div>


            <div class="form-group">

                <label class="form-label">
                    Dousage
                </label>

                <input
                    type="text"
                    name="item[${medicineIndex}][dousage]"
                    class="form-input"
                    placeholder="e.g. 1 tablet"
                    required
                >

            </div>


            <div class="form-group instruction-field">

                <label class="form-label">
                    Usage Instruction
                </label>

                <input
                    type="text"
                    name="item[${medicineIndex}][usage_instruction]"
                    class="form-input"
                    placeholder="e.g. After meals, twice daily"
                    required
                >

            </div>

        </div>
    `;

    list.appendChild(item);

    medicineIndex++;

    updateMedicineNumbers();

    document.getElementById('medicineCount').innerText =
        list.children.length;
}


function removeMedicine(button)
{
    const item =
        button.closest('.medicine-item');

    item.remove();

    updateMedicineNumbers();

    document.getElementById('medicineCount').innerText =
        document.querySelectorAll('.medicine-item').length;
}


function updateMedicineNumbers()
{
    const items =
        document.querySelectorAll('.medicine-item');

    items.forEach((item, index) => {

        item.querySelector(
            '.medicine-number'
        ).innerText = index + 1;

    });
}

</script>

@endsection