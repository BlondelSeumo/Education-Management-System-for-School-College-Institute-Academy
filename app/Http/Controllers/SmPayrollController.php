<?php

namespace App\Http\Controllers;

use DB;
use App\Role;
use App\User;
use App\SmStaff;
use App\SmBaseSetup;
use App\SmLeaveRequest;
use App\SmPaymentMethhod;
use App\SmGeneralSettings;
use App\SmStaffAttendence;
use App\SmHrPayrollGenerate;
use Illuminate\Http\Request;
use App\SmHrPayrollEarnDeduc;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;

class SmPayrollController extends Controller
{
	public function __construct()
	{
		$this->middleware('PM');
	}

	public function index(Request $request)
	{
		$roles = Role::where('active_status', '=', '1')->where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 10)->get();

		return view('backEnd.humanResource.payroll.index', compact('roles'));
	}

	public function searchStaffPayr(Request $request)
	{

		$request->validate([
			'role_id' => "required",
			'payroll_month' => "required",
			'payroll_year' => "required"

		]);

		$role_id = $request->role_id;
		$payroll_month = $request->payroll_month;
		$payroll_year = $request->payroll_year;

		$staffs = SmStaff::where('active_status', '=', '1')->where('role_id', '=', $request->role_id)->get();

		$roles = Role::where('active_status', '=', '1')->where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->get();
		return view('backEnd.humanResource.payroll.index', compact('staffs', 'roles', 'payroll_month', 'payroll_year', 'role_id'));
	}


	public function generatePayroll(Request $request, $id, $payroll_month, $payroll_year)
	{

		$staffDetails = SmStaff::find($id);

		$month = date('m', strtotime($payroll_month));

		$attendances = SmStaffAttendence::where('staff_id', $id)->where('attendence_date', 'like', $payroll_year . '-' . $month . '%')->get();

		$p = 0;
		$l = 0;
		$a = 0;
		$f = 0;
		$h = 0;
		foreach ($attendances as $value) {
			if ($value->attendence_type == 'P') {
				$p++;
			} elseif ($value->attendence_type == 'L') {
				$l++;
			} elseif ($value->attendence_type == 'A') {
				$a++;
			} elseif ($value->attendence_type == 'F') {
				$f++;
			} elseif ($value->attendence_type == 'H') {
				$h++;
			}
		}

		$approve_leaves = SmLeaveRequest::where('approve_status', 'A')->where('staff_id', $id)->get();





		return view('backEnd.humanResource.payroll.generatePayroll', compact('staffDetails', 'payroll_month', 'payroll_year', 'p', 'l', 'a', 'f', 'h'));
	}

	public function savePayrollData(Request $request)
	{
		$request->validate([
			'net_salary' => "required"

		]);

		$payrollGenerate = new SmHrPayrollGenerate();
		$payrollGenerate->staff_id = $request->staff_id;
		$payrollGenerate->payroll_month = $request->payroll_month;
		$payrollGenerate->payroll_year = $request->payroll_year;
		$payrollGenerate->basic_salary = $request->basic_salary;
		$payrollGenerate->total_earning = $request->total_earning;
		$payrollGenerate->total_deduction = $request->total_deduction;
		$payrollGenerate->gross_salary = $request->final_gross_salary;
		$payrollGenerate->tax = $request->tax;
		$payrollGenerate->net_salary = $request->net_salary;
		$payrollGenerate->payroll_status = 'G';
		$payrollGenerate->created_by = Auth()->user()->id;
		$result = $payrollGenerate->save();
		$payrollGenerate->toArray();

		if ($result) {
			$earnings = count($request->earningsType);
			for ($i = 0; $i < $earnings; $i++) {
				if (!empty($request->earningsType[$i]) && !empty($request->earningsValue[$i])) {
					$payroll_earn_deducs = new SmHrPayrollEarnDeduc;
					$payroll_earn_deducs->payroll_generate_id = $payrollGenerate->id;
					$payroll_earn_deducs->type_name = $request->earningsType[$i];
					$payroll_earn_deducs->amount = $request->earningsValue[$i];
					$payroll_earn_deducs->earn_dedc_type = 'E';
					$payroll_earn_deducs->created_by = Auth()->user()->id;
					$result = $payroll_earn_deducs->save();
				}
			}

			$deductions = count($request->deductionstype);
			for ($i = 0; $i < $deductions; $i++) {
				if (!empty($request->deductionstype[$i]) && !empty($request->deductionsValue[$i])) {
					$payroll_earn_deducs = new SmHrPayrollEarnDeduc;
					$payroll_earn_deducs->payroll_generate_id = $payrollGenerate->id;
					$payroll_earn_deducs->type_name = $request->deductionstype[$i];
					$payroll_earn_deducs->amount = $request->deductionsValue[$i];
					$payroll_earn_deducs->earn_dedc_type = 'D';
					$payroll_earn_deducs->created_by = Auth()->user()->id;
					$result = $payroll_earn_deducs->save();
				}
			}
			Toastr::success('Operation successful', 'Success');
			return redirect('payroll');
		} else {
			Toastr::error('Operation Failed', 'Failed');
			return redirect()->back();
		}
	}

	public function paymentPayroll(Request $request, $id, $role_id)
	{
		$payrollDetails = SmHrPayrollGenerate::find($id);
		$paymentMethods = SmPaymentMethhod::where('id', '!=', '4')->where('id', '!=', '5')->where('id', '!=', '6')->get();
		return view('backEnd.humanResource.payroll.paymentPayroll', compact('payrollDetails', 'paymentMethods', 'role_id'));
	}

	public function savePayrollPaymentData(Request $request)
	{



		$payroll_month = $request->payroll_month;
		$payroll_year = $request->payroll_year;

		$payments = SmHrPayrollGenerate::find($request->payroll_generate_id);
		$payments->payment_date = date('Y-m-d', strtotime($request->payment_date));
		$payments->payment_mode = $request->payment_mode;
		$payments->note = $request->note;
		$payments->payroll_status = 'P';
		$payments->updated_by = Auth()->user()->id;
		$result = $payments->update();


		$staffs = SmStaff::where('active_status', '=', '1')->where('role_id', '=', $request->role_id)->get();

		$roles = Role::all();

		return view('backEnd.humanResource.payroll.index', compact('staffs', 'roles', 'payroll_month', 'payroll_year'));
	}

	public function viewPayslip($id)
	{
		$schoolDetails = SmGeneralSettings::find(1);
		$payrollDetails = SmHrPayrollGenerate::find($id);

		$payrollEarnDetails = SmHrPayrollEarnDeduc::where('active_status', '=', '1')->where('payroll_generate_id', '=', $id)->where('earn_dedc_type', '=', 'E')->get();

		$payrollDedcDetails = SmHrPayrollEarnDeduc::where('active_status', '=', '1')->where('payroll_generate_id', '=', $id)->where('earn_dedc_type', '=', 'D')->get();

		return view('backEnd.humanResource.payroll.viewPayslip', compact('payrollDetails', 'payrollEarnDetails', 'payrollDedcDetails', 'schoolDetails'));
	}

	public function payrollReport(Request $request)
	{
		$roles = Role::where('active_status', '=', '1')->where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->get();
		return view('backEnd.reports.payroll', compact('roles'));
	}

	public function searchPayrollReport(Request $request)
	{


		$request->validate([
			'role_id' => "required",
			'payroll_month' => "required",
			'payroll_year' => "required"

		]);

		$role_id = $request->role_id;
		$payroll_month = $request->payroll_month;
		$payroll_year = $request->payroll_year;

		$query = '';
		if ($request->role_id != "") {
			$query = "AND s.role_id = '$request->role_id'";
		}
		if ($request->payroll_month != "") {
			$query .= "AND pg.payroll_month = '$request->payroll_month'";
		}

		if ($request->payroll_year != "") {
			$query .= "AND pg.payroll_year = '$request->payroll_year'";
		}

		$staffsPayroll = DB::select(DB::raw("SELECT pg.*, s.full_name, r.name, 									d.title 
											FROM sm_hr_payroll_generates pg
        									LEFT JOIN sm_staffs s ON pg.staff_id = s.id
        									LEFT JOIN roles r ON s.role_id = r.id
        									LEFT JOIN sm_designations d ON s.designation_id = d.id
        									WHERE pg.active_status AND pg.payroll_status='P'
        									$query"));

		$roles = Role::where('active_status', '=', '1')->where('id', '!=', 2)->where('id', '!=', 3)->get();
		return view('backEnd.reports.payroll', compact('staffsPayroll', 'roles', 'payroll_month', 'payroll_year', 'role_id'));
	}
}
