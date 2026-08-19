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
                <span class="stats-label">Patients</span>
            </div>
            <div class="stats-value">{{ number_format($stats['patients']) }}</div>
            <div class="stats-description">Total registered patients</div>
        </div>

        {{-- Today's Appointments --}}
        <div class="stats-card">
            <div class="stats-card-top">
                <div class="stats-icon stats-icon-appointment">
                    <i class="bi bi-calendar-check-fill"></i>
                </div>
                <span class="stats-label">Today's Appointments</span>
            </div>
            <div class="stats-value">{{ number_format($stats['today_appointments']) }}</div>
            <div class="stats-description">Appointments scheduled today</div>
        </div>

        {{-- Monthly Revenue --}}
        <div class="stats-card">
            <div class="stats-card-top">
                <div class="stats-icon stats-icon-revenue">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <span class="stats-label">Monthly Revenue</span>
            </div>
            <div class="stats-value stats-revenue" 
                id="revenue-counter" 
                data-target="{{ $stats['monthly_revenue'] ?? 0 }}">
                $ 0
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
                <span class="stats-label">Low Stock</span>
            </div>
            <div class="stats-value">{{ number_format($stats['low_stock_medicines']) }}</div>
            <div class="stats-description">Medicines that need restocking</div>
        </div>

    </div>


    {{-- Analytics & Low Stock Section --}}
    <div class="dashboard-analytics-grid">

        {{-- Left: Revenue Chart --}}
        <div class="stats-section">
            <div class="stats-section-header">
                <div>
                    <h2>Revenue Overview</h2>
                    <p>Monthly revenue performance for current year</p>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        {{-- Right: Low Stock Medicines List --}}
        <div class="stats-section">
            <div class="stats-section-header">
                <div>
                    <h2>Low Stock Alert</h2>
                    <p>Medicines near or below threshold limit</p>
                </div>
                <a href="{{ route('medicines.index') }}" class="btn-link">View All</a>
            </div>

            <div class="stock-list-container">
                @forelse($lowStockMedicines ?? [] as $medicine)
                    <div class="stock-item">
                        <div class="stock-info">
                            <strong class="stock-name">{{ $medicine->name }}</strong>
                            <span class="stock-unit">{{ $medicine->unit ?? 'Unit' }}</span>
                        </div>
                        <div class="stock-badge">
                            <span class="badge-stock-qty">{{ $medicine->stock }} left</span>
                        </div>
                    </div>
                @empty
                    <div class="empty-stock-state">
                        <i class="bi bi-check-circle-fill"></i>
                        <p>All medicine stocks are sufficient!</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</div>


{{-- Include Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const counterEl = document.getElementById('revenue-counter');
        if (counterEl) {
            const targetValue = parseFloat(counterEl.getAttribute('data-target')) || 0;
            const duration = 1500; 
            const frameDuration = 1000 / 60; 
            const totalFrames = Math.round(duration / frameDuration);
            let frame = 0;

            const counter = setInterval(() => {
                frame++;
              
                const progress = 1 - Math.pow(1 - (frame / totalFrames), 4);
                const currentNumber = Math.floor(targetValue * progress);

                counterEl.innerHTML = '$ ' + currentNumber.toLocaleString();

                if (frame >= totalFrames) {
                    counterEl.innerHTML = '$ ' + targetValue.toLocaleString();
                    clearInterval(counter);
                }
            }, frameDuration);
        }

        const ctx = document.getElementById('revenueChart').getContext('2d');
        
        const revenueData = {!! json_encode($monthlyRevenueChart ?? array_fill(0, 12, 0)) !!};

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Revenue ($)',
                    data: revenueData,
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.08)',
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#2563eb',
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,

             
                animation: {
                    duration: 1500,        
                    easing: 'easeOutQuart', 
                },
                animations: {
                    y: {
                        from: 0
                    }
                },

                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ' Revenue: $' + context.raw.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f3f4f6' },
                        ticks: {
                            callback: function(value) { return '$' + value; },
                            color: '#9ca3af',
                            font: { size: 11 }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#9ca3af', font: { size: 11 } }
                    }
                }
            }
        });
    });
</script>

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

    /* Cards Grid */
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

    .stats-icon-patient { background: #eaf2ff; color: #2563eb; }
    .stats-icon-appointment { background: #ecfdf5; color: #059669; }
    .stats-icon-revenue { background: #fff7ed; color: #ea580c; }
    .stats-icon-stock { background: #fef2f2; color: #dc2626; }

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

    .stats-revenue { font-size: 25px; }
    .stats-description { font-size: 13px; color: #9ca3af; }

    /* Dashboard Analytics 2-Column Grid */
    .dashboard-analytics-grid {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: 20px;
        margin-top: 28px;
    }

    .stats-section {
        background: #ffffff;
        border: 1px solid #e8ebef;
        border-radius: 16px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.04);
        display: flex;
        flex-direction: column;
    }

    .stats-section-header {
        padding: 20px 24px;
        border-bottom: 1px solid #eef0f2;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .stats-section-header h2 {
        margin: 0 0 4px;
        font-size: 18px;
        font-weight: 650;
        color: #1f2937;
    }

    .stats-section-header p {
        margin: 0;
        font-size: 13px;
        color: #9ca3af;
    }

    .btn-link {
        color: #2563eb;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-link:hover {
        text-decoration: underline;
    }

    /* Chart Box */
    .chart-container {
        padding: 20px 24px 24px;
        height: 320px;
        position: relative;
    }

    /* Low Stock List */
    .stock-list-container {
        padding: 12px 24px;
        max-height: 320px;
        overflow-y: auto;
    }

    .stock-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 0;
        border-bottom: 1px solid #f3f4f6;
    }

    .stock-item:last-child {
        border-bottom: none;
    }

    .stock-info {
        display: flex;
        flex-direction: column;
    }

    .stock-name {
        font-size: 14px;
        color: #1f2937;
        font-weight: 600;
    }

    .stock-unit {
        font-size: 12px;
        color: #9ca3af;
        margin-top: 2px;
    }

    .badge-stock-qty {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
        font-size: 12px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
    }

    .empty-stock-state {
        padding: 40px 20px;
        text-align: center;
        color: #10b981;
    }

    .empty-stock-state i {
        font-size: 32px;
    }

    .empty-stock-state p {
        margin-top: 8px;
        font-size: 14px;
        color: #6b7280;
    }

    /* Responsive */
    @media (max-width: 1100px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .dashboard-analytics-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 700px) {
        .stats-header {
            align-items: flex-start;
            gap: 15px;
            flex-direction: column;
        }

        .stats-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection