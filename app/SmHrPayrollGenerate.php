<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmHrPayrollGenerate extends Model
{
    public function staffs(){
		return $this->belongsTo('App\SmStaff', 'staff_id', 'id');
	}

	public static function getPayrollDetails($staff_id, $payroll_month, $payroll_year){

	 $getPayrollDetails = SmHrPayrollGenerate::select('id','payroll_status')
						 ->where('staff_id', $staff_id)
						 ->where('payroll_month', $payroll_month)
						 ->where('payroll_year', $payroll_year)
						 ->first();

	 if(isset($getPayrollDetails)){
        return $getPayrollDetails;
	 }
	 else{
	 	return false;
	 }

    }

	public function staffDetails(){
		return $this->belongsTo('App\SmStaff', 'staff_id', 'id');
	}

	public static function getPaymentMode($id){
		$getPayrollDetails = SmPaymentMethhod::select('method')
							 ->where('id', $id)
							 ->first();
		if(isset($getPayrollDetails)){
			return $getPayrollDetails->method;
		}
		else{
			return false;
		}
	}

	public function paymentMethods(){
		return $this->belongsTo('App\SmPaymentMethhod', 'payment_mode', 'id');
	}

}
