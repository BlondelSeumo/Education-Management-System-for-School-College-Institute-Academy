<?php

namespace App\Http\Controllers;

use App\SmClass;
use App\SmStudent;
use App\tableList;
use App\SmFeesType;
use App\SmBaseSetup;
use App\SmFeesGroup;
use App\SmFeesAssign;
use App\SmFeesMaster;
use App\ApiBaseMethod;
use App\SmNotification;
use App\SmStudentCategory;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SmFeesMasterController extends Controller
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
        $fees_groups = SmFeesGroup::all();
        $fees_masters = SmFeesMaster::all();
        $fees_masters = $fees_masters->groupBy('fees_group_id');

        // foreach($fees_masters as $fees_master){
        //     echo $fees_master.'<br>'.'';
        // } 
        // exit();       
        $fees_types = SmFeesType::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['fees_groups'] = $fees_groups->toArray();
            $data['fees_types'] = $fees_types->toArray();
            $data['fees_masters'] = $fees_masters->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.feesCollection.fees_master', compact('fees_groups', 'fees_types', 'fees_masters'));
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
        if ($request->fees_group == "" || $request->fees_group != 1 && $request->fees_group != 2) {
            $request->validate([
                'fees_group' => "required",
                'fees_type' => "required",
                'date' => "required",
                'amount' => "required"
            ]);
        } else {
            $request->validate([
                'fees_group' => "required",
                'fees_type' => "required",
                'date' => "required"
            ]);
        }


        $combination = SmFeesMaster::where('fees_group_id', $request->fees_group)->where('fees_type_id', $request->fees_type)->count();

        if ($combination == 0) {
            $fees_master = new SmFeesMaster();
            $fees_master->fees_group_id = $request->fees_group;
            $fees_master->fees_type_id = $request->fees_type;
            $fees_master->date = date('Y-m-d', strtotime($request->date));
            if ($request->fees_group != 1 && $request->fees_group != 2) {
                $fees_master->amount = $request->amount;
            } else {
                $fees_master->amount = NULL;
            }
            $result = $fees_master->save();
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fees_master = SmFeesMaster::find($id);
        $fees_groups = SmFeesGroup::all();
        $fees_types = SmFeesType::all();
        $fees_masters = SmFeesMaster::all();
        $fees_masters = $fees_masters->groupBy('fees_group_id');
        return view('backEnd.feesCollection.fees_master', compact('fees_groups', 'fees_types', 'fees_master', 'fees_masters'));
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
        if ($request->fees_group_id != 1 && $request->fees_group_id != 2) {
            $request->validate([
                'fees_type' => "required",
                'amount' => "required"
            ]);
        } else {
            $request->validate([
                'fees_type' => "required",
            ]);
        }


        $fees_master = SmFeesMaster::find($request->id);
        $fees_master->fees_type_id = $request->fees_type;
        $fees_master->date = date('Y-m-d', strtotime($request->date));
        if ($fees_master->fees_group_id != 1 && $fees_master->fees_group_id != 2) {
            $fees_master->amount = $request->amount;
        }
        $result = $fees_master->save();
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect('fees-master');
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = SmFeesMaster::destroy($id);
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect('fees-master');
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function deleteSingle(Request $request)
    {

        $id_key = 'fees_master_id';

        $tables = tableList::getTableList($id_key);

        try {
            $delete_query = SmFeesMaster::destroy($request->id);
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($delete_query) {
                    return ApiBaseMethod::sendResponse(null, 'Fees Master has been deleted successfully');
                } else {
                    return ApiBaseMethod::sendError('Something went wrong, please try again.');
                }
            } else {
                if ($delete_query) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect()->back();
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';

            return redirect()->back()->with('message-danger-delete', $msg);
        } catch (\Exception $e) {
            //dd($e->getMessage(), $e->errorInfo);
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }










        $result = SmFeesMaster::destroy($request->id);


        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Fees Master been deleted successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect('fees-master');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }

    public function deleteGroup(Request $request)
    {


        $id_key = 'fees_master_id';

        $tables = tableList::getTableList($id_key);

        try {
            $delete_query = SmFeesMaster::destroy($request->id);
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($delete_query) {
                    return ApiBaseMethod::sendResponse(null, 'Fees Master has been deleted successfully');
                } else {
                    return ApiBaseMethod::sendError('Something went wrong, please try again.');
                }
            } else {
                if ($delete_query) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect()->back();
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';

            return redirect()->back()->with('message-danger-delete', $msg);
        } catch (\Exception $e) {
            //dd($e->getMessage(), $e->errorInfo);
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }







        //  $result = SmFeesMaster::where('fees_group_id', $request->id);
        //  $result = $result->delete();

        // if (ApiBaseMethod::checkUrl($request->fullUrl())) {
        //     if ($result) {
        //         return ApiBaseMethod::sendResponse(null, 'Fees Master been deleted successfully');
        //     } else {
        //         return ApiBaseMethod::sendError('Something went wrong, please try again');
        //     }
        // } else {
        //     if ($result) {
        //         return redirect('fees-master')->with('message-success-delete', 'Fees Master been deleted successfully');
        //     } else {
        //         return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        //     }
        // }
    }

    public function feesAssign(Request $request, $id)
    {
        $fees_group_id = $id;
        $classes = SmClass::where('active_status', 1)->get();
        $genders = SmBaseSetup::where('active_status', '=', '1')->where('base_group_id', '=', '1')->get();
        $categories = SmStudentCategory::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['classes'] = $classes->toArray();
            $data['categories'] = $categories->toArray();
            $data['genders'] = $genders->toArray();
            $data['fees_group_id'] = $fees_group_id;
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.feesCollection.fees_assign', compact('classes', 'categories', 'genders', 'fees_group_id'));
    }
    public function feesAssignSearch(Request $request)
    {


        $classes = SmClass::where('active_status', 1)->get();
        $genders = SmBaseSetup::where('active_status', '=', '1')->where('base_group_id', '=', '1')->get();
        $categories = SmStudentCategory::all();
        $fees_group_id = $request->fees_group_id;

        $students = SmStudent::query();
        $students->where('active_status', 1);
        if ($request->class != "") {
            $students->where('class_id', $request->class);
        }
        if ($request->section != "") {
            $students->where('section_id', $request->section);
        }
        if ($request->category != "") {
            $students->where('student_category_id', $request->category);
        }
        if ($request->gender != "") {
            $students->where('gender_id', $request->gender);
        }
        if ($request->fees_group_id == 1) {
            $students->where('route_list_id', '!=', '');
        }
        if ($request->fees_group_id == 2) {
            $students->where('room_id', '!=', '');
        }
        $students = $students->get();

        $fees_masters = SmFeesMaster::where('fees_group_id', $request->fees_group_id)->get();

        $pre_assigned = [];
        foreach ($students as $student) {
            foreach ($fees_masters as $fees_master) {
                $assigned_student = SmFeesAssign::select('student_id')->where('student_id', $student->id)->where('fees_master_id', $fees_master->id)->first();

                if ($assigned_student != "") {
                    if (!in_array($assigned_student->student_id, $pre_assigned)) {
                        $pre_assigned[] = $assigned_student->student_id;
                    }
                }
            }
        }

        $class_id = $request->class;
        $category_id = $request->category;
        $gender_id = $request->gender;

        $fees_assign_groups = SmFeesMaster::where('fees_group_id', $request->fees_group_id)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['classes'] = $classes->toArray();
            $data['categories'] = $categories->toArray();
            $data['genders'] = $genders->toArray();
            $data['students'] = $students->toArray();
            $data['fees_assign_groups'] = $fees_assign_groups->toArray();
            $data['fees_group_id'] = $fees_group_id;
            $data['pre_assigned'] = $pre_assigned;
            $data['class_id'] = $class_id;
            $data['category_id'] = $category_id;
            $data['gender_id'] = $gender_id;
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.feesCollection.fees_assign', compact('classes', 'categories', 'genders', 'students', 'fees_assign_groups', 'fees_group_id', 'pre_assigned', 'class_id', 'category_id', 'gender_id'));
    }



    public function feesAssignStore(Request $request)
    {
        $fees_masters = SmFeesMaster::where('fees_group_id', $request->fees_group_id)->get();

        foreach ($request->students as $student) {
            foreach ($fees_masters as $fees_master) {
                $assign_fees = SmFeesAssign::where('fees_master_id', $fees_master->id)->where('student_id', $student)->delete();
            }
        }

        if ($request->checked_ids != "") {
            foreach ($request->checked_ids as $student) {
                foreach ($fees_masters as $fees_master) {
                    $assign_fees = new SmFeesAssign();
                    $assign_fees->student_id = $student;
                    $assign_fees->fees_master_id = $fees_master->id;
                    $assign_fees->save();
                }
            }
        }



        foreach ($request->students as $student) {
            $notification = new SmNotification;
            $notification->user_id = $student;
            $notification->role_id = 2;
            $notification->date = date('Y-m-d');
            $notification->message = 'New fees Assigned';
            $notification->save();
        }

        $html = "";
        return response()->json([$html]);
    }
}
