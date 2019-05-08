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
use App\User;
use App\Measure;
use App\Activity;
use Carbon\Carbon;
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

        if ($request->team_id == "null") {
            $activities = $this->prepareDefaultActivitiesForCoachSave($request);

            Activity::insert($activities);
        }

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

        if (Auth::user()->type == "admin" && $request->team_id == "null") {
            $attributes['team_id'] = null;
        }

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

    public function prepareDefaultActivitiesForCoachSave(Request $request)
    {
        $coaches = User::select('id')->where('type', 'coach')->get();

        $coachesIds = $coaches->pluck('id')->toArray();
        $data = array();

        $now = Carbon::now();

        $i = 0;
        foreach ($coachesIds as $coachId) {
            $teams = Team::select('id', 'user_id')->where('user_id', $coachId)->get();

            foreach ($teams as $team) {
                $data[$i] =
                    [
                        'name' => $request->name,
                        'team_id' => $team->id,
                        'measure_id' => $request->measure_id,
                        'graph_type' => $request->graph_type,
                        'status' => 'default',
                        'user_id' => $coachId,
                        'created_at' => $now,
                        'updated_at' => $now
                    ];
                $i++;
            }
        }

        return $data;
    }
}
