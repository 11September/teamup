<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 012 12.03.19
 * Time: 16:31
 */

namespace App\Services;

use App\Note;
use App\Team;
use App\User;
use App\Record;
use App\Report;
use App\Measure;
use App\Activity;
use App\Feedback;
use App\UserCoach;
use Illuminate\Http\Request;
use App\Helpers\PasswordHelper;
use App\Helpers\SubscribeHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\TeamRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserCoachRepository;

class UserService
{
    public function __construct(UserRepository $user, TeamRepository $team, UserCoachRepository $userCoach)
    {
        $this->user = $user;
        $this->team = $team;
        $this->userCoach = $userCoach;
    }

    protected $status = false;

    public function dashboard()
    {
        if (Auth::user()->type == "admin"){
            $tabs['users'] = User::where('type', 'athlete')->count();
            $tabs['measures'] = Measure::count();
            $tabs['teams'] = Team::count();
            $tabs['reports'] = Report::count();
            $tabs['actives'] = Activity::where('status', 'custom')->count();
            $tabs['feedbacks'] = Feedback::count();
        }else{
            $tabs['teams'] = Team::where('user_id', Auth::id())->count();
            $tabs['students'] = UserCoach::where('coach_id', Auth::id())->count();
            $tabs['notes'] = Note::where('user_id', Auth::id())->count();
            $tabs['actives'] = Activity::where('user_id', Auth::id())->count();
        }

        return $tabs;
    }

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
            $this->status = $this->createNewRelationUserCoachByEmail($request->email);
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

        if ($request->type == "admin") {
            $attributes['expiration_date'] = SubscribeHelper::getCurrentDate();
            $attributes['activation_code'] = $request->activation_code ? $request->activation_code : SubscribeHelper::generateActivationCode();
        }

        return $attributes;
    }

    public function createNewRelationUserCoachByEmail($email)
    {
        $user = $this->user->findByAttr('email', $email);

        $userCoach = new UserCoach();
        $userCoach->user_id = $user->id;
        $userCoach->coach_id = Auth::id();
        return $userCoach->save();
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
        $user = $this->user->find($id);

        $this->deleteRelationsUser($user);

        $user->teams()->detach();

        $this->userCoach->unbindUser($id);

        return $this->user->delete($id);
    }

    public function deleteRelationsUser($user)
    {
        if (Auth::user()->type == "admin"){
            $teams = $user->teams()->get();
            $teamsIds = $teams->pluck('id')->toArray();
        }else{
            $teamsIds = array();
            $teams = $user->teams()->get();
            foreach ($teams as $team) {
                if ($team->user_id == Auth::id()){
                    $teamsIds[] = $team->id;
                }
            }
        }

        $activities = Activity::select('id')->whereIn('team_id', $teamsIds)->get();
        $activitiesIds = $activities->pluck('id')->toArray();

        Record::where('user_id', $user->id)->whereIn('activity_id', $activitiesIds)->delete();
        Report::where('user_id', $user->id)->delete();

        $user->goal()->delete();

        Feedback::where('user_id', $user->id)->delete();
        Note::where('user_id', $user->id)->delete();
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
        } else {
            $athlets = $this->user->getAllAvailableAthlets();
        }

        return $athlets;
    }
}

