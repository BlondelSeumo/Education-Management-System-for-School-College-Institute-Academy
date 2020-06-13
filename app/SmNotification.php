<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class SmNotification extends Model
{
    public static function notifications(){
    	$user = Auth()->user();
		if($user->role_id == 2){
    		return SmNotification::where('user_id', $user->student->id)->where('role_id', 2)->where('is_read', 0)->get();
    	}
        if($user->role_id == 10){
            return SmNotification::all();
        }else{
    		return SmNotification::where('user_id', $user->staff->id)->where('role_id', '!=', 2)->where('is_read', 0)->get();
    	}

    	
    	
    }
}
