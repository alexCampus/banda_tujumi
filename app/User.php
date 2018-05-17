<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_banda_tujumi';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastname', 'firstname', 'nickname', 'email', 'phonenumber', 'instrument', 'adminLevel', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function events()
    {
        return $this->belongsToMany('App\EventModel')->withPivot('participe');
    }

//    public function comments()
//    {
//        return $this->hasMany('App\Comment');
//    }

    public function getAllUsers()
    {
        $users = User::all();
        return $users;
    }
}
