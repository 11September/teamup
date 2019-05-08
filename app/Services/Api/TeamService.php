<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 013 13.03.19
 * Time: 10:53
 */

namespace App\Services\Api;

use App\User;
use Illuminate\Http\Request;
use App\Repositories\TeamRepository;

class TeamService
{
    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepo = $teamRepository;
    }

    public function index(Request $request)
    {
        return $this->teamRepo->getListTeamCoachWithActivities();
    }

    public function athletsTeam($id)
    {
        return User::select('id', 'first_name', 'last_name')
            ->whereHas('teams', function ($query) use ($id) {
                $query->where('team_id', $id);
            })->get();
    }
}
