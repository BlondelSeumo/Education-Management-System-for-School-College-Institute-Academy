<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\SmSubject;
use App\tableList;
use App\ApiBaseMethod;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SmSubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }

    public function index(Request $request)
    {
        $subjects = SmSubject::where('active_status', 1)->orderBy('id', 'DESC')->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($subjects, null);
        }
        return view('backEnd.academics.subject', compact('subjects'));
    }
    public function store(Request $request)
    {
        $input = $request->all();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'subject_name' => "required|unique:sm_subjects",
                'subject_type' => "required",
            ]);
        } else {
            $validator = Validator::make($input, [
                'subject_name' => "required|unique:sm_subjects",
                'subject_type' => "required",
            ]);
        }
        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $subject = new SmSubject();
        $subject->subject_name = $request->subject_name;
        $subject->subject_type = $request->subject_type;
        $subject->subject_code = $request->subject_code;
        $result = $subject->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Subject has been created successfully');
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
    public function edit(Request $request, $id)
    {
        $subject = SmSubject::find($id);
        $subjects = SmSubject::where('active_status', 1)->orderBy('id', 'DESC')->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['subject'] = $subject->toArray();
            $data['subjects'] = $subjects->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.academics.subject', compact('subject', 'subjects'));
    }
    public function update(Request $request)
    {
        $input = $request->all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'subject_name' => "required|unique:sm_subjects,subject_name," . $request->id,
                'subject_type' => "required",
            ]);
        } else {
            $validator = Validator::make($input, [
                'subject_name' => "required|unique:sm_subjects,subject_name," . $request->id,
                'subject_type' => "required",
            ]);
        }
        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $subject = SmSubject::find($request->id);
        $subject->subject_name = $request->subject_name;
        $subject->subject_type = $request->subject_type;
        $subject->subject_code = $request->subject_code;
        $result = $subject->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Subject has been updated successfully');
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
    public function delete(Request $request, $id)
    {

        $column_name = 'subject_id';

        $column_name = 'subject_id';
        $tables = tableList::ONLY_TABLE_LIST($column_name);
        foreach ($tables as $table) {
            try {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                DB::table($table)->where($column_name, '=', $id)->delete();
            } catch (\Illuminate\Database\QueryException $e) {
                //dd($e);
                $msg = 'Ops! Something went wrong. You are not allowed to remove this class.';
                Toastr::error($msg, 'Failed');
                return redirect()->back();
            }
        } //end foreach

        try {
            $result = $delete_query = SmSubject::destroy($request->id);

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($result) {
                    return ApiBaseMethod::sendResponse(null, 'Subject has been deleted successfully');
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
}
