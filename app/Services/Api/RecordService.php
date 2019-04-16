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
use Illuminate\Support\Facades\Auth;
use App\Repositories\RecordRepository;

class RecordService
{
    public function __construct(RecordRepository $recordRepository)
    {
        $this->recordRepo = $recordRepository;
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
}
