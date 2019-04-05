<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 013 13.03.19
 * Time: 9:54
 */

namespace App\Repositories;

use App\Team;

class TeamRepository{

    protected $team;

    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    public function index()
    {
        return $this->team->first();
    }

    public function first()
    {
        return $this->team->first();
    }

    public function find($id)
    {
        return $this->team->find($id);
    }
}
