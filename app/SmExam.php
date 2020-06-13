<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmExam extends Model
{ 

    public function getClassName(){
		return $this->belongsTo('App\SmClass', 'class_id', 'id');
	}
	public function GetSectionName(){
		return $this->belongsTo('App\SmSection', 'section_id', 'id');
	}
	public function GetSubjectName(){
		return $this->belongsTo('App\SmSubject', 'subject_id', 'id');
	}
	public function GetExamTitle(){
		return $this->belongsTo('App\SmExamType', 'exam_type_id', 'id');
	}


	public function GetExamSetup(){
		return $this->hasMany('App\SmExamSetup', 'exam_id', 'id');
	}


	public static function getMarkDistributions($ex_id, $class_id, $section_id, $subject_id){
		$data = SmExamSetup::where([
                ['exam_term_id', $ex_id],
                ['class_id', $class_id],
                ['section_id', $section_id],
                ['subject_id', $subject_id]
            ])->get();

		return $data;
	} 


	public static function getMarkREgistered($ex_id, $class_id, $section_id, $subject_id){

		$data = SmMarkStore::where([
                ['exam_term_id', $ex_id],
                ['class_id', $class_id],
                ['section_id', $section_id],
                ['subject_id', $subject_id]
            ])->first();

		return $data;
	} 

}
