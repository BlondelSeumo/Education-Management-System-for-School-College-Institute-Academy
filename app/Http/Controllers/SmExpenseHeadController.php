<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SmExpenseHead;

class SmExpenseHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expense_heads = SmExpenseHead::all();
        return view('backEnd.accounts.expense_head', compact('expense_heads'));
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
            'name' => "required|unique:sm_expense_heads,name",
        ]);


        $expense_head = new SmExpenseHead();
        $expense_head->name = $request->name;
        $expense_head->description = $request->description;
        $result = $expense_head->save();
        if($result){
            return redirect()->back()->with('message-success', 'Expense Head has been created successfully');
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
        $expense_head = SmExpenseHead::find($id);
        $expense_heads = SmExpenseHead::all();
        return view('backEnd.accounts.expense_head', compact('expense_heads', 'expense_head'));
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
            'name' => "required|unique:sm_expense_heads,name,".$request->id,
        ]);


        $expense_head = SmExpenseHead::find($request->id);
        $expense_head->name = $request->name;
        $expense_head->description = $request->description;
        $result = $expense_head->save();
        if($result){
            return redirect('expense-head')->with('message-success', 'Expense Head has been updated successfully');
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
        $expense_head = SmExpenseHead::destroy($id);
        if($expense_head){
            return redirect('expense-head')->with('message-success-delete', 'Expense Head has been deleted successfully');
        }else{
            return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        }
    }
}
