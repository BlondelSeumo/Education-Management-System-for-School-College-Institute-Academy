<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmLeaveType;
use Validator;

class SmLeaveTypeController extends Controller
{
    public function __construct(){
        $this->middleware('PM');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $leave_types = SmLeaveType::all();
        if(ApiBaseMethod::checkUrl($request->fullUrl())){

            return ApiBaseMethod::sendResponse($leave_types->toArray(), null);
        }
        return view('backEnd.humanResource.leave_type', compact('leave_types'));
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
            'type' => "required|unique:sm_leave_types",
            'total_days' => "required|numeric|min:0"
        ]);

        if($validator->fails()){
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $leave_type = new SmLeaveType();
        $leave_type->type = $request->type;
        $result = $leave_type->save();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($result){
                return ApiBaseMethod::sendResponse(null, 'Type has been created successfully');
            }
            return ApiBaseMethod::sendError('Something went wrong, please try again.');
        }else{
            if($result){
                return redirect()->back()->with('message-success', 'Type has been created successfully');
            }

            return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
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
        $leave_type = SmLeaveType::find($id);
        $leave_types = SmLeaveType::all();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            $data = [];
            $data['leave_type'] = $leave_type->toArray();
            $data['leave_types'] = $leave_types->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.humanResource.leave_type', compact('leave_types', 'leave_type'));
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
        if(ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'type' => "required|unique:sm_leave_types,type," . $request->id,
                'id'=>"required"
            ]);
        }
        else{
            $validator = Validator::make($input, [
                'type' => "required|unique:sm_leave_types,type," . $request->id
            ]);
        }

        if($validator->fails()){
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $leave_type = SmLeaveType::find($request->id);
        $leave_type->type = $request->type;
        $result = $leave_type->save();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($result){
                return ApiBaseMethod::sendResponse(null, 'Type has been updated successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($result){
                return redirect('leave-type')->with('message-success', 'Type has been updated successfully');
            }else{
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {




        $tables=\App\tableList::getTableList('type_id');
        try {
            $leave_type = SmLeaveType::destroy($id);

            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                if($leave_type){
                    return ApiBaseMethod::sendResponse(null, 'Type has been deleted successfully');
                }else{
                    return ApiBaseMethod::sendError('Something went wrong, please try again.');
                }
            }else{
                if($leave_type){
                    return redirect()->back()->with('message-success-delete', 'Type has been deleted successfully');
                }else{
                    return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {

            $msg='This data already used in  : '.$tables. ' Please remove those data first';
			return redirect()->back()->with('message-danger-delete', $msg);
        } catch (\Exception $e) {
        //dd($e->getMessage(), $e->errorInfo);
        return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        }
    }
}
