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

class TeamRepository
{

    protected $team;

    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    public function getAllWithRelationCoach()
    {
        return $this->team->with(array(
                'coach' => function ($query) {
                    $query->select('id', 'first_name', 'last_name');
                })
        )->get();
    }

    public function index()
    {
        return $this->team->all();
    }

    public function first()
    {
        return $this->team->first();
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

