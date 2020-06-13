<?php

namespace App\Http\Controllers;

use DB;
use App\SmExam;
use App\SmClass;
use App\SmSection;
use App\SmStudent;
use App\SmSubject;
use App\SmExamType;
use App\SmExamSetup;
use App\SmMarkStore;
use App\ApiBaseMethod;
use App\SmResultStore;
use App\SmClassSection;
use App\SmAssignSubject;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;


class SmExamController extends Controller
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
        $exams = SmExam::all();
        $exams_types = SmExamType::all();
        $classes = SmClass::where('active_status', 1)->get();
        $subjects = SmSubject::where('active_status', 1)->get();
        $sections = SmSection::where('active_status', 1)->get();
        
        return view('backEnd.examination.exam', compact('exams', 'classes', 'subjects', 'exams_types', 'sections'));
    }


    public function exam_setup($id)
    {
        $exams = SmExam::all();
        $exams_types = SmExamType::all();
        $classes = SmClass::where('active_status', 1)->get();
        $subjects = SmSubject::where('active_status', 1)->get();
        $sections = SmSection::where('active_status', 1)->get();
        $selected_exam_type_id = $id;

        return view('backEnd.examination.exam', compact('exams', 'classes', 'subjects', 'exams_types', 'sections', 'selected_exam_type_id'));
    }



    public function exam_reset()
    {

        $exams = SmExam::all();
        SmExam::query()->truncate();


        $exams_types = SmExamType::all();
        SmExamType::query()->truncate();

        $exam_mark_stores = SmMarkStore::all();
        SmMarkStore::query()->truncate();

        $exam_results_stores = SmResultStore::all();
        SmResultStore::query()->truncate();

        SmExamSetup::query()->truncate();



        $classes = SmClass::where('active_status', 1)->get();
        $subjects = SmSubject::where('active_status', 1)->get();
        $sections = SmSection::where('active_status', 1)->get();
        return view('backEnd.examination.exam', compact('exams', 'classes', 'subjects', 'exams_types', 'sections'));
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


        $request->validate(
            [
                'class_ids' => 'required',
                'subjects_ids' => 'required|array',
                'exams_types' => 'required|array',
                'exam_marks' => "required|numeric|min:0"
            ],
            [
                'class_ids.required' => 'The Class Field is required!',
                'subjects_ids.required' => 'At least one checkbox required!',
                'exams_types.required' => 'At least one checkbox required!',
            ]
        );

       
        DB::beginTransaction();

        try {

            $sections = SmClassSection::where('class_id', $request->class_ids)->get();


            foreach ($request->exams_types as $exam_type_id) {

                foreach ($sections as $section) {


                    $subject_for_sections = SmAssignSubject::where('class_id', $request->class_ids)->where('section_id', $section->section_id)->get();


                    $eligible_subjects = [];

                    foreach ($subject_for_sections as $subject_for_section) {
                        $eligible_subjects[] = $subject_for_section->subject_id;
                    }


                    foreach ($request->subjects_ids as $subject_id) {

                        if (in_array($subject_id, $eligible_subjects)) {
                            $exam = new SmExam();
                            $exam->exam_type_id = $exam_type_id;
                            $exam->class_id = $request->class_ids;
                            $exam->section_id = $section->section_id;
                            $exam->subject_id = $subject_id;
                            $exam->exam_mark = $request->exam_marks;
                            $exam->save();
                            $exam->toArray();


                            $exam_term_id = $exam->id;


                            $length = count($request->exam_title);


                            for ($i = 0; $i < $length; $i++) {

                                $ex_title = $request->exam_title[$i];
                                $ex_mark = $request->exam_mark[$i];

                                $newSetupExam = new SmExamSetup();
                                $newSetupExam->exam_id = $exam->id;
                                $newSetupExam->class_id = $request->class_ids;
                                $newSetupExam->section_id = $section->section_id;
                                $newSetupExam->subject_id = $subject_id;
                                $newSetupExam->exam_term_id = $exam_type_id;
                                $newSetupExam->exam_title = $ex_title;
                                $newSetupExam->exam_mark = $ex_mark;
                                $result = $newSetupExam->save();
                            } //end loop exam setup loop
                        }
                    }
                }
            }

            DB::commit();
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            //dd($e->getMessage(), $e->errorInfo);
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

        $exams_types = SmExamType::all();
        $exam = SmExam::find($id);
        $classes = SmClass::where('active_status', 1)->get();
        $subjects = SmAssignSubject::where('active_status', 1)->where('class_id', $exam->class_id)->where('section_id', $exam->section_id)->get();
        $sections = SmClassSection::where('class_id', $exam->class_id)->get();



        return view('backEnd.examination.examEdit', compact('exam', 'exams', 'classes', 'subjects', 'sections', 'exams_types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'exam_marks' => "required",
        ]);


        DB::beginTransaction();

        try {

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            $exam = SmExam::find($id);
            $exam->exam_mark = $request->exam_marks;
            $exam->save();

            SmExamSetup::where('exam_id', $id)->delete();
            $length = count($request->exam_title);

            for ($i = 0; $i < $length; $i++) {

                $ex_title = $request->exam_title[$i];
                $ex_mark = $request->exam_mark[$i];

                $newSetupExam = new SmExamSetup();
                $newSetupExam->exam_id = $exam->id;
                $newSetupExam->exam_title = $ex_title;
                $newSetupExam->exam_mark = $ex_mark;
                $newSetupExam->save();
            } //end loop exam setup loop


            DB::commit();
            Toastr::success('Operation successful', 'Success');
            return redirect('exam');
        } catch (\Exception $e) {
            //dd($e->getMessage(), $e->errorInfo);
            return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
        }
    }
    public function examSetup($id)
    {
        $exam = SmExam::find($id);

        $exams = SmExam::all();
        $classes = SmClass::where('active_status', 1)->get();
        $subjects = SmSubject::where('active_status', 1)->get();
        $sections = SmSection::where('active_status', 1)->get();
        return view('backEnd.examination.exam_setup', compact('exam', 'exams', 'classes', 'subjects', 'sections'));
    }


    public function examSetupStore(Request $request)
    {


        $class_id = $request->class;
        $section_id = $request->section;
        $subject_id = $request->subject;
        $exam_title = $request->name;
        $exam_term_id = $request->exam_term_id;

        $total_exam_mark = $request->total_exam_mark;
        $totalMark = $request->totalMark;

        if ($total_exam_mark == $totalMark) {
            $length = count($request->exam_title);
            for ($i = 0; $i < $length; $i++) {
                $ex_title = $request->exam_title[$i];
                $ex_mark = $request->exam_mark[$i];

                $newSetupExam = new SmExamSetup();
                $newSetupExam->class_id = $class_id;
                $newSetupExam->section_id = $section_id;
                $newSetupExam->subject_id = $subject_id;
                $newSetupExam->exam_term_id = $exam_term_id;
                $newSetupExam->exam_title = $ex_title;
                $newSetupExam->exam_mark = $ex_mark;
                $result = $newSetupExam->save();
                if ($result) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect('exam');
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            }
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
    public function destroy(Request $request, $id)
    {

        $id_key = 'exam_id';

        $tables = \App\tableList::getTableList($id_key);

        DB::beginTransaction();

        try {

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');



            SmExamSetup::where('exam_id', $id)->delete();

            $delete_query = SmExam::destroy($id);

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($delete_query) {
                    return ApiBaseMethod::sendResponse(null, 'Exam has been deleted successfully');
                } else {
                    return ApiBaseMethod::sendError('Something went wrong, please try again.');
                }
            } else {

                if ($delete_query) {
                    DB::commit();
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

    public function getClassSubjects(Request $request)
    {

        $subjects = SmAssignSubject::where('class_id', $request->id)->get();
        $subjects = $subjects->groupBy('subject_id');

        $assinged_subjects = [];
        foreach ($subjects as $key => $subject) {
            $assinged_subjects[] = SmSubject::find($key);
        }

        return response()->json($assinged_subjects);
    }

    public function subjectAssignCheck(Request $request)
    {

        $exam = [];
        $assigned_subjects = [];
        foreach ($request->exam_types as $exam_type) {
            $exam = SmExam::where('exam_type_id', $exam_type)->where('class_id', $request->class_id)->where('subject_id', $request->id)->first();

            if ($exam != "") {
                $exam_title = SmExamType::find($exam_type);

                $assigned_subjects[] = $exam_title->title;
            }
        }



        return response()->json($assigned_subjects);
    }
}
