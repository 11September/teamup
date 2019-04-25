<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 012 12.03.19
 * Time: 16:31
 */

namespace App\Services\Api;

use Carbon\Carbon;
use App\Helpers\GraphHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\RecordRepository;
use App\Repositories\ReportsRepository;

class ReportsService
{
    public function __construct(ReportsRepository $report, RecordRepository $recordRepository)
    {
        $this->report = $report;
        $this->record = $recordRepository;
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

    public function generateGraphActivityImage($activity, $records)
    {
        $base64 = GraphHelper::generateGraphImageBase64($activity, $records);

        $path = GraphHelper::saveBase64GraphImage($base64);

        return $path;
    }

    public function store(Request $request)
    {
        $attributes = $this->prepareData($request);

        return $this->report->store($attributes);
    }

    public function updateImagePath($id, $path)
    {
        $attributes['image_graph'] = $path;

        return $this->report->update($id, $attributes);
    }

    public function prepareData(Request $request)
    {
        $attributes['team_id'] = $request->team_id;
        $attributes['user_id'] = $request->user_id;
        $attributes['activity_id'] = $request->activity_id;
        $attributes['range'] = $request->range;
        $attributes['link'] = "temp";
        $attributes['date'] = Carbon::now()->format('Y-m-d');
        $attributes['owner_id'] = Auth::id();

        return $attributes;
    }
}

