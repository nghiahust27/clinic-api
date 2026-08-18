<?php

namespace App\Listeners;

use App\Events\ExaminationUpdated;
use App\Services\ActivityLogService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogExaminationUpdated
{
    public function __construct(
        private ActivityLogService $activityLogService
    ) {}

    public function handle(ExaminationUpdated $event): void
    {
        $this->activityLogService->log(
            action: 'examination.updated',
            subject: $event->examination,
            meta: [
                'old_diagnosis' => $event->oldDiagnosis,
                'new_diagnosis' => $event->newDiagnosis,
                'old_note' => $event->oldNote,
                'new_note' => $event->newNote,
            ]
        );
    }
}
