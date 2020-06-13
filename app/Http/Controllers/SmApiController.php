<?php

namespace App\Http\Controllers;


use Image;
use App\Role;
use Validator;
use App\SmBook;
use App\SmStaff;
use App\SmStudent;
use App\tableList;
use App\SmRoomList;
use App\SmFeesMaster;
use App\ApiBaseMethod;
use App\SmDormitoryList;
use App\SmLibraryMember;
use App\SmStudentAttendance;
// use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Schema;

class SmApiController extends Controller
{

    public function checkColumnAvailable(Request $request)
    {
        if (!Schema::hasColumn('sm_general_settings', 'api_url')) {
            Schema::table('sm_general_settings', function ($table) {
                $table->integer('api_url')->default(0);
            });
        }
        $data = SmGeneralSettings::find(1);
        if ($data->api_url == 0) {

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {

                $response = [
                    'success' => false,
                    'data'    => '',
                    'message' => null,
                ];

                return $response;
            }
        } else {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];

                $response = [
                    'success' => true,
                    'data'    => '',
                    'message' => null,
                ];
                return $response;
            }
        }
    }
    public function UpdateStaffApi(Request $request)
    {

        $input = $request->all();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'field_name' => "required"

            ]);
        }
        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
        }
        if (!empty($request->field_name)) {
            $request_string = $request->field_name;
            $request_id = $request->id;
            $data = SmStaff::find($request_id);
            $data->$request_string = $request->$request_string;
            if ($request_string == "email") {
                $user = User::find($data->user_id);
                $user->email = $request->$request_string;
                $user->save();
            } else if ($request_string == "first_name") {
                $full_name = $request->$request_string . ' ' . $data->last_name;
                $data->full_name = $full_name;
                $user = User::find($data->user_id);
                $user->full_name = $data->full_name;
                $user->save();
            } else if ($request_string == "last_name") {
                $full_name = $data->first_name . ' ' .  $request->$request_string;
                $data->full_name = $full_name;
                $user = User::find($data->user_id);
                $user->full_name = $data->full_name;
                $user->save();
            } else if ($request_string == "staff_photo") {
                $file = $request->file('staff_photo');
                $images = Image::make($file)->resize(100, 100)->insert($file, 'center');
                $staff_photos = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $images->save('public/uploads/staff/' . $staff_photos);
                $staff_photo = 'public/uploads/staff/' . $staff_photos;
                $data->staff_photo = $staff_photo;
            }
            $data->save();
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['message'] = 'Updated';
                $data['flag'] = TRUE;
                return ApiBaseMethod::sendResponse($data, null);
            }
        } else {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['message'] = 'Invalid Input';
                $data['flag'] = FALSE;
                return ApiBaseMethod::sendError($data, null);
            }
        }
    }
    public function UpdateStudentApi(Request $request)
    {

        $input = $request->all();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'field_name' => "required"

            ]);
        }
        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
        }
        if (!empty($request->field_name)) {
            $request_string = $request->field_name;
            $request_id = $request->id;
            $data = SmStudent::find($request_id);
            $data->$request_string = $request->$request_string;
            if ($request_string == "first_name") {
                $full_name = $request->$request_string . ' ' . $data->last_name;
                $data->full_name = $full_name;
            } else if ($request_string == "last_name") {
                $full_name = $data->first_name . ' ' .  $request->$request_string;
                $data->full_name = $full_name;
            } else if ($request_string == "student_photo") {
                $file = $request->file('student_photo');
                $images = Image::make($file)->resize(100, 100)->insert($file, 'center');
                $student_photos = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $images->save('public/uploads/student/' . $student_photos);
                $student_photo = 'public/uploads/student/' . $student_photos;
                $data->student_photo = $student_photo;
            }
            $data->save();
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['message'] = 'Updated';
                $data['flag'] = TRUE;
                return ApiBaseMethod::sendResponse($data, null);
            }
        } else {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['message'] = 'Invalid Input';
                $data['flag'] = FALSE;
                return ApiBaseMethod::sendError($data, null);
            }
        }
    }
    public function roomList(Request $request)
    {
        $studentDormitory = DB::table('sm_room_lists')
            ->join('sm_dormitory_lists', 'sm_room_lists.dormitory_id', '=', 'sm_dormitory_lists.id')
            ->join('sm_room_types', 'sm_room_lists.room_type_id', '=', 'sm_room_types.id')
            ->select('sm_room_lists.id', 'sm_dormitory_lists.dormitory_name', 'sm_room_lists.name as room_number', 'sm_room_lists.number_of_bed', 'sm_room_lists.cost_per_bed', 'sm_room_lists.active_status')
            ->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($studentDormitory, null);
        }
    }
    public function dormitoryList(Request $request)
    {
        $dormitory_lists = DB::table('sm_dormitory_lists')
            //->select('id', 'dormitory_name')
            ->where('active_status', 1)
            ->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['dormitory_lists'] = $dormitory_lists->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
    }
    public function roomTypeList(Request $request)
    {
        $room_type_lists = DB::table('sm_room_types')
            ->select('id', 'type')
            ->where('active_status', 1)
            ->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['room_type_lists'] = $room_type_lists->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
    }
    public function storeRoom(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'room_number' => "required",
            'dormitory' => "required",
            'room_type' => "required",
            'number_of_bed' => "required|max:2",
            'cost_per_bed' => "required|max:11"
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $room_list = new SmRoomList();
        $room_list->name = $request->room_number;
        $room_list->dormitory_id = $request->dormitory;
        $room_list->room_type_id = $request->room_type;
        $room_list->number_of_bed = $request->number_of_bed;
        $room_list->cost_per_bed = $request->cost_per_bed;
        $room_list->description = $request->description;
        $result = $room_list->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Room has been created successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        }
    }

    public function updateRoom(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'room_number' => "required",
            'dormitory' => "required",
            'room_type' => "required",
            'number_of_bed' => "required|max:2",
            'cost_per_bed' => "required|max:11"
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $room = SmRoomList::find($request->id);
        $room->name = $request->room_number;
        $room->dormitory_id = $request->dormitory;
        $room->room_type_id = $request->room_type;
        $room->number_of_bed = $request->number_of_bed;
        $room->cost_per_bed = $request->cost_per_bed;
        $room->description = $request->description;
        $result = $room->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Room has been updated successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        }
    }
    public function deleteRoom(Request $request, $id)
    {
        $key_id = 'room_id';
        $tables = tableList::getTableList($key_id);
        try {
            $delete_query = SmRoomList::destroy($id);
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($delete_query) {
                    return ApiBaseMethod::sendResponse(null, 'Room has been deleted successfully');
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $msg = 'This data already used in  : Student information table, Please remove those data first';
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {

                return ApiBaseMethod::sendResponse(null,  $msg);
            }
        }
    }


    public function addDormitory(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'dormitory_name' => "required|unique:sm_dormitory_lists,dormitory_name",
            'type' => "required",
            'intake' => "required"
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }




        $dormitory_list = new SmDormitoryList();
        $dormitory_list->dormitory_name = $request->dormitory_name;
        $dormitory_list->type = $request->type;
        $dormitory_list->address = $request->address;
        $dormitory_list->intake = $request->intake;
        $dormitory_list->description = $request->description;
        $result = $dormitory_list->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Dormitory has been created successfully');
            }
        }
    }

    public function editDormitory(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'dormitory_name' => "required|unique:sm_dormitory_lists,dormitory_name",
            'type' => "required",
            'intake' => "required"
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $dormitory_list = SmDormitoryList::find($request->id);
        $dormitory_list->dormitory_name = $request->dormitory_name;
        $dormitory_list->type = $request->type;
        $dormitory_list->address = $request->address;
        $dormitory_list->intake = $request->intake;
        $dormitory_list->description = $request->description;
        $result = $dormitory_list->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Dormitory has been updated successfully');
            }
        }
    }
    public function deleteDormitory(Request $request, $id)
    {
        $tables = \App\tableList::getTableList('dormitory_id');
        try {
            $dormitory_list = SmDormitoryList::destroy($id);
            if ($dormitory_list) {
                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    if ($dormitory_list) {
                        return ApiBaseMethod::sendResponse(null, 'Dormitory has been deleted successfully');
                    } else {
                        return ApiBaseMethod::sendError('Something went wrong, please try again');
                    }
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {

            $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';

            return ApiBaseMethod::sendError($msg);
        }
    }
    public function getDriverList(Request $request)
    {
        $driver_list = DB::table('sm_staffs')
            ->where('active_status', 1)
            ->where('role_id', '=', 9)
            ->get();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($driver_list, null);
        }
    }

    public function setToken(Request $request)
    {
        if (!Schema::hasColumn('users', 'notificationToken')) {
            Schema::table('users', function ($table) {
                $table->text('notificationToken')->nullable();
            });
        }

        $user = User::find($request->id);
        $user->notificationToken = $request->token;
        $user->save();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = '';
            return ApiBaseMethod::sendResponse($data, null);
        }
    }
    public function studentAttendanceStore(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => "required",
            'date' => "required",
            'attendance' => "required",
            'class' => "required",
            'section' => "required"
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $students = SmStudent::where('class_id', $request->class)->where('section_id', $request->section)->select('id')->get();

        $attendance = SmStudentAttendance::where('student_id', $request->id)->where('attendance_date', date('Y-m-d', strtotime($request->date)))->first();
        // return  $attendance;
        if(empty($attendance)){
            foreach ($students as $student) {
                $attendance = SmStudentAttendance::where('student_id', $student->id)->where('attendance_date', date('Y-m-d', strtotime($request->date)))->first();

                if ($attendance != "") {
                    $attendance->delete();
                }

                $attendance = new SmStudentAttendance();
                $attendance->student_id = $student->id;
                $attendance->attendance_type = "P";
                $attendance->attendance_date = date('Y-m-d', strtotime($request->date));
                $attendance->save();
            }
        }
       

        // return $students;

        $attendance = SmStudentAttendance::where('student_id', $request->id)->where('attendance_date', date('Y-m-d', strtotime($request->date)))->first();



        if ($attendance != "") {
            $attendance->delete();
        }
        $attendance = new SmStudentAttendance();
        $attendance->student_id = $request->id;
        $attendance->attendance_type = $request->attendance;
        $attendance->attendance_date = date('Y-m-d', strtotime($request->date));
        $attendance->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse(null, 'Student attendance been submitted successfully');
        }
    }
    public function bookCategory(Request $request)
    {
        $book_category = DB::table('sm_book_categories')->get();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($book_category, null);
        }
    }
    public function addBook(Request $request)
    {
        $input = $request->all();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'book_title' => "required",
                'book_category_id' => "required",
                'subject' => "required",
                'user_id' => "required"
            ]);
        }
        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $books = new SmBook();
        $books->book_title = $request->book_title;
        $books->book_category_id = $request->book_category_id;
        $books->book_number = $request->book_number;
        $books->isbn_no = $request->isbn_no;
        $books->publisher_name = $request->publisher_name;
        $books->author_name = $request->author_name;
        $books->subject_id = $request->subject;
        $books->rack_number = $request->rack_number;
        $books->quantity = $request->quantity;
        $books->book_price = $request->book_price;
        $books->details = $request->details;
        $books->post_date = date('Y-m-d');
        $books->created_by = $request->user_id;
        $results = $books->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($results) {
                return ApiBaseMethod::sendResponse(null, 'New Book has been added successfully.');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        }
    }
    public function member_role(Request $request)
    {

        $roles = Role::where('active_status', '=', 1)->orderBy('id', 'desc')->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($roles, null);
        }
    }
    public function library_member_store(Request $request)
    {
        $input = $request->all();
        // return $input;
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($request->member_type == "") {
                $validator = Validator::make($input, [
                    'member_type' => "required",
                    'created_by' => "required",
                    'member_ud_id' => "required|unique:sm_library_members,member_ud_id"
                ]);
            } elseif ($request->member_type == "2") {

                $validator = Validator::make($input, [
                    'member_type' => "required",
                    'student' => "required",
                    'created_by' => "required",
                    'member_ud_id' => "required|unique:sm_library_members,member_ud_id"
                ]);
            } else {
                $validator = Validator::make($input, [
                    'member_type' => "required",
                    'staff' => "required",
                    'created_by' => "required",
                    'member_ud_id' => "required|unique:sm_library_members,member_ud_id"
                ]);
            }
        }
        // return $input;
        $student_staff_id = '';
        if ($request->student <> 0) {
            $student_staff_id = $request->student;
            $isData = SmLibraryMember::where('student_staff_id', '=', $student_staff_id)->where('active_status', '=', 1)->first();
            if (!empty($isData)) {
                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    return ApiBaseMethod::sendError('This Member is already added in our library.');
                }
            }
        }
        if ($request->staff <> 0) {
            $student_staff_id = $request->staff;
            $isData = SmLibraryMember::where('student_staff_id', '=', $student_staff_id)->where('active_status', '=', 1)->first();
            if (!empty($isData)) {
                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    return ApiBaseMethod::sendError('This Member is already added in our library.');
                }
            }
        }


        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
        }


        $user = Auth()->user();

        if ($user) {
            $user_id = $user->id;
        } else {
            $created_by = $request->created_by;
        }

        $isExist_staff_id = SmLibraryMember::where('student_staff_id', '=', $student_staff_id)->first();
        //return $isExist_staff_id;
        if (!empty($isExist_staff_id)) {
            $members = SmLibraryMember::where('student_staff_id', '=', $student_staff_id)->first();
            $members->active_status = 1;
            $results = $members->update();
            return ApiBaseMethod::sendResponse(null, 'New Member has been added successfully');
        } else {
            $members = new SmLibraryMember();
            $members->member_type = $request->member_type;
            $members->student_staff_id = $student_staff_id;
            $members->member_ud_id = $request->member_ud_id;
            $members->created_by = $created_by;
            $results = $members->save();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($results) {
                    return ApiBaseMethod::sendResponse(null, 'New Member has been added successfully');
                } else {
                    return ApiBaseMethod::sendError('Something went wrong, please try again.');
                }
            }
        }
    }
    public function feesMasterStore(Request $request)
    {
        $input = $request->all();
        if ($request->fees_group == "" || $request->fees_group != 1 && $request->fees_group != 2) {


            $validator = Validator::make($input, [
                'fees_group' => "required",
                'fees_type' => "required",
                'date' => "required",
                'amount' => "required"
            ]);
        } else {
            $validator = Validator::make($input, [
                'fees_group' => "required",
                'fees_type' => "required",
                'date' => "required"
            ]);
        }
        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
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
                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    return ApiBaseMethod::sendResponse(null, 'Fees Master added successfully');
                }
            } else {
                return ApiBaseMethod::sendError('Operation Failed.', $validator->errors());
            }
        } else {
            return ApiBaseMethod::sendError('Operation Failed.', $validator->errors());
        }
    }
    public function feesMasterUpdate(Request $request)
    {
        $input = $request->all();
        if ($request->fees_group == "" || $request->fees_group != 1 && $request->fees_group != 2) {


            $validator = Validator::make($input, [
                'fees_group' => "required",
                'fees_type' => "required",
                'date' => "required",
                'amount' => "required"
            ]);
        } else {
            $validator = Validator::make($input, [
                'fees_group' => "required",
                'fees_type' => "required",
                'date' => "required"
            ]);
        }
        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
        }

        $combination = SmFeesMaster::where('fees_group_id', $request->fees_group)->where('fees_type_id', $request->fees_type)->count();

        if ($combination == 0) {
            $fees_master = SmFeesMaster::find($request->id);
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
                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    return ApiBaseMethod::sendResponse(null, 'Fees Master updated successfully');
                }
            } else {
                return ApiBaseMethod::sendError('Operation Failed.', $validator->errors());
            }
        } else {
            return ApiBaseMethod::sendError('Operation Failed.', $validator->errors());
        }
    }
}
