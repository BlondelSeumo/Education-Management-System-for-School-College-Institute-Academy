<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class SmMarksRegister extends Model
{
    public function marksRegisterChilds(){
    	return $this->hasMany('App\SmMarksRegisterChild', 'marks_register_id', 'id');
    }

    public static function marksRegisterChild($student, $exam, $class, $section){
    	$marks_register_id = SmMarksRegister::where('student_id', $student)->where('exam_id', $exam)->where('class_id', $class)->where('section_id', $section)->first();
    	if($marks_register_id != ""){
	    	return SmMarksRegisterChild::where('marks_register_id', $marks_register_id->id)->get();
	    }
	    return array();
    }

    public function studentInfo(){
        return $this->belongsTo('App\SmStudent', 'student_id', 'id');
    }

    public static function subjectDetails($exam, $class, $section, $subject){
    	$exam_schedule = SmExamSchedule::where('exam_id', $exam)->where('class_id', $class)->where('section_id', $section)->first();
    	
    		return SmExamScheduleSubject::where('exam_schedule_id', $exam_schedule->id)->where('subject_id', $subject)->first();
    	
    }

    public static function highestMark($exam_id, $subject_id, $section_id, $class_id){
        $highest_mark = DB::table('sm_result_stores')
                            ->where('section_id', $section_id)
                            ->where('class_id', $class_id)
                            ->where('exam_type_id', $exam_id)
                            ->where('subject_id', $subject_id)
                            ->max('total_marks');

        return $highest_mark;                  
    }
}
