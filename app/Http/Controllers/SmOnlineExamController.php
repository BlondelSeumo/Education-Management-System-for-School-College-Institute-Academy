<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\SmClass;
use App\SmSection;
use App\SmStudent;
use App\SmSubject;
use App\SmOnlineExam;
use App\ApiBaseMethod;
use App\SmNotification;
use App\SmQuestionBank;
use App\SmOnlineExamMark;
use Illuminate\Http\Request;
use App\SmOnlineExamQuestion;

use App\SmStudentTakeOnlineExam;
use App\SmOnlineExamQuestionAssign;
use Brian2694\Toastr\Facades\Toastr;
use App\SmOnlineExamQuestionMuOption;

class SmOnlineExamController extends Controller
{

    public function __construct()
    {
        $this->middleware('PM');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $online_exams = SmOnlineExam::where('status', '!=', 2)->get();
        $classes = SmClass::where('active_status', 1)->get();
        $sections = SmSection::where('active_status', 1)->get();
        $subjects = SmSubject::where('active_status', 1)->get();
        $present_date_time = date("Y-m-d H:i:s");

        return view('backEnd.examination.online_exam', compact('online_exams', 'classes', 'sections', 'subjects', 'present_date_time'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'title' => 'required',
            'class' => 'required',
            'section' => 'required',
            'subject' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'percentage' => 'required',
            'instruction' => 'required'
        ]);


        $date = strtotime($request->date);

        $newformat = date('Y-m-d', $date);

        $online_exam = new SmOnlineExam();
        $online_exam->title = $request->title;
        $online_exam->class_id = $request->class;
        $online_exam->section_id = $request->section;
        $online_exam->subject_id = $request->subject;
        $online_exam->date = date('Y-m-d', strtotime($request->date));
        $online_exam->start_time = date('H:i:s', strtotime($request->start_time));
        $online_exam->end_time = date('H:i:s', strtotime($request->end_time));
        $online_exam->end_date_time = date('Y-m-d H:i:s', strtotime($request->date . ' ' . $request->end_time));
        $online_exam->percentage = $request->percentage;
        $online_exam->instruction = $request->instruction;
        $online_exam->status = 0;


        $result = $online_exam->save();
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $online_exams = SmOnlineExam::all();



        $classes = SmClass::all();
        $sections = SmSection::all();
        $subjects = SmSubject::all();
        $online_exam = SmOnlineExam::find($id);
        $present_date_time = date("Y-m-d H:i:s");

        return view('backEnd.examination.online_exam', compact('online_exams', 'classes', 'sections', 'subjects', 'online_exam', 'present_date_time'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'class' => 'required',
            'section' => 'required',
            'subject' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'percentage' => 'required',
            'instruction' => 'required'
        ]);

        $date = strtotime($request->date);

        $newformat = date('Y-m-d', $date);

        $online_exam = SmOnlineExam::find($id);
        $online_exam->title = $request->title;
        $online_exam->class_id = $request->class;
        $online_exam->section_id = $request->section;
        $online_exam->subject_id = $request->subject;
        $online_exam->date = date('Y-m-d', strtotime($request->date));
        $online_exam->start_time = date('H:i:s', strtotime($request->start_time));
        $online_exam->end_time = date('H:i:s', strtotime($request->end_time));
        $online_exam->end_date_time = date('Y-m-d H:i:s', strtotime($request->date . ' ' . $request->end_time));
        $online_exam->percentage = $request->percentage;
        $online_exam->instruction = $request->instruction;

        $result = $online_exam->save();
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function section()
    {
        $id = $_GET['id'];
        return response()->json(['response' => 'This is get method']);
    }

    public function delete(Request $request)
    {

        // $result = SmOnlineExam::where('id', $request->id)->delete();
        // if($result){
        //     return redirect()->back()->with('message-success-delete', 'Online exam been deleted successfully');
        // }else{
        //     return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        // }
        $id_key = 'online_exam_id';

        $tables = \App\tableList::getTableList($id_key);

        try {
            $delete_query = SmOnlineExam::destroy($request->id);
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($delete_query) {
                    return ApiBaseMethod::sendResponse(null, 'Online exam been deleted successfully');
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
    }

    public function manageOnlineExamQuestion($id)
    {
        $online_exam = SmOnlineExam::find($id);
        $question_banks = SmQuestionBank::where('class_id', $online_exam->class_id)->where('section_id', $online_exam->section_id)->get();

        $assigned_questions = SmOnlineExamQuestionAssign::where('online_exam_id', $id)->get();
        $already_assigned = [];
        foreach ($assigned_questions as $assigned_question) {
            $already_assigned[] = $assigned_question->question_bank_id;
        }


        return view('backEnd.examination.manage_online_exam', compact('online_exam', 'question_banks', 'already_assigned'));
    }

    public function manageOnlineExamQuestionStore(Request $request)
    {

        if ($request->question_type != 'M') {
            $online_question = new SmOnlineExamQuestion();
            $online_question->online_exam_id = $request->online_exam_id;
            $online_question->type = $request->question_type;
            $online_question->mark = $request->mark;
            $online_question->title = $request->question_title;
            if ($request->question_type == "F") {
                $online_question->suitable_words = $request->suitable_words;
            } elseif ($request->question_type == "T") {
                $online_question->trueFalse = $request->trueOrFalse;
            }
            $result = $online_question->save();
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } else {

            DB::beginTransaction();

            try {
                $online_question = new SmOnlineExamQuestion();
                $online_question->online_exam_id = $request->online_exam_id;
                $online_question->type = $request->question_type;
                $online_question->mark = $request->mark;
                $online_question->title = $request->question_title;
                $online_question->save();
                $online_question->toArray();
                $i = 0;
                if (isset($request->option)) {
                    foreach ($request->option as $option) {
                        $i++;
                        $option_check = 'option_check_' . $i;
                        $online_question_option = new SmOnlineExamQuestionMuOption();
                        $online_question_option->online_exam_question_id = $online_question->id;
                        $online_question_option->title = $option;
                        if (isset($request->$option_check)) {
                            $online_question_option->status = 1;
                        } else {
                            $online_question_option->status = 0;
                        }
                        $online_question_option->save();
                    }
                }
                DB::commit();
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } catch (Exception $e) {
                DB::rollBack();
            }
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function onlineExamPublish($id)
    {
        date_default_timezone_set("Asia/Dhaka");
        $present_date_time = date("Y-m-d H:i:s");

        $publish = SmOnlineExam::find($id);
        $class_id = $publish->class_id;
        $section_id = $publish->section_id;
        if ($present_date_time > $publish->end_date_time) {
            Toastr::error('Please update exam time', 'Failed');
            return redirect()->back();
        }
        $publish->status = 1;
        $publish->save();



        $students = SmStudent::select('id')->where('class_id', $class_id)->where('section_id', $section_id)->get();

        foreach ($students as $student) {
            $notification = new SmNotification;
            $notification->user_id = $student->id;
            $notification->role_id = 2;
            $notification->date = date('Y-m-d');
            $notification->message = 'New online exam created';
            $notification->save();
        }

        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    public function onlineExamPublishCancel($id)
    {
        $publish = SmOnlineExam::find($id);
        $publish->status = 3;
        $publish->save();
        Toastr::error('Exam Expired', 'Failed');
        return redirect()->back();
    }

    public function onlineQuestionEdit($id, $type, $examId)
    {
        $online_exam_question = SmOnlineExamQuestion::find($id);
        return view('backEnd.examination.online_exam_question_edit', compact('id', 'type', 'examId', 'online_exam_question'));
    }

    public function onlineExamQuestionEdit(Request $request)
    {
        if ($request->question_type != 'M') {
            $online_question = SmOnlineExamQuestion::find($request->id);
            $online_question->online_exam_id = $request->online_exam_id;
            $online_question->type = $request->question_type;
            $online_question->mark = $request->mark;
            $online_question->title = $request->question_title;
            if ($request->question_type == "F") {
                $online_question->suitable_words = $request->suitable_words;
            } elseif ($request->question_type == "T") {
                $online_question->trueFalse = $request->trueOrFalse;
            }
            $result = $online_question->save();
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } else {

            DB::beginTransaction();

            try {
                $online_question = SmOnlineExamQuestion::find($request->id);
                $online_question->online_exam_id = $request->online_exam_id;
                $online_question->type = $request->question_type;
                $online_question->mark = $request->mark;
                $online_question->title = $request->question_title;
                $online_question->save();
                $online_question->toArray();

                SmOnlineExamQuestionMuOption::where('online_exam_question_id', $online_question->id)->delete();

                $i = 0;
                if (isset($request->option)) {
                    foreach ($request->option as $option) {
                        $i++;
                        $option_check = 'option_check_' . $i;
                        $online_question_option = new SmOnlineExamQuestionMuOption();
                        $online_question_option->online_exam_question_id = $online_question->id;
                        $online_question_option->title = $option;
                        if (isset($request->$option_check)) {
                            $online_question_option->status = 1;
                        } else {
                            $online_question_option->status = 0;
                        }
                        $online_question_option->save();
                    }
                }
                DB::commit();
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } catch (Exception $e) {
                DB::rollBack();
            }
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function onlineExamQuestionDelete(Request $request)
    {
        $online_exam_question = SmOnlineExamQuestion::find($request->id);
        if ($online_exam_question->type == "M") {
            SmOnlineExamQuestionMuOption::where('online_exam_question_id', $online_exam_question->id)->delete();
            $online_exam_question->delete();
        } else {
            $online_exam_question->delete();
        }
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    public function onlineExamMarksRegister($id)
    {

        $online_exam_question = SmOnlineExam::find($id);

        $students = SmStudent::where('class_id', $online_exam_question->class_id)->where('section_id', $online_exam_question->section_id)->get();

        $present_students = [];
        foreach ($students as $student) {
            $take_exam = SmStudentTakeOnlineExam::where('student_id', $student->id)->where('online_exam_id', $online_exam_question->id)->first();
            if ($take_exam != "") {
                $present_students[] = $student->id;
            }
        }

        return view('backEnd.examination.online_exam_marks_register', compact('online_exam_question', 'students', 'present_students'));
    }

    public function onlineExamMarksStore(Request $request)
    {
        SmOnlineExamMark::where('exam_id', $request->exam_id)->delete();

        $counter = 0;
        foreach ($request->students as $student) {
            $counter++;

            $marks = 'marks_' . $counter;
            $abs = 'abs_' . $counter;

            $online_mark = new SmOnlineExamMark();
            $online_mark->exam_id = $request->exam_id;
            $online_mark->subject_id = $request->subject_id;
            $online_mark->student_id = $student;
            if (isset($request->$abs)) {
                $online_mark->abs = $request->$abs;
            } else {
                $online_mark->marks = $request->$marks;
                $online_mark->abs = 0;
            }
            $online_mark->save();
        }
        Toastr::success('Operation successful', 'Success');
        return redirect('online-exam');
    }
    public function onlineExamResult($id)
    {

        $online_exam_question = SmOnlineExam::find($id);

        $students = SmStudent::where('class_id', $online_exam_question->class_id)->where('section_id', $online_exam_question->section_id)->get();

        $present_students = [];
        foreach ($students as $student) {
            $take_exam = SmStudentTakeOnlineExam::where('student_id', $student->id)->where('online_exam_id', $online_exam_question->id)->first();
            if ($take_exam != "") {
                $present_students[] = $student->id;
            }
        }

        $total_marks = 0;
        foreach ($online_exam_question->assignQuestions as $assignQuestion) {
            $total_marks = $total_marks + $assignQuestion->questionBank->marks;
        }


        return view('backEnd.examination.online_exam_result_view', compact('online_exam_question', 'students', 'present_students', 'total_marks'));
    }



    public function onlineExamQuestionAssign(Request $request)
    {
        SmOnlineExamQuestionAssign::where('online_exam_id', $request->online_exam_id)->delete();
        if (isset($request->questions)) {
            foreach ($request->questions as $question) {
                $assign = new SmOnlineExamQuestionAssign();
                $assign->online_exam_id = $request->online_exam_id;
                $assign->question_bank_id = $question;
                $assign->save();
            }
            Toastr::success('Operation successful', 'Success');
            return redirect('online-exam');
        }
        Toastr::error('No question is assigned', 'Failed');
        return redirect()->back();
    }

    public function viewOnlineQuestionModal($id)
    {
        $question_bank = SmQuestionBank::find($id);
        return view('backEnd.examination.online_eaxm_question_view_modal', compact('question_bank'));
    }

    public function onlineExamMarking($exam_id, $s_id)
    {
        $take_online_exam = SmStudentTakeOnlineExam::where('online_exam_id', $exam_id)->where('student_id', $s_id)->first();
        return view('backEnd.examination.online_answer_marking', compact('take_online_exam'));
    }

    public function onlineExamMarkingStore(Request $request)
    {

        $online_take_exam_mark = SmStudentTakeOnlineExam::where('online_exam_id', $request->online_exam_id)->where('student_id', $request->student_id)->first();
        $total_marks = 0;
        if (isset($request->marks)) {
            foreach ($request->marks as $mark) {
                $question_marks = SmQuestionBank::select('marks')->where('id', $mark)->first();
                $total_marks = $total_marks + $question_marks->marks;
            }
        }
        $online_take_exam_mark->total_marks = $total_marks;
        $online_take_exam_mark->status = 2;
        $online_take_exam_mark->save();
        Toastr::success('Operation successful', 'Success');
        return redirect('online-exam-marks-register/' . $request->online_exam_id);
    }

    public function onlineExamReport(Request $request)
    {
        $exams = SmOnlineExam::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['exams'] = $exams->toArray();
            $data['classes'] = $classes->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.reports.online_exam_report', compact('exams', 'classes'));
    }




    public function onlineExamReportSearch(Request $request)
    {


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

        date_default_timezone_set("Asia/Dhaka");
        $present_date_time = date("Y-m-d H:i:s");

        $online_exam_question = SmOnlineExam::find($request->exam);

        $students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->get();

        $online_exam = SmOnlineExam::where('class_id', $request->class)->where('section_id', $request->section)->where('id', $request->exam)->where('end_date_time', '<', $present_date_time)->where('status', 1)->first();


        if ($students->count() == 0 && $online_exam == "") {
            Toastr::error('No Result Found', 'Failed');
            return redirect('online-exam-report');
        }




        $present_students = [];
        foreach ($students as $student) {
            $take_exam = SmStudentTakeOnlineExam::where('student_id', $student->id)->where('online_exam_id', $online_exam_question->id)->first();
            if ($take_exam != "") {
                $present_students[] = $student->id;
            }
        }




        $total_marks = 0;
        foreach ($online_exam_question->assignQuestions as $assignQuestion) {
            $total_marks = $total_marks + $assignQuestion->questionBank->marks;
        }

        $exams = SmOnlineExam::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();

        $class_id = $request->class;
        $exam_id = $request->exam;


        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['online_exam_question'] = $online_exam_question;
            $data['students'] = $students->toArray();
            $data['present_students'] = $present_students;
            $data['total_marks'] = $total_marks;
            $data['exams'] = $exams->toArray();
            $data['classes'] = $classes->toArray();
            $data['class_id'] = $class_id;
            $data['exam_id'] = $exam_id;
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.reports.online_exam_report', compact('online_exam_question', 'students', 'present_students', 'total_marks', 'exams', 'classes', 'class_id', 'exam_id'));
    }
}
