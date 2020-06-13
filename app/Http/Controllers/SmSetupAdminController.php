<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmSetupAdmin;
use Validator;
use App\tableList;
use Brian2694\Toastr\Facades\Toastr;
class SmSetupAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admin_setups = SmSetupAdmin::where('active_status', '=', 1)->get();
        $admin_setups = $admin_setups->groupBy('type');

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['admin_setups'] = $admin_setups->toArray();
            $data['admin_setups'] = $admin_setups->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.admin.setup_admin', compact('admin_setups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'type' => 'required',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $setup = new SmSetupAdmin();
        $setup->type = $request->type;
        $setup->name = $request->name;
        $setup->description = $request->description;
        $result = $setup->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Admin  Setup has been created successfully');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $admin_setup = SmSetupAdmin::find($id);
        $admin_setups = SmSetupAdmin::where('active_status', '=', 1)->get();
        $admin_setups = $admin_setups->groupBy('type');

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['admin_setup'] = $admin_setup->toArray();
            $data['admin_setups'] = $admin_setups->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.admin.setup_admin', compact('admin_setups', 'admin_setup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'type' => 'required',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $setup = SmSetupAdmin::find($id);
        $setup->type = $request->type;
        $setup->name = $request->name;
        $setup->description = $request->description;
        $result = $setup->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Admin Setup has been updated successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect('setup-admin');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        // $id_key='class_id';

        // $tables=tableList::getTableList($id_key);

        // try {
        //     $delete_query = SmSetupAdmin::destroy($request->id);
        //     if(ApiBaseMethod::checkUrl($request->fullUrl())){
        //         if($delete_query){
        //             return ApiBaseMethod::sendResponse(null, 'Class has been deleted successfully');
        //         }else{
        //             return ApiBaseMethod::sendError('Something went wrong, please try again.');
        //         }
        //     }else{               
        //         if($delete_query){
        //             return redirect()->back()->with('message-success-delete', 'Class has been deleted successfully');
        //         }else{
        //             return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        //         }
        //     }

        // } catch (\Illuminate\Database\QueryException $e) {
        //     $msg='This data already used in  : '.$tables.' Please remove those data first';

        //     return redirect()->back()->with('message-danger-delete', $msg);
        // } catch (\Exception $e) {
        //             //dd($e->getMessage(), $e->errorInfo);
        //     return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        // }









        $result = SmSetupAdmin::destroy($id);

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Admin Setup has been deleted successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect('setup-admin');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }
}
