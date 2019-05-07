<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 012 12.03.19
 * Time: 15:11
 */

namespace App\Repositories;

use App\User;
use App\UserCoach;
use Illuminate\Support\Facades\Auth;

class UserCoachRepository
{
    protected $userCoach;

    public function __construct(UserCoach $userCoach)
    {
        $this->userCoach = $userCoach;
    }

    public function unbindUser($id)
    {
        return $this->userCoach->where('user_id', $id)->where('coach_id', Auth::id())->delete();
    }

    public function bindUser($id)
    {
        $userCoach = new UserCoach();
        $userCoach->user_id = Auth::id();
        $userCoach->coach_id = $id;
        $userCoach->save();
    }

    public function findAllUserRelationWithAuthCoach($user_id)
    {
        return $this->userCoach->where('user_id', $user_id)->where('coach_id', Auth::id())->get();
    }
}
