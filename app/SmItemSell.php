<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmItemSell extends Model
{
    public function roles(){
    	return $this->belongsTo('App\Role', 'role_id', 'id');
    }

    public function staffDetails(){
    	return $this->belongsTo('App\SmStaff', 'student_staff_id', 'id');
    }

    public function parentsDetails(){
    	return $this->belongsTo('App\SmParent', 'student_staff_id', 'id');
    }

    public function studentDetails(){
    	return $this->belongsTo('App\SmStudent', 'student_staff_id', 'id');
    }
}
