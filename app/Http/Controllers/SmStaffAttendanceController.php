<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\Role;
use App\SmStaff;
use App\SmClass;
use App\SmStaffAttendence;
use Validator;

class SmStaffAttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }

    public function staffAttendance(Request $request)
    {
        $roles = Role::where('active_status', '=', '1')->where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 10)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($roles, null);
        }
        return view('backEnd.humanResource.staff_attendance', compact('roles'));
    }

    public function staffAttendanceSearch(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'role' => 'required',
            'attendance_date' => 'required'
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $date = $request->attendance_date;
        $roles = Role::where('id', '!=', 3)->where('id', '!=', 2)->get();
        $role_id = $request->role;



        $staffs = SmStaff::where('role_id', $request->role)->get();

        if ($staffs->isEmpty()) {
            Toastr::error('No result found', 'Failed');
            return redirect('staff-attendance');
        }

        $already_assigned_staffs = [];
        $new_staffs = [];
        $attendance_type = "";
        foreach ($staffs as $staff) {
            $attendance = SmStaffAttendence::where('staff_id', $staff->id)->where('attendence_date', date('Y-m-d', strtotime($request->attendance_date)))->first();
            if ($attendance != "") {
                $already_assigned_staffs[] = $attendance;
                $attendance_type =  $attendance->attendence_type;
            } else {
                $new_staffs[] =  $staff;
            }
        }

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['role_id'] = $role_id;
            $data['date'] = $date;
            $data['roles'] = $roles->toArray();
            $data['already_assigned_staffs'] = $already_assigned_staffs;
            $data['new_staffs'] = $new_staffs;
            $data['attendance_type'] = $attendance_type;
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.humanResource.staff_attendance', compact('role_id', 'date', 'roles', 'already_assigned_staffs', 'new_staffs', 'attendance_type'));
    }

    public function staffAttendanceStore(Request $request)
    {

        foreach ($request->id as $staff) {
            $attendance = SmStaffAttendence::where('staff_id', $staff)->where('attendence_date', date('Y-m-d', strtotime($request->date)))->first();

            if ($attendance != "") {
                $attendance->delete();
            }


            $attendance = new SmStaffAttendence();
            $attendance->staff_id = $staff;

            if (isset($request->mark_holiday)) {
                $attendance->attendence_type = "H";
            } else {
                $attendance->attendence_type = $request->attendance[$staff];
                $attendance->notes = $request->note[$staff];
            }

            $attendance->attendence_date = date('Y-m-d', strtotime($request->date));
            $attendance->save();
        }

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse(null, 'Staff attendance been submitted successfully');
        }
        Toastr::success('Operation successful', 'Success');
        return redirect('staff-attendance');
    }


    public function staffAttendanceReport(Request $request)
    {

        // $roles = Role::where('id', '!=', 3)->where('id', '!=', 2)->get();
        $roles = Role::where('active_status', '=', '1')->where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 10)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            return ApiBaseMethod::sendResponse($roles, null);
        }
        return view('backEnd.humanResource.staff_attendance_report', compact('roles'));
    }

    public function staffAttendanceReportSearch(Request $request)
    {

        $input = $request->all();
        $validator = Validator::make($input, [
            'role' => 'required',
            'month' => 'required',
            'year' => 'required'
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $year = $request->year;
        $month = $request->month;;
        $role_id = $request->role;;
        $current_day = date('d');

        $days = cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year);
        $roles = Role::where('id', '!=', 3)->where('id', '!=', 2)->get();

        $staffs = SmStaff::where('role_id', $request->role)->get();

        $attendances = [];
        foreach ($staffs as $staff) {
            $attendance = SmStaffAttendence::where('staff_id', $staff->id)->where('attendence_date', 'like', $request->year . '-' . $request->month . '%')->get();
            if (count($attendance) != 0) {
                $attendances[] = $attendance;
            }
        }

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['attendances'] = $attendances;
            $data['days'] = $days;
            $data['year'] = $year;
            $data['month'] = $month;
            $data['current_day'] = $current_day;
            $data['roles'] = $roles;
            $data['role_id'] = $role_id;
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.humanResource.staff_attendance_report', compact('attendances', 'days', 'year', 'month', 'current_day', 'roles', 'role_id'));
    }

    function attendanceData($data)
    {
        return staffAttendanceSearch($data);
    }

    public function teacherMyAttendanceSearchAPI(Request $request, $id = null)
    {

        $input = $request->all();

        $validator = Validator::make($input, [
            'month' => "required",
            'year' => "required",
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $teacher = SmStaff::where('user_id', $id)->first();

        $year = $request->year;
        $month = $request->month;
        if ($month < 10) {
            $month = '0' . $month;
        }
        $current_day = date('d');

        $days = cal_days_in_month(CAL_GREGORIAN, $month, $request->year);
        $days2 = cal_days_in_month(CAL_GREGORIAN, $month - 1, $request->year);
        $previous_month = $month - 1;
        $previous_date = $year . '-' . $previous_month . '-' . $days2;



        $previousMonthDetails['date'] = $previous_date;
        $previousMonthDetails['day'] = $days2;
        $previousMonthDetails['week_name'] = date('D', strtotime($previous_date));


        $attendances = SmStaffAttendence::where('staff_id', $teacher->id)
            ->where('attendence_date', 'like', '%' . $request->year . '-' . $month . '%')
            ->select('attendence_type as attendance_type', 'attendence_date as attendance_date')
            ->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data['attendances'] = $attendances;
            $data['previousMonthDetails'] = $previousMonthDetails;
            $data['days'] = $days;
            $data['year'] = $year;
            $data['month'] = $month;
            $data['current_day'] = $current_day;
            $data['status'] = 'Present: P, Late: L, Absent: A, Holiday: H, Half Day: F';
            return ApiBaseMethod::sendResponse($data, null);
        }
        //Test
        //return view('backEnd.studentPanel.student_attendance', compact('attendances', 'days', 'year', 'month', 'current_day'));
    }
}
