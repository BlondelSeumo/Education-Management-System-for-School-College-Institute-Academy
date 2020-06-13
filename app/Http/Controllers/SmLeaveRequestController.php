<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Validator;
use App\SmLeaveType;
use App\ApiBaseMethod;
use App\SmLeaveDefine;
use App\SmLeaveRequest;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SmLeaveRequestController extends Controller
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
        $user = Auth::user();

        if ($user) {
            $my_leaves = SmLeaveDefine::where('role_id', $user->role_id)->get();
            $apply_leaves = SmLeaveRequest::where('role_id', $user->role_id)->where('active_status', 1)->get();
            $leave_types = SmLeaveDefine::where('role_id', $user->role_id)->where('active_status', 1)->get();
        } else {
            $my_leaves = SmLeaveDefine::where('role_id', $request->role_id)->get();
            $apply_leaves = SmLeaveRequest::where('role_id', $request->role_id)->where('active_status', 1)->get();
            $leave_types = SmLeaveDefine::where('role_id', $request->role_id)->where('active_status', 1)->get();
        }

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['my_leaves'] = $my_leaves->toArray();
            $data['apply_leaves'] = $apply_leaves->toArray();
            $data['leave_types'] = $leave_types->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.humanResource.apply_leave', compact('apply_leaves', 'leave_types', 'my_leaves'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'apply_date' => "required",
                'leave_type' => "required",
                'leave_from' => 'required|before_or_equal:leave_to',
                'leave_to' => "required",
                'login_id' => "required",
                'role_id' => "required"
            ]);
        } else {
            $validator = Validator::make($input, [
                'apply_date' => "required",
                'leave_type' => "required",
                'leave_from' => 'required|before_or_equal:leave_to',
                'leave_to' => "required"
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

        $fileName = "";
        if ($request->file('attach_file') != "") {
            $file = $request->file('attach_file');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/leave_request/', $fileName);
            $fileName = 'public/uploads/leave_request/' . $fileName;
        }

        $user = Auth()->user();

        if ($user) {
            $login_id = $user->id;
            $role_id = $user->role_id;
        } else {
            $login_id = $request->login_id;
            $role_id = $request->role_id;
        }
        $apply_leave = new SmLeaveRequest();
        $apply_leave->staff_id = $login_id;
        $apply_leave->role_id = $role_id;
        $apply_leave->apply_date = date('Y-m-d', strtotime($request->apply_date));
        $apply_leave->leave_define_id = $request->leave_type;
        $apply_leave->type_id = $request->leave_type;
        $apply_leave->leave_from = date('Y-m-d', strtotime($request->leave_from));
        $apply_leave->leave_to = date('Y-m-d', strtotime($request->leave_to));
        $apply_leave->approve_status = 'P';
        $apply_leave->reason = $request->reason;
        $apply_leave->file = $fileName;
        $result = $apply_leave->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Leave Request has been created successfully.');
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = Auth::user();
        if ($user) {
            $my_leaves = SmLeaveDefine::where('role_id', $user->role_id)->get();
            $apply_leaves = SmLeaveRequest::where('role_id', $user->role_id)->where('active_status', 1)->get();
            $leave_types = SmLeaveDefine::where('role_id', $user->role_id)->where('active_status', 1)->get();
        } else {
            $my_leaves = SmLeaveDefine::where('role_id', $request->role_id)->get();
            $apply_leaves = SmLeaveRequest::where('role_id', $request->role_id)->where('active_status', 1)->get();
            $leave_types = SmLeaveDefine::where('role_id', $request->role_id)->where('active_status', 1)->get();
        }

        $apply_leave = SmLeaveRequest::find($id);

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['my_leaves'] = $my_leaves->toArray();
            $data['apply_leaves'] = $apply_leaves->toArray();
            $data['leave_types'] = $leave_types->toArray();
            $data['apply_leave'] = $apply_leave->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.humanResource.apply_leave', compact('apply_leave', 'apply_leaves', 'leave_types', 'my_leaves'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->all();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'id' => "required",
                'apply_date' => "required",
                'leave_type' => "required",
                'leave_from' => 'required|before_or_equal:leave_to',
                'leave_to' => "required",
                'login_id' => "required",
                'role_id' => "required"
            ]);
        } else {
            $validator = Validator::make($input, [
                'apply_date' => "required",
                'leave_type' => "required",
                'leave_from' => 'required|before_or_equal:leave_to',
                'leave_to' => "required"
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

        $fileName = "";
        if ($request->file('file') != "") {
            $apply_leave = SmLeaveRequest::find($request->id);
            if (file_exists($apply_leave->file)) unlink($apply_leave->file);
            $file = $request->file('file');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/leave_request/', $fileName);
            $fileName = 'public/uploads/leave_request/' . $fileName;
        }


        $user = Auth()->user();

        if ($user) {
            $login_id = $user->id;
            $role_id = $user->role_id;
        } else {
            $login_id = $request->login_id;
            $role_id = $request->role_id;
        }

        $apply_leave = SmLeaveRequest::find($request->id);
        $apply_leave->staff_id = $login_id;
        $apply_leave->role_id = $role_id;
        $apply_leave->apply_date = date('Y-m-d', strtotime($request->apply_date));
        $apply_leave->leave_define_id = $request->leave_type;
        $apply_leave->leave_from = date('Y-m-d', strtotime($request->leave_from));
        $apply_leave->leave_to = date('Y-m-d', strtotime($request->leave_to));
        $apply_leave->approve_status = 'P';
        $apply_leave->reason = $request->reason;
        if ($fileName != "") {
            $apply_leave->file = $fileName;
        }
        $result = $apply_leave->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Leave Request has been updated successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect('apply-leave');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }

    public function viewLeaveDetails(Request $request, $id)
    {


        $leaveDetails = SmLeaveRequest::find($id);

        $apply = "";

        // $apply_leaves = SmLeaveRequest::all();
        // $leave_types = SmLeaveType::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['leaveDetails'] = $leaveDetails->toArray();
            $data['apply'] = $apply;
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.humanResource.viewLeaveDetails', compact('leaveDetails', 'apply'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $apply_leave = SmLeaveRequest::find($id);
        if ($apply_leave->file != "") {

            if (file_exists($apply_leave->file)) unlink($apply_leave->file);
        }
        $result = $apply_leave->delete();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Request has been deleted successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect('apply-leave');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }
}
