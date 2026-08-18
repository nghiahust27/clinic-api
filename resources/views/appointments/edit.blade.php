@extends('layouts.app')


@section('title', 'Edit Appointment')
@section('page-title', 'Edit Appointment')


@section('content')

<style>
    
.page-container {
    max-width: 900px;
    margin: 0 auto;
}


.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}


.page-header h1 {
    margin: 0;
    font-size: 28px;
    color: #1f2937;
}


.page-header p {
    margin-top: 6px;
    color: #64748b;
}


.back-btn {
    text-decoration: none;
    color: #0f766e;
    font-weight: 600;
}


.patient-summary {
    display: flex;
    align-items: center;
    gap: 14px;

    padding: 18px;
    margin-bottom: 20px;

    background: #f0fdfa;
    border: 1px solid #ccfbf1;
    border-radius: 12px;
}


.summary-avatar {
    width: 48px;
    height: 48px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #0f766e;
    color: white;

    font-size: 18px;
    font-weight: 700;
}


.summary-label {
    font-size: 12px;
    color: #64748b;
}


.summary-name {
    margin-top: 3px;

    font-size: 16px;
    font-weight: 700;

    color: #1f2937;
}


.card {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    overflow: hidden;
    margin-bottom: 20px;
}


.card-header {
    padding: 20px;
    border-bottom: 1px solid #e2e8f0;
}


.card-header h2 {
    margin: 0;
    font-size: 18px;
}


.card-header p {
    margin: 5px 0 0;
    color: #64748b;
    font-size: 14px;
}


.card-body {
    padding: 25px;
}


.form-group {
    margin-bottom: 20px;
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

    font-size: 14px;

    outline: none;
}


.form-input:focus {
    border-color: #14b8a6;
    box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.12);
}


.field-error {
    margin-top: 6px;
    color: #dc2626;
    font-size: 13px;
}


.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;

    margin-top: 25px;
}


.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 11px 20px;

    border-radius: 8px;

    text-decoration: none;

    font-size: 14px;
    font-weight: 600;

    cursor: pointer;
}


.btn-primary {
    border: none;
    background: #0f766e;
    color: white;
}


.btn-primary:hover {
    background: #0d5f59;
}


.btn-secondary {
    border: 1px solid #cbd5e1;
    background: white;
    color: #475569;
}


.status-card {
    margin-top: 20px;
}


.status-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}


.status-btn {
    border: none;
    padding: 11px 18px;

    border-radius: 8px;

    font-weight: 600;
    cursor: pointer;
}


.confirm-btn {
    background: #dbeafe;
    color: #1d4ed8;
}


.cancel-btn {
    background: #fee2e2;
    color: #b91c1c;
}


.complete-btn {
    background: #dcfce7;
    color: #166534;
}


.status-message {
    padding: 14px;

    border-radius: 8px;

    background: #f8fafc;
    color: #64748b;

    font-size: 14px;
}


.alert-danger {
    padding: 14px;
    margin-bottom: 20px;

    border-radius: 8px;

    background: #fee2e2;
    color: #991b1b;
}

</style>

<div class="page-container">

    {{-- HEADER --}}

    <div class="page-header">

        <div>
            <h1>Edit Appointment</h1>

            <p>
                Update appointment information
            </p>
        </div>

        <a
            href="{{ route('appointments.show', $appointment) }}"
            class="back-btn"
        >
            ← Back
        </a>

    </div>


    {{-- PATIENT INFO --}}

    <div class="patient-summary">

        <div class="summary-avatar">

            {{ strtoupper(
                substr(
                    $appointment->patient->full_name,
                    0,
                    1
                )
            ) }}

        </div>

        <div>

            <div class="summary-label">
                Patient
            </div>

            <div class="summary-name">
                {{ $appointment->patient->full_name }}
            </div>

        </div>

    </div>


    {{-- FORM --}}

    <div class="card">

        <div class="card-header">

            <div>
                <h2>
                    Appointment Details
                </h2>

                <p>
                    Only scheduled appointments can be edited.
                </p>
            </div>

        </div>


        <div class="card-body">

            @if($errors->any())

                <div class="alert alert-danger">

                    @foreach($errors->all() as $error)

                        <div>
                            {{ $error }}
                        </div>

                    @endforeach

                </div>

            @endif


            <form
                method="POST"
                action="{{ route(
                    'appointments.update',
                    $appointment
                ) }}"
            >

                @csrf

                @method('PUT')


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
                        class="form-input"
                        required
                    >

                        <option value="">
                            Select doctor
                        </option>

                        @foreach($doctors as $doctor)

                            <option
                                value="{{ $doctor->id }}"
                                {{ old(
                                    'doctor_id',
                                    $appointment->doctor_id
                                ) == $doctor->id
                                    ? 'selected'
                                    : ''
                                }}
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

                        <div class="field-error">
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
                        value="{{ old(
                            'scheduled_at',
                            $appointment->scheduled_at
                                ? $appointment->scheduled_at
                                    ->format('Y-m-d\TH:i')
                                : ''
                        ) }}"
                        class="form-input"
                        required
                    >

                    @error('scheduled_at')

                        <div class="field-error">
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
                        class="form-input"
                        rows="5"
                        placeholder="Enter appointment reason"
                    >{{ old(
                        'reason',
                        $appointment->reason
                    ) }}</textarea>

                    @error('reason')

                        <div class="field-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- ACTIONS --}}

                <div class="form-actions">

                    <a
                        href="{{ route(
                            'appointments.show',
                            $appointment
                        ) }}"
                        class="btn btn-secondary"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Save Changes
                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- STATUS --}}

    <div class="card status-card">

        <div class="card-header">

            <div>

                <h2>
                    Appointment Status
                </h2>

                <p>
                    Current status:
                    <strong>
                        {{ ucfirst($appointment->status) }}
                    </strong>
                </p>

            </div>

        </div>


        <div class="card-body">

            @if($appointment->status === 'scheduled')

                <div class="status-actions">

                    {{-- CONFIRM --}}

                    <form
                        method="POST"
                        action="{{ route(
                            'appointments.updateStatus',
                            $appointment
                        ) }}"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="status"
                            value="confirmed"
                        >

                        <button
                            type="submit"
                            class="status-btn confirm-btn"
                            onclick="return confirm(
                                'Confirm this appointment?'
                            )"
                        >
                            Confirm Appointment
                        </button>

                    </form>


                    {{-- CANCEL --}}

                    <form
                        method="POST"
                        action="{{ route(
                            'appointments.updateStatus',
                            $appointment
                        ) }}"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="status"
                            value="cancelled"
                        >

                        <button
                            type="submit"
                            class="status-btn cancel-btn"
                            onclick="return confirm(
                                'Cancel this appointment?'
                            )"
                        >
                            Cancel Appointment
                        </button>

                    </form>

                </div>

            @elseif($appointment->status === 'confirmed')

                <form
                    method="POST"
                    action="{{ route(
                        'appointments.updateStatus',
                        $appointment
                    ) }}"
                >

                    @csrf
                    @method('PATCH')

                    <input
                        type="hidden"
                        name="status"
                        value="completed"
                    >

                    <button
                        type="submit"
                        class="status-btn complete-btn"
                        onclick="return confirm(
                            'Mark this appointment as completed?'
                        )"
                    >
                        Mark as Completed
                    </button>

                </form>


                <form
                    method="POST"
                    action="{{ route(
                        'appointments.updateStatus',
                        $appointment
                    ) }}"
                    style="margin-top: 10px;"
                >

                    @csrf
                    @method('PATCH')

                    <input
                        type="hidden"
                        name="status"
                        value="cancelled"
                    >

                    <button
                        type="submit"
                        class="status-btn cancel-btn"
                        onclick="return confirm(
                            'Cancel this appointment?'
                        )"
                    >
                        Cancel Appointment
                    </button>

                </form>

            @else

                <div class="status-message">

                    This appointment can no longer
                    be updated.

                </div>

            @endif

        </div>

    </div>

</div>

@endsection