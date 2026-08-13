@extends('layouts.app')


@section('title', 'Examination Details')
@section('page-title', 'Examination Details')


@section('content')
<style>

    /* =========================================================
       APPOINTMENT SHOW PAGE
    ========================================================= */

    .appointment-page {
        width: 100%;
        max-width: 1180px;
        margin: 0 auto;
        padding: 10px 0 40px;
    }


    /* =========================================================
       PAGE HEADER
    ========================================================= */

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


    /* =========================================================
       BUTTONS
    ========================================================= */

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 42px;

        padding: 0 17px;

        border-radius: 9px;

        font-size: 14px;
        font-weight: 600;

        text-decoration: none;

        cursor: pointer;

        transition:
            background 0.2s ease,
            border-color 0.2s ease,
            color 0.2s ease,
            transform 0.15s ease;
    }


    .btn:hover {
        transform: translateY(-1px);
    }


    .btn-secondary {
        border: 1px solid #d8e1e8;

        background: #ffffff;

        color: #475569;
    }


    .btn-secondary:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }


    .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        height: 44px;
        padding: 0 20px;

        background: #13adb5;
        color: white;

        border-radius: 8px;
        text-decoration: none;

        font-size: 14px;
        font-weight: 600;

        transition: 0.2s;
    }

    .btn-primary:hover {
        background: #0d969d;
    }


    /* =========================================================
       STATUS SUMMARY
    ========================================================= */

    .appointment-status-card {
        display: flex;
        align-items: center;
        justify-content: space-between;

        min-height: 105px;

        margin-bottom: 22px;
        padding: 22px 24px;

        border: 1px solid #d5efec;
        border-radius: 14px;

        background:
            linear-gradient(
                135deg,
                #f2fbfa 0%,
                #ecfdfb 100%
            );

        box-shadow:
            0 3px 12px rgba(15, 118, 110, 0.05);
    }


    .status-label {
        margin-bottom: 9px;

        font-size: 12px;
        font-weight: 600;

        color: #64748b;

        text-transform: uppercase;
        letter-spacing: 0.5px;
    }


    .appointment-datetime {
        text-align: right;
    }


    .datetime-date {
        color: #334155;

        font-size: 14px;
        font-weight: 600;
    }


    .datetime-time {
        margin-top: 5px;

        color: #0f766e;

        font-size: 25px;
        font-weight: 700;

        letter-spacing: -0.5px;
    }


    /* =========================================================
       STATUS BADGES
    ========================================================= */

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-width: 88px;

        padding: 7px 12px;

        border-radius: 999px;

        font-size: 12px;
        font-weight: 700;

        text-transform: capitalize;
    }


    .status-scheduled {
        background: #e0f7f7;

        color: #0d969d;
    }


    .status-confirmed {
        background: #dcfce7;

        color: #15803d;
    }


    .status-completed {
        background: #e0e7ff;

        color: #4338ca;
    }


    .status-cancelled {
        background: #fee2e2;

        color: #dc2626;
    }


    /* =========================================================
       DETAILS GRID
    ========================================================= */

    .details-grid {
        display: grid;

        grid-template-columns:
            minmax(0, 1fr)
            minmax(0, 1fr);

        gap: 20px;
    }


    .card {
        overflow: hidden;

        border: 1px solid #e2e8f0;
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


    /* =========================================================
       PROFILE
    ========================================================= */

    .profile-row {
        display: flex;
        align-items: center;

        gap: 14px;

        padding-bottom: 18px;

        border-bottom: 1px solid #edf2f5;
    }


    .profile-avatar {
        width: 54px;
        height: 54px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #dff7f4;

        color: #0f766e;

        font-size: 20px;
        font-weight: 700;

        border: 3px solid #f0fdfa;
    }


    .doctor-avatar {
        background: #e4efff;

        color: #2563eb;

        border-color: #eff6ff;
    }


    .profile-info {
        min-width: 0;
    }


    .profile-label {
        margin-bottom: 3px;

        color: #94a3b8;

        font-size: 11px;
        font-weight: 600;

        text-transform: uppercase;
        letter-spacing: 0.45px;
    }


    .profile-name {
        overflow: hidden;

        color: #1e293b;

        font-size: 16px;
        font-weight: 700;

        text-overflow: ellipsis;
        white-space: nowrap;
    }


    .profile-specialty {
        margin-top: 4px;

        color: #0f766e;

        font-size: 13px;
        font-weight: 500;
    }


    /* =========================================================
       INFORMATION LIST
    ========================================================= */

    .info-list {
        margin-top: 4px;
    }


    .info-item {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 20px;

        min-height: 43px;

        border-bottom: 1px solid #f1f5f9;
    }


    .info-item:last-child {
        border-bottom: none;
    }


    .info-item span {
        color: #64748b;

        font-size: 13px;
    }


    .info-item strong {
        max-width: 60%;

        overflow: hidden;

        color: #334155;

        font-size: 13px;
        font-weight: 600;

        text-align: right;

        text-overflow: ellipsis;
        white-space: nowrap;
    }


    /* =========================================================
       PROFILE LINK
    ========================================================= */

    .profile-link {
        display: inline-flex;
        align-items: center;

        margin-top: 15px;

        color: #0f766e;

        font-size: 13px;
        font-weight: 600;

        text-decoration: none;

        transition: color 0.2s ease;
    }


    .profile-link:hover {
        color: #0b5f59;
        text-decoration: underline;
    }


    /* =========================================================
       REASON
    ========================================================= */

    .reason-box {
        position: relative;

        padding: 17px 18px 17px 20px;

        border: 1px solid #e6eef1;
        border-radius: 10px;

        background: #f8fbfc;

        color: #334155;

        font-size: 14px;

        line-height: 1.7;
    }


    .reason-box::before {
        content: "";

        position: absolute;

        top: 12px;
        bottom: 12px;
        left: 0;

        width: 3px;

        border-radius: 3px;

        background: #14b8a6;
    }


    .empty-info {
        padding: 15px 16px;

        border-radius: 9px;

        background: #f8fafc;

        color: #94a3b8;

        font-size: 13px;

        text-align: center;
    }


    /* =========================================================
       STATUS ACTIONS
    ========================================================= */

    .action-group {
        display: flex;
        align-items: center;

        gap: 10px;

        flex-wrap: wrap;
    }


    .action-group form {
        margin: 0;
    }


    .status-action {
        min-height: 42px;

        padding: 0 17px;

        border: 1px solid transparent;
        border-radius: 8px;

        font-size: 13px;
        font-weight: 600;

        cursor: pointer;

        transition:
            background 0.2s ease,
            border-color 0.2s ease,
            transform 0.15s ease;
    }


    .status-action:hover {
        transform: translateY(-1px);
    }


    .status-action.confirm {
        border-color: #bfdbfe;

        background: #eff6ff;

        color: #1d4ed8;
    }


    .status-action.confirm:hover {
        background: #dbeafe;
    }


    .status-action.cancel {
        border-color: #fecaca;

        background: #fff1f2;

        color: #b91c1c;
    }


    .status-action.cancel:hover {
        background: #fee2e2;
    }


    .status-action.complete {
        border-color: #bbf7d0;

        background: #f0fdf4;

        color: #166534;
    }


    .status-action.complete:hover {
        background: #dcfce7;
    }


    /* =========================================================
       ALERT
    ========================================================= */

    .alert {
        padding: 13px 15px;

        margin-bottom: 18px;

        border-radius: 9px;

        font-size: 13px;
        line-height: 1.6;
    }


    .alert-danger {
        border: 1px solid #fecaca;

        background: #fef2f2;

        color: #991b1b;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 900px) {

        .appointment-page {
            padding: 10px 15px 30px;
        }


        .details-grid {
            grid-template-columns: 1fr;
        }


        .full-width {
            grid-column: auto;
        }

    }


    @media (max-width: 650px) {

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


        .appointment-status-card {
            align-items: flex-start;

            flex-direction: column;

            gap: 16px;
        }


        .appointment-datetime {
            width: 100%;

            padding-top: 14px;

            border-top: 1px solid #d8eeeb;

            text-align: left;
        }


        .datetime-time {
            font-size: 22px;
        }


        .card-header {
            min-height: 56px;

            padding: 0 16px;
        }


        .card-body {
            padding: 16px;
        }


        .profile-name {
            max-width: 220px;
        }


        .info-item {
            align-items: flex-start;

            flex-direction: column;

            gap: 4px;

            padding: 11px 0;
        }


        .info-item strong {
            max-width: 100%;

            text-align: left;
        }


        .action-group {
            flex-direction: column;

            align-items: stretch;
        }


        .action-group form,
        .status-action {
            width: 100%;
        }

    }


    @media (max-width: 420px) {

        .appointment-page {
            padding-left: 10px;
            padding-right: 10px;
        }


        .page-header h1 {
            font-size: 23px;
        }


        .profile-avatar {
            width: 48px;
            height: 48px;

            font-size: 18px;
        }


        .profile-name {
            max-width: 190px;
        }

    }

</style>


<div class="appointment-page">

    {{-- HEADER --}}

    <div class="page-header">

        <div>

            <h1>
                Examination Details
            </h1>

            <p>
                View examination information and status
            </p>

        </div>

        <div class="header-actions">
            
            <a
                href="{{ route('examinations.index') }}"
                class="btn btn-secondary"
            >
                ← Back
            </a>

            @if(!isset($examination->prescription))
                @if(auth()->user()->hasPermission(
                        'PRESCRIPTIONS.CREATE'))
                    <a
                        href="{{ route(
                            'examinations.prescriptions.create',
                            ['examination' => $examination->id]
                        ) }}"
                        class="btn-primary"
                    >
                        + Create Prescription
                    </a>
                @endif
            @else
                @if(auth()->user()->hasPermission(
                        'PRESCRIPTIONS.FINDONE'))
                    <a
                        href="{{ route(
                            'prescriptions.show',
                            ['prescription' => $examination
                            ->prescription->id]
                        ) }}"
                        class="btn-primary"
                    >
                        View Prescription
                    </a>
                @endif
            @endif
        </div>
    </div>

    {{-- STATUS --}}

    <div class="appointment-status-card">

        

        <div class="appointment-datetime">
            <div class="datetime-date">
                {{ $examination->examinated_at->format(
                    'D, d M Y'
                ) }}
            </div>
            <div class="datetime-time">

                {{ $examination->examinated_at->format(
                    'H:i'
                ) }}
            </div>
        </div>
    </div>

    <div class="details-grid">
        {{-- PATIENT --}}
        <div class="card">
            <div class="card-header">
                <h2>
                    Patient
                </h2>
            </div>
            <div class="card-body">
                <div class="profile-row">
                    <div class="profile-avatar">
                        {{ strtoupper(
                            substr(
                                $examination->
                                appointment->patient->full_name,
                                0,
                                1
                            )
                        ) }}

                    </div>

                    <div class="profile-info">
                        <div class="profile-label">
                            Full Name
                        </div>
                        <div class="profile-name">
                            {{ $examination->appointment->patient->full_name }}
                        </div>
                    </div>
                </div>

                <div class="info-list">

                    <div class="info-item">

                        <span>
                            Patient Code
                        </span>

                        <strong>
                            {{ $examination->appointment->patient->code }}
                        </strong>

                    </div>


                    <div class="info-item">

                        <span>
                            Phone
                        </span>

                        <strong>
                            {{ $examination->appointment->patient->phone }}
                        </strong>

                    </div>


                    @if($examination->appointment->patient->email)

                        <div class="info-item">

                            <span>
                                Email
                            </span>

                            <strong>
                                {{ $examination->appointment->patient->email }}
                            </strong>

                        </div>

                    @endif

                </div>


                <a
                    href="{{ route(
                        'patients.show',
                        $examination->appointment->patient
                    ) }}"
                    class="profile-link"
                >
                    View Patient Profile →
                </a>
            </div>
        </div>

        {{-- DOCTOR --}}
        <div class="card">
            <div class="card-header">
                <h2>
                    Doctor
                </h2>
            </div>

            <div class="card-body">

                <div class="profile-row">

                    <div class="profile-avatar doctor-avatar">

                        {{ strtoupper(
                            substr(
                                $examination->
                                appointment->doctor->user->name,
                                0,
                                1
                            )
                        ) }}

                    </div>


                    <div class="profile-info">

                        <div class="profile-label">
                            Doctor
                        </div>

                        <div class="profile-name">

                            {{ $examination->appointment->doctor->user->name }}

                        </div>


                        @if($examination->appointment->doctor->specialty)

                            <div class="profile-specialty">

                                {{ $examination->appointment->doctor->specialty->name }}

                            </div>

                        @endif

                    </div>

                </div>


                <div class="info-list">

                    <div class="info-item">

                        <span>
                            License Number
                        </span>

                        <strong>
                            {{ $examination->appointment->doctor->license_number }}
                        </strong>

                    </div>


                    @if($examination->appointment->doctor->user->email)

                        <div class="info-item">

                            <span>
                                Email
                            </span>

                            <strong>
                                {{ $examination->appointment->doctor->user->email }}
                            </strong>

                        </div>

                    @endif

                </div>


            </div>

        </div>

        {{-- REASON --}}

        <div class="card full-width">

            <div class="card-header">
                <h2>
                    Diagnosis
                </h2>
            </div>
            <div class="card-body">

                @if($examination->diagnosis)
                    <div class="reason-box">
                        {{ $examination->diagnosis }}
                    </div>
                @else
                    <div class="empty-info">
                        No diagnosis provided for this examination.
                    </div>
                @endif
            </div>

            <div class="card-header">
                <h2>
                    Note
                </h2>
            </div>
            <div class="card-body">

                @if($examination->note)
                    <div class="reason-box">
                        {{ $examination->note }}
                    </div>
                @else
                    <div class="empty-info">
                        No note provided for this examination.
                    </div>
                @endif
            </div>
        </div>

        
    </div>

</div>

@endsection