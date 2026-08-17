<?php

namespace App\Listeners;

use App\Events\UserActivityLogged;
use App\Services\ActivityLogService;

class LogUserActivity
{
    public function __construct(
        private ActivityLogService $activityLogService
    ) {}

    public function handle(UserActivityLogged $event): void
    {
        $this->activityLogService->log(
            $event->action,
            $event->user,
            $event->meta
        );
    }
}