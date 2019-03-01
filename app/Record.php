<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = "records";

    protected $fillable = ['activity_id', 'user_id', 'value', 'notice'];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
