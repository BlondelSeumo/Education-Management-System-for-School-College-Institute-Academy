<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmClass;
use App\SmRoute;
use App\SmVehicle;
use App\SmStudent;
use DB;

class SmTransportController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }
    
    public function studentTransportReport(Request $request){
    	$classes = SmClass::where('active_status', 1)->get();
    	$routes = SmRoute::where('active_status', 1)->get();
    	$vehicles = SmVehicle::where('active_status', 1)->get();
    	$students = SmStudent::where('active_status', 1)->where('vechile_id', '!=', "")->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['classes'] = $classes->toArray();
            $data['routes'] = $routes->toArray();
            $data['vehicles'] = $vehicles->toArray();
           // $data['students'] = $students->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
    	return view('backEnd.transport.student_transport_report', compact('classes', 'routes', 'vehicles', 'students'));
    }

    public function studentTransportReportSearch(Request $request){

    	$students = SmStudent::query();
        $students->where('active_status', 1);
        if($request->class != ""){
            $students->where('class_id', $request->class);
        }
         if($request->section != ""){
            $students->where('section_id', $request->section);
        }
        if($request->route != ""){
            $students->where('route_list_id', $request->route);
        }else{
        	$students->where('route_list_id', '!=', '');
        }
        if($request->vehicle != ""){
            $students->where('vechile_id', $request->vehicle);
        }else{
        	$students->where('vechile_id', '!=', '');
        }
        $students = $students->get();

        $classes = SmClass::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
    	$routes = SmRoute::where('active_status', 1)->get();
    	$vehicles = SmVehicle::where('active_status', 1)->get();


        $class_id = $request->class;
        $route_id = $request->route;
        $vechile_id = $request->vehicle;

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['classes'] = $classes->toArray();
            $data['routes'] = $routes->toArray();
            $data['vehicles'] = $vehicles->toArray();
            $data['students'] = $students->toArray();
            $data['class_id'] = $class_id;
            $data['route_id'] = $route_id;
            $data['vechile_id'] = $vechile_id;
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.transport.student_transport_report', compact('classes', 'routes', 'vehicles', 'students', 'class_id', 'route_id', 'vechile_id'));
    }
    public function studentTransportReportApi(Request $request){
        
        

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $transport = DB::table('sm_assign_vehicles')
            ->select('sm_routes.title as route','sm_vehicles.vehicle_no','sm_vehicles.vehicle_model','sm_vehicles.made_year','sm_staffs.full_name as driver_name','sm_staffs.mobile','sm_staffs.driving_license')
            ->join('sm_routes', 'sm_assign_vehicles.route_id', '=', 'sm_routes.id')
            ->join('sm_vehicles', 'sm_assign_vehicles.vehicle_id', '=', 'sm_vehicles.id')
            ->join('sm_staffs', 'sm_vehicles.driver_id', '=', 'sm_staffs.id')
            ->get();
            
            return ApiBaseMethod::sendResponse($transport, null);
        }
    	//return view('backEnd.transport.student_transport_report', compact('classes', 'routes', 'vehicles', 'students'));
    }
}
