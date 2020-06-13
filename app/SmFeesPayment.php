<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmFeesPayment extends Model
{
    public function studentInfo(){
    	return $this->belongsTo('App\SmStudent', 'student_id', 'id');
    }

    public function feesType(){
    	return $this->belongsTo('App\SmFeesType', 'fees_type_id', 'id');
    }

    public function feesMaster(){
    	return $this->belongsTo('App\SmFeesMaster', 'fees_type_id', 'fees_type_id');
    }

    public static function discountMonth($discount, $month){
    	return SmFeesPayment::where('fees_discount_id', $discount)->where('discount_month', $month)->first();
    }
}
