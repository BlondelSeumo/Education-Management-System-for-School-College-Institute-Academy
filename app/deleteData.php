<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class deleteData extends Model
{
    public  function deleteTableData($id)
    {
        $db_name=env('DB_DATABASE', null);
		$table_list=DB::select("SELECT TABLE_NAME 
		FROM INFORMATION_SCHEMA.COLUMNS
		WHERE COLUMN_NAME ='$id'
			AND TABLE_SCHEMA='$db_name'");
			$tables="";
			foreach($table_list as $row){
				$name = str_replace('sm_', '', $row->TABLE_NAME);
				$name = str_replace('_', ' ', $name);
				$name = ucfirst($name);
				$tables.=$name.', ';
			}
			
		// try {
		// 	$delete_query = $db_table::destroy($request->id);
		// 			if($delete_query){
		// 				return redirect('base-setup')->with('message-success-delete', 'Base Setup has been deleted successfully');
		// 			}else{
		// 				return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
		// 			}
		// } catch (\Illuminate\Database\QueryException $e) {
		// 	$msg='This data already used in  : '.$tables.' Please remove those data first';

		// 	return redirect()->back()->with('message-danger-delete', $msg);
		// } catch (\Exception $e) {
		// 	//dd($e->getMessage(), $e->errorInfo);
		// 	return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        // }
        
    }
}
