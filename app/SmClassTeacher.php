<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmClassTeacher extends Model
{
    public function teacher(){
    	return $this->belongsTo('App\SmStaff', 'teacher_id', 'id');
    }
}
