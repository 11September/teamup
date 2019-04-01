<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController
{
    public function admin()
    {
        if (Auth::user()->type == "admin"){
            $tabs['users'] = 1;
            $tabs['coaches'] = 1;
            $tabs['feedbacks'] = 1;
            $tabs['reports'] = 1;
        }else{
            $tabs['teams'] = 1;
            $tabs['students'] = 1;
            $tabs['notes'] = 1;
            $tabs['actives'] = 1;
        }

        return view('admin.panel', compact('tabs'));
    }
}
