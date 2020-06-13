<?php

namespace App\Http\Controllers\teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SmAssignSubject;
use App\SmClassRoutine;
use App\SmClassTime;
use App\SmWeekend;
use App\SmStaff;
use App\SmStudent;
use App\SmClass;

use App\SmHomework;
use App\SmLeaveRequest;

use App\SmNotification;
use App\SmTeacherUploadContent;

use DB;
use Auth;
use Validator;
use App\ApiBaseMethod;

class TeacherApiController extends Controller
{
    public function viewTeacherRoutine()
    {

       
        $user = Auth::user();

        $class_times = SmClassTime::all();
        $teacher_id = $user->staff->id;

        $sm_weekends = SmWeekend::orderBy('order', 'ASC')->where('active_status', 1)->get();
        $teachers = SmStaff::select('id', 'full_name')->where('active_status', 1)->get();

        return view('backEnd.teacherPanel.view_class_routine', compact('class_times', 'teacher_id', 'sm_weekends', 'teachers'));
    }

    public function searchStudent(Request $request)
    {


        $class_id = $request->class;
        $section_id = $request->section;
        $name = $request->name;
        $roll_no = $request->roll_no;



        $students = '';
        $msg = '';

        if (!empty($request->class) && !empty($request->section)) {
            $students = DB::table('sm_students')
                ->select('student_photo', 'full_name', 'roll_no', 'class_name', 'section_name', 'user_id')
                ->join('sm_sections', 'sm_sections.id', '=', 'sm_students.section_id')
                ->join('sm_classes', 'sm_classes.id', '=', 'sm_students.class_id')
                ->where('sm_students.class_id', $request->class)
                ->where('sm_students.section_id', $request->section)
                ->get();
            $msg = "Student Found";
        } elseif (!empty($request->class)) {
            $students = DB::table('sm_students')
                ->select('student_photo', 'full_name', 'roll_no', 'class_name', 'section_name', 'user_id')
                ->join('sm_sections', 'sm_sections.id', '=', 'sm_students.section_id')
                ->join('sm_classes', 'sm_classes.id', '=', 'sm_students.class_id')
                ->where('sm_students.class_id', $class_id)
                // ->where('section_id',$section_id)
                ->get();
            $msg = "Student Found";
        } elseif ($request->name != "") {
            $students = DB::table('sm_students')
                ->select('student_photo', 'full_name', 'roll_no', 'class_name', 'section_name', 'user_id')
                ->join('sm_sections', 'sm_sections.id', '=', 'sm_students.section_id')
                ->join('sm_classes', 'sm_classes.id', '=', 'sm_students.class_id')
                ->where('full_name', 'like', '%' . $request->name . '%')
                ->first();
            $msg = "Student Found";
        } elseif ($request->roll_no != "") {
            $students = DB::table('sm_students')
                ->select('student_photo', 'full_name', 'roll_no', 'class_name', 'section_name', 'user_id')
                ->join('sm_sections', 'sm_sections.id', '=', 'sm_students.section_id')
                ->join('sm_classes', 'sm_classes.id', '=', 'sm_students.class_id')
                ->where('roll_no', 'like', '%' . $request->roll_no . '%')
                ->first();
            $msg = "Student Found";
        } else {

            $msg = "Student Not Found";
        }



        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['students'] = $students;

            return ApiBaseMethod::sendResponse($data, $msg);
        }
    }
    public function myRoutine(Request $request, $id)
    {
        $teacher = DB::table('sm_staffs')
            ->where('user_id', '=', $id)
            ->first();
        $teacher_id = $teacher->id;

        $sm_weekends = SmWeekend::orderBy('order', 'ASC')->where('active_status', 1)->get();
        $class_times = SmClassTime::where('type', 'class')->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $weekenD = SmWeekend::all();
            foreach ($weekenD as $row) {
                $data[$row->name] = DB::table('sm_class_routine_updates')
                    ->select('class_id', 'class_name', 'section_id', 'section_name', 'sm_class_times.period', 'sm_class_times.start_time', 'sm_class_times.end_time', 'sm_subjects.subject_name', 'sm_class_rooms.room_no')
                    ->join('sm_classes', 'sm_classes.id', '=', 'sm_class_routine_updates.class_id')
                    ->join('sm_sections', 'sm_sections.id', '=', 'sm_class_routine_updates.section_id')
                    ->join('sm_class_times', 'sm_class_times.id', '=', 'sm_class_routine_updates.class_period_id')
                    ->join('sm_subjects', 'sm_subjects.id', '=', 'sm_class_routine_updates.subject_id')
                    ->join('sm_class_rooms', 'sm_class_rooms.id', '=', 'sm_class_routine_updates.room_id')

                    ->where([
                        ['sm_class_routine_updates.teacher_id', $teacher_id], ['sm_class_routine_updates.day', $row->id],
                    ])->get();
            }

            return ApiBaseMethod::sendResponse($data, null);
        }
    }
    public function sectionRoutine(Request $request, $id, $class, $section)
    {
        $teacher = DB::table('sm_staffs')
            ->where('user_id', '=', $id)
            ->first();
        $teacher_id = $teacher->id;

        $sm_weekends = SmWeekend::orderBy('order', 'ASC')->where('active_status', 1)->get();
        $class_times = SmClassTime::where('type', 'class')->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $weekenD = SmWeekend::all();
            foreach ($weekenD as $row) {
                $data[$row->name] = DB::table('sm_class_routine_updates')
                    ->select('sm_class_times.period', 'sm_class_times.start_time', 'sm_class_times.end_time', 'sm_subjects.subject_name', 'sm_class_rooms.room_no')
                    ->join('sm_classes', 'sm_classes.id', '=', 'sm_class_routine_updates.class_id')
                    ->join('sm_sections', 'sm_sections.id', '=', 'sm_class_routine_updates.section_id')
                    ->join('sm_class_times', 'sm_class_times.id', '=', 'sm_class_routine_updates.class_period_id')
                    ->join('sm_subjects', 'sm_subjects.id', '=', 'sm_class_routine_updates.subject_id')
                    ->join('sm_class_rooms', 'sm_class_rooms.id', '=', 'sm_class_routine_updates.room_id')

                    ->where([
                        ['sm_class_routine_updates.teacher_id', $teacher_id],
                        ['sm_class_routine_updates.class_id', $class],
                        ['sm_class_routine_updates.section_id', $section],
                        ['sm_class_routine_updates.day', $row->id],
                    ])->get();
            }

            return ApiBaseMethod::sendResponse($data, null);
        }
    }
    public function classSection(Request $request, $id)
    {

        $teacher = DB::table('sm_staffs')
            ->where('user_id', '=', $id)
            ->first();
        $teacher_id = $teacher->id;

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $teacher_classes = DB::table('sm_assign_subjects')
                ->join('sm_classes', 'sm_classes.id', '=', 'sm_assign_subjects.class_id')
                ->join('sm_sections', 'sm_sections.id', '=', 'sm_assign_subjects.section_id')
                ->distinct('class_id')

                ->where('teacher_id', $teacher_id)
                ->get();

            // return  $teacher_classes;
            foreach ($teacher_classes as $class) {
                $data[$class->class_name] = DB::table('sm_assign_subjects')
                    ->join('sm_subjects', 'sm_subjects.id', '=', 'sm_assign_subjects.subject_id')
                    ->join('sm_sections', 'sm_sections.id', '=', 'sm_assign_subjects.section_id')
                    ->select('section_name', 'subject_name')
                    ->distinct('section_id')
                    ->where([
                        ['sm_assign_subjects.class_id', $class->id],
                        ['sm_assign_subjects.teacher_id', $teacher_id],
                    ])->get();
            }

            return ApiBaseMethod::sendResponse($data, null);
        }
    }
    public function teacherClassList(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => "required",
            
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $teacher = DB::table('sm_staffs')
            ->where('user_id', '=', $request->id)
            ->first();
        $teacher_id = $teacher->id;

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $teacher_classes = DB::table('sm_assign_subjects')
                ->join('sm_classes', 'sm_classes.id', '=', 'sm_assign_subjects.class_id')
                ->join('sm_sections', 'sm_sections.id', '=', 'sm_assign_subjects.section_id')
                ->distinct('class_id')
                ->select('class_id', 'class_name')
                ->where('teacher_id', $teacher_id)
                ->get();
            $data['teacher_classes'] = $teacher_classes->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
    }
    public function teacherSectionList(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => "required",
            'class' => "required",
            
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $teacher = DB::table('sm_staffs')
            ->where('user_id', '=', $request->id)
            ->first();
        $teacher_id = $teacher->id;

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $teacher_classes = DB::table('sm_assign_subjects')
                ->join('sm_classes', 'sm_classes.id', '=', 'sm_assign_subjects.class_id')
                ->join('sm_sections', 'sm_sections.id', '=', 'sm_assign_subjects.section_id')
                ->distinct('section_id')
                ->select('section_id', 'section_name')
                ->where('teacher_id', $teacher_id)
                ->where('class_id', $request->class)
                ->get();
            $data['teacher_sections'] = $teacher_classes->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
    }
    //Some Changes
    public function subjectsName(Request $request, $id)
    {
        $teacher = DB::table('sm_staffs')
            ->where('user_id', '=', $id)
            ->first();
        $teacher_id = $teacher->id;

        $subjectsName = DB::table('sm_assign_subjects')
            ->join('sm_subjects', 'sm_subjects.id', '=', 'sm_assign_subjects.subject_id')
            ->select('subject_id', 'subject_name', 'subject_code', 'subject_type')
            ->where('sm_assign_subjects.active_status', 1)
            ->where('teacher_id', $teacher_id)
            ->distinct('subject_id')
            ->get();
        $subject_type = 'T=Theory, P=Practical';
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data['subjectsName'] = $subjectsName->toArray();
            $data['subject_type'] = $subject_type;
            return ApiBaseMethod::sendResponse($data, null);
        }
    }
    public function addHomework(Request $request)
    {

        // return $request->all();
        $request->validate([
            'class' => "required",
            'section' => "required",
            'subject' => "required",
            'assign_date' => "required",
            'submission_date' => "required",
            'description' => "required",
            'marks' => "required"
        ]);

        $fileName = "";
        if ($request->file('homework_file') != "") {

            $file = $request->file('homework_file');
            $fileName = $request->teacher_id . time() . "." . $file->getClientOriginalExtension();
            //$fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/homework/', $fileName);
            $fileName = 'public/uploads/homework/' . $fileName;
        }

        $homeworks = new SmHomework;
        $homeworks->class_id = $request->class;
        $homeworks->section_id = $request->section;
        $homeworks->subject_id = $request->subject;
        $homeworks->marks = $request->marks;
        $homeworks->created_by = $request->teacher_id;
        $homeworks->homework_date = $request->assign_date;
        $homeworks->submission_date = $request->submission_date;
        //$homeworks->marks = $request->marks;
        $homeworks->description = $request->description;
        if ($fileName != "") {
            $homeworks->file = $fileName;
        }
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            $results = $homeworks->save();

            return ApiBaseMethod::sendResponse($results, null);
        }
    }
    public function homeworkList2(Request $request, $id)
    {

        $teacher = DB::table('sm_staffs')
            ->where('user_id', '=', $id)
            ->first();
        $teacher_id = $teacher->id;

        $homeworkLists = SmHomework::where('sm_homeworks.created_by', '=', $teacher_id)
            ->join('sm_classes', 'sm_homeworks.class_id', '=', 'sm_classes.id')
            ->join('sm_sections', 'sm_homeworks.section_id', '=', 'sm_sections.id')
            ->join('sm_subjects', 'sm_homeworks.subject_id', '=', 'sm_subjects.id')
            ->select('homework_date', 'submission_date', 'evaluation_date', 'file', 'sm_homeworks.marks', 'description', 'subject_name', 'class_name', 'section_name')
            ->get();


        $classes = SmClass::where('active_status', '=', '1')->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];

            return ApiBaseMethod::sendResponse($homeworkLists, null);
        }
    }
    public function homeworkList(Request $request, $id)
    {




        $teacher = SmStaff::where('user_id', '=', $id)->first();
        $teacher_id = $teacher->id;


        $subject_list = SmAssignSubject::where('teacher_id', '=', $teacher_id)->get();

        $i = 0;
        foreach ($subject_list as $subject) {
            $homework_subject_list[$subject->subject->subject_name] = $subject->subject->subject_name;
            $allList[$subject->subject->subject_name] = DB::table('sm_homeworks')
                ->leftjoin('sm_subjects', 'sm_subjects.id', '=', 'sm_homeworks.subject_id')
                ->where('sm_homeworks.created_by', $teacher_id)
                ->where('subject_id', $subject->subject_id)->get()->toArray();;
        }

        foreach ($allList as $single) {
            foreach ($single as $singleHw) {
                $std_homework = DB::table('sm_homework_students')
                    ->select('homework_id', 'complete_status')
                    ->where('homework_id', '=', $singleHw->id)
                    ->where('complete_status', 'C')
                    ->first();

                $d['homework_id'] = $singleHw->id;
                $d['description'] = $singleHw->description;
                $d['subject_name'] = $singleHw->subject_name;
                $d['homework_date'] = $singleHw->homework_date;
                $d['submission_date'] = $singleHw->submission_date;
                $d['evaluation_date'] = $singleHw->evaluation_date;
                $d['file'] = $singleHw->file;
                $d['marks'] = $singleHw->marks;

                if (!empty($std_homework)) {
                    $d['status'] = 'C';
                } else {
                    $d['status'] = 'I';
                }
                $kijanidibo[] = $d;
            }
        }
        // return $kijanidibo;

        //$homeworkLists = SmHomework::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->get();


        // dd($allList);
        $data = [];

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            $data = $kijanidibo;
            return ApiBaseMethod::sendResponse($data, null);
        }
    }

    public function teacherMyAttendanceSearchAPI(Request $request, $id = null)
    {

        $input = $request->all();

        $validator = Validator::make($input, [
            'month' => "required",
            'year' => "required",
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $teacher = SmStaff::where('user_id', $id)->first();

        $year = $request->year;
        $month = $request->month;
        if ($month < 10) {
            $month = '0' . $month;
        }
        $current_day = date('d');

        $days = cal_days_in_month(CAL_GREGORIAN, $month, $request->year);
        $days2 = cal_days_in_month(CAL_GREGORIAN, $month - 1, $request->year);
        $previous_month = $month - 1;
        $previous_date = $year . '-' . $previous_month . '-' . $days2;



        $previousMonthDetails['date'] = $previous_date;
        $previousMonthDetails['day'] = $days2;
        $previousMonthDetails['week_name'] = date('D', strtotime($previous_date));


        $attendances = SmStaffAttendance::where('student_id', $teacher->id)
            ->where('attendance_date', 'like', '%' . $request->year . '-' . $month . '%')
            ->select('attendance_type', 'attendance_date')
            ->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data['attendances'] = $attendances;
            $data['previousMonthDetails'] = $previousMonthDetails;
            $data['days'] = $days;
            $data['year'] = $year;
            $data['month'] = $month;
            $data['current_day'] = $current_day;
            $data['status'] = 'Present: P, Late: L, Absent: A, Holiday: H, Half Day: F';
            return ApiBaseMethod::sendResponse($data, null);
        }
        //Test
        //return view('backEnd.studentPanel.student_attendance', compact('attendances', 'days', 'year', 'month', 'current_day'));
    }
    public function applyLeave(Request $request)
    {


        $input = $request->all();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'apply_date' => "required",
                'leave_type' => "required",
                'leave_from' => 'required|before_or_equal:leave_to',
                'leave_to' => "required",
                'teacher_id' => "required",
                'reason' => "required",

            ]);
        }

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
        }

        //return $request->input('apply_date');

        $fileName = "";
        if ($request->file('attach_file') != "") {
            $file = $request->file('attach_file');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/leave_request/', $fileName);
            $fileName = 'public/uploads/leave_request/' . $fileName;
        }

        $apply_leave = new SmLeaveRequest();
        $apply_leave->staff_id = $request->input('teacher_id');
        $apply_leave->role_id = 4;
        $apply_leave->apply_date = date('Y-m-d');
        $apply_leave->leave_define_id = $request->input('leave_type');
        $apply_leave->leave_from = $request->input('leave_from');
        $apply_leave->leave_to = $request->input('leave_to');
        $apply_leave->approve_status = 'P';
        $apply_leave->reason = $request->input('reason');
        //return $request->teacher_id;
        if ($fileName != "") {
            $apply_leave->file = $fileName;
        }

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            $result = $apply_leave->save();

            return ApiBaseMethod::sendResponse($result, null);
        }
    }


    public function staffLeaveList(Request $request, $id)
    {

        $teacher = SmStaff::where('user_id', '=', $id)->first();
        $teacher_id = $teacher->id;

        $leave_list = SmLeaveRequest::where('staff_id', '=', $teacher_id)
            ->join('sm_leave_defines', 'sm_leave_defines.id', '=', 'sm_leave_requests.leave_define_id')
            ->join('sm_leave_types', 'sm_leave_types.id', '=', 'sm_leave_defines.type_id')
            ->get();
        $status = 'P for Pending, A for Approve, R for reject';
        $data = [];
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data['leave_list'] = $leave_list->toArray();
            $data['status'] = $status;
            return ApiBaseMethod::sendResponse($data, null);
        }
    }

    public function leaveTypeList(Request $request)
    {
        //return "Api URL";
        $leave_type = DB::table('sm_leave_defines')
            ->where('role_id', 4)
            ->join('sm_leave_types', 'sm_leave_types.id', '=', 'sm_leave_defines.type_id')
            ->where('sm_leave_defines.active_status', 1)
            ->select('sm_leave_types.id', 'type', 'total_days')
            ->distinct('sm_leave_defines.type_id')
            ->get();

        //return $leave_type;
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($leave_type, null);
        }
    }
    // public function contentType(){

    // 	$content_type='as assignment, st study material, sy sullabus, ot others download';
    // 	return $content_type;
    // }
    public function uploadContent(Request $request)
    {


        $input = $request->all();
        //return $request->input();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'content_title' => "required",
                'content_type' => "required",
                'upload_date' => "required",
                'description' => "required"


            ]);
        }
        //as assignment, st study material, sy sullabus, ot others download

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
        }
        if (empty($request->input('available_for'))) {

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', 'Content Receiver not selected');
            }
        }


        $fileName = "";
        if ($request->file('attach_file') != "") {
            $file = $request->file('attach_file');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/upload_contents/', $fileName);
            $fileName = 'public/uploads/upload_contents/' . $fileName;
        }

        $uploadContents = new SmTeacherUploadContent();
        $uploadContents->content_title = $request->input('content_title');
        $uploadContents->content_type = $request->input('content_type');



        if ($request->input('available_for') == 'admin') {
            $uploadContents->available_for_admin = 1;
        } elseif ($request->input('available_for') == 'student') {
            if (!empty($request->input('all_classes'))) {
                $uploadContents->available_for_all_classes = 1;
            } else {
                $uploadContents->class = $request->input('class');
                $uploadContents->section = $request->input('section');
            }
        }

        //return $request->input();

        $uploadContents->upload_date = date('Y-m-d', strtotime($request->input('upload_date')));
        $uploadContents->description = $request->input('description');
        $uploadContents->upload_file = $fileName;
        $uploadContents->created_by = $request->input('created_by');
        $results = $uploadContents->save();


        if ($request->input('content_type') == 'as') {
            $purpose = 'assignment';
        } elseif ($request->input('content_type') == 'st') {
            $purpose = 'Study Material';
        } elseif ($request->input('content_type') == 'sy') {
            $purpose = 'Syllabus';
        } elseif ($request->input('content_type') == 'ot') {
            $purpose = 'Others Download';
        }


        // foreach ($request->input('available_for') as $value) {
        if ($request->input('available_for') == 'admin') {
            $roles = Role::where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 9)->get();

            foreach ($roles as $role) {
                $staffs = SmStaff::where('role_id', $role->id)->get();
                foreach ($staffs as $staff) {
                    $notification = new SmNotification;
                    $notification->user_id = $staff->user_id;
                    $notification->role_id = $role->id;
                    $notification->date = date('Y-m-d');
                    $notification->message = $purpose . ' updated';
                    $notification->save();
                }
            }
        }
        if ($request->input('available_for') == 'student') {
            if (!empty($request->input('all_classes'))) {
                $students = SmStudent::select('id')->get();
                foreach ($students as $student) {
                    $notification = new SmNotification;
                    $notification->user_id = $student->user_id;
                    $notification->role_id = 2;
                    $notification->date = date('Y-m-d');
                    $notification->message = $purpose . ' updated';
                    $notification->save();
                }
            } else {
                $students = SmStudent::select('id')->where('class_id', $request->input('class'))->where('section_id', $request->input('section'))->get();
                foreach ($students as $student) {
                    $notification = new SmNotification;
                    $notification->user_id = $student->user_id;
                    $notification->role_id = 2;
                    $notification->date = date('Y-m-d');
                    $notification->message = $purpose . ' updated';
                    $notification->save();
                }
            }
        }
        // }

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            $data = '';

            return ApiBaseMethod::sendResponse($data, null);
        }
    }
    public function contentList(Request $request)
    {
        $content_list = DB::table('sm_teacher_upload_contents')
            ->where('available_for_admin', '<>', 0)
            ->get();
        $type = "as assignment, st study material, sy sullabus, ot others download";
        $data = [];
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data['content_list'] = $content_list->toArray();
            $data['type'] = $type;


            return ApiBaseMethod::sendResponse($data, null);
        }
    }
    public function deleteContent(Request $request, $id)
    {
        $content = DB::table('sm_teacher_upload_contents')->where('id', $id)->delete();
        //$res=User::where('id',$id)->delete();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = '';
            return ApiBaseMethod::sendResponse($data, null);
        }
    }
}
