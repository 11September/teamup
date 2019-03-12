<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserStore;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdatePassword;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $userservice;

    public function __construct(UserService $userservice)
    {
        $this->userservice = $userservice;
    }

    public function index()
    {
        $users = $this->userservice->index();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStore $request)
    {
        $this->userservice->create($request);

        return redirect()->action('Admin\UsersController@index')
            ->with(['alert-status' => 'success',
                'message' => 'Користувач успішно доданий! Перевiрте пошту!'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = $this->userservice->update($request, $user->id);

        return redirect()->action('Admin\UsersController@index')
            ->with(['alert-status' => 'success',
                'message' => 'User password successfully changed!'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userservice->delete($id);

        return redirect()->action('Admin\UsersController@index')
            ->with(['alert-status' => 'success',
                'message' => 'User password successfully changed!'
            ]);
    }


    public function reset_password(User $user)
    {
        return view('admin.users.reset-password', compact('user'));
    }


    public function update_password(UserUpdatePassword $request, $id)
    {
        $this->userservice->update_password($request, $id);

        return redirect()->action('Admin\UsersController@index')
            ->with(['alert-status' => 'success',
                'message' => 'User password successfully changed!'
            ]);
    }
}
