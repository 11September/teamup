<?php

namespace App\Http\Controllers\Admin;

use App\Report;
use App\Helpers\UserHelper;
use App\Services\TeamService;
use App\Services\ReportsService;
use App\Services\ActivityService;
use App\Http\Requests\ReportStore;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    protected $reportsService;
    protected $activityService;
    protected $teamService;

    public function __construct(ReportsService $reportsService, TeamService $teamService, ActivityService $activityService)
    {
        $this->reportsService = $reportsService;
        $this->activityService = $activityService;
        $this->teamService = $teamService;
    }

    public function download()
    {
        return true;
    }

    public function index()
    {
        $reports = $this->reportsService->getOwnerReports();

        return view('admin.reports.index', compact('reports'));
    }

    public function show(Report $report)
    {
        UserHelper::checkPermissionOwnerReport($report);

        $report->load('user');

        $activity = $this->activityService->find($report->activity_id) ;

        $measure = $this->activityService->getMeasureByActivityId($report->activity_id);

        $records = $this->reportsService->getRecordsByReportId($report->user->id, $report->activity_id, $activity->graph_type);

        return view('admin.reports.show', compact('reports', 'report', 'records', 'measure'));
    }

    public function store(ReportStore $request)
    {
        $report = $this->reportsService->store($request);

        return redirect()->action('Admin\ReportsController@show', $report->id)
            ->with([
                'success' => $report ? true : false,
                'status' => $report ? true : false
                    ? "success"
                    : "danger",
                'message' => $report
                    ? "Report successfully generated!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ], 200);
    }
}
