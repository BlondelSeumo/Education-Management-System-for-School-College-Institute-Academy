<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmLibraryMember extends Model
{
    public function roles(){
		return $this->belongsTo('App\Role', 'member_type', 'id');
	}
	public function studentDetails(){
		return $this->belongsTo('App\SmStudent', 'student_staff_id', 'user_id');
	}
	public function staffDetails(){
		return $this->belongsTo('App\SmStaff', 'student_staff_id', 'user_id');
	}
	public function parentsDetails(){
		return $this->belongsTo('App\SmParent', 'student_staff_id', 'user_id');
	}
	public function memberTypes(){
		return $this->belongsTo('App\Role', 'member_type', 'id');
	}
}
