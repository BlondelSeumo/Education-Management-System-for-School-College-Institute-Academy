<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable; 
class User extends Authenticatable
{
    use Notifiable;
    public static $item ="23876323";  //23876323 //22014245

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'phone', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function student(){
        return $this->belongsTo('App\SmStudent', 'id', 'user_id');
    }
    public function staff(){
        return $this->belongsTo('App\SmStaff', 'id', 'user_id');
    }
}
