<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 012 12.03.19
 * Time: 16:31
 */

namespace App\Services\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ActivityGoalRepository;

class ActivityGoalService
{
    public function __construct(ActivityGoalRepository $activityGoalRepository)
    {
        $this->activityGoalRepository = $activityGoalRepository;
    }

    public function store(Request $request)
    {
        $attributes = $this->prepareData($request);

        $this->activityGoalRepository->create($attributes);

        return $this->activityGoalRepository->lastWithNeedFields(['id', 'goal']);
    }

    public function update(Request $request)
    {
        $this->activityGoalRepository->update_field($request->id, 'goal', $request->goal);

        return $this->activityGoalRepository->findWithCustomFileds($request->id, ['id', 'goal']);

    }

    public function prepareData($request)
    {
        $attributes['activity_id'] = $request->activity_id;
        $attributes['user_id'] = Auth::id();
        $attributes['goal'] = $request->goal;

        return $attributes;
    }
}
