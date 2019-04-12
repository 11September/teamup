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

    public function coach()
    {
        return $this->belongsTo(User::class);
    }
}
