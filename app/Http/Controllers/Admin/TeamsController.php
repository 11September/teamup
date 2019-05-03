<?php

namespace App\Http\Controllers\Admin;

use App\Team;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\TeamService;
use App\Http\Requests\TeamStore;
use App\Http\Requests\TeamUpdate;
use App\Services\ActivityService;
use App\Http\Controllers\Controller;

class TeamsController extends Controller
{
    protected $teamService;
    protected $userService;
    protected $activityService;

    public function __construct(TeamService $teamService, UserService $userService, ActivityService $activityService)
    {
        $this->teamService = $teamService;
        $this->userService = $userService;
        $this->activityService = $activityService;
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $users = $this->userService->getUsersInTeam($request);

            return response()->json(['data'=> $users, 'success' => true]);
        }

        $teams = $this->teamService->index();

        return view('admin.teams.index', compact('teams'));
    }

    public function create()
    {
        $coaches = $this->userService->getAllAvailableCoaches();

        $athlets = $this->userService->getAllAvailableAthlets();

        $activities = $this->activityService->blankActivities();

        return view('admin.teams.create', compact('athlets', 'coaches', 'activities'));
    }

    public function store(TeamStore $request)
    {
        $status = UserHelper::CanCoachAddNewAthletesToTeam($request->user_id, $request->ids);

        if (!$status['status']){
            $number_students = $status['number_students'];
            $busy_students = $status['busy_students'];
            $available_students = $status['available_students'];
            $want_add_students = $status['want_add_students'];
            $returnSelectedAthletsIds = $request->ids;
            $returnSelectedActivitiesIds = $request->activityIds;

            return redirect()->back()
                ->with([
                    'success' => $status['status'],
                    'status' => 'danger',
                    'SelectedAthletsIds' => $returnSelectedAthletsIds,
                    'SelectedAthletsIdsError' => "Please reduce the number of selected athletes.",
                    'SelectedActivitiesIds' => $returnSelectedActivitiesIds,
                    'message' => "Exceeded the limit of free athletes. You cannot tie too many athletes to this user. 
                    The number of possible athletes - $number_students, available - $available_students, busy - $busy_students and you want to add - $want_add_students"
                ], 200);
        }

        $status = $this->teamService->store($request);

        return redirect()->action('Admin\TeamsController@index')
            ->with([
                'success' => $status,
                'status' => $status
                    ? "success"
                    : "danger",
                'message' => $status
                    ? "The team has been successfully added!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ], 200);
    }

    public function edit(Team $team)
    {
        UserHelper::checkPermission($team);

        $team->load('users');

        $coaches = $this->userService->getAllAvailableCoaches();

        $athlets = $this->userService->getAllAvailableAthlets();

        return view('admin.teams.edit', compact('athlets', 'coaches', 'team'));
    }

    public function update(TeamUpdate $request, Team $team)
    {
        $status = UserHelper::CanCoachAddNewAthletesToTeam($request->user_id, $request->ids);

        if (!$status['status']){
            $number_students = $status['number_students'];
            $busy_students = $status['busy_students'];
            $available_students = $status['available_students'];
            $want_add_students = $status['want_add_students'];
            $returnSelectedAthletsIds = $request->ids;
            $returnSelectedActivitiesIds = $request->activityIds;

            return redirect()->back()
                ->with([
                    'success' => $status['status'],
                    'status' => 'danger',
                    'SelectedAthletsIds' => $returnSelectedAthletsIds,
                    'SelectedAthletsIdsError' => "Please reduce the number of selected athletes.",
                    'SelectedActivitiesIds' => $returnSelectedActivitiesIds,
                    'message' => "Exceeded the limit of free athletes. You cannot tie too many athletes to this user. 
                    The number of possible athletes - $number_students, available - $available_students, busy - $busy_students and you want to add - $want_add_students"
                ], 200);
        }

        $status = $this->teamService->update($request, $team->id);

        return redirect()->action('Admin\TeamsController@edit', $team)
            ->with([
                'success' => $status,
                'status' => $status
                    ? "success"
                    : "danger",
                'message' => $status
                    ? "The team has been successfully added!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ], 200);
    }

    public function destroy(Team $team)
    {
        $status = $this->teamService->delete($team->id);

        return redirect()->action('Admin\TeamsController@index')
            ->with([
                'success' => $status,
                'status' => $status
                    ? "success"
                    : "danger",
                'message' => $status
                    ? "Team successfully deleted!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ], 200);
    }
}
