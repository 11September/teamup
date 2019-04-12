<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserStore;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdatePassword;

class UsersController extends Controller
{
    protected $userservice;

    public function __construct(UserService $userservice)
    {
        $this->userservice = $userservice;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $status = $this->userservice->create($request);

        return redirect()->action('Admin\UsersController@index')
            ->with([
                'success' => $status,
                'status' => $status
                    ? "success"
                    : "danger",
                'message' => $status
                    ? "User successfully added!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ], 200);
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
        $status = $this->userservice->update($request, $user->id);

        return redirect()->action('Admin\UsersController@index')
            ->with([
                'success' => $status,
                'status' => $status
                    ? "success"
                    : "danger",
                'message' => $status
                    ? "User password successfully updated!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = $this->userservice->delete($id);

        return redirect()->action('Admin\UsersController@index')
            ->with([
                'success' => $status,
                'status' => $status
                    ? "success"
                    : "danger",
                'message' => $status
                    ? "User password successfully deleted!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ], 200);
    }


    /**
     * reset_password
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reset_password(User $user)
    {
        return view('admin.users.reset-password', compact('user'));
    }


    /**
     * update_password
     *
     * @param  string  $password-old
     * @param  string  $password
     * @param  string  $password-confirmation
     *
     * @return \Illuminate\Http\Response
     */
    public function update_password(UserUpdatePassword $request, $id)
    {
        $status = $this->userservice->update_password($request, $id);

        return redirect()->action('Admin\UsersController@index')
            ->with([
                'success' => $status,
                'status' => $status
                    ? "success"
                    : "danger",
                'message' => $status
                    ? "User password successfully changed!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ], 200);
    }
}
