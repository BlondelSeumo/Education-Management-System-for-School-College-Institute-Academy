<?php

namespace App\Http\Controllers\Parent;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SmStudent;
use App\SmFeesCarryForward;
use App\SmFeesAssign;
use App\SmFeesAssignDiscount;
use App\SmFeesPayment;
use App\SmFeesMaster;
use App\SmFeesGroup;
use App\SmStudentDocument;
use App\SmStudentTimeline;
use App\SmExamSchedule;
use App\SmExamScheduleSubject;
use App\SmClass;
use App\SmSection;
use App\SmClassRoutine;
use App\SmStudentAttendance;
use App\SmAssignSubject;
use App\SmAssignVehicle;
use App\SmVehicle;
use App\SmRoute;
use App\SmRoomList;
use App\SmRoomType;
use App\SmDormitoryList;
use App\SmMarksGrade;
use App\SmParent;
use App\SmHomework;
use App\SmNoticeBoard;
use App\SmWeekend;
use App\SmClassTime;
use Validator;
use DB;
use Auth;
use Session;
use App\SmGeneralSettings;

class SmParentPanelController extends Controller
{


    public function parentDashboard()
    {

        return view('backEnd.parentPanel.parent_dashboard');
    }
    public function myChildren($id)
    {

        $student_detail = SmStudent::where('id', $id)->first();
        $driver = SmVehicle::where('sm_vehicles.id', $student_detail->vechile_id)
            ->join('sm_staffs', 'sm_vehicles.driver_id', '=', 'sm_staffs.id')
            ->first();
        //return $driver;
        $fees_assigneds = SmFeesAssign::where('student_id', $student_detail->id)->get();
        $fees_discounts = SmFeesAssignDiscount::where('student_id', $student_detail->id)->get();
        $documents = SmStudentDocument::where('student_staff_id', $student_detail->id)->where('type', 'stu')->get();
        $timelines = SmStudentTimeline::where('staff_student_id', $student_detail->id)->where('type', 'stu')->where('visible_to_student', 1)->get();
        $exams = SmExamSchedule::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->get();
        $grades = SmMarksGrade::where('active_status', 1)->get();
        return view('backEnd.parentPanel.my_children', compact('student_detail', 'fees_assigneds', 'driver', 'fees_discounts', 'exams', 'documents', 'timelines', 'grades'));
    }

    public function classRoutine($id)
    {
        $student_detail = SmStudent::where('id', $id)->first();

        //$classes = SmClass::where('active_status', 1)->get();

        //$class_routines = SmClassRoutine::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->get();


        //return view('backEnd.parentPanel.class_routine', compact('class_routines', 'classes', 'student_detail'));




        $class_id = $student_detail->class_id;
        $section_id = $student_detail->section_id;

        $sm_weekends = SmWeekend::orderBy('order', 'ASC')->where('active_status', 1)->get();
        $class_times = SmClassTime::where('type', 'class')->get();

        return view('backEnd.parentPanel.class_routine', compact('class_times', 'class_id', 'section_id', 'sm_weekends', 'student_detail'));
    }

    public function attendance($id)
    {
        $student_detail = SmStudent::where('id', $id)->first();
        return view('backEnd.parentPanel.attendance', compact('student_detail'));
    }

    public function attendanceSearch(Request $request)
    {
        $request->validate([
            'month' => 'required',
            'year' => 'required'
        ]);


        $student_detail = SmStudent::where('id', $request->student_id)->first();

        $year = $request->year;
        $month = $request->month;
        $current_day = date('d');

        $days = cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year);
        //$students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->get();


        $attendances = SmStudentAttendance::where('student_id', $student_detail->id)->where('attendance_date', 'like', $request->year . '-' . $request->month . '%')->get();

        return view('backEnd.parentPanel.attendance', compact('attendances', 'days', 'year', 'month', 'current_day', 'student_detail'));
    }

    public function examination($id)
    {

        $student_detail = SmStudent::where('id', $id)->first();


        $exams = SmExamSchedule::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->get();
        $grades = SmMarksGrade::where('active_status', 1)->get();


        return view('backEnd.parentPanel.student_result', compact('student_detail', 'exams', 'grades'));
    }

    public function subjects($id)
    {
        $student_detail = SmStudent::where('id', $id)->first();

        $assignSubjects = SmAssignSubject::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->get();


        return view('backEnd.parentPanel.subject', compact('assignSubjects', 'student_detail'));
    }

    public function teacherList($id)
    {

        $student_detail = SmStudent::where('id', $id)->first();
        $teachers = SmAssignSubject::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->get()->unique('teacher_id');


        return view('backEnd.parentPanel.teacher_list', compact('teachers', 'student_detail'));
    }

    public function transport($id)
    {
        $student_detail = SmStudent::where('id', $id)->first();

        $routes = SmAssignVehicle::where('active_status', 1)->get();

        return view('backEnd.parentPanel.transport', compact('routes', 'student_detail'));
    }

    public function dormitory($id)
    {
        $student_detail = SmStudent::where('id', $id)->first();
        $room_lists = SmRoomList::where('active_status', 1)->get();
        $room_lists = $room_lists->groupBy('dormitory_id');
        $room_types = SmRoomType::where('active_status', 1)->get();
        $dormitory_lists = SmDormitoryList::where('active_status', 1)->get();
        return view('backEnd.parentPanel.dormitory', compact('room_lists', 'room_types', 'dormitory_lists', 'student_detail'));
    }

    public function homework($id)
    {
        $student_detail = SmStudent::where('id', $id)->first();

        $homeworkLists = SmHomework::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->get();

        return view('backEnd.parentPanel.homework', compact('homeworkLists', 'student_detail'));
    }



    public function homeworkView($class_id, $section_id, $homework_id)
    {
        $homeworkDetails = SmHomework::where('class_id', '=', $class_id)->where('section_id', '=', $section_id)->where('id', '=', $homework_id)->first();


        return view('backEnd.parentPanel.homeworkView', compact('homeworkDetails', 'homework_id'));
    }

    public function parentNoticeboard()
    {


        $allNotices = SmNoticeBoard::where('active_status', 1)->where('inform_to', 'LIKE', '%3%')
            ->orderBy('id', 'DESC')
            ->get();

        return view('backEnd.parentPanel.parentNoticeboard', compact('allNotices'));
    }

    public function childListApi(Request $request, $id)
    {

        $parent = SmParent::where('user_id', $id)->first();
        $student_info = DB::table('sm_students')
            ->join('sm_classes', 'sm_classes.id', '=', 'sm_students.class_id')
            ->join('sm_sections', 'sm_sections.id', '=', 'sm_students.section_id')
            // ->join('sm_exams','sm_exams.id','=','sm_exam_types.id' )
            // ->join('sm_subjects','sm_subjects.id','=','sm_result_stores.subject_id' )

            ->where('sm_students.parent_id', '=', $parent->id)


            ->select('sm_students.user_id', 'student_photo', 'sm_students.full_name as student_name', 'class_name', 'section_name', 'roll_no')

            ->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {


            return ApiBaseMethod::sendResponse($student_info, null);
        }
    }
    public function childProfileApi(Request $request, $id)
    {



        $student_detail = SmStudent::where('id', $id)->first();
        $siblings = SmStudent::where('parent_id', $student_detail->parent_id)->where('active_status', 1)->get();
        $fees_assigneds = SmFeesAssign::where('student_id', $student_detail->id)->get();
        $fees_discounts = SmFeesAssignDiscount::where('student_id', $student_detail->id)->get();
        $documents = SmStudentDocument::where('student_staff_id', $student_detail->id)->where('type', 'stu')->get();
        $timelines = SmStudentTimeline::where('staff_student_id', $student_detail->id)->where('type', 'stu')->where('visible_to_student', 1)->get();
        $exams = SmExamSchedule::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->get();
        $grades = SmMarksGrade::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['student_detail'] = $student_detail->toArray();
            $data['fees_assigneds'] = $fees_assigneds->toArray();
            $data['fees_discounts'] = $fees_discounts->toArray();
            $data['exams'] = $exams->toArray();
            $data['documents'] = $documents->toArray();
            $data['timelines'] = $timelines->toArray();
            $data['siblings'] = $siblings->toArray();
            $data['grades'] = $grades->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }

        //return view('backEnd.studentPanel.my_profile', compact('student_detail', 'fees_assigneds', 'fees_discounts', 'exams', 'documents', 'timelines', 'siblings', 'grades'));
    }
    public function collectFeesChildApi(Request $request, $id)
    {

        $student = SmStudent::where('id', $id)->first();
        $fees_assigneds = SmFeesAssign::where('student_id', $id)->orderBy('id', 'desc')->get();

        $fees_assigneds2 = DB::table('sm_fees_assigns')
            ->select('sm_fees_types.id as fees_type_id', 'sm_fees_types.name', 'sm_fees_masters.date as due_date', 'sm_fees_masters.amount as amount')
            ->join('sm_fees_masters', 'sm_fees_masters.id', '=', 'sm_fees_assigns.fees_master_id')
            ->join('sm_fees_types', 'sm_fees_types.id', '=', 'sm_fees_masters.fees_type_id')
            ->join('sm_fees_payments', 'sm_fees_payments.fees_type_id', '=', 'sm_fees_masters.fees_type_id')
            ->where('sm_fees_assigns.student_id', $student->id)
            //->where('sm_fees_payments.student_id', $student->id)
            ->get();
        $i = 0;
        return $fees_assigneds2;
        foreach ($fees_assigneds2 as $row) {
            $d[$i]['fees_name'] = $row->name;
            $d[$i]['due_date'] = $row->due_date;
            $d[$i]['amount'] = $row->amount;
            $d[$i]['paid'] = DB::table('sm_fees_payments')->where('fees_type_id', $row->fees_type_id)->sum('amount');
            $d[$i]['fine'] = DB::table('sm_fees_payments')->where('fees_type_id', $row->fees_type_id)->sum('fine');
            $d[$i]['discount_amount'] = DB::table('sm_fees_payments')->where('fees_type_id', $row->fees_type_id)->sum('discount_amount');
            $d[$i]['balance'] = ((float) $d[$i]['amount'] + (float) $d[$i]['fine'])  - ((float) $d[$i]['paid'] + (float) $d[$i]['discount_amount']);
            $i++;
        }

        //dd($fees_assigneds2);
        //, DB::raw("SUM(sm_fees_payments.amount) as total_paid where sm_fees_payments.fees_type_id==")
        $fees_discounts = SmFeesAssignDiscount::where('student_id', $id)->get();

        $applied_discount = [];
        foreach ($fees_discounts as $fees_discount) {
            $fees_payment = SmFeesPayment::select('fees_discount_id')->where('fees_discount_id', $fees_discount->id)->first();
            if (isset($fees_payment->fees_discount_id)) {
                $applied_discount[] = $fees_payment->fees_discount_id;
            }
        }

        //dd($fees_discounts);


        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            // $data['student'] = $student;  
            $data['fees'] = $d;
            return ApiBaseMethod::sendResponse($fees_assigneds2, null);
        }

        return view('backEnd.feesCollection.collect_fees_student_wise', compact('student', 'fees_assigneds', 'fees_discounts', 'applied_discount'));
    }
    public function classRoutineApi(Request $request, $id)
    {

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $user_id = $id;
        } else {
            $user = Auth::user();

            if ($user) {
                $user_id = $user->id;
            } else {
                $user_id = $request->user_id;
            }
        }

        $student_detail = SmStudent::where('id', $id)->first();
        //return $student_detail;
        $class_id = $student_detail->class_id;
        $section_id = $student_detail->section_id;

        $sm_weekends = SmWeekend::orderBy('order', 'ASC')->where('active_status', 1)->get();
        $class_times = SmClassTime::where('type', 'class')->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['student_detail'] = $student_detail->toArray();
            // $data['class_id'] = $class_id;
            // $data['section_id'] = $section_id;
            // $data['sm_weekends'] = $sm_weekends->toArray();
            // $data['class_times'] = $class_times->toArray();

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
                        ['sm_class_routine_updates.class_id', $class_id], ['sm_class_routine_updates.section_id', $section_id], ['sm_class_routine_updates.day', $row->id],
                    ])->get();
            }

            return ApiBaseMethod::sendResponse($data, null);
        }

        //return view('backEnd.studentPanel.class_routine', compact('class_times', 'class_id', 'section_id', 'sm_weekends'));
    }
    public function childHomework(Request $request, $id)
    {

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $student_detail = SmStudent::where('id', $id)->first();

            $class_id = $student_detail->class->id;
            $subject_list = SmAssignSubject::where([['class_id', $class_id], ['section_id', $student_detail->section_id]])->get();

            $i = 0;
            foreach ($subject_list as $subject) {
                $homework_subject_list[$subject->subject->subject_name] = $subject->subject->subject_name;
                $allList[$subject->subject->subject_name] =
                    DB::table('sm_homeworks')
                    ->select('sm_homeworks.description', 'sm_subjects.subject_name', 'sm_homeworks.homework_date', 'sm_homeworks.submission_date', 'sm_homeworks.evaluation_date', 'sm_homeworks.file', 'sm_homeworks.marks', 'sm_homework_students.complete_status as status')
                    ->leftjoin('sm_homework_students', 'sm_homework_students.homework_id', '=', 'sm_homeworks.id')
                    ->leftjoin('sm_subjects', 'sm_subjects.id', '=', 'sm_homeworks.subject_id')
                    ->where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->where('subject_id', $subject->subject_id)->get();
            }
            //return $h;

            $homeworkLists = SmHomework::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->get();
        }
        // dd($allList);
        $data = [];

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            foreach ($allList as $r) {
                foreach ($r as $s) {
                    $data[] = $s;
                }
            }
            return ApiBaseMethod::sendResponse($data, null);
        }
        // return view('backEnd.studentPanel.student_homework', compact('homeworkLists', 'student_detail'));
    }
    public function childAttendanceAPI(Request $request, $id)
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

        $student_detail = SmStudent::where('id', $id)->first();

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


        $attendances = SmStudentAttendance::where('student_id', $student_detail->id)
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
    public function aboutApi(request $request)
    {

        $about = DB::table('sm_general_settings')
            ->join('sm_languages', 'sm_general_settings.language_id', '=', 'sm_languages.id')
            ->join('sm_academic_years', 'sm_general_settings.session_id', '=', 'sm_academic_years.id')
            ->join('sm_about_pages', 'sm_general_settings.school_id', '=', 'sm_about_pages.school_id')
            ->select('main_description', 'school_name', 'site_title', 'school_code', 'address', 'phone', 'email', 'logo', 'sm_languages.language_name', 'year as session', 'copyright_text')
            ->first();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            return ApiBaseMethod::sendResponse($about, null);
        }
    }
}
