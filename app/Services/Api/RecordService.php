<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 013 13.03.19
 * Time: 10:53
 */

namespace App\Services\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\RecordRepository;
use App\Repositories\ActivityRepository;

class RecordService
{
    public function __construct(RecordRepository $recordRepository, ActivityRepository $activityRepository)
    {
        $this->recordRepo = $recordRepository;
        $this->activityRepo = $activityRepository;
    }

    public function getUserRecords(Request $request)
    {
        $user_id = $request->user_id;
        $records = $this->recordRepo->getUsersRecords($user_id);

        $RecordsIds = array();
        foreach ($records as $record) {
            $RecordsIds[] = $record->activity_id;
        }

        return $this->activityRepo->getActivitiesIds($RecordsIds);
    }

    public function index()
    {
        return $this->recordRepo->all();
    }

    public function getRecordsByReportId(Request $request)
    {
        $request = $this->checkValidDataFilter($request);

        return $this->recordRepo->getUsersRecordsToReportApi($request);
    }

    public function store(Request $request)
    {
        $attributes = $this->prepareData($request);

        return $this->recordRepo->create($attributes);
    }

    public function update(Request $request, $id)
    {
        $attributes = $this->prepareData($request);

        return $this->recordRepo->update($id, $attributes);
    }

    public function prepareData(Request $request)
    {
        $attributes['activity_id'] = $request->activity_id;
        $attributes['user_id'] = $request->user_id;
        $attributes['value'] = $request->value;
        $attributes['date'] = Carbon::now()->format('Y-m-d');
        $attributes['notice'] = $request->notice;

        return $attributes;
    }

    public function checkValidDataFilter(Request $request)
    {
        $now = Carbon::now();
        $to = Carbon::now();
        $subYear = $to->subYear();

        if ($request->date_from && $request->date_to) {
            if (!$request->date_from instanceof Carbon) {
                $date_from = Carbon::createFromFormat('Y-m-d', $request->date_from);
            } else {
                $date_from = $request->date_from;
            }

            if (!$request->date_to instanceof Carbon) {
                $date_to = Carbon::createFromFormat('Y-m-d', $request->date_to);
            } else {
                $date_to = $request->date_to;
            }

            if ($date_from > $date_to || $date_to < $date_from) {
                $request->merge(['date_from' => $subYear]);
                $request->merge(['date_to' => $now]);
            }
        }

        return $request;
    }
}
