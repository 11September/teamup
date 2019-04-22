<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 018 18.04.19
 * Time: 14:56
 */

namespace App\Helpers;


use Carbon\Carbon;

class GraphHelper
{
    public static $graph_type;
    public static $graph_format;
    public static $start_date;
    public static $end_date;

    public static function convertActivityTypeToQuery($type)
    {
        if ($type == "straight") {
            self::$graph_type = "asc";
        } elseif ($type == "reverse") {
            self::$graph_type = "desc";
        } else {
            self::$graph_type = "asc";
        }

        return self::$graph_type;
    }

    public static function convertActivityRangeToFormat($type)
    {
        if ($type == "week") {
            self::$graph_format = "D";
        }
        elseif ($type == "month") {
//            self::$graph_format = "M d";
            self::$graph_format = "M d";
        }
        else {
            self::$graph_format = 'M';
        }

        return self::$graph_format;
    }

    public static function detectStartDate($type)
    {
        if ($type == "week") {
            $now = Carbon::now();
            self::$start_date = $now->subWeek();
        }
        elseif ($type == "month") {
            $now = Carbon::now();
            self::$start_date = $now->subMonths();
        }
        elseif ($type == "year"){
            $now = Carbon::now();
            self::$start_date = $now->subYear();
        }
        else {
            $now = Carbon::now();
            self::$start_date = $now->subYear();
        }

        return self::$start_date;
    }

    public static function detectEndDate($type)
    {
        if ($type == "week") {
            self::$end_date = Carbon::now();
        } elseif ($type == "month") {
            self::$end_date = Carbon::now();
        } else {
            self::$end_date = Carbon::now();
        }

        return self::$end_date;
    }
}
