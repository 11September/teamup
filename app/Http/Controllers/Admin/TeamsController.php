<?php

namespace App\Http\Controllers\Admin;

use App\Services\UserService;
use App\Services\TeamService;
use App\Http\Requests\TeamStore;
use App\Http\Requests\TeamUpdate;
use App\Http\Controllers\Controller;
use App\Team;

class TeamsController extends Controller
{
    protected $teamService;
    protected $userService;

    public function __construct(TeamService $teamService, UserService $userService)
    {
        $this->teamService = $teamService;
        $this->userService = $userService;
    }

    public function index()
    {
        $teams = $this->teamService->index();

        return view('admin.teams.index', compact('teams'));
    }

    public function create()
    {
        $coaches = $this->userService->getAllAvailableCoaches();

        $athlets = $this->userService->getAllAvailableAthlets();

        return view('admin.teams.create', compact('athlets', 'coaches'));
    }

    public function store(TeamStore $request)
    {
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
        $team->load('users');

        $coaches = $this->userService->getAllAvailableCoaches();

        $athlets = $this->userService->getAllAvailableAthlets();

        return view('admin.teams.edit', compact('athlets', 'coaches', 'team'));
    }

    public function update(TeamUpdate $request, Team $team)
    {
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

    public function destroy($id)
    {
        $status = $this->teamService->delete($id);

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
