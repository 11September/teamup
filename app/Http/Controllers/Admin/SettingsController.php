<?php

namespace App\Http\Controllers\Admin;

use App\Observers\SettingsObserver;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsStore;

class SettingsController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        return view('admin.settings.index', compact('setting'));
    }

    public function store(SettingsStore $request)
    {
        $setting = Setting::where('id', $request->id);
        $setting->update($request->except('_token'));

        return redirect()->back()
            ->with(['alert-status' => 'success',
                'message' => 'User password successfully changed!'
            ]);
    }
}
