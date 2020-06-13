<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmStudent extends Model
{
    public function parents(){
        return $this->belongsTo('App\SmParent', 'parent_id', 'id');
    }
    public function drivers(){
        return $this->belongsTo('App\SmStaff', 'driver_id', 'id');
    }

	public function className(){
		return $this->belongsTo('App\SmClass', 'class_id', 'id');
	}

	public function gender(){
		return $this->belongsTo('App\SmBaseSetup', 'gender_id', 'id');
	}

	public function religion(){
		return $this->belongsTo('App\SmBaseSetup', 'religion_id', 'id');
	}

	public function bloodGroup(){
		return $this->belongsTo('App\SmBaseSetup', 'bloodgroup_id', 'id');
	}

	public function category(){
		return $this->belongsTo('App\SmStudentCategory', 'student_category_id', 'id');
	}

	public function session(){
		return $this->belongsTo('App\SmSession', 'session_id', 'id');
	}
    //student class name 
    public function class(){
        return $this->belongsTo('App\SmClass', 'class_id', 'id');
    }

	public function section(){
		return $this->belongsTo('App\SmSection', 'section_id', 'id');
	}
	public function route(){
		return $this->belongsTo('App\SmRoute', 'route_list_id', 'id');
	}

	public function vehicle(){
		return $this->belongsTo('App\SmVehicle', 'vechile_id', 'id');
	}

	public function dormitory(){
		return $this->belongsTo('App\SmDormitoryList', 'dormitory_id', 'id');
	}


	public function sections(){
		return $this->hasManyThrough('App\SmSection', 'App\SmClassSection', 'class_id', 'id', 'class_id', 'section_id');
	}

	public function rooms(){
		return $this->hasMany('App\SmRoomList', 'dormitory_id', 'dormitory_id');
	}

	public function room(){
		return $this->belongsTo('App\SmRoomList', 'room_id', 'id');
	}
	public function attendanceStudents(){
		return $this->belongsTo('App\SmStudentAttendance');
	}
	public function forwardBalance(){
    	return $this->belongsTo('App\SmFeesCarryForward', 'id', 'student_id');
    }

    public function feesAssign(){
    	return $this->hasMany('App\SmFeesAssign', 'student_id', 'id');
    }

    public static function totalFees($feesAssigns, $route_id, $room_id){
    	$amount = 0;
    	foreach($feesAssigns as $feesAssign){
    		$master = SmFeesMaster::select('fees_group_id', 'amount')->where('id', $feesAssign->fees_master_id)->first();
    		if($master->fees_group_id != 1 && $master->fees_group_id != 2){
    			$amount += $master->amount;
    		}else{
    			if($master->fees_group_id == 1){
    				$route = SmRoute::find($route_id);
    				$amount += $route->far;
    			}else{
    				$room = SmRoomList::find($room_id);
    				$amount += $room->cost_per_bed;
    			}
    		}
    		
    	}
    	return $amount;
    }

    public static function totalDeposit($feesAssigns, $student_id){
    	$amount = 0;
    	foreach($feesAssigns as $feesAssign){
    		$fees_type = SmFeesMaster::select('fees_type_id')->where('id', $feesAssign->fees_master_id)->first();
    		$amount += SmFeesPayment::where('fees_type_id', $fees_type->fees_type_id)->where('student_id', $student_id)->sum('amount');

    	}
    	return $amount;
    }
    public static function totalDiscount($feesAssigns, $student_id){
    	$amount = 0;
    	foreach($feesAssigns as $feesAssign){
    		$fees_type = SmFeesMaster::select('fees_type_id')->where('id', $feesAssign->fees_master_id)->first();
    		$amount += SmFeesPayment::where('fees_type_id', $fees_type->fees_type_id)->where('student_id', $student_id)->sum('discount_amount');

    	}
    	return $amount;
    }
    public static function totalFine($feesAssigns, $student_id){
    	$amount = 0;
    	foreach($feesAssigns as $feesAssign){
    		$fees_type = SmFeesMaster::select('fees_type_id')->where('id', $feesAssign->fees_master_id)->first();
    		$amount += SmFeesPayment::where('fees_type_id', $fees_type->fees_type_id)->where('student_id', $student_id)->sum('fine');

    	}
    	return $amount;
    }

    public function user(){
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public static function marks($exam_id, $s_id){
        $marks_register = SmMarksRegister::where('exam_id', $exam_id)->where('student_id', $s_id)->first();
        
        $marks_register_clilds = [];
        if($marks_register != ""){
            $marks_register_clilds = SmMarksRegisterChild::where('marks_register_id', $marks_register->id)->where('active_status', 1)->get();
        }
        return $marks_register_clilds;
    }

    public static function fullMarks($exam_id, $sb_id){
        $full_marks = SmExamScheduleSubject::where('exam_schedule_id', $exam_id)->where('subject_id', $sb_id)->first();
        return $full_marks;
    }

    public function promotion(){
        return $this->hasMany('App\SmStudentPromotion', 'student_id', 'id');
    }

    public static function classPromote($class){
        $class = SmClass::where('id', $class)->first();
        return $class->class_name;
    }

    public static function sessionPromote($session){
        $session = SmSession::where('id', $session)->first();
        return $session->session;
    }


    // public function evaluationHomework(){
    //     return $this->belongsTo('App\SmHomework', 'session_id', 'id');
    // }





}
