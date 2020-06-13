<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmHrPayrollEarnDeduc extends Model
{
    public static function getTotalEarnings($payroll_generate_id){
    	 $totalEarnings = SmHrPayrollEarnDeduc::where('payroll_generate_id', $payroll_generate_id)
						 ->where('earn_dedc_type', 'E')
						 ->sum('amount');

		 if(isset($totalEarnings)){
	        return $totalEarnings;
		 }
		 else{
		 	return false;
		 }
    }

    public static function getTotalDeductions($payroll_generate_id){
    	 $totalDeductions = SmHrPayrollEarnDeduc::where('payroll_generate_id', $payroll_generate_id)
						 ->where('earn_dedc_type', 'D')
						 ->sum('amount');

		 if(isset($totalDeductions)){
	        return $totalDeductions;
		 }
		 else{
		 	return false;
		 }
    }
    
}
