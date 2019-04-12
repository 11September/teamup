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
use Illuminate\Support\Str;

class SubscribeHelper
{
    public static function getDateDemoSubscribe()
    {
        return Carbon::now()->addMonths(1)->toDateString();
    }

    public static function getCurrentDate()
    {
        return Carbon::now()->format('Y-m-d');
    }

    public static function SubscribeActive($expiredDate)
    {
        new Carbon($expiredDate);
        $now = Carbon::now();

        if ($expiredDate >= $now) {
            return true;
        } else {
            return false;
        }
    }

    public static function calculateDaysLeft($dateEnd)
    {
        $now = Carbon::now();
        $end = Carbon::parse($dateEnd);
        $left = $now->diffInDays($end);

        return $left;
    }

    public static function calculateHoursLeft($dateEnd)
    {
        $now = Carbon::now();
        $end = Carbon::parse($dateEnd);
        $leftHours = $now->diffInHours($end);

        return $leftHours;
    }

    public static function IsSubscriber($user)
    {
        if ($user->type == "coach"){
            if ($user->activation == "expired"){
                return false;
            }else{
                $SubscribeActive = self::SubscribeActive($user->expiration_date);

                if ($user->activation != "expired" && !$SubscribeActive){
                    return false;
                }
            }
        }

        return true;
    }

    public static function generateActivationCode()
    {
        try {
            return bin2hex(random_bytes(10));
        } catch (\Exception $e) {
            return Str::random(20);
        }
    }
}
