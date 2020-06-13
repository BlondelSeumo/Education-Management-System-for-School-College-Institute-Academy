<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SmMarkStore;
class SmResultStore extends Model
{
    
    public function studentInfo(){
    	return $this->belongsTo('App\SmStudent', 'student_id', 'id');
    }

    public static function  GetResultBySubjectId($class_id, $section_id, $subject_id,$exam_id,$student_id){
    	$data = SmMarkStore::where([
    		['class_id',$class_id],
    		['section_id',$section_id],
    		 ['exam_term_id',$exam_id],
    		['student_id',$student_id],
    		['subject_id',$subject_id]
    	])->get();
    	return $data;
    }

    public static function  GetFinalResultBySubjectId($class_id, $section_id, $subject_id,$exam_id,$student_id){
        $data = SmResultStore::where([
        ['class_id',$class_id],
        ['section_id',$section_id],
        ['exam_type_id',$exam_id],
        ['student_id',$student_id],
        ['subject_id',$subject_id]
        ])->first();

    	return $data;
    }




}
