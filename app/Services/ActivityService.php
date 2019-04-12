<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 013 13.03.19
 * Time: 10:53
 */

namespace App\Services;

use App\Measure;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ActivityRepository;

class ActivityService
{
    public function __construct(ActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    public function index()
    {
        if (auth::user()->type == "coach"){
            return $this->activityRepository->getCoachActivities();
        }

        return $this->activityRepository->indexWithTeam();
    }

    public function blankActivities()
    {
        return $this->activityRepository->getBlankActivities();
    }

    public function getTeamsList()
    {
        return Team::all();
    }

    public function measures()
    {
        return Measure::select('id', 'name')->orderBy('id', 'ASC')->get();
    }

    public function store(Request $request)
    {
        $attributes = $this->prepareData($request);

        return $this->activityRepository->create($attributes);
    }

    public function update(Request $request)
    {
        $attributes = $this->prepareData($request);

        return $this->activityRepository->update($request->Id, $attributes);
    }


    public function delete($id)
    {
        return $this->activityRepository->delete($id);
    }

    public function prepareData(Request $request)
    {
        $attributes['name'] = $request->Name;
        $attributes['measure_id'] = $request->Units;
        $attributes['graph_type'] = $request->Graphtype;
        $attributes['graph_color'] = $request->Colors;
        $attributes['user_id'] = Auth::id();

        return $attributes;
    }
}
