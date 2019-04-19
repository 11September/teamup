<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    protected $fillable = ['name', 'measure_id', 'user_id', 'team_id', 'graph_type' ,'status'];

    public function measure()
    {
        return $this->belongsTo(Measure::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function coach()
    {
        return $this->belongsTo(User::class);
    }

    public function goal()
    {
        return $this->hasOne(ActivityGoal::class);
    }

    public function scopeFilter($query, $params)
    {
        if ($id = array_get($params, 'id')) {
            $query = $query->where('id', '=', $id);
        }

        if ($id = array_get($params, 'team_id')) {
            $query = $query->where('team_id', '=', $params['team_id']);
        }

        return $query;
    }
}
