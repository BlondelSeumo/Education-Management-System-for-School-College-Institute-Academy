<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\SmRolePermission;
use App\SmUserLog;
use App\SmStudent;
use App\SmStaff;
use App\SmParent;
use App\SmToDo;
use App\SmNoticeBoard;
use App\SmHoliday;
use App\SmAddIncome;
use App\SmFeesPayment;
use App\SmItemSell;
use App\SmAddExpense;
use App\SmItemReceive;
use App\SmHrPayrollGenerate;
use Illuminate\Support\Facades\Hash;
use Session;

class LandingController extends Controller
{
    
    public function landing(){
        return view('frontEnd.landing.index');
    }

}
