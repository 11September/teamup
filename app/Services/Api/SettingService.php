<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 012 12.03.19
 * Time: 16:31
 */

namespace App\Services\Api;

use Illuminate\Http\Request;
use App\Repositories\SettingRepository;

class SettingService
{
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function settings(Request $request)
    {
        $setting = $this->settingRepository->index();

        return $this->prepareData($setting);
    }

    public function prepareData($setting)
    {
        $setting = collect($setting)->except(
            [
                'id',
                'created_at',
                'updated_at',
            ]
        );

        return $setting;
    }
}
