<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 020 20.03.19
 * Time: 10:32
 */

namespace App\Helpers;

use Carbon\Carbon;

class SubscribeHelper
{
    public static function calculateDaysLeft($dateEnd)
    {
        $now = Carbon::now();
        $end = Carbon::parse($dateEnd);
        $left = $now->diffInDays($end);

        return $left;
    }
}
