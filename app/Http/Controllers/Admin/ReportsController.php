<?php

namespace App\Http\Controllers\Admin;

use App\Report;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Services\TeamService;
use App\Services\ReportsService;
use App\Services\ActivityService;
use App\Http\Requests\ReportStore;
use Illuminate\Foundation\Auth\User;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    protected $teamService;
    protected $reportsService;
    protected $activityService;

    public function __construct(ReportsService $reportsService, TeamService $teamService, ActivityService $activityService)
    {
        $this->reportsService = $reportsService;
        $this->activityService = $activityService;
        $this->teamService = $teamService;
    }

    public function downloadv(Report $report, Request $request)
    {
        UserHelper::checkPermissionOwnerReport($report);

        $report = $this->reportsService->loadRelationActivityWithMeasuresAndGoal($report);

        $records = $this->reportsService->getRecordsByReportId($report->user->id, $report->activity_id, $report->range);

        $this->reportsService->generateGraphActivityImage($request, $report->activity, $records);
    }

    public function downloadpdf(Report $report, Request $request)
    {
        $report = $this->reportsService->loadRelationActivityWithMeasuresAndGoal($report);

        $activity = $report->activity;

        $records = $this->reportsService->getRecordsByReportId($report->user->id, $report->activity_id, $report->range);

        return view('admin.reports.report2', compact('report', 'records', 'activity'));
    }

    public function download(Report $report, Request $request)
    {
        UserHelper::checkPermissionOwnerReport($report);

        $pathToDownload = $this->reportsService->download($request, $report);

        $fileName = $this->reportsService->generatePdfNameFile($report);

        return response()->download(storage_path('app/public/' . $pathToDownload), $fileName);
    }

    public function index()
    {
        $reports = $this->reportsService->getOwnerReports();

        return view('admin.reports.index', compact('reports'));
    }

    public function show(Report $report)
    {
        UserHelper::checkPermissionOwnerReport($report);

        $report = $this->reportsService->loadRelationActivityWithMeasuresAndGoal($report);

        $activity = $report->activity;

        $records = $this->reportsService->getRecordsByReportId($report->user->id, $report->activity_id, $report->range);

        return view('admin.reports.show', compact('report', 'records', 'activity'));
    }

    public function store(ReportStore $request)
    {
        $activity = $this->activityService->findWithMeasureAndGoal($request->activity_id);

        $user = User::find($request->user_id);

        $records = $this->reportsService->getRecordsByReportId($request->user_id, $request->activity_id, $request->range);

        $this->reportsService->generateGraphActivityImage($request, $activity, $records);

        $this->reportsService->generatePdfWithData($request, $activity, $records, $request->range, $user);

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
