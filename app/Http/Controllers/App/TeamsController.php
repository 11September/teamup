<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Services\Api\TeamService;
use App\Http\Controllers\Controller;

class TeamsController extends Controller
{
    protected $teamService;

    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teams = $this->teamService->index($request);

        return response()->json([
            "data" => $teams
        ]);
    }
}
