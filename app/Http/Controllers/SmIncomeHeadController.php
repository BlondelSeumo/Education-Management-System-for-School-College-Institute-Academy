<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SmIncomeHead;

class SmIncomeHeadController extends Controller
{
    public function __construct(){
        $this->middleware('PM');
    }
    
    public function index(){
    	$income_heads = SmIncomeHead::all();
    	return view('backEnd.accounts.income_head', compact('income_heads'));

    }
    public function store(Request $request){
    	$request->validate([
    		'income_head' => "required|unique:sm_income_heads,name",
    	]);

    	$income_head = new SmIncomeHead();
    	$income_head->name = $request->income_head;
    	$income_head->description = $request->description;
    	$result = $income_head->save();
    	if($result){
			return redirect()->back()->with('message-success', 'Income Head has been created successfully');
		}else{
			return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
		}
    }

    public function edit($id){
    	$income_head = SmIncomeHead::find($id);
    	$income_heads = SmIncomeHead::all();
     	return view('backEnd.accounts.income_head', compact('income_head', 'income_heads'));
    }
    public function update(Request $request){
    	$request->validate([
    		'income_head' => "required|unique:sm_income_heads,name,".$request->id,
    	]);

    	$fees_discount = SmIncomeHead::find($request->id);
    	$fees_discount->name = $request->income_head;
    	$fees_discount->description = $request->description;
    	$result = $fees_discount->save();
    	if($result){
			return redirect('income-head')->with('message-success', 'Income Head has been updated successfully');
		}else{
			return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
		}
    }
    public function delete($id){
    	$fees_discount = SmIncomeHead::destroy($id);
    	if($fees_discount){
    		return redirect()->back()->with('message-success-delete', 'Income Head has been deleted successfully');
    	}else{
    		return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
    	}
    }
}
