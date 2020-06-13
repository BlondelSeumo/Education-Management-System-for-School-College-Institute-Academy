<?php

namespace App\Http\Controllers;

use Mail;
use Twilio;
use App\Role;
use Validator;
use App\SmClass;
use App\SmStaff;
use App\SmParent;
use App\SmStudent;
use Clickatell\Rest;
use LaravelMsg91;
use App\SmSmsGateway;
use App\ApiBaseMethod;
use App\SmNoticeBoard;
use App\SmEmailSmsLog;
use App\SmGeneralSettings;
use Illuminate\Http\Request;
use Clickatell\ClickatellException;
use Brian2694\Toastr\Facades\Toastr;
use PhpMyAdmin\MoTranslator\ReaderException;

class SmCommunicateController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }


    public function sendMessage(Request $request)
    {
        $roles = Role::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($roles, null);
        }
        return view('backEnd.communicate.sendMessage', compact('roles'));
    }

    public function saveNoticeData(Request $request)
    {
        $input = $request->all();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'notice_title' => "required",
                'notice_date' => "required",
                'publish_on' => "required",
                'login_id' => "required"
            ]);
        } else {
            $validator = Validator::make($input, [
                'notice_title' => "required",
                'notice_date' => "required",
                'publish_on' => "required",
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

        $roles_array = array();
        if (empty($request->role)) {
            $roles_array = '';
        } else {
            $roles_array = implode(',', $request->role);
        }

        $user = Auth()->user();

        if ($user) {
            $login_id = $user->id;
        } else {
            $login_id = $request->login_id;
        }

        $noticeData = new SmNoticeBoard();
        if (isset($request->is_published)) {
            $noticeData->is_published = $request->is_published;
        }
        $noticeData->notice_title = $request->notice_title;
        $noticeData->notice_message = $request->notice_message;
        $noticeData->notice_date = date('Y-m-d', strtotime($request->notice_date));
        $noticeData->publish_on = date('Y-m-d', strtotime($request->publish_on));
        $noticeData->inform_to = $roles_array;
        $noticeData->created_by = $login_id;
        $results = $noticeData->save();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($results) {
                return ApiBaseMethod::sendResponse(null, 'Class Room has been created successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($results) {
                Toastr::success('Operation successful', 'Success');
                return redirect('notice-list');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }

    public function noticeList(Request $request)
    {
        $allNotices = SmNoticeBoard::where('active_status', 1)
            ->orderBy('id', 'DESC')
            ->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($allNotices, null);
        }

        return view('backEnd.communicate.noticeList', compact('allNotices'));
    }

    public function editNotice(Request $request, $notice_id)
    {
        $roles = Role::all();
        $noticeDataDetails = SmNoticeBoard::find($notice_id);

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['roles'] = $roles->toArray();
            $data['noticeDataDetails'] = $noticeDataDetails->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.communicate.editSendMessage', compact('noticeDataDetails', 'roles'));
    }

    public function updateNoticeData(Request $request)
    {
        $input = $request->all();
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'notice_title' => "required",
                'notice_date' => "required",
                'publish_on' => "required",
                'login_id' => "required"
            ]);
        } else {
            $validator = Validator::make($input, [
                'notice_title' => "required",
                'notice_date' => "required",
                'publish_on' => "required",
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

        $roles_array = array();
        if (empty($request->role)) {
            $roles_array = '';
        } else {
            $roles_array = implode(',', $request->role);
        }

        $user = Auth()->user();

        if ($user) {
            $login_id = $user->id;
        } else {
            $login_id = $request->login_id;
        }

        $noticeData = SmNoticeBoard::find($request->notice_id);
        if (isset($request->is_published)) {
            $noticeData->is_published = $request->is_published;
        }
        $noticeData->notice_title = $request->notice_title;
        $noticeData->notice_message = $request->notice_message;
        $noticeData->notice_date = date('Y-m-d', strtotime($request->notice_date));
        $noticeData->publish_on = date('Y-m-d', strtotime($request->publish_on));
        $noticeData->inform_to = $roles_array;
        $noticeData->updated_by = $login_id;
        $results = $noticeData->update();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($results) {
                return ApiBaseMethod::sendResponse(null, 'Notice has been updated successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($results) {
                Toastr::success('Operation successful', 'Success');
                return redirect('notice-list');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }

    public function deleteNoticeView(Request $request, $id)
    {
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($id, null);
        }
        return view('backEnd.communicate.deleteNoticeView', compact('id'));
    }

    public function deleteNotice(Request $request, $id)
    {
        $result = SmNoticeBoard::destroy($id);

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($result) {
                return ApiBaseMethod::sendResponse(null, 'Notice has been deleted successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
        } else {
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }

    public function sendEmailSmsView(Request $request)
    {
        $roles = Role::select('*')->where('id', '!=', 1)->get();
        $classes = SmClass::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['roles'] = $roles->toArray();
            $data['classes'] = $classes->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.communicate.sendEmailSms', compact('roles', 'classes'));
    }




    public function sendEmailFromComunicate($data, $to_name, $to_email, $email_sms_title)
    {
        $systemSetting = SmGeneralSettings::select('school_name', 'email')->find(1);
        $system_email = $systemSetting->email;
        $school_name = $systemSetting->school_name;
        if (!empty($system_email)) {
            $result = Mail::send('backEnd.emails.mail', ["result" => $data], function ($message) use ($to_name, $to_email, $email_sms_title, $system_email, $school_name) {
                $message->to($to_email, $to_name)->subject($email_sms_title);
                $message->from($system_email, $school_name);
            });
            $error_data =  [];
            return $error_data;
        } else {
            $error_data[0] = 'success';
            $error_data[1] = 'Operation Failed, Please Updated System Mail';
            return $error_data;
        }
    }

    public function sendSMSFromComunicate($to_mobile, $sms)
    {
        $activeSmsGateway = SmSmsGateway::where('active_status', '=', 1)->first();

        if ($activeSmsGateway->gateway_name == 'Twilio') {
            $account_id         = $activeSmsGateway->twilio_account_sid; // Your Account SID from www.twilio.com/console
            $auth_token         = $activeSmsGateway->twilio_authentication_token; // Your Auth Token from www.twilio.com/console
            $from_phone_number  = $activeSmsGateway->twilio_registered_no;

            $client = new Twilio\Rest\Client($account_id, $auth_token);
            if (!empty($to_mobile)) {
                $result = $message = $client->messages->create($to_mobile, array('from' => $from_phone_number,  'body' => $sms));
            }
        } //end Twilio
        else if ($activeSmsGateway->gateway_name == 'Clickatell') {
            config(['clickatell.api_key' => $smsGatewayDetails->clickatell_api_id]); //set a variale in config file(clickatell.php)
            $clickatell = new \Clickatell\Rest();
            $result = $clickatell->sendMessage(['to' => [$to_mobile],  'content' => $sms]);
        } //end Clickatell

        else if ($activeSmsGateway->gateway_name == 'Msg91') {
            $msg91_authentication_key_sid   = $activeSmsGateway->msg91_authentication_key_sid;
            $msg91_sender_id                = $activeSmsGateway->msg91_sender_id;
            $msg91_route                    = $activeSmsGateway->msg91_route;
            $msg91_country_code             = $activeSmsGateway->msg91_country_code;

            $curl = curl_init();



            $url = "https://api.msg91.com/api/sendhttp.php?mobiles=" . $to_mobile . "&authkey=" . $msg91_authentication_key_sid . "&route=" . $msg91_route . "&sender=" . $msg91_sender_id . "&message=" . $sms . "&country=91";

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true, CURLOPT_ENCODING => "", CURLOPT_MAXREDIRS => 10, CURLOPT_TIMEOUT => 30, CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, CURLOPT_CUSTOMREQUEST => "GET", CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0,
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                $result =  "cURL Error #:" . $err;
            } else {
                $result =  $response;
            }
        } //end Msg91

        return $result;
    }

    public function sendEmailSms(Request $request)
    {

        $request->validate([
            'email_sms_title' => "required",
            'send_through' => "required",
            'description' => "required",
        ]);

        $email_sms_title = $request->email_sms_title;
        // save data in email sms log
        $saveEmailSmsLogData = new SmEmailSmsLog();
        $saveEmailSmsLogData->saveEmailSmsLogData($request);

        if (empty($request->selectTab) or $request->selectTab == 'G') {

            if (empty($request->role)) {
                Toastr::error('Please select whom you want to send', 'Failed');
                return redirect()->back();
            } else {
                $email_sms_title = $request->email_sms_title;
                $description = $request->description;
                $message_to = implode(',', $request->role);

                $to_name = '';
                $to_email = '';
                $to_mobile = '';
                $receiverDetails = '';
                foreach ($request->role as $role_id) {

                    if ($role_id == 2) {
                        $receiverDetails = SmStudent::select('email', 'full_name', 'mobile')->where('active_status', 1)->get();
                    } elseif ($role_id == 3) {
                        $receiverDetails = SmParent::select('guardians_email', 'fathers_name', 'fathers_mobile')->get();
                    } else {
                        $receiverDetails = SmStaff::select('email', 'full_name', 'mobile')->where('role_id', $role_id)->where('active_status', 1)->get();
                    }


                    foreach ($receiverDetails as $receiverDetail) {
                        $to_name    = $receiverDetail->full_name;
                        $to_email   = $receiverDetail->email;
                        $to_mobile  = $receiverDetail->mobile;

                        // send dynamic content in $data
                        $data = array('name' => $to_name, 'email_sms_title' => $request->email_sms_title, 'description' => $request->description);
                        if ($request->send_through == 'E') {
                            if (!empty($receiverDetail->full_name) && !empty($receiverDetail->email)) {
                                $flag = $this->sendEmailFromComunicate($data, $to_name, $to_email, $email_sms_title);
                                if ($flag != "") {
                                    Toastr::error('Operation Failed' . $flag[1], 'Failed');
                                    return redirect()->back();
                                }
                            }
                        } else {
                            $sms = $request->description;
                            $this->sendSMSFromComunicate($to_mobile, $sms);
                        } //end else
                    } //end loop
                } //end role loop
            } //end else Please select whom you want to send

        } //end select tab G
        else if ($request->selectTab == 'I') {
            if (empty($request->message_to_individual)) {
                Toastr::error('Please select whom you want to send', 'Failed');
                return redirect()->back();
            } else {
                $message_to_individual = $request->message_to_individual;

                foreach ($message_to_individual as $key => $value) {
                    $receiver_full_name_email = explode('-', $value);
                    $receiver_full_name = $receiver_full_name_email[0];
                    $receiver_email = $receiver_full_name_email[1];
                    $receiver_mobile = $receiver_full_name_email[2];

                    $to_name = $receiver_full_name;
                    $to_email = $receiver_email;

                    $to_mobile = $receiver_mobile;
                    // send dynamic content in $data
                    $data = array('name' => $to_name, 'email_sms_title' => $request->email_sms_title, 'description' => $request->description);
                    // If checked Email
                    if ($request->send_through == 'E') {
                        if (!empty($receiverDetail->full_name) && !empty($receiverDetail->email)) {
                            $flag = $this->sendEmailFromComunicate($data, $to_name, $to_email, $email_sms_title);
                            if ($flag != "") {
                                Toastr::error('Operation Failed' . $flag[1], 'Failed');
                                return redirect()->back();
                            }
                        }
                    }
                    // if checked Sms 
                    else {
                        $sms = $request->description;
                        $this->sendSMSFromComunicate($to_mobile, $sms);
                    } //end else

                }
            } //end else
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            //  start send email/sms to class section
            if (empty($request->message_to_section)) {
                Toastr::error('Please select whom you want to send', 'Failed');
                return redirect()->back();
            } else {
                $class_id = $request->class_id;
                $selectedSections = $request->message_to_section;
                foreach ($selectedSections as $key => $value) {
                    $students = SmStudent::select('email', 'full_name', 'mobile')->where('class_id', $class_id)->where('section_id', $value)->where('active_status', 1)->get();

                    foreach ($students as $student) {
                        $to_name = $student->full_name;
                        $to_email = $student->email;
                        $to_mobile = $student->mobile;
                        // send dynamic content in $data
                        $data = array(
                            'name' => $student->full_name,
                            'email_sms_title' => $request->email_sms_title,
                            'description' => $request->description,

                        );



                        if ($request->send_through == 'E') {
                            if (!empty($receiverDetail->full_name) && !empty($receiverDetail->email)) {
                                $flag = $this->sendEmailFromComunicate($data, $to_name, $to_email, $email_sms_title);
                                if ($flag != "") {
                                    Toastr::error('Operation Failed' . $flag[1], 'Failed');
                                    return redirect()->back();
                                }
                            }
                        } //send email template 
                        else {
                            $sms = $request->description;
                            $this->sendSMSFromComunicate($to_mobile, $sms);
                        } //end else
                    } //end student loop
                } //end selectedSections loop
            } //end else
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } //end else 

    } // end function sendEmailSms 





    public function studStaffByRole(Request $request)
    {

        if ($request->id == 2) {
            $allStudents = SmStudent::where('active_status', '=', 1)->get();
            $students = [];
            foreach ($allStudents as $allStudent) {
                $students[] = SmStudent::find($allStudent->id);
            }

            return response()->json([$students]);
        }

        if ($request->id == 3) {
            $allParents = SmParent::all();
            $parents = [];
            foreach ($allParents as $allParent) {
                $parents[] = SmParent::find($allParent->id);
            }

            return response()->json([$parents]);
        }

        if ($request->id != 2 and $request->id != 3) {
            $allStaffs = SmStaff::where('role_id', '=', $request->id)->where('active_status', '=', 1)->get();
            $staffs = [];
            foreach ($allStaffs as $staffsvalue) {
                $staffs[] = SmStaff::find($staffsvalue->id);
            }

            return response()->json([$staffs]);
        }
    }

    public function emailSmsLog()
    {
        $emailSmsLogs = SmEmailSmsLog::orderBy('id', 'DESC')->get();
        return view('backEnd.communicate.emailSmsLog', compact('emailSmsLogs'));
    }
}
