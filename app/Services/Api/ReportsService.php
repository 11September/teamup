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

    public function getRecordsByReportId($user_id, $activity_id, $type_graph)
    {
        $type_graph = GraphHelper::convertActivityTypeToQuery($type_graph);

        return $this->record->getUsersRecordsToReportApi($user_id, $activity_id, $type_graph);
    }

    public function store(Request $request)
    {
        $attributes = $this->prepareData($request);

        return $this->report->store($attributes);
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

