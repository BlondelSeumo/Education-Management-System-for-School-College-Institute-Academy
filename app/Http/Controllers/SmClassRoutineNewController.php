<?php

namespace App\Http\Controllers;

use Validator;
use App\SmClass;
use App\SmStaff;
use App\SmWeekend;
use App\SmClassRoom;
use App\SmClassTime;
use App\ApiBaseMethod;
use App\SmAssignSubject;
use Illuminate\Http\Request;
use App\SmClassRoutineUpdate;

class SmClassRoutineNewController extends Controller
{

    public function __construct()
    {
        $this->middleware('PM');
    }

    public function classRoutine(Request $request)
    {
        $classes = SmClass::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($classes, null);
        }
        return view('backEnd.academics.class_routine_new', compact('classes'));
    }

    public function classRoutineSearch(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'class' => 'required',
            'section' => 'required'
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $class_times = SmClassTime::where('type', 'class')->get();
        $class_id = $request->class;
        $section_id = $request->section;

        $sm_weekends = SmWeekend::orderBy('order', 'ASC')->where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['classes'] = $classes->toArray();
            $data['class_times'] = $class_times->toArray();
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;
            $data['sm_weekends'] = $sm_weekends;
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.academics.class_routine_new', compact('classes', 'class_times', 'class_id', 'section_id', 'sm_weekends'));
    }

    public function addNewClassRoutine($class_time_id, $day, $class_id, $section_id)
    {

        $assinged_subjects = SmClassRoutineUpdate::select('subject_id')->where('class_id', $class_id)->where('section_id', $section_id)->where('day', $day)->get();


        $assinged_subject = [];
        foreach ($assinged_subjects as $value) {
            $assinged_subject[] = $value->subject_id;
        }


        $assinged_rooms = SmClassRoutineUpdate::select('room_id')->where('class_period_id', $class_time_id)->where('day', $day)->get();

        $assinged_room = [];
        foreach ($assinged_rooms as $value) {
            $assinged_room[] = $value->room_id;
        }




        $rooms = SmClassRoom::where('active_status', 1)->get();

        $subjects = SmAssignSubject::where('class_id', $class_id)->where('section_id', $section_id)->get();


        return view('backEnd.academics.add_new_class_routine_form', compact('rooms', 'subjects', 'day', 'class_time_id', 'class_id', 'section_id', 'assinged_subject', 'assinged_room'));
    }

    public function addNewClassRoutineEdit($class_time_id, $day, $class_id, $section_id, $subject_id, $room_id, $assigned_id, $teacher_id)
    {

        $assinged_subjects = SmClassRoutineUpdate::select('subject_id')->where('class_id', $class_id)->where('section_id', $section_id)->where('day', $day)->where('subject_id', '!=', $subject_id)->get();




        $assinged_subject = [];
        foreach ($assinged_subjects as $value) {
            $assinged_subject[] = $value->subject_id;
        }



        $assinged_rooms = SmClassRoutineUpdate::select('room_id')->where('room_id', '!=', $room_id)->where('class_period_id', $class_time_id)->where('day', $day)->get();

        $assinged_room = [];
        foreach ($assinged_rooms as $value) {
            $assinged_room[] = $value->room_id;
        }




        $rooms = SmClassRoom::where('active_status', 1)->get();
        $teacher_detail = SmStaff::select('id', 'full_name')->where('id', $teacher_id)->first();

        $subjects = SmAssignSubject::where('class_id', $class_id)->where('section_id', $section_id)->get();


        return view('backEnd.academics.add_new_class_routine_form', compact('rooms', 'subjects', 'day', 'class_time_id', 'class_id', 'section_id', 'assinged_subject', 'assinged_room', 'subject_id', 'room_id', 'assigned_id', 'teacher_detail'));
    }


    public function addNewClassRoutineStore(Request $request)
    {


        if (!isset($request->assigned_id)) {
            $check = SmClassRoutineUpdate::where('class_id', $request->class_id)->where('section_id', $request->section_id)->where('subject_id', $request->subject)->where('room_id', $request->room)->where('class_period_id', $request->class_time_id)->where('day', $request->day)->first();

            if ($check == "") {
                $class_routine = new SmClassRoutineUpdate();
                $class_routine->class_id = $request->class_id;
                $class_routine->section_id = $request->section_id;
                $class_routine->subject_id = $request->subject;
                $class_routine->teacher_id = $request->teacher_id;
                $class_routine->room_id = $request->room;
                $class_routine->class_period_id = $request->class_time_id;
                $class_routine->day = $request->day;
                $class_routine->save();
                \Session::flash('success', 'Class routine has been assigned successfully');
            }
        } else {
            $class_routine = SmClassRoutineUpdate::find($request->assigned_id);
            $class_routine->class_id = $request->class_id;
            $class_routine->section_id = $request->section_id;
            $class_routine->subject_id = $request->subject;
            $class_routine->teacher_id = $request->teacher_id;
            $class_routine->room_id = $request->room;
            $class_routine->class_period_id = $request->class_time_id;
            $class_routine->day = $request->day;
            $class_routine->save();
            \Session::flash('success', 'Class routine has been updated successfully');
        }


        //$class_times = SmClassTime::all();
        $class_id = $request->class_id;
        $section_id = $request->section_id;

        //$classes = SmClass::where('active_status', 1)->get();
        //return view('backEnd.academics.class_routine_new', compact('classes', 'class_times', 'class_id', 'section_id'));

        return redirect('class-routine-new/' . $class_id . '/' . $section_id);
    }

    public function classRoutineRedirect($class_id, $section_id)
    {
        $sm_weekends = SmWeekend::orderBy('order', 'ASC')->where('active_status', 1)->get();
        $class_times = SmClassTime::where('type', 'class')->get();
        $classes = SmClass::where('active_status', 1)->get();
        return view('backEnd.academics.class_routine_new', compact('classes', 'class_times', 'class_id', 'section_id', 'sm_weekends'));
    }

    public function getClassTeacherAjax(Request $request)
    {


        $subject_teacher = SmAssignSubject::select('teacher_id')->where('class_id', $request->class_id)->where('section_id', $request->section_id)->where('subject_id', $request->subject)->first();




        $teacher_detail = '';
        $i = 0;
        if ($subject_teacher->teacher_id != "") {
            if ($request->update_teacher_id == "") {

                $already_assigned = SmClassRoutineUpdate::where('class_period_id', $request->class_time_id)->where('day', $request->day)->where('teacher_id', $subject_teacher->teacher_id)->first();
            } else {
                $already_assigned = SmClassRoutineUpdate::where('teacher_id', '!=', $request->update_teacher_id)->where('class_period_id', $request->class_time_id)->where('day', $request->day)->where('teacher_id', $subject_teacher->teacher_id)->first();
            }



            $i++;

            if ($already_assigned == "") {
                $teacher_detail = SmStaff::where('id', $subject_teacher->teacher_id)->first();
            }
        }

        return response()->json([$teacher_detail, $i]);
    }

    public function classRoutineReport(Request $request)
    {
        $classes = SmClass::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($classes, null);
        }
        return view('backEnd.reports.class_routine_report', compact('classes'));
    }

    public function classRoutineReportSearch(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'class' => 'required',
            'section' => 'required'
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $class_times = SmClassTime::where('type', 'class')->get();
        $class_id = $request->class;
        $section_id = $request->section;

        $sm_weekends = SmWeekend::orderBy('order', 'ASC')->where('active_status', 1)->get();

        $classes = SmClass::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['classes'] = $classes->toArray();
            $data['class_times'] = $class_times->toArray();
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;
            $data['sm_weekends'] = $sm_weekends->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.reports.class_routine_report', compact('classes', 'class_times', 'class_id', 'section_id', 'sm_weekends'));
    }
    public function teacherClassRoutineReport(Request $request)
    {
        $teachers = SmStaff::select('id', 'full_name')->where('active_status', 1)->where('role_id', 4)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($teachers, null);
        }
        return view('backEnd.reports.teacher_class_routine_report', compact('teachers'));
    }

    public function teacherClassRoutineReportSearch(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'teacher' => 'required',
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $class_times = SmClassTime::where('type', 'class')->get();
        $teacher_id = $request->teacher;

        $sm_weekends = SmWeekend::orderBy('order', 'ASC')->where('active_status', 1)->get();
        $teachers = SmStaff::select('id', 'full_name')->where('active_status', 1)->get();

        $classes = SmClass::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['class_times'] = $class_times->toArray();
            $data['teacher_id'] = $teacher_id;
            $data['sm_weekends'] = $sm_weekends->toArray();
            $data['teachers'] = $teachers->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.reports.teacher_class_routine_report', compact('class_times', 'teacher_id', 'sm_weekends', 'teachers'));
    }

    public function deleteClassRoutineModal($id)
    {
        return view('backEnd.academics.delete_class_routine', compact('id'));
    }

    public function deleteClassRoutine($id)
    {

        $class_routine = SmClassRoutineUpdate::find($id);

        $class_id = $class_routine->class_id;
        $section_id = $class_routine->section_id;

        $result = $class_routine->delete();


        if ($result) {
            \Session::flash('success', 'Class routine has been deleted successfully');
        } else {
            \Session::flash('danger', 'Class routine has been deleted unsuccessfully');
        }
        return redirect('class-routine-new/' . $class_id . '/' . $section_id);
    }
}
