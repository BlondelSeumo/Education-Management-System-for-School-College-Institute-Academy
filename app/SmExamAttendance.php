<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmExamAttendance extends Model
{
    public function examAttendanceChild(){
    	return $this->hasMany('App\SmExamAttendanceChild', 'exam_attendance_id', 'id');
    }
}
