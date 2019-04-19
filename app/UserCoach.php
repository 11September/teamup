<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCoach extends Model
{
    protected $table = 'user_coaches';

    protected $fillable = ['user_id', 'coach_id'];

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
