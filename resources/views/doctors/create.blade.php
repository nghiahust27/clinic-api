
@extends('layouts.app')

@section('title', 'Create Doctor')
@section('page-title', 'Create Doctor')

@section('content')

<style>

    .doctor-form-page {
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

        min-height: 120px;

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


    .field-error {

        color: #dc2626;

        font-size: 12px;

        margin-top: 6px;
    }


    .is-invalid {
        border-color: #ef4444;
    }


    .field-note {

        color: #94a3b8;

        font-size: 12px;

        margin-top: 6px;
    }


    /* ================= USER OPTION ================= */

    .user-select-info {

        margin-top: 8px;

        padding: 10px 12px;

        border-radius: 7px;

        background: #effafa;

        color: #0d8f97;

        font-size: 12px;
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


<div class="doctor-form-page">


    <!-- ================= HEADER ================= -->

    <div class="form-header">

        <div>

            <h1>
                Create Doctor
            </h1>

            <div class="form-description">
                Create a doctor profile for an existing DOCTOR user.
            </div>

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
        action="{{ route('doctors.store') }}"
    >

        @csrf


        <div class="form-card">


            <!-- ================= DOCTOR ACCOUNT ================= -->

            <div class="form-section">

                <div class="section-title">
                    Doctor Account
                </div>

                <div class="section-description">
                    Select an existing user whose role is DOCTOR.
                </div>


                <div class="form-grid">


                    <!-- User -->

                    <div class="form-group">

                        <label
                            for="user_id"
                            class="form-label"
                        >
                            Doctor User
                            <span class="required">*</span>
                        </label>


                        <select
                            id="user_id"
                            name="user_id"
                            class="form-select @error('user_id') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                Select a doctor user
                            </option>


                            @foreach($users as $user)

                                <option
                                    value="{{ $user->id }}"
                                    {{ old('user_id') == $user->id
                                        ? 'selected'
                                        : ''
                                    }}
                                >

                                    {{ $user->name }}
                                    -
                                    {{ $user->email }}

                                </option>

                            @endforeach

                        </select>


                        <div class="user-select-info">
                            Only users with the DOCTOR role are available.
                        </div>


                        @error('user_id')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>



                    <!-- Specialty -->

                    <div class="form-group">

                        <label
                            for="specialty_id"
                            class="form-label"
                        >
                            Specialty
                            <span class="required">*</span>
                        </label>


                        <select
                            id="specialty_id"
                            name="specialty_id"
                            class="form-select @error('specialty_id') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                Select specialty
                            </option>


                            @foreach($specialties as $specialty)

                                <option
                                    value="{{ $specialty->id }}"
                                    {{ old('specialty_id') == $specialty->id
                                        ? 'selected'
                                        : ''
                                    }}
                                >

                                    {{ $specialty->name }}

                                </option>

                            @endforeach

                        </select>


                        @error('specialty_id')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                </div>

            </div>



            <!-- ================= PROFESSIONAL INFORMATION ================= -->

            <div class="form-section">

                <div class="section-title">
                    Professional Information
                </div>

                <div class="section-description">
                    Enter the doctor's professional credentials and profile.
                </div>


                <div class="form-grid">


                    <!-- License Number -->

                    <div class="form-group full-width">

                        <label
                            for="license_number"
                            class="form-label"
                        >
                            License Number
                            <span class="required">*</span>
                        </label>


                        <input
                            id="license_number"
                            type="text"
                            name="license_number"
                            value="{{ old('license_number') }}"
                            class="form-input @error('license_number') is-invalid @enderror"
                            placeholder="Enter medical license number"
                            required
                        >


                        @error('license_number')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>



                    <!-- Bio -->

                    <div class="form-group full-width">

                        <label
                            for="bio"
                            class="form-label"
                        >
                            Biography
                        </label>


                        <textarea
                            id="bio"
                            name="bio"
                            class="form-textarea @error('bio') is-invalid @enderror"
                            placeholder="Enter doctor's biography, experience, qualifications..."
                        >{{ old('bio') }}</textarea>


                        @error('bio')

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
                    href="{{ route('doctors.index') }}"
                    class="cancel-btn"
                >
                    Cancel
                </a>


                @if(
                    auth()->user()->hasPermission(
                        'DOCTORS.CREATE'
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
