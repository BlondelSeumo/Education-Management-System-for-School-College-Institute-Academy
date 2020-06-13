<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmStudentAttendance extends Model
{
    public function studentInfo(){
    	return $this->belongsTo('App\SmStudent', 'student_id', 'id');
    }
}
