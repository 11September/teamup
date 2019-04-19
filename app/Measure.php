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
}
