<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 021 21.03.19
 * Time: 14:07
 */

namespace App\Helpers;

use App\User;
use Carbon\Carbon;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserHelper
{
    public static function CanCoachCreateNewAthlete()
    {
        if (Auth::user()->type == "coach") {
            $userRepo = new UserRepository(new User());
            $count = count($userRepo->belongsToCoach());

            if ($count < Auth::user()->number_students){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }

    public static function isActive($user)
    {
        if ($user->status != "active"){
            return false;
        }

        return true;
    }

    public static function getCurrentDate()
    {
        return Carbon::now()->format('Y-m-d');
    }

    public static function getCurrentDateFormat($format = "Y-m-d")
    {
        return Carbon::now()->format($format);
    }

    public static function checkPermission($entity)
    {
        if (Auth::user()->type == "admin"){
            return true;
        }else{
            if (isset($entity->user_id) && $entity->user_id == Auth::id()){
                return true;
            }
        }

        abort(403, 'Forbidden');
    }

    public static function checkPermissionOwnerReport($entity)
    {
        if (Auth::user()->type == "admin"){
            return true;
        }else{
            if (isset($entity->owner_id) && $entity->owner_id == Auth::id()){
                return true;
            }
        }

        abort(403, 'Forbidden');
    }
}
