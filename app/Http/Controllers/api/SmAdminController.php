<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\api\SmBaseController as SmBaseController;
use App\SmVisitor;
use App\SmComplaint;
use Validator;

class SmAdminController extends SmBaseController
{

	// visitor method
    public function visitor()
    {
        $visitors = SmVisitor::all();
        return $this->sendResponse($visitors->toArray(), 'Visitors retrieved successfully.');
    }


    public function visitorStore(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => "required",
    		'phone' => "required",
    		'purpose' => "required"
        ]);



        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $fileName = ""; 
    	if($request->file('file') != ""){
    		$file = $request->file('file');
	        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
	        $file->move('public/uploads/visitor/', $fileName);
	        $fileName =  'public/uploads/visitor/'.$fileName;
    	}


        $visitor = new SmVisitor();

    	$visitor->name = $request->name;
    	$visitor->phone = $request->phone;
    	$visitor->visitor_id = $request->visitor_id;
    	$visitor->no_of_person = $request->no_of_person;
    	$visitor->purpose = $request->purpose;
    	$visitor->date = date('Y-m-d',strtotime($request->date));
    	$visitor->in_time = $request->in_time;
    	$visitor->out_time = $request->out_time;
    	$visitor->file = $fileName;
    	$result = $visitor->save();

    	if($result){
    		return $this->sendResponse(null, 'Visitor has been created successfully.');
    	}else{
    		return $this->sendError('Something went wrong, please try again.');       
    	}
        
    }

    public function visitorEdit($id)
    {
        $visitor = SmVisitor::find($id);


        if (is_null($visitor)) {
            return $this->sendError('Product not found.');
        }


        return $this->sendResponse($visitor->toArray(), 'Visitor retrieved successfully.');
    }


    public function visitorUpdate(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => "required",
    		'phone' => "required",
    		'purpose' => "required"
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $fileName = ""; 
    	if($request->file('file') != ""){
    		$visitor = SmVisitor::find($request->id);
    		if($visitor->file != ""){
                $path = url('/').'/public/uploads/visitor/'.$visitor->file;
    			if(file_exists($path)){
    				unlink($path);
    			}
    		}
    		$file = $request->file('file');
	        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
	        $file->move('public/uploads/visitor/', $fileName);
	        $fileName =  'public/uploads/visitor/'.$fileName;
    	}


        $visitor = SmVisitor::find($request->id);

    	$visitor->name = $request->name;
    	$visitor->phone = $request->phone;
    	$visitor->visitor_id = $request->visitor_id;
    	$visitor->no_of_person = $request->no_of_person;
    	$visitor->purpose = $request->purpose;
    	$visitor->date = date('Y-m-d',strtotime($request->date));
    	$visitor->in_time = $request->in_time;
    	$visitor->out_time = $request->out_time;

    	if($fileName != ""){
    		$visitor->file = $fileName;
    	}
    	

    	$result = $visitor->save();

    	if($result){
    		return $this->sendResponse(null, 'Visitor has been updated successfully.');
    	}else{
    		return $this->sendError('Something went wrong, please try again.');       
    	}
    }


    public function visitorDelete($id)
    {
    	$visitor = SmVisitor::find($id);
    	if($visitor->file != ""){
			if(file_exists($visitor->file)){
				unlink($visitor->file);
			}
		}

        $result = $visitor->delete();


        if($result){
    		return $this->sendResponse(null, 'Visitor has been deleted successfully.');
    	}else{
    		return $this->sendError('Something went wrong, please try again.');       
    	}
    }



    // complaint method
    public function complaint()
    {
        $complaints = SmComplaint::all();
        return $this->sendResponse($complaints->toArray(), 'Complaint retrieved successfully.');
    }

    public function complaintStore (Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'complaint_by' => "required",
            'complaint_type' => "required",
            'phone' => "required",
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $fileName = ""; 
        if($request->file('file') != ""){
            $file = $request->file('file');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/complaint/', $fileName);
            $fileName =  'public/uploads/complaint/'.$fileName;
        }


        $complaint = new SmComplaint();
        $complaint->complaint_by = $request->complaint_by;
        $complaint->complaint_type = $request->complaint_type;
        $complaint->complaint_source = $request->complaint_source;
        $complaint->phone = $request->phone;
        $complaint->date = date('Y-m-d',strtotime($request->date));
        $complaint->description = $request->description;
        $complaint->action_taken = $request->action_taken;
        $complaint->assigned = $request->assigned;
        $complaint->file = $fileName;
        $result = $complaint->save();

    	if($result){
    		return $this->sendResponse(null, 'Complaint has been created successfully.');
    	}else{
    		return $this->sendError('Something went wrong, please try again.');       
    	}
        
    }




}
