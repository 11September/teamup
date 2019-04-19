<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = "teams";

    protected $fillable = ['name', 'user_id', 'count', 'code'];

    public function coach()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'team_user')->withTimestamps();
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
