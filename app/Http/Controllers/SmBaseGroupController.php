<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmBaseGroup;
use App\tableList;

use Validator;
class SmBaseGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }
    
    public function index(Request $request){
    	$base_groups = SmBaseGroup::where('active_status', '=', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($base_groups, null);
        }
    	return view('backEnd.systemSettings.baseSetup.base_group', compact('base_groups'));
    }
    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
    		'name' => "required"
    	]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    	$base_group = new SmBaseGroup();
    	$base_group->name = $request->name;
    	$result = $base_group->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Base Group has been created successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($result) {
                return redirect()->back()->with('message-success', 'Base Group has been created successfully');
            } else {
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }
    public function edit(Request $request,$id){
    	$base_group = SmBaseGroup::find($id);
    	$base_groups = SmBaseGroup::where('active_status', '=', 1)->orderBy('id', 'desc')->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['base_group'] = $base_group;
            $data['base_groups'] = $base_groups->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
     	return view('backEnd.systemSettings.baseSetup.base_group', compact('base_group', 'base_groups'));
    }
    
    public function update(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
    		'name' => "required"
    	]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


    	$base_group = SmBaseGroup::find($request->id);
    	$base_group->name = $request->name;
    	$result = $base_group->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Base Group has been updated successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($result) {
                return redirect()->back()->with('message-success', 'Base Group has been updated successfully');
            } else {
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }
    public function delete(Request $request,$id){


        $id='base_group_id';

        $tables=tableList::getTableList($id);
        
        try {
            $delete_query = SmBaseGroup::destroy($request->id);
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                if($result){
                    return ApiBaseMethod::sendResponse(null, 'Base group has been deleted successfully');
                }else{
                    return ApiBaseMethod::sendError('Something went wrong, please try again.');
                }
            }else{               
                if($delete_query){
                    return redirect()->back()->with('message-success-delete', 'Class has been deleted successfully');
                }else{
                    return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
                }
            }
            
        } catch (\Illuminate\Database\QueryException $e) {
            $msg='This data already used in  : '.$tables.' Please remove those data first';
        
            return redirect()->back()->with('message-danger-delete', $msg);
        } catch (\Exception $e) {
                    //dd($e->getMessage(), $e->errorInfo);
            return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        }









    	// $base_group = SmBaseGroup::destroy($id);

        // if (ApiBaseMethod::checkUrl($request->fullUrl())) {
        //     if ($base_group) {
        //         return ApiBaseMethod::sendResponse(null, 'Base Group has been deleted successfully');
        //     } else {
        //         return ApiBaseMethod::sendError('Something went wrong, please try again');
        //     }
        // } else {
        //     if ($base_group) {
        //         return redirect()->back()->with('message-success-delete', 'Base Group has been deleted successfully');
        //     } else {
        //         return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        //     }
        // }
    }
}
