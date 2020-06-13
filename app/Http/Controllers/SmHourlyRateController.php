<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SmHourlyRate;

class SmHourlyRateController extends Controller
{
    public function __construct(){
        $this->middleware('PM');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hourly_rates = SmHourlyRate::all();
        return view('backEnd.humanResource.hourly_rate', compact('hourly_rates'));
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
        $request->validate([
            'grade' => "required",
            'rate' => "required"
        ]);

        $hourly_rate = new SmHourlyRate();
        $hourly_rate->grade = $request->grade;
        $hourly_rate->rate = $request->rate;
        $result = $hourly_rate->save();
        if($result){
            return redirect()->back()->with('message-success', 'Rate has been created successfully');
        }else{
            return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
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
        $hourly_rate = SmHourlyRate::find($id);
        $hourly_rates = SmHourlyRate::all();
        return view('backEnd.humanResource.hourly_rate', compact('hourly_rates', 'hourly_rate'));
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
        $request->validate([
            'grade' => "required",
            'rate' => "required"
        ]);

        $hourly_rate = SmHourlyRate::find($request->id);
        $hourly_rate->grade = $request->grade;
        $hourly_rate->rate = $request->rate;
        $result = $hourly_rate->save();
        if($result){
            return redirect('hourly-rate')->with('message-success', 'Rate has been updated successfully');
        }else{
            return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
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
        $hourly_rate = SmHourlyRate::destroy($id);
        if($hourly_rate){
            return redirect('hourly-rate')->with('message-success-delete', 'Rate has been deleted successfully');
        }else{
            return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        }
    }
}
