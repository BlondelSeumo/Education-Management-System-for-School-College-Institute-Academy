<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmFeesAssign extends Model
{
    public function feesGroupMaster(){
    	return $this->belongsTo('App\SmFeesMaster', 'fees_master_id', 'id');
    }

    public function feesPayments(){
    	return $this->hasMany('App\SmFeesPayment', 'id', 'fees_type_id');
    }

    public static function discountSum($student_id, $type_id, $perpose){
    	$sum = SmFeesPayment::where('student_id', $student_id)->where('fees_type_id', $type_id)->sum($perpose);
    	return $sum;
    }

    public static function createdBy($student_id, $discount_id){
    	$created_by = SmFeesPayment::where('student_id', $student_id)->where('fees_discount_id', $discount_id)->first();
    	return $created_by;
    }

    public static function feesPayment($type_id, $student_id){
    	$payments = SmFeesPayment::where('fees_type_id', $type_id)->where('student_id', $student_id)->get();
    	return $payments;
    }

    public function studentInfo(){
        return $this->belongsTo('App\SmStudent', 'student_id', 'id');
    }
}
