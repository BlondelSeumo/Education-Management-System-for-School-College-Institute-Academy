<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmSeatPlan extends Model
{
    public function seatPlanChild(){
    	return $this->hasMany('App\SmSeatPlanChild', 'seat_plan_id', 'id');
    }
    public function exam(){
    	return $this->belongsTo('App\SmExam', 'exam_id', 'id');
    }
    public function subject(){
    	return $this->belongsTo('App\SmSubject', 'subject_id', 'id');
    }
    public function section(){
    	return $this->belongsTo('App\SmSection', 'section_id', 'id');
    }
    public function class(){
    	return $this->belongsTo('App\SmClass', 'class_id', 'id');
    }

    public static function total_student($class, $section){
    	return SmStudent::where('class_id', $class)->where('section_id', $section)->count();
    }
}
