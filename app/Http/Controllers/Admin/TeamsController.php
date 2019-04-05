<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\TeamService;
use App\Http\Controllers\Controller;

class TeamsController extends Controller
{
    protected $teamService;

    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
    }

    public function index()
    {
        $teams = $this->teamService->index();

        return view('admin.teams.index', compact('teams'));
    }
}
