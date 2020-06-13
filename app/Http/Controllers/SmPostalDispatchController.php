<?php

namespace App\Http\Controllers;

use Validator;
use App\ApiBaseMethod;
use App\SmPostalDispatch;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;


class SmPostalDispatchController extends Controller
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
        $postal_dispatchs = SmPostalDispatch::all();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($postal_dispatchs->toArray(), 'Postal dispatchs retrieved successfully.');
        }
        return view('backEnd.admin.postal_dispatch', compact('postal_dispatchs'));
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
            'to_title' => "required"
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
            $fileName = 'dis-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/postal/', $fileName);
            $fileName =  'public/uploads/postal/' . $fileName;
        }


        $postal_dispatch = new SmPostalDispatch();
        $postal_dispatch->from_title = $request->from_title;
        $postal_dispatch->reference_no = $request->reference_no;
        $postal_dispatch->address = $request->address;
        $postal_dispatch->date = date('Y-m-d', strtotime($request->date));
        $postal_dispatch->note = $request->note;
        $postal_dispatch->to_title = $request->to_title;
        $postal_dispatch->file = $fileName;
        $result = $postal_dispatch->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Postal dispatch has been created successfully.');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $postal_dispatchs = SmPostalDispatch::all();
        $postal_dispatch = SmPostalDispatch::find($id);

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['postal_dispatchs'] = $postal_dispatchs->toArray();
            $data['postal_dispatch'] = $postal_dispatch->toArray();

            return ApiBaseMethod::sendResponse($data, 'Postal retrieved successfully.');
        }
        return view('backEnd.admin.postal_dispatch', compact('postal_dispatchs', 'postal_dispatch'));
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
    public function update(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'to_title' => "required"
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
            $postal_dispatch = SmPostalDispatch::find($request->id);
            if ($postal_dispatch->file != "") {
                if (file_exists($postal_dispatch->file)) {
                    unlink($postal_dispatch->file);
                }
            }

            $file = $request->file('file');
            $fileName = 'dis' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/postal/', $fileName);
            $fileName =  'public/uploads/postal/' . $fileName;
        }


        $postal_dispatch = SmPostalDispatch::find($request->id);
        $postal_dispatch->from_title = $request->from_title;
        $postal_dispatch->reference_no = $request->reference_no;
        $postal_dispatch->address = $request->address;
        $postal_dispatch->date = date('Y-m-d', strtotime($request->date));
        $postal_dispatch->note = $request->note;
        $postal_dispatch->to_title = $request->to_title;
        if ($fileName != "") {
            $postal_dispatch->file = $fileName;
        }
        $result = $postal_dispatch->save();


        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Postal has been updated successfully.');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect('postal-dispatch');
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
        $postal_dispatch = SmPostalDispatch::find($id);
        if ($postal_dispatch->file != "") {
            if (file_exists($postal_dispatch->file)) {
                unlink($postal_dispatch->file);
            }
        }
        $result = $postal_dispatch->delete();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Postal dispatch has been deleted successfully.');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect('postal-dispatch');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }
}
