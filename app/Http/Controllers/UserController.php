<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use Soumen\Agent\Agent;
use App\SmUserLog;


class UserController extends Controller
{
    public function __construct(){
        $this->middleware('PM');
    }
    
    public function index(){
    	return view('backEnd.systemSettings.user.user');
    }
    public function create(){
    	return view('backEnd.systemSettings.user.user_create');
    }
    public function userLog(Request $request){
    	$user_logs = SmUserLog::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            return ApiBaseMethod::sendResponse($user_logs, null);
        }
    	return view('backEnd.reports.user_log', compact('user_logs'));
    }
}
