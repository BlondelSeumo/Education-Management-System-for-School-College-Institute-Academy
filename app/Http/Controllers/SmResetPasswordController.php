<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class SmResetPasswordController extends Controller
{
    public function __construct(){
        $this->middleware('PM');
    }
    
    public function resetStudentPassword(Request $request){
    	if($request->new_password == ""){
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('New Password and id field are required');
            }
    		return redirect('student-login-report')->with('message-dander', 'New Password field is required');
    	}else{
    		$password = Hash::make($request->new_password);
    		$user = User::find($request->id);
    		$user->password = $password;
    		$result = $user->save();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($result) {
                    return ApiBaseMethod::sendResponse(null, 'Password reset has been successfully');
                } else {
                    return ApiBaseMethod::sendError('Something went wrong, please try again');
                }
            } else {
                if ($result) {
                    return redirect('student-login-report')->with('message-success', 'Password reset has been successfully');
                } else {
                    return redirect('student-login-report')->with('message-danger', 'Something went wrong, please try again');
                }
            }
    	}
    } 
}
