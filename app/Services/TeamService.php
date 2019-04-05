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
use App\Repositories\TeamRepository;

class TeamService
{
    public function __construct(TeamRepository $team)
    {
        $this->team = $team;
    }

    public function index()
    {
        return true;

//        return $this->user->update_field($id, "password", $password);
    }
}

