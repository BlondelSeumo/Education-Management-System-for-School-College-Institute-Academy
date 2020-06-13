<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmFeesDiscount;
use App\SmFeesMaster;
use App\SmFeesGroup;
use App\SmFeesType;
use App\SmClass;
use App\SmBaseSetup;
use App\SmStudentCategory;
use App\SmStudent;
use App\SmFeesAssign;
use App\SmFeesAssignDiscount;
use App\tableList;
use Validator;
class SmFeesDiscountController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }
    
    public function index(Request $request){
    	$fees_discounts = SmFeesDiscount::all();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            return ApiBaseMethod::sendResponse($fees_discounts, null);
        }

        return view('backEnd.feesCollection.fees_discount', compact('fees_discounts'));

    }
    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
    		'name' => "required|unique:sm_fees_discounts",
    		'code' => "required|unique:sm_fees_discounts",
    		'amount' => "required"
    	]);

        if($validator->fails()){
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


    	$fees_discount = new SmFeesDiscount();
    	$fees_discount->name = $request->name;
    	$fees_discount->code = $request->code;
        $fees_discount->type = $request->type;
    	$fees_discount->amount = $request->amount;
    	$fees_discount->description = $request->description;
    	$result = $fees_discount->save();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($result){
                return ApiBaseMethod::sendResponse(null, 'Fees discount has been created successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($result){
                return redirect()->back()->with('message-success', 'Fees discount has been created successfully');
            }else{
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }

    public function edit(Request $request,$id){
    	$fees_discount = SmFeesDiscount::find($id);
    	$fees_discounts = SmFeesDiscount::all();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            $data = [];
            $data['fees_discount'] = $fees_discount ->toArray();
            $data['fees_discounts'] = $fees_discounts->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }

     	return view('backEnd.feesCollection.fees_discount', compact('fees_discounts', 'fees_discount'));
    }
    public function update(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
    		'name' => "required|unique:sm_fees_discounts,name,".$request->id,
    		'code' => "required|unique:sm_fees_discounts,code,".$request->id,
    		'amount' => "required"
    	]);

        if($validator->fails()){
            if(ApiBaseMethod::checkUrl($request->fullUrl())){
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    	$fees_discount = SmFeesDiscount::find($request->id);
    	$fees_discount->name = $request->name;
    	$fees_discount->code = $request->code;
        $fees_discount->type = $request->type;
    	$fees_discount->amount = $request->amount;
    	$fees_discount->description = $request->description;
    	$result = $fees_discount->save();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            if($result){
                return ApiBaseMethod::sendResponse(null, 'Fees discount has been updated successfully');
            }else{
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }else{
            if($result){
                return redirect('fees-discount')->with('message-success', 'Fees discount has been updated successfully');
            }else{
                return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }
    }
    public function delete(Request $request,$id){


$id_key='fees_discount_id';

$tables=tableList::getTableList($id_key);

try {
	$delete_query = SmFeesDiscount::destroy($request->id);
	if(ApiBaseMethod::checkUrl($request->fullUrl())){
		if($delete_query){
			return ApiBaseMethod::sendResponse(null, 'Fees Discount has been deleted successfully');
		}else{
			return ApiBaseMethod::sendError('Something went wrong, please try again.');
		}
	}else{               
		if($delete_query){
			return redirect()->back()->with('message-success-delete', 'Fees Discount has been deleted successfully');
		}else{
			return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
		}
	}

} catch (\Illuminate\Database\QueryException $e) {
	$msg='This data already used in  : '.$tables.' Please remove those data first';

	return redirect()->back()->with('message-danger-delete', $msg);
} catch (\Exception $e) {
			//dd($e->getMessage(), $e->errorInfo);
	return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
}



    	// $fees_discount = SmFeesDiscount::destroy($id);

        // if(ApiBaseMethod::checkUrl($request->fullUrl())){
        //     if($fees_discount){
        //         return ApiBaseMethod::sendResponse(null, 'Fees discount has been deleted successfully');
        //     }else{
        //         return ApiBaseMethod::sendError('Something went wrong, please try again.');
        //     }
        // }else{
        //     if($fees_discount){
        //         return redirect()->back()->with('message-success-delete', 'Fees discount has been deleted successfully');
        //     }else{
        //         return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        //     }
        // }
    }

    public function feesDiscountAssign(Request $request,$id){
        $fees_discount_id = $id;
        $classes = SmClass::where('active_status', 1)->get();
        $genders = SmBaseSetup::where('active_status', '=', '1')->where('base_group_id', '=', '1')->get();
        $categories = SmStudentCategory::all();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            $data = [];
            $data['fees_discount_id'] = $fees_discount_id;
            $data['classes'] = $classes ->toArray();
            $data['genders'] = $genders->toArray();
            $data['categories'] = $categories->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.feesCollection.fees_discount_assign', compact('classes', 'categories', 'genders', 'fees_discount_id'));
    }

    public function feesDiscountAssignSearch(Request $request){
        
        $classes = SmClass::where('active_status', 1)->get();
        $genders = SmBaseSetup::where('active_status', '=', '1')->where('base_group_id', '=', '1')->get();
        $categories = SmStudentCategory::all();
        $fees_discount_id = $request->fees_discount_id;
        $students = SmStudent::query();
        $students->where('active_status', 1);
        if($request->class != ""){
            $students->where('class_id', $request->class);
        }
        if($request->section != ""){
            $students->where('section_id', $request->section);
        }
        if($request->category != ""){
            $students->where('student_category_id', $request->category);
        }
        if($request->gender != ""){
            $students->where('gender_id', $request->gender);
        }
        $students = $students->get();

        $fees_discount = SmFeesDiscount::find($request->fees_discount_id);

        $pre_assigned = [];
        foreach($students as $student){
            $assigned_student = SmFeesAssignDiscount::select('student_id')->where('student_id', $student->id)->where('fees_discount_id', $request->fees_discount_id)->first();

            if($assigned_student!= ""){
                if(!in_array($assigned_student->student_id, $pre_assigned)){
                    $pre_assigned[] = $assigned_student->student_id;
                }
                
            } 
        }

        $class_id = $request->class;
        $category_id = $request->category;
        $gender_id = $request->gender;

        // $fees_assign_groups = SmFeesMaster::where('fees_group_id', $request->fees_group_id)->get();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            $data = [];
            $data['classes'] = $classes ->toArray();
            $data['categories'] = $categories->toArray();
            $data['genders'] = $genders->toArray();
            $data['students'] = $students->toArray();
            $data['fees_discount'] = $fees_discount;
            $data['fees_discount_id'] = $fees_discount_id;
            $data['pre_assigned'] = $pre_assigned;
            $data['class_id'] = $class_id;
            $data['category_id'] = $category_id;
            $data['gender_id'] = $gender_id;
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.feesCollection.fees_discount_assign', compact('classes', 'categories', 'genders', 'students', 'fees_discount', 'fees_discount_id', 'pre_assigned', 'class_id', 'category_id', 'gender_id'));
    }

    public function feesDiscountAssignStore(Request $request){

        foreach($request->students as $student){
                $assign_discount = SmFeesAssignDiscount::where('fees_discount_id', $request->fees_discount_id)->where('student_id', $student)->delete();
        }

        if($request->checked_ids != ""){
            foreach($request->checked_ids as $student){
                    $assign_discount = new SmFeesAssignDiscount();
                    $assign_discount->student_id = $student;
                    $assign_discount->fees_discount_id = $request->fees_discount_id;
                    $assign_discount->save();   
            }
        }
        $html = "";

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            return ApiBaseMethod::sendResponse($html, null);
        }
        return response()->json([$html]);
    }
    public function feesDiscountAmountSearch(Request $request){
        $html =$request->fees_discount_id;
        $discount_amount = SmFeesAssignDiscount::find($request->fees_discount_id);
        $html = $discount_amount->feesDiscount->amount;

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            return ApiBaseMethod::sendResponse($html, null);
        }
        return response()->json([$html]);
    }
}
