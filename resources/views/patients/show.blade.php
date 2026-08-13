
@extends('layouts.app')

@section('title', 'Patient Details')
@section('page-title', 'Patient Details')

@section('content')

<style>

    .patient-page {
        max-width: 1100px;
    }

    /* ================= HEADER ================= */

    .patient-header {
        display: flex;
        align-items: center;
        justify-content: space-between;

        margin-bottom: 25px;
    }

    .patient-header-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .patient-avatar-large {
        width: 58px;
        height: 58px;

        border-radius: 50%;

        background: #e0f7f7;
        color: #0d969d;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 22px;
        font-weight: bold;
    }

    .patient-title h1 {
        font-size: 27px;
        color: #111827;

        margin-bottom: 5px;
    }

    .patient-code {
        color: #94a3b8;
        font-size: 13px;
    }

    .header-actions {
        display: flex;
        gap: 10px;
    }

    /* ================= BUTTONS ================= */

    .btn {
        height: 42px;

        padding: 0 17px;

        border-radius: 8px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        text-decoration: none;

        font-size: 14px;
        font-weight: 600;

        transition: 0.2s;
    }

    .btn-primary {
        background: #13adb5;
        color: white;
    }

    .btn-primary:hover {
        background: #0d969d;
    }

    .btn-secondary {
        background: white;
        color: #64748b;

        border: 1px solid #cbdede;
    }

    .btn-secondary:hover {
        background: #f8ffff;
        color: #374151;
    }

    /* ================= GRID ================= */

    .patient-grid {
        display: grid;

        grid-template-columns: 1fr 1fr;

        gap: 20px;
    }

    .card {
        background: white;

        border: 1px solid #dceeee;

        border-radius: 12px;

        box-shadow:
            0 5px 20px rgba(0, 100, 100, 0.06);

        overflow: hidden;
    }

    .card-header {
        padding: 18px 22px;

        border-bottom: 1px solid #edf4f4;

        background: #fbfefe;
    }

    .card-header h2 {
        font-size: 16px;

        color: #374151;
    }

    .card-body {
        padding: 22px;
    }

    /* ================= INFORMATION ================= */

    .info-row {
        display: flex;

        justify-content: space-between;
        gap: 20px;

        padding: 13px 0;

        border-bottom: 1px solid #edf4f4;
    }

    .info-row:first-child {
        padding-top: 0;
    }

    .info-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .info-label {
        color: #94a3b8;

        font-size: 13px;
    }

    .info-value {
        color: #1f2937;

        font-size: 14px;

        font-weight: 500;

        text-align: right;
    }
    .create-btn {
        height: 43px;
        padding: 0 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #13adb5;
        color: white;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: 0.2s;
    }

    .create-btn:hover {
        background: #0d969d;
    }

    .empty-value {
        color: #94a3b8;
        font-weight: normal;
    }

    /* ================= PATIENT SUMMARY ================= */

    .summary {
        display: flex;

        align-items: center;

        gap: 15px;

        margin-bottom: 22px;

        padding-bottom: 20px;

        border-bottom: 1px solid #edf4f4;
    }

    .summary-avatar {
        width: 48px;
        height: 48px;

        border-radius: 50%;

        background: #e0f7f7;
        color: #0d969d;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 18px;
        font-weight: bold;
    }

    .summary-name {
        color: #1f2937;

        font-size: 16px;

        font-weight: 600;

        margin-bottom: 4px;
    }

    .summary-code {
        color: #94a3b8;

        font-size: 12px;
    }

    /* ================= MEDICAL SECTION ================= */

    .medical-placeholder {
        padding: 35px 20px;

        text-align: center;

        color: #94a3b8;

        font-size: 13px;
    }

    .medical-placeholder-icon {
        font-size: 32px;

        margin-bottom: 10px;
    }
    .appointment-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}


    .appointment-item {
        display: flex;
        align-items: center;
        gap: 18px;

        padding: 16px;

        border: 1px solid #e2e8f0;
        border-radius: 10px;

        background: #ffffff;

        transition: 0.2s;
    }


    .appointment-item:hover {
        border-color: #99f6e4;
        background: #f8fffe;
    }


    .appointment-date {
        width: 55px;
        height: 55px;

        flex-shrink: 0;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background: #ecfdf5;
        color: #0f766e;
    }


    .appointment-day {
        font-size: 20px;
        font-weight: 700;
    }


    .appointment-month {
        font-size: 11px;
        text-transform: uppercase;
    }


    .appointment-info {
        flex: 1;
    }


    .appointment-doctor {
        font-size: 15px;
        font-weight: 700;
        color: #1f2937;
    }


    .appointment-specialty {
        margin-top: 3px;

        font-size: 13px;
        color: #0f766e;
    }


    .appointment-time {
        margin-top: 5px;

        font-size: 13px;
        color: #64748b;
    }


    .appointment-reason {
        margin-top: 5px;

        font-size: 13px;
        color: #475569;
    }


    .appointment-status {
        flex-shrink: 0;
    }


    .status-badge {
        display: inline-flex;

        padding: 6px 10px;

        border-radius: 999px;

        font-size: 12px;
        font-weight: 600;
    }


    .status-scheduled {
        background: #fef3c7;
        color: #92400e;
    }


    .status-confirmed {
        background: #dbeafe;
        color: #1d4ed8;
    }


    .status-completed {
        background: #dcfce7;
        color: #166534;
    }


    .status-cancelled {
        background: #fee2e2;
        color: #991b1b; 
    }
    /* ================================
   MEDICAL RECORDS
================================ */

.medical-record-card {
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 20px;
    margin-bottom: 16px;
    background: #ffffff;
    transition: box-shadow 0.2s ease, transform 0.2s ease;
}

.medical-record-card:hover {
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    transform: translateY(-1px);
}


/* Header */

.medical-record-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
    padding-bottom: 16px;
    border-bottom: 1px solid #eef0f2;
}

.medical-record-date {
    font-size: 15px;
    font-weight: 600;
    color: #1f2937;
}

.medical-record-doctor {
    margin-top: 5px;
    font-size: 13px;
    color: #6b7280;
}


    /* Sections */

    .medical-record-section {
        padding: 16px 0;
        border-bottom: 1px solid #f1f3f5;
    }

    .medical-record-section:last-of-type {
        border-bottom: none;
    }

    .medical-record-label {
        margin-bottom: 7px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #166534;
    }

    .medical-record-value {
        font-size: 14px;
        line-height: 0.3;
        color: #374151;
        white-space: pre-line;
    }


    .medical-record-footer {
        margin-top: 14px;
        padding-top: 12px;
        border-top: 1px solid #eef0f2;
        font-size: 12px;
        color: #9ca3af;
    }


    /* View button */

    .medical-record-header .view-btn {
        flex-shrink: 0;
        text-decoration: none;
    }


    /* Empty state */

    .medical-placeholder {
        min-height: 180px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 12px;
        text-align: center;
        color: #9ca3af;
    }

    .medical-placeholder-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #f3f4f6;
        font-size: 22px;
    }


    /* Responsive */

    @media (max-width: 768px) {

        .medical-record-card {
            padding: 16px;
        }

        .medical-record-header {
            flex-direction: column;
            gap: 12px;
        }

        .medical-record-header .view-btn {
            width: 100%;
            text-align: center;
        }

    }


    @media (max-width: 700px) {

        .appointment-item {
            align-items: flex-start;
        }

        .appointment-status {
            margin-left: auto;
        }

    }

    /* ================= RESPONSIVE ================= */

    @media (max-width: 800px) {

        .patient-grid {
            grid-template-columns: 1fr;
        }

    }

    @media (max-width: 600px) {

        .patient-header {
            flex-direction: column;

            align-items: flex-start;

            gap: 18px;
        }

        .header-actions {
            width: 100%;
        }

        .header-actions .btn {
            flex: 1;
        }
        .create-btn {
            width: 100%;
        }

        .info-row {
            flex-direction: column;

            gap: 5px;
        }

        .info-value {
            text-align: left;
        }
        

    }

</style>


<div class="patient-page">


    <!-- ================= HEADER ================= -->

    <div class="patient-header">


        <div class="patient-header-left">


            <div class="patient-avatar-large">

                {{ strtoupper(
                    substr($patient->full_name, 0, 1)
                ) }}

            </div>


            <div class="patient-title">

                <h1>
                    {{ $patient->full_name }}
                </h1>

                <div class="patient-code">

                    Patient Code:
                    {{ $patient->code }}

                </div>

            </div>


        </div>


        <div class="header-actions">


            <a
                href="{{ route('patients.index') }}"
                class="btn btn-secondary"
            >
                ← Back
            </a>
            @if(
                auth()->user()->hasPermission(
                    'APPOINTMENTS.CREATE'
                )
            )

                <a
                    href="{{ route('patients.appointments.create', [
                        'patient' => $patient->id
                    ]) }}"
                    class="create-btn"
                >
                    + New Appointment
                </a>

            @endif


            @if(
                auth()->user()->hasPermission('PATIENTS.UPDATE')
            )
                <a
                    href="{{ route('patients.edit', $patient) }}"
                    class="btn btn-primary"
                >
                    Edit Patient
                </a>
            @endif
        </div>
    </div>

    <!-- ================= INFORMATION ================= -->

    <div class="patient-grid">


        <!-- ================= PERSONAL INFORMATION ================= -->

        <div class="card">


            <div class="card-header">

                <h2>
                    Personal Information
                </h2>

            </div>


            <div class="card-body">


                <div class="summary">

                    <div class="summary-avatar">

                        {{ strtoupper(
                            substr($patient->full_name, 0, 1)
                        ) }}

                    </div>


                    <div>

                        <div class="summary-name">

                            {{ $patient->full_name }}

                        </div>

                        <div class="summary-code">

                            {{ $patient->code }}

                        </div>

                    </div>

                </div>



                <div class="info-row">

                    <span class="info-label">
                        Full Name
                    </span>

                    <span class="info-value">
                        {{ $patient->full_name }}
                    </span>

                </div>

                <div class="info-row">

                    <span class="info-label">
                        Gender
                    </span>

                    <span class="info-value">
                        {{ $patient->gender
                            ? ucfirst($patient->gender)
                            : '-' }}
                    </span>

                </div>


                <div class="info-row">

                    <span class="info-label">
                        Date of Birth
                    </span>

                    <span class="info-value">

                        {{ $patient->date_of_birth
                            ? \Carbon\Carbon::parse(
                                $patient->date_of_birth
                            )->format('d/m/Y')
                            : '-' }}

                    </span>

                </div>


                <div class="info-row">

                    <span class="info-label">
                        Patient Code
                    </span>

                    <span class="info-value">
                        {{ $patient->code }}
                    </span>

                </div>


            </div>

        </div>



        <!-- ================= CONTACT INFORMATION ================= -->

        <div class="card">


            <div class="card-header">

                <h2>
                    Contact Information
                </h2>

            </div>


            <div class="card-body">


                <div class="info-row">

                    <span class="info-label">
                        Phone
                    </span>

                    <span class="info-value">

                        {{ $patient->phone ?? '-' }}

                    </span>

                </div>


                <div class="info-row">

                    <span class="info-label">
                        Email
                    </span>

                    <span class="info-value">

                        @if($patient->email)

                            {{ $patient->email }}

                        @else

                            <span class="empty-value">
                                Not provided
                            </span>

                        @endif

                    </span>

                </div>


                <div class="info-row">

                    <span class="info-label">
                        Address
                    </span>

                    <span class="info-value">

                        @if($patient->address)

                            {{ $patient->address }}

                        @else

                            <span class="empty-value">
                                Not provided
                            </span>

                        @endif

                    </span>

                </div>


                <div class="info-row">

                    <span class="info-label">
                        Registered
                    </span>

                    <span class="info-value">

                        {{ $patient->created_at
                            ? $patient->created_at->format('d/m/Y H:i')
                            : '-' }}

                    </span>

                </div>


            </div>

        </div>



        <!-- ================= MEDICAL RECORDS ================= -->

        <div class="card">
            <div class="card-header">
                <h2>
                    Medical Records
                </h2>
            </div>
            <div class="card-body">

                @php
                    $examinations = $patient->appointments
                        ->pluck('examination')
                        ->filter()
                        ->sortByDesc('examinated_at');
                @endphp

                @forelse($examinations as $examination)
                    <div class="medical-record-card">
                        <div class="medical-record-header">
                            <div>
                                <div class="medical-record-date">

                                    {{ \Carbon\Carbon::parse(
                                        $examination->examinated_at
                                    )->format('d M Y, H:i') }}

                                </div>

                                <div class="medical-record-doctor">

                                    Dr.
                                    {{ $examination->
                                    appointment->doctor->user->name }}

                                </div>
                            </div>

                        </div>

                        <div class="medical-record-section">

                            <div class="medical-record-label">
                                Diagnosis
                            </div>
                            <div class="medical-record-value">

                                {{ $examination->diagnosis }}

                            </div>
                        </div>

                        <div class="medical-record-section">
                            <div class="medical-record-label">
                                Note
                            </div>
                            <div class="medical-record-value">
                                {{ $examination->note ?? 'No note provided.' }}
                            </div>
                        </div>


                        <div class="medical-record-footer">
                            Appointment #{{ $examination->appointment_id }}
                        </div>
                    </div>
                @empty

                    <div class="medical-placeholder">

                        <div class="medical-placeholder-icon">
                            ♡
                        </div>

                        <div>
                            No medical examination records yet.
                        </div>

                    </div>

                @endforelse

            </div>

        </div>

        <!-- ================= APPOINTMENTS ================= -->

        <div class="card">
            <div class="card-header">
                <h2>
                    Appointments
                </h2>

            </div>
            <div class="card-body">

                @if($patient->appointments->count() > 0)
                    <div class="appointment-list">
                        @foreach($patient->appointments->
                        sortByDesc('scheduled_at') as $appointment)
                            <div class="appointment-item">

                                {{-- Date --}}

                                <div class="appointment-date">

                                    <div class="appointment-day">
                                        {{ $appointment->scheduled_at->format('d') }}
                                    </div>

                                    <div class="appointment-month">
                                        {{ $appointment->scheduled_at->format('M') }}
                                    </div>

                                </div>

                                {{-- Information --}}

                                <div class="appointment-info">

                                    <div class="appointment-doctor">
                                        {{ $appointment->doctor->user->name }}

                                    </div>

                                    @if($appointment->doctor->specialty)

                                        <div class="appointment-specialty">

                                            {{ $appointment->doctor->specialty->name }}

                                        </div>

                                    @endif

                                    <div class="appointment-time">
                                        {{ $appointment->scheduled_at->format('H:i') }}
                                    </div>

                                    @if($appointment->reason)
                                        <div class="appointment-reason">
                                            {{ $appointment->reason }}
                                        </div>
                                    @endif
                                </div>

                                {{-- Status --}}
                                <div class="appointment-status">
                                    <span
                                        class="status-badge status-{{ $appointment->status }}"
                                    >
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </div>
                            </div>
                       @endforeach
                    </div>
                @else
                    <div class="medical-placeholder">
                        <div class="medical-placeholder-icon">
                            ◫
                        </div>
                        <div>
                            No appointments found for this patient.
                        </div>
                    </div>
                @endif

            </div>


        </div>


    </div>


</div>

@endsection

