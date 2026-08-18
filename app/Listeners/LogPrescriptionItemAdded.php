<?php

namespace App\Listeners;

use App\Events\PrescriptionItemAdded;
use App\Services\ActivityLogService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogPrescriptionItemAdded
{
    public function __construct(
        private ActivityLogService $activityLogService
    ) {}

    public function handle(PrescriptionItemAdded $event): void
    {
        $this->activityLogService->log(
            'prescriptionItem.added',
            $event->prescriptionItem
        );
    }
}
