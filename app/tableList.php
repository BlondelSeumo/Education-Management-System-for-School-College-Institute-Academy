<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class tableList extends Model
{
	public static function getTableList($id)
	{
		$db_name = env('DB_DATABASE', null);
		$table_list = DB::select("SELECT TABLE_NAME 
		FROM INFORMATION_SCHEMA.COLUMNS
		WHERE COLUMN_NAME ='$id'
			AND TABLE_SCHEMA='$db_name'");
		$tables = "";
		foreach ($table_list as $row) {
			$name = str_replace('sm_', '', $row->TABLE_NAME);
			$name = str_replace('_', ' ', $name);
			$name = ucfirst($name);
			$tables .= $name . ', ';
		}
		return $tables;
	}


	public static function ONLY_TABLE_LIST($id)
	{
		$db_name = env('DB_DATABASE', null);
		$table_list = DB::select("SELECT TABLE_NAME 
		FROM INFORMATION_SCHEMA.COLUMNS
		WHERE COLUMN_NAME ='$id'
			AND TABLE_SCHEMA='$db_name'");
		$tables = [];
		foreach ($table_list as $row) {
			$tables[] = $row->TABLE_NAME;
		}
		return $tables;
	}
}
