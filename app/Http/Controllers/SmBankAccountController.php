<?php

namespace App\Http\Controllers;

use App\SmBankAccount;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SmBankAccountController extends Controller
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
        $bank_accounts = SmbankAccount::all();
        return view('backEnd.accounts.bank_account', compact('bank_accounts'));
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
            'account_name' => "required|unique:sm_bank_accounts,account_name",
            'opening_balance' => "required"
        ]);


        $bank_account = new SmbankAccount();
        $bank_account->account_name = $request->account_name;
        $bank_account->opening_balance = $request->opening_balance;
        $bank_account->note = $request->note;
        $result = $bank_account->save();
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
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
        $bank_account = SmbankAccount::find($id);
        $bank_accounts = SmbankAccount::all();
        return view('backEnd.accounts.bank_account', compact('bank_accounts', 'bank_account'));
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
            'account_name' => "required|unique:sm_bank_accounts,account_name," . $request->id,
            'opening_balance' => "required"
        ]);


        $bank_account = SmbankAccount::find($request->id);
        $bank_account->account_name = $request->account_name;
        $bank_account->opening_balance = $request->opening_balance;
        $bank_account->note = $request->note;
        $result = $bank_account->save();
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect('bank-account');
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
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
        $bank_account = SmbankAccount::destroy($id);
        if ($bank_account) {
            Toastr::success('Operation successful', 'Success');
            return redirect('bank-account');
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}
