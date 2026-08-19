<?php

namespace App\Listeners;

use App\Events\StockAdjusted;
use App\Services\ActivityLogService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogStockAdjusted
{
    public function __construct(
        private ActivityLogService $activityLogService
    ) {}

    public function handle(StockAdjusted $event): void
    {
        $this->activityLogService->log(
            'medicine.stock_adjusted',
            $event->medicine,
            [
                'old_stock' => $event->oldStock,
                'new_stock' => $event->newStock,
            ]
        );
    }
}
