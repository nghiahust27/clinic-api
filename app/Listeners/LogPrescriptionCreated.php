<?php

namespace App\Listeners;

use App\Events\PrescriptionCreated;
use App\Services\ActivityLogService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogPrescriptionCreated
{
    public function __construct(
        private ActivityLogService $activityLogService
    ) {}

    public function handle(PrescriptionCreated $event): void
    {
        $this->activityLogService->log(
            'prescription.created',
            $event->prescription
        );
    }
}
