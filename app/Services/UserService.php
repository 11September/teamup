<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 012 12.03.19
 * Time: 16:31
 */

namespace App\Services;

use App\UserCoach;
use Illuminate\Http\Request;
use App\Helpers\PasswordHelper;
use App\Helpers\SubscribeHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\TeamRepository;
use App\Repositories\UserRepository;

class UserService
{
    public function __construct(UserRepository $user, TeamRepository $team)
    {
        $this->user = $user;
        $this->team = $team;
    }

    protected $status = false;

    public function index()
    {
        if (Auth::user()->type == "coach") {
            $users = $this->user->belongsToCoach();
        } else {
            $users = $this->user->all();
        }

        return $this->addStatusFieldUsers($users);
    }

    public function getUsersInTeam(Request $request)
    {
        $team_id = $request->team_id;

        return $this->user->getAllUsersInTeam($team_id);
    }

    public function getCountCoachAthlets()
    {
        return count($this->user->belongsToCoach());
    }

    public function create(Request $request)
    {
        $attributes = $this->prepareCreateUserData($request);

        $this->status = $this->user->create($attributes);

        if ($this->status && Auth::user()->type == "coach") {

            $user = $this->user->last();

            $userCoach = new UserCoach();
            $userCoach->user_id = $user->id;
            $userCoach->coach_id = Auth::id();
            $userCoach->save();
        }

        return $this->status;
    }

    public function prepareCreateUserData(Request $request)
    {
        $attributes['first_name'] = $request->first_name;
        $attributes['last_name'] = $request->last_name;
        $attributes['email'] = $request->email;
        $attributes['password'] = PasswordHelper::HashPassword($request->password);
        $attributes['type'] = $request->type ? $request->type : "athlete";
        $attributes['number_students'] = $request->number_students ? $request->number_students : 0;
        $attributes['phone'] = $request->phone;
        $attributes['school'] = $request->school;

        if ($request->type == "coach" && $request->activation == "demo") {
            $attributes['activation'] = "demo";
            $attributes['activation_code'] = SubscribeHelper::generateActivationCode();
            $attributes['expiration_date'] = SubscribeHelper::getDateDemoSubscribe();
        }

        if ($request->type == "coach" && $request->activation == "full") {
            $attributes['activation'] = "full";
            $attributes['activation_code'] = $request->activation_code;
            $attributes['expiration_date'] = $request->expiration_date;
        }

        if ($request->type == "athlete" && $request->activation == "full") {
            $attributes['expiration_date'] = SubscribeHelper::getCurrentDate();
            $attributes['activation_code'] = $request->activation_code ? $request->activation_code : SubscribeHelper::generateActivationCode();
        }

        return $attributes;
    }

    public function read($id)
    {
        return $this->user->find($id);
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->all();

        return $this->user->update($id, $attributes);
    }

    public function update_password(Request $request, $id)
    {
        $password = Hash::make($request->password);

        return $this->user->update_field($id, "password", $password);
    }

    public function delete($id)
    {
        if (Auth::user()->type == "coach") {
            $team = $this->team->getFirstTeamByUserId($id);
            $team->users()->detach($id);

            UserCoach::where('user_id', $id)->where('coach_id', Auth::id())->delete();
        }

        return $this->user->delete($id);
    }

    public function addStatusFieldUsers($users)
    {
        foreach ($users as $user) {
            $user->IsActive = SubscribeHelper::IsSubscriber($user);;
        }

        return $users;
    }

    public function getAllAvailableCoaches()
    {
        return $this->user->getAllAvailableCoaches();
    }

    public function getAllAvailableAthlets()
    {
        if (Auth::user()->type == "coach") {
            $athlets = $this->user->belongsToCoach();
        }else{
            $athlets = $this->user->getAllAvailableAthlets();
        }

        return $athlets;
    }
}

