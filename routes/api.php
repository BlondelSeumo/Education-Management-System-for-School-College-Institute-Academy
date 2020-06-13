<?php

use Illuminate\Http\Request;


/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// -------------------Start admin Module------------------

Route::any('is-enabled', 'SmApiController@checkColumnAvailable');


// admin section visitor  
Route::any('login', 'SmAuthController@mobileLogin');


Route::get('class-id/{id}', 'SmAuthController@get_class_name');
Route::get('section-id/{id}', 'SmAuthController@get_section_name');
Route::get('teacher-id/{id}', 'SmAuthController@get_teacher_name');
Route::get('subject-id/{id}', 'SmAuthController@get_subject_name');
Route::get('room-id/{id}', 'SmAuthController@get_room_name');
Route::get('class-period-id/{id}', 'SmAuthController@get_class_period_name');


Route::get('visitor', ['as' => 'visitor', 'uses' => 'SmVisitorController@index']);
Route::post('visitor-store', ['as' => 'visitor_store', 'uses' => 'SmVisitorController@store']);
Route::get('visitor-edit/{id}', ['as' => 'visitor_edit', 'uses' => 'SmVisitorController@edit']);

Route::post('visitor-update', ['as' => 'visitor_update', 'uses' => 'SmVisitorController@update']);
Route::get('visitor-delete/{id}', ['as' => 'visitor_delete', 'uses' => 'SmVisitorController@delete']);

Route::get('download-visitor-document/{file_name}', function ($file_name = null) {

    $file = public_path() . '/uploads/visitor/' . $file_name;
    if (file_exists($file)) {
        return Response::download($file);
    }
});


// admin section complaint
Route::get('complaint', 'api\SmAdminController@complaint');
Route::post('complaint-store', 'api\SmAdminController@complaintStore');


Route::get('complaint', 'SmComplaintController@index');
Route::post('complaint-store', 'SmComplaintController@store');
Route::get('complaint-edit/{id}', 'SmComplaintController@edit');
Route::post('complaint-update', 'SmComplaintController@update');
Route::get('complaint-delete/{id}', 'SmVisitorController@delete');

Route::get('download-complaint-document/{file_name}', function ($file_name = null) {
    $file = public_path() . '/uploads/complaint/' . $file_name;
    if (file_exists($file)) {
        return Response::download($file);
    }
});

// Admin section postal-receive

Route::get('postal-receive', 'SmPostalReceiveController@index');
Route::post('postal-receive-store', 'SmPostalReceiveController@store');
Route::post('postal-receive-edit/{id}', 'SmPostalReceiveController@show');
Route::post('postal-receive-update', 'SmPostalReceiveController@update');
Route::get('postal-receive-delete/{id}', 'SmPostalReceiveController@destroy');
Route::get('postal-receive-document/{file_name}', function ($file_name = null) {
    $file = public_path() . '/uploads/postal/' . $file_name;
    if (file_exists($file)) {
        return Response::download($file);
    }
});

// Admin section postal-dispatch
Route::get('postal-dispatch', 'SmPostalDispatchController@index');
Route::post('postal-dispatch-store', 'SmPostalDispatchController@store');
Route::get('postal-dispatch-edit/{id}', 'SmPostalDispatchController@show');
Route::post('postal-dispatch-update', 'SmPostalDispatchController@update');
Route::get('postal-dispatch-delete/{id}', 'SmPostalDispatchController@destroy');

Route::get('postal-dispatch-document/{file_name}', function ($file_name = null) {
    $file = public_path() . '/uploads/postal/' . $file_name;
    if (file_exists($file)) {
        return Response::download($file);
    } else {
        redirect()->back();
    }
});

// Phone Call Log
Route::resource('phone-call', 'SmPhoneCallLogController');

// Admin Setup
Route::resource('setup-admin', 'SmSetupAdminController');
Route::get('setup-admin-delete/{id}', 'SmSetupAdminController@destroy');

// -------------------End admin Module------------------


// -----------Start Student Information---------------
// student list
Route::get('student-list', ['as' => 'student_list', 'uses' => 'SmStudentAdmissionController@studentDetails']);

// student search

Route::post('student-list-search', 'SmStudentAdmissionController@studentDetailsSearch');
Route::get('student-list-search', 'SmStudentAdmissionController@studentDetails');

// student list
Route::get('student-view/{id}', ['as' => 'student_view', 'uses' => 'SmStudentAdmissionController@studentView']);
// student delete
Route::any('student-delete', ['as' => 'student_delete', 'uses' => 'SmStudentAdmissionController@studentDelete']);
// student edit
Route::get('student-edit/{id}', ['as' => 'student_edit', 'uses' => 'SmStudentAdmissionController@studentEdit']);


// Student Attendance
Route::get('student-attendance', ['as' => 'student_attendance', 'uses' => 'SmStudentAttendanceController@index']);
Route::post('student-search', 'SmStudentAttendanceController@studentSearch');
Route::get('student-search', 'SmStudentAttendanceController@index');

Route::post('student-attendance-store', 'SmStudentAttendanceController@studentAttendanceStore');

// Student Attendance Report
Route::get('student-attendance-report', ['as' => 'student_attendance_report', 'uses' => 'SmStudentAdmissionController@studentAttendanceReport']);

Route::post('student-attendance-report-search', ['as' => 'student_attendance_report_search', 'uses' => 'SmStudentAdmissionController@studentAttendanceReportSearch']);
Route::get('student-attendance-report-search', 'SmStudentAdmissionController@studentAttendanceReport');

// Student Category
Route::get('student-category', ['as' => 'student_category', 'uses' => 'SmStudentCategoryController@index']);
Route::post('student-category-store', ['as' => 'student_category_store', 'uses' => 'SmStudentCategoryController@store']);
Route::get('student-category-edit/{id}', ['as' => 'student_category_edit', 'uses' => 'SmStudentCategoryController@edit']);
Route::post('student-category-update', ['as' => 'student_category_update', 'uses' => 'SmStudentCategoryController@update']);
Route::get('student-category-delete/{id}', ['as' => 'student_category_delete', 'uses' => 'SmStudentCategoryController@delete']);


// Student Group Routes
Route::get('student-group', ['as' => 'student_group', 'uses' => 'SmStudentGroupController@index']);
Route::post('student-group-store', ['as' => 'student_group_store', 'uses' => 'SmStudentGroupController@store']);
Route::get('student-group-edit/{id}', ['as' => 'student_group_edit', 'uses' => 'SmStudentGroupController@edit']);
Route::post('student-group-update', ['as' => 'student_group_update', 'uses' => 'SmStudentGroupController@update']);
Route::get('student-group-delete/{id}', ['as' => 'student_group_delete', 'uses' => 'SmStudentGroupController@delete']);


// Student Promote search
Route::get('student-promote', ['as' => 'student_promote', 'uses' => 'SmStudentAdmissionController@studentPromote']);

Route::get('student-current-search', 'SmStudentAdmissionController@studentPromote');
Route::post('student-current-search', 'SmStudentAdmissionController@studentCurrentSearch');
Route::get('view-academic-performance/{id}', 'SmStudentAdmissionController@view_academic_performance');


// // Student Promote Store
Route::get('student-promote-store', 'SmStudentAdmissionController@studentPromote');
Route::post('student-promote-store', 'SmStudentAdmissionController@studentPromoteStore');

// Disabled Student
Route::get('disabled-student', ['as' => 'disabled_student', 'uses' => 'SmStudentAdmissionController@disabledStudent']);
Route::post('disabled-student', ['as' => 'disabled_student', 'uses' => 'SmStudentAdmissionController@disabledStudentSearch']);
// -----------End Student Information---------------

// -------------------Teacher Module------------------
// Start Upload Content
Route::get('upload-content', 'SmTeacherController@uploadContentList');
Route::post('save-upload-content', 'SmTeacherController@saveUploadContent'); // incomplete for API
Route::get('delete-upload-content/{id}', 'SmTeacherController@deleteUploadContent');

Route::get('download-content-document/{file_name}', function ($file_name = null) {

    $file = public_path() . '/uploads/upload_contents/' . $file_name;
    if (file_exists($file)) {
        return Response::download($file);
    }
});
// End Upload Content

// Start rest of the routes
Route::get('assignment-list', 'SmTeacherController@assignmentList');
Route::get('study-metarial-list', 'SmTeacherController@studyMetarialList');
Route::get('syllabus-list', 'SmTeacherController@syllabusList');
Route::get('other-download-list', 'SmTeacherController@otherDownloadList');
// End rest of the routes

// ------------------- End Teacher Module------------------


//--------------- Start Fees Collection --------------

// Collect Fees
Route::get('collect-fees', ['as' => 'collect_fees', 'uses' => 'SmFeesController@collectFees']);
Route::get('fees-collect-student-wise/{id}', ['as' => 'fees_collect_student_wise', 'uses' => 'SmFeesController@collectFeesStudentApi']);
Route::post('collect-fees', ['as' => 'collect_fees', 'uses' => 'SmFeesController@collectFeesSearch']);

//Search Fees Payment
Route::get('search-fees-payment', ['as' => 'search_fees_payment', 'uses' => 'SmFeesController@searchFeesPayment']);
Route::post('fees-payment-search', ['as' => 'fees_payment_search', 'uses' => 'SmFeesController@feesPaymentSearch']);
Route::get('fees-payment-search', ['as' => 'fees_payment_search', 'uses' => 'SmFeesController@searchFeesPayment']);

//Fees Search due
Route::get('search-fees-due', ['as' => 'search_fees_due', 'uses' => 'SmFeesController@searchFeesDue']);
Route::post('fees-due-search', ['as' => 'fees_due_search', 'uses' => 'SmFeesController@feesDueSearch']);
Route::get('fees-due-search', ['as' => 'fees_due_search', 'uses' => 'SmFeesController@searchFeesDue']);


// Route::resource('fees-master', 'SmFeesMasterController');
Route::post('fees-master-single-delete', 'SmFeesMasterController@deleteSingle');
Route::post('fees-master-group-delete', 'SmFeesMasterController@deleteGroup');
Route::get('fees-assign/{id}', ['as' => 'fees_assign', 'uses' => 'SmFeesMasterController@feesAssign']);
Route::get('fees-assign/{id}', ['as' => 'fees_assign', 'uses' => 'SmFeesMasterController@feesAssign']);
Route::post('fees-assign-search', 'SmFeesMasterController@feesAssignSearch');

// Fees Master
Route::get('fees-master-store', ['as' => 'fees_master_add', 'uses' => 'SmApiController@feesMasterStore']);
Route::get('fees-master-update', ['as' => 'fees_master_update', 'uses' => 'SmApiController@feesMasterUpdate']);

// Fees Group routes
Route::get('fees-group', ['as' => 'fees_group', 'uses' => 'SmFeesGroupController@index']);
Route::get('fees-group-store', ['as' => 'fees_group_store', 'uses' => 'SmFeesGroupController@store']);
Route::get('fees-group-edit/{id}', ['as' => 'fees_group_edit', 'uses' => 'SmFeesGroupController@edit']);
Route::get('fees-group-update', ['as' => 'fees_group_update', 'uses' => 'SmFeesGroupController@update']);
Route::post('fees-group-delete', ['as' => 'fees_group_delete', 'uses' => 'SmFeesGroupController@deleteGroup']);

// Fees type routes
Route::get('fees-type', ['as' => 'fees_type', 'uses' => 'SmFeesTypeController@index']);
Route::get('fees-type-store', ['as' => 'fees_type_store', 'uses' => 'SmFeesTypeController@store']);
Route::get('fees-type-edit/{id}', ['as' => 'fees_type_edit', 'uses' => 'SmFeesTypeController@edit']);
Route::get('fees-type-update', ['as' => 'fees_type_update', 'uses' => 'SmFeesTypeController@update']);
Route::get('fees-type-delete/{id}', ['as' => 'fees_type_delete', 'uses' => 'SmFeesTypeController@delete']);

// Fees Discount routes
Route::get('fees-discount', ['as' => 'fees_discount', 'uses' => 'SmFeesDiscountController@index']);
Route::post('fees-discount-store', ['as' => 'fees_discount_store', 'uses' => 'SmFeesDiscountController@store']);
Route::get('fees-discount-edit/{id}', ['as' => 'fees_discount_edit', 'uses' => 'SmFeesDiscountController@edit']);
Route::post('fees-discount-update', ['as' => 'fees_discount_update', 'uses' => 'SmFeesDiscountController@update']);
Route::get('fees-discount-delete/{id}', ['as' => 'fees_discount_delete', 'uses' => 'SmFeesDiscountController@delete']);
Route::get('fees-discount-assign/{id}', ['as' => 'fees_discount_assign', 'uses' => 'SmFeesDiscountController@feesDiscountAssign']);
Route::post('fees-discount-assign-search', 'SmFeesDiscountController@feesDiscountAssignSearch');
Route::get('fees-discount-assign-store', 'SmFeesDiscountController@feesDiscountAssignStore');

Route::get('fees-generate-modal/{amount}/{student_id}/{type}', 'SmFeesController@feesGenerateModal');
Route::get('fees-discount-amount-search', 'SmFeesDiscountController@feesDiscountAmountSearch');
// delete fees payment
Route::post('fees-payment-delete', 'SmFeesController@feesPaymentDelete');

// Fees carry forward
Route::get('fees-forward', ['as' => 'fees_forward', 'uses' => 'SmFeesController@feesForward']);
Route::post('fees-forward-search', 'SmFeesController@feesForwardSearch');
Route::get('fees-forward-search', 'SmFeesController@feesForward');

Route::post('fees-forward-store', 'SmFeesController@feesForwardStore');
Route::get('fees-forward-store', 'SmFeesController@feesForward');

//--------------- End Fees Collection --------------


//--------------- Start Accounts Modules --------------

// Profit of account
Route::get('profit', ['as' => 'profit', 'uses' => 'SmAccountsController@profit']);
Route::post('search-profit-by-date', ['as' => 'search_profit_by_date', 'uses' => 'SmAccountsController@searchProfitByDate']);
Route::get('search-profit-by-date', ['as' => 'search_profit_by_date', 'uses' => 'SmAccountsController@profit']);

// add income routes
Route::get('add-income', ['as' => 'add_income', 'uses' => 'SmAddIncomeController@index']);
Route::post('add-income-store', ['as' => 'add_income_store', 'uses' => 'SmAddIncomeController@store']);
Route::get('add-income-edit/{id}', ['as' => 'add_income_edit', 'uses' => 'SmAddIncomeController@edit']);
Route::post('add-income-update', ['as' => 'add_income_update', 'uses' => 'SmAddIncomeController@update']);
Route::post('add-income-delete', ['as' => 'add_income_delete', 'uses' => 'SmAddIncomeController@delete']);

// Add Expense
Route::resource('add-expense', 'SmAddExpenseController');

//payment method
Route::get('payment-method', ['as' => 'payment_method', 'uses' => 'SmPaymentMethodController@index']);
Route::post('payment-method-store', ['as' => 'payment_method_store', 'uses' => 'SmPaymentMethodController@store']);
Route::get('payment-method-edit/{id}', ['as' => 'payment_method_edit', 'uses' => 'SmPaymentMethodController@edit']);
Route::post('payment-method-update', ['as' => 'payment_method_update', 'uses' => 'SmPaymentMethodController@update']);
Route::get('payment-method-delete/{id}', ['as' => 'payment_method_delete', 'uses' => 'SmPaymentMethodController@delete']);

//--------------- End Accounts Modules --------------


//--------------- Start Human Resource  --------------

// staff directory
Route::get('staff-directory', ['as' => 'staff_directory', 'uses' => 'SmStaffController@staffList']);
Route::get('staff-roles', ['as' => 'staff_roles', 'uses' => 'SmStaffController@staffRoles']);
Route::get('staff-list/{role_id}', ['as' => 'staff_dlist', 'uses' => 'SmStaffController@roleStaffList']);
Route::get('staff-view/{id}', ['as' => 'staff_view', 'uses' => 'SmStaffController@staffView']);
Route::get('search-staff', 'SmStaffController@staffList');
Route::post('search-staff', ['as' => 'searchStaff', 'uses' => 'SmStaffController@searchStaff']);
Route::get('deleteStaff/{id}', 'SmStaffController@deleteStaff');

//Staff Attendance
Route::get('staff-attendance', ['as' => 'staff_attendance', 'uses' => 'SmStaffAttendanceController@staffAttendance']);
Route::post('staff-attendance-search', 'SmStaffAttendanceController@staffAttendanceSearch');
Route::post('staff-attendance-store', 'SmStaffAttendanceController@staffAttendanceStore');

Route::get('staff-attendance-report', ['as' => 'staff_attendance_report', 'uses' => 'SmStaffAttendanceController@staffAttendanceReport']);
Route::post('staff-attendance-report-search', ['as' => 'staff_attendance_report_search', 'uses' => 'SmStaffAttendanceController@staffAttendanceReportSearch']);

// Staff designation
Route::resource('designation', 'SmDesignationController');

//Department
Route::resource('department', 'SmHumanDepartmentController');
//--------------- End Human Resource  --------------


//--------------- Start Leave module --------------

//Start Approve Leave Request
Route::get('approve-leave', 'SmApproveLeaveController@index');
Route::post('approve-leave-store', 'SmApproveLeaveController@store');
Route::get('approve-leave-edit/{id}', 'SmApproveLeaveController@edit');
Route::get('/staffNameByRole', 'SmApproveLeaveController@staffNameByRole');
Route::post('update-approve-leave', 'SmApproveLeaveController@updateApproveLeave');
Route::get('view-leave-details-approve/{id}', 'SmApproveLeaveController@viewLeaveDetails');
//End Approve Leave Request

//Start Apply Leave
Route::get('apply-leave', 'SmLeaveRequestController@index');
Route::post('apply-leave-store', 'SmLeaveRequestController@store');
Route::get('apply-leave-edit/{id}', 'SmLeaveRequestController@show');
Route::post('apply-leave-update', 'SmLeaveRequestController@update');
Route::get('view-leave-details-apply/{id}', 'SmLeaveRequestController@viewLeaveDetails');
Route::get('delete-apply-leave/{id}', 'SmLeaveRequestController@destroy');
//End Apply Leave

// Staff leave define
Route::resource('leave-define', 'SmLeaveDefineController');

// Staff leave type
Route::resource('leave-type', 'SmLeaveTypeController');

//--------------- End Leave module --------------


//--------------- Start Examination Module--------------

// Marks Grade
Route::resource('marks-grade', 'SmMarksGradeController');

//--------------- End Examination Module--------------


//--------------- Start Academic Module--------------

// class routine new
Route::get('class-routine-new', ['as' => 'class_routine_new', 'uses' => 'SmClassRoutineNewController@classRoutine']);
Route::post('class-routine-new', 'SmClassRoutineNewController@classRoutineSearch');

//assign subject
Route::get('assign-subject', ['as' => 'assign_subject', 'uses' => 'SmAcademicsController@assignSubject']);
Route::get('assign-subject-create', ['as' => 'assign_subject_create', 'uses' => 'SmAcademicsController@assigSubjectCreate']);
Route::post('assign-subject-search', ['as' => 'assign_subject_search', 'uses' => 'SmAcademicsController@assignSubjectSearch']);
Route::get('assign-subject-search', 'SmAcademicsController@assigSubjectCreate');
Route::post('assign-subject-store', 'SmAcademicsController@assignSubjectStore');
Route::get('assign-subject-store', 'SmAcademicsController@assigSubjectCreate');
Route::post('assign-subject', 'SmAcademicsController@assignSubjectFind');
Route::get('assign-subject-get-by-ajax', 'SmAcademicsController@assignSubjectAjax');

//Assign Class Teacher
Route::resource('assign-class-teacher', 'SmAssignClassTeacherControler');

// Subject routes
Route::get('subject', ['as' => 'subject', 'uses' => 'SmSubjectController@index']);
Route::post('subject-store', ['as' => 'subject_store', 'uses' => 'SmSubjectController@store']);
Route::get('subject-edit/{id}', ['as' => 'subject_edit', 'uses' => 'SmSubjectController@edit']);
Route::post('subject-update', ['as' => 'subject_update', 'uses' => 'SmSubjectController@update']);
Route::get('subject-delete/{id}', ['as' => 'subject_delete', 'uses' => 'SmSubjectController@delete']);

// Class route
Route::get('class', ['as' => 'class', 'uses' => 'SmClassController@index']);
Route::post('class-store', ['as' => 'class_store', 'uses' => 'SmClassController@store']);
Route::get('class-edit/{id}', ['as' => 'class_edit', 'uses' => 'SmClassController@edit']);
Route::post('class-update', ['as' => 'class_update', 'uses' => 'SmClassController@update']);
Route::get('class-delete/{id}', ['as' => 'class_delete', 'uses' => 'SmClassController@delete']);

//Class Section routes
Route::get('section', ['as' => 'section', 'uses' => 'SmSectionController@index']);
Route::post('section-store', ['as' => 'section_store', 'uses' => 'SmSectionController@store']);
Route::get('section-edit/{id}', ['as' => 'section_edit', 'uses' => 'SmSectionController@edit']);
Route::post('section-update', ['as' => 'section_update', 'uses' => 'SmSectionController@update']);
Route::get('section-delete/{id}', ['as' => 'section_delete', 'uses' => 'SmSectionController@delete']);


// Class room
Route::resource('class-room', 'SmClassRoomController');

//class time
Route::resource('class-time', 'SmClassTimeController');


//class routine
Route::get('student-class-routine/{id}', 'Student\SmStudentPanelController@classRoutine');
//--------------- End Academic Module--------------


//--------------- Start Homework Module--------------
//homework list
Route::get('homework-list', ['as' => 'homework-list', 'uses' => 'SmHomeworkController@homeworkList']);
Route::post('homework-list', ['as' => 'homework-list', 'uses' => 'SmHomeworkController@searchHomework']);

//--------------- End Homework Module--------------


//--------------- Start Communicate Module --------------
// Communicate
Route::get('notice-list', 'SmCommunicateController@noticeList');
Route::get('send-message', 'SmCommunicateController@sendMessage');
Route::post('save-notice-data', 'SmCommunicateController@saveNoticeData');
Route::get('edit-notice/{id}', 'SmCommunicateController@editNotice');
Route::post('update-notice-data', 'SmCommunicateController@updateNoticeData');
Route::get('delete-notice-view/{id}', 'SmCommunicateController@deleteNoticeView');
Route::get('send-email-sms-view', 'SmCommunicateController@sendEmailSmsView');
Route::get('delete-notice/{id}', 'SmCommunicateController@deleteNotice');

//Event
Route::resource('event', 'SmEventController');
Route::get('delete-event-view/{id}', 'SmEventController@deleteEventView');
Route::get('delete-event/{id}', 'SmEventController@deleteEvent');

//--------------- Start Communicate Module --------------


//--------------- Start Library Module --------------

// Book
Route::get('book-list', 'SmBookController@index');
// Route::get('add-book', 'SmBookController@addBook');
Route::get('save-book-data', 'SmBookController@saveBookData');
Route::get('edit-book/{id}', 'SmBookController@editBook');
Route::get('update-book-data/{id}', 'SmBookController@updateBookData');
Route::get('delete-book-view/{id}', 'SmBookController@deleteBookView');
Route::get('delete-book/{id}', 'SmBookController@deleteBook');
Route::get('member-list', 'SmBookController@memberList');
Route::get('issue-books/{member_type}/{id}', 'SmBookController@issueBooks');
Route::get('save-issue-book-data', 'SmBookController@saveIssueBookData');
Route::get('return-book-view/{id}', 'SmBookController@returnBookView');
Route::get('return-book/{id}', 'SmBookController@returnBook');
Route::get('all-issed-book', 'SmBookController@allIssuedBook');
Route::get('search-issued-book', 'SmBookController@searchIssuedBook');
Route::get('search-issued-book', 'SmBookController@allIssuedBook');

//library member
Route::resource('library-member', 'SmLibraryMemberController');
Route::get('add-library-member', 'SmApiController@library_member_store');
Route::get('library-member-role', 'SmApiController@member_role');
Route::get('cancel-membership/{id}', 'SmLibraryMemberController@cancelMembership');

//--------------- End Library Module --------------


//-----------------Start Inventory Module------------------------

//Item Category
Route::resource('item-category', 'SmItemCategoryController');
Route::get('delete-item-category-view/{id}', 'SmItemCategoryController@deleteItemCategoryView');
Route::get('delete-item-category/{id}', 'SmItemCategoryController@deleteItemCategory');

//Item List
Route::resource('item-list', 'SmItemController');
Route::get('delete-item-view/{id}', 'SmItemController@deleteItemView');
Route::get('delete-item/{id}', 'SmItemController@deleteItem');

//Item Store
Route::resource('item-store', 'SmItemStoreController');
Route::get('delete-store-view/{id}', 'SmItemStoreController@deleteStoreView');
Route::get('delete-store/{id}', 'SmItemStoreController@deleteStore');

//Supplier
Route::resource('suppliers', 'SmSupplierController');
Route::get('delete-supplier-view/{id}', 'SmSupplierController@deleteSupplierView');
Route::get('delete-supplier/{id}', 'SmSupplierController@deleteSupplier');

//Issue Item
Route::get('item-issue', 'SmItemSellController@itemIssueList');
Route::post('save-item-issue-data', 'SmItemSellController@saveItemIssueData');
Route::get('getItemByCategory', 'SmItemSellController@getItemByCategory');
Route::get('return-item-view/{id}', 'SmItemSellController@returnItemView');
Route::get('return-item/{id}', 'SmItemSellController@returnItem');
//-----------------End Inventory Module------------------------


//------------------Start Transport Module--------------

//routes
Route::resource('transport-route', 'SmRouteController');

//Vehicle
Route::resource('vehicle', 'SmVehicleController');

//Assign Vehicle
Route::resource('assign-vehicle', 'SmAssignVehicleController');
Route::post('assign-vehicle-delete', 'SmAssignVehicleController@delete');

// student transport report
Route::get('student-transport-report', ['as' => 'student_transport_report', 'uses' => 'SmTransportController@studentTransportReportApi']);

//Route::get('student-transport-reportApi', ['as' => 'student_transport_report', 'uses' => 'SmTransportController@studentTransportReportApi']);


Route::post('student-transport-report', ['as' => 'student_transport_report', 'uses' => 'SmTransportController@studentTransportReportSearch']);
//------------------End Transport Module--------------


// ---------------Start Dormitory Module-----------------

//Room list
Route::resource('room-list', 'SmRoomListController');

//Room Type
Route::resource('room-type', 'SmRoomTypeController');

//Dormitory List
Route::resource('dormitory-list', 'SmDormitoryListController');

// Student Dormitory Report
Route::get('student-dormitory-report', ['as' => 'student_dormitory_report', 'uses' => 'SmDormitoryController@studentDormitoryReport']);
Route::post('student-dormitory-report', ['as' => 'student_dormitory_report', 'uses' => 'SmDormitoryController@studentDormitoryReportSearch']);

// ---------------End Dormitory Module-----------------


//------------- Start Report Module---------------------

//Student Report
Route::get('student-report', ['as' => 'student_report', 'uses' => 'SmStudentAdmissionController@studentReport']);
Route::post('student-report', ['as' => 'student_report', 'uses' => 'SmStudentAdmissionController@studentReportSearch']);

//guardian report
Route::get('guardian-report', ['as' => 'guardian_report', 'uses' => 'SmStudentAdmissionController@guardianReport']);
Route::post('guardian-report-search', ['as' => 'guardian_report_search', 'uses' => 'SmStudentAdmissionController@guardianReportSearch']);
Route::get('guardian-report-search', ['as' => 'guardian_report_search', 'uses' => 'SmStudentAdmissionController@guardianReport']);

//Student history
Route::get('student-history', ['as' => 'student_history', 'uses' => 'SmStudentAdmissionController@studentHistory']);
Route::post('student-history-search', ['as' => 'student_history_search', 'uses' => 'SmStudentAdmissionController@studentHistorySearch']);
Route::get('student-history-search', ['as' => 'student_history_search', 'uses' => 'SmStudentAdmissionController@studentHistory']);

// student login report
Route::get('student-login-report', ['as' => 'student_login_report', 'uses' => 'SmStudentAdmissionController@studentLoginReport']);
Route::post('student-login-search', ['as' => 'student_login_search', 'uses' => 'SmStudentAdmissionController@studentLoginSearch']);
Route::get('student-login-search', ['as' => 'student_login_search', 'uses' => 'SmStudentAdmissionController@studentLoginReport']);

// student & parent reset password
Route::post('reset-student-password', 'SmResetPasswordController@resetStudentPassword');

//Fees Statement
Route::get('fees-statement', ['as' => 'fees_statement', 'uses' => 'SmFeesController@feesStatemnt']);
Route::post('fees-statement-search', ['as' => 'fees_statement_search', 'uses' => 'SmFeesController@feesStatementSearch']);

// Balance fees report
Route::get('balance-fees-report', ['as' => 'balance_fees_report', 'uses' => 'SmFeesController@balanceFeesReport']);
Route::post('balance-fees-search', ['as' => 'balance_fees_search', 'uses' => 'SmFeesController@balanceFeesSearch']);
Route::get('balance-fees-search', ['as' => 'balance_fees_search', 'uses' => 'SmFeesController@balanceFeesReport']);

// Transaction Report
Route::get('transaction-report', ['as' => 'transaction_report', 'uses' => 'SmFeesController@transactionReport']);
Route::post('transaction-report-search', ['as' => 'transaction_report_search', 'uses' => 'SmFeesController@transactionReportSearch']);
Route::get('transaction-report-search', ['as' => 'transaction_report_search', 'uses' => 'SmFeesController@transactionReport']);

// Class Report
Route::get('class-report', ['as' => 'class_report', 'uses' => 'SmAcademicsController@classReport']);
Route::post('class-report', ['as' => 'class_report', 'uses' => 'SmAcademicsController@classReportSearch']);

// class routine report
Route::get('class-routine-report', ['as' => 'class_routine_report', 'uses' => 'SmClassRoutineNewController@classRoutineReport']);
Route::post('class-routine-report', 'SmClassRoutineNewController@classRoutineReportSearch');

// exam routine report
Route::get('exam-routine-report', ['as' => 'exam_routine_report', 'uses' => 'SmExamRoutineController@examRoutineReport']);
Route::post('exam-routine-report', ['as' => 'exam_routine_report', 'uses' => 'SmExamRoutineController@examRoutineReportSearch']);

//teacher class routine report
Route::get('teacher-class-routine-report', ['as' => 'teacher_class_routine_report', 'uses' => 'SmClassRoutineNewController@teacherClassRoutineReport']);
Route::post('teacher-class-routine-report', 'SmClassRoutineNewController@teacherClassRoutineReportSearch');

// merit list Report
Route::get('merit-list-report', ['as' => 'merit_list_report', 'uses' => 'SmExaminationController@meritListReport']);
Route::post('merit-list-report', ['as' => 'merit_list_report', 'uses' => 'SmExaminationController@meritListReportSearch']);

// online exam report
Route::get('online-exam-report', ['as' => 'online_exam_report', 'uses' => 'SmOnlineExamController@onlineExamReport']);
Route::post('online-exam-report', ['as' => 'online_exam_report', 'uses' => 'SmOnlineExamController@onlineExamReportSearch']);

//mark sheet report student
Route::get('mark-sheet-report-student', ['as' => 'mark_sheet_report_student', 'uses' => 'SmExaminationController@markSheetReportStudent']);
Route::post('mark-sheet-report-student', ['as' => 'mark_sheet_report_student', 'uses' => 'SmExaminationController@markSheetReportStudentSearch']);

//mark sheet report student
Route::get('mark-sheet-report-student', ['as' => 'mark_sheet_report_student', 'uses' => 'SmExaminationController@markSheetReportStudent']);
Route::post('mark-sheet-report-student', ['as' => 'mark_sheet_report_student', 'uses' => 'SmExaminationController@markSheetReportStudentSearch']);

// Tabulation Sheet Report
Route::get('tabulation-sheet-report', ['as' => 'tabulation_sheet_report', 'uses' => 'SmReportController@tabulationSheetReport']);
Route::post('tabulation-sheet-report', ['as' => 'tabulation_sheet_report', 'uses' => 'SmReportController@tabulationSheetReportSearch']);

// progress card report
Route::get('progress-card-report', ['as' => 'progress_card_report', 'uses' => 'SmReportController@progressCardReport']);
Route::post('progress-card-report', ['as' => 'progress_card_report', 'uses' => 'SmReportController@progressCardReportSearch']);

//student fine report
Route::get('student-fine-report', ['as' => 'student_fine_report', 'uses' => 'SmFeesController@studentFineReport']);
Route::post('student-fine-report', ['as' => 'student_fine_report', 'uses' => 'SmFeesController@studentFineReportSearch']);

//user log
Route::get('user-log', ['as' => 'user_log', 'uses' => 'UserController@userLog']);
//------------- End Report Module---------------------


//------------Start System Settings Module--------------

//General Settings
Route::get('general-settings', 'SmSystemSettingController@generalSettingsView');
Route::get('update-general-settings', 'SmSystemSettingController@updateGeneralSettings');
Route::post('update-general-settings-data', 'SmSystemSettingController@updateGeneralSettingsData');
Route::post('update-school-logo', 'SmSystemSettingController@updateSchoolLogo');

//Role Setup
Route::get('role', ['as' => 'role', 'uses' => 'RoleController@index']);
Route::post('role-store', ['as' => 'role_store', 'uses' => 'RoleController@store']);
Route::get('role-edit/{id}', ['as' => 'role_edit', 'uses' => 'RoleController@edit']);
Route::post('role-update', ['as' => 'role_update', 'uses' => 'RoleController@update']);
Route::post('role-delete', ['as' => 'role_delete', 'uses' => 'RoleController@delete']);

// Role Permission
Route::get('assign-permission/{id}', ['as' => 'assign_permission', 'uses' => 'SmRolePermissionController@assignPermission']);
Route::post('role-permission-store', ['as' => 'role_permission_store', 'uses' => 'SmRolePermissionController@rolePermissionStore']);

// Base group
Route::get('base-group', ['as' => 'base_group', 'uses' => 'SmBaseGroupController@index']);
Route::post('base-group-store', ['as' => 'base_group_store', 'uses' => 'SmBaseGroupController@store']);
Route::get('base-group-edit/{id}', ['as' => 'base_group_edit', 'uses' => 'SmBaseGroupController@edit']);
Route::post('base-group-update', ['as' => 'base_group_update', 'uses' => 'SmBaseGroupController@update']);
Route::get('base-group-delete/{id}', ['as' => 'base_group_delete', 'uses' => 'SmBaseGroupController@delete']);

//academic year
Route::resource('academic-year', 'SmAcademicYearController');

//Session
Route::resource('session', 'SmSessionController');

//Holiday
Route::resource('holiday', 'SmHolidayController');
Route::get('delete-holiday-view/{id}', 'SmHolidayController@deleteHolidayView');
Route::get('delete-holiday/{id}', 'SmHolidayController@deleteHoliday');

//weekend
Route::resource('weekend', 'SmWeekendController');

//------------End System Settings Module--------------


//******************Start Student Panel ********************


//------------Start Student Dashboard --------------
Route::get('student-homework/{id}', 'Student\SmStudentPanelController@studentHomework');
Route::get('student-dashboard/{id}', 'Student\SmStudentPanelController@studentDashboard');
Route::get('student-my-attendance/{id}', 'Student\SmStudentPanelController@studentMyAttendanceSearchAPI');
Route::get('student-noticeboard/{id}', 'Student\SmStudentPanelController@studentNoticeboard');
//------------End Student Dashboard --------------


//******************Start Student Panel ********************


Route::get('studentSubject/{id}', 'Student\SmStudentPanelController@studentSubjectApi');
Route::get('student-library/{id}', 'Student\SmStudentPanelController@studentLibrary');
Route::get('studentTeacher/{id}', 'Student\SmStudentPanelController@studentTeacherApi');

Route::get('studentAssignment/{id}', 'Student\SmStudentPanelController@studentAssignmentApi');
Route::get('studentDocuments/{id}', 'Student\SmStudentPanelController@studentsDocumentApi');

Route::get('student-dormitory', 'Student\SmStudentPanelController@studentDormitoryApi');

Route::get('student-exam_schedule/{id}', 'Student\SmStudentPanelController@studentExamScheduleApi');

Route::get('student-timeline/{id}', 'Student\SmStudentPanelController@studentTimelineApi');


Route::get('student-online-exam/{id}', 'Student\SmOnlineExamController@studentOnlineExamApi');
Route::get('choose-exam/{id}', 'Student\SmOnlineExamController@chooseExamApi');
Route::get('online-exam-result/{id}/{exam_id}', 'Student\SmOnlineExamController@examResultApi');
Route::get('getGrades/{marks}', 'Student\SmOnlineExamController@getGrades');


//******************SYSTEM********************
Route::get('getSystemVersion', 'SmSystemSettingController@getSystemVersion');
Route::get('getSystemUpdate/{id}', 'SmSystemSettingController@getSystemUpdate');


Route::get('exam-list/{id}', 'Student\SmStudentPanelController@examListApi');
Route::get('exam-schedule/{id}/{exam_id}', 'Student\SmStudentPanelController@examScheduleApi');
Route::get('exam-result/{id}/{exam_id}', 'Student\SmStudentPanelController@examResultApi');

Route::any('change-password', 'Student\SmStudentPanelController@updatePassowrdStoreApi');


Route::get('child-list/{id}', 'Parent\SmParentPanelController@childListApi');
Route::get('child-info/{id}', 'Parent\SmParentPanelController@childProfileApi');
Route::get('child-fees/{id}', 'Parent\SmParentPanelController@collectFeesChildApi');
Route::get('child-class-routine/{id}', 'Parent\SmParentPanelController@classRoutineApi');
Route::get('child-homework/{id}', 'Parent\SmParentPanelController@childHomework');

Route::get('child-attendance/{id}', 'Parent\SmParentPanelController@childAttendanceAPI');

Route::get('childInfo/{id}', 'SmAuthController@childInfo');

Route::get('parent-about', 'Parent\SmParentPanelController@aboutApi');


//Route::get('parent-about', 'Parent\SmParentPanelController@aboutApi');


//Teacher Api

Route::any('search-student', 'teacher\SearchStudentController@searchStudent');
// https://infixedu.com/api/search-student?class=2
// https://infixedu.com/api/search-student?section=1&class=2
// https://infixedu.com/api/search-student?name=Conner Stamm
// https://infixedu.com/api/search-student?roll_no=28229
Route::get('my-routine/{id}', 'teacher\TeacherApiController@myRoutine');
Route::get('section-routine/{id}/{class}/{section}', 'teacher\TeacherApiController@sectionRoutine');
Route::get('class-section/{id}', 'teacher\TeacherApiController@classSection');
Route::get('subject/{id}', 'teacher\TeacherApiController@subjectsName');


Route::get('teacher-class-list', 'teacher\TeacherApiController@teacherClassList');
Route::get('teacher-section-list', 'teacher\TeacherApiController@teacherSectionList');



Route::any('add-homework', 'teacher\HomeWorkController@addHomework');
Route::get('homework-list/{id}', 'teacher\HomeWorkController@homeworkList');
Route::get('my-attendance/{id}', 'SmStaffAttendanceController@teacherMyAttendanceSearchAPI');
Route::get('staff-leave-type', 'teacher\LeaveController@leaveTypeList');
Route::any('staff-apply-leave', 'teacher\LeaveController@applyLeave');
Route::get('staff-apply-list/{id}', 'teacher\LeaveController@staffLeaveList');
// Route::get('upload-content-type', 'teacher\SmAcademicsController@contentType');
Route::any('teacher-upload-content', 'teacher\TeacherContentController@uploadContent');
Route::get('content-list', 'teacher\TeacherContentController@contentList');
Route::get('delete-content/{id}', 'teacher\TeacherContentController@deleteContent');



//Super Admin Api
Route::get('pending-leave', 'SmApproveLeaveController@pendingLeave');
Route::get('approved-leave', 'SmApproveLeaveController@approvedLeave');
Route::get('reject-leave', 'SmApproveLeaveController@rejectLeave');
Route::any('staff-leave-apply', 'SmApproveLeaveController@applyLeave');
Route::get('update-leave', 'SmApproveLeaveController@updateLeave');

Route::post('update-staff',  'SmApiController@UpdateStaffApi');
Route::post('update-student',  'SmApiController@UpdateStudentApi');
//Super Admin Student
Route::any('set-token', 'SmApiController@setToken');
Route::get('group-token', 'teacher\TeacherContentController@groupToken');

Route::get('room-list', 'SmApiController@roomList');

Route::get('room-type-list', 'SmApiController@roomTypeList');
Route::post('room-list', 'SmApiController@storeRoom');
Route::get('room-update', 'SmApiController@updateRoom');
Route::get('room-delete/{id}', 'SmApiController@deleteRoom');

Route::get('dormitory-list', 'SmApiController@dormitoryList');
Route::get('add-dormitory', 'SmApiController@addDormitory');
Route::get('edit-dormitory', 'SmApiController@editDormitory');
Route::get('delete-dormitory/{id}', 'SmApiController@deleteDormitory');

Route::get('driver-list', 'SmApiController@getDriverList');
Route::get('student-attendance-store', 'SmApiController@studentAttendanceStore');

Route::get('book-category', 'SmApiController@bookCategory');
// Route::get('add-book', 'SmApiController@addBook');
// Route::get('update-book-data/{id}', 'SmBookController@updateBookData');
