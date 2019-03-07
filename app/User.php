<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'type', 'number_students', 'number_students', 'activation_code', 'expiration_date', 'phone', 'school'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getFullnameAttribute(){
        return $this->first_name . ' '. $this->last_name;
    }

    public function goal()
    {
        return $this->hasOne(Goal::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }
}
