<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmStaffAttendence extends Model
{
    public function StaffInfo(){
    	return $this->belongsTo('App\SmStaff', 'staff_id', 'id');
    }
}
