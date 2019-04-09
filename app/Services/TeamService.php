<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 012 12.03.19
 * Time: 16:31
 */

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Repositories\TeamRepository;
use Illuminate\Support\Facades\Auth;

class TeamService
{
    public function __construct(TeamRepository $team, UserRepository $user)
    {
        $this->team = $team;
        $this->user = $user;
    }

    public function index()
    {
        return $this->team->getAllWithRelationCoach();
    }

    public function store(Request $request)
    {
        $attributes = $this->prepareData($request);

        if ($this->team->store($attributes)){
            $team = $this->team->last();
            $team->users()->sync($request->ids, true);

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
        $attributes['code'] = $request->code;

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

    public function delete($id)
    {
        $team = $this->team->find($id);

        return $this->team->delete($id);
    }
}

