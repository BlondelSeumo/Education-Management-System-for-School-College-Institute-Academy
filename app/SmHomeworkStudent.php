<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmHomeworkStudent extends Model
{
    public function studentInfo(){
    	return $this->belongsTo('App\SmStudent', 'student_id', 'id');
    }
}
