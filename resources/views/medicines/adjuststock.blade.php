
@extends('layouts.app')

@section('title', 'Adjust Stock')
@section('page-title', 'Adjust Stock')

@section('content')

<style>

.adjust-stock-page {
    max-width: 900px;
    margin: 0 auto;
}


/* PAGE HEADER */

.adjust-stock-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
}

.adjust-stock-header-content h1 {
    margin: 0;
    font-size: 26px;
    font-weight: 700;
    color: #1f2937;
}

.adjust-stock-header-content p {
    margin: 6px 0 0;
    color: #6b7280;
    font-size: 14px;
}


/* MAIN CARD */

.adjust-stock-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    overflow: hidden;
}


/* CARD HEADER */

.adjust-stock-card-header {
    padding: 22px 24px;
    border-bottom: 1px solid #eef0f2;
}

.adjust-stock-card-header h2 {
    margin: 0;
    font-size: 18px;
    font-weight: 650;
    color: #1f2937;
}

.adjust-stock-card-header p {
    margin: 5px 0 0;
    font-size: 13px;
    color: #6b7280;
}


/* CARD BODY */

.adjust-stock-card-body {
    padding: 24px;
}


/* MEDICINE SUMMARY */

.medicine-summary {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 28px;
}

.medicine-summary-item {
    padding: 16px 18px;
    background: #f8fafc;
    border: 1px solid #e8edf2;
    border-radius: 10px;
}

.medicine-summary-label {
    display: block;
    margin-bottom: 7px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: #8a94a3;
}

.medicine-summary-value {
    display: block;
    font-size: 16px;
    font-weight: 600;
    color: #273444;
}

.medicine-summary-value.stock {
    font-size: 20px;
    color: #2563eb;
}


/* FORM */

.adjust-stock-form {
    margin-top: 4px;
}

.form-group {
    margin-bottom: 22px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-size: 13px;
    font-weight: 600;
    color: #374151;
}

.form-input {
    width: 100%;
    min-height: 44px;
    padding: 10px 13px;
    box-sizing: border-box;

    border: 1px solid #d9dee5;
    border-radius: 8px;

    background: #ffffff;
    color: #1f2937;

    font-size: 14px;

    outline: none;

    transition:
        border-color 0.15s ease,
        box-shadow 0.15s ease;
}

.form-input:hover {
    border-color: #b9c1cc;
}

.form-input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.10);
}

.form-input::placeholder {
    color: #a1a9b4;
}


/* HELP TEXT */

.form-help {
    margin-top: 7px;
    font-size: 12px;
    line-height: 1.5;
    color: #8a94a3;
}


/* VALIDATION */

.form-input.is-invalid {
    border-color: #ef4444;
}

.field-error {
    margin-top: 6px;
    font-size: 12px;
    color: #dc2626;
}


/* ACTIONS */

.adjust-stock-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;

    margin-top: 28px;
    padding-top: 20px;

    border-top: 1px solid #eef0f2;
}


/* BUTTONS */

.adjust-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    min-height: 40px;
    padding: 0 17px;

    border-radius: 8px;
    border: none;

    font-size: 13px;
    font-weight: 600;

    text-decoration: none;
    cursor: pointer;

    transition:
        background 0.15s ease,
        border-color 0.15s ease,
        transform 0.1s ease;
}

.adjust-btn:active {
    transform: translateY(1px);
}


/* CANCEL */

.adjust-btn-secondary {
    background: #ffffff;
    border: 1px solid #dfe3e8;
    color: #4b5563;
}

.adjust-btn-secondary:hover {
    background: #f8fafc;
    border-color: #cfd5dc;
}


/* SUBMIT */

.adjust-btn-primary {
    background: #2563eb;
    color: #ffffff;
}

.adjust-btn-primary:hover {
    background: #1d4ed8;
}


/* RESPONSIVE */

@media (max-width: 700px) {

    .adjust-stock-page {
        width: 100%;
    }

    .adjust-stock-header {
        align-items: flex-start;
        flex-direction: column;
        gap: 14px;
    }

    .medicine-summary {
        grid-template-columns: 1fr;
    }

    .adjust-stock-card-body {
        padding: 18px;
    }

    .adjust-stock-actions {
        flex-direction: column-reverse;
    }

    .adjust-btn {
        width: 100%;
    }

}
</style>

<div class="adjust-stock-page">

    {{-- HEADER --}}

    <div class="adjust-stock-header">

        <div class="adjust-stock-header-content">

            <h1>
                Adjust Stock
            </h1>

            <p>
                Update the inventory quantity for this medicine.
            </p>

        </div>

    </div>


    {{-- CARD --}}

    <div class="adjust-stock-card">

        <div class="adjust-stock-card-header">

            <h2>
                {{ $medicine->name }}
            </h2>

            <p>
                Medicine inventory
            </p>

        </div>


        <div class="adjust-stock-card-body">

            {{-- MEDICINE INFO --}}

            <div class="medicine-summary">

                <div class="medicine-summary-item">

                    <span class="medicine-summary-label">
                        Medicine Code
                    </span>

                    <span class="medicine-summary-value">
                        {{ $medicine->code }}
                    </span>

                </div>


                <div class="medicine-summary-item">

                    <span class="medicine-summary-label">
                        Current Stock
                    </span>

                    <span class="medicine-summary-value stock">
                        @if($medicine ->stock > 1)
                            {{ $medicine->stock }}
                            {{ $medicine->unit }}s
                        @else
                            {{ $medicine->stock }}
                            {{ $medicine->unit }}
                        @endif
                    </span>

                </div>

            </div>


            {{-- FORM --}}

            <form
                method="POST"
                action="{{ route(
                    'medicines.adjust-stock',
                    $medicine
                ) }}"
                class="adjust-stock-form"
            >

                @csrf
                @method('PATCH')


                <div class="form-group">

                    <label
                        for="quantity"
                        class="form-label"
                    >
                        Quantity Adjustment
                    </label>

                    <input
                        id="quantity"
                        type="number"
                        name="quantity"
                        value="{{ old('quantity') }}"
                        class="form-input @error('quantity') is-invalid @enderror"
                        placeholder="e.g. 10 or -5"
                        required
                    >

                    <div class="form-help">
                        Positive values add stock.
                        Negative values remove stock.
                    </div>

                    @error('quantity')

                        <div class="field-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- ACTIONS --}}

                <div class="adjust-stock-actions">

                    <a
                        href="{{ route(
                            'medicines.index'
                        ) }}"
                        class="adjust-btn adjust-btn-secondary"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="adjust-btn adjust-btn-primary"
                    >
                        Update Stock
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
