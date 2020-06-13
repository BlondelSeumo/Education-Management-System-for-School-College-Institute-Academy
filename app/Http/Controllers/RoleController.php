<?php

namespace App\Http\Controllers;

use Auth;
use App\Role;
use Validator;
use App\tableList;
use App\ApiBaseMethod;
use App\SmModulePermission;
use Illuminate\Http\Request;
use App\SmModulePermissionAssign;
use Brian2694\Toastr\Facades\Toastr;

class RoleController extends Controller
{
    public function __construct()
    {
        $roles = Role::all();
        // $roles->truncate();
    }

    public function index(Request $request)
    {
        $roles = Role::where('active_status', '=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 9)->orderBy('id', 'desc')->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($roles, null);
        }
        return view('backEnd.systemSettings.role.role', compact('roles'));
    }


    public function store(Request $request)
    {
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
        $role = new Role();
        $role->name = $request->name;
        $role->type = 'User Defined';
        $result = $role->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Role has been created successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }
    public function edit(Request $request, $id)
    {
        $role = Role::find($id);
        $roles = Role::where('active_status', '=', 1)->orderBy('id', 'desc')->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['role'] = $role;
            $data['roles'] = $roles->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.systemSettings.role.role', compact('role', 'roles'));
    }
    public function update(Request $request)
    {
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

        $role = Role::find($request->id);
        $role->name = $request->name;
        $result = $role->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Role has been updated successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }
    public function delete(Request $request)
    {


        $id = 'role_id';

        $tables = tableList::getTableList($id);

        try {
            $delete_query = Role::destroy($request->id);
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($delete_query) {
                    return ApiBaseMethod::sendResponse(null, 'Role has been deleted successfully');
                } else {
                    return ApiBaseMethod::sendError('Something went wrong, please try again.');
                }
            } else {
                if ($delete_query) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect()->back();
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';

            return redirect()->back()->with('message-danger-delete', $msg);
        } catch (\Exception $e) {
            //dd($e->getMessage(), $e->errorInfo);
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }










        // $role = Role::destroy($request->id);

        // if (ApiBaseMethod::checkUrl($request->fullUrl())) {
        //     if ($role) {
        //         return ApiBaseMethod::sendResponse(null, 'Role has been deleted successfully');
        //     } else {
        //         return ApiBaseMethod::sendError('Something went wrong, please try again');
        //     }
        // } else {
        //     if ($role) {
        //         return redirect()->back()->with('message-success-delete', 'Role has been deleted successfully');
        //     } else {
        //         return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        //     }
        // }
    }

    public function modulePermission()
    {
        $roles = Role::all();
        return view('backEnd.systemSettings.modulePermission', compact('roles'));
    }

    public function assignModulePermission($id)
    {

        $role = Role::find($id);
        if ($id == 2) {
            $modules = SmModulePermission::where('dashboard_id', 2)->where('id', '!=', 22)->get();
        } elseif ($id == 3) {
            $modules = SmModulePermission::where('dashboard_id', 3)->where('id', '!=', 36)->get();
        } elseif ($id == 1) {
            $modules = SmModulePermission::where('id', '!=', 18)->where('id', '!=', 1)->where('dashboard_id', 1)->get();
        } else {
            $modules = SmModulePermission::where('dashboard_id', 1)->where('id', '!=', 1)->get();
        }


        $modules = $modules->groupBy('dashboard_id');


        $already_assigned = SmModulePermissionAssign::select('module_id')->where('role_id', $id)->get();
        $already_assigned_ids = [];
        foreach ($already_assigned as $value) {
            $already_assigned_ids[] = $value->module_id;
        }



        return view('backEnd.systemSettings.assignModulePermission', compact('role', 'modules', 'already_assigned_ids'));
    }

    public function assignModulePermissionStore(Request $request)
    {

        SmModulePermissionAssign::where('role_id', $request->role_id)->delete();

        if (isset($request->permissions)) {
            foreach ($request->permissions as $permission) {
                $role_permission = new SmModulePermissionAssign();
                $role_permission->role_id = $request->role_id;
                $role_permission->module_id = $permission;
                $role_permission->save();
            }
        }
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse(null, 'Module permission has been assigned successfully');
        }
        Toastr::success('Operation successful', 'Success');
        return redirect('module-permission');
    }
}
