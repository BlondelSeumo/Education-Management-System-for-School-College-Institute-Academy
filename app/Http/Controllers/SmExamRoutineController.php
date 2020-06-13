<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmClass;

use App\SmSection;
use App\SmSubject;
use App\SmExam;
use App\SmExamType;
use App\SmAssignSubject;
use App\SmClassTime;
use App\SmClassRoom;
use App\SmExamSchedule;
use App\SmHoliday;

class SmExamRoutineController extends Controller
{

    public function __construct()
    {
        $this->middleware('PM');
    }

    public function examSchedule(){
        $exam_types = SmExamType::all();
    	$classes = SmClass::where('active_status', 1)->get();
    	return view('backEnd.examination.exam_schedule', compact('classes', 'exam_types'));
    }

    public function examScheduleCreate(){
        $classes = SmClass::where('active_status', 1)->get();
        $sections = SmSection::where('active_status', 1)->get();
        $subjects = SmSubject::where('active_status', 1)->get();
        $exams = SmExam::all();
        $exam_types = SmExamType::all();
    	return view('backEnd.examination.exam_schedule_create', compact('classes', 'exams','exam_types'));
    }

    public function examScheduleSearch(Request $request){
    	$request->validate([
    		'exam' => 'required',
    		'class' => 'required',
    		'section' => 'required'
    	]);


    	$assign_subjects = SmAssignSubject::where('class_id', $request->class)->where('section_id', $request->section)->get();

    	if($assign_subjects->count() == 0){
    		return redirect('exam-schedule-create')->with('message-danger', 'No Subject Assigned. Please assign subjects in this class.');
    	}


        $assign_subjects = SmAssignSubject::where('class_id', $request->class)->where('section_id', $request->section)->get();


    	$classes = SmClass::where('active_status', 1)->get();
    	$exams = SmExam::where('active_status', 1)->get();
    	$class_id = $request->class;
    	$section_id = $request->section;
    	$exam_id = $request->exam;


        $exam_types = SmExamType::all();
        $exam_periods  = SmClassTime::where('type', 'exam')->get();

    	return view('backEnd.examination.exam_schedule_create', compact('classes', 'exams', 'assign_subjects', 'class_id', 'section_id', 'exam_id','exam_types', 'exam_periods'));
    }


    public function addExamRoutineModal($subject_id, $exam_period_id, $class_id, $section_id, $exam_term_id){

    	$rooms = SmClassRoom::where('active_status', 1)->get();
    	return view('backEnd.examination.add_exam_routine_modal', compact('subject_id', 'exam_period_id', 'class_id', 'section_id', 'exam_term_id', 'rooms'));
    }




    public function EditExamRoutineModal($subject_id, $exam_period_id, $class_id, $section_id, $exam_term_id, $assigned_id){

    	$rooms = SmClassRoom::where('active_status', 1)->get();
    	$assigned_exam = SmExamSchedule::find($assigned_id);
    	return view('backEnd.examination.add_exam_routine_modal', compact('subject_id', 'exam_period_id', 'class_id', 'section_id', 'exam_term_id', 'rooms', 'assigned_exam'));
    }

    public function deleteExamRoutineModal($assigned_id){

    	return view('backEnd.examination.delete_exam_routine', compact('assigned_id'));
    } 


    public function deleteExamRoutine($assigned_id){

    	$exam_routine = SmExamSchedule::find($assigned_id);

    	$class_id = $exam_routine->class_id;
    	$section_id = $exam_routine->section_id;
    	$exam_term_id = $exam_routine->exam_term_id;


    	$result = $exam_routine->delete();

    	if($result){
    		\Session::flash('success','Exam routine has been deleted successfully');
        	return redirect('exam-routine-view/'.$class_id.'/'.$section_id.'/'.$exam_term_id);
        }
    }




    public function addExamRoutineStore(Request $request){



    	if($request->assigned_id == ""){

	        $exam_routine = new SmExamSchedule();
	        $exam_routine->class_id = $request->class_id;
	        $exam_routine->section_id = $request->section_id;
	        $exam_routine->subject_id = $request->subject_id;
	        $exam_routine->exam_period_id = $request->exam_period_id;
	        $exam_routine->exam_term_id = $request->exam_term_id;
	        $exam_routine->room_id = $request->room;
	        $exam_routine->date = date('Y-m-d', strtotime($request->date));
	        $result = $exam_routine->save();

	        \Session::flash('success','Exam routine has been assigned successfully');

	    }else{

	    	$exam_routine = SmExamSchedule::find($request->assigned_id);
	        $exam_routine->class_id = $request->class_id;
	        $exam_routine->section_id = $request->section_id;
	        $exam_routine->subject_id = $request->subject_id;
	        $exam_routine->exam_period_id = $request->exam_period_id;
	        $exam_routine->exam_term_id = $request->exam_term_id;
	        $exam_routine->room_id = $request->room;
	        $exam_routine->date = date('Y-m-d', strtotime($request->date));
	        $result = $exam_routine->save();

	        \Session::flash('success','Exam routine has been updated successfully');

	    }


        $class_id = $request->class_id;
        $section_id = $request->section_id;
        $exam_term_id = $request->exam_term_id;



        if($result){
        	return redirect('exam-routine-view/'.$class_id.'/'.$section_id.'/'.$exam_term_id);
        }

        return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
    }

    public function examRoutineView($class_id, $section_id, $exam_term_id){


    	$assign_subjects = SmAssignSubject::where('class_id', $class_id)->where('section_id', $section_id)->get();


    	$classes = SmClass::where('active_status', 1)->get();
    	$exams = SmExam::where('active_status', 1)->get();

    	$exam_id = $exam_term_id;


        $exam_types = SmExamType::all();
        $exam_periods  = SmClassTime::where('type', 'exam')->get();

        return view('backEnd.examination.exam_schedule_create', compact('classes', 'exams', 'assign_subjects', 'class_id', 'section_id', 'exam_id', 'exam_types', 'exam_periods'));
    }

    public function checkExamRoutineDate(Request $request){

    	if($request->assigned_id == ""){
    		$check_date = SmExamSchedule::where('class_id', $request->class_id)->where('section_id', $request->section_id)->where('exam_term_id', $request->exam_term_id)->where('date', date('Y-m-d', strtotime($request->date)))->where('exam_period_id', $request->exam_period_id)->get();
    	}else{
    		$check_date = SmExamSchedule::where('id', '!=', $request->assigned_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->where('exam_term_id', $request->exam_term_id)->where('date', date('Y-m-d', strtotime($request->date)))->where('exam_period_id', $request->exam_period_id)->get();
    	}


    	$holiday_check = SmHoliday::where('from_date', '<=', date('Y-m-d', strtotime($request->date)))->where('to_date', '>=', date('Y-m-d', strtotime($request->date)))->first();


    	if($holiday_check != ""){
    		$from_date = date('jS M, Y', strtotime($holiday_check->from_date));
    		$to_date = date('jS M, Y', strtotime($holiday_check->to_date));
    	}else{
    		$from_date = '';
    		$to_date = '';
    	}


    	return response()->json([$check_date, $holiday_check, $from_date, $to_date]);

    }

    public function examScheduleReportSearch(Request $request){
        $request->validate([
            'exam' => 'required',
            'class' => 'required',
            'section' => 'required'
        ]);


        $assign_subjects = SmAssignSubject::where('class_id', $request->class)->where('section_id', $request->section)->get();

        if($assign_subjects->count() == 0){
            return redirect('exam-schedule-create')->with('message-danger', 'No Subject Assigned. Please assign subjects in this class.');
        }


        $assign_subjects = SmAssignSubject::where('class_id', $request->class)->where('section_id', $request->section)->get();


        $classes = SmClass::where('active_status', 1)->get();
        $exams = SmExam::where('active_status', 1)->get();
        $class_id = $request->class;
        $section_id = $request->section;
        $exam_id = $request->exam;


        $exam_types = SmExamType::all();
        $exam_periods  = SmClassTime::where('type', 'exam')->get();

        return view('backEnd.examination.exam_schedule', compact('classes', 'exams', 'assign_subjects', 'class_id', 'section_id', 'exam_id','exam_types', 'exam_periods'));
    }

    public function examRoutineReport(Request $request){
        $exam_types = SmExamType::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            return ApiBaseMethod::sendResponse($exam_types, null);
        }
        return view('backEnd.reports.exam_routine_report', compact('classes', 'exam_types'));
    } 

    public function examRoutineReportSearch(Request $request){
        $exam_types = SmExamType::all();
        $exam_periods  = SmClassTime::where('type', 'exam')->get();

        $exam_routines = SmExamSchedule::where('exam_term_id', $request->exam)->orderBy('date', 'ASC')->get();

        $exam_routines = $exam_routines->groupBy('date');


        $exam_term_id = $request->exam;

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['exam_types'] = $exam_types->toArray();
            $data['exam_routines'] = $exam_routines->toArray();
            $data['exam_periods'] = $exam_periods->toArray();
            $data['exam_term_id'] = $exam_term_id;
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.reports.exam_routine_report', compact('exam_types', 'exam_routines', 'exam_periods', 'exam_term_id'));
    }

}
