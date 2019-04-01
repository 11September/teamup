<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = "notes";

    protected $fillable = ['note', 'user_id', 'date'];

    protected $casts = [
        'date' => 'datetime:Y-m',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
