<?php

namespace App\Http\Controllers\teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SmAssignSubject;

use App\SmStaff;


use App\SmHomework;


use DB;
use Auth;
use Validator;
use App\ApiBaseMethod;

class HomeWorkController extends Controller
{
    public function addHomework(Request $request)
    {

        $input = $request->all();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'class' => "required",
                'section' => "required",
                'subject' => "required",
                'assign_date' => "required",
                'submission_date' => "required",
                'description' => "required",
                'marks' => "required"
            ]);
        }

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
        }
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
}
