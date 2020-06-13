<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use Auth;

class SmParent extends Model
{
    public function parent_user(){
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public static function myChildrens(){
		if(Session::get('childrens') == ""){

			$user = Auth::user();
			$parent = SmParent::where('user_id', $user->id)->first();
			$childrens = SmStudent::where('parent_id', $parent->id)->where('active_status' ,1)->get();
			Session::put('childrens', $childrens);
		}

		return Session::get('childrens');
	}
}
