@extends('layouts.app')

@section('content')
<div class="stats-page">

    {{-- Header --}}
    <div class="stats-header">
        <div>
            <h1>Clinic Overview</h1>
            <p>Overview of your clinic's activities and performance.</p>
        </div>

        <div class="stats-date">
            <span>{{ now()->format('d/m/Y') }}</span>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="stats-grid">

        {{-- Patients --}}
        <div class="stats-card">
            <div class="stats-card-top">
                <div class="stats-icon stats-icon-patient">
                    <i class="bi bi-people-fill"></i>
                </div>

                <span class="stats-label">
                    Patients
                </span>
            </div>

            <div class="stats-value">
                {{ number_format($stats['patients']) }}
            </div>

            <div class="stats-description">
                Total registered patients
            </div>
        </div>


        {{-- Today's Appointments --}}
        <div class="stats-card">
            <div class="stats-card-top">
                <div class="stats-icon stats-icon-appointment">
                    <i class="bi bi-calendar-check-fill"></i>
                </div>

                <span class="stats-label">
                    Today's Appointments
                </span>
            </div>

            <div class="stats-value">
                {{ number_format($stats['today_appointments']) }}
            </div>

            <div class="stats-description">
                Appointments scheduled today
            </div>
        </div>


        {{-- Monthly Revenue --}}
        <div class="stats-card">
            <div class="stats-card-top">
                <div class="stats-icon stats-icon-revenue">
                    <i class="bi bi-cash-stack"></i>
                </div>

                <span class="stats-label">
                    Monthly Revenue
                </span>
            </div>

            <div class="stats-value stats-revenue">
                $ {{ number_format($stats['monthly_revenue']) }}
                
            </div>

            <div class="stats-description">
                Revenue from completed payments
            </div>
        </div>


        {{-- Low Stock --}}
        <div class="stats-card">
            <div class="stats-card-top">
                <div class="stats-icon stats-icon-stock">
                    <i class="bi bi-capsule"></i>
                </div>

                <span class="stats-label">
                    Low Stock
                </span>
            </div>

            <div class="stats-value">
                {{ number_format($stats['low_stock_medicines']) }}
            </div>

            <div class="stats-description">
                Medicines that need restocking
            </div>
        </div>

    </div>


    {{-- Quick Overview --}}
    <div class="stats-section">

        <div class="stats-section-header">
            <div>
                <h2>Quick Overview</h2>
                <p>Current clinic status</p>
            </div>
        </div>

        <div class="overview-list">

            <div class="overview-item">
                <div class="overview-left">
                    <div class="overview-icon">
                        <i class="bi bi-person-check-fill"></i>
                    </div>

                    <div>
                        <strong>Patient Management</strong>
                        <span>
                            {{ number_format($stats['patients']) }}
                            registered patients
                        </span>
                    </div>
                </div>
            </div>


            <div class="overview-item">
                <div class="overview-left">
                    <div class="overview-icon">
                        <i class="bi bi-calendar2-check-fill"></i>
                    </div>

                    <div>
                        <strong>Today's Schedule</strong>
                        <span>
                            {{ number_format($stats['today_appointments']) }}
                            appointments today
                        </span>
                    </div>
                </div>
            </div>


            <div class="overview-item">
                <div class="overview-left">
                    <div class="overview-icon">
                        <i class="bi bi-box-seam-fill"></i>
                    </div>

                    <div>
                        <strong>Medicine Inventory</strong>
                        <span>
                            {{ number_format($stats['low_stock_medicines']) }}
                            medicines running low
                        </span>
                    </div>
                </div>
            </div>


            <div class="overview-item">
                <div class="overview-left">
                    <div class="overview-icon">
                        <i class="bi bi-wallet2"></i>
                    </div>

                    <div>
                        <strong>Monthly Revenue</strong>
                        <span>
                            $ {{ number_format($stats['monthly_revenue']) }}
                            this month
                        </span>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>


<style>
    .stats-page {
        padding: 10px 5px 40px;
    }

    /* Header */

    .stats-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .stats-header h1 {
        margin: 0 0 7px;
        font-size: 28px;
        font-weight: 700;
        color: #1f2937;
    }

    .stats-header p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .stats-date {
        padding: 10px 16px;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        color: #4b5563;
        font-size: 14px;
        font-weight: 500;
    }


    /* Cards */

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .stats-card {
        background: #ffffff;
        border: 1px solid #e8ebef;
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.04);
        transition: all 0.2s ease;
    }

    .stats-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 22px rgba(0, 0, 0, 0.07);
    }

    .stats-card-top {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .stats-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .stats-icon-patient {
        background: #eaf2ff;
        color: #2563eb;
    }

    .stats-icon-appointment {
        background: #ecfdf5;
        color: #059669;
    }

    .stats-icon-revenue {
        background: #fff7ed;
        color: #ea580c;
    }

    .stats-icon-stock {
        background: #fef2f2;
        color: #dc2626;
    }

    .stats-label {
        font-size: 14px;
        color: #6b7280;
        font-weight: 500;
    }

    .stats-value {
        font-size: 30px;
        font-weight: 700;
        color: #111827;
        line-height: 1.2;
        margin-bottom: 8px;
    }

    .stats-revenue {
        font-size: 25px;
    }

    .stats-revenue span {
        font-size: 16px;
        font-weight: 600;
    }

    .stats-description {
        font-size: 13px;
        color: #9ca3af;
    }


    /* Overview */

    .stats-section {
        margin-top: 28px;
        background: #ffffff;
        border: 1px solid #e8ebef;
        border-radius: 16px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.04);
    }

    .stats-section-header {
        padding: 22px 24px;
        border-bottom: 1px solid #eef0f2;
    }

    .stats-section-header h2 {
        margin: 0 0 5px;
        font-size: 19px;
        font-weight: 650;
        color: #1f2937;
    }

    .stats-section-header p {
        margin: 0;
        font-size: 13px;
        color: #9ca3af;
    }

    .overview-list {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }

    .overview-item {
        padding: 20px 24px;
        border-bottom: 1px solid #f0f1f3;
    }

    .overview-item:nth-child(odd) {
        border-right: 1px solid #f0f1f3;
    }

    .overview-item:nth-last-child(-n+2) {
        border-bottom: none;
    }

    .overview-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .overview-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: #f3f6fa;
        color: #4b5563;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .overview-left strong {
        display: block;
        color: #374151;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .overview-left span {
        display: block;
        color: #9ca3af;
        font-size: 13px;
    }


    /* Responsive */

    @media (max-width: 1100px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 700px) {
        .stats-header {
            align-items: flex-start;
            gap: 15px;
            flex-direction: column;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .overview-list {
            grid-template-columns: 1fr;
        }

        .overview-item:nth-child(odd) {
            border-right: none;
        }

        .overview-item {
            border-bottom: 1px solid #f0f1f3 !important;
        }

        .overview-item:last-child {
            border-bottom: none !important;
        }
    }
</style>
@endsection