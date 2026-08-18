<?php

namespace App\Listeners;

use App\Events\InvoiceUpdated;
use App\Services\ActivityLogService;

class LogInvoiceUpdated
{
    public function __construct(
        private ActivityLogService $activityLogService
    ) {}

    public function handle(InvoiceUpdated $event): void
    {
        $this->activityLogService->log(
            action: 'invoice.updated',
            subject: $event->invoice,
            meta: [
                'old_discount' => $event->oldDiscount,
                'new_discount' => $event->newDiscount,
            ]
        );
    }
}