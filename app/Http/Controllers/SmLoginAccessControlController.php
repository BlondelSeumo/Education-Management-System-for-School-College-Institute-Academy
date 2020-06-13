<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\SmClass;
use App\SmStudent;
use App\SmStaff;
use App\SmParent;
use App\User;

class SmLoginAccessControlController extends Controller
{
    public function loginAccessControl(){
    	$roles = Role::all();
        $classes = SmClass::all();

        return view('backEnd.systemSettings.login_access_control', compact('roles', 'classes'));
    }

    public function searchUser(Request $request){

    	if($request->role == ""){
    		$request->validate([
    			'role' => 'required'
    		]);
    	}elseif($request->role == "2"){
    		$request->validate([
    			'role' => 'required',
    			'class' => 'required',
    		]);
    	}

    	$role = $request->role;
    	$roles = Role::all();
        $classes = SmClass::all();

    	if($request->role == "2"){


    		$students = SmStudent::query();
	        $students->where('active_status', 1);
	        if($request->class != ""){
	            $students->where('class_id', $request->class);
	        }
	         if($request->section != ""){
	            $students->where('section_id', $request->section);
	        }
	        $students = $students->get();

    		return view('backEnd.systemSettings.login_access_control', compact('students', 'role', 'roles', 'classes'));

    	}elseif($request->role == "3"){
    		$parents = SmParent::where('active_status', 1)->get();
    		return view('backEnd.systemSettings.login_access_control', compact('parents', 'role', 'roles', 'classes'));
    	}else{
    		$staffs = SmStaff::where('active_status', 1)->where('role_id', $request->role)->get();
    		return view('backEnd.systemSettings.login_access_control', compact('staffs', 'role', 'roles', 'classes'));
    	}



        return view('backEnd.systemSettings.login_access_control', compact('roles', 'classes'));
    }

    public function loginAccessPermission(Request $request){
    	if($request->status == 'on'){
    		$status = 1;
    	}else{
    		$status = 0;
    	}

    	
    	$user = User::find($request->id);
    	$user->access_status = $status;
    	$user->save();

    	return response()->json($request->id);
    }
}
