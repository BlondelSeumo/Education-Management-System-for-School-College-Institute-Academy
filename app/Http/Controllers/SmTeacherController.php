<?php

namespace App\Http\Controllers;

use DB;
use App\Role;
use App\User;
use App\SmClass;
use App\SmStaff;
use App\SmSection;
use App\SmStudent;
use App\ApiBaseMethod;
use App\SmContentType;
use App\SmNotification;
use Illuminate\Http\Request;
use App\SmTeacherUploadContent;
use Brian2694\Toastr\Facades\Toastr;

class SmTeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }

    public function uploadContentList(Request $request)
    {
        $contentTypes = SmContentType::all();
        $uploadContents = SmTeacherUploadContent::where('available_for_admin', 1)->get();
        $classes = SmClass::where('active_status', '=', '1')->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['contentTypes'] = $contentTypes->toArray();
            $data['uploadContents'] = $uploadContents->toArray();
            $data['classes'] = $classes->toArray();
            return ApiBaseMethod::sendResponse($data, 'Content uploaded successfully.');
        }

        return view('backEnd.teacher.uploadContentList', compact('contentTypes', 'classes', 'uploadContents'));
    }


    public function saveUploadContent(Request $request)
    {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');



        if (isset($request->available_for)) {
            foreach ($request->available_for as $value) {
                if ($value == 'student') {
                    if (!isset($request->all_classes)) {
                        $request->validate([
                            'content_title' => "required",
                            'content_type' => "required",
                            'upload_date' => "required",
                            'content_file' => "required",
                            'class' => "required",
                            'section' => "required",
                        ]);
                    } else {
                        $request->validate([
                            'content_title' => "required",
                            'content_type' => "required",
                            'upload_date' => "required",
                            'content_file' => "required",
                        ]);
                    }
                }
            }
        } else {
            $request->validate(
                [
                    'content_title' => "required",
                    'content_type' => "required",
                    'available_for' => 'required|array',
                    'upload_date' => "required",
                    'content_file' => "required",
                ],
                [
                    'available_for.required' => 'At least one checkbox required!'
                ]
            );
        }


        $fileName = "";

        if ($request->file('content_file') != "") {
            $file = $request->file('content_file');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/upload_contents/', $fileName);
            $fileName = 'public/uploads/upload_contents/' . $fileName;
        }

        $uploadContents = new SmTeacherUploadContent();
        $uploadContents->content_title = $request->content_title;
        $uploadContents->content_type = $request->content_type;

        foreach ($request->available_for as $value) {
            if ($value == 'admin') {
                $uploadContents->available_for_admin = 1;
            }

            if ($value == 'student') {
                if (isset($request->all_classes)) {
                    $uploadContents->available_for_all_classes = 1;
                } else {
                    $uploadContents->class = $request->class;
                    $uploadContents->section = $request->section;
                }
            }
        }

        // $uploadContents->available_for_admin = 1;
        // $uploadContents->available_for_all_classes = 1;
        // $uploadContents->class = $request->class;
        // $uploadContents->section = $request->section;


        $uploadContents->upload_date = date('Y-m-d', strtotime($request->upload_date));
        $uploadContents->description = $request->description;
        $uploadContents->upload_file = $fileName;
        $uploadContents->created_by = Auth()->user()->id; 
        $results = $uploadContents->save();


        if ($request->content_type == 'as') {
            $purpose = 'assignment';
        } elseif ($request->content_type == 'st') {
            $purpose = 'Study Material';
        } elseif ($request->content_type == 'sy') {
            $purpose = 'Syllabus';
        } elseif ($request->content_type == 'ot') {
            $purpose = 'Others Download';
        }


        foreach ($request->available_for as $value) {
            if ($value == 'admin') {
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
            if ($value == 'student') {
                if (isset($request->all_classes)) {
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
                    $students = SmStudent::select('id')->where('class_id', $request->class)->where('section_id', $request->section)->get();
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
        }


        if ($results) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function assignmentList(Request $request)
    {

        $uploadContents = SmTeacherUploadContent::where('content_type', 'as')->where('available_for_admin', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($uploadContents->toArray(), 'null');
        }

        return view('backEnd.teacher.assignmentList', compact('uploadContents'));
    }

    public function studyMetarialList(Request $request)
    {

        $uploadContents = SmTeacherUploadContent::where('content_type', 'st')->where('available_for_admin', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($uploadContents->toArray(), 'null');
        }
        return view('backEnd.teacher.studyMetarialList', compact('uploadContents'));
    }

    public function syllabusList(Request $request)
    {

        $uploadContents = SmTeacherUploadContent::where('content_type', 'sy')->where('available_for_admin', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($uploadContents->toArray(), 'null');
        }

        return view('backEnd.teacher.syllabusList', compact('uploadContents'));
    }

    public function otherDownloadList(Request $request)
    {

        $uploadContents = SmTeacherUploadContent::where('content_type', "ot")->where('available_for_admin', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($uploadContents->toArray(), 'null');
        }
        return view('backEnd.teacher.otherDownloadList', compact('uploadContents'));
    }

    public function deleteUploadContent(Request $request, $id)
    {

        $uploadContent = SmTeacherUploadContent::find($id);
        if ($uploadContent->upload_file != "") {
            unlink($uploadContent->upload_file);
        }
        $result = $uploadContent->delete();


        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Content has been deleted successfully.');
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
}
