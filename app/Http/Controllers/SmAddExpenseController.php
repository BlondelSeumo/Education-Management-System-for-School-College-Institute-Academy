<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmAddExpense;
use App\SmExpenseHead;
use App\SmBankAccount;
use App\SmPaymentMethhod;
use App\SmChartOfAccount;
use Validator;
use DB;

class SmAddExpenseController extends Controller
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
        $add_expenses = SmAddExpense::where('active_status', 1)->get();
        $expense_heads = SmChartOfAccount::where('type', "E")->where('active_status', 1)->get();
        $bank_accounts = SmbankAccount::where('active_status', '=', 1)->get();
        $payment_methods = SmPaymentMethhod::where('active_status', '=', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['add_expenses'] = $add_expenses->toArray();
            $data['expense_heads'] = $expense_heads->toArray();
            $data['bank_accounts'] = $bank_accounts->toArray();
            $data['payment_methods'] = $payment_methods->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.accounts.add_expense', compact('add_expenses', 'expense_heads', 'bank_accounts', 'payment_methods'));
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

        if ($request->payment_method == "3") {
            $validator = Validator::make($input, [
                'expense_head' => "required",
                'name' => "required",
                'date' => "required",
                'accounts' => "required",
                'payment_method' => "required",
                'amount' => "required"
            ]);
        } else {
            $validator = Validator::make($input, [
                'expense_head' => "required",
                'name' => "required",
                'date' => "required",
                'payment_method' => "required",
                'amount' => "required"
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
        if ($request->file('file') != "") {
            $file = $request->file('file');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/addExpense/', $fileName);
            $fileName =  'public/uploads/addExpense/' . $fileName;
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');


        $add_expense = new SmAddExpense();
        $add_expense->name = $request->name;
        $add_expense->expense_head_id = $request->expense_head;
        $add_expense->date = date('Y-m-d', strtotime($request->date));
        $add_expense->payment_method_id = $request->payment_method;
        if ($request->payment_method == "3") {
            $add_expense->account_id = $request->accounts;
        }
        $add_expense->amount = $request->amount;
        $add_expense->file = $fileName;
        $add_expense->description = $request->description;
        $result = $add_expense->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Expense has been created successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($result) {
                return redirect()->back()->with('message-success', 'Expense has been created successfully');
            } else {
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
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
        $add_expense = SmAddExpense::find($id);
        $add_expenses = SmAddExpense::where('active_status', '=', 1)->get();
        $expense_heads = SmChartOfAccount::where('active_status', '=', 1)->get();
        $bank_accounts = SmbankAccount::where('active_status', '=', 1)->get();
        $payment_methods = SmPaymentMethhod::where('active_status', '=', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['add_expenses'] = $add_expenses->toArray();
            $data['add_expense'] = $add_expense->toArray();
            $data['expense_heads'] = $expense_heads->toArray();
            $data['bank_accounts'] = $bank_accounts->toArray();
            $data['payment_methods'] = $payment_methods->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.accounts.add_expense', compact('add_expenses', 'add_expense', 'expense_heads', 'bank_accounts', 'payment_methods'));
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
        $input = $request->all();
        if ($request->payment_method == "3") {
            $validator = Validator::make($input, [
                'expense_head' => "required",
                'name' => "required",
                'date' => "required",
                'accounts' => "required",
                'payment_method' => "required",
                'amount' => "required"
            ]);
        } else {
            $validator = Validator::make($input, [
                'expense_head' => "required",
                'name' => "required",
                'date' => "required",
                'payment_method' => "required",
                'amount' => "required"
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
        if ($request->file('file') != "") {
            $add_expense = SmAddExpense::find($request->id);
            unlink($add_expense->file);

            $file = $request->file('file');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/addExpense/', $fileName);
            $fileName =  'public/uploads/addExpense/' . $fileName;
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');


        $add_expense = SmAddExpense::find($request->id);
        $add_expense->name = $request->name;
        $add_expense->expense_head_id = $request->expense_head;
        $add_expense->date = date('Y-m-d', strtotime($request->date));
        $add_expense->payment_method_id = $request->payment_method;
        if ($request->payment_method == "3") {
            $add_expense->account_id = $request->accounts;
        }
        $add_expense->amount = $request->amount;

        if ($fileName != "") {
            $add_expense->file = $fileName;
        }

        $add_expense->description = $request->description;
        $result = $add_expense->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Expense has been updated successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($result) {
                return redirect('add-expense')->with('message-success', 'Expense has been updated successfully');
            } else {
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
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
        $add_expense = SmAddExpense::find($id);
        if ($add_expense->file != "") {
            unlink($add_expense->file);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $result = $add_expense->delete();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Expense has been deleted successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($result) {
                return redirect('add-expense')->with('message-success-delete', 'Expense has been deleted successfully');
            } else {
                return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
            }
        }
    }
}
