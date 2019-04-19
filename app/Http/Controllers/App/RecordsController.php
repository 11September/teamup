<?php

namespace App\Http\Controllers\App;

use App\Services\Api\RecordService;
use App\Http\Controllers\Controller;
use App\Http\Requests\RecordStoreApi;
use App\Services\Api\ActivityService;
use App\Http\Requests\GenerateReportApi;

class RecordsController extends Controller
{
    protected $recordService;
    protected $activityService;

    public function __construct(RecordService $recordService, ActivityService $activityService)
    {
        $this->recordService = $recordService;
        $this->activityService = $activityService;
    }


    /**
     * index
     *
     * @param  [string] activity_id | required
     * @param  [string] format_group | nullable
     * @param  [int] id | nullable
     * @param  [date] date_from | nullable
     * @param  [date] date_to | nullable
     * @param  [string] format_group | nullable | rule ['Y', 'y', 'M', 'm', 'W', 'w', 'D', 'd']
     * @param  [string] order_value_by | nullable | rule ['asc', 'desc']
     * @param  [string] order_date_by | nullable | rule ['asc', 'desc']
     *
     * @return [json] activity->measure
     * @return [json] records
     */

    public function index(GenerateReportApi $request)
    {
        $activity = $this->activityService->getActivityWithMeasure($request->activity_id);

        $records = $this->recordService->getRecordsByReportId($request);

        return response()->json([
            'activity' => $activity,
            'records' => $records
        ]);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecordStoreApi $request)
    {
        $this->recordService->store($request);

        return response()->json([
            "message" => "Record saved successfully!"
        ]);
    }
}
