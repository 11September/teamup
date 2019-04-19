<?php

namespace App\Http\Controllers\Admin;

use App\Activity;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Services\ActivityService;
use App\Services\Api\MeasureService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityStore;
use App\Http\Requests\ActivityUpdate;

class ActivitiesController extends Controller
{
    protected $activityService;
    protected $measureService;

    public function __construct(ActivityService $activityService, MeasureService $measureService)
    {
        $this->activityService = $activityService;
        $this->measureService = $measureService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $activities = $this->activityService->activityTeam($request);

            return response()->json([ 'data'=> $activities, 'success' => true]);
        }

        $activities = $this->activityService->index();

        $teams = $this->activityService->getTeamsList();

        $measures = $this->activityService->measures();

        return view('admin.activities.index', compact('activities', 'measures', 'teams'));
    }


    /**
     * Create exercise.
     *
     * @return ['view']
     */

    public function create()
    {
        $teams = $this->activityService->getTeamsList();

        $measures = $this->activityService->measures();

        return view('admin.activities.create', compact('activities', 'measures', 'teams'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivityStore $request)
    {
        $status = $this->activityService->store($request);

        return redirect()->action('Admin\ActivitiesController@index')
            ->with([
                'success' => $status,
                'status' => $status
                    ? "success"
                    : "danger",
                'message' => $status
                    ? "Exercise successfully added!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ], 200);
    }


    public function edit(Activity $activity)
    {
        UserHelper::checkPermission($activity);

        $teams = $this->activityService->getTeamsList();

        $measures = $this->measureService->index();

        return view('admin.activities.edit', compact('activity', 'measures', 'teams'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActivityUpdate $request, Activity $activity)
    {
        UserHelper::checkPermission($activity);

        $status = $this->activityService->update($request);

        return redirect()->action('Admin\ActivitiesController@index')
            ->with([
                'success' => $status,
                'status' => $status
                    ? "success"
                    : "danger",
                'message' => $status
                    ? "Exercise successfully updated!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        UserHelper::checkPermission($activity);

        $status = $this->activityService->delete($activity->id);

        return redirect()->action('Admin\ActivitiesController@index')
            ->with([
                'success' => $status,
                'status' => $status
                    ? "success"
                    : "danger",
                'message' => $status
                    ? "Exercise successfully deleted!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ], 200);
    }
}
