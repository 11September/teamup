<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\ReportsService;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    protected $reportsService;

    public function __construct(ReportsService $reportsService)
    {
        $this->reportsService = $reportsService;
    }

    public function index()
    {
        $reports = $this->reportsService->index();

        return view('admin.reports.index', compact('reports'));
    }
}
