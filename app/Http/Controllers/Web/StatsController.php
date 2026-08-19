<?php

namespace App\Http\Controllers\Web;

use App\Constants\LowStockMedicine;
use App\Events\PaymentActivity;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Payment;
use App\Services\StatsService;

class StatsController extends Controller
{
    public function __construct(
        private StatsService $statsService
    ) {}

    public function index()
    {

        $threshold = LowStockMedicine::LOW_STOCK_THRESHOLD; 
        
        $lowStockMedicines = Medicine::where('stock', '<=', $threshold)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        $stats = [
            'patients'=> Patient::count(), 
            'today_appointments' => Appointment::whereDate('scheduled_at', today())->count(),
            'monthly_revenue' => Payment::whereMonth('created_at', now()->month)
                                        ->whereYear('created_at', now()->year)
                                        ->where('status', 'completed')
                                        ->sum('amount'),
            'low_stock_medicines' => Medicine::where('stock', '<=', $threshold)->count(),
        ];

       $revenueByMonth = Payment::whereYear('created_at', date('Y'))
            ->where('status', 'completed')
            ->get()
            ->groupBy(function ($payment) {
                return (int) $payment->created_at->format('n'); 
            })
            ->map(function ($group) {
                return (float) $group->sum('amount'); 
            });


        $chartData = [];
        for ($m = 1; $m <= 12; $m++) {
            $chartData[] = $revenueByMonth->get($m, 0);
        }

        return view('stats.index', [
            'stats' => $stats,
            'lowStockMedicines' => $lowStockMedicines,
            'monthlyRevenueChart' => $chartData,
        ]);
    }
}