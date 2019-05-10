<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    protected $table = "measures";

    protected $fillable = ['name'];

    public $timestamps = true;

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function scopeFilter($query, $params)
    {
        if ($id = array_get($params, 'id')) {
            $query = $query->where('id', '=', $id);
        }

        if ($activity_id = array_get($params, 'activity_id')) {
            $query = $query->whereHas('activities', function ($query) use ($activity_id) {
                $query->where('id', '=', $activity_id);
            });
        }

        return $query;
    }
}
