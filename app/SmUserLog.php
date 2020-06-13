<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class SmUserLog extends Model
{
    public function user(){
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function role(){
    	return $this->belongsTo('App\Role', 'role_id', 'id');
    }
}
