<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    protected $fillable = ['name', 'measure_id', 'type_graph', 'type_graph' ,'status', 'user_id'];

    public function measure()
    {
        return $this->belongsTo(Measure::class);
    }

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    public function coach()
    {
        return $this->belongsTo(User::class);
    }

    public static function selectAll()
    {
        return Activity::select('id', 'name', 'measure_id', 'type_graph', 'user_id', 'status')->get();
    }
}
