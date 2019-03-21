<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 021 21.03.19
 * Time: 14:07
 */

namespace App\Helpers;


class UserHelper
{
    public static function isActive($user)
    {
        if ($user->status != "active"){
            return false;
        }

        return true;
    }
}
