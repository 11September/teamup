<?php

namespace App\Http\Controllers\Admin;

use App\Services\ActivityService;
use App\Http\Requests\ActivityStore;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityUpdate;

class ActivitiesController extends Controller
{
    protected $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = $this->activityService->index();

        $measures = $this->activityService->measures();

        return view('admin.activities.index', compact('activities', 'measures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivityStore $request)
    {
        $activity = $this->activityService->store($request);

        return response()->json(['data' => $activity, 'success' => true, 'text' => 'Activity is successfully added!']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActivityUpdate $request, $id)
    {
        $activity = $this->activityService->update($request);

        return response()->json(['data' => $activity, 'success' => true, 'text' => 'Activity is successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activity = $this->activityService->delete($id);

        return response()->json(['data' => $activity, 'success' => true, 'text' => 'Activity is successfully deleted!']);
    }
}
