<?php

namespace App\Http\Controllers\teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SmAssignSubject;
use App\SmClassRoutine;
use App\SmClassTime;
use App\SmWeekend;
use App\SmStaff;
use App\SmStudent;
use App\SmClass;

use App\SmHomework;
use App\SmLeaveRequest;

use App\SmNotification;
use App\SmTeacherUploadContent;

use DB;
use Auth;
use Validator;
use App\ApiBaseMethod;

class LeaveController extends Controller
{
    public function leaveTypeList(Request $request)
    {
        //return "Api URL";
        $leave_type = DB::table('sm_leave_defines')
            ->where('role_id', 4)
            ->join('sm_leave_types', 'sm_leave_types.id', '=', 'sm_leave_defines.type_id')
            ->where('sm_leave_defines.active_status', 1)
            ->select('sm_leave_types.id', 'type', 'total_days')
            ->distinct('sm_leave_defines.type_id')
            ->get();

        //return $leave_type;
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($leave_type, null);
        }
    }
    public function staffLeaveList(Request $request, $id)
    {

        $teacher = SmStaff::where('user_id', '=', $id)->first();
        $teacher_id = $teacher->id;

        $leave_list = SmLeaveRequest::where('staff_id', '=', $teacher_id)
            ->join('sm_leave_defines', 'sm_leave_defines.id', '=', 'sm_leave_requests.leave_define_id')
            ->join('sm_leave_types', 'sm_leave_types.id', '=', 'sm_leave_defines.type_id')
            ->get();
        $status = 'P for Pending, A for Approve, R for reject';
        $data = [];
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data['leave_list'] = $leave_list->toArray();
            $data['status'] = $status;
            return ApiBaseMethod::sendResponse($data, null);
        }
    }
    public function applyLeave(Request $request)
    {


        $input = $request->all();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'apply_date' => "required",
                'leave_type' => "required",
                'leave_from' => 'required|before_or_equal:leave_to',
                'leave_to' => "required",
                'teacher_id' => "required",
                'reason' => "required",

            ]);
        }

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
        }



        $fileName = "";
        if ($request->file('attach_file') != "") {
            $file = $request->file('attach_file');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/leave_request/', $fileName);
            $fileName = 'public/uploads/leave_request/' . $fileName;
        }

        $apply_leave = new SmLeaveRequest();
        $apply_leave->staff_id = $request->input('teacher_id');
        $apply_leave->role_id = 4;
        $apply_leave->apply_date = date('Y-m-d');
        $apply_leave->leave_define_id = $request->input('leave_type');
        $apply_leave->type_id = $request->input('leave_type');
        $apply_leave->leave_from = $request->input('leave_from');
        $apply_leave->leave_to = $request->input('leave_to');
        $apply_leave->approve_status = 'P';
        $apply_leave->reason = $request->input('reason');
        //return $request->teacher_id;
        if ($fileName != "") {
            $apply_leave->file = $fileName;
        }

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            $result = $apply_leave->save();

            return ApiBaseMethod::sendResponse($result, null);
        }
    }
}
