<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 012 12.03.19
 * Time: 15:11
 */

namespace App\Repositories;

use App\Activity;
use Illuminate\Support\Facades\Auth;

class ActivityRepository
{

    protected $activity;

    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
    }

    public function filter($attributes)
    {
        return $this->activity->filter($attributes)->get();
    }

    public function filterWithUsers($attributes)
    {
        return $this->activity->filter($attributes)->get();
    }

    public function create($attributes)
    {
        return $this->activity->create($attributes);
    }

    public function all()
    {
        return $this->activity->latest()->get();
    }

    public function getCoachActivities()
    {
        return $this->activity
            ->orderBy('status', 'asc')
            ->where('user_id', Auth::id())
            ->where('status', '!=', 'blank')
            ->with(array('team' => function ($query) {
                $query->select('id', 'name');
            }))
            ->with(array('measure' => function ($query) {
                $query->select('id', 'name');
            }))
            ->get();
    }

    public function getAdminActivities()
    {
        return $this->activity
            ->orderBy('status', 'asc')
            ->where('user_id', Auth::id())
            ->where('status', '=', 'blank')
            ->with(array('team' => function ($query) {
                $query->select('id', 'name');
            }))
            ->with(array('measure' => function ($query) {
                $query->select('id', 'name');
            }))
            ->get();
    }

    public function getBlankActivities()
    {
        return $this->activity
            ->select('id', 'name')
            ->where('status', '=', 'blank')
            ->get();
    }

    public function indexWithTeam()
    {
        return $this->activity
            ->orderBy('status', 'asc')
            ->with(array('team' => function ($query) {
                $query->select('id', 'name');
            }))
            ->get();
    }

    public function whereBlankAll()
    {
        return $this->activity->where('status', 'blank')->get();
    }

    public function whereBlankInIds($ids)
    {
        return $this->activity
            ->whereIn('id', $ids)
            ->where('status', 'blank')
            ->get();
    }

    public function find($id)
    {
        return $this->activity->find($id);
    }

    public function findByAttr($attribute, $value)
    {
        return $this->activity->where($attribute, $value)->first();
    }

    public function findByAttrAndUserId($attribute, $value, $user_id)
    {
        return $this->activity
            ->where($attribute, $value)
            ->where('user_id', $user_id)
            ->with(array('team' => function($query){
                $query->select('id', 'name');
            }))
            ->with(array('measure' => function($query){
                $query->select('id', 'name');
            }))
            ->first();
    }

    public function update($id, array $attributes)
    {
        return $this->activity->find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->activity->find($id)->delete();
    }
}
