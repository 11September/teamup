<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 018 18.04.19
 * Time: 14:56
 */

namespace App\Helpers;


class GrapHelper
{
    public static $graph_type;

    public static function convertActivityTypeToQuery($type)
    {
        if ($type == "straight"){
            self::$graph_type = "asc";
        }
        elseif ($type == "reverse"){
            self::$graph_type = "desc";
        }else{
            self::$graph_type = "asc";
        }

        return self::$graph_type;
    }
}
