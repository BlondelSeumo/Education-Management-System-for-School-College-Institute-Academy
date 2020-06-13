<?php

namespace App\Http\Controllers;
use App\SmChartOfAccount;

use Illuminate\Http\Request;

class SmChartOfAccountController extends Controller
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
    public function index()
    {
        $chart_of_accounts = SmChartOfAccount::all();
        return view('backEnd.accounts.chart_of_account', compact('chart_of_accounts'));
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
            'head' => "required|unique:sm_chart_of_accounts,head",
            'type' => "required",
        ]);


        $chart_of_account = new SmChartOfAccount();
        $chart_of_account->head = $request->head;
        $chart_of_account->type = $request->type;
        $result = $chart_of_account->save();
        if($result){
            return redirect()->back()->with('message-success', 'A/C Head has been created successfully');
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
        $chart_of_account = SmChartOfAccount::find($id);
        $chart_of_accounts = SmChartOfAccount::all();
        return view('backEnd.accounts.chart_of_account', compact('chart_of_account', 'chart_of_accounts'));
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
            'head' => "required|unique:sm_chart_of_accounts,head,".$request->id,
            'type' => "required",
        ]);


        $chart_of_account = SmChartOfAccount::find($request->id);
        $chart_of_account->head = $request->head;
        $chart_of_account->type = $request->type;
        $result = $chart_of_account->save();
        if($result){
            return redirect('chart-of-account')->with('message-success', 'A/C Head has been updated successfully');
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
        $chart_of_account = SmChartOfAccount::destroy($id);
        if($chart_of_account){
            return redirect('chart-of-account')->with('message-success-delete', 'A/C Head has been deleted successfully');
        }else{
            return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        }
    }
}
