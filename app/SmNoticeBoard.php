<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmNoticeBoard extends Model
{
    public function users(){
    	return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public static function getRoleName($role_id){

	 $getRoleName = Role::select('name')
						 ->where('id', $role_id)
						 ->first();

	 if(isset($getRoleName)){
        return $getRoleName;
	 }
	 else{
	 	return false;
	 }

    }
}
