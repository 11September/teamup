<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 012 12.03.19
 * Time: 15:11
 */

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create($attributes)
    {
        return $this->user->create($attributes);
    }

    public function getAllUsersInTeam($team_id)
    {
        return $this->user
            ->select('id', 'first_name', 'last_name')
            ->whereHas('teams', function ($query) use ($team_id) {
                $query->where('team_id', $team_id);
            })
            ->get();
    }

    public function all()
    {
        return $this->user->latest()->get();
    }

    public function last()
    {
        return $this->user->latest()->first();
    }

    public function find($id)
    {
        return $this->user->find($id);
    }

    public function findEmail($email)
    {
        return $this->user->where('email', $email)->first();
    }

    public function findByAttr($attribute, $value)
    {
        return $this->user->where($attribute, $value)->first();
    }

    public function update($id, array $attributes)
    {
        return $this->user->findOrFail($id)->update($attributes);
    }

    public function update_field($id, $field, $attribute)
    {
        return $this->user->findOrFail($id)->update([$field => $attribute]);
    }

    public function delete($id)
    {
        return $this->user->findOrFail($id)->delete();
    }

    public function getAllAvailableCoaches()
    {
        return $this->user
            ->where('type', 'coach')
            ->where('status', 'active')
            ->get();
    }

    public function getAllAvailableAthlets()
    {
        return $this->user
            ->where('type', 'athlete')
            ->where('status', 'active')
            ->get();
    }

    public function belongsToCoach()
    {
        return $this->user
            ->whereHas('belongsToCoach', function ($query) {
                $query->where('coach_id', Auth::id());
            })->get();
    }
}
