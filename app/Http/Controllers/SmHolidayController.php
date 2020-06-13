<?php

namespace App\Http\Controllers;

use Validator;
use App\SmHoliday;
use App\ApiBaseMethod;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SmHolidayController extends Controller
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
        $holidays = SmHoliday::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($holidays, null);
        }
        return view('backEnd.holidays.holidaysList', compact('holidays'));
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
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'holiday_title' => "required",
                'from_date' => 'required|before_or_equal:to_date',
                'to_date' => 'required',
                'user_id' => 'required',
                'details' => "required"
            ]);
        } else {
            $validator = Validator::make($input, [
                'holiday_title' => "required",
                'from_date' => 'required|before_or_equal:to_date',
                'to_date' => 'required',
                'details' => "required"
            ]);
        }

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $fileName = "";
        if ($request->file('upload_file_name') != "") {
            $file = $request->file('upload_file_name');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/holidays/', $fileName);
            $fileName =  'public/uploads/holidays/' . $fileName;
        }

        $user = Auth()->user();

        if ($user) {
            $user_id = $user->id;
        } else {
            $user_id = $request->user_id;
        }

        $holidays = new SmHoliday();
        $holidays->holiday_title = $request->holiday_title;
        $holidays->details = $request->details;
        $holidays->from_date = date('Y-m-d', strtotime($request->from_date));
        $holidays->to_date = date('Y-m-d', strtotime($request->to_date));
        $holidays->created_by = $user_id;
        $holidays->upload_image_file = $fileName;
        $results = $holidays->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($results) {
                return ApiBaseMethod::sendResponse(null, 'New Holiday has been added successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($results) {
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $editData = SmHoliday::find($id);
        $holidays = SmHoliday::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['editData'] = $editData->toArray();
            $data['holidays'] = $holidays->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.holidays.holidaysList', compact('editData', 'holidays'));
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
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'holiday_title' => "required",
                'from_date' => 'required|before_or_equal:to_date',
                'to_date' => 'required',
                'user_id' => 'required',
                'details' => "required"
            ]);
        } else {
            $validator = Validator::make($input, [
                'holiday_title' => "required",
                'from_date' => 'required|before_or_equal:to_date',
                'to_date' => 'required',
                'details' => "required"
            ]);
        }

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $fileName = "";
        if ($request->file('upload_file_name') != "") {
            $eventFile = SmHoliday::find($id);
            if ($eventFile->upload_image_file != "") {
                unlink($eventFile->upload_image_file);
            }

            $file = $request->file('upload_file_name');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/holidays/', $fileName);
            $fileName =  'public/uploads/holidays/' . $fileName;
        } else {
            $filesData = SmHoliday::find($id);
            $fileName = $filesData->upload_image_file;
        }

        $user = Auth()->user();

        if ($user) {
            $user_id = $user->id;
        } else {
            $user_id = $request->user_id;
        }
        $holidays = SmHoliday::find($id);
        $holidays->holiday_title = $request->holiday_title;
        $holidays->details = $request->details;
        $holidays->from_date = date('Y-m-d', strtotime($request->from_date));
        $holidays->to_date = date('Y-m-d', strtotime($request->to_date));
        $holidays->updated_by = $user_id;
        $holidays->upload_image_file = $fileName;
        $results = $holidays->update();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($results) {
                return ApiBaseMethod::sendResponse(null, 'Holiday has been updated successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($results) {
                Toastr::success('Operation successful', 'Success');
                return redirect('holiday');
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
    public function destroy($id)
    {
        //
    }

    public function deleteHolidayView(Request $request, $id)
    {

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($id, null);
        }
        return view('backEnd.holidays.deleteHolidayView', compact('id'));
    }

    public function deleteHoliday(Request $request, $id)
    {
        $holiday = SmHoliday::find($id);
        if ($holiday->upload_image_file != "") {
            unlink($holiday->upload_image_file);
        }
        $result = $holiday->delete();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Holiday has been deleted successfully.');
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
}
