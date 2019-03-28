<?php

namespace App\Http\Controllers\Admin;

use App\Services\SettingService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsStore;

class SettingsController extends Controller
{
    protected $settingSerive;

    public function __construct(SettingService $userservice)
    {
        $this->settingSerive = $userservice;
    }


    /**
     * index
     *
     * @param  int  $id
     * @return ['view']
     */
    public function index()
    {
        $setting = $this->settingSerive->index();

        return view('admin.settings.index', compact('setting'));
    }


    /**
     * store
     *
     * @param  int  $id
     * @return "redirect"
     */
    public function store(SettingsStore $request)
    {
        $status = $this->settingSerive->update($request);

        return redirect()->back()
            ->with([
                'success' => $status,
                'status' => $status
                    ? "success"
                    : "danger",
                'message' => $status
                    ? "Settings saved successfully!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ], 200);
    }
}
