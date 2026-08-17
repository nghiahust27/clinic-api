<?php

namespace App\Listeners;

use App\Constants\ActivityAction;
use App\Events\InvoiceCreated;
use App\Services\ActivityLogService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogInvoiceCreated
{
    public function __construct(
        private ActivityLogService $activityLogService
    ) {}

    public function handle(InvoiceCreated $event): void
    {
        $this->activityLogService->log(
            'invoice.created',
            $event->invoice,
            [
                'invoice_code' => $event->invoice->invoice_code,
                'total' => $event->invoice->total,
            ]
        );
    }
}
