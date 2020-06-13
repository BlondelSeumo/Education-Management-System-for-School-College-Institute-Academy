<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\Role;
use App\SmModuleLink;
use App\SmModule;
use App\SmRolePermission;

class SmRolePermissionController extends Controller
{
    public function __construct(){
        $this->middleware('PM');
    }
    
    public function assignPermission(Request $request,$id){

    	$role = Role::find($id);
    	$modulesRole = SmModule::where('active_status', 1)->get();
    	$role_permissions = SmRolePermission::where('role_id', $id)->get();
    	$already_assigned = [];
    	foreach($role_permissions as $role_permission){
    		$already_assigned[] = $role_permission->module_link_id;
    	}

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['role'] = $role;
            $data['modules'] = $modulesRole->toArray();
            $data['already_assigned'] = $already_assigned;
            return ApiBaseMethod::sendResponse($data, null);
        }
    	return view('backEnd.systemSettings.role.assign_role_permission', compact('role', 'modulesRole', 'already_assigned'));
    }
    public function rolePermissionStore(Request $request){

    	SmRolePermission::where('role_id', $request->role_id)->delete();

    	if(isset($request->permissions)){
	    	foreach($request->permissions as $permission){
	    		$role_permission = new SmRolePermission();
	    		$role_permission->role_id = $request->role_id;
	    		$role_permission->module_link_id = $permission;
	    		$role_permission->save();
	    	}
	    }
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse(null, 'Role permission has been assigned successfully');
        }
    	return redirect('role')->with('message-success-delete', 'Role permission has been assigned successfully');
    }
}
