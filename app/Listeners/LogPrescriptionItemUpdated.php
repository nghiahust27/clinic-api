<?php

namespace App\Listeners;

use App\Events\PrescriptionItemUpdated;
use App\Services\ActivityLogService;

class LogPrescriptionItemUpdated
{
    public function __construct(
        private ActivityLogService $activityLogService
    ) {}

    public function handle(PrescriptionItemUpdated $event): void
    {
        $this->activityLogService->log(
            action: 'prescription_item.updated',
            subject: $event->item,
            meta: [
                'prescription_id' => $event->item->prescription_id,
                'medicine_id' => $event->item->medicine_id,
                'old_quantity' => $event->oldQuantity,
                'new_quantity' => $event->newQuantity,
            ]
        );
    }
}