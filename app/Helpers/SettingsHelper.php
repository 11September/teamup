<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 021 21.03.19
 * Time: 14:07
 */


namespace App\Helpers;

use App\Setting;

class SettingsHelper
{
    public static function graphSettings()
    {
        return Setting::select('type_graph_straight', 'type_graph_reverse')->first();
    }
}
