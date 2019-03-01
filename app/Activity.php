<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    protected $fillable = ['name', 'measure_id', 'type_graph', 'status'];

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
}
