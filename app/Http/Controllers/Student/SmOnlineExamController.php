<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ApiBaseMethod;
use App\SmStudent;
use App\SmOnlineExam;
use App\SmQuestionBank;
use App\SmQuestionBankMuOption;
use App\SmOnlineExamQuestionAssign;
use App\SmStudentTakeOnlineExam;
use App\SmStudentTakeOnlineExamQuestion;
use App\SmStudentTakeOnlnExQuesOption;
use Auth;
use DB;

class SmOnlineExamController extends Controller
{
    public function studentOnlineExam(){
    	
    	$student = Auth::user()->student;
    	$now = date('H:i:s');
    

    	$online_exams = SmOnlineExam::where('active_status', 1)->where('status', 1)->where('class_id', $student->class_id)->where('section_id', $student->section_id)->where('date', 'like', date('Y-m-d'))->where('start_time', '<', $now)->where('end_time', '>', $now)->get();
    	
    	$marks_assigned = [];
    	foreach($online_exams as $online_exam){
    		$exam = SmStudentTakeOnlineExam::where('online_exam_id', $online_exam->id)->where('student_id', $student->id)->where('status', 2)->first();
    		if($exam != ""){
    			$marks_assigned[] = $exam->online_exam_id;
    		}
    	}

    	return view('backEnd.studentPanel.online_exam', compact('online_exams', 'marks_assigned'));
    }

    public function takeOnlineExam($id){
    	$online_exam = SmOnlineExam::find($id);
    	$assigned_questions = SmOnlineExamQuestionAssign::where('online_exam_id', $online_exam->id)->get();

    	return view('backEnd.studentPanel.take_online_exam', compact('online_exam', 'assigned_questions'));
    }

    public function studentOnlineExamSubmit(Request $request){
    	// $question_option = 5;
    	

    	DB::beginTransaction();

        try{
	    	$student = Auth::user()->student;

	    	$take_online_exam = new SmStudentTakeOnlineExam();
	    	$take_online_exam->online_exam_id = $request->online_exam_id;
	    	$take_online_exam->student_id = $student->id;
	    	$take_online_exam->status = 1;
	    	$take_online_exam->save();
	    	$take_online_exam->toArray();

	    	foreach($request->question_ids as $question_id){
	    		$question_bank = SmQuestionBank::find($question_id);
	    		$trueFalse = 'trueOrFalse_'.$question_id;
	    		$trueFalse = $request->$trueFalse;

	    		$suitable_words = 'suitable_words_'.$question_id;
	    		$suitable_words = $request->$suitable_words;

	    		$exam_question = new SmStudentTakeOnlineExamQuestion();
	    		$exam_question->take_online_exam_id = $take_online_exam->id;
	    		$exam_question->question_bank_id = $question_id;
	    		$exam_question->trueFalse = $trueFalse;
	    		$exam_question->suitable_words = $suitable_words;
	    		$exam_question->save();
	    		$exam_question->toArray();
	    		if($question_bank->type == "M"){
	    			$question_options = SmQuestionBankMuOption::where('question_bank_id', $question_bank->id)->get();

	    			$i = 0;
	    			foreach($question_options as $question_option){
	    				$options = 'options_'.$question_id.'_'.$i++;
	    				// $options = $request->$options[$i++];
	    				// dd($request->$options);
	    				
	    				$exam_question_option = new SmStudentTakeOnlnExQuesOption();
	    				$exam_question_option->take_online_exam_question_id = $exam_question->id;
	    				$exam_question_option->title = $question_option->title;
	    				if(isset($request->$options)){
	    					$exam_question_option->status = $request->$options;
	    				}else{
	    					$exam_question_option->status = 0;
	    				}
	    				$exam_question_option->save();
	    				
	    			}
	    		}
	    	}

    	DB::commit();
        return redirect('student-online-exam')->with('message-success', 'Answer submitted successfully');

    } catch(Exception $e){
        DB::rollBack();
    }

    return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
	}

	public function studentViewResult()
	{

		$result_views = SmStudentTakeOnlineExam::where('active_status', 1)->where('status', 2)->get();

		return view('backEnd.studentPanel.student_view_result', compact('result_views'));
	}

	public function studentAnswerScript($exam_id, $s_id)
	{
		$take_online_exam = SmStudentTakeOnlineExam::where('online_exam_id', $exam_id)->where('student_id', $s_id)->first();
		return view('backEnd.examination.online_answer_view_script_modal', compact('take_online_exam'));
	}

	public function studentOnlineExamApi(Request $request, $id)
	{

		if (ApiBaseMethod::checkUrl($request->fullUrl())) {

			$data = [];

			$student = SmStudent::where('user_id', $id)->first();

			$now = date('H:i:s');



			$online_exams = DB::table('sm_online_exams')
				->join('sm_subjects', 'sm_online_exams.class_id', '=', 'sm_subjects.id')
				->join('sm_student_take_online_exams', 'sm_online_exams.id', '=', 'sm_student_take_online_exams.online_exam_id')
				->where('class_id', $student->class_id)
				->where('sm_online_exams.status', '=', 1)
				->where('section_id', $student->section_id)
				->where('sm_student_take_online_exams.status', '!=', 2)
				->where('sm_student_take_online_exams.student_id', $student->id)
				->select('sm_online_exams.id as exam_id', 'sm_online_exams.title as exam_title', 'sm_subjects.subject_name', 'sm_online_exams.date', 'sm_online_exams.status as onlineExamStatus', 'sm_student_take_online_exams.status as onlineExamTakeStatus')
				->get();

			$examStatus = '0 = Pending , 1 Published';
			$examTakenStatus = '0 = Take Exam , 1 = Alreday Submitted';
			$data['online_exams'] = $online_exams->toArray();
			$data['online_exams_status'] = $examStatus;
			$data['onlineExamTakenStatus'] = $examTakenStatus;
			return ApiBaseMethod::sendResponse($data, null);
		}
	}
	public function chooseExamApi(Request $request, $id)
	{
		if (ApiBaseMethod::checkUrl($request->fullUrl())) {

			$student = SmStudent::where('user_id', $id)->first();

			$student_exams = DB::table('sm_online_exams')
				->where('class_id', $student->class_id)
				->where('section_id', $student->section_id)
				->where('school_id', $student->school_id)
				->select('sm_online_exams.title as exam_name', 'id as exam_id')
				->get();
			return ApiBaseMethod::sendResponse($student_exams, null);
		}
	}
	public function examResultApi(Request $request, $id, $exam_id)
	{
		if (ApiBaseMethod::checkUrl($request->fullUrl())) {
			$data = [];
			$student = SmStudent::where('user_id', $id)->first();

			$student_exams = DB::table('sm_online_exams')
				->where('class_id', $student->class_id)
				->where('section_id', $student->section_id)
				->where('school_id', $student->school_id)
				->select('sm_online_exams.title as exam_name', 'sm_online_exams.id as exam_id')
				->get();

			$exam_result = DB::table('sm_online_exam_marks')
				->join('sm_online_exams', 'sm_online_exam_marks.exam_id', '=', 'sm_online_exams.id')
				->join('sm_student_take_online_exams', 'sm_student_take_online_exams.online_exam_id', '=', 'sm_online_exams.id')
				->join('sm_subjects', 'sm_online_exam_marks.subject_id', '=', 'sm_subjects.id')
				->where('sm_online_exam_marks.student_id', $student->id)
				->where('sm_online_exams.school_id', $student->school_id)
				->where('sm_online_exams.id', $exam_id)
				->where('sm_online_exams.status', '=', 1)
				->select(
					'sm_online_exams.title as exam_name',
					'sm_online_exams.id as exam_id',
					'sm_subjects.subject_name',
					'sm_online_exam_marks.marks as obtained_marks',
					'sm_online_exams.percentage as pass_mark_percentage',
					'sm_student_take_online_exams.total_marks'
				)
				->get();

			//dd($exam_result);
			$gradeArray = [];
			foreach ($exam_result  as $row) {

				$mark = floor($row->obtained_marks);
				$grades = DB::table('sm_marks_grades')
					->where('percent_from', '<=', $mark)
					->where('percent_upto', '>=', $mark)
					->select('grade_name')
					->first();
				$gradeArray[] = array(
					"grade" => $grades->grade_name,
					"exam_id" => $row->exam_id,
					"total_marks" => $row->total_marks,
					"subject_name" => $row->subject_name,
					"obtained_marks" => $row->obtained_marks,
					"pass_mark" => $row->pass_mark_percentage,
					"exam_name" => $row->exam_name
				);
			}

			$data['student_exams'] = $student_exams->toArray();
			$data['exam_result'] = $gradeArray;


			return ApiBaseMethod::sendResponse($data, null);
		}
	}
	public function getGrades(Request $request, $marks)
	{
		if (ApiBaseMethod::checkUrl($request->fullUrl())) {


			$grades = DB::table('sm_marks_grades')
				->where('percent_from', '<=', floor($marks))
				->where('percent_upto', '>=', floor($marks))
				->select('grade_name')
				->first();


			return ApiBaseMethod::sendResponse($grades, null);
		}
	}
}
