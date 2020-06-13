<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmAddIncome;
use App\SmIncomeHead;
use App\SmChartOfAccount;
use App\SmBankAccount;
use App\SmPaymentMethhod;
use Validator;
use DB;

class SmAddIncomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }


    public function index(Request $request){
    	$add_incomes = SmAddIncome::where('active_status', '=', 1)->get();
        $income_heads = SmChartOfAccount::where('type', "I")->where('active_status', '=', 1)->get();
        $bank_accounts = SmbankAccount::where('active_status', '=', 1)->get();
    	$payment_methods = SmPaymentMethhod::where('active_status', '=', 1)->get();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            $data=[];
            $data['add_incomes']= $add_incomes->toArray();
            $data['income_heads']= $income_heads->toArray();
            $data['bank_accounts']= $bank_accounts->toArray();
            $data['payment_methods']= $payment_methods->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }

    	return view('backEnd.accounts.add_income', compact('add_incomes', 'income_heads', 'bank_accounts', 'payment_methods'));

    }
    public function store(Request $request){
        $input = $request->all();
        if($request->payment_method == "3"){
            $validator = Validator::make($input, [
                'income_head' => "required|integer",
                'name' => "required",
                'date' => "required",
                'accounts' => "required|integer",
                'payment_method' => "required|integer",
                'amount' => "required|integer"
            ]);
        }else{
            $validator = Validator::make($input, [
                'income_head' => "required|integer",
                'name' => "required",
                'date' => "required",
                'payment_method' => "required|integer",
                'amount' => "required|integer"
            ]);
        }

        if($validator->fails()){
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

    	$fileName = ""; 
    	if($request->file('file') != ""){
    		$file = $request->file('file');
	        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
	        $file->move('public/uploads/add_income/', $fileName);
	        $fileName =  'public/uploads/add_income/'.$fileName;
    	}

    	$date = strtotime($request->date);

		$newformat = date('Y-m-d',$date);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');


    	$add_income = new SmAddIncome();
    	$add_income->name = $request->name;
    	$add_income->income_head_id = $request->income_head;
        $add_income->date = $newformat;
        $add_income->payment_method_id = $request->payment_method;
        if($request->payment_method == "3"){
        	$add_income->account_id = $request->accounts;
        }

    	$add_income->amount = $request->amount;
    	$add_income->file = $fileName;
    	$add_income->description = $request->description;
    	$result = $add_income->save();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($result){
                return ApiBaseMethod::sendResponse(null, 'Income has been created successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($result){
                return redirect()->back()->with('message-success', 'Income has been created successfully');
            }else{
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }

    public function edit(Request $request,$id){
    	$add_income = SmAddIncome::find($id);
    	$add_incomes = SmAddIncome::where('active_status', 1)->get();
    	$income_heads = SmChartOfAccount::where('active_status', '=', 1)->get();
        $bank_accounts = SmbankAccount::where('active_status', '=', 1)->get();
        $payment_methods = SmPaymentMethhod::where('active_status', '=', 1)->get();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            $data=[];
            $data['add_income']= $add_income->toArray();
            $data['add_incomes']= $add_incomes->toArray();
            $data['income_heads']= $income_heads->toArray();
            $data['bank_accounts']= $bank_accounts->toArray();
            $data['payment_methods']= $payment_methods->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
     	return view('backEnd.accounts.add_income', compact('add_income', 'add_incomes', 'income_heads', 'bank_accounts', 'payment_methods'));
    }

    
    public function update(Request $request){
        $input = $request->all();
    	if($request->payment_method == "3"){
            $validator = Validator::make($input, [
                'income_head' => "required",
                'name' => "required",
                'date' => "required",
                'accounts' => "required",
                'payment_method' => "required",
                'amount' => "required"
            ]);
        }else{
            $validator = Validator::make($input, [
                'income_head' => "required",
                'name' => "required",
                'date' => "required",
                'payment_method' => "required",
                'amount' => "required"
            ]);
        }

        if($validator->fails()){
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

    	$fileName = ""; 
    	if($request->file('file') != ""){

    		$add_income = SmAddIncome::find($request->id);
    		if($add_income->file != ""){
    			unlink($add_income->file);
    		}

    		$file = $request->file('file');
	        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
	        $file->move('public/uploads/add_income/', $fileName);
	        $fileName =  'public/uploads/add_income/'.$fileName;
    	}

    	$date = strtotime($request->date);

		$newformat = date('Y-m-d',$date);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    	$add_income = SmAddIncome::find($request->id);
    	$add_income->name = $request->name;
        $add_income->income_head_id = $request->income_head;
        $add_income->date = $newformat;
        $add_income->payment_method_id = $request->payment_method;
        if($request->payment_method == "3"){
            $add_income->account_id = $request->accounts;
        }
        $add_income->amount = $request->amount;
    	if($request->file('file') != ""){
    		$add_income->file = $fileName;
    	}
    	$add_income->description = $request->description;
    	$result = $add_income->save();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($result){
                return ApiBaseMethod::sendResponse(null, 'Income has been updated successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($result){
                return redirect('add-income')->with('message-success', 'Income has been updated successfully');
            }else{
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }
    public function delete(Request $request){
    	$add_income = SmAddIncome::find($request->id);
        if($add_income->file != ""){
            unlink($add_income->file);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $result = $add_income->delete();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($result){
                return ApiBaseMethod::sendResponse(null, 'Income has been deleted successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($result){
                return redirect()->back()->with('message-success-delete', 'Income has been deleted successfully');
            }else{
                return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
            }
        }
    }
}
