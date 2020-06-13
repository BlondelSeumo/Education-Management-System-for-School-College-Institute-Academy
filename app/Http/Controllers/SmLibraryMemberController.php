<?php

namespace App\Http\Controllers;

use App\Role;
use Validator;
use App\SmClass;
use App\SmBookIssue;
use App\ApiBaseMethod;
use App\SmLibraryMember;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SmLibraryMemberController extends Controller
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
        //$libraryMembers = SmLibraryMember::where('active_status', '=', 1)->get();
        $libraryMembers = SmLibraryMember::where('active_status', '=', 1)->get();
        $roles = Role::all();
        $classes = SmClass::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['libraryMembers'] = $libraryMembers->toArray();
            $data['roles'] = $roles->toArray();
            $data['classes'] = $classes->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.library.members', compact('libraryMembers', 'roles', 'classes'));
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
        $input = $request->all();
        // return $input;
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($request->member_type == "") {
                $validator = Validator::make($input, [
                    'member_type' => "required",
                    'user_id' => "required",
                    'member_ud_id' => "required|unique:sm_library_members,member_ud_id"
                ]);
            } elseif ($request->member_type == "2") {

                $validator = Validator::make($input, [
                    'member_type' => "required",
                    'student' => "required",
                    'user_id' => "required",
                    'member_ud_id' => "required|unique:sm_library_members,member_ud_id"
                ]);
            } else {
                $validator = Validator::make($input, [
                    'member_type' => "required",
                    'staff' => "required",
                    'user_id' => "required",
                    'member_ud_id' => "required|unique:sm_library_members,member_ud_id"
                ]);
            }
        } else {
            if ($request->member_type == "") {
                $validator = Validator::make($input, [
                    'member_type' => "required",
                    'member_ud_id' => "required|unique:sm_library_members,member_ud_id"
                ]);
            } elseif ($request->member_type == "2") {
                $validator = Validator::make($input, [
                    'member_type' => "required",
                    'student' => "required",
                    'member_ud_id' => "required|unique:sm_library_members,member_ud_id"
                ]);
            } else {
                $validator = Validator::make($input, [
                    'member_type' => "required",
                    'staff' => "required",
                    'member_ud_id' => "required|unique:sm_library_members,member_ud_id"
                ]);
            }
        }

        $student_staff_id = '';
        if (!empty($request->student)) {
            $student_staff_id = $request->student;
            $isData = SmLibraryMember::where('student_staff_id', '=', $student_staff_id)->where('active_status', '=', 1)->first();
            if (!empty($isData)) {
                Toastr::error('This Member is already added in our library', 'Failed');
                return redirect()->back();
            }
        }
        if (!empty($request->staff)) {
            $student_staff_id = $request->staff;
            $isData = SmLibraryMember::where('student_staff_id', '=', $student_staff_id)->where('active_status', '=', 1)->first();
            if (!empty($isData)) {
                Toastr::error('This Member is already added in our library', 'Failed');
                return redirect()->back();
            }
        }


        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $user = Auth()->user();

        if ($user) {
            $user_id = $user->id;
        } else {
            $user_id = $request->user_id;
        }

        $isExist_staff_id = SmLibraryMember::where('student_staff_id', '=', $student_staff_id)->first();
        //return $isExist_staff_id;
        if (!empty($isExist_staff_id)) {

            $members = SmLibraryMember::where('student_staff_id', '=', $student_staff_id)->first();
            ///return $members;
            $members->active_status = 1;
            $results = $members->update();
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            $members = new SmLibraryMember();
            $members->member_type = $request->member_type;
            $members->student_staff_id = $student_staff_id;
            $members->member_ud_id = $request->member_ud_id;
            $members->created_by = $user_id;
            $results = $members->save();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($results) {
                    return ApiBaseMethod::sendResponse(null, 'New Member has been added successfully');
                } else {
                    return ApiBaseMethod::sendError('Something went wrong, please try again.');
                }
            } else {
                if ($results) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect()->back();
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cancelMembership(Request $request, $id)
    {
        $tables = "";

        try {

            $isExist_member_id = SmBookIssue::select('id', 'issue_status')
                ->where('member_id', '=', $id)
                ->where('issue_status', '=', 'I')
                ->first();
            //return $isExist_member_id;


            if (!empty($isExist_member_id)) {
                Toastr::error('This member have to return book', 'Failed');
                return redirect()->back();
            } else {
                $members = SmLibraryMember::find($id);
                $members->active_status = 0;
                $results = $members->update();

                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    if ($results) {
                        return ApiBaseMethod::sendResponse(null, 'Membership has been successfully cancelled');
                    } else {
                        return ApiBaseMethod::sendError('Something went wrong, please try again.');
                    }
                } else {
                    if ($results) {
                        Toastr::success('Operation successful', 'Success');
                        return redirect()->back();
                    } else {
                        Toastr::error('Operation Failed', 'Failed');
                        return redirect()->back();
                    }
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













        // $members = SmLibraryMember::find($id);
        // $members->active_status = 0;
        // $results = $members->update();

        // if (ApiBaseMethod::checkUrl($request->fullUrl())) {
        //     if ($results) {
        //         return ApiBaseMethod::sendResponse(null, 'Membership has been successfully cancelled');
        //     } else {
        //         return ApiBaseMethod::sendError('Something went wrong, please try again.');
        //     }
        // } else {
        //     if ($results) {
        //         return redirect()->back()->with('message-success-delete', 'Membership has been successfully cancelled');
        //     } else {
        //         return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        //     }
        // }

    }
}
