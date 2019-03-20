<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use Illuminate\Http\Request;
use App\Services\SettingService;
use App\Observers\SettingsObserver;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsStore;

class SettingsController extends Controller
{
    protected $settingSerive;

    public function __construct(SettingService $userservice)
    {
        $this->settingSerive = $userservice;
    }

    public function index()
    {
        $setting = $this->settingSerive->index();

        return view('admin.settings.index', compact('setting'));
    }

    public function store(SettingsStore $request)
    {
        $setting = $this->settingSerive->update($request, $request->id);

        return redirect()->back()
            ->with(['alert-status' => 'success',
                'message' => 'Settings saved successfully!',
                'setting' => $setting
            ]);
    }
}
