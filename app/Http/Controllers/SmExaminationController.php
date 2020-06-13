<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Validator;
use App\SmExam;
use App\SmClass;
use App\SmSection;
use App\SmStudent;
use App\SmSubject;
use App\SmExamType;
use App\SmSeatPlan;
use App\SmCLassRoom;
use App\SmClassTime;
use App\SmExamSetup;
use App\SmMarkStore;
use App\SmMarksGrade;
use App\ApiBaseMethod;
use App\SmResultStore;
use App\SmExamSchedule;
use App\SmAssignSubject;
use App\SmMarksRegister;
use App\SmSeatPlanChild;
use App\SmExamAttendance;
use Illuminate\Http\Request;
use App\SmMarksRegisterChild;
use App\SmTemporaryMeritlist;
use App\SmExamAttendanceChild;
use App\SmExamScheduleSubject;
use Brian2694\Toastr\Facades\Toastr;

class SmExaminationController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }


    public function examSchedule()
    {
        $classes = SmClass::where('active_status', 1)->get();
        return view('backEnd.examination.exam_schedule', compact('classes'));
    }

    public function examScheduleCreate()
    {
        $classes = SmClass::where('active_status', 1)->get();
        $sections = SmSection::where('active_status', 1)->get();
        $subjects = SmSubject::where('active_status', 1)->get();
        $exams = SmExam::all();
        $exam_types = SmExamType::all();
        return view('backEnd.examination.exam_schedule_create', compact('classes', 'exams', 'exam_types'));
    }

    public function examScheduleSearch(Request $request)
    {
        $request->validate([
            'exam' => 'required',
            'class' => 'required',
            'section' => 'required'
        ]);


        $assign_subjects = SmAssignSubject::where('class_id', $request->class)->where('section_id', $request->section)->get();

        if ($assign_subjects->count() == 0) {
            Toastr::error('No Subject Assigned. Please assign subjects in this class', 'Failed');
            return redirect('exam-schedule-create');
        }


        $assign_subjects = SmAssignSubject::where('class_id', $request->class)->where('section_id', $request->section)->get();


        $classes = SmClass::where('active_status', 1)->get();
        $exams = SmExam::where('active_status', 1)->get();
        $class_id = $request->class;
        $section_id = $request->section;
        $exam_id = $request->exam;


        $exam_types = SmExamType::all();
        $exam_periods  = SmClassTime::where('type', 'exam')->get();

        return view('backEnd.examination.exam_schedule_create', compact('classes', 'exams', 'assign_subjects', 'class_id', 'section_id', 'exam_id', 'exam_types', 'exam_periods'));
    }




    public function examScheduleStore(Request $request)
    {

        $update_check = SmExamSchedule::where('exam_id', $request->exam_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->first();

        DB::beginTransaction();

        try {
            if ($update_check == "") {
                $exam_schedule = new SmExamSchedule();
            } else {
                $exam_schedule = $update_check = SmExamSchedule::where('exam_id', $request->exam_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->first();
            }


            $exam_schedule->class_id = $request->class_id;
            $exam_schedule->section_id = $request->section_id;
            $exam_schedule->exam_id = $request->exam_id;
            $exam_schedule->save();
            $exam_schedule->toArray();

            $counter = 0;

            if ($update_check != "") {
                SmExamScheduleSubject::where('exam_schedule_id', $exam_schedule->id)->delete();
            }

            foreach ($request->subjects as $subject) {
                $counter++;
                $date = 'date_' . $counter;
                $start_time = 'start_time_' . $counter;
                $end_time = 'end_time_' . $counter;
                $room = 'room_' . $counter;
                $full_mark = 'full_mark_' . $counter;
                $pass_mark = 'pass_mark_' . $counter;

                $exam_schedule_subject = new SmExamScheduleSubject();
                $exam_schedule_subject->exam_schedule_id = $exam_schedule->id;
                $exam_schedule_subject->subject_id = $subject;
                $exam_schedule_subject->date = date('Y-m-d', strtotime($request->$date));
                $exam_schedule_subject->start_time = $request->$start_time;
                $exam_schedule_subject->end_time = $request->$end_time;
                $exam_schedule_subject->room = $request->$room;
                $exam_schedule_subject->full_mark = $request->$full_mark;
                $exam_schedule_subject->pass_mark = $request->$pass_mark;
                $exam_schedule_subject->save();
            }


            DB::commit();
            Toastr::success('Operation successful', 'Success');
            return redirect('exam-schedule');
        } catch (Exception $e) {
            DB::rollBack();
        }
        Toastr::error('Operation Failed', 'Failed');
        return redirect()->back();
    }


    public function viewExamSchedule($class_id, $section_id, $exam_id)
    {
        $class = SmClass::find($class_id);
        $section = SmSection::find($section_id);
        $assign_subjects = SmExamScheduleSubject::where('exam_schedule_id', $exam_id)->get();
        return view('backEnd.examination.view_exam_schedule_modal', compact('class', 'section', 'assign_subjects'));
    }

    public function viewExamStatus($exam_id)
    {
        $exam = SmExam::find($exam_id);
        $view_exams = SmExamSchedule::where('exam_id', $exam_id)->get();
        return view('backEnd.examination.view_exam_status', compact('exam', 'view_exams'));
    }

    // Mark Register View Page
    public function marksRegister()
    {
        $exams = SmExam::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        $exam_types = SmExamType::where('active_status', 1)->get();

        return view('backEnd.examination.masks_register', compact('exams', 'classes', 'exam_types'));
    }

    public function marksRegisterCreate()
    {
        $exams = SmExam::where('active_status', 1)->get();
        $exam_types = SmExamType::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        $subjects = SmSubject::where('active_status', 1)->get();
        return view('backEnd.examination.masks_register_create', compact('exams', 'classes', 'subjects', 'exam_types'));
    }

    //show exam type method from sm_exams_types table
    public function exam_type()
    {
        $exams = SmExam::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        $exams_types = SmExamType::all();
        return view('backEnd.examination.exam_type', compact('exams', 'classes', 'exams_types'));
    }

    //edit exam type method from sm_exams_types table
    public function exam_type_edit($id)
    {
        $exam_type_edit = SmExamType::find($id);
        $exams_types = SmExamType::where('active_status', 1)->get();
        return view('backEnd.examination.exam_type', compact('exam_type_edit', 'exams_types'));
    }

    //update exam type method from sm_exams_types table
    public function exam_type_update(Request $request)
    {
        $request->validate([
            'exam_type_title' => 'required',
            'active_status' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $update_exame_type = SmExamType::find($request->id);
            $update_exame_type->title = $request->exam_type_title;
            $update_exame_type->active_status = $request->active_status;
            $update_exame_type->save();
            $update_exame_type->toArray();

            DB::commit();
            Toastr::success('Operation successful', 'Success');
            return redirect('exam-type');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    //store exam type method from sm_exams_types table
    public function exam_type_store(Request $request)
    {
        $request->validate([
            'exam_type_title' => 'required'
        ]);


        $update_exame_type = new SmExamType();
        $update_exame_type->title = $request->exam_type_title;
        $update_exame_type->active_status = 1;    //1 for status active & 0 for inactive
        $result = $update_exame_type->save();

        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect('exam-type');
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }



    //delete exam type method from sm_exams_types table
    public function exam_type_delete(Request $request, $id)
    {

        $id_key = 'exam_type_id';

        $tables = \App\tableList::getTableList($id_key);

        try {
            $delete_query = SmExamType::destroy($id);
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($delete_query) {
                    return ApiBaseMethod::sendResponse(null, 'Exam Type has been deleted successfully');
                } else {
                    return ApiBaseMethod::sendError('Something went wrong, please try again.');
                }
            } else {
                if ($delete_query) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect()->back();
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';

            return redirect()->back()->with('message-danger-delete', $msg);
        } catch (\Exception $e) {
            //dd($e->getMessage(), $e->errorInfo);
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }



        //     DB::beginTransaction();
        //    try{

        //     SmMarkStore::where('exam_term_id', $id)->delete();
        //     SmExamSetup::where('exam_term_id', $id)->delete();
        //     SmExam::where('exam_type_id', $id)->delete();
        //     SmExamType::where('id', $id)->delete();

        //     DB::commit();
        //       return redirect('exam-type')->with('message-success', 'Marks has been registered successfully');
        //     }catch (\Exception $e) {
        //         DB::rollback();
        //         return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
        //     }

    }







    public function marksRegisterSearch(Request $request)
    {


        $request->validate([
            'exam' => 'required',
            'class' => 'required',
            'section' => 'required',
            'subject' => 'required'
        ]);


        $exams = SmExam::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        $exam_types = SmExamType::where('active_status', 1)->get();

        $exam_id = $request->exam;
        $class_id = $request->class;
        $section_id = $request->section;
        $subject_id = $request->subject;
        $subjectNames = SmSubject::where('id', $subject_id)->first();


        $students = SmStudent::where('active_status', 1)->where('class_id', $request->class)->where('section_id', $request->section)->get();

        $exam_schedule = SmExamSchedule::where('exam_id', $request->exam)->where('class_id', $request->class)->where('section_id', $request->section)->first();

        if ($students->count() < 1) {
            return redirect()->back()->with('message-danger', 'Student is not found in according this class and section! Please add student in this section of that class.');
        } else {

            $marks_entry_form = SmExamSetup::where(
                [
                    ['exam_term_id', $exam_id],
                    ['class_id', $class_id],
                    ['section_id', $section_id],
                    ['subject_id', $subject_id]
                ]
            )->get();

            if ($marks_entry_form->count() > 0) {


                $number_of_exam_parts = count($marks_entry_form);

                return view('backEnd.examination.masks_register_create', compact('exams', 'classes', 'students', 'exam_id', 'class_id', 'section_id', 'subject_id', 'subjectNames', 'number_of_exam_parts', 'marks_entry_form', 'exam_types'));
            } else {
                return redirect()->back()->with('message-danger', 'No result found or exam setup is not done!');
            }


            return view('backEnd.examination.masks_register_create', compact('exams', 'classes', 'students',   'exam_id', 'class_id', 'section_id', 'marks_register_subjects', 'assign_subject_ids'));
        }
    }


    public function marksRegisterStore(Request $request)
    {


        //dd($request->marks[151]);
        DB::beginTransaction();
        try {

            $class_id = $request->class_id;
            $section_id = $request->section_id;
            $subject_id = $request->subject_id;
            $exam_id = $request->exam_id;

            $counter = 0;           // Initilize by 0 

            foreach ($request->student_ids as $student_id) {
                $sid            =   $student_id;
                $admission_no   = ($request->student_admissions[$sid] == null) ? '' : $request->student_admissions[$sid];
                $roll_no        = ($request->student_rolls[$sid] == null) ? '' : $request->student_rolls[$sid];

                if (!isset($request->abs[$sid])) {       // 0=Present && 1=absent 
                    $is_absent = 0;
                } else {
                    $is_absent = 1;
                }
                // $is_absent = ($request->abs[$sid]==null) ? 0 : 1;

                if (!empty($request->marks[$sid])) {
                    $exam_setup_count = 0;
                    $total_marks_persubject = 0;
                    foreach ($request->marks[$sid] as $part_mark) {
                        $mark_by_exam_part = ($part_mark == null) ? 0 : $part_mark;          // 0=If exam part is empty
                        $total_marks_persubject = $total_marks_persubject + $mark_by_exam_part;
                        // $is_absent = ($request->abs[$sid]==null) ? 0 : 1;        
                        $exam_setup_id = $request->exam_Sids[$sid][$exam_setup_count];

                        $previous_record = SmMarkStore::where([
                            ['class_id', $class_id],
                            ['section_id', $section_id],
                            ['subject_id', $subject_id],
                            ['exam_term_id', $exam_id],
                            ['exam_setup_id', $exam_setup_id],
                            ['student_id', $sid]
                        ])->first();
                        // Is previous record exist ?

                        if ($previous_record == "" || $previous_record == null) {
                            $marks_register = new SmMarkStore();

                            $marks_register->exam_term_id           =       $exam_id;
                            $marks_register->class_id               =       $class_id;
                            $marks_register->section_id             =       $section_id;
                            $marks_register->subject_id             =       $subject_id;
                            $marks_register->student_id             =       $sid;
                            // $marks_register->student_addmission_no  =       $admission_no;
                            // $marks_register->student_roll_no        =       $roll_no; 
                            $marks_register->total_marks            =       $mark_by_exam_part;
                            $marks_register->exam_setup_id          =       $exam_setup_id;
                            $marks_register->is_absent              =       $is_absent;
                            $marks_register->save();
                            $marks_register->toArray();
                        } else {                                                          //If already exists, it will updated
                            $pid = $previous_record->id;
                            $marks_register = SmMarkStore::find($pid);
                            $marks_register->total_marks            =       $mark_by_exam_part;
                            $marks_register->is_absent              =       $is_absent;
                            $marks_register->save();
                        }


                        $exam_setup_count++;
                    } // end part insertion

                    $mark_grade = SmMarksGrade::where([['percent_from', '<=', $total_marks_persubject], ['percent_upto', '>=', $total_marks_persubject]])->first();


                    $previous_result_record = SmResultStore::where([
                        ['class_id', $class_id],
                        ['section_id', $section_id],
                        ['subject_id', $subject_id],
                        ['exam_type_id', $exam_id],
                        ['student_id', $sid]
                    ])->first();


                    if ($previous_result_record == "" || $previous_result_record == null) {         //If not result exists, it will create
                        $result_record = new SmResultStore();
                        $result_record->class_id               =   $class_id;
                        $result_record->section_id             =   $section_id;
                        $result_record->subject_id             =   $subject_id;
                        $result_record->exam_type_id           =   $exam_id;
                        $result_record->student_id             =   $sid;
                        $result_record->is_absent              =   $is_absent;

                        // $result_record->student_roll_no        =   $roll_no;
                        // $result_record->student_addmission_no  =   $admission_no;
                        $result_record->total_marks            =   $total_marks_persubject;
                        $result_record->total_gpa_point        =   $mark_grade->gpa;
                        $result_record->total_gpa_grade        =   $mark_grade->grade_name;
                        $result_record->save();
                        $result_record->toArray();
                    } else {                               //If already result exists, it will updated
                        $id = $previous_result_record->id;
                        $result_record = SmResultStore::find($id);
                        $result_record->total_marks            =   $total_marks_persubject;
                        $result_record->total_gpa_point        =   $mark_grade->gpa;
                        $result_record->total_gpa_grade        =   $mark_grade->grade_name;
                        $result_record->is_absent              =   $is_absent;
                        $result_record->save();
                        $result_record->toArray();
                    }
                }   // If student id is valid

            } //end student loop

            DB::commit();
            Toastr::success('Operation successful', 'Success');
            return redirect('marks-register');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
    }

    public function marksRegisterReportSearch(Request $request)
    {

        $request->validate([
            'exam' => 'required',
            'class' => 'required',
            'section' => 'required',
            'subject' => 'required'
        ]);


        $exams = SmExam::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        $exam_types = SmExamType::where('active_status', 1)->get();

        $exam_id = $request->exam;
        $class_id = $request->class;
        $section_id = $request->section;
        $subject_id = $request->subject;
        $subjectNames = SmSubject::where('id', $subject_id)->first();


        $students = SmStudent::where('active_status', 1)->where('class_id', $request->class)->where('section_id', $request->section)->get();

        $exam_schedule = SmExamSchedule::where('exam_id', $request->exam)->where('class_id', $request->class)->where('section_id', $request->section)->first();

        if ($students->count() == 0) {
            return redirect()->back()->with('message-danger', 'Sorry ! Student is not available Or exam schedule is not set yet.');
        } else {

            $marks_entry_form = SmExamSetup::where(
                [
                    ['exam_term_id', $exam_id],
                    ['class_id', $class_id],
                    ['section_id', $section_id],
                    ['subject_id', $subject_id]
                ]

            )->get();

            if ($marks_entry_form->count() > 0) {
                $number_of_exam_parts = count($marks_entry_form);
                return view('backEnd.examination.masks_register_search', compact('exams', 'classes', 'students', 'exam_id', 'class_id', 'section_id', 'subject_id', 'subjectNames', 'number_of_exam_parts', 'marks_entry_form', 'exam_types'));
            }
        }
    }



    public function seatPlan()
    {
        $exam_types = SmExamType::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        $subjects = SmSubject::where('active_status', 1)->get();
        return view('backEnd.examination.seat_plan', compact('exam_types', 'classes', 'subjects'));
    }

    public function seatPlanCreate()
    {
        $exam_types = SmExamType::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        $subjects = SmSubject::where('active_status', 1)->get();
        $class_rooms = SmClassRoom::where('active_status', 1)->get();
        return view('backEnd.examination.seat_plan_create', compact('exam_types', 'classes', 'subjects', 'class_rooms'));
    }
    public function seatPlanSearch(Request $request)
    {

        $request->validate([
            'exam' => 'required',
            'subject' => 'required',
            'class' => 'required',
            'section' => 'required'
        ]);

        $students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->where('active_status', 1)->get();

        if ($students->count() == 0) {
            return redirect('seat-plan-create')->with('message-danger', 'No result found');
        }

        $seat_plan_assign = SmSeatPlan::where('exam_id', $request->exam)->where('subject_id', $request->subject)->where('class_id', $request->class)->where('section_id', $request->section)->where('date', date('Y-m-d', strtotime($request->date)))->first();


        $seat_plan_assign_childs = [];
        if ($seat_plan_assign != "") {
            $seat_plan_assign_childs = $seat_plan_assign->seatPlanChild;
        }

        $exam_types = SmExamType::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();

        $class_rooms = SmClassRoom::where('active_status', 1)->get();
        $fill_uped = [];
        foreach ($class_rooms as $class_room) {
            $assigned_student = SmSeatPlanChild::where('room_id', $class_room->id)->get();
            if ($assigned_student->count() > 0) {
                $assigned_student = $assigned_student->sum('assign_students');
                if ($assigned_student >= $class_room->capacity) {
                    $fill_uped[] = $class_room->id;
                }
            }
        }
        $class_id = $request->class;
        $section_id = $request->section;
        $exam_id = $request->exam;
        $subject_id = $request->subject;
        $date = $request->date;



        return view('backEnd.examination.seat_plan_create', compact('exam_types', 'classes', 'class_rooms', 'students', 'class_id', 'section_id', 'exam_id', 'subject_id', 'seat_plan_assign_childs', 'fill_uped', 'date'));
    }

    public function getExamRoomByAjax(Request $request)
    {
        $class_rooms = SmClassRoom::where('active_status', 1)->get();

        $rest_class_rooms = [];
        foreach ($class_rooms as $class_room) {
            $assigned_student = SmSeatPlanChild::where('room_id', $class_room->id)->get();
            if ($assigned_student->count() > 0) {
                $assigned_student = $assigned_student->sum('assign_students');
                if ($assigned_student < $class_room->capacity) {
                    $rest_class_rooms[] = $class_room;
                }
            } else {
                $rest_class_rooms[] = $class_room;
            }
        }

        return response()->json([$rest_class_rooms]);
    }

    public function getRoomCapacity(Request $request)
    {


        $class_room = SmClassRoom::find($request->id);

        $assigned = SmSeatPlanChild::where('room_id', $request->id)->where('date', date('Y-m-d', strtotime($request->date)))->first();
        $assigned_student = 0;
        if ($assigned != '') {
            $assigned_student = SmSeatPlanChild::where('room_id', $request->id)->where('date', date('Y-m-d', strtotime($request->date)))->where('start_time', '<=', date('H:i:s', strtotime($request->start_time)))->where('end_time', '>=', date('H:i:s', strtotime($request->end_time)))->sum('assign_students');
        }

        return response()->json([$class_room, $assigned_student]);
    }

    public function seatPlanStore(Request $request)
    {

        $seat_plan_assign = SmSeatPlan::where('exam_id', $request->exam_id)->where('subject_id', $request->subject_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->first();

        DB::beginTransaction();
        try {
            if ($seat_plan_assign == "") {
                $seat_plan = new SmSeatPlan();
            } else {
                $seat_plan = SmSeatPlan::where('exam_id', $request->exam_id)->where('subject_id', $request->subject_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->where('date', date('Y-m-d', strtotime($request->exam_date)))->first();
            }
            $seat_plan->exam_id = $request->exam_id;
            $seat_plan->subject_id = $request->subject_id;
            $seat_plan->class_id = $request->class_id;
            $seat_plan->section_id = $request->section_id;
            $seat_plan->date = date('Y-m-d', strtotime($request->exam_date));
            $seat_plan->save();
            $seat_plan->toArray();

            if ($seat_plan_assign != "") {
                SmSeatPlanChild::where('seat_plan_id', $seat_plan->id)->delete();
            }

            $i = 0;
            foreach ($request->room as $room) {
                $seat_plan_child = new SmSeatPlanChild();
                $seat_plan_child->seat_plan_id = $seat_plan->id;
                $seat_plan_child->room_id = $room;
                $seat_plan_child->assign_students = $request->assign_student[$i];
                $seat_plan_child->start_time = date('H:i:s', strtotime($request->start_time));
                $seat_plan_child->end_time = date('H:i:s', strtotime($request->end_time));
                $seat_plan_child->date = date('Y-m-d', strtotime($request->exam_date));
                $seat_plan_child->save();
                $i++;
            }


            DB::commit();
            return redirect('seat-plan')->with('message-success', 'Seat Plan has been assigned successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
        }
    }

    public function seatPlanReportSearch(Request $request)
    {

        $seat_plans = SmSeatPlan::query();
        $seat_plans->where('active_status', 1);
        if ($request->exam != "") {
            $seat_plans->where('exam_id', $request->exam);
        }
        if ($request->subject != "") {
            $seat_plans->where('subject_id', $request->subject);
        }

        if ($request->class != "") {
            $seat_plans->where('class_id', $request->class);
        }

        if ($request->section != "") {
            $seat_plans->where('section_id', $request->section);
        }
        if ($request->date != "") {
            $seat_plans->where('date', date('Y-m-d', strtotime($request->date)));
        }
        $seat_plans = $seat_plans->get();
        if ($seat_plans->count() == 0) {
            Toastr::success('No Record Found', 'Success');
            return redirect('seat-plan');
        }



        $exams = SmExam::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        $subjects = SmSubject::where('active_status', 1)->get();

        return view('backEnd.examination.seat_plan', compact('exams', 'classes', 'subjects', 'seat_plans'));
    }

    public function examAttendance()
    {
        $exams = SmExamType::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        $subjects = SmSubject::where('active_status', 1)->get();
        return view('backEnd.examination.exam_attendance', compact('exams', 'classes', 'subjects'));
    }

    public function examAttendanceAeportSearch(Request $request)
    {
        $request->validate([
            'exam' => 'required',
            'subject' => 'required',
            'class' => 'required',
            'section' => 'required'
        ]);

        $exam_attendance = SmExamAttendance::where('class_id', $request->class)
            ->where('section_id', $request->section)->where('subject_id', $request->subject)
            ->where('exam_id', $request->exam)->first();

        if ($exam_attendance == "") {
            Toastr::success('No Record Found', 'Success');
            return redirect('exam-attendance');
        }

        $exam_attendance_childs = [];
        if ($exam_attendance != "") {
            $exam_attendance_childs = $exam_attendance->examAttendanceChild;
        }

        $exams = SmExamType::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        $subjects = SmSubject::where('active_status', 1)->get();
        return view('backEnd.examination.exam_attendance', compact('exams', 'classes', 'subjects', 'exam_attendance_childs'));
    }

    public function examAttendanceCreate()
    {
        $exams = SmExamType::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        $subjects = SmSubject::where('active_status', 1)->get();
        return view('backEnd.examination.exam_attendance_create', compact('exams', 'classes', 'subjects'));
    }

    public function examAttendanceSearch(Request $request)
    {
        $request->validate([
            'exam' => 'required',
            'subject' => 'required',
            'class' => 'required',
            'section' => 'required'
        ]);

        $students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->get();
        if ($students->count() == 0) {
            return redirect('exam-attendance-create')->with('message-danger', 'No Record Found');
        }

        $exam_attendance = SmExamAttendance::where('class_id', $request->class)->where('section_id', $request->section)->where('subject_id', $request->subject)->where('exam_id', $request->exam)->first();


        $exam_attendance_childs = [];
        if ($exam_attendance != "") {
            $exam_attendance_childs = $exam_attendance->examAttendanceChild;
        }


        $exams = SmExamType::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        $subjects = SmSubject::where('active_status', 1)->get();
        $exam_id = $request->exam;
        $subject_id = $request->subject;
        $class_id = $request->class;
        $section_id = $request->section;
        return view('backEnd.examination.exam_attendance_create', compact('exams', 'classes', 'subjects', 'students', 'exam_id', 'subject_id', 'class_id', 'section_id', 'exam_attendance_childs'));
    }
    public function examAttendanceStore(Request $request)
    {

        $alreday_assigned = SmExamAttendance::where('class_id', $request->class_id)->where('section_id', $request->section_id)->where('subject_id', $request->subject_id)->where('exam_id', $request->exam_id)->first();
        DB::beginTransaction();
        try {
            if ($alreday_assigned == "") {
                $exam_attendance = new SmExamAttendance();
            } else {
                $exam_attendance = SmExamAttendance::where('class_id', $request->class_id)->where('section_id', $request->section_id)->where('subject_id', $request->subject_id)->where('exam_id', $request->exam_id)->first();
            }

            $exam_attendance->exam_id = $request->exam_id;
            $exam_attendance->subject_id = $request->subject_id;
            $exam_attendance->class_id = $request->class_id;
            $exam_attendance->section_id = $request->section_id;
            $exam_attendance->save();
            $exam_attendance->toArray();

            if ($alreday_assigned != "") {
                SmExamAttendanceChild::where('exam_attendance_id', $exam_attendance->id)->delete();
            }

            foreach ($request->id as $student) {
                $exam_attendance_child = new SmExamAttendanceChild();
                $exam_attendance_child->exam_attendance_id = $exam_attendance->id;
                $exam_attendance_child->student_id = $student;
                $exam_attendance_child->attendance_type = $request->attendance[$student];
                $exam_attendance_child->save();
            }

            DB::commit();
            Toastr::success('Operation successful', 'Success');
            return redirect('exam-attendance-create');
        } catch (\Exception $e) {
            DB::rollback();

            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
    }

    public function sendMarksBySms()
    {
        $exams = SmExamType::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        return view('backEnd.examination.send_marks_by_sms', compact('exams', 'classes'));
    }
    public function sendMarksBySmsStore(Request $request)
    {
        $request->validate([
            'exam' => 'required',
            'class' => 'required',
            'receiver' => 'required'
        ]);
        $exams = SmExamType::all();
        $classes = SmClass::all();
        return view('backEnd.examination.send_marks_by_sms', compact('exams', 'classes'));
    }



    public function meritListReport(Request $request)
    {

        $exams = SmExamType::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['exams'] = $exams->toArray();
            $data['classes'] = $classes->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.reports.merit_list_report', compact('exams', 'classes'));
    }


    //created by Rashed
    public function reportsTabulationSheet()
    {
        $exams = SmExam::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        return view('backEnd.reports.report_tabulation_sheet', compact('exams', 'classes'));
    }
    public function reportsTabulationSheetSearch(Request $request)
    {

        $exams = SmExam::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        return view('backEnd.reports.report_tabulation_sheet', compact('exams', 'classes'));
    }




    //end tabulation sheet report



    public function meritListReportSearch(Request $request)
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        if ($request->method() == 'POST') {
            //ur code here

            $emptyResult = SmTemporaryMeritlist::truncate();
            $input = $request->all();
            $validator = Validator::make($input, [
                'exam' => 'required',
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

            $InputClassId = $request->class;
            $InputExamId = $request->exam;
            $InputSectionId = $request->section;

            $class          = SmClass::find($InputClassId);
            $section        = SmSection::find($InputSectionId);
            $exam           = SmExamType::find($InputExamId);

            $is_data = DB::table('sm_mark_stores')->where([['class_id', $InputClassId], ['section_id', $InputSectionId], ['exam_term_id', $InputExamId]])->first();
            if (empty($is_data)) {
                return redirect()->back()->with('message-danger', 'Your result is not found!');
            }

            $exams = SmExamType::where('active_status', 1)->get();
            $classes = SmClass::where('active_status', 1)->get();



            $subjects = SmSubject::where('active_status', 1)->get();
            $assign_subjects = SmAssignSubject::where('class_id', $class->id)->where('section_id', $section->id)->get();
            $class_name = $class->class_name;


            $exam_name = $exam->title;

            $eligible_subjects       = SmAssignSubject::where('class_id', $InputClassId)->where('section_id', $InputSectionId)->get();
            $eligible_students       = SmStudent::where('class_id', $InputClassId)->where('section_id', $InputSectionId)->get();


            //all subject list in a specific class/section
            $subject_ids        = [];
            $subject_strings    = '';
            $marks_string       = '';
            foreach ($eligible_students as $SingleStudent) {
                foreach ($eligible_subjects as $subject) {
                    $subject_ids[]      = $subject->subject_id;
                    $subject_strings    = (empty($subject_strings)) ? $subject->subject->subject_name : $subject_strings . ',' . $subject->subject->subject_name;
                    $getMark            =  SmResultStore::where([
                        ['exam_type_id',   $InputExamId],
                        ['class_id',       $InputClassId],
                        ['section_id',     $InputSectionId],
                        ['student_id',     $SingleStudent->id],
                        ['subject_id',     $subject->subject_id]
                    ])->first();


                    if (empty($getMark->total_marks)) {
                        $FinalMarks = 0;
                    } else {
                        $FinalMarks = $getMark->total_marks;
                    }
                    $marks_string = (empty($marks_string)) ? $FinalMarks : $marks_string . ',' . $FinalMarks;
                }
                //end subject list for specific section/class

                $results                =  SmResultStore::where([
                    ['exam_type_id',   $InputExamId],
                    ['class_id',       $InputClassId],
                    ['section_id',     $InputSectionId],
                    ['student_id',     $SingleStudent->id]
                ])->get();


                $is_absent                =  SmResultStore::where([
                    ['exam_type_id',   $InputExamId],
                    ['class_id',       $InputClassId],
                    ['section_id',     $InputSectionId],
                    ['is_absent',      1],
                    ['student_id',     $SingleStudent->id]
                ])->get();
                $total_gpa_point        =  SmResultStore::where([
                    ['exam_type_id',   $InputExamId],
                    ['class_id',       $InputClassId],
                    ['section_id',     $InputSectionId],
                    ['student_id',     $SingleStudent->id]
                ])->sum('total_gpa_point');
                $total_marks            =  SmResultStore::where([
                    ['exam_type_id',   $InputExamId],
                    ['class_id',       $InputClassId],
                    ['section_id',     $InputSectionId],
                    ['student_id',     $SingleStudent->id]
                ])->sum('total_marks');


                $sum_of_mark = ($total_marks == 0) ? 0 : $total_marks;
                $average_mark = ($total_marks == 0) ? 0 : floor($total_marks / $results->count()); //get average number 
                $is_absent = (count($is_absent) > 0) ? 1 : 0;         //get is absent ? 1=Absent, 0=Present 
                $total_GPA = ($total_gpa_point == 0) ? 0 : $total_gpa_point / $results->count();
                $exart_gp_point = number_format($total_GPA, 2, '.', '');            //get gpa results 
                $full_name          =   $SingleStudent->full_name;                 //get name 
                $admission_no       =   $SingleStudent->admission_no;           //get admission no


                $insert_results                     = new SmTemporaryMeritlist();
                $insert_results->student_name       = $full_name;
                $insert_results->admission_no       = $admission_no;
                $insert_results->subjects_string    = $subject_strings;
                $insert_results->marks_string       = $marks_string;
                $insert_results->total_marks        = $sum_of_mark;
                $insert_results->average_mark       = $average_mark;
                $insert_results->gpa_point          = $exart_gp_point;
                $markGrades = SmMarksGrade::where([['from', '<=', $exart_gp_point], ['up', '>=', $exart_gp_point]])->first();
                $insert_results->result             = $markGrades->grade_name;
                $insert_results->section_id         = $InputSectionId;
                $insert_results->class_id           = $InputClassId;
                $insert_results->exam_id            = $InputExamId;
                $insert_results->save();

                $subject_strings = "";
                $marks_string = "";
                $total_marks = 0;
                $average = 0;
                $exart_gp_point = 0;
                $admission_no = 0;
                $full_name = "";
            } //end loop eligible_students

            $first_data = SmTemporaryMeritlist::find(1);
            $subjectlist = explode(',', $first_data->subjects_string);
            $allresult_data = SmTemporaryMeritlist::orderBy('gpa_point', 'desc')->get();
            $merit_serial = 1;
            foreach ($allresult_data as $row) {
                $D = SmTemporaryMeritlist::find($row->id);
                $D->merit_order = $merit_serial++;
                $D->save();
            }
            $allresult_data = SmTemporaryMeritlist::orderBy('merit_order', 'asc')->get();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['exams'] = $exams->toArray();
                $data['classes'] = $classes->toArray();
                $data['subjects'] = $subjects->toArray();
                $data['class'] = $class;
                $data['section'] = $section;
                $data['exam'] = $exam;
                $data['subjectlist'] = $subjectlist;
                $data['allresult_data'] = $allresult_data;
                $data['class_name'] = $class_name;
                $data['assign_subjects'] = $assign_subjects;
                $data['exam_name'] = $exam_name;
                return ApiBaseMethod::sendResponse($data, null);
            }


            return view('backEnd.reports.merit_list_report', compact('exams', 'classes', 'marks_register', 'subjects', 'class', 'section', 'exam', 'subjectlist', 'allresult_data', 'class_name', 'assign_subjects', 'exam_name', 'InputClassId', 'InputExamId', 'InputSectionId'));
        }
    }






    public function meritListPrint(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $emptyResult = SmTemporaryMeritlist::truncate();

        $InputClassId = $request->InputClassId;
        $InputExamId = $request->InputExamId;
        $InputSectionId = $request->InputSectionId;

        $class          = SmClass::find($InputClassId);
        $section        = SmSection::find($InputSectionId);
        $exam           = SmExamType::find($InputExamId);

        $is_data = DB::table('sm_mark_stores')->where([['class_id', $InputClassId], ['section_id', $InputSectionId], ['exam_term_id', $InputExamId]])->first();


        $exams = SmExamType::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();



        $subjects = SmSubject::where('active_status', 1)->get();
        $assign_subjects = SmAssignSubject::where('class_id', $class->id)->where('section_id', $section->id)->get();
        $class_name = $class->class_name;
        $exam_name = $exam->title;

        $eligible_subjects       = SmAssignSubject::where('class_id', $InputClassId)->where('section_id', $InputSectionId)->get();
        $eligible_students       = SmStudent::where('class_id', $InputClassId)->where('section_id', $InputSectionId)->get();


        //all subject list in a specific class/section
        $subject_ids        = [];
        $subject_strings    = '';
        $marks_string       = '';
        foreach ($eligible_students as $SingleStudent) {
            foreach ($eligible_subjects as $subject) {
                $subject_ids[]      = $subject->subject_id;
                $subject_strings    = (empty($subject_strings)) ? $subject->subject->subject_name : $subject_strings . ',' . $subject->subject->subject_name;
                $getMark            =  SmResultStore::where([
                    ['exam_type_id',   $InputExamId],
                    ['class_id',       $InputClassId],
                    ['section_id',     $InputSectionId],
                    ['student_id',     $SingleStudent->id],
                    ['subject_id',     $subject->subject_id]
                ])->first();


                if (empty($getMark->total_marks)) {
                    $FinalMarks = 0;
                } else {
                    $FinalMarks = $getMark->total_marks;
                }
                $marks_string = (empty($marks_string)) ? $FinalMarks : $marks_string . ',' . $FinalMarks;
            }
            //end subject list for specific section/class

            $results                =  SmResultStore::where([
                ['exam_type_id',   $InputExamId],
                ['class_id',       $InputClassId],
                ['section_id',     $InputSectionId],
                ['student_id',     $SingleStudent->id]
            ])->get();


            $is_absent                =  SmResultStore::where([
                ['exam_type_id',   $InputExamId],
                ['class_id',       $InputClassId],
                ['section_id',     $InputSectionId],
                ['is_absent',      1],
                ['student_id',     $SingleStudent->id]
            ])->get();
            $total_gpa_point        =  SmResultStore::where([
                ['exam_type_id',   $InputExamId],
                ['class_id',       $InputClassId],
                ['section_id',     $InputSectionId],
                ['student_id',     $SingleStudent->id]
            ])->sum('total_gpa_point');
            $total_marks            =  SmResultStore::where([
                ['exam_type_id',   $InputExamId],
                ['class_id',       $InputClassId],
                ['section_id',     $InputSectionId],
                ['student_id',     $SingleStudent->id]
            ])->sum('total_marks');


            $sum_of_mark = ($total_marks == 0) ? 0 : $total_marks;
            $average_mark = ($total_marks == 0) ? 0 : floor($total_marks / $results->count()); //get average number 
            $is_absent = (count($is_absent) > 0) ? 1 : 0;         //get is absent ? 1=Absent, 0=Present 
            $total_GPA = ($total_gpa_point == 0) ? 0 : $total_gpa_point / $results->count();
            $exart_gp_point = number_format($total_GPA, 2, '.', '');            //get gpa results 
            $full_name          =   $SingleStudent->full_name;                 //get name 
            $admission_no       =   $SingleStudent->admission_no;           //get admission no


            $insert_results                     = new SmTemporaryMeritlist();
            $insert_results->student_name       = $full_name;
            $insert_results->admission_no       = $admission_no;
            $insert_results->subjects_string    = $subject_strings;
            $insert_results->marks_string       = $marks_string;
            $insert_results->total_marks        = $sum_of_mark;
            $insert_results->average_mark       = $average_mark;
            $insert_results->gpa_point          = $exart_gp_point;
            $markGrades = SmMarksGrade::where([['from', '<=', $exart_gp_point], ['up', '>=', $exart_gp_point]])->first();
            $insert_results->result             = $markGrades->grade_name;
            $insert_results->section_id         = $InputSectionId;
            $insert_results->class_id           = $InputClassId;
            $insert_results->exam_id            = $InputExamId;
            $insert_results->save();

            $subject_strings = "";
            $marks_string = "";
            $total_marks = 0;
            $average = 0;
            $exart_gp_point = 0;
            $admission_no = 0;
            $full_name = "";
        } //end loop eligible_students

        $first_data = SmTemporaryMeritlist::find(1);
        $subjectlist = explode(',', $first_data->subjects_string);
        $allresult_data = SmTemporaryMeritlist::orderBy('gpa_point', 'desc')->get();
        $merit_serial = 1;
        foreach ($allresult_data as $row) {
            $D = SmTemporaryMeritlist::find($row->id);
            $D->merit_order = $merit_serial++;
            $D->save();
        }
        $allresult_data = SmTemporaryMeritlist::orderBy('merit_order', 'asc')->get();



        $customPaper = array(0, 0, 700.00, 1500.80);
        $pdf = PDF::loadView(
            'backEnd.reports.merit_list_report_print',
            [
                'exams' => $exams,
                'classes' => $classes,
                'subjects' => $subjects,
                'class' => $class,
                'section' => $section,
                'exam' => $exam,
                'subjectlist' => $subjectlist,
                'allresult_data' => $allresult_data,
                'class_name' => $class_name,
                'assign_subjects' => $assign_subjects,
                'exam_name' => $exam_name,
                'exam_name' => $exam_name,

            ]
        )->setPaper($customPaper, 'landscape');
        return $pdf->stream('Merit_LIST.pdf');
    }

    public function markSheetReport()
    {
        $exams = SmExamType::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        return view('backEnd.reports.mark_sheet_report', compact('exams', 'classes'));
    }

    public function markSheetReportSearch(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $request->validate([
            'exam' => 'required',
            'class' => 'required',
            'section' => 'required'
        ]);

        $class = SmClass::find($request->class);
        $section = SmSection::find($request->section);
        $exam = SmExam::find($request->exam);

        $subjects = SmAssignSubject::where('class_id', $request->class)->where('section_id', $request->section)->get();
        $all_students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->get();

        $marks_registers = SmMarksRegister::where('exam_id', $request->exam)->where('class_id', $request->class)->where('section_id', $request->section)->get();

        $marks_register = SmMarksRegister::where('exam_id', $request->exam)->where('class_id', $request->class)->where('section_id', $request->section)->first();
        if ($marks_registers->count() == 0) {
            return redirect('mark-sheet-report')->with('message-danger', 'Result not found');
        }
        // $marks_register_childs = $marks_register->marksRegisterChilds;
        $exams = SmExam::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        $grades = SmMarksGrade::where('active_status', 1)->get();

        $exam_id = $request->exam;
        $class_id = $request->class;

        return view('backEnd.reports.mark_sheet_report', compact('exams', 'classes', 'marks_registers', 'marks_register', 'all_students', 'subjects', 'class', 'section', 'exam', 'grades', 'exam_id', 'class_id'));
    }

    public function markSheetReportStudent(Request $request)
    {
        $exams = SmExamType::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['exams'] = $exams->toArray();
            $data['classes'] = $classes->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.reports.mark_sheet_report_student', compact('exams', 'classes'));
    }


    //marks     SheetReport     Student     Search

    public function markSheetReportStudentSearch(Request $request)
    {

        $input = $request->all();
        $validator = Validator::make($input, [
            'exam' => 'required',
            'class' => 'required',
            'section' => 'required',
            'student' => 'required'
        ]);

        $input['exam_id'] = $request->exam;
        $input['class_id'] = $request->class;
        $input['section_id'] = $request->section;
        $input['student_id'] = $request->student;



        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $exams = SmExamType::where('active_status', 1)->get();
        $classes        =   SmClass::where('active_status', 1)->get();
        $exam_types     =   SmExamType::where('active_status', 1)->get();

        $subjects = SmAssignSubject::where([['class_id', $request->class], ['section_id', $request->section]])->get();
        $student_detail =   $studentDetails = SmStudent::find($request->student);
        $section        =   SmSection::where('active_status', 1)->where('id', $request->section)->first();
        $section_id     =   $request->section;
        $class_id       =   $request->class;
        $class_name     =   SmClass::find($class_id);
        $exam_type_id   =   $request->exam;
        $student_id     =   $request->student;
        $exam_details     =   SmExamType::where('active_status', 1)->find($exam_type_id);



        $is_result_available = SmResultStore::where([['class_id', $request->class], ['exam_type_id', $request->exam], ['section_id', $request->section], ['student_id', $request->student]])->get();

        if ($is_result_available->count() > 0) {

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['exam_types'] = $exam_types->toArray();
                $data['classes'] = $classes->toArray();
                $data['studentDetails'] = $studentDetails;
                $data['exams'] = $exams->toArray();
                $data['subjects'] = $subjects->toArray();
                $data['section'] = $section;
                $data['class_id'] = $class_id;
                $data['student_detail'] = $student_detail;
                $data['is_result_available'] = $is_result_available;
                $data['exam_type_id'] = $exam_type_id;
                $data['section_id'] = $section_id;
                $data['student_id'] = $student_id;
                $data['exam_details'] = $exam_details;
                $data['class_name'] = $class_name;
                return ApiBaseMethod::sendResponse($data, null);
            }
            $student = $student_id;
            return view('backEnd.reports.mark_sheet_report_student', compact('exam_types', 'classes', 'studentDetails', 'exams', 'classes', 'subjects', 'section', 'class_id', 'student_detail', 'is_result_available', 'exam_type_id', 'section_id', 'student_id', 'exam_details', 'class_name', 'input'));
        } else {

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Ops! Your result is not found! Please check mark register');
            }
            Toastr::error('Ops! Your result is not found! Please check mark register', 'Failed');
            return redirect('mark-sheet-report-student');
        }



        $marks_register = SmMarksRegister::where('exam_id', $request->exam)->where('student_id', $request->student)->first();


        $student_detail = SmStudent::where('id', $request->student)->first();
        $subjects = SmAssignSubject::where('class_id', $request->class)->where('section_id', $request->section)->get();
        $exams = SmExamType::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        $grades = SmMarksGrade::where('active_status', 1)->get();
        $class = SmClass::find($request->class);
        $section = SmSection::find($request->section);
        $exam_detail = SmExam::find($request->exam);
        $exam_id = $request->exam;
        $class_id = $request->class;



        return view('backEnd.reports.mark_sheet_report_student', compact('exam_types', 'classes', 'studentDetails', 'exams', 'classes', 'marks_register', 'subjects', 'class', 'section', 'exam_detail', 'grades', 'exam_id', 'class_id', 'student_detail', 'input'));
    }


    public function markSheetReportStudentPrint(Request $request)
    {



        $exams = SmExamType::where('active_status', 1)->get();
        $classes        =   SmClass::where('active_status', 1)->get();
        $exam_types     =   SmExamType::where('active_status', 1)->get();

        $subjects = SmAssignSubject::where([['class_id', $request->class], ['section_id', $request->section]])->get();
        $student_detail =   $studentDetails = SmStudent::find($request->student);
        $section        =   SmSection::where('active_status', 1)->where('id', $request->section)->first();
        $section_id     =   $request->section;
        $class_id       =   $request->class;
        $class_name     =   SmClass::find($class_id);
        $exam_type_id   =   $request->exam;
        $student_id     =   $request->student;
        $exam_details     =   SmExamType::where('active_status', 1)->find($exam_type_id);



        $is_result_available = SmResultStore::where([['class_id', $request->class], ['exam_type_id', $request->exam], ['section_id', $request->section], ['student_id', $request->student]])->get();

        if ($is_result_available->count() > 0) {

            // ->setPaper($customPaper,'portrait');
            // ->setPaper($customPaper, 'landscape');
            $customPaper = array(0, 0, 700.00, 1000.80);
            $pdf = PDF::loadView(
                'backEnd.reports.mark_sheet_report_student_print',
                [
                    'exam_types' => $exam_types,
                    'classes' => $classes,
                    'subjects' => $subjects,
                    'class' => $class_id,
                    'class_name' => $class_name,
                    'section' => $section,
                    'exams' => $exams,
                    'section_id' => $section_id,
                    'exam_type_id' => $exam_type_id,
                    'is_result_available' => $is_result_available,
                    'student_detail' => $student_detail,
                    'class_id' => $class_id,
                    'studentDetails' => $studentDetails,
                    'student_id' => $student_id,
                    'exam_details' => $exam_details,

                ]
            )->setPaper('A4', 'portrait');
            return $pdf->stream('marks-sheet-of-' . $student_detail->full_name . '.pdf');
        }
    }
}
