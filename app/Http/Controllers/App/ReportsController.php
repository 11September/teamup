<?php

namespace App\Http\Controllers\App;

use PDF;
use App\Report;
use App\Helpers\UserHelper;
use App\Http\Requests\ReportStore;
use App\Http\Controllers\Controller;
use App\Services\Api\ReportsService;
use Illuminate\Support\Facades\View;
use App\Services\Api\ActivityService;

class ReportsController extends Controller
{
    protected $reportsService;
    protected $activityService;

    public function __construct(ReportsService $reportsService, ActivityService $activityService)
    {
        $this->reportsService = $reportsService;
        $this->activityService = $activityService;
    }

    public function show(Report $report)
    {
        return response()->json([
            'report' => $report,
        ], 200);
    }

    public function store(ReportStore $request)
    {
        $activity = $this->activityService->findWithMeasureAndGoal($request->activity_id);

        $measure = $this->activityService->getMeasureByActivityId($request->activity_id);

        $records = $this->reportsService->getRecordsByReportId($request->user_id, $request->activity_id, $request->range);

        $path = $this->reportsService->generateGraphActivityImage($activity, $records);

        $request->merge(['image_graph' => $path]);

        $report = $this->reportsService->store($request);

        $this->reportsService->updateImagePath($report->id, $path);

        return response()->json([
            'report' => $report,
        ], 200);
    }

    public function download(Report $report)
    {
        UserHelper::checkPermissionOwnerReport($report);

//      Get file path



//      Generate PDF

        $html = View::make("admin.reports.report2")->with('reports', 'report', 'records', 'measure', 'activity')->render();
        $pdf = PDF::loadHTML($html)->setWarnings(true)->save('myfile.pdf');


        return $pdf->download('download.pdf');

//      Download

//        $report->load('user');
//
//        $activity = $this->activityService->findWithMeasureAndGoal($report->activity_id);
//
//        $measure = $this->activityService->getMeasureByActivityId($report->activity_id);
//
//        $records = $this->reportsService->getRecordsByReportId($report, $activity);

//        return view('admin.reports.report2', compact('reports', 'report', 'records', 'measure', 'activity'));

//        $data = [
//            'title' => 'Test Report PDF',
//            'report' => $report,
//            'activity' => $activity,
//            'measure' => $measure,
//            'records' => $records,
//        ];

//        $pdf = PDF::loadView('admin.reports.report2', $data);
//        $pdf->debug = true;
//        $pdf->save(public_path() . '/reports/my.pdf')->stream('download.pdf');
//        return $pdf->download('download.pdf');


    }

}
