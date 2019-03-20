<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = "settings";

    protected $fillable = ['type_graph_straight', 'type_graph_reverse', 'privacy_policy', 'default_units'];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, $params)
    {
        if ($title = array_get($params, 'type_graph_straight')) {
            $query = $query->where('type_graph_straight', '=', $title);
        }
        if ($title = array_get($params, 'type_graph_reverse')) {
            $query = $query->where('type_graph_reverse', '=', $title);
        }
        if ($title = array_get($params, 'privacy_policy')) {
            $query = $query->where('privacy_policy', '=', $title);
        }
        if ($title = array_get($params, 'default_units')) {
            $query = $query->where('default_units', '=', $title);
        }

        return $query;
    }
}
