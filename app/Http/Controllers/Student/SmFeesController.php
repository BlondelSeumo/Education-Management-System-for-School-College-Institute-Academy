<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\SmStudent;
use App\SmFeesAssign;
use App\SmFeesAssignDiscount;
use App\SmFeesPayment;
use App\SmPaymentGatewaySetting;
use App\SmPaymentMethhod;


use App\Http\Requests;
use Paystack;
use Session;

class SmFeesController extends Controller
{
    public function studentFees(){
    	$id = Auth::user()->id;
    	$student = SmStudent::where('user_id', $id)->first();

        $payment_gateway = SmPaymentMethhod::where('active_status', 1)->first(); 

        $fees_assigneds = SmFeesAssign::where('student_id', $student->id)->get();
        $fees_discounts = SmFeesAssignDiscount::where('student_id', $student->id)->get();

        $applied_discount = [];
        foreach($fees_discounts as $fees_discount){
            $fees_payment = SmFeesPayment::select('fees_discount_id')->where('fees_discount_id', $fees_discount->id)->first();
            if(isset($fees_payment->fees_discount_id)){
                $applied_discount[] = $fees_payment->fees_discount_id;
            }
        }


        return view('backEnd.studentPanel.fees_pay', compact('student', 'fees_assigneds', 'fees_discounts', 'applied_discount', 'payment_gateway'));
    }



    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {
        Session::put('fees_type_id', $request->fees_type_id);
        Session::put('student_id', $request->student_id);
        Session::put('amount', $request->amount);
        Session::put('payment_mode', $request->payment_mode);
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        $user = Auth::User();
        // $student = SmStudent::where('user_id', $id)->first();


        $fees_payment = new SmFeesPayment();
        $fees_payment->student_id = Session::get('student_id');
        $fees_payment->fees_type_id = Session::get('fees_type_id');
        
        $fees_payment->discount_amount = 0;
        $fees_payment->fine = 0;
        $fees_payment->amount = Session::get('amount');
        $fees_payment->payment_date = date('Y-m-d',strtotime(date('Y-m-d')));
        $fees_payment->payment_mode = 'PS';
        $result = $fees_payment->save();

        if($result){
            if($user == 2){
                return redirect('student-fees')->with('message-success', 'Fees payment has been collected  successfully');
            }else{
                return redirect('parent-fees/'.Session::get('student_id'))->with('message-success', 'Fees payment has been collected  successfully');
            }
        }else{
            if($user == 2){
                return redirect('student-fees')->with('message-danger', 'Something went wrong, please try again');
            }else{
                return redirect('student-fees')->with('message-danger', 'Something went wrong, please try again');
            }
        }
        
    }
}
