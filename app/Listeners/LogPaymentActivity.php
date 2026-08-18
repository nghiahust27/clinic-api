<?php

namespace App\Listeners;

use App\Events\PaymentActivity;
use App\Services\ActivityLogService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogPaymentActivity
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private ActivityLogService $activityLogService
    )
    {  
    }

    public function handle(PaymentActivity $event): void
    {
        $this->activityLogService->log(
            $event->action,
            $event->payment,
            $event->meta
        );
    }
}
