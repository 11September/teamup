<?php

namespace App\Http\Controllers\Admin;

use App\Services\UserService;

class AdminController
{
    protected $userservice;

    public function __construct(UserService $userservice)
    {
        $this->userservice = $userservice;
    }

    public function admin()
    {
        $tabs = $this->userservice->dashboard();

        return view('admin.panel', compact('tabs'));
    }
}
