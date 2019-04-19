<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 012 12.03.19
 * Time: 15:11
 */

namespace App\Repositories;

use App\ActivityGoal;
use Illuminate\Http\Request;

class ActivityGoalRepository
{
    protected $activityGoal;

    public function __construct(ActivityGoal $activityGoal)
    {
        $this->activityGoal = $activityGoal;
    }

    public function create($attributes)
    {
        return $this->activityGoal->create($attributes);
    }

    public function update_field($id, $field, $attribute)
    {
        return $this->activityGoal->findOrFail($id)->update([$field => $attribute]);
    }

    public function findWithCustomFileds($id, $fields)
    {
        return $this->activityGoal
            ->select($fields)
            ->where('id', $id)
            ->first();
    }

    public function lastWithNeedFields($fields)
    {
        return $this->activityGoal
            ->select($fields)
            ->latest()
            ->first();
    }

    public function delete($id)
    {
        return $this->activityGoal->findOrFail($id)->delete();
    }
}
