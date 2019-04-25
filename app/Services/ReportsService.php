<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 012 12.03.19
 * Time: 16:31
 */

namespace App\Services;

use PDF;
use App\Report;
use Carbon\Carbon;
use App\Helpers\GraphHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Repositories\RecordRepository;
use App\Repositories\ReportsRepository;

class ReportsService
{
    private $pdf_link;
    private $pdf_extension = ".pdf";

    public function __construct(ReportsRepository $report, RecordRepository $recordRepository)
    {
        $this->report = $report;
        $this->record = $recordRepository;
    }

    public function index()
    {
        return true;
    }

    public function getOwnerReports()
    {
        return $this->report->indexOwner();
    }

    public function getRecordsByReportId($user_id, $activity_id, $range, $type_graph = null)
    {
//        $type_graph = $activity->graph_type;
//        $type_graph = GraphHelper::convertActivityTypeToQuery($type_graph);

        $graph_format = GraphHelper::convertActivityRangeToFormat($range);

        $period_start = GraphHelper::detectStartDate($range);
//        $period_end = GraphHelper::detectEndDate($range);

        $records = $this->record->getUsersRecordsToReport($user_id, $activity_id, $graph_format, $period_start);

        return $records;
    }

    public function store(Request $request)
    {
        $attributes = $this->prepareData($request);

        return $this->report->store($attributes);
    }

    public function generateGraphActivityImage(Request $request, $activity, $records)
    {
        $base64 = GraphHelper::generateGraphImageBase64($activity, $records);

        $path = GraphHelper::saveBase64GraphImage($base64);

        $request->merge(['image_graph' => $path]);

        return $path;
    }

    public function generatePdfWithData(Request $request, $activity, $records, $range, $user = null)
    {
        $measure = $activity->measure;

        $html = View::make("admin.reports.report2")
            ->with('records', $records)
            ->with('activity', $activity)
            ->with('measure', $measure)
            ->with('range', $range)
            ->with('user', $user)
            ->render();

        $path = "/reports/" . time() . "-" . uniqid() . ".pdf";

        $pdf = PDF::loadHTML($html)->setWarnings(true)->save(storage_path('app/public/' . $path));

        $request->merge(['pdf_link' => $path]);

        return $path;
    }

    public function generatePdfNameFile(Report $report)
    {
        $report->load(
            [
                'user' => function ($query) {
                    $query->select('id', 'first_name', 'last_name');
                },
                'activity' => function ($query) {
                    $query->select('id', 'name');
                }
            ]);

        return $report->user->getFullnameAttribute() . " - " . $report->activity->name . $this->pdf_extension;
    }

    public function download(Request $request, Report $report)
    {
        if (!$report->pdf_link || !file_exists(storage_path("app/public") . $report->pdf_link)) {
            $report = $this->loadRelationActivityWithMeasuresAndGoal($report);

            $records = $this->getRecordsByReportId($report->user->id, $report->activity->id, $report->range);

            $pathGraphImage = $this->generateGraphActivityImage($request, $report->activity, $records);

            $pathGraphPdf = $this->generatePdfWithData($request, $report->activity, $records, $request->range);

            if ($pathGraphImage && $pathGraphPdf && $this->updatePathesReport($report->id, $pathGraphImage, $pathGraphPdf)) {
                $this->pdf_link = $pathGraphPdf;
            } else {
                $this->pdf_link = null;
            }
        } else {
            $this->pdf_link = $report->pdf_link;
        }

        return $this->pdf_link;
    }

    public function show()
    {
        return $this->report->last();
    }

    public function prepareData(Request $request)
    {
        $attributes['team_id'] = $request->team_id;
        $attributes['user_id'] = $request->user_id;
        $attributes['activity_id'] = $request->activity_id;
        $attributes['range'] = $request->range;
        $attributes['image_graph'] = $request->image_graph;
        $attributes['pdf_link'] = $request->pdf_link;
        $attributes['date'] = Carbon::now()->format('Y-m-d');
        $attributes['owner_id'] = Auth::id();

        return $attributes;
    }

    public function updatePathesReport($id, $pathGraphImage, $pathGraphPdf)
    {
        $attributes['image_graph'] = $pathGraphImage;
        $attributes['pdf_link'] = $pathGraphPdf;

        return $this->report->update($id, $attributes);
    }

    public function loadRelationActivityWithMeasuresAndGoal(Report $report)
    {
        $report->load('activity');

        $report->load(['user' => function ($query) {
            $query->select('id', 'first_name', 'last_name');
        }]);

        $report->activity->load(
            [
                'goal' => function ($query) {
                    $query->select('id', 'user_id', 'activity_id', 'goal');
                },
                'measure' => function ($query) {
                    $query->select('id', 'name');
                }
            ]);

        return $report;
    }
}

