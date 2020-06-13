<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Auth;
use App\User;
use Redirect;
use Validator;
use App\SmClass;
use App\SmStudent;
use App\SmAddIncome;
use App\SmFeesGroup;
use App\SmAddExpense;
use App\SmFeesAssign;
use App\SmFeesMaster;
use App\ApiBaseMethod;
use App\SmFeesPayment;
use App\SmGeneralSettings;
use App\SmFeesCarryForward;
use Illuminate\Http\Request;
use App\SmFeesAssignDiscount;
use Brian2694\Toastr\Facades\Toastr;

class SmFeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }

    public function feesForward(Request $request)
    {
        $classes = SmClass::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($classes, null);
        }
        return view('backEnd.feesCollection.fees_forward', compact('classes'));
    }

    public function feesForwardSearch(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'class' => 'required',
            'section' => 'required'
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $classes = SmClass::where('active_status', 1)->get();
        $students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->get();


        if ($students->count() != 0) {
            foreach ($students as $student) {
                $fees_balance = SmFeesCarryForward::where('student_id', $student->id)->count();
            }

            $class_id = $request->class;

            if ($fees_balance == 0) {

                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    $data = [];
                    $data['classes'] = $classes->toArray();
                    $data['students'] = $students->toArray();
                    $data['class_id'] = $class_id;
                    return ApiBaseMethod::sendResponse($data, null);
                }
                return view('backEnd.feesCollection.fees_forward', compact('classes', 'students', 'class_id'));
            } else {
                $update = "";

                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    $data = [];
                    $data['classes'] = $classes->toArray();
                    $data['students'] = $students->toArray();
                    $data['class_id'] = $class_id;
                    $data['update'] = $update;
                    return ApiBaseMethod::sendResponse($data, null);
                }
                return view('backEnd.feesCollection.fees_forward', compact('classes', 'students', 'update', 'class_id'));
            }
        } else {

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('No result Found');
            }
            Toastr::error('Operation Failed', 'Failed');
            return redirect('fees-forward');
        }
    }

    public function feesForwardStore(Request $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->id as $student) {

                if ($request->update == 1) {

                    $fees_forward = SmFeesCarryForward::find($student);
                    $fees_forward->balance = $request->balance[$student];
                    $fees_forward->save();
                } else {
                    $fees_forward = new SmFeesCarryForward();
                    $fees_forward->student_id = $student;
                    $fees_forward->balance = $request->balance[$student];
                    $fees_forward->save();
                }
            }
            DB::commit();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendResponse(null, 'Fees has been forwarded successfully');
            }
            Toastr::success('Operation successful', 'Success');
            return redirect('fees-forward');
        } catch (\Exception $e) {
            DB::rollback();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function collectFees(Request $request)
    {
        $classes = SmClass::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            return ApiBaseMethod::sendResponse($classes, null);
        }
        return view('backEnd.feesCollection.collect_fees', compact('classes'));
    }
    public function collectFeesSearch(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'class' => 'required'
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $students = SmStudent::query();
        $students->where('class_id', $request->class);
        if ($request->section != "") {
            $students->where('section_id', $request->section);
        }
        if ($request->keyword != "") {
            $students->where('full_name', 'like', '%' . $request->keyword . '%')->orWhere('admission_no', $request->keyword)->orWhere('roll_no', $request->keyword)->orWhere('national_id_no', $request->keyword)->orWhere('local_id_no', $request->keyword);
        }
        $students = $students->get();

        if ($students->isEmpty()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('No result found');
            }

            return redirect('collect-fees')->with('message-danger', 'No result found');
        }

        $classes = SmClass::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['classes'] = $classes->toArray();
            $data['students'] = $students->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.feesCollection.collect_fees', compact('classes', 'students'));
    }



    public function collectFeesStudent(Request $request, $id)
    {

        $student = SmStudent::find($id);
        $fees_assigneds = SmFeesAssign::where('student_id', $id)->orderBy('id', 'desc')->get();

        $fees_assigneds2 = DB::table('sm_fees_assigns')
            ->select('sm_fees_types.id as fees_type_id', 'sm_fees_types.name', 'sm_fees_masters.date as due_date', 'sm_fees_masters.amount as amount')
            ->join('sm_fees_masters', 'sm_fees_masters.id', '=', 'sm_fees_assigns.fees_master_id')
            ->join('sm_fees_types', 'sm_fees_types.id', '=', 'sm_fees_masters.fees_type_id')
            ->join('sm_fees_payments', 'sm_fees_payments.fees_type_id', '=', 'sm_fees_masters.fees_type_id')
            ->where('sm_fees_assigns.student_id', $id)->get();
        $i = 0;
        foreach ($fees_assigneds2 as $row) {
            $d[$i]['fees_name'] = $row->name;
            $d[$i]['due_date'] = $row->due_date;
            $d[$i]['amount'] = $row->amount;
            $d[$i]['paid'] = DB::table('sm_fees_payments')->where('fees_type_id', $row->fees_type_id)->sum('amount');
            $d[$i]['fine'] = DB::table('sm_fees_payments')->where('fees_type_id', $row->fees_type_id)->sum('fine');
            $d[$i]['discount_amount'] = DB::table('sm_fees_payments')->where('fees_type_id', $row->fees_type_id)->sum('discount_amount');
            $d[$i]['balance'] = ((float) $d[$i]['amount'] + (float) $d[$i]['fine'])  - ((float) $d[$i]['paid'] + (float) $d[$i]['discount_amount']);
            $i++;
        }

        //, DB::raw("SUM(sm_fees_payments.amount) as total_paid where sm_fees_payments.fees_type_id==")
        $fees_discounts = SmFeesAssignDiscount::where('student_id', $id)->get();

        $applied_discount = [];
        foreach ($fees_discounts as $fees_discount) {
            $fees_payment = SmFeesPayment::select('fees_discount_id')->where('fees_discount_id', $fees_discount->id)->first();
            if (isset($fees_payment->fees_discount_id)) {
                $applied_discount[] = $fees_payment->fees_discount_id;
            }
        }

        //dd($fees_discounts);


        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            // $data['student'] = $student;  
            $data['fees'] = $d;
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.feesCollection.collect_fees_student_wise', compact('student', 'fees_assigneds', 'fees_discounts', 'applied_discount'));
    }
    public function collectFeesStudentApi(Request $request, $id)
    {

        $student = SmStudent::where('user_id', $id)->first();
        $fees_assigneds = SmFeesAssign::where('student_id', $id)->orderBy('id', 'desc')->get();

        $fees_assigneds2 = DB::table('sm_fees_assigns')
            ->select('sm_fees_types.id as fees_type_id', 'sm_fees_types.name', 'sm_fees_masters.date as due_date', 'sm_fees_masters.amount as amount')
            ->join('sm_fees_masters', 'sm_fees_masters.id', '=', 'sm_fees_assigns.fees_master_id')
            ->join('sm_fees_types', 'sm_fees_types.id', '=', 'sm_fees_masters.fees_type_id')
            // ->join('sm_fees_payments', 'sm_fees_payments.fees_type_id', '=', 'sm_fees_masters.fees_type_id')
            ->where('sm_fees_assigns.student_id', $student->id)
            ->get();
        $i = 0;
        //dd($fees_assigneds2);
        foreach ($fees_assigneds2 as $row) {
            $d[$i]['fees_name'] = $row->name;
            $d[$i]['due_date'] = $row->due_date;
            $d[$i]['amount'] = $row->amount;
            $d[$i]['paid'] = DB::table('sm_fees_payments')->where('fees_type_id', $row->fees_type_id)->where('student_id', $student->id)->sum('amount');
            $d[$i]['fine'] = DB::table('sm_fees_payments')->where('fees_type_id', $row->fees_type_id)->where('student_id', $student->id)->sum('fine');
            $d[$i]['discount_amount'] = DB::table('sm_fees_payments')->where('fees_type_id', $row->fees_type_id)->where('student_id', $student->id)->sum('discount_amount');
            $d[$i]['balance'] = ((float) $d[$i]['amount'] + (float) $d[$i]['fine'])  - ((float) $d[$i]['paid'] + (float) $d[$i]['discount_amount']);
            $i++;
        }

        //, DB::raw("SUM(sm_fees_payments.amount) as total_paid where sm_fees_payments.fees_type_id==")
        $fees_discounts = SmFeesAssignDiscount::where('student_id', $id)->get();

        $applied_discount = [];
        foreach ($fees_discounts as $fees_discount) {
            $fees_payment = SmFeesPayment::select('fees_discount_id')->where('fees_discount_id', $fees_discount->id)->first();
            if (isset($fees_payment->fees_discount_id)) {
                $applied_discount[] = $fees_payment->fees_discount_id;
            }
        }

        //dd($fees_discounts);
        $currency_symbol = SmGeneralSettings::select('currency_symbol')->first();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            // $data['student'] = $student;  
            $data['fees'] = $d;
            $data['currency_symbol'] = $currency_symbol;
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.feesCollection.collect_fees_student_wise', compact('student', 'fees_assigneds', 'fees_discounts', 'applied_discount'));
    }

    public function feesGenerateModal(Request $request, $amount, $student_id, $type)
    {

        $amount = $amount;
        $fees_type_id = $type;
        $student_id = $student_id;
        $discounts = SmFeesAssignDiscount::where('student_id', $student_id)->get();

        $applied_discount = [];
        foreach ($discounts as $fees_discount) {
            $fees_payment = SmFeesPayment::select('fees_discount_id')->where('fees_discount_id', $fees_discount->id)->first();
            if (isset($fees_payment->fees_discount_id)) {
                $applied_discount[] = $fees_payment->fees_discount_id;
            }
        }


        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['amount'] = $amount;
            $data['discounts'] = $discounts;
            $data['fees_type_id'] = $fees_type_id;
            $data['student_id'] = $student_id;
            $data['applied_discount'] = $applied_discount;
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.feesCollection.fees_generate_modal', compact('amount', 'discounts', 'fees_type_id', 'student_id', 'applied_discount'));
    }

    public function feesPaymentStore(Request $request)
    {

        $discount_group = explode('-', $request->discount_group);


        $user = Auth::user();
        $fees_payment = new SmFeesPayment();
        $fees_payment->student_id = $request->student_id;
        $fees_payment->fees_type_id = $request->fees_type_id;
        if ($discount_group[0] != "") {
            $fees_payment->fees_discount_id = $discount_group[0];
        }
        if (isset($discount_group[1])) {
            $fees_payment->discount_month = $discount_group[1];
        }
        $fees_payment->discount_amount = !empty($request->discount_amount) ? $request->discount_amount : 0;
        $fees_payment->fine = !empty($request->fine) ? $request->fine : 0;
        $fees_payment->amount = !empty($request->amount) ? $request->amount : 0;
        $fees_payment->payment_date = date('Y-m-d', strtotime($request->date));
        $fees_payment->payment_mode = $request->payment_mode;
        $fees_payment->created_by = $user->id;
        $result = $fees_payment->save();

        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return Redirect::route('fees_collect_student_wise', array('id' => $request->student_id));
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return Redirect::route('fees_collect_student_wise', array('id' => $request->student_id));
        }
    }


    public function feesPaymentDelete(Request $request)
    {
        $result = SmFeesPayment::destroy($request->id);

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Fees payment has been deleted  successfully');
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

    public function searchFeesPayment(Request $request)
    {
        $fees_payments = SmFeesPayment::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($fees_payments, null);
        }
        return view('backEnd.feesCollection.search_fees_payment', compact('fees_payments'));
    }

    public function feesPaymentSearch(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'payment_id' => 'required'
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $payment = explode('/', $request->payment_id);

        if (!isset($payment[1])) {
            $payment[1] = 0;
        }

        $fees_payments = SmFeesPayment::where('id', $payment[0])->where('created_by', $payment[1])->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($fees_payments, null);
        }

        return view('backEnd.feesCollection.search_fees_payment', compact('fees_payments'));
    }

    public function searchFeesDue(Request $request)
    {
        $classes = SmClass::where('active_status', 1)->get();
        $fees_masters = SmFeesMaster::select('fees_group_id')->where('active_status', 1)->distinct('fees_group_id')->get();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['classes'] = $classes->toArray();
            $data['fees_masters'] = $fees_masters->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.feesCollection.search_fees_due', compact('classes', 'fees_masters'));
    }

    public function feesDueSearch(Request $request)
    {

        $input = $request->all();
        $validator = Validator::make($input, [
            'fees_group' => 'required',
            'class' => 'required',
            'section' => 'required',
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $fees_group = explode('-', $request->fees_group);

        // $fees_master = SmFeesMaster::select('id', 'amount')->where('fees_group_id', $fees_group[0])->where('fees_type_id', $fees_group[1])->first();

        $fees_master = SmFeesMaster::select('id', 'amount')->where('fees_group_id', $fees_group[0])->where('fees_type_id', $fees_group[1])->first();


        if ($fees_group[0] != 1 && $fees_group[0] != 2) {
            $students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->get();
        } else {
            if ($fees_group[0] == 1) {
                $students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->where('route_list_id', '!=', '')->get();
            } else {
                $students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->where('room_id', '!=', '')->get();
            }
        }

        $fees_dues = [];


        foreach ($students as $student) {

            if ($fees_group[0] != 1 && $fees_group[0] != 2) {
                $fees_master = SmFeesMaster::select('id', 'amount')->where('fees_group_id', $fees_group[0])->where('fees_type_id', $fees_group[1])->first();
                $total_amount = $fees_master->amount;
            } else {
                if ($fees_group[0] == 1) {
                    $total_amount = $student->route->far;
                } else {
                    $total_amount = $student->room->cost_per_bed;
                }
            }


            $fees_assign = SmFeesAssign::where('student_id', $student->id)->where('fees_master_id', $fees_master->id)->first();
            $discount_amount = SmFeesPayment::where('student_id', $student->id)->where('fees_type_id', $fees_group[1])->sum('discount_amount');
            $amount = SmFeesPayment::where('student_id', $student->id)->where('fees_type_id', $fees_group[1])->sum('amount');

            $paid = $discount_amount + $amount;

            if ($fees_assign != "") {
                if ($total_amount > $paid) {
                    $fees_dues[] = $fees_assign;
                }
            }
        }


        $classes = SmClass::where('active_status', 1)->get();
        $fees_masters = SmFeesMaster::select('fees_group_id')->where('active_status', 1)->distinct('fees_group_id')->get();

        $class_id = $request->class;
        $fees_group_id = $fees_group[1];

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['classes'] = $classes->toArray();
            $data['fees_masters'] = $fees_masters;
            $data['fees_dues'] = $fees_dues;
            $data['class_id'] = $class_id;
            $data['fees_group_id'] = $fees_group_id;
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.feesCollection.search_fees_due', compact('classes', 'fees_masters', 'fees_dues', 'class_id', 'fees_group_id'));
    }

    public function feesStatemnt(Request $request)
    {
        $classes = SmClass::where('active_status', 1)->get();
        $fees_masters = SmFeesMaster::select('fees_group_id')->where('active_status', 1)->distinct('fees_group_id')->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['classes'] = $classes->toArray();
            $data['fees_masters'] = $fees_masters->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.feesCollection.fees_statment', compact('classes', 'fees_masters'));
    }

    public function feesStatementSearch(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'student' => 'required',
            'class' => 'required',
            'section' => 'required',
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $classes = SmClass::where('active_status', 1)->get();
        $fees_masters = SmFeesMaster::select('fees_group_id')->where('active_status', 1)->distinct('fees_group_id')->get();
        $student = SmStudent::find($request->student);
        $fees_assigneds = SmFeesAssign::where('student_id', $request->student)->get();
        $fees_discounts = SmFeesAssignDiscount::where('student_id', $request->student)->get();

        $applied_discount = [];
        foreach ($fees_discounts as $fees_discount) {
            $fees_payment = SmFeesPayment::select('fees_discount_id')->where('fees_discount_id', $fees_discount->id)->first();
            if (isset($fees_payment->fees_discount_id)) {
                $applied_discount[] = $fees_payment->fees_discount_id;
            }
        }

        $class_id = $request->class;

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['classes'] = $classes->toArray();
            $data['fees_masters'] = $fees_masters->toArray();
            $data['fees_assigneds'] = $fees_assigneds->toArray();
            $data['fees_discounts'] = $fees_discounts->toArray();
            $data['applied_discount'] = $applied_discount;
            $data['student'] = $student;
            $data['class_id'] = $class_id;
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.feesCollection.fees_statment', compact('classes', 'fees_masters', 'fees_assigneds', 'fees_discounts', 'applied_discount', 'student', 'class_id'));
    }

    public function balanceFeesReport(Request $request)
    {
        $classes = SmClass::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($classes, null);
        }
        return view('backEnd.feesCollection.balance_fees_report', compact('classes'));
    }

    public function balanceFeesSearch(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'class' => 'required',
            'section' => 'required'
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->get();
        $balance_students = [];

        $fees_masters = SmFeesMaster::where('active_status', 1)->get();

        foreach ($students as $student) {
            $total_balance = 0;
            $total_discount = 0;
            $total_amount = 0;
            foreach ($fees_masters as $fees_master) {
                $fees_assign = SmFeesAssign::where('student_id', $student->id)->where('fees_master_id', $fees_master->id)->first();
                if ($fees_assign != "") {
                    $discount_amount = SmFeesPayment::where('student_id', $student->id)->where('fees_type_id', $fees_master->fees_type_id)->sum('discount_amount');


                    // if($fees_master->fees_group_id != 1 && $fees_master->fees_group_id != 2){
                    $balance = SmFeesPayment::where('student_id', $student->id)->where('fees_type_id', $fees_master->fees_type_id)->sum('amount');
                    // }else{
                    //     if($fees_master->fees_group_id != 1){
                    //         $balance = $student->route->far;
                    //     }else{
                    //         $balance =  $student->room->cost_per_bed;
                    //     }
                    // } 



                    $total_balance += $balance;
                    $total_discount += $discount_amount;
                    if ($fees_master->fees_group_id != 1 && $fees_master->fees_group_id != 2) {
                        $total_amount += $fees_master->amount;
                    } else {
                        if ($fees_master->fees_group_id != 1) {
                            $total_amount += $student->route->far;
                        } else {
                            $total_amount +=  $student->room->cost_per_bed;
                        }
                    }
                }
            }
            $total_paid = $total_balance + $total_discount;
            if ($total_amount > $total_paid) {
                $balance_students[] = $student;
            }
        }


        $class_id = $request->class;



        $classes = SmClass::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['classes'] = $classes->toArray();
            $data['balance_students'] = $balance_students;
            $data['class_id'] = $class_id;
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.feesCollection.balance_fees_report', compact('classes', 'balance_students', 'class_id'));
    }

    public function feesInvoice($sid, $pid, $faid)
    {
        return view('backEnd.feesCollection.fees_collect_invoice');
    }

    public function feesGroupPrint($id)
    {
        $fees_assigned = SmFeesAssign::find($id);
        $student = SmStudent::find($fees_assigned->student_id);
        $pdf = PDF::loadView('backEnd.feesCollection.fees_group_print', ['fees_assigned' => $fees_assigned, 'student' => $student]);

        return $pdf->stream(date('d-m-Y') . '-' . $student->full_name . '-fees-group-details.pdf');
    }

    public function feesPaymentPrint($id, $group)
    {
        $payment = SmFeesPayment::find($id);
        $group = $group;


        $student = SmStudent::find($payment->student_id);
        $pdf = PDF::loadView('backEnd.feesCollection.fees_payment_print', ['payment' => $payment, 'group' => $group, 'student'=>$student]);
    
        return $pdf->stream(date('d-m-Y') . '-' . $student->full_name . '-fees-payment-details.pdf');
    }
    public function feesGroupsPrint($id, $s_id)
    {
        $groups = explode("-", $id);
        $student = SmStudent::find($s_id);
        foreach ($groups as $group) {
            $fees_assigneds[] = SmFeesAssign::find($group);
        }
        $pdf = PDF::loadView('backEnd.feesCollection.fees_groups_print', ['fees_assigneds' => $fees_assigneds, 'student' => $student]);
        return $pdf->stream(date('d-m-Y') . '-' . $student->full_name . '-fees-groups-details.pdf');
    }

    public function transactionReport(Request $request)
    {
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse(null, null);
        }

        return view('backEnd.feesCollection.transaction_report');
    }

    public function transactionReportSearch(Request $request)
    {


        $date_from = date('Y-m-d', strtotime($request->date_from));
        $date_to = date('Y-m-d', strtotime($request->date_to));

        $fees_payments = SmFeesPayment::where('payment_date', '>=', $date_from)->where('payment_date', '<=', $date_to)->get();
        $fees_payments = $fees_payments->groupBy('student_id');

        $add_incomes = SmAddIncome::where('date', '>=', $date_from)->where('date', '<=', $date_to)->where('active_status', 1)->get();
        $add_expenses = SmAddExpense::where('date', '>=', $date_from)->where('date', '<=', $date_to)->where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['fees_payments'] = $fees_payments->toArray();
            $data['add_incomes'] = $add_incomes->toArray();
            $data['add_expenses'] = $add_expenses->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.feesCollection.transaction_report', compact('fees_payments', 'add_incomes', 'add_expenses'));
    }

    public function studentFineReport(Request $request)
    {
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse(null, null);
        }
        return view('backEnd.reports.student_fine_report');
    }

    public function studentFineReportSearch(Request $request)
    {
        $date_from = date('Y-m-d', strtotime($request->date_from));
        $date_to = date('Y-m-d', strtotime($request->date_to));

        $fees_payments = SmFeesPayment::where('payment_date', '>=', $date_from)->where('payment_date', '<=', $date_to)->where('fine', '!=', 0)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            return ApiBaseMethod::sendResponse($fees_payments, null);
        }

        return view('backEnd.reports.student_fine_report', compact('fees_payments'));
    }
}
