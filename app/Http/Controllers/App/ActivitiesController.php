<?php

namespace App\Http\Controllers\App;

use App\Activity;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Services\TeamService;
use App\Helpers\SettingsHelper;
use App\Http\Controllers\Controller;
use App\Services\Api\MeasureService;
use App\Services\Api\ActivityService;
use App\Http\Requests\ActivityStoreApi;
use App\Http\Requests\ActivityUpdateApi;

class ActivitiesController extends Controller
{
    protected $activityService;
    protected $measureService;
    protected $teamService;

    public function __construct(ActivityService $activityService, MeasureService $measureService, TeamService $teamService)
    {
        $this->activityService = $activityService;
        $this->measureService = $measureService;
        $this->teamService = $teamService;
    }


    public function index(Request $request)
    {
        $activities = $this->activityService->filter($request);

        return response()->json([
            'data' => $activities,
        ], 202);
    }


    public function userStats($id)
    {
        $activities = $this->activityService->userStats($id);

        return response()->json([
            'data' => $activities,
        ], 202);
    }


    /**
     * Create new Acticvity in Application
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $measures = $this->measureService->index();

        $graphSettingsTips = SettingsHelper::graphSettings();

        return response()->json(
            [
                'data' => array(
                    'typeGraph' => ['straight', 'reverse'],
                    'typeGraphTipStraight' => isset($graphSettingsTips->type_graph_straight) ? $graphSettingsTips->type_graph_straight : null,
                    'typeGraphTipReverse' => isset($graphSettingsTips->type_graph_reverse) ? $graphSettingsTips->type_graph_reverse : null,
                    'measures' => $measures,
                )
            ],
            200
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivityStoreApi $request)
    {
        $this->activityService->store($request);

        return response()->json([
            "message" => "Exercise saved successfully!"
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        UserHelper::checkPermission($activity);

        $measures = $this->measureService->index();

        $graphSettingsTips = SettingsHelper::graphSettings();

        return response()->json(
            [
                'activity' => $activity,
                'data' => array(
                    'typeGraph' => ['straight', 'reverse'],
                    'typeGraphTips' => [$graphSettingsTips->type_graph_straight, $graphSettingsTips->type_graph_reverse],
                    'measures' => $measures,
                )
            ],
            200
        );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActivityUpdateApi $request, Activity $activity)
    {
        UserHelper::checkPermission($activity);

        $status = $this->activityService->update($request, $activity->id);

        return response()->json(
            [
                'success' => $status,
                'message' => $status

                    ? "Activity is successfully updated!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ],
            200
        );
    }
}
