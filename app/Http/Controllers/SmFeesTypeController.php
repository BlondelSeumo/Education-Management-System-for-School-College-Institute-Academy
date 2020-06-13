<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmFeesType;
use Validator;
use App\tableList;

class SmFeesTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }

    public function index(Request $request)
    {
        $fees_types = SmFeesType::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($fees_types, null);
        }

        return view('backEnd.feesCollection.fees_type', compact('fees_types'));
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => "required|unique:sm_fees_types",
            'code' => "required|unique:sm_fees_types"
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $fees_type = new SmFeesType();
        $fees_type->name = $request->name;
        $fees_type->code = $request->code;
        $fees_type->description = $request->description;
        $result = $fees_type->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Fees type has been created successfully.');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($result) {
                return redirect()->back()->with('message-success', 'Fees type has been created successfully');
            } else {
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }

    public function edit(Request $request, $id)
    {
        $fees_type = SmFeesType::find($id);
        $fees_types = SmFeesType::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['fees_type'] = $fees_type->toArray();
            $data['fees_types'] = $fees_types->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.feesCollection.fees_type', compact('fees_type', 'fees_types'));
    }
    public function update(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' =>  'required|unique:sm_fees_types,name,' . $request->id,
            'code' => "required|unique:sm_fees_types,code," . $request->id
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $fees_type = SmFeesType::find($request->id);
        $fees_type->name = $request->name;
        $fees_type->code = $request->code;
        $fees_type->description = $request->description;
        $result = $fees_type->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Fees type has been updated successfully.');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($result) {
                return redirect('fees-type')->with('message-success', 'Fees type has been updated successfully');
            } else {
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }
    public function delete(Request $request, $id)
    {



        $id_key = 'fees_type_id';

        $tables = tableList::getTableList($id_key);

        try {
            $delete_query = SmFeesType::destroy($id);
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($delete_query) {
                    return ApiBaseMethod::sendResponse(null, 'Fees Type has been deleted successfully');
                } else {
                    return ApiBaseMethod::sendError('Something went wrong, please try again.');
                }
            } else {
                if ($delete_query) {
                    return redirect()->back()->with('message-success-delete', 'Fees Type has been deleted successfully');
                } else {
                    return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';

            return redirect()->back()->with('message-danger-delete', $msg);
        } catch (\Exception $e) {
            //dd($e->getMessage(), $e->errorInfo);
            return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        }







        // $fees_type = SmFeesType::destroy($id);

        // if(ApiBaseMethod::checkUrl($request->fullUrl())){
        //     if($fees_type){
        //         return ApiBaseMethod::sendResponse(null, 'Fees type has been deleted successfully.');
        //     }else{
        //         return ApiBaseMethod::sendError('Something went wrong, please try again.');
        //     }
        // }else{
        //     if($fees_type){
        //         return redirect()->back()->with('message-success-delete', 'Fees type has been deleted successfully');
        //     }else{
        //         return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        //     }
        // }
    }
}
