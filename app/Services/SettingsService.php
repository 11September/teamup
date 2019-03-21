<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 012 12.03.19
 * Time: 16:31
 */

namespace App\Services;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\SettingRepository;

class SettingsService
{
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function settings(Request $request)
    {
        try {
            $setting = $this->settingRepository->index();

            return $this->prepareData($setting);

        } catch (\Exception $exception) {
            Log::warning('AuthService@settings Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Упс! Щось пішло не так!'], 500);
        }
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
