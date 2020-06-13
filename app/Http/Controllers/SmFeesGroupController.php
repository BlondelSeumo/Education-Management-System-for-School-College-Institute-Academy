<?php

namespace App\Http\Controllers;

use Validator;
use App\SmFeesGroup;
use App\ApiBaseMethod;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SmFeesGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }

    public function index(Request $request)
    {
        $fees_groups = SmFeesGroup::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($fees_groups, null);
        }

        return view('backEnd.feesCollection.fees_group', compact('fees_groups'));
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => "required|unique:sm_fees_groups"
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $visitor = new SmFeesGroup();
        $visitor->name = $request->name;
        $visitor->description = $request->description;
        $result = $visitor->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Fees Group has been created successfully.');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
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
        $fees_group = SmFeesGroup::find($id);
        $fees_groups = SmFeesGroup::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['fees_group'] = $fees_group->toArray();
            $data['fees_groups'] = $fees_groups->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.feesCollection.fees_group', compact('fees_group', 'fees_groups'));
    }
    public function update(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => "required|unique:sm_fees_groups,name," . $request->id,

        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $visitor = SmFeesGroup::find($request->id);
        $visitor->name = $request->name;
        $visitor->description = $request->description;
        $result = $visitor->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Fees Group has been updated successfully.');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect('fees-group');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }

    public function deleteGroup(Request $request)
    {
        $fees_group = SmFeesGroup::destroy($request->id);

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($fees_group) {
                return ApiBaseMethod::sendResponse(null, 'Fees Group has been deleted successfully.');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($fees_group) {
                Toastr::success('Operation successful', 'Success');
                return redirect('fees-group');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect('fees-group');
            }
        }
    }
}
