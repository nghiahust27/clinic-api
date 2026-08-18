<?php

namespace App\Listeners;

use App\Events\ExaminationCreated;
use App\Services\ActivityLogService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogExaminationCreated
{
    public function __construct(
        private ActivityLogService $activityLogService
    ) {}

    public function handle(ExaminationCreated $event): void
    {
        $this->activityLogService->log(
            'examination.created',
            $event->examination
        );
    }
}
