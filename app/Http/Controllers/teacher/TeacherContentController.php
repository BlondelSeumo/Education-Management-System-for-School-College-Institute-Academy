<?php

namespace App\Http\Controllers\teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\SmStaff;
use App\SmStudent;
use App\Role;

use App\SmNotification;
use App\SmTeacherUploadContent;

use DB;

use Validator;
use App\ApiBaseMethod;

class TeacherContentController extends Controller
{
    public function uploadContent(Request $request)
    {


        $input = $request->all();
        //return $request->input();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'content_title' => "required",
                'content_type' => "required",
                'upload_date' => "required",
                'description' => "required"


            ]);
        }
        //as assignment, st study material, sy sullabus, ot others download

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
        }
        if (empty($request->input('available_for'))) {

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', 'Content Receiver not selected');
            }
        }


        $fileName = "";
        if ($request->file('attach_file') != "") {
            $file = $request->file('attach_file');
            $fileName = $request->input('created_by') . time() . "." . $file->getClientOriginalExtension();
            // $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/upload_contents/', $fileName);
            $fileName = 'public/uploads/upload_contents/' . $fileName;
        }
        // return $fileName;

        $uploadContents = new SmTeacherUploadContent();
        $uploadContents->content_title = $request->input('content_title');
        $uploadContents->content_type = $request->input('content_type');



        if ($request->input('available_for') == 'admin') {
            $uploadContents->available_for_admin = 1;
        } elseif ($request->input('available_for') == 'student') {
            if (!empty($request->input('all_classes'))) {
                $uploadContents->available_for_all_classes = 1;
            } else {
                $uploadContents->class = $request->input('class');
                $uploadContents->section = $request->input('section');
            }
        }

        //return $request->input();

        $uploadContents->upload_date = date('Y-m-d', strtotime($request->input('upload_date')));
        $uploadContents->description = $request->input('description');
        $uploadContents->upload_file = $fileName;
        $uploadContents->created_by = $request->input('created_by');
        $results = $uploadContents->save();


        if ($request->input('content_type') == 'as') {
            $purpose = 'assignment';
        } elseif ($request->input('content_type') == 'st') {
            $purpose = 'Study Material';
        } elseif ($request->input('content_type') == 'sy') {
            $purpose = 'Syllabus';
        } elseif ($request->input('content_type') == 'ot') {
            $purpose = 'Others Download';
        }


        // foreach ($request->input('available_for') as $value) {
        if ($request->input('available_for') == 'admin') {
            $roles = Role::where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 9)->get();

            foreach ($roles as $role) {
                $staffs = SmStaff::where('role_id', $role->id)->get();
                foreach ($staffs as $staff) {
                    $notification = new SmNotification;
                    $notification->user_id = $staff->id;
                    $notification->role_id = $role->id;
                    $notification->date = date('Y-m-d');
                    $notification->message = $purpose . ' updated';
                    $notification->save();
                }
            }
        }
        if ($request->input('available_for') == 'student') {
            if (!empty($request->input('all_classes'))) {
                $students = SmStudent::select('id')->get();
                foreach ($students as $student) {
                    $notification = new SmNotification;
                    $notification->user_id = $student->id;
                    $notification->role_id = 2;
                    $notification->date = date('Y-m-d');
                    $notification->message = $purpose . ' updated';
                    $notification->save();
                }
            } else {
                $students = SmStudent::select('id')->where('class_id', $request->input('class'))->where('section_id', $request->input('section'))->get();
                foreach ($students as $student) {
                    $notification = new SmNotification;
                    $notification->user_id = $student->id;
                    $notification->role_id = 2;
                    $notification->date = date('Y-m-d');
                    $notification->message = $purpose . ' updated';
                    $notification->save();
                }
            }
        }
        // }

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            $data = '';

            return ApiBaseMethod::sendResponse($data, null);
        }
    }
    public function contentList(Request $request)
    {
        $content_list = DB::table('sm_teacher_upload_contents')
            ->where('available_for_admin', '<>', 0)
            ->get();
        $type = "as assignment, st study material, sy sullabus, ot others download";
        $data = [];
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data['content_list'] = $content_list->toArray();
            $data['type'] = $type;
            return ApiBaseMethod::sendResponse($data, null);
        }
    }
    public function deleteContent(Request $request, $id)
    {
        $content = DB::table('sm_teacher_upload_contents')->where('id', $id)->delete();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = '';
            return ApiBaseMethod::sendResponse($data, null);
        }
    }
}
