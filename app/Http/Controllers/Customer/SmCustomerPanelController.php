<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SmStudent;
use App\SmFeesAssign;
use App\SmFeesAssignDiscount;
use App\SmStudentDocument;
use App\SmStudentTimeline;
use App\SmExamSchedule;
use App\SmExamScheduleSubject;
use App\SmClass;
use App\SmSection;
use App\SmClassRoutine;
use App\SmStudentAttendance;
use App\SmAssignSubject;
use App\SmAssignVehicle;
use App\SmVehicle;
use App\SmRoute;
use App\SmRoomList;
use App\SmRoomType;
use App\SmDormitoryList;
use App\SmMarksGrade;
use App\SmParent;
use App\SmHomework;
use App\SmNoticeBoard;
use App\SmWeekend;
use App\SmStaff;
use App\SmClassTime;
use Auth;
use Session;
use App\SmProductPurchase;
class SmCustomerPanelController extends Controller
{


    public function customerDashboard(){
    	$id = Auth::user()->id;


      

  $staffDetails = SmStaff::where('user_id',$id)->get();
        //dd($staffDetails);        

        return view('backEnd.customerPanel.customer_dashboard', compact('staffDetails'));
    } 

    public function customerPurchases(){
    	$id = Auth::user()->id;
    	$customerDetails = SmStaff::where('user_id',$id)->get();
    	$ProductPurchase = SmProductPurchase::where('user_id',$id)->get();
    	return view('backEnd.customerPanel.customer_purchase', compact('customerDetails','ProductPurchase'));
    } 



    
}
