<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserStore;
use App\Http\Requests\UserUpdate;
use App\Services\Api\RecordService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdatePassword;

class UsersController extends Controller
{
    protected $userservice;
    protected $recordService;

    public function __construct(UserService $userservice, RecordService $recordService)
    {
        $this->userservice = $userservice;
        $this->recordService = $recordService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $users = $this->recordService->getUserRecords($request);

            return response()->json(['data'=> $users, 'success' => true]);
        }

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
        if (UserHelper::CanCoachCreateNewAthlete()){
            return view('admin.users.create');
        }else{
            return redirect()->back()->with([
                'success' => true,
                'status' => "danger",
                'message' => "You have too many athletes attached. You can not create a new athlete!"
            ], 200);
        }
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
    public function update(UserUpdate $request, User $user)
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
