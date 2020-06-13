<?php

namespace App\Http\Controllers;

use Validator;
use App\SmEvent;
use App\ApiBaseMethod;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SmEventController extends Controller
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
        $events = SmEvent::all();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($events, null);
        }

        return view('backEnd.events.eventsList', compact('events'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'event_title' => "required",
            'from_date' => "required",
            'to_date' => "required",
            'event_des' => "required",
            'event_location' => 'required'
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
        if ($request->file('upload_file_name') != "") {
            $file = $request->file('upload_file_name');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/events/', $fileName);
            $fileName = 'public/uploads/events/' . $fileName;
        }
        $user = Auth()->user();

        if ($user) {
            $login_id = $user->id;
        } else {
            $login_id = $request->login_id;
        }

        $events = new SmEvent();
        $events->event_title = $request->event_title;
        $events->event_des = $request->event_des;
        $events->event_location = $request->event_location;
        $events->from_date = date('Y-m-d', strtotime($request->from_date));
        $events->to_date = date('Y-m-d', strtotime($request->to_date));
        $events->created_by = $login_id;
        $events->uplad_image_file = $fileName;
        $results = $events->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($results) {
                return ApiBaseMethod::sendResponse(null, 'New Event has been added successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $editData = SmEvent::find($id);
        $events = SmEvent::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['editData'] = $editData->toArray();
            $data['events'] = $events->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.events.eventsList', compact('editData', 'events'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'event_title' => "required",
            'from_date' => "required",
            'to_date' => "required",
            'event_des' => "required",
            'event_location' => "required"

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
        if ($request->file('upload_file_name') != "") {
            $eventFile = SmEvent::find($id);
            if ($eventFile->uplad_image_file != "") {
                unlink($eventFile->uplad_image_file);
            }


            $file = $request->file('upload_file_name');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/events/', $fileName);
            $fileName = 'public/uploads/events/' . $fileName;
        }

        $user = Auth()->user();

        if ($user) {
            $login_id = $user->id;
        } else {
            $login_id = $request->login_id;
        }

        $events = SmEvent::find($id);
        $events->event_title = $request->event_title;
        $events->event_des = $request->event_des;
        $events->event_location = $request->event_location;
        $events->from_date = date('Y-m-d', strtotime($request->from_date));
        $events->to_date = date('Y-m-d', strtotime($request->to_date));
        $events->updated_by = $login_id;
        $events->uplad_image_file = $fileName;
        $results = $events->update();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($results) {
                return ApiBaseMethod::sendResponse(null, 'Event has been updated successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($results) {
                Toastr::success('Operation successful', 'Success');
                return redirect('event');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleteEventView(Request $request, $id)
    {
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            return ApiBaseMethod::sendResponse($id, null);
        }
        return view('backEnd.events.deleteEventView', compact('id'));
    }

    public function deleteEvent(Request $request, $id)
    {
        $result = SmEvent::destroy($id);

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Event has been deleted successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect('event');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }
}
