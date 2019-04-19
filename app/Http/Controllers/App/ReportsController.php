<?php

namespace App\Http\Controllers\App;

use App\Services\Api\ReportsService;
use App\Http\Controllers\Controller;


class ReportsController extends Controller
{
    protected $recordService;
    protected $reportsService;
    protected $activityService;

    public function __construct(ReportsService $reportsService)
    {
        $this->reportsService = $reportsService;
    }

    public function download()
    {
        return true;
    }
}
