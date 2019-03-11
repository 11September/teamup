<?php

namespace App\Observers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsObserver
{
    public function saving(Setting $setting, $data)
    {
        $setting->type_graph_straight = $data->type_graph_straight;
        $setting->type_graph_reverse = $data->type_graph_reverse;
        $setting->privacy_policy = $data->privacy_policy;
        $setting->default_units = $data->default_units;
    }
}
