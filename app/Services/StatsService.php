<?php

namespace App\Services;

use App\Constants\LowStockMedicine;
use App\Models\Appointment;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class StatsService
{
    public function overview(): array
    {
        $today = now()->toDateString();

        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        $patientCount = Patient::query()->count();

        $todayAppointments = Appointment::query()
            ->whereDate('scheduled_at', $today)
            ->count();

        $monthlyRevenue = Payment::query()
            ->where('status', 'completed')
            ->whereBetween('created_at', [
                $startOfMonth,
                $endOfMonth,
            ])
            ->sum('amount');

        $lowStockMedicines = Medicine::query()
            ->where('is_active', true)
            ->where('stock', '<=',  LowStockMedicine::LOW_STOCK_THRESHOLD)
            ->count();

        return [
            'patients' => $patientCount,
            'today_appointments' => $todayAppointments,
            'monthly_revenue' => (float) $monthlyRevenue,
            'low_stock_medicines' => $lowStockMedicines,
        ];
    }
}