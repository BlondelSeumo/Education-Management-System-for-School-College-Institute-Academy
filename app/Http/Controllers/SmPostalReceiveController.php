<?php

namespace App\Http\Controllers;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\SmPostalReceive;
use App\ApiBaseMethod;
use Validator;

class SmPostalReceiveController extends Controller
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
        $postal_receives = SmPostalReceive::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($postal_receives->toArray(), 'Postal retrieved successfully.');
        }
        return view('backEnd.admin.postal_receive', compact('postal_receives'));
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
            'from_title' => "required"
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
            $file->move('public/uploads/postal/', $fileName);
            $fileName =  'public/uploads/postal/' . $fileName;
        }


        $postal_receive = new SmPostalReceive();
        $postal_receive->from_title = $request->from_title;
        $postal_receive->reference_no = $request->reference_no;
        $postal_receive->address = $request->address;
        $postal_receive->date = date('Y-m-d', strtotime($request->date));
        $postal_receive->note = $request->note;
        $postal_receive->to_title = $request->to_title;
        $postal_receive->file = $fileName;
        $result = $postal_receive->save();


        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Postal has been created successfully.');
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
        $postal_receives = SmPostalReceive::all();
        $postal_receive = SmPostalReceive::find($id);

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['postal_receives'] = $postal_receives->toArray();
            $data['postal_receive'] = $postal_receive->toArray();

            return ApiBaseMethod::sendResponse($data, 'Postal retrieved successfully.');
        }
        return view('backEnd.admin.postal_receive', compact('postal_receives', 'postal_receive'));
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
            'from_title' => "required"
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
            $postal_receive = SmPostalReceive::find($request->id);
            if ($postal_receive->file != "") {
                if (file_exists($postal_receive->file)) {
                    unlink($postal_receive->file);
                }
            }

            $file = $request->file('file');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/postal/', $fileName);
            $fileName =  'public/uploads/postal/' . $fileName;
        }


        $postal_receive = SmPostalReceive::find($request->id);
        $postal_receive->from_title = $request->from_title;
        $postal_receive->reference_no = $request->reference_no;
        $postal_receive->address = $request->address;
        $postal_receive->date = date('Y-m-d', strtotime($request->date));
        $postal_receive->note = $request->note;
        $postal_receive->to_title = $request->to_title;
        if ($fileName != "") {
            $postal_receive->file = $fileName;
        }
        $result = $postal_receive->save();



        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Postal has been updated successfully.');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($result) {
                Toastr::success('Operation successful', 'Success');

                return redirect('postal-receive');
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
        $postal_receive = SmPostalReceive::find($id);
        if ($postal_receive->file != "") {
            if (file_exists($postal_receive->file)) {
                unlink($postal_receive->file);
            }
        }
        $result = $postal_receive->delete();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Postal has been deleted successfully.');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($result) {
                Toastr::success('Operation successful', 'Success');

                return redirect('postal-receive');
            } else {
                Toastr::error('Operation Failed', 'Failed');

                return redirect()->back();
            }
        }
    }
}
