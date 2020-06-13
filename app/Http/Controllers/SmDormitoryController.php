<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmClass;
use App\SmStudent;
use App\SmDormitoryList;
use App\SmRoomList;

class SmDormitoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }

    
    public function studentDormitoryReport(Request $request){
    	$classes = SmClass::where('active_status', 1)->get();
    	$dormitories = SmDormitoryList::where('active_status', 1)->get();
    	$students = SmStudent::where('active_status', 1)->where('dormitory_id', '!=', "")->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['classes'] = $classes->toArray();
            $data['dormitories'] = $dormitories->toArray();
            $data['students'] = $students->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
    	return view('backEnd.dormitory.student_dormitory_report', compact('classes','students', 'dormitories'));
    }

    
    public function studentDormitoryReportSearch(Request $request){

    	$students = SmStudent::query();
        $students->where('active_status', 1);
        if($request->class != ""){
            $students->where('class_id', $request->class);
        }
         if($request->section != ""){
            $students->where('section_id', $request->section);
        }
        if($request->dormitory != ""){
            $students->where('dormitory_id', $request->dormitory);
        }else{
        	$students->where('dormitory_id', '!=', '');
        }
        $students = $students->get();

        $classes = SmClass::where('active_status', 1)->get();
    	$dormitories = SmDormitoryList::where('active_status', 1)->get();

        $class_id = $request->class;
        $dormitory_id = $request->dormitory;

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['classes'] = $classes->toArray();
            $data['dormitories'] = $dormitories->toArray();
            $data['students'] = $students->toArray();
            $data['class_id'] = $class_id;
            $data['dormitory_id'] = $dormitory_id;
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.dormitory.student_dormitory_report', compact('classes', 'dormitories', 'students', 'class_id', 'dormitory_id'));
    }
}
