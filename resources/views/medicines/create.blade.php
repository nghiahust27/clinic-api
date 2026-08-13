
@extends('layouts.app')

@section('title', 'Add Medicine')
@section('page-title', 'Add Medicine')

@section('content')

<style>

    .medicine-form-page {
        max-width: 900px;
    }

    /* ================= HEADER ================= */

    .form-header {
        display: flex;
        align-items: center;
        justify-content: space-between;

        margin-bottom: 25px;
    }

    .form-header h1 {
        font-size: 27px;
        color: #111827;
        margin-bottom: 6px;
    }

    .form-description {
        color: #64748b;
        font-size: 14px;
    }

    .back-btn {
        height: 42px;

        padding: 0 16px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border: 1px solid #cbdede;
        border-radius: 8px;

        background: white;
        color: #64748b;

        text-decoration: none;

        font-size: 14px;
        font-weight: 600;

        transition: 0.2s;
    }

    .back-btn:hover {
        background: #f8ffff;
        color: #374151;
    }


    /* ================= CARD ================= */

    .form-card {
        background: white;

        border: 1px solid #dceeee;

        border-radius: 12px;

        box-shadow:
            0 5px 20px rgba(0, 100, 100, 0.06);

        overflow: hidden;
    }


    .form-section {
        padding: 25px;
    }


    .form-section + .form-section {
        border-top: 1px solid #edf4f4;
    }


    .section-title {
        color: #374151;

        font-size: 16px;
        font-weight: 600;

        margin-bottom: 5px;
    }


    .section-description {
        color: #94a3b8;

        font-size: 13px;

        margin-bottom: 22px;
    }


    /* ================= FORM ================= */

    .form-grid {
        display: grid;

        grid-template-columns: 1fr 1fr;

        gap: 20px;
    }


    .form-group {
        display: flex;

        flex-direction: column;
    }


    .form-group.full-width {
        grid-column: 1 / -1;
    }


    .form-label {
        color: #374151;

        font-size: 13px;

        font-weight: 600;

        margin-bottom: 8px;
    }


    .required {
        color: #ef4444;
    }


    .form-input,
    .form-select,
    .form-textarea {

        width: 100%;

        border: 1px solid #cbdede;

        border-radius: 8px;

        background: white;

        color: #1f2937;

        font-size: 14px;

        outline: none;

        transition: 0.2s;
    }


    .form-input,
    .form-select {

        height: 44px;

        padding: 0 13px;
    }


    .form-textarea {

        min-height: 100px;

        padding: 12px 13px;

        resize: vertical;

        font-family: inherit;
    }


    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {

        border-color: #15b5bc;

        box-shadow:
            0 0 0 3px rgba(21, 181, 188, 0.1);
    }


    .form-input:disabled {

        background: #f8fafc;

        color: #94a3b8;

        cursor: not-allowed;
    }


    .field-error {

        color: #dc2626;

        font-size: 12px;

        margin-top: 6px;
    }


    .is-invalid {

        border-color: #ef4444;
    }


    /* ================= CODE ================= */

    .code-note {

        color: #94a3b8;

        font-size: 12px;

        margin-top: 6px;
    }


    /* ================= FOOTER ================= */

    .form-footer {

        display: flex;

        align-items: center;

        justify-content: flex-end;

        gap: 10px;

        padding: 20px 25px;

        background: #fbfefe;

        border-top: 1px solid #edf4f4;
    }


    .cancel-btn {

        height: 42px;

        padding: 0 18px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        border-radius: 8px;

        border: 1px solid #cbdede;

        background: white;

        color: #64748b;

        text-decoration: none;

        font-size: 14px;

        font-weight: 600;
    }


    .cancel-btn:hover {

        background: #f8fafc;

        color: #374151;
    }
     

    .save-btn {

        height: 42px;

        padding: 0 20px;

        border: none;

        border-radius: 8px;

        background: #13adb5;

        color: white;

        font-size: 14px;

        font-weight: 600;

        cursor: pointer;

        transition: 0.2s;
    }


    .save-btn:hover {

        background: #0d969d;
    }


    /* ================= ALERT ================= */

    .error-alert {

        margin-bottom: 20px;

        padding: 14px 16px;

        border-radius: 8px;

        background: #fef2f2;

        border: 1px solid #fecaca;

        color: #b91c1c;

        font-size: 13px;
    }


    /* ================= RESPONSIVE ================= */

    @media (max-width: 700px) {

        .form-header {

            flex-direction: column;

            align-items: flex-start;

            gap: 15px;
        }


        .form-grid {

            grid-template-columns: 1fr;
        }


        .form-group.full-width {

            grid-column: auto;
        }


        .form-footer {

            flex-direction: column-reverse;

            align-items: stretch;
        }


        .cancel-btn,
        .save-btn {

            width: 100%;
        }

    }

</style>


<div class="                    Basic information about the medicine.
-form-page">


    <!-- ================= HEADER ================= -->

    <div class="form-header">
        <div>

            <h1>
                Add Medicine
            </h1>
        </div>
    </div>



    <!-- ================= VALIDATION ERROR ================= -->

    @if($errors->any())

        <div class="error-alert">

            <strong>
                Please fix the following errors:
            </strong>

            <ul style="margin: 8px 0 0 18px;">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif



    <!-- ================= FORM ================= -->

    <form
        method="POST"
        action="{{ route('medicines.store') }}"
    >

        @csrf


        <div class="form-card">


            <!-- ================= PERSONAL INFORMATION ================= -->

            <div class="form-section">

                <div class="section-title">
                    Medicine Information
                </div>

                <div class="section-description">
                    Basic information about the medicine.
                </div>


                <div class="form-grid">

                    <!-- Full Name -->

                    <div class="form-group">

                        <label
                            for="full_name"
                            class="form-label"
                        >
                            Name
                            <span class="required">*</span>
                        </label>


                        <input
                            id="name"
                            type="text"
                            name="name"
                            class="form-input @error('name') is-invalid @enderror"
                            placeholder="Enter medicine's name"
                            required
                        >


                        @error('name')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>



                    <!-- Unit -->

                    <div class="form-group">

                        <label
                            for="Unit"
                            class="form-label"
                        >
                            Unit
                            <span class="required">*</span>
                        </label>


                        <select
                            id="unit"
                            name="unit"
                            class="form-select @error('unit') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                Select unit
                            </option>

                            <option
                                value="tablet"
                            >
                                Tablet
                            </option>

                            <option
                                value="capsule"
                                
                            >
                                Capsule
                            </option>

                            <option
                                value="box"
                                
                            >
                                Box
                            </option>

                            <option
                                value="bottle"
                                
                            >
                                Bottle
                            </option>

                            <option
                                value="tube"
                                
                            >
                                Tube
                            </option>

                            <option
                                value="vial"
                                
                            >
                                Vial
                            </option>

                            <option
                                value="sachet"
                                
                            >
                                Sachet
                            </option>

                            <option
                                value="strip"
                                
                            >
                                Strip
                            </option>

                            <option
                                value="other"
                                
                            >
                                Other
                            </option>

                        </select>


                        @error('gender')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>



                    <!-- Price-->

                    <div class="form-group">

                        <label
                            for="price"
                            class="form-label"
                        >
                            Phone
                            <span class="required">*</span>
                        </label>


                        <input
                            id="price"
                            type="numeric"
                            name="price"

                            class="form-input @error('price') is-invalid @enderror"
                            placeholder="Enter price"
                            required
                        >


                        @error('price')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                </div>

            </div>


            <!-- ================= CONTACT INFORMATION ================= -->

            <div class="form-section">


                <div class="form-grid">


                    <!-- Code -->

                    <div class="form-group">

                        <label
                            for="code"
                            class="form-label"
                        >
                            Medicine Code
                            <span class="required">*</span>
                        </label>


                        <input
                            id="code"
                            type="string"
                            name="code"

                            class="form-input @error('code') is-invalid @enderror"
                            placeholder="Enter code number"
                            required
                        >


                        @error('code')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>



                </div>

            </div>



            <!-- ================= FOOTER ================= -->

            <div class="form-footer">
                <a
                    href="{{ route('medicines.index') }}"
                    class="cancel-btn"
                >
                    Cancel
                </a>

                @if(
                    auth()->user()->hasPermission(
                        'PATIENTS.CREATE'
                    )
                )
                    <button
                        type="submit"
                        class="save-btn"
                    >
                        Save Changes
                    </button>

                @endif


            </div>


        </div>

    </form>


</div>

@endsection

