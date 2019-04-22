<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 012 12.03.19
 * Time: 16:31
 */

namespace App\Services;

use App\Report;
use App\Activity;
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

    public function index()
    {
        return true;
    }

    public function getOwnerReports()
    {
        return $this->report->indexOwner();
    }

    public function getRecordsByReportId(Report $report, Activity $activity)
    {
        $user_id = $report->user->id;
        $activity_id = $report->activity_id;
        $type_graph = $activity->graph_type;
        $range = $report->range;

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
        $attributes['link'] = "temp";
        $attributes['date'] = Carbon::now()->format('Y-m-d');
        $attributes['owner_id'] = Auth::id();

        return $attributes;
    }

    public function prepareDataAfter($range, $records)
    {
        if ($range == "month"){
            foreach ($records as $key => $value) {

//                dd($key, $value->first()->date);

                $date = Carbon::createFromFormat('d-m-Y', $value->first()->date)->isoFormat('MMM DD');

                $records[ucfirst($key)] = $value;
                unset($records[$key]);
            }
        }


        return $records;
    }
}

