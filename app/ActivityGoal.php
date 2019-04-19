<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityGoal extends Model
{
    protected $table = 'activity_user_goals';

    protected $fillable = ['user_id', 'activity_id', 'goal'];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
