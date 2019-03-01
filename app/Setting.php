<?php

namespace App;

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
}
