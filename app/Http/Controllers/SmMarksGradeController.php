<?php

namespace App\Http\Controllers;

use Validator;
use App\SmMarksGrade;
use App\ApiBaseMethod;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SmMarksGradeController extends Controller
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
    public function index(Request $request)
    {
        $marks_grades = SmMarksGrade::orderBy('gpa', 'desc')->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($marks_grades, null);
        }
        return view('backEnd.examination.marks_grade', compact('marks_grades'));
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
        $input = $request->all();
        $validator = Validator::make($input, [
            'grade_name' => "required|unique:sm_marks_grades",
            'gpa' => "required|unique:sm_marks_grades|max:4",
            'percent_from' => "required",
            'percent_upto' => "required"
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $marks_grade = new SmMarksGrade();
        $marks_grade->grade_name = $request->grade_name;
        $marks_grade->gpa = $request->gpa;
        $marks_grade->percent_from = $request->percent_from;
        $marks_grade->percent_upto = $request->percent_upto;
        $marks_grade->description = $request->description;
        $result = $marks_grade->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Grade has been created successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $marks_grade = SmMarksGrade::find($id);
        $marks_grades = SmMarksGrade::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['marks_grade'] = $marks_grade->toArray();
            $data['marks_grades'] = $marks_grades->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.examination.marks_grade', compact('marks_grade', 'marks_grades'));
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
        $input = $request->all();

        $validator = Validator::make($input, [
            'grade_name' => "required|unique:sm_marks_grades,grade_name," . $request->id,
            'gpa' => "required|unique:sm_marks_grades,gpa," . $request->id,
            'percent_from' => "required",
            'percent_upto' => "required"
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $marks_grade = SmMarksGrade::find($request->id);
        $marks_grade->grade_name = $request->grade_name;
        $marks_grade->gpa = $request->gpa;
        $marks_grade->percent_from = $request->percent_from;
        $marks_grade->percent_upto = $request->percent_upto;
        $marks_grade->description = $request->description;
        $result = $marks_grade->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Grade has been updated successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect('marks-grade');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
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
        $marks_grade = SmMarksGrade::destroy($id);

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($marks_grade) {
                return ApiBaseMethod::sendResponse(null, 'Grdae has been deleted successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($marks_grade) {
                Toastr::success('Operation successful', 'Success');
                return redirect('marks-grade');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }
}
