<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use App\SmMarksGrade;
use Illuminate\Http\Request;
use App\SmExamType;
use App\SmClass;
use App\SmSection;
use App\SmMarkStore;
use App\SmAssignSubject;
use App\SmStudent;
use App\SmExam;
use App\SmResultStore;
use App\SmExamSetup;
use Validator;
use DB;
use PDF;

class SmReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }

    public function tabulationSheetReport(Request $request)
    {
        $exam_types = SmExamType::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['exam_types'] = $exam_types->toArray();
            $data['classes'] = $classes->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.reports.tabulation_sheet_report', compact('exam_types', 'classes'));
    }

    public function tabulationSheetReportSearch(Request $request)
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

        $exam_term_id   = $request->exam;
        $class_id       = $request->class;
        $section_id     = $request->section;
        $student_id     = $request->student;

        if (isset($request->student)) {
            $marks      = SmMarkStore::where([
                ['exam_term_id', $request->exam],
                ['class_id', $request->class],
                ['section_id', $request->section],
                ['student_id', $request->student]
            ])->get();
            $students   = SmStudent::where([
                ['class_id', $request->class],
                ['section_id', $request->section],
                ['id', $request->student]
            ])->get();

            $subjects       = SmAssignSubject::where([
                ['class_id', $request->class],
                ['section_id', $request->section]
            ])->get();
            foreach ($subjects as $sub) {
                $subject_list_name[] = $sub->subject->subject_name;
            }
            $grade_chart = SmMarksGrade::select('grade_name', 'gpa', 'percent_from as start', 'percent_upto as end', 'description')->where('active_status', 1)->get()->toArray();

            $single_student = SmStudent::find($request->student);
            $single_exam_term = SmExamType::find($request->exam);

            $tabulation_details['student_name'] = $single_student->full_name;
            $tabulation_details['student_roll'] = $single_student->roll_no;
            $tabulation_details['student_admission_no'] = $single_student->admission_no;
            $tabulation_details['student_class'] = $single_student->ClassName->class_name;
            $tabulation_details['student_section'] = $single_student->section->section_name;
            $tabulation_details['exam_term'] = $single_exam_term->title;
            $tabulation_details['subject_list'] = $subject_list_name;
            $tabulation_details['grade_chart'] = $grade_chart;
        } else {
            $marks = SmMarkStore::where([
                ['exam_term_id', $request->exam],
                ['class_id', $request->class],
                ['section_id', $request->section]
            ])->get();
            $students       = SmStudent::where([
                ['class_id', $request->class],
                ['section_id', $request->section]
            ])->get();
        }


        $exam_types     = SmExamType::where('active_status', 1)->get();
        $classes        = SmClass::where('active_status', 1)->get();
        $single_class   = SmClass::find($request->class);
        $single_section   = SmSection::find($request->section);
        $subjects       = SmAssignSubject::where([
            ['class_id', $request->class],
            ['section_id', $request->section]
        ])->get();


        foreach ($subjects as $sub) {
            $subject_list_name[] = $sub->subject->subject_name;
        }
        $grade_chart = SmMarksGrade::select('grade_name', 'gpa', 'percent_from as start', 'percent_upto as end', 'description')->where('active_status', 1)->get()->toArray();

        $single_exam_term = SmExamType::find($request->exam);

        $tabulation_details['student_class'] = $single_class->class_name;
        $tabulation_details['student_section'] = $single_section->section_name;
        $tabulation_details['exam_term'] = $single_exam_term->title;
        $tabulation_details['subject_list'] = $subject_list_name;
        $tabulation_details['grade_chart'] = $grade_chart;



        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['exam_types'] = $exam_types->toArray();
            $data['classes'] = $classes->toArray();
            $data['marks'] = $marks->toArray();
            $data['subjects'] = $subjects->toArray();
            $data['exam_term_id'] = $exam_term_id;
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;
            $data['students'] = $students->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        $get_class = SmClass::where('active_status', 1)
            ->where('id', $request->class)
            ->first();
        $get_section = SmSection::where('active_status', 1)
            ->where('id', $request->section)
            ->first();
        $class_name = $get_class->class_name;
        $section_name = $get_section->section_name;

        return view(
            'backEnd.reports.tabulation_sheet_report',
            compact('exam_types', 'classes', 'marks', 'subjects', 'exam_term_id', 'class_id', 'section_id', 'class_name', 'section_name', 'students', 'student_id', 'tabulation_details')
        );
    }

    //tabulationSheetReportPrint
    public function tabulationSheetReportPrint(Request $request)
    {

        $exam_term_id   = $request->exam_term_id;
        $class_id       = $request->class_id;
        $section_id     = $request->section_id;
        $student_id     = $request->student_id;

        $single_class   = SmClass::find($request->class_id);
        $single_section   = SmSection::find($request->section_id);
        $single_exam_term = SmExamType::find($request->exam_term_id);
        $subject_list_name = [];

        $subjects       = SmAssignSubject::where([
            ['class_id', $request->class_id],
            ['section_id', $request->section_id]
        ])->get();


        if (!empty($request->student_id)) {


            $marks      = SmMarkStore::where([
                ['exam_term_id',    $request->exam_term_id],
                ['class_id',        $request->class_id],
                ['section_id',      $request->section_id],
                ['student_id',      $request->student_id]
            ])->get();
            $students   = SmStudent::where([
                ['class_id',    $request->class_id],
                ['section_id',  $request->section_id],
                ['id',          $request->student_id]
            ])->get();


            foreach ($subjects as $sub) {
                $subject_list_name[] = $sub->subject->subject_name;
            }
            $grade_chart = SmMarksGrade::select('grade_name', 'gpa', 'percent_from as start', 'percent_upto as end', 'description')->where('active_status', 1)->get()->toArray();

            $single_student = SmStudent::find($request->student_id);

            $single_exam_term = SmExamType::find($request->exam_term_id);

            $tabulation_details['student_name'] = $single_student->full_name;
            $tabulation_details['student_roll'] = $single_student->roll_no;
            $tabulation_details['student_admission_no'] = $single_student->admission_no;
            $tabulation_details['student_class'] = $single_student->ClassName->class_name;
            $tabulation_details['student_section'] = $single_student->section->section_name;
            $tabulation_details['exam_term'] = $single_exam_term->title;
            $tabulation_details['subject_list'] = $subject_list_name;
            $tabulation_details['grade_chart'] = $grade_chart;
        } else {
            $marks = SmMarkStore::where([
                ['exam_term_id', $request->exam_term_id],
                ['class_id', $request->class_id],
                ['section_id', $request->section_id]
            ])->get();
            $students       = SmStudent::where([
                ['class_id', $request->class_id],
                ['section_id', $request->section_id]
            ])->get();
        }


        $exam_types     = SmExamType::where('active_status', 1)->get();
        $classes        = SmClass::where('active_status', 1)->get();



        foreach ($subjects as $sub) {
            $subject_list_name[] = $sub->subject->subject_name;
        }
        $grade_chart = SmMarksGrade::select('grade_name', 'gpa', 'percent_from as start', 'percent_upto as end', 'description')->where('active_status', 1)->get()->toArray();

        $tabulation_details['student_class'] = $single_class->class_name;
        $tabulation_details['student_section'] = $single_section->section_name;
        $tabulation_details['exam_term'] = $single_exam_term->title;
        $tabulation_details['subject_list'] = $subject_list_name;
        $tabulation_details['grade_chart'] = $grade_chart;


        $get_class = SmClass::where('active_status', 1)
            ->where('id', $request->class_id)
            ->first();
        $get_section = SmSection::where('active_status', 1)
            ->where('id', $request->section_id)
            ->first();
        $class_name = $get_class->class_name;
        $section_name = $get_section->section_name;

        $customPaper = array(0, 0, 700.00, 1500.80);

        $pdf = PDF::loadView(
            'backEnd.reports.tabulation_sheet_report_print',
            [
                'exam_types'    => $exam_types,
                'classes'       => $classes,
                'marks'         => $marks,
                'class_id'      => $class_id,
                'section_id'    => $section_id,
                'exam_term_id'  => $exam_term_id,
                'subjects'      => $subjects,
                'class_name'    => $class_name,
                'section_name'  => $section_name,
                'students'      => $students,
                'student_id'    => $student_id,
                'tabulation_details' => $tabulation_details,
            ]
        )->setPaper($customPaper, 'landscape');
        return $pdf->stream('tabulationSheetReportPrint.pdf');
    }


    public function progressCardReport(Request $request)
    {
        $exams = SmExam::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['routes'] = $exams->toArray();
            $data['assign_vehicles'] = $classes->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.reports.progress_card_report', compact('exams', 'classes'));
    }


    //student progress report search by rashed
    public function progressCardReportSearch(Request $request)
    {

        //input validations, 3 input must be required
        $input = $request->all();
        $validator = Validator::make($input, [
            'class' => 'required',
            'section' => 'required',
            'student' => 'required'
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $exams = SmExam::where('active_status', 1)->get();
        $exam_types = SmExamType::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        //$studentDetails = SmStudent::find($request->student);

        $studentDetails = DB::table('sm_students')
            ->join('sm_sessions', 'sm_sessions.id', '=', 'sm_students.session_id')
            ->join('sm_classes', 'sm_classes.id', '=', 'sm_students.class_id')
            ->join('sm_sections', 'sm_sections.id', '=', 'sm_students.section_id')
            ->where('sm_students.id', '=', $request->student)
            ->first();


        //return $studentDetails;

        $exam_setup = SmExamSetup::where([['class_id', $request->class], ['section_id', $request->section]])->get();

        $class_id = $request->class;
        $section_id = $request->section;
        $student_id = $request->student;


        $subjects = SmAssignSubject::where([['class_id', $request->class], ['section_id', $request->section]])->get();


        $is_result_available = SmResultStore::where([['class_id', $request->class], ['section_id', $request->section], ['student_id', $request->student]])->get();

        if ($is_result_available->count() > 0) {

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['exams'] = $exams->toArray();
                $data['classes'] = $classes->toArray();
                $data['studentDetails'] = $studentDetails;
                $data['is_result_available'] = $is_result_available;
                $data['subjects'] = $subjects->toArray();
                $data['class_id'] = $class_id;
                $data['section_id'] = $section_id;
                $data['student_id'] = $student_id;
                $data['exam_types'] = $exam_types;
                return ApiBaseMethod::sendResponse($data, null);
            }
            return view('backEnd.reports.progress_card_report', compact('exams', 'classes', 'studentDetails', 'is_result_available', 'subjects', 'class_id', 'section_id', 'student_id', 'exam_types'));
        } else {
            return redirect('progress-card-report')->with('message-danger', 'Ops! Your result is not found! Please check mark register.');
        }
    }
}
