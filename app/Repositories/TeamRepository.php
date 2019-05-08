<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 013 13.03.19
 * Time: 9:54
 */

namespace App\Repositories;

use App\User;
use App\Team;
use Illuminate\Support\Facades\Auth;

class TeamRepository
{

    protected $team;

    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    public function index()
    {
        return $this->team->all();
    }

    public function getAllCoachTeams()
    {
        return $this->team
            ->where('user_id', Auth::id())
            ->get();
    }

    public function getAllWithRelationCoach()
    {
        return $this->team->with(array(
                'coach' => function ($query) {
                    $query->select('id', 'first_name', 'last_name');
                })
        )->get();
    }

    public function loadUsersToTeams($team)
    {
        $team->load(['users' => function ($query) {
            $query->select('first_name', 'last_name');
        }]);

        return $team;
    }

    public function getFirstTeamByUserId($id)
    {
        return $this->team
            ->whereHas('users', function ($query) use ($id) {
                $query->where('user_id', $id);
            })->first();
    }

    public function getAllCoachesTeamsWithRelation($coach_id)
    {
        return $this->team
            ->where('user_id', $coach_id)
            ->with(['coach' => function ($query) {
                $query->select('id', 'first_name', 'last_name');
            }])
            ->get();
    }

    public function getListUserTeams()
    {
        return $this->team->select('id', 'name')
            ->whereHas('users', function ($query){
                $query->where('user_id', Auth::id());
            })->get();
    }

    public function getListTeamCoach()
    {
        return $this->team->select('id', 'name')->where('user_id', Auth::id())->get();
    }

    public function find($id)
    {
        return $this->team->find($id);
    }

    public function store($attributes)
    {
        return $this->team->create($attributes);
    }

    public function update($id, array $attributes)
    {
        return $this->team->find($id)->update($attributes);
    }

    public function last()
    {
        return $this->team->latest()->first();
    }

    public function delete($id)
    {
        return $this->team->findOrFail($id)->delete();
    }
}

