@extends('layouts.app')


@section('title', 'Create Appointment')

@section('page-title', 'Create Appointment')


@section('content')
<style>

.appointment-container {
    max-width: 900px;
    margin: 0 auto;
}


.appointment-header {
    display: flex;
    justify-content: space-between;
    align-items: center;

    margin-bottom: 25px;
}


.appointment-header h1 {
    margin: 0;

    font-size: 28px;
    color: #1f2937;
}


.appointment-header p {
    margin-top: 6px;

    color: #64748b;
}


.appointment-card {
    background: white;

    border: 1px solid #dbe7e7;

    border-radius: 14px;

    padding: 30px;

    box-shadow:
        0 6px 20px rgba(
            15,
            118,
            110,
            0.06
        );
}


.form-group {
    margin-bottom: 24px;
}


.form-label {
    display: block;

    margin-bottom: 8px;

    font-size: 14px;

    font-weight: 600;

    color: #374151;
}


.form-input {
    width: 100%;

    padding: 12px 14px;

    border: 1px solid #cbd5e1;

    border-radius: 8px;

    background: white;

    color: #1f2937;

    font-size: 14px;

    box-sizing: border-box;
}


.form-input:focus {
    outline: none;

    border-color: #14b8a6;

    box-shadow:
        0 0 0 3px
        rgba(
            20,
            184,
            166,
            0.12
        );
}


.patient-box {
    display: flex;

    align-items: center;

    gap: 14px;

    padding: 16px;

    background: #f0fdfa;

    border: 1px solid #ccfbf1;

    border-radius: 10px;
}


.patient-avatar {
    width: 48px;
    height: 48px;

    flex-shrink: 0;

    border-radius: 50%;

    background: #14b8a6;

    color: white;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 20px;

    font-weight: 700;
}


.patient-name {
    font-size: 16px;

    font-weight: 700;

    color: #1f2937;
}


.patient-meta {
    margin-top: 5px;

    font-size: 13px;

    color: #64748b;
}


.error {
    margin-top: 6px;

    color: #dc2626;

    font-size: 13px;
}


.is-invalid {
    border-color: #dc2626;
}


.form-actions {
    display: flex;

    justify-content: flex-end;

    gap: 12px;

    margin-top: 30px;

    padding-top: 22px;

    border-top: 1px solid #e5e7eb;
}


.btn {
    display: inline-flex;

    align-items: center;

    justify-content: center;

    min-height: 44px;

    padding: 0 20px;

    border-radius: 8px;

    text-decoration: none;

    font-size: 14px;

    font-weight: 600;

    cursor: pointer;
}


.btn-primary {
    border: 1px solid #14b8a6;

    background: #14b8a6;

    color: white;
}


.btn-primary:hover {
    background: #0f9f91;
}


.btn-secondary {
    border: 1px solid #cbd5e1;

    background: white;

    color: #475569;
}


.btn-secondary:hover {
    background: #f8fafc;
}


@media (max-width: 768px) {

    .appointment-header {
        flex-direction: column;

        align-items: flex-start;

        gap: 15px;
    }


    .appointment-card {
        padding: 20px;
    }


    .form-actions {
        flex-direction: column-reverse;
    }


    .form-actions .btn {
        width: 100%;
    }

}

</style>

<div class="appointment-container">


    {{-- HEADER --}}

    <div class="appointment-header">

        <div>

            <h1>
                Create Appointment
            </h1>

            <p>
                Schedule an appointment for this patient.
            </p>

        </div>


    </div>



    {{-- FORM --}}

    <div class="appointment-card">

       <form
            method="POST"
            action="{{ route('patients.create-appointment', [
                'patient' => $patient->id
            ]) }}"
        >
            @csrf

            {{-- PATIENT --}}

            <div class="form-group">

                <label class="form-label">
                    Patient
                </label>


                <div class="patient-box">

                    <div class="patient-avatar">

                        {{ strtoupper(
                            substr(
                                $patient->full_name,
                                0,
                                1
                            )
                        ) }}

                    </div>


                    <div>

                        <div class="patient-name">
                            {{ $patient->full_name }}
                        </div>


                        <div class="patient-meta">

                            Patient Code:
                            {{ $patient->code }}

                            @if($patient->phone)

                                · {{ $patient->phone }}

                            @endif

                        </div>

                    </div>

                </div>

            </div>



            {{-- DOCTOR --}}

            <div class="form-group">

                <label
                    for="doctor_id"
                    class="form-label"
                >
                    Doctor
                </label>


                <select
                    id="doctor_id"
                    name="doctor_id"
                    class="form-input @error('doctor_id') is-invalid @enderror"
                    required
                >

                    <option value="">
                        Select doctor
                    </option>


                    @foreach($doctors as $doctor)

                        <option
                            value="{{ $doctor->id }}"
                            @selected(
                                old('doctor_id')
                                == $doctor->id
                            )
                        >

                            Dr.
                            {{ $doctor->user->name }}

                            @if($doctor->specialty)

                                -
                                {{ $doctor->specialty->name }}

                            @endif

                        </option>

                    @endforeach

                </select>


                @error('doctor_id')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>



            {{-- DATE TIME --}}

            <div class="form-group">

                <label
                    for="scheduled_at"
                    class="form-label"
                >
                    Appointment Date & Time
                </label>


                <input
                    id="scheduled_at"
                    type="datetime-local"
                    name="scheduled_at"
                    value="{{ old('scheduled_at') }}"
                    class="form-input @error('scheduled_at') is-invalid @enderror"
                    required
                >


                @error('scheduled_at')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>



            {{-- REASON --}}

            <div class="form-group">

                <label
                    for="reason"
                    class="form-label"
                >
                    Reason
                </label>


                <textarea
                    id="reason"
                    name="reason"
                    rows="5"
                    class="form-input"
                    placeholder="Enter appointment reason..."
                >{{ old('reason') }}</textarea>


                @error('reason')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>



            {{-- BUTTONS --}}

            <div class="form-actions">

                <a
                    href="{{ route(
                        'patients.show',
                        ['patient' => $patient->id]
                    ) }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Create Appointment
                </button>

            </div>


        </form>

    </div>

</div>




@endsection