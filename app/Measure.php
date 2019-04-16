<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    protected $table = "measures";

    public $timestamps = true;

    protected $fillable = ['name'];
}
