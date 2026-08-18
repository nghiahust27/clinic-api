<?php

namespace App\Listeners;

use App\Events\PrescriptionItemRemoved;
use App\Services\ActivityLogService;

class LogPrescriptionItemRemoved
{
    public function __construct(
        private ActivityLogService $activityLogService
    ) {}

    public function handle(PrescriptionItemRemoved $event): void
    {
        $this->activityLogService->log(
            action: 'prescription_item.removed',
            subject: $event->item,
            meta: [
                'prescription_id' => $event->item->prescription_id,
                'medicine_id' => $event->item->medicine_id,
                'quantity' => $event->item->quantity,
            ]
        );
    }
}