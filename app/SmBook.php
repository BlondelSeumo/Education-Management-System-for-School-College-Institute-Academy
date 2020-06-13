<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmBook extends Model
{
    public function bookCategory(){
    	return $this->belongsTo('App\SmBookCategory', 'book_category_id', 'id');
    }
    
    public function bookSubject(){
    	return $this->belongsTo('App\SmSubject', 'subject', 'id');
    }

    public static function getMemberDetails($memberID){
    	return $getMemberDetails = SmStudent::select('full_name', 'email', 'mobile')->where('id', '=', $memberID)->first();
    }

    public static function getMemberStaffsDetails($memberID){
    	return $getMemberDetails = SmStaff::select('full_name', 'email', 'mobile')->where('user_id', '=', $memberID)->first();
    }

    public static function getParentDetails($memberID){
        return $getMemberDetails = SmParent::select('full_name', 'email', 'mobile')->where('user_id', '=', $memberID)->first();
    }

    
}
