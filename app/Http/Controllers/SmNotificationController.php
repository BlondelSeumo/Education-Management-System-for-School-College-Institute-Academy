<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SmNotification;

class SmNotificationController extends Controller
{
    public function __construct(){
        $this->middleware('PM');
    }
    
    public function viewSingleNotification($id){
    	$notification = SmNotification::find($id);
    	$notification->is_read = 1;
    	$notification->save();

    	return redirect()->back();
    }

    public function viewAllNotification($id){

    	$user = Auth()->user();
    	if(Auth()->user()->role_id != 1){
    		if($user->role_id == 2){
	    		SmNotification::where('user_id', $user->student->id)->where('role_id', 2)->update(['is_read' => 1]);
	    	}else{
	    		SmNotification::where('user_id', $user->staff->id)->where('role_id', '!=', 2)->update(['is_read' => 1]);
	    	}
    	}
    	
    	return redirect()->back();
    }

    public function viewNotice($id){

    }
}
