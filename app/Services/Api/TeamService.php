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
use App\Repositories\TeamRepository;

class TeamService
{
    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepo = $teamRepository;
    }

    public function index(Request $request)
    {
        return $this->teamRepo->getListTeamCoach();
    }
}
