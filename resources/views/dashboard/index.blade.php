
@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')

<style>

    /* =====================================================
       WELCOME
    ===================================================== */

    .dashboard-welcome {
        margin-bottom: 28px;
    }

    .dashboard-welcome h1 {
        color: #172b40;

        font-size: 25px;

        margin-bottom: 7px;
    }


    .dashboard-welcome p {
        color: #94a3b8;

        font-size: 13px;
    }


    /* =====================================================
       STAT CARDS
    ===================================================== */

    .stats-grid {
        display: grid;

        grid-template-columns:
            repeat(4, minmax(0, 1fr));

        gap: 16px;

        margin-bottom: 25px;
    }


    .stat-card {
        background: white;

        border: 1px solid #e3edf4;
        border-radius: 12px;

        padding: 20px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        min-height: 120px;

        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }


    .stat-card:hover {
        transform:
            translateY(-2px);

        box-shadow:
            0 10px 25px
            rgba(30, 70, 100, 0.07);
    }


    .stat-label {
        color: #94a3b8;

        font-size: 11px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: 0.5px;

        margin-bottom: 8px;
    }


    .stat-number {
        color: #172b40;

        font-size: 27px;

        font-weight: 700;
    }


    .stat-description {
        color: #a0acb8;

        font-size: 10px;

        margin-top: 5px;
    }
    .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
  
        height: 28px;
        width: 30px;
        
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

    .stat-icon {
        width: 45px;
        height: 45px;

        border-radius: 11px;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 18px;

        flex-shrink: 0;
    }


    .stat-blue {
        background: #e8f4fc;

        color: #1769aa;
    }


    .stat-mint {
        background: #e8f7f4;

        color: #2a9d8f;
    }


    .stat-orange {
        background: #fff3e9;

        color: #e67e22;
    }


    .stat-purple {
        background: #f1edfb;

        color: #7556a8;
    }


    /* =====================================================
       DASHBOARD GRID
    ===================================================== */

    .dashboard-grid {
        display: grid;

        grid-template-columns:
            minmax(0, 1.7fr)
            minmax(280px, 1fr);

        gap: 20px;
    }


    .dashboard-card {
        background: white;

        border: 1px solid #e3edf4;

        border-radius: 12px;

        overflow: hidden;
    }


    .card-header {
        min-height: 62px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        padding: 0 20px;

        border-bottom: 1px solid #edf2f6;
    }


    .card-title {
        color: #26384a;

        font-size: 14px;

        font-weight: 700;
    }


    .card-link {
        color: #1769aa;

        font-size: 11px;

        font-weight: 700;

        text-decoration: none;
    }


    .card-link:hover {
        text-decoration: underline;
    }


    /* =====================================================
       APPOINTMENTS
    ===================================================== */

    .appointment-list {
        padding: 5px 20px;
    }


    .appointment-item {
        min-height: 70px;

        display: flex;

        align-items: center;

        gap: 15px;

        border-bottom:
            1px solid #f0f3f6;
    }


    .appointment-item:last-child {
        border-bottom: none;
    }


    .appointment-time {
        width: 58px;

        color: #1769aa;

        font-size: 12px;

        font-weight: 700;
    }


    .appointment-info {
        flex: 1;

        min-width: 0;
    }


    .appointment-patient {
        color: #334155;

        font-size: 12px;

        font-weight: 700;

        margin-bottom: 4px;
    }


    .appointment-reason {
        color: #94a3b8;

        font-size: 10px;

        white-space: nowrap;

        overflow: hidden;

        text-overflow: ellipsis;
    }


    .appointment-status {
        padding:
            5px 9px;

        border-radius: 20px;

        font-size: 9px;

        font-weight: 700;
    }


    .status-confirmed {
        background: #e8f7f4;

        color: #15803d;
    }


    .status-scheduled {
        background: #e8f4fc;

        color: #0d969d;
    }


    .status-completed {
        background: #eef1f4;

        color: #4338ca;
    }


    /* =====================================================
       QUICK ACTIONS
    ===================================================== */

    .quick-actions {
        padding: 18px 20px;
    }


    .quick-action {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        border:
            1px solid #e7eef3;
        border-radius: 9px;
        margin-bottom: 10px;
        color: #334155;
        transition:
            background 0.2s ease,
            border-color 0.2s ease;
    }


    .quick-action:last-child {
        margin-bottom: 0;
    }


    .quick-action:hover {
        background: #f7fbfe;

        border-color: #cfe2ef;
    }


    .quick-icon {
        width: 34px;
        height: 34px;

        border-radius: 8px;

        background: #e8f4fc;

        color: #1769aa;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 14px;
    }


    .quick-text {
        flex: 1;
    }


    .quick-title {
        font-size: 11px;

        font-weight: 700;

        color: #334155;
    }


    .quick-description {
        font-size: 9px;

        color: #94a3b8;

        margin-top: 3px;
    }


    .quick-arrow {
        color: #b0bcc7;

        font-size: 14px;
    }


    /* =====================================================
       EMPTY STATE
    ===================================================== */

    .empty-state {
        min-height: 210px;

        display: flex;

        flex-direction: column;

        align-items: center;

        justify-content: center;

        text-align: center;

        color: #94a3b8;
    }


    .empty-icon {
        width: 45px;
        height: 45px;

        border-radius: 50%;

        background: #f1f6f9;

        display: flex;

        align-items: center;

        justify-content: center;

        margin-bottom: 10px;

        color: #aab7c2;
    }


    .empty-state p {
        font-size: 11px;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 1150px) {

        .stats-grid {
            grid-template-columns:
                repeat(2, 1fr);
        }

    }


    @media (max-width: 850px) {

        .dashboard-grid {
            grid-template-columns: 1fr;
        }

    }


    @media (max-width: 550px) {

        .stats-grid {
            grid-template-columns: 1fr;
        }


        .dashboard-welcome h1 {
            font-size: 21px;
        }

    }

</style>

@endpush


@section('content')


    <!-- =====================================================
         WELCOME
    ====================================================== -->

    <section class="dashboard-welcome">

        <h1>
            Welcome back, {{ auth()->user()->name }}
        </h1>

        <p>
            Here is what's happening at your clinic today.
        </p>

    </section>


    <!-- =====================================================
         STATS
    ====================================================== -->

    <section class="stats-grid">


        {{-- Patients --}}

        @if(auth()->user()->hasPermission('PATIENTS.FINDALL'))

            <div class="stat-card">

                <div>

                    <div class="stat-label">
                        Patients
                    </div>

                    <div class="stat-number">
                        {{ $patientCount ?? 0 }}
                    </div>

                    <div class="stat-description">
                        Registered patients
                    </div>

                </div>


                <div class="stat-icon stat-blue">
                    ♙
                </div>

            </div>

        @endif


        {{-- Appointments --}}

        @if(auth()->user()->hasPermission('APPOINTMENTS.FINDALL'))

            <div class="stat-card">

                <div>

                    <div class="stat-label">
                        Appointments
                    </div>

                    <div class="stat-number">
                        {{ $appointmentCount ?? 0 }}
                    </div>

                    <div class="stat-description">
                        Today's appointments
                    </div>

                </div>


                <div class="stat-icon stat-mint">
                    ◫
                </div>

            </div>

        @endif


        {{-- Medicines --}}

        @if(auth()->user()->hasPermission('MEDICINES.FINDALL'))

            <div class="stat-card">

                <div>

                    <div class="stat-label">
                        Medicines
                    </div>

                    <div class="stat-number">
                        {{ $medicineCount ?? 0 }}
                    </div>

                    <div class="stat-description">
                        Active medicines
                    </div>

                </div>


                <div class="stat-icon stat-orange">
                    ♧
                </div>

            </div>

        @endif


        {{-- Invoices --}}

        @if(auth()->user()->hasPermission('INVOICES.FINDALL'))

            <div class="stat-card">

                <div>

                    <div class="stat-label">
                        Invoices
                    </div>

                    <div class="stat-number">
                        {{ $invoiceCount ?? 0 }}
                    </div>

                    <div class="stat-description">
                        Pending invoices
                    </div>

                </div>


                <div class="stat-icon stat-purple">
                    ▧
                </div>

            </div>

        @endif


    </section>


    <!-- =====================================================
         MAIN DASHBOARD
    ====================================================== -->

    <section class="dashboard-grid">


        <!-- =================================================
             TODAY'S APPOINTMENTS
        ================================================== -->

        @if(auth()->user()->hasPermission('APPOINTMENTS.FINDALL'))

            <div class="dashboard-card">

                <div class="card-header">

                    <div class="card-title">
                        Today's Appointments
                    </div>

                    <a
                        href="{{ route('appointments.index') }}"
                        class="card-link"
                    >
                        View all
                    </a>
                </div>

                @if(isset($appointments) && $appointments->count())

                    <div class="appointment-list">
                        @foreach($appointments as $appointment)
                            <div class="appointment-item">
                                <div class="appointment-time">

                                    {{ $appointment->scheduled_at?->format('H:i') }}
                                </div>

                                <div class="appointment-info">

                                    <div class="appointment-patient">

                                        {{ $appointment->patient->full_name ?? 'Unknown Patient' }}

                                    </div>


                                    <div class="appointment-reason">

                                        {{ $appointment->reason ?? 'General consultation' }}

                                    </div>

                                </div>


                                <div>

                                    <span
                                        class="
                                            appointment-status

                                            @if($appointment->status === 'confirmed')
                                                status-confirmed
                                            @elseif($appointment->status === 'completed')
                                                status-completed
                                            @else
                                                status-scheduled
                                            @endif
                                        "
                                    >

                                        {{ ucfirst($appointment->status) }}

                                    </span>

                                </div>


                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="empty-state">

                        <div class="empty-icon">
                            ◫
                        </div>

                        <p>
                            No appointments scheduled for today.
                        </p>

                    </div>

                @endif


            </div>

        @endif


        <!-- =================================================
             QUICK ACTIONS
        ================================================== -->

        <div class="dashboard-card">


            <div class="card-header">

                <div class="card-title">
                    Quick Actions
                </div>

            </div>


            <div class="quick-actions">


                {{-- Add Patient --}}

                @if(auth()->user()->hasPermission('PATIENTS.CREATE'))

                        <a
                            href="{{ route('patients.create') }}"
                            class="btn-primary"
                        >
                            <span>+</span>
                        </a>

                        <div class="quick-text">
                            <div class="quick-title">
                                Add Patient
                            </div>
                            <div class="quick-description">
                                Register a new patient
                            </div>
                        </div>

                        <div class="quick-arrow">
                            →
                        </div>

                    </a>
                @endif

                {{-- Add Doctor --}}

                @if(auth()->user()->hasPermission('DOCTORS.CREATE'))

                        <a
                            href="{{ route('doctors.create') }}"
                            class="btn-primary"
                        >
                            <span>+</span>
                        </a>

                        <div class="quick-text">
                            <div class="quick-title">
                                Add doctor
                            </div>
                            <div class="quick-description">
                                Register a new doctor
                            </div>
                        </div>

                        <div class="quick-arrow">
                            →
                        </div>

                    </a>
                @endif

               
                {{-- Medicine --}}

                @if(auth()->user()->hasPermission('MEDICINES.CREATE'))


                       <a
                            href="{{ route('medicines.create') }}"
                            class="btn-primary"
                        >
                            <span>+</span>
                        </a>

                        <div class="quick-text">

                            <div class="quick-title">
                                Add Medicine
                            </div>

                            <div class="quick-description">
                                Add medicine to inventory
                            </div>

                        </div>

                        <div class="quick-arrow">
                            →
                        </div>

                    </a>

                @endif


                {{-- Create User --}}
                {{-- ADMIN ONLY THROUGH PERMISSION --}}

                @if(auth()->user()->hasPermission('USERS.CREATE'))

                        <a
                            href="{{ route('users.create') }}"
                            class="btn-primary"
                        >
                            <span>+</span>
                        </a>

                        <div class="quick-text">

                            <div class="quick-title">
                                Create User
                            </div>

                            <div class="quick-description">
                                Create a clinic staff account
                            </div>

                        </div>


                        <div class="quick-arrow">
                            →
                        </div>

                    </a>

                @endif


            </div>

        </div>

    </section>

@endsection
