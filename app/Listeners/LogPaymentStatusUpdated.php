<?php

namespace App\Listeners;

use App\Events\PaymentStatusUpdated;
use App\Services\ActivityLogService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogPaymentStatusUpdated
{
    public function __construct(
        private ActivityLogService $activityLogService
    ) {}

    public function handle(PaymentStatusUpdated $event): void
    {
        $this->activityLogService->log(
            'payment.status_updated',
            $event->payment,
            [
                'old_status' => $event->oldStatus,
                'new_status' => $event->newStatus,
                'amount' => $event->payment->amount,
            ]
        );
    }
}