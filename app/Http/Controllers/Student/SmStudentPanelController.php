<?php

namespace App\Http\Controllers\Student;

use App\ApiBaseMethod;
use App\Http\Controllers\Controller;
use App\SmAssignSubject;
use App\SmAssignVehicle;
use App\SmBook;
use App\SmBookIssue;
use App\SmClass;
use App\SmClassTime;
use App\SmDormitoryList;
use App\SmExam;
use App\SmExamSchedule;
use App\SmExamScheduleSubject;
use App\SmExamType;
use App\SmFeesAssign;
use App\SmFeesAssignDiscount;
use App\SmHomework;
use App\SmStudentHomework;
use App\SmLibraryMember;
use App\SmMarksGrade;
use App\SmNoticeBoard;
use App\SmRoomList;
use App\SmRoomType;
use App\SmRoute;
use App\SmSection;
use App\SmStudent;
use App\SmStudentAttendance;
use App\SmStudentDocument;
use App\SmStudentTimeline;
use App\SmSubject;
use App\SmTeacherUploadContent;
use App\SmVehicle;
use App\SmWeekend;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Hash;

class SmStudentPanelController extends Controller
{
    public function studentMyAttendanceSearchAPI(Request $request, $id = null)
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

        $student_detail = SmStudent::where('user_id', $id)->first();

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
        return view('backEnd.studentPanel.student_attendance', compact('attendances', 'days', 'year', 'month', 'current_day'));
    }



    public function studentMyAttendanceSearch(Request $request, $id = null)
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

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $login_id = $id;
        } else {
            $login_id = Auth::user()->id;
        }
        $student_detail = SmStudent::where('user_id', $login_id)->first();

        $year = $request->year;
        $month = $request->month;
        $current_day = date('d');

        $days = cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year);

        $attendances = SmStudentAttendance::where('student_id', $student_detail->id)->where('attendance_date', 'like', $request->year . '-' . $request->month . '%')->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data['attendances'] = $attendances;
            $data['days'] = $days;
            $data['year'] = $year;
            $data['month'] = $month;
            $data['current_day'] = $current_day;
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.studentPanel.student_attendance', compact('attendances', 'days', 'year', 'month', 'current_day'));
    }

    public function studentDashboard(Request $request, $id = null)
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

        $student_detail = SmStudent::where('user_id', $user_id)->first();
        $driver = SmVehicle::where('sm_vehicles.id', '=', $student_detail->vechile_id)
            ->join('sm_staffs', 'sm_staffs.id', '=', 'sm_vehicles.driver_id')
            ->first();
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

        return view('backEnd.studentPanel.my_profile', compact('driver', 'student_detail', 'fees_assigneds', 'fees_discounts', 'exams', 'documents', 'timelines', 'siblings', 'grades'));
    }

    public function studentsDocumentApi(Request $request, $id)
    {

        $student_detail = SmStudent::where('user_id', $id)->first();
        $documents = SmStudentDocument::where('student_staff_id', $student_detail->id)->where('type', 'stu')
            ->select('title', 'file')
            ->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['student_detail'] = $student_detail->toArray();
            $data['documents'] = $documents->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
    }

    public function classRoutine(Request $request, $id = null)
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

        $student_detail = SmStudent::where('user_id', $user_id)->first();
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

        return view('backEnd.studentPanel.class_routine', compact('class_times', 'class_id', 'section_id', 'sm_weekends'));
    }

    public function studentResult()
    {
        $user = Auth::user();

        $student_detail = SmStudent::where('user_id', $user->id)->first();

        $exams = SmExamSchedule::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->get();
        $grades = SmMarksGrade::where('active_status', 1)->get();
        //dd($exams);
        return view('backEnd.studentPanel.student_result', compact('student_detail', 'exams', 'grades'));
    }

    public function studentExamSchedule()
    {

        $user = Auth::user();
        $student_detail = SmStudent::where('user_id', $user->id)->first();

        $exam_types = SmExamType::all();

        return view('backEnd.studentPanel.exam_schedule', compact('exam_types'));
    }

    public function studentExamScheduleSearch(Request $request)
    {

        $request->validate([
            'exam' => 'required',
        ]);

        $user = Auth::user();
        $student_detail = SmStudent::where('user_id', $user->id)->first();

        $assign_subjects = SmAssignSubject::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->get();

        if ($assign_subjects->count() == 0) {
            return redirect('student-exam-schedule')->with('message-danger', 'No Subject Assigned. Please assign subjects in this class.');
        }

        $assign_subjects = SmAssignSubject::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->get();

        $exams = SmExam::where('active_status', 1)->get();
        $class_id = $student_detail->class_id;
        $section_id = $student_detail->section_id;
        $exam_id = $request->exam;

        $exam_types = SmExamType::all();
        $exam_periods = SmClassTime::where('type', 'exam')->get();
        $exam_schedule_subjects = "";
        $assign_subject_check = "";

        return view('backEnd.studentPanel.exam_schedule', compact('exams', 'assign_subjects', 'class_id', 'section_id', 'exam_id', 'exam_schedule_subjects', 'assign_subject_check', 'exam_types', 'exam_periods'));
    }
    public function studentExamScheduleApi(Request $request, $id)
    {

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            $student_detail = SmStudent::where('user_id', $id)->first();

            // $assign_subjects = SmAssignSubject::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->get();

            $exam_schedule = DB::table('sm_exam_schedules')
                ->join('sm_students', 'sm_students.class_id', '=', 'sm_exam_schedules.class_id')
                ->join('sm_exam_types', 'sm_exam_types.id', '=', 'sm_exam_schedules.exam_term_id')
                ->join('sm_exam_schedule_subjects', 'sm_exam_schedule_subjects.exam_schedule_id', '=', 'sm_exam_schedules.id')
                ->join('sm_subjects', 'sm_subjects.id', '=', 'sm_exam_schedules.subject_id')
                ->select('sm_subjects.subject_name', 'sm_exam_schedule_subjects.start_time', 'sm_exam_schedule_subjects.end_time', 'sm_exam_schedule_subjects.date', 'sm_exam_schedule_subjects.room', 'sm_exam_schedules.class_id', 'sm_exam_schedules.section_id')
                //->where('sm_students.class_id', '=', 'sm_exam_schedules.class_id')

                ->where('sm_exam_schedules.section_id', '=', $student_detail->section_id)
                ->get();



            return ApiBaseMethod::sendResponse($exam_schedule, null);
        }
    }

    public function studentViewExamSchedule($id)
    {

        $user = Auth::user();
        $student_detail = SmStudent::where('user_id', $user->id)->first();
        $class = SmClass::find($student_detail->class_id);
        $section = SmSection::find($student_detail->section_id);
        $assign_subjects = SmExamScheduleSubject::where('exam_schedule_id', $id)->get();

        return view('backEnd.examination.view_exam_schedule_modal', compact('class', 'section', 'assign_subjects'));
    }

    public function studentMyAttendance()
    {
        return view('backEnd.studentPanel.student_attendance');
    }

    public function studentHomework(Request $request, $id = null)
    {

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $student_detail = SmStudent::where('user_id', $id)->first();

            $class_id = $student_detail->class->id;
            $subject_list = SmAssignSubject::where([['class_id', $class_id], ['section_id', $student_detail->section_id]])->get();

            $i = 0;
            foreach ($subject_list as $subject) {
                $homework_subject_list[$subject->subject->subject_name] = $subject->subject->subject_name;
                $allList[$subject->subject->subject_name] = DB::table('sm_homeworks')
                    ->leftjoin('sm_subjects', 'sm_subjects.id', '=', 'sm_homeworks.subject_id')
                    ->where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)
                    ->where('subject_id', $subject->subject_id)->get()->toArray();;
            }
            foreach ($allList as $single) {
                foreach ($single as $singleHw) {
                    $std_homework = DB::table('sm_homework_students')
                        ->select('homework_id', 'complete_status')
                        ->where('homework_id', '=', $singleHw->id)
                        ->where('student_id', '=', $student_detail->id)
                        ->where('complete_status', 'C')
                        ->first();

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

            $homeworkLists = SmHomework::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->get();
        } else {
            $user = Auth::user();
            $student_detail = SmStudent::where('user_id', $user->id)->first();
            $homeworkLists = SmHomework::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->get();
        }
        // dd($allList);
        $data = [];

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            $data = $kijanidibo;
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.studentPanel.student_homework', compact('homeworkLists', 'student_detail'));
    }

    public function studentHomeworkView($class_id, $section_id, $homework_id)
    {

        $homeworkDetails = SmHomework::where('class_id', '=', $class_id)->where('section_id', '=', $section_id)->where('id', '=', $homework_id)->first();

        return view('backEnd.studentPanel.studentHomeworkView', compact('homeworkDetails', 'homework_id'));
    }

    public function studentAssignment()
    {
        $user = Auth::user();

        $student_detail = SmStudent::where('user_id', $user->id)->first();

        $uploadContents = SmTeacherUploadContent::where('content_type', 'as')
            ->where(function ($query) use ($student_detail) {
                $query->where('available_for_all_classes', 1)
                    ->orWhere([['class', $student_detail->class_id], ['section', $student_detail->section_id]]);
            })->get();

        return view('backEnd.studentPanel.assignmentList', compact('uploadContents'));
    }

    public function studentAssignmentApi(Request $request, $id)
    {

        $student_detail = SmStudent::where('user_id', $id)->first();
        $uploadContents = SmTeacherUploadContent::where('content_type', 'as')
            ->select('content_title', 'upload_date', 'description', 'upload_file')
            ->where(function ($query) use ($student_detail) {
                $query->where('available_for_all_classes', 1)
                    ->orWhere([['class', $student_detail->class_id], ['section', $student_detail->section_id]]);
            })->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['student_detail'] = $student_detail->toArray();
            $data['uploadContents'] = $uploadContents->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
    }

    public function studentStudyMaterial()
    {
        $user = Auth::user();
        $student_detail = SmStudent::where('user_id', $user->id)->first();

        $uploadContents = SmTeacherUploadContent::where('content_type', 'st')
            ->where(function ($query) use ($student_detail) {
                $query->where('available_for_all_classes', 1)
                    ->orWhere([['class', $student_detail->class_id], ['section', $student_detail->section_id]]);
            })->get();

        return view('backEnd.studentPanel.studyMetarialList', compact('uploadContents'));
    }

    public function studentSyllabus()
    {
        $user = Auth::user();
        $student_detail = SmStudent::where('user_id', $user->id)->first();

        $uploadContents = SmTeacherUploadContent::where('content_type', 'sy')
            ->where(function ($query) use ($student_detail) {
                $query->where('available_for_all_classes', 1)
                    ->orWhere([['class', $student_detail->class_id], ['section', $student_detail->section_id]]);
            })->get();

        return view('backEnd.studentPanel.studentSyllabus', compact('uploadContents'));
    }

    public function othersDownload()
    {
        $user = Auth::user();
        $student_detail = SmStudent::where('user_id', $user->id)->first();

        $uploadContents = SmTeacherUploadContent::where('content_type', 'ot')
            ->where(function ($query) use ($student_detail) {
                $query->where('available_for_all_classes', 1)
                    ->orWhere([['class', $student_detail->class_id], ['section', $student_detail->section_id]]);
            })->get();

        return view('backEnd.studentPanel.othersDownload', compact('uploadContents'));
    }

    public function studentSubject()
    {
        $user = Auth::user();
        $student_detail = SmStudent::where('user_id', $user->id)->first();
        $assignSubjects = SmAssignSubject::where('class_id', $student_detail->class_id)->where('section_id', $student_detail->section_id)->get();

        return view('backEnd.studentPanel.student_subject', compact('assignSubjects'));
    }

    //Student Subject API
    public function studentSubjectApi(Request $request, $id)
    {

        $student = SmStudent::where('user_id', $id)->first();
        $assignSubjects = DB::table('sm_assign_subjects')
            ->leftjoin('sm_subjects', 'sm_subjects.id', '=', 'sm_assign_subjects.subject_id')
            ->leftjoin('sm_staffs', 'sm_staffs.id', '=', 'sm_assign_subjects.teacher_id')
            ->select('sm_subjects.subject_name', 'sm_subjects.subject_code', 'sm_subjects.subject_type', 'sm_staffs.full_name as teacher_name')
            ->where('sm_assign_subjects.class_id', '=', $student->class_id)
            ->where('sm_assign_subjects.section_id', '=', $student->section_id)
            ->get();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['student_subjects'] = $assignSubjects->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
    }

    //student panel Transport
    public function studentTransport()
    {
        $user = Auth::user();
        $student_detail = SmStudent::where('user_id', $user->id)->first();

        $routes = SmAssignVehicle::where('active_status', 1)->get();

        // $routes = DB::table('sm_assign_vehicles')
        //     ->where('sm_assign_vehicles.active_status', 1)
        //     ->join('sm_vehicles', 'sm_assign_vehicles.vehicle_id', 'sm_vehicles.id')
        //     ->join('sm_staffs', 'sm_vehicles.driver_id', 'sm_staffs.id')
        //     ->get();
        //$vehicles = SmAssignVehicle::where('active_status', 1)->get();

        //dd( $routes );


        return view('backEnd.studentPanel.student_transport', compact('routes', 'student_detail'));
    }

    public function studentTransportViewModal($r_id, $v_id)
    {
        $vehicle = SmVehicle::find($v_id);
        $route = SmRoute::find($r_id);

        return view('backEnd.studentPanel.student_transport_view_modal', compact('route', 'vehicle'));
    }

    public function studentDormitory()
    {
        $user = Auth::user();
        $student_detail = SmStudent::where('user_id', $user->id)->first();
        $room_lists = SmRoomList::where('active_status', 1)->get();

        $room_lists = $room_lists->groupBy('dormitory_id');

        $room_types = SmRoomType::where('active_status', 1)->get();
        $dormitory_lists = SmDormitoryList::where('active_status', 1)->get();



        return view('backEnd.studentPanel.student_dormitory', compact('room_lists', 'room_types', 'dormitory_lists', 'student_detail'));
    }

    public function studentBookList()
    {
        $books = SmBook::where('active_status', 1)
            ->orderBy('id', 'DESC')
            ->get();
        return view('backEnd.studentPanel.studentBookList', compact('books'));
    }

    public function studentBookIssue()
    {

        $user = Auth::user();
        $student_detail = SmStudent::where('user_id', $user->id)->first();

        $books = SmBook::select('id', 'book_title')->where('active_status', 1)->get();
        $subjects = SmSubject::select('id', 'subject_name')->where('active_status', 1)->get();

        $library_member = SmLibraryMember::where('member_type', 2)->where('student_staff_id', $student_detail->user_id)->first();
        if (empty($library_member)) {
            return redirect()->back()->with('message-danger', 'You are not library member ! Please contact with librarian');
        }

        $issueBooks = SmBookIssue::where('member_id', $library_member->student_staff_id)->where('issue_status', 'I')->get();

        return view('backEnd.studentPanel.studentBookIssue', compact('books', 'subjects', 'issueBooks'));
    }

    public function studentNoticeboard(Request $request)
    {
        $data = [];
        $allNotices = SmNoticeBoard::where('active_status', 1)->where('inform_to', 'LIKE', '%2%')
            ->orderBy('id', 'DESC')
            ->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            $data['allNotices'] = $allNotices->toArray();

            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.studentPanel.studentNoticeboard', compact('allNotices'));
    }

    public function studentTeacher()
    {
        $user = Auth::user();
        $student_detail = SmStudent::where('user_id', $user->id)->first();
        $teachers = SmAssignSubject::select('teacher_id')->where('class_id', $student_detail->class_id)
            ->where('section_id', $student_detail->section_id)->distinct('teacher_id')->get();

        return view('backEnd.studentPanel.studentTeacher', compact('teachers'));
    }
    public function studentTeacherApi(Request $request, $id)
    {

        $student = SmStudent::where('user_id', $id)->first();

        $assignTeacher = DB::table('sm_assign_subjects')
            ->leftjoin('sm_subjects', 'sm_subjects.id', '=', 'sm_assign_subjects.subject_id')
            ->leftjoin('sm_staffs', 'sm_staffs.id', '=', 'sm_assign_subjects.teacher_id')
            //->select('sm_subjects.subject_name', 'sm_subjects.subject_code', 'sm_subjects.subject_type', 'sm_staffs.full_name')
            ->select('sm_staffs.full_name', 'sm_staffs.email', 'sm_staffs.mobile')
            ->where('sm_assign_subjects.class_id', '=', $student->class_id)
            ->where('sm_assign_subjects.section_id', '=', $student->section_id)
            ->get();

        $class_teacher = DB::table('sm_class_teachers')
            ->join('sm_assign_class_teachers', 'sm_assign_class_teachers.id', '=', 'sm_class_teachers.assign_class_teacher_id')
            ->join('sm_staffs', 'sm_class_teachers.teacher_id', '=', 'sm_staffs.id')
            ->where('sm_assign_class_teachers.class_id', '=', $student->class_id)
            ->where('sm_assign_class_teachers.section_id', '=', $student->section_id)
            ->where('sm_assign_class_teachers.active_status', '=', 1)
            ->select('full_name')
            ->first();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['teacher_list'] = $assignTeacher->toArray();
            $data['class_teacher'] = $class_teacher;
            return ApiBaseMethod::sendResponse($data, null);
        }
    }


    public function studentLibrary(Request $request, $id)
    {

        $student = SmStudent::where('user_id', $id)->first();
        $issueBooks = DB::table('sm_book_issues')
            ->leftjoin('sm_books', 'sm_books.id', '=', 'sm_book_issues.book_id')
            ->where('sm_book_issues.member_id', '=', $student->user_id)
            ->get();


        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['issueBooks'] = $issueBooks->toArray();

            return ApiBaseMethod::sendResponse($data, null);
        }
    }
    public function studentDormitoryApi(Request $request)
    {


        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            $studentDormitory = DB::table('sm_room_lists')
                ->join('sm_dormitory_lists', 'sm_room_lists.dormitory_id', '=', 'sm_dormitory_lists.id')
                ->join('sm_room_types', 'sm_room_lists.room_type_id', '=', 'sm_room_types.id')
                ->select('sm_dormitory_lists.dormitory_name', 'sm_room_lists.name as room_number', 'sm_room_lists.number_of_bed', 'sm_room_lists.cost_per_bed', 'sm_room_lists.active_status')
                ->get();

            return ApiBaseMethod::sendResponse($studentDormitory, null);
        }
    }
    public function studentTimelineApi(Request $request, $id)
    {

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            //$timelines = SmStudentTimeline::where('staff_student_id', $id)->first();


            $timelines = DB::table('sm_student_timelines')
                ->leftjoin('sm_students', 'sm_students.id', '=', 'sm_student_timelines.staff_student_id')
                ->where('sm_student_timelines.type', '=', 'stu')
                ->where('sm_student_timelines.active_status', '=', 1)
                ->where('sm_students.user_id', '=', $id)
                ->select('title', 'date', 'description', 'file', 'sm_student_timelines.active_status')

                ->get();

            return ApiBaseMethod::sendResponse($timelines, null);
        }
    }
    public function examListApi(Request $request, $id)
    {

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            $student = SmStudent::where('user_id', $id)->first();


            $exam_List = DB::table('sm_exams')
                ->join('sm_exam_types', 'sm_exam_types.id', '=', 'sm_exams.exam_type_id')


                ->where('sm_exams.school_id', '=', $student->school_id)
                ->where('sm_exams.class_id', '=', $student->class_id)
                ->where('sm_exams.section_id', '=', $student->section_id)
                ->where('sm_exams.active_status', '=', 1)

                ->select('sm_exam_types.title as exam_name', 'sm_exams.id as exam_id')

                ->get();

            return ApiBaseMethod::sendResponse($exam_List, null);
        }
    }
    public function examScheduleApi(Request $request, $id, $exam_id)
    {

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            $student = SmStudent::where('user_id', $id)->first();


            $exam_schedule = DB::table('sm_exam_schedules')
                ->join('sm_exam_types', 'sm_exam_types.id', '=', 'sm_exam_schedules.exam_term_id')
                // ->join('sm_exam_types','sm_exam_types.id','=','sm_exam_schedules.exam_term_id' )
                ->join('sm_subjects', 'sm_subjects.id', '=', 'sm_exam_schedules.subject_id')
                ->join('sm_class_rooms', 'sm_class_rooms.id', '=', 'sm_exam_schedules.room_id')
                ->join('sm_class_times', 'sm_class_times.id', '=', 'sm_exam_schedules.exam_period_id')

                ->where('sm_exam_schedules.exam_term_id', '=', $exam_id)
                ->where('sm_exam_schedules.school_id', '=', $student->school_id)
                ->where('sm_exam_schedules.class_id', '=', $student->class_id)
                ->where('sm_exam_schedules.section_id', '=', $student->section_id)

                ->where('sm_exam_schedules.active_status', '=', 1)

                ->select('sm_exam_types.id', 'sm_exam_types.title as exam_name', 'sm_subjects.subject_name', 'date', 'sm_class_rooms.room_no', 'sm_class_times.start_time', 'sm_class_times.end_time')

                ->get();

            return ApiBaseMethod::sendResponse($exam_schedule, null);
        }
    }
    public function examResultApi(Request $request, $id, $exam_id)
    {

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            $student = SmStudent::where('user_id', $id)->first();


            $exam_result = DB::table('sm_result_stores')
                ->join('sm_exam_types', 'sm_exam_types.id', '=', 'sm_result_stores.exam_type_id')
                ->join('sm_exams', 'sm_exams.id', '=', 'sm_exam_types.id')
                ->join('sm_subjects', 'sm_subjects.id', '=', 'sm_result_stores.subject_id')

                ->where('sm_exams.id', '=', $exam_id)
                ->where('sm_result_stores.school_id', '=', $student->school_id)
                ->where('sm_result_stores.class_id', '=', $student->class_id)
                ->where('sm_result_stores.section_id', '=', $student->section_id)
                ->where('sm_result_stores.student_id', '=', $student->id)

                ->select('sm_exams.id', 'sm_exam_types.title as exam_name', 'sm_subjects.subject_name', 'sm_result_stores.total_marks as obtained_marks', 'sm_exams.exam_mark', 'sm_result_stores.total_gpa_grade')

                ->get();

            return ApiBaseMethod::sendResponse($exam_result, null);
        }
    }
    public function updatePassowrdStoreApi(Request $request)
    {

        $user = User::find($request->id);

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {


            if (Hash::check($request->current_password, $user->password)) {

                $user->password = Hash::make($request->new_password);
                $result = $user->save();
                $msg = "Password Changed Successfully ";
                return ApiBaseMethod::sendResponse(null, $msg);
            } else {
                $msg = "You Entered Wrong Current Password";
                return ApiBaseMethod::sendError(null, $msg);
            }
        }
    }
}
