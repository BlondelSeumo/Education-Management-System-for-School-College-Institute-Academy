<?php

namespace App\Http\Controllers\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\SmStudent;
use App\SmFeesAssign;
use App\SmFeesAssignDiscount;
use App\SmFeesPayment;

class SmFeesController extends Controller
{
    public function childrenFees($id){
    	
    	$student = SmStudent::where('id', $id)->first();

        $fees_assigneds = SmFeesAssign::where('student_id', $student->id)->get();
        $fees_discounts = SmFeesAssignDiscount::where('student_id', $student->id)->get();

        $applied_discount = [];
        foreach($fees_discounts as $fees_discount){
            $fees_payment = SmFeesPayment::select('fees_discount_id')->where('fees_discount_id', $fees_discount->id)->first();
            if(isset($fees_payment->fees_discount_id)){
                $applied_discount[] = $fees_payment->fees_discount_id;
            }
        }


        return view('backEnd.parentPanel.childrenFees', compact('student', 'fees_assigneds', 'fees_discounts', 'applied_discount'));
    }
}
