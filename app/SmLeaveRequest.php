<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class SmLeaveRequest extends Model
{
    public function leaveType()
	{
	  return $this->belongsTo('App\SmLeaveType', 'type_id');
	}

	public function leaveDefine()
	{
	  return $this->belongsTo('App\SmLeaveDefine', 'leave_define_id', 'id');
	}

	public function staffs()
	{
	  return $this->belongsTo('App\SmStaff', 'staff_id', 'user_id');
	}

	public static function approvedLeave($type_id){
		$user = Auth::user();
		$leaves = SmLeaveRequest::where('role_id', $user->role_id)->where('staff_id', $user->id)->where('leave_define_id', $type_id)->where('approve_status', "A")->get();
		$approved_days = 0;
		foreach($leaves as $leave){
			$start = strtotime($leave->leave_from);
            $end = strtotime($leave->leave_to);

            $days_between = ceil(abs($end - $start) / 86400);
            $days = $days_between + 1;
            $approved_days += $days;
		}
		return $approved_days;
	}

	public static function approvedLeaveModal($type_id, $role_id, $staff_id){
		$leaves = SmLeaveRequest::where('role_id', $role_id)->where('staff_id', $staff_id)->where('leave_define_id', $type_id)->where('approve_status', "A")->get();
		$approved_days = 0;
		foreach($leaves as $leave){
			$start = strtotime($leave->leave_from);
            $end = strtotime($leave->leave_to);

            $days_between = ceil(abs($end - $start) / 86400);
            $days = $days_between + 1;
            $approved_days += $days;
		}
		return $approved_days;
	}
}
