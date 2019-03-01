<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = "feedbacks";

    protected $fillable = ['user_id', 'feedback', 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
