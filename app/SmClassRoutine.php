<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmClassRoutine extends Model
{
    public function subject(){
    	return $this->belongsTo('App\SmSubject', 'subject_id', 'id');
    }

    public function class(){
    	return $this->belongsTo('App\SmClass', 'class_id', 'id');
    }

    public function section(){
    	return $this->belongsTo('App\SmSection', 'section_id', 'id');
    }

    public static function teacherId($class_id, $section_id, $subject_id){
    	return SmAssignSubject::where('class_id', $class_id)->where('section_id', $section_id)->where('subject_id', $subject_id)->first();
    }
}
