<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmClass;
use App\SmAssignSubject;
use App\SmSubject;
use App\SmStaff;
use App\SmClassRoutine;
use App\SmStudent;
use App\SmAssignClassTeacher;
use App\SmFeesMaster;
use App\SmFeesAssign;
use App\SmFeesPayment;
use App\SmSection;
use Validator;

class SmAcademicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }
    
    public function classRoutine(){
    	$classes = SmClass::where('active_status', 1)->get();
    	return view('backEnd.academics.class_routine', compact('classes'));
    }
    public function classRoutineCreate(){
    	$classes = SmClass::where('active_status', 1)->get();
    	return view('backEnd.academics.class_routine_create', compact('classes'));
    }
	public function assignSubject(Request $request){
    	$classes = SmClass::where('active_status', 1)->get();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            return ApiBaseMethod::sendResponse($classes, null);
        }
    	return view('backEnd.academics.assign_subject', compact('classes'));
    }
    public function assigSubjectCreate(Request $request){
    	$classes = SmClass::where('active_status', 1)->get();
        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            return ApiBaseMethod::sendResponse($classes, null);
        }
    	return view('backEnd.academics.assign_subject_create', compact('classes'));
    }

    public function assignSubjectSearch(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
    		'class' => 'required',
    		'section' => 'required'
    	]);

        if($validator->fails()){
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

    	$assign_subjects = SmAssignSubject::where('class_id', $request->class)->where('section_id', $request->section)->get();

    	$subjects = SmSubject::where('active_status', 1)->get();
    	$teachers = SmStaff::where('active_status', 1)->where('role_id', 4)->get();
    	$class_id = $request->class; 
    	$section_id = $request->section; 

    	$classes = SmClass::where('active_status', 1)->get();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            $data=[];
            $data['classes']= $classes->toArray();
            $data['assign_subjects']= $assign_subjects->toArray();
            $data['teachers']= $teachers->toArray();
            $data['subjects']= $subjects->toArray();
            $data['class_id']= $class_id;
            $data['section_id']= $section_id;
            return ApiBaseMethod::sendResponse($data, null);
        }

    	return view('backEnd.academics.assign_subject_create', compact('classes', 'assign_subjects', 'teachers', 'subjects', 'class_id', 'section_id'));
    }

    public function assignSubjectAjax(Request $request){
    	$subjects = SmSubject::where('active_status', 1)->get();
    	$teachers = SmStaff::where('active_status', 1)->where('role_id', 4)->get();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            $data=[];
            $data['subjects']= $subjects->toArray();
            $data['teachers']= $teachers->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
    	return response()->json([$subjects, $teachers]);
    }

    public function assignSubjectStore(Request $request){

    	if($request->update == 0){
    		$i = 0;
            if(isset($request->subjects)){
        		foreach($request->subjects as $subject){
    	    		if($subject != ""){
    		    		$assign_subject = New SmAssignSubject();
    		    		$assign_subject->class_id = $request->class_id;
    		    		$assign_subject->section_id = $request->section_id;
    		    		$assign_subject->subject_id = $subject;
    		    		$assign_subject->teacher_id = $request->teachers[$i];
    		    		$assign_subject->save();
    		    		$i++;
    		    	}
    	    	}
            }
    	}elseif($request->update == 1){
    		$assign_subjects = SmAssignSubject::where('class_id', $request->class_id)->where('section_id', $request->section_id)->delete();

    		$i = 0;
            if(isset($request->subjects)){
        		foreach($request->subjects as $subject){

    	    		if($subject != ""){
    		    		$assign_subject = New SmAssignSubject();
    		    		$assign_subject->class_id = $request->class_id;
    		    		$assign_subject->section_id = $request->section_id;
    		    		$assign_subject->subject_id = $subject;
    		    		$assign_subject->teacher_id = $request->teachers[$i];
    		    		$assign_subject->save();
    		    		$i++;
    		    	}
    	    	}
            }
    	}


        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            return ApiBaseMethod::sendResponse(null, 'Record Updated Successfully');
        }
    	return redirect()->back()->with('message-success', 'Record Updated Successfully');
    }

    public function assignSubjectFind(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
    		'class' => 'required',
    		'section' => 'required'
    	]);
        if($validator->fails()){
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $assign_subjects = SmAssignSubject::where('class_id', $request->class)->where('section_id', $request->section)->get();
    	$subjects = SmSubject::where('active_status', 1)->get();
    	$teachers = SmStaff::where('active_status', 1)->where('role_id', 4)->get();
    	$classes = SmClass::where('active_status', 1)->get();



    	if($assign_subjects->count() == 0){
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                return ApiBaseMethod::sendError('No Result Found');
            }
    		return redirect()->back()->with('message-danger', 'No Result Found');
    	}else{
            $class_id = $request->class;

            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                $data=[];
                $data['classes']= $classes->toArray();
                $data['assign_subjects']= $assign_subjects->toArray();
                $data['teachers']= $teachers->toArray();
                $data['subjects']= $subjects->toArray();
                $data['class_id']= $class_id;
                return ApiBaseMethod::sendResponse($data, null);
            }
    		return view('backEnd.academics.assign_subject', compact('classes', 'assign_subjects', 'teachers', 'subjects', 'class_id'));
    	}
    }

    public function ajaxSelectSubject(Request $request){
        $subject_all = SmAssignSubject::where('class_id', '=', $request->class)->where('section_id', $request->section)->distinct('subject_id')->get();

        $students = [];
        foreach($subject_all as $allSubject){
            $students[] = SmSubject::find($allSubject->subject_id);
        }

        return response()->json([$students]);
    }

    public function assignRoutineSearch(Request $request){
    	$request->validate([
    		'class' => 'required',
    		'section' => 'required',
    		'subject' => 'required'
    	]);

    	$class_id = $request->class;
    	$section_id = $request->section;
    	$subject_id = $request->subject;
    	$classes = SmClass::where('active_status', 1)->get();


    	$class_routine = SmClassRoutine::where('class_id', $request->class)->where('section_id', $request->section)->where('subject_id', $request->subject)->first();
    	if($class_routine == ""){
    		$class_routine = "hello";
    	}


    	return view('backEnd.academics.class_routine_create', compact('class_routine', 'class_id', 'section_id', 'subject_id', 'classes'));
    }

    public function assignRoutineStore(Request $request){



    	$check_assigned = $class_routine = SmClassRoutine::where('class_id', $request->class_id)->where('section_id', $request->section_id)->where('subject_id', $request->subject_id)->delete();

    	// if($check_assigned != ""){
    		$class_routine = new SmClassRoutine();
	    	$class_routine->class_id = $request->class_id;
	    	$class_routine->section_id = $request->section_id;
	    	$class_routine->subject_id = $request->subject_id;

	    	$class_routine->monday_start_from = $request->monday_start_from;
	    	$class_routine->monday_end_to = $request->monday_end_to;
	    	$class_routine->monday_room_id = $request->monday_room;
	    	
	    	$class_routine->tuesday_start_from = $request->tuesday_start_from;
	    	$class_routine->tuesday_end_to = $request->tuesday_end_to;
	    	$class_routine->tuesday_room_id = $request->tuesday_room; 
	    	   	
	    	$class_routine->wednesday_start_from = $request->wednesday_start_from;
	    	$class_routine->wednesday_end_to = $request->wednesday_end_to;
	    	$class_routine->wednesday_room_id = $request->wednesday_room;
	    	   	
	    	$class_routine->thursday_start_from = $request->thursday_start_from;
	    	$class_routine->thursday_end_to = $request->thursday_end_to;
	    	$class_routine->thursday_room_id = $request->thursday_room;
	    	   	
	    	$class_routine->friday_start_from = $request->friday_start_from;
	    	$class_routine->friday_end_to = $request->friday_end_to;
	    	$class_routine->friday_room_id = $request->friday_room;
	    	   	
	    	$class_routine->saturday_start_from = $request->saturday_start_from;
	    	$class_routine->saturday_end_to = $request->saturday_end_to;
	    	$class_routine->saturday_room_id = $request->saturday_room;
	    	   	
	    	$class_routine->sunday_start_from = $request->sunday_start_from;
	    	$class_routine->sunday_end_to = $request->sunday_end_to;
	    	$class_routine->sunday_room_id = $request->sunday_room;
	    	$class_routine->save();
    	// }else{

    	// }

    	

    	return redirect('class-routine')->with('message-success', 'Class Routine has been Inserted successfully');

    }

    public function classRoutineReportSearch(Request $request){
    	$request->validate([
    		'class' => 'required',
    		'section' => 'required'
    	]);
    	$classes = SmClass::where('active_status', 1)->get();

    	$class_routines = SmClassRoutine::where('class_id', $request->class)->where('section_id', $request->section)->get();
        $class_id = $request->class;
    	return view('backEnd.academics.class_routine', compact('class_routines', 'classes', 'class_id'));
    }

    public function classReport(Request $request){
        $classes = SmClass::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($classes, null);
        }
        return view('backEnd.reports.class_report', compact('classes'));
    }

    public function classReportSearch(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'class' => 'required'
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $class = SmClass::where('id', $request->class)->first();

        if($request->section != ""){
            $section = SmSection::where('id', $request->section)->first();
        }else{
            $section = '';
        }

        $students = SmStudent::query();
        $students->where('active_status', 1);
        if($request->section != ""){
            $students->where('section_id', $request->section);
        }
        $students->where('class_id', $request->class);
        $students = $students->get();


        $assign_subjects = SmAssignSubject::query();
        $assign_subjects->where('active_status', 1);
        if($request->section != ""){
            $assign_subjects->where('section_id', $request->section);
        }
        $assign_subjects->where('class_id', $request->class);
        $assign_subjects = $assign_subjects->get();


        $assign_class_teacher = SmAssignClassTeacher::query();
        $assign_class_teacher->where('active_status', 1);
        if($request->section != ""){
            $assign_class_teacher->where('section_id', $request->section);
        }
        $assign_class_teacher->where('class_id', $request->class);
        $assign_class_teacher = $assign_class_teacher->first();
        if($assign_class_teacher != ""){
            $assign_class_teachers = $assign_class_teacher->classTeachers->first();
        }else{
            $assign_class_teachers = '';
        }
        




        $total_collection = 0;
        $total_assign = 0;
        foreach($students as $student){
            $fees_assigns = SmFeesAssign::where("student_id", $student->id)->where('active_status', 1)->get();
            foreach($fees_assigns as $fees_assign){
                $fees_masters = SmFeesMaster::where('id', $fees_assign->fees_master_id)->get();
                foreach($fees_masters as $fees_master){
                    $total_collection = $total_collection + SmFeesPayment::where('student_id', $student->id)->where('fees_type_id', $fees_master->fees_type_id)->sum('amount');

                }
            }

            foreach($fees_assigns as $fees_assign){
                $fees_master = SmFeesMaster::where('id', $fees_assign->fees_master_id)->first();
                if($fees_master->fees_group_id != 1 && $fees_master->fees_group_id != 2){
                   $total_assign = $total_assign + $fees_master->amount;
                }elseif($fees_master->fees_group_id == 1){
                    $total_assign = $total_assign + $student->route->far;
                }else{
                    $total_assign = $total_assign + $student->room->cost_per_bed;
                }
            }
        }


        $classes = SmClass::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['classes'] = $classes->toArray();
            $data['students'] = $students->toArray();
            $data['assign_subjects'] = $assign_subjects;
            $data['assign_class_teachers'] = $assign_class_teachers;
            $data['total_collection'] = $total_collection;
            $data['total_assign'] = $total_assign;
            $data['class'] = $class;
            $data['section'] = $section;
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.reports.class_report', compact('classes', 'students', 'assign_subjects', 'assign_class_teachers', 'total_collection', 'total_assign', 'class', 'section'));
    }


}
