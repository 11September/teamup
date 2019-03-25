<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 013 13.03.19
 * Time: 9:48
 */

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\SettingRepository;

class SettingService{

    public function __construct(SettingRepository $setting)
    {
        $this->setting = $setting;
    }

    public function index()
    {
        return $this->setting->first();
    }

    public function update(Request $request)
    {
        $attributes = $request->except('_token', 'id');

        return $this->setting->updateOrCreate($request->id, $attributes);
    }

}
