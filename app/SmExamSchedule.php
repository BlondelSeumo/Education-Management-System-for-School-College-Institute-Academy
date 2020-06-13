<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmExamSchedule extends Model
{
    public function examSchedule(){
    	return $this->hasMany('App\SmExamScheduleSubject', 'exam_schedule_id', 'id');
    }

    public function exam(){
    	return $this->belongsTo('App\SmExam', 'exam_id', 'id');
    }

    public function class(){
		return $this->belongsTo('App\SmClass', 'class_id', 'id');
	}
	public function section(){
        return $this->belongsTo('App\SmSection', 'section_id', 'id');
    }

    public function classRoom(){
        return $this->belongsTo('App\SmClassRoom', 'room_id', 'id');
    }

    public function subject(){
        return $this->belongsTo('App\SmSubject', 'subject_id', 'id');
    }


    public static function assignedRoutine($class_id, $section_id, $exam_id, $subject_id, $exam_period_id){
        return SmExamSchedule::where('class_id', $class_id)->where('section_id', $section_id)->where('exam_term_id', $exam_id)->where('subject_id', $subject_id)->where('exam_period_id', $exam_period_id)->first();
    }

    public static function assignedRoutineSubject($class_id, $section_id, $exam_id, $subject_id){
        return SmExamSchedule::where('class_id', $class_id)->where('section_id', $section_id)->where('exam_term_id', $exam_id)->where('subject_id', $subject_id)->first();
    }

    public static function assigned_date_wise_exams($exam_period_id, $exam_term_id, $date){
        return SmExamSchedule::where('exam_period_id', $exam_period_id)->where('date', $date)->where('exam_term_id', $exam_term_id)->get();
    }

    public static function assignedRoutineSubjectStudent($class_id, $section_id, $exam_id, $subject_id, $exam_period_id){
        return SmExamSchedule::where('class_id', $class_id)->where('section_id', $section_id)->where('exam_term_id', $exam_id)->where('subject_id', $subject_id)->where('exam_period_id', $exam_period_id)->first();
    }
}
