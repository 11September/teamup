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
use Illuminate\Support\Facades\Log;

class SettingsService
{
    public function settings()
    {
        try {
            return Setting::first();

        } catch (\Exception $exception) {
            Log::warning('AuthService@settings Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Упс! Щось пішло не так!'], 500);
        }
    }
}
