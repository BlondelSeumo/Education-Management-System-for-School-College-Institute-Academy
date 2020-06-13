<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmOnlineExam extends Model
{
    public function studentInfo(){
    	return $this->belongsTo('App\SmStudent', 'id', 'student_id');
    }

    public function class(){
    	return $this->belongsTo('App\SmClass', 'class_id', 'id');
    }

    public function section(){
    	return $this->belongsTo('App\SmSection', 'section_id', 'id');
    }

    public function subject(){
        return $this->belongsTo('App\SmSubject', 'subject_id', 'id');
    }

    public function assignQuestions(){
        return $this->hasMany('App\SmOnlineExamQuestionAssign', 'online_exam_id', 'id');
    }

    public static function obtainedMarks($exam_id, $student_id){
    	$marks = SmStudentTakeOnlineExam::select('status', 'total_marks')->where('online_exam_id', $exam_id)->where('student_id', $student_id)->first();
        return $marks;
    }

}
