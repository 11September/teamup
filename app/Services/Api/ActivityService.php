<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 013 13.03.19
 * Time: 10:53
 */

namespace App\Services\Api;

use App\Record;
use App\TeamUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\TeamRepository;
use App\Repositories\RecordRepository;
use App\Repositories\ActivityRepository;

class ActivityService
{
    public function __construct(ActivityRepository $activityRepository, TeamRepository $teamRepository, RecordRepository $recordRepository)
    {
        $this->activityRepository = $activityRepository;
        $this->teamRepository = $teamRepository;
        $this->recordRepository = $recordRepository;
    }

    public function userStats($id)
    {
        $teams = TeamUser::where('user_id', $id)->get();
        $teamsIds = $teams->pluck('team_id')->toArray();

        $activities = $this->activityRepository->getAllActivitiesByTeamIdsAndCoachId($teamsIds);

        $activities = $this->prepareActivitiesToUserStats($activities, $id);

        return $activities;
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
        $attributes['user_id'] = Auth::id();

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
        $attributes['status'] = "custom";

        return $attributes;
    }

    public function prepareActivitiesToUserStats($activities, $id)
    {
        foreach ($activities as $activity) {
            $record = Record::where('activity_id', $activity->id)
                ->select('value')
                ->where('user_id', $id)
                ->orderBy('value', $activity->graph_type == "straight" ? "desc" : "asc")
                ->first();

            unset($activity->graph_type);
            $activity->record = isset($record->value) ? $record->value : null;
        }

        return $activities;
    }
}
