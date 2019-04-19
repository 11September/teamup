<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\GoalStore;
use App\Http\Requests\GoalUpdate;
use App\Http\Controllers\Controller;
use App\Services\Api\ActivityGoalService;


class GoalsController extends Controller
{
    protected $activityGoalService;

    public function __construct(ActivityGoalService $activityGoalService)
    {
        $this->activityGoalService = $activityGoalService;
    }

    public function store(GoalStore $request)
    {
        $goal = $this->activityGoalService->store($request);

        return response()->json([
            'message' => "Athlete target successfully set!",
            'data' => $goal
        ], 200);
    }

    public function update(GoalUpdate $request)
    {
        $goal = $this->activityGoalService->update($request);

        return response()->json([
            'message' => "Athlete target successfully updated!",
            'data' => $goal
        ], 200);
    }
}
