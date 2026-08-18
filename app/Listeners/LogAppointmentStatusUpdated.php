<?php

namespace App\Listeners;

use App\Events\AppointmentStatusUpdated;
use App\Services\ActivityLogService;

class LogAppointmentStatusUpdated
{
    public function __construct(
        private ActivityLogService $activityLogService
    ) {}

    public function handle(AppointmentStatusUpdated $event): void
    {

        $this->activityLogService->log(
            'appointment.status_updated',
            $event->appointment,
            [
                'old_status' => $event->oldStatus,
                'new_status' => $event->newStatus,
            ]
        );
    }
}