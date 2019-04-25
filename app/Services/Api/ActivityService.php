<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 013 13.03.19
 * Time: 10:53
 */

namespace App\Services\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\TeamRepository;
use App\Repositories\ActivityRepository;

class ActivityService
{
    public function __construct(ActivityRepository $activityRepository, TeamRepository $teamRepository)
    {
        $this->activityRepository = $activityRepository;
        $this->teamRepository = $teamRepository;
    }

    public function filter(Request $request)
    {
        $attributes = $request->all();

        return $this->activityRepository->filterWithUsers($attributes);
    }

    public function findWithMeasureAndGoal($id)
    {
        return $this->activityRepository->findWithMeasureAndGoal($id);
    }

    public function getMeasureByActivityId($id)
    {
        $activity = $this->activityRepository->getMeasureByActivityId($id);

        return $activity->measure;
    }

    public function store(Request $request)
    {
        $attributes = $this->prepareData($request);

        $teams = $this->teamRepository->getAllCoachesTeamsWithRelation(Auth::id());

        if (count($teams) >= 1){
            foreach ($teams as $team) {
                $attributes['team_id'] = $team->id;

                $this->activityRepository->create($attributes);
            }
        }else{
            $this->activityRepository->create($attributes);
        }
    }

    public function update(Request $request, $id)
    {
        $attributes = $this->prepareData($request);

        return $this->activityRepository->update($id, $attributes);
    }

    public function prepareData(Request $request)
    {
        $attributes['name'] = $request->name;
        $attributes['measure_id'] = $request->unit_id;
        $attributes['graph_type'] = $request->graphtype;

        return $attributes;
    }
}
