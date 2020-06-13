<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class SmSearchController extends Controller
{
    function search(Request $r){
        if($r->ajax())
        {
         $output = '';
         $query = $r->get('search');
         if($query != '')
         {
            if (Auth::user()->role_id == 1) {
              $data = \DB::table('sm_module_links')
              ->where('name', 'like', '%'.$query.'%')
              ->where('route', '!=', '')
              ->orderBy('id', 'desc')
              ->get();
              return response()->json($data, 200);
            }
            else {
              $data = \DB::table('sm_module_links')
              ->join('sm_role_permissions', 'sm_module_links.id', '=', 'sm_role_permissions.module_link_id')
              ->select('sm_module_links.id','sm_module_links.name as name','sm_module_links.route', 'sm_role_permissions.role_id as role_id', 'sm_role_permissions.active_status as active_status')
              ->where('name', 'like', '%'.$query.'%')
              ->where('route', '!=', '')
              ->where('role_id', @Auth::user()->role_id)
              ->orderBy('id', 'desc')
              ->get();
              return response()->json($data, 200);
            }
        }
        else {
            return response()->json(['not found'=>'Not Foound'], 404);
             
          }

        }
    }
}
