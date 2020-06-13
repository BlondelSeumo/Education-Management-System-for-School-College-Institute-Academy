<?php

namespace App\Http\Controllers;

use DB;
use App\tableList;
use App\SmBaseGroup;
use App\SmBaseSetup;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;


class SmBaseSetupController extends Controller
{
	public function __construct()
	{
		$this->middleware('PM');
	}

	public function index()
	{
		$base_groups = SmBaseGroup::where('active_status', '=', 1)->get();
		return view('backEnd.systemSettings.baseSetup.base_setup', compact('base_groups'));
	}
	public function store(Request $request)
	{
		$request->validate([
			'name' => "required",
			'base_group' => "required"
		]);
		$base_setup = new SmBaseSetup();
		$base_setup->base_setup_name = $request->name;
		$base_setup->base_group_id = $request->base_group;
		$result = $base_setup->save();
		if ($result) {
			Toastr::success('Operation successful', 'Success');
			return redirect()->back();
		} else {
			return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
		}
	}
	public function edit($id)
	{
		$base_setup = SmBaseSetup::find($id);
		$base_groups = SmBaseGroup::where('active_status', '=', 1)->get();
		return view('backEnd.systemSettings.baseSetup.base_setup', compact('base_setup', 'base_groups'));
	}

	public function update(Request $request)
	{
		$request->validate([
			'name' => "required",
			'base_group' => "required"
		]);

		$base_group = SmBaseSetup::find($request->id);
		$base_group->base_setup_name = $request->name;
		$base_group->base_group_id = $request->base_group;
		$result = $base_group->save();
		if ($result) {
			Toastr::success('Operation successful', 'Success');
			return redirect('base-setup');
		} else {
			Toastr::error('Operation Failed', 'Failed');
			return redirect()->back();
		}
	}

	// public function deleteQuery($id,$db_table){

	// 	$db_name=env('DB_DATABASE', null);
	// 	$table_list=DB::select("SELECT TABLE_NAME 
	// 	FROM INFORMATION_SCHEMA.COLUMNS
	// 	WHERE COLUMN_NAME ='$id'
	// 		AND TABLE_SCHEMA='$db_name'");
	// 		$tables="";
	// 		foreach($table_list as $row){
	// 			$name = str_replace('sm_', '', $row->TABLE_NAME);
	// 			$name = str_replace('_', ' ', $name);
	// 			$name = ucfirst($name);
	// 			$tables.=$name.', ';
	// 		}

	// 	try {
	// 		$delete_query = $db_table::destroy($request->id);
	// 				if($delete_query){
	// 					return redirect()->back()->with('message-success-delete', 'Base Setup has been deleted successfully');
	// 				}else{
	// 					return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
	// 				}
	// 	} catch (\Illuminate\Database\QueryException $e) {
	// 		$msg='This data already used in  : '.$tables.' Please remove those data first';

	// 		return redirect()->back()->with('message-danger-delete', $msg);
	// 	} catch (\Exception $e) {
	// 		//dd($e->getMessage(), $e->errorInfo);
	// 		return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
	// 	}
	// }
	public function delete(Request $request)
	{

		$id = 'gender_id';

		$tables = tableList::getTableList($id);

		try {
			$delete_query = SmBaseSetup::destroy($request->id);
			if ($delete_query) {
				Toastr::success('Operation successful', 'Success');
				return redirect('base-setup');
			} else {
				Toastr::error('Operation Failed', 'Failed');
				return redirect()->back();
			}
		} catch (\Illuminate\Database\QueryException $e) {
			$msg = 'This data already used in  : ' . $tables . ' Please remove those data first';

			return redirect()->back()->with('message-danger-delete', $msg);
		} catch (\Exception $e) {
			//dd($e->getMessage(), $e->errorInfo);
			Toastr::error('Operation Failed', 'Failed');
			return redirect()->back();
		}

		//return deleteData::deleteTableData($id,$table_name);


	}
}
