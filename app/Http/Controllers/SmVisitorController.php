<?php

namespace App\Http\Controllers;

use Validator;
use App\SmVisitor;
use App\ApiBaseMethod;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;


class SmVisitorController extends Controller
{

    public function __construct()
    {
        $this->middleware('PM');
    }

    public function index(Request $request)
    {
        $visitors = SmVisitor::all();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($visitors->toArray(), 'Visitors retrieved successfully.');
        }
        return view('backEnd.admin.visitor', compact('visitors'));
    }

    public function store(Request $request)
    {

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => "required",
            'phone' => "required",
            'purpose' => "required"
        ]);


        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $fileName = "";
        if ($request->file('file') != "") {
            $file = $request->file('file');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/visitor/', $fileName);
            $fileName =  'public/uploads/visitor/' . $fileName;
        }

        $date = strtotime($request->date);

        $newformat = date('Y-m-d', $date);

        $visitor = new SmVisitor();
        $visitor->name = $request->name;
        $visitor->phone = $request->phone;
        $visitor->visitor_id = $request->visitor_id;
        $visitor->no_of_person = $request->no_of_person;
        $visitor->purpose = $request->purpose;
        $visitor->date = $newformat;
        $visitor->in_time = $request->in_time;
        $visitor->out_time = $request->out_time;
        $visitor->file = $fileName;
        $result = $visitor->save();



        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {

                return ApiBaseMethod::sendResponse(null, 'Visitor has been created successfully.');
            }
            return ApiBaseMethod::sendError('Something went wrong, please try again.');
        } else {
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            }
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }



    public function edit(Request $request, $id)
    {
        $visitor = SmVisitor::find($id);
        $visitors = SmVisitor::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['visitor'] = $visitor->toArray();
            $data['visitors'] = $visitors->toArray();
            return ApiBaseMethod::sendResponse($data, 'Visitor retrieved successfully.');
        }
        return view('backEnd.admin.visitor', compact('visitor', 'visitors'));
    }



    public function update(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => "required",
            'phone' => "required",
            'purpose' => "required"
        ]);



        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $fileName = "";
        if ($request->file('file') != "") {
            $visitor = SmVisitor::find($request->id);
            if ($visitor->file != "") {
                $path = url('/') . '/public/uploads/visitor/' . $visitor->file;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $file = $request->file('file');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/visitor/', $fileName);
            $fileName =  'public/uploads/visitor/' . $fileName;
        }



        $time = strtotime($request->date);

        $newformat = date('Y-m-d', $time);

        $visitor = SmVisitor::find($request->id);
        $visitor->name = $request->name;
        $visitor->phone = $request->phone;
        $visitor->visitor_id = $request->visitor_id;
        $visitor->no_of_person = $request->no_of_person;
        $visitor->purpose = $request->purpose;
        $visitor->date = $newformat;
        $visitor->in_time = $request->in_time;
        $visitor->out_time = $request->out_time;
        if ($fileName != "") {
            $visitor->file = $fileName;
        }
        $result = $visitor->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Visitor has been updated successfully.');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect('visitor');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }
    public function delete(Request $request, $id)
    {
        $visitor = SmVisitor::find($id);
        if ($visitor->file != "") {
            $path = url('/') . '/public/uploads/visitor/' . $visitor->file;
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $result = $visitor->delete();


        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Visitor has been deleted successfully.');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect('visitor');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }
}
