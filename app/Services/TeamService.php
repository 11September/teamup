<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 012 12.03.19
 * Time: 16:31
 */

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use App\Repositories\TeamRepository;
use App\Repositories\ActivityRepository;

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

        $teams = $this->team->loadUsersToTeams($teams);

        $teams = $this->addBusyAthlets($teams);

        return $teams;
    }

    public function reportIndex()
    {
        if (Auth::user()->type == "coach") {
            $teams = $this->team->getAllCoachTeams();
        }else {
            $teams = $this->team->index();
        }

        $teams->first()->load('users');

        return $teams;
    }

    public function store(Request $request)
    {
        $attributes = $this->prepareData($request);

        $array[0] = $request->user_id;
        $result = array_merge($array, $request->ids);

        if ($this->team->store($attributes)){
            $team = $this->team->last();
            $team->users()->sync($result, true);

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

    public function addBusyAthlets($teams)
    {
        foreach ($teams as $team) {
            if ($team->users){
                $team->count_busy = $team->users->count();
            }else{
                $team->count_busy = 0;
            }
        }

        return $teams;
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

