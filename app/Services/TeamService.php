<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 012 12.03.19
 * Time: 16:31
 */

namespace App\Services;

use App\Repositories\ActivityRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Repositories\TeamRepository;
use Illuminate\Support\Facades\Auth;

class TeamService
{
    public function __construct(TeamRepository $team, UserRepository $user, ActivityRepository $activity)
    {
        $this->team = $team;
        $this->user = $user;
        $this->activity = $activity;
    }

    public function index()
    {
        if (Auth::user()->type == "coach") {
            $teams = $this->team->getAllCoachesTeamsWithRelation(Auth::id());
        }else{
            $teams = $this->team->getAllWithRelationCoach();
        }

        return $teams;
    }

    public function store(Request $request)
    {
        $attributes = $this->prepareData($request);

        if ($this->team->store($attributes)){

            $team = $this->team->last();
            $team->users()->sync($request->ids, true);

            if ($request->activityIds){
                $this->createDefaultActivitiesToTeam($request, $team);
            }

            return true;
        }else{
            return false;
        }
    }

    public function update(Request $request, $id)
    {
        $attributes = $this->prepareData($request);

        if ($this->team->update($id, $attributes)){
            $team = $this->team->find($id);
            $team->users()->sync($request->ids, true);

            return true;
        }else{
            return false;
        }
    }

    public function prepareData(Request $request)
    {
        $attributes['name'] = $request->name;

        if ($request->code){
            $attributes['code'] = $request->code;
        }

        if ($request->user_id){
            $user = $this->user->find($request->user_id);
            $attributes['user_id'] = $user->id;
            $attributes['count'] = $user->number_students;
        }else{
            $attributes['user_id'] = auth()->id();
            $attributes['count'] = Auth::user()->number_students;
        }

        return $attributes;
    }

    public function createDefaultActivitiesToTeam($request, $team)
    {
        $activities = $this->activity->whereBlankInIds($request->activityIds);

        foreach ($activities as $activity) {
            $attributes = $this->prepareDataCreateNewActivity($activity, $request->user_id, $team->id);
            $this->activity->create($attributes);
        }
    }

    public function prepareDataCreateNewActivity($activity, $user_id, $team_id)
    {
        $attributes['name'] = $activity->name;
        $attributes['measure_id'] = $activity->measure_id;
        $attributes['graph_type'] = $activity->graph_type;
        $attributes['status'] = "default";
        $attributes['user_id'] = $user_id;
        $attributes['team_id'] = $team_id;

        return $attributes;
    }

    public function delete($id)
    {
        $team = $this->team->find($id);

        $team->users()->detach();

        return $this->team->delete($id);
    }
}

