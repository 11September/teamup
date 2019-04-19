<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 013 13.03.19
 * Time: 10:53
 */

namespace App\Services;

use App\Team;
use App\Measure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ActivityRepository;

class ActivityService
{
    public function __construct(ActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    public function index()
    {
        if (auth::user()->type == "coach") {
            return $this->activityRepository->getCoachActivities();
        } elseif (auth::user()->type == "admin") {
            return $this->activityRepository->getAdminActivities();
        }

        return $this->activityRepository->indexWithTeam();
    }

    public function find($id)
    {
        return $this->activityRepository->find($id);
    }

    public function findWithMeasureAndGoal($id)
    {
        return $this->activityRepository->findWithMeasureAndGoal($id);
    }

    public function activityTeam(Request $request)
    {
        return $this->activityRepository->filter($request->all());
    }

    public function blankActivities()
    {
        return $this->activityRepository->getBlankActivities();
    }

    public function getMeasureByActivityId($id)
    {
        $activity = $this->activityRepository->getMeasureByActivityId($id);

        return $activity->measure;
    }

    public function getTeamsList()
    {
        return Team::all();
    }

    public function measures()
    {
        return Measure::select('id', 'name')->orderBy('id', 'ASC')->get();
    }

    public function store(Request $request)
    {
        $attributes = $this->prepareData($request);

        return $this->activityRepository->create($attributes);
    }

    public function update(Request $request)
    {
        $attributes = $this->prepareData($request);

        return $this->activityRepository->update($request->id, $attributes);
    }

    public function delete($id)
    {
        return $this->activityRepository->delete($id);
    }

    public function prepareData(Request $request)
    {
        $attributes['name'] = $request->name;
        $attributes['team_id'] = $request->team_id;
        $attributes['measure_id'] = $request->measure_id;
        $attributes['graph_type'] = $request->graph_type;

        if (Auth::user()->type == "admin") {
            $attributes['status'] = "blank";
        }

        if (Auth::user()->type == "coach") {
            $attributes['status'] = "custom";
        }

        $attributes['user_id'] = Auth::id();

        return $attributes;
    }
}
