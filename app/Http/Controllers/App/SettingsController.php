<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Services\SettingsService;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    protected $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function index(Request $request)
    {
        $settings = $this->settingsService->settings($request);

        return response()->json([
            'data' => $settings
        ]);
    }
}
