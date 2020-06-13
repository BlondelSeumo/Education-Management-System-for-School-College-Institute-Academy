<?php

namespace App\Http\Controllers;

use Validator;
use App\SmClass;
use App\SmStudent;
use App\ApiBaseMethod;
use App\SmStudentAttendance;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SmStudentAttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }

    public function index(Request $request)
    {
        $classes = SmClass::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($classes, null);
        }
        return view('backEnd.studentInformation.student_attendance', compact('classes'));
    }

    public function studentSearch(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'class' => 'required',
            'section' => 'required',
            'attendance_date' => 'required'
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $date = $request->attendance_date;
        $classes = SmClass::where('active_status', 1)->get();



        $students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->where('active_status', 1)->get();

        if ($students->isEmpty()) {
            Toastr::error('No Result Found', 'Failed');
            return redirect('student-attendance');
        }

        $already_assigned_students = [];
        $new_students = [];
        $attendance_type = "";
        foreach ($students as $student) {
            $attendance = SmStudentAttendance::where('student_id', $student->id)->where('attendance_date', date('Y-m-d', strtotime($request->attendance_date)))->first();

            if ($attendance != "") {
                $already_assigned_students[] = $attendance;
                $attendance_type =  $attendance->attendance_type;
            } else {
                $new_students[] =  $student;
            }
        }

        $class_id = $request->class;

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['classes'] = $classes->toArray();
            $data['date'] = $date;
            $data['class_id'] = $class_id;
            $data['already_assigned_students'] = $already_assigned_students;
            $data['new_students'] = $new_students;
            $data['attendance_type'] = $attendance_type;
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.studentInformation.student_attendance', compact('classes', 'date', 'class_id', 'date', 'already_assigned_students', 'new_students', 'attendance_type'));
    }

    public function studentAttendanceStore(Request $request)
    {

        foreach ($request->id as $student) {
            $attendance = SmStudentAttendance::where('student_id', $student)->where('attendance_date', date('Y-m-d', strtotime($request->date)))->first();

            if ($attendance != "") {
                $attendance->delete();
            }


            $attendance = new SmStudentAttendance();
            $attendance->student_id = $student;
            if (isset($request->mark_holiday)) {
                $attendance->attendance_type = "H";
            } else {
                $attendance->attendance_type = $request->attendance[$student];
                $attendance->notes = $request->note[$student];
            }
            $attendance->attendance_date = date('Y-m-d', strtotime($request->date));
            $attendance->save();
        }

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse(null, 'Student attendance been submitted successfully');
        }
        Toastr::success('Operation successful', 'Success');
        return redirect('student-attendance');
    }


    public function studentAttendanceHoliday(Request $request)
    {
        dd($request->all());
    }
}
