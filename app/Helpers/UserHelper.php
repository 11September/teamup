<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 021 21.03.19
 * Time: 14:07
 */

namespace App\Helpers;

use Carbon\Carbon;

class UserHelper
{
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
}
