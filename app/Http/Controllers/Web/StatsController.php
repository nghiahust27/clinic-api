<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\StatsService;

class StatsController extends Controller
{
    public function __construct(
        private StatsService $statsService
    ) {}

    public function index()
    {
        $stats = $this->statsService->overview();

        return view('stats.index', compact('stats'));
    }
}