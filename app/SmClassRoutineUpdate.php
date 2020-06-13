<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmClassRoutineUpdate extends Model
{
    public static function assingedClassRoutine($class_time, $day, $class_id, $section_id){
    	return SmClassRoutineUpdate::where('class_period_id', $class_time)->where('day', $day)->where('class_period_id', $class_time)->where('class_id', $class_id)->where('section_id', $section_id)->first();
    }

    public static function teacherAssingedClassRoutine($class_time, $day, $teacher_id){
        return SmClassRoutineUpdate::where('class_period_id', $class_time)->where('day', $day)->where('class_period_id', $class_time)->where('teacher_id', $teacher_id)->first();
    }

    public function subject(){
    	return $this->belongsTo('App\SmSubject', 'subject_id', 'id');
    }

    public function classRoom(){
    	return $this->belongsTo('App\SmClassRoom', 'room_id', 'id');
    }

    public function teacherDetail(){
    	return $this->belongsTo('App\SmStaff', 'teacher_id', 'id');
    }

    public function class(){
        return $this->belongsTo('App\SmClass', 'class_id', 'id');
    }

    public function section(){
        return $this->belongsTo('App\SmSection', 'section_id', 'id');
    }
}
