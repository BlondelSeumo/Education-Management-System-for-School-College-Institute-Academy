<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmAssignClassTeacher extends Model
{
    public function className(){
		return $this->belongsTo('App\SmClass', 'class_id', 'id');
	}
	public function section(){
		return $this->belongsTo('App\SmSection', 'section_id', 'id');
	}

	public function classTeachers(){
		return $this->hasMany('App\SmClassTeacher', 'assign_class_teacher_id', 'id');
	}
}
