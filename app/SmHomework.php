<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmHomework extends Model
{
    public function classes(){
		return $this->belongsTo('App\SmClass', 'class_id', 'id');
	}

	public function sections(){
		return $this->belongsTo('App\SmSection', 'section_id', 'id');
	}

	public function subjects(){
		return $this->belongsTo('App\SmSubject', 'subject_id', 'id');
	}

	public function users(){
		return $this->belongsTo('App\User', 'created_by', 'id');
	}

	public static function getHomeworkPercentage($class_id, $section_id, $homework_id){

	 $allStudents = SmStudent::select('id')
						 ->where('class_id', $class_id)
						 ->where('section_id', $section_id)
						 ->get();

	 $totalStudents = count($allStudents);
     $HomeworkCompleted = SmHomeworkStudent::select('id')
						 ->where('homework_id', $homework_id)
						 ->where('complete_status', 'C')
						 ->get();

	 $totalHomeworkCompleted = count($HomeworkCompleted);

     if(isset($totalStudents)){
        $homeworks = array(
        	'totalStudents' => $totalStudents,
        	'totalHomeworkCompleted' => $totalHomeworkCompleted

        	);
        return $homeworks;
	 }
	 else{
	 	return false;
	 }

	}

	public static function evaluationHomework($s_id, $h_id){
		$abc = SmHomeworkStudent::where('homework_id', $h_id)->where('student_id', $s_id)->first();
		return $abc;
	}
}
