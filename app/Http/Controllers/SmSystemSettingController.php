<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use ZipArchive;
use App\SmStaff;
use App\SmTimeZone;
use App\SmStyle;
use App\Language;
use App\SmBackup;
use App\SmModule;
use App\SmCountry;
use App\SmSession;
use App\SmCurrency;
use App\SmLanguage;
use App\SmCustomLink;
use App\SmDateFormat;
use App\SmSmsGateway;
use App\ApiBaseMethod;
use GuzzleHttp\Client;
use App\SmAcademicYear;
use App\SmEmailSetting;
use App\SmSystemVersion;
use App\SmLanguagePhrase;
use App\SmPaymentMethhod;
use App\SmGeneralSettings;
use App\SmHomePageSetting;
use Illuminate\Http\Request;
use App\SmFrontendPersmission;
use App\SmPaymentGatewaySetting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\GuzzleException;

class SmSystemSettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('PM');
        if (empty(Auth::user()->id)) {
            return redirect('login');
        }
    }

    public function news()
    {
        $exams       = SmExam::all();
        $exams_types = SmExamType::all();
        $classes     = SmClass::where('active_status', 1)->get();
        $subjects    = SmSubject::where('active_status', 1)->get();
        $sections    = SmSection::where('active_status', 1)->get();
        return view('frontEnd.home.light_news', compact('exams', 'classes', 'subjects', 'exams_types', 'sections'));
    }
    public function notificationApi(Request $request)
    {
        return view('backEnd.api');
    }
    // tableEmpty
    public function tableEmpty()
    {
        $sms_services = DB::table('migrations')->get();

        $tables                = DB::select('SHOW TABLES');
        $table_list            = [];
        $table_list_with_count = [];

        $tableString = 'Tables_in_' . DB::connection()->getDatabaseName();

        foreach ($tables as $table) {
            $table_name              = $table->$tableString;
            $table_list[]            = $table_name;
            $count                   = DB::table($table_name)->count();
            $table_list_with_count[] = $table->$tableString . '(' . $count . ')';
            // $table_strings[] = '$this->call('. $table_name.'Seeder::class);';

        }
        return view('backEnd.systemSettings.tableEmpty', compact('table_list', 'table_list_with_count'));
    }
    // end tableEmpty

    public function databaseDelete(Request $request)
    {

        $list_of_table = $request->permisions;

        if (empty($list_of_table)) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        }
        foreach ($list_of_table as $table) {

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table($table)->truncate();
            //            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        $staff = new SmStaff();

        $staff->user_id        = Auth::user()->id;
        $staff->role_id        = 1;
        $staff->staff_no       = 1;
        $staff->designation_id = 1;
        $staff->department_id  = 1;
        $staff->first_name     = 'Super';
        $staff->last_name      = 'Admin';
        $staff->full_name      = 'Super Admin';
        $staff->fathers_name   = 'NA';
        $staff->mothers_name   = 'NA';

        $staff->date_of_birth   = '1980-12-26';
        $staff->date_of_joining = '2019-05-26';

        $staff->gender_id        = 1;
        $staff->email            = Auth::user()->email;
        $staff->mobile           = '';
        $staff->emergency_mobile = '';
        $staff->merital_status   = '';
        $staff->staff_photo      = 'public/uploads/staff/staff1.jpg';

        $staff->current_address   = '';
        $staff->permanent_address = '';
        $staff->qualification     = '';
        $staff->experience        = '';

        $staff->casual_leave    = '12';
        $staff->medical_leave   = '15';
        $staff->metarnity_leave = '45';

        $staff->driving_license         = '';
        $staff->driving_license_ex_date = '2019-02-23';
        $staff->save();

        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    public function databaseRestory(Request $request)
    {
        set_time_limit(900);
        \Artisan::call('db:seed');
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    public function displaySetting()
    {
        $sms_services       = SmSmsGateway::all();
        $active_sms_service = SmSmsGateway::select('id')->where('active_status', 1)->first();
        return view('backEnd.systemSettings.displaySetting', compact('sms_services', 'active_sms_service'));
    }

    public function smsSettings()
    {
        $sms_services       = SmSmsGateway::all();
        $active_sms_service = SmSmsGateway::select('id')->where('active_status', 1)->first();
        return view('backEnd.systemSettings.smsSettings', compact('sms_services', 'active_sms_service'));
    }

    public function languageSettings()
    {
        $sms_languages = SmLanguage::all();
        $all_languages = DB::table('languages')->orderBy('code', 'ASC')->get();
        return view('backEnd.systemSettings.languageSettings', compact('sms_languages', 'all_languages'));
    }

    public function languageEdit($id)
    {

        $selected_languages = SmLanguage::find($id);
        $sms_languages      = SmLanguage::all();
        $all_languages      = DB::table('languages')->orderBy('code', 'ASC')->get();
        return view('backEnd.systemSettings.languageSettings', compact('sms_languages', 'all_languages', 'selected_languages'));
    }

    public function languageUpdate(Request $request)
    {
        $id               = $request->id;
        $language_id      = $request->language_id;
        $language_details = Language::find($language_id);

        if (!empty($language_id)) {
            $sms_languages                     = SmLanguage::find($id);
            $sms_languages->language_name      = $language_details->name != null ? $language_details->name : '';
            $sms_languages->language_universal = $language_details->code;
            $sms_languages->native             = $language_details->native;
            $sms_languages->lang_id            = $language_details->id;

            $results = $sms_languages->save();
            if ($results) {
                Toastr::success('Operation successful', 'Success');
                return redirect('language-settings');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }



    public function setEnvironmentValue()
    {

        $values['APP_LOCALE'] = 'en';
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $str .= "\n";
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }
        $str = substr($str, 0, -1);
        $res = file_put_contents($envFile, $str);
        return $res;
    }



    public function ajaxLanguageChange(Request $request)
    {
        $uni = $request->id;
        SmLanguage::where('active_status', 1)->update(['active_status' => 0]);

        $updateLang = SmLanguage::where('language_universal', $uni)->first();
        $updateLang->active_status = 1;
        $updateLang->update();

        $values['APP_LOCALE'] = $updateLang->language_universal;
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $str .= "\n";
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }
        $str = substr($str, 0, -1);
        $res = file_put_contents($envFile, $str);

        return response()->json([$updateLang]);
    }

    public function ajaxSubjectDropdown(Request $request)
    {
        $class_id = $request->class;
        $allSubjects = SmAssignSubject::where([['section_id', '=', $request->id], ['class_id', $class_id]])->get();

        $subjectsName = [];
        foreach ($allSubjects as $allSubject) {
            $subjectsName[] = SmSubject::find($allSubject->subject_id);
        }

        return response()->json([$subjectsName]);
    }

    public function languageAdd(Request $request)
    {


        $request->validate([
            'lang_id' => 'required|unique:sm_languages,lang_id|max:255',
        ]);
        $lang_id          = $request->lang_id;
        $language_details = DB::table('languages')->where('id', $lang_id)->first();

        if (!empty($language_details)) {
            $sms_languages                     = new SmLanguage();
            $sms_languages->language_name      = $language_details->name;
            $sms_languages->language_universal = $language_details->code;
            $sms_languages->native             = $language_details->native;
            $sms_languages->lang_id            = $language_details->id;
            $sms_languages->active_status      = '0';
            $results = $sms_languages->save();
            if ($results) {

                if (Schema::hasColumn('sm_language_phrases', $language_details->code)) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect('language-settings');
                } else {
                    if (DB::statement('ALTER TABLE sm_language_phrases ADD ' . $language_details->code . ' text')) {
                        $column = $language_details->code;
                        $all_translation_terms = SmLanguagePhrase::all();
                        $jsonArr = [];
                        foreach ($all_translation_terms as $row) {
                            $lid          = $row->id;
                            $english_term = $row->en;
                            if (!empty($english_term)) {
                                $update_translation_term                = SmLanguagePhrase::find($lid);
                                $update_translation_term->$column       = $english_term;
                                $update_translation_term->active_status = 1;
                                $update_translation_term->save();
                            }
                        }
                        $path = base_path() . '/resources/lang/' . $language_details->code;
                        if (!file_exists($path)) {
                            File::makeDirectory($path, $mode = 0777, true, true);
                            $newPath      = $path . 'lang.php';
                            $page_content = "<?php
               use App\SmLanguagePhrase;
               \$getData = SmLanguagePhrase::where('active_status',1)->get();
               \$LanguageArr=[];
               foreach (\$getData as \$row) {
                \$LanguageArr[\$row->default_phrases]=\$row->" . $language_details->code . ";
              }
              return \$LanguageArr;";
                            if (!file_exists($newPath)) {
                                File::put($path . '/lang.php', $page_content);
                            }
                        }
                        Toastr::success('Operation successful', 'Success');
                        return redirect('language-settings');
                    } else {
                        Toastr::error('Operation Failed', 'Failed');
                        return redirect()->back();
                    }
                }
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } //not empty language

    }

    //backupSettings
    public function backupSettings()
    {
        $sms_dbs = SmBackup::orderBy('id', 'DESC')->get();
        return view('backEnd.systemSettings.backupSettings', compact('sms_dbs'));
    }

    public function BackupStore(Request $request)
    {
        $request->validate([
            'content_file' => 'required|file',
        ]);

        if ($request->file('content_file') != "") {
            $file = $request->file('content_file');
            if ($file->getClientOriginalExtension() == 'sql') {
                $file_name = 'Restore_' . date('d_m_Y_') . $file->getClientOriginalName();
                $file->move('public/databaseBackup/', $file_name);
                $content_file = 'public/databaseBackup/' . $file_name;
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }

        if (isset($content_file)) {
            $store                = new SmBackup();
            $store->file_name     = $file_name;
            $store->source_link   = $content_file;
            $store->active_status = 1;
            $store->created_by    = Auth::user()->id;
            $store->updated_by    = Auth::user()->id;
            $result               = $store->save();
        }
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }

        $sms_dbs = SmBackup::orderBy('id', 'DESC')->get();
        return view('backEnd.systemSettings.backupSettings', compact('sms_dbs'));
    }

    public function languageSetup($language_universal)
    {
        $sms_languages = SmLanguagePhrase::where('active_status', 1)->get();
        $modules       = SmModule::all();

        return view('backEnd.systemSettings.languageSetup', compact('language_universal', 'sms_languages', 'modules'));
    }

    public function deleteDatabase($id)
    {
        $source_link = "";
        $data        = SmBackup::find($id);
        if (!empty($data)) {
            $source_link = $data->source_link;
            if (file_exists($source_link)) {
                unlink($source_link);
            }
        }
        $result = SmBackup::where('id', $id)->delete();
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    //download database from public/databaseBackup
    public function downloadDatabase($id)
    {
        $source_link = "";
        $data        = SmBackup::where('id', $id)->first();
        if (!empty($data)) {
            $source_link = $data->source_link;
            if (file_exists($source_link)) {
                unlink($source_link);
            }
        }

        if (file_exists($source_link)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($source_link) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($source_link));
            flush(); // Flush system output buffer
            readfile($source_link);
            return redirect()->back();
        }
    }

    //restore database from public/databaseBackup
    public function restoreDatabase($id)
    {
        $sm_db = SmBackup::where('id', $id)->first();
        if (!empty($sm_db)) {
            $source_link = $sm_db->source_link;
        }

        $DB_HOST     = env("DB_HOST", "");
        $DB_DATABASE = env("DB_DATABASE", "");
        $DB_USERNAME = env("DB_USERNAME", "");
        $DB_PASSWORD = env("DB_PASSWORD", "");

        $connection = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

        if (!file_exists($source_link)) {
            Toastr::error('File not found', 'Failed');
            return redirect()->back();
        }
        $handle   = fopen($source_link, "r+");
        $contents = fread($handle, filesize($source_link));
        $sql      = explode(';', $contents);
        $flag     = 0;
        foreach ($sql as $query) {
            $result = mysqli_query($connection, $query);
            if ($result) {
                $flag = 1;
            }
        }
        fclose($handle);

        if ($flag) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    //get files Backup #file
    public function getfilesBackup($id)
    {
        if ($id == 1) {
            $files             = base_path() . '/public/uploads';
            $created_file_name = 'Backup_' . date('d_m_Y_h:i') . '_Images.zip';
        } else if ($id == 2) {
            $files = base_path() . '';
            $created_file_name = 'Backup_' . date('d_m_Y_h:i') . '_Projects.zip';
        }

        \Zipper::make(public_path($created_file_name))->add($files)->close();

        $store                = new SmBackup();
        $store->file_name     = $created_file_name;
        $store->source_link   = public_path($created_file_name);
        $store->active_status = 1;
        $store->file_type     = $id;
        $store->created_by    = Auth::user()->id;
        $store->updated_by    = Auth::user()->id;
        $result               = $store->save();
        if ($id == 2) {
            return response()->download(public_path($created_file_name));
        }
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    // download Files #file
    public function downloadFiles($id)
    {

        $sm_db       = SmBackup::where('id', $id)->first();
        $source_link = $sm_db->source_link;
        if (@file_exists(@$source_link)) {
            return response()->download($source_link);
        } else {
            Toastr::error('File not found', 'Failed');
            return redirect()->back();
        }
    }

    public function getDatabaseBackup()
    {
        $DB_HOST     = env("DB_HOST", "");
        $DB_DATABASE = env("DB_DATABASE", "");
        $DB_USERNAME = env("DB_USERNAME", "");
        $DB_PASSWORD = env("DB_PASSWORD", "");
        $connection  = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

        $tables = array();
        $result = mysqli_query($connection, "SHOW TABLES");
        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }
        $return = '';
        foreach ($tables as $table) {
            $result     = mysqli_query($connection, "SELECT * FROM " . $table);
            $num_fields = mysqli_num_fields($result);

            $return .= 'DROP TABLE ' . $table . ';';
            $row2 = mysqli_fetch_row(mysqli_query($connection, "SHOW CREATE TABLE " . $table));
            $return .= "\n\n" . $row2[1] . ";\n\n";

            for ($i = 0; $i < $num_fields; $i++) {
                while ($row = mysqli_fetch_row($result)) {
                    $return .= "INSERT INTO " . $table . " VALUES(";
                    for ($j = 0; $j < $num_fields; $j++) {
                        $row[$j] = addslashes($row[$j]);
                        if (isset($row[$j])) {
                            $return .= '"' . $row[$j] . '"';
                        } else {
                            $return .= '""';
                        }
                        if ($j < $num_fields - 1) {
                            $return .= ',';
                        }
                    }
                    $return .= ");\n";
                }
            }
            $return .= "\n\n\n";
        }

        if (!file_exists('public/databaseBackup')) {
            mkdir('public/databaseBackup', 0777, true);
        }

        //save file
        $name   = 'database_backup_' . date('d_m_Y_h:i') . '.sql';
        $path   = 'public/databaseBackup/' . $name;
        $handle = fopen($path, "w+");
        fwrite($handle, $return);
        fclose($handle);

        $get_backup                = new SmBackup();
        $get_backup->file_name     = $name;
        $get_backup->source_link   = $path;
        $get_backup->active_status = 1;
        $get_backup->file_type     = 0;
        $results                   = $get_backup->save();

        // $sms_dbs = SmBackup::orderBy('id', 'DESC')->get();
        // return view('backEnd.systemSettings.backupSettings', compact('sms_dbs'));

        if ($results) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function updateClickatellData()
    {
        $gateway_id          = $_POST['gateway_id'];
        $clickatell_username = $_POST['clickatell_username'];
        $clickatell_password = $_POST['clickatell_password'];
        $clickatell_api_id   = $_POST['clickatell_api_id'];

        if ($gateway_id) {
            $gatewayDetails = SmSmsGateway::where('id', $gateway_id)->first();
            if (!empty($gatewayDetails)) {

                $gatewayDetailss                      = SmSmsGateway::find($gatewayDetails->id);
                $gatewayDetailss->clickatell_username = $clickatell_username;
                $gatewayDetailss->clickatell_password = $clickatell_password;
                $gatewayDetailss->clickatell_api_id   = $clickatell_api_id;
                $results                              = $gatewayDetailss->update();
            } else {

                $gatewayDetail                      = new SmSmsGateway();
                $gatewayDetail->clickatell_username = $clickatell_username;
                $gatewayDetail->clickatell_password = $clickatell_password;
                $gatewayDetail->clickatell_api_id   = $clickatell_api_id;
                $results                            = $gatewayDetail->save();
            }
        }

        if ($results) {
            echo "success";
        }
    }

    public function updateTwilioData()
    {

        $gateway_id                  = $_POST['gateway_id'];
        $twilio_account_sid          = $_POST['twilio_account_sid'];
        $twilio_authentication_token = $_POST['twilio_authentication_token'];
        $twilio_registered_no        = $_POST['twilio_registered_no'];

        if ($gateway_id) {
            $gatewayDetails = SmSmsGateway::where('id', $gateway_id)->first();
            if (!empty($gatewayDetails)) {

                $gatewayDetailss                              = SmSmsGateway::find($gatewayDetails->id);
                $gatewayDetailss->twilio_account_sid          = $twilio_account_sid;
                $gatewayDetailss->twilio_authentication_token = $twilio_authentication_token;
                $gatewayDetailss->twilio_registered_no        = $twilio_registered_no;
                $results                                      = $gatewayDetailss->update();
            } else {

                $gatewayDetail                              = new SmSmsGateway();
                $gatewayDetail->twilio_account_sid          = $twilio_account_sid;
                $gatewayDetail->twilio_authentication_token = $twilio_authentication_token;
                $gatewayDetail->twilio_registered_no        = $twilio_registered_no;
                $results                                    = $gatewayDetail->save();
            }
        }

        if ($results) {
            echo "success";
        }
    }

    public function updateMsg91Data(Request $request)
    {

        $gateway_id                   = $request->gateway_id;
        $msg91_authentication_key_sid = $request->msg91_authentication_key_sid;
        $msg91_route                  = $request->msg91_route;
        $msg91_country_code           = $request->msg91_country_code;
        $msg91_sender_id              = $request->msg91_sender_id;

        $key1 = 'MSG91_KEY';
        $key2 = 'MSG91_SENDER_ID';
        $key3 = 'MSG91_COUNTRY';
        $key4 = 'MSG91_ROUTE';

        $value1 = $msg91_authentication_key_sid;
        $value2 = $msg91_sender_id;
        $value3 = $msg91_country_code;
        $value4 = $msg91_route;

        $path            = base_path() . "/.env";
        $MSG91_KEY       = env($key1);
        $MSG91_SENDER_ID = env($key2);
        $MSG91_COUNTRY   = env($key3);
        $MSG91_ROUTE     = env($key4);

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "$key1=" . $MSG91_KEY,
                "$key1=" . $value1,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                "$key2=" . $MSG91_SENDER_ID,
                "$key2=" . $value2,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                "$key3=" . $MSG91_COUNTRY,
                "$key3=" . $value3,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                "$key4=" . $MSG91_ROUTE,
                "$key4=" . $value4,
                file_get_contents($path)
            ));
        }

        if ($gateway_id) {
            $gatewayDetails = SmSmsGateway::where('id', $gateway_id)->first();
            if (!empty($gatewayDetails)) {

                $gatewayDetailss                               = SmSmsGateway::find($gatewayDetails->id);
                $gatewayDetailss->msg91_authentication_key_sid = $msg91_authentication_key_sid;
                $gatewayDetailss->msg91_sender_id              = $msg91_sender_id;
                $gatewayDetailss->msg91_route                  = $msg91_route;
                $gatewayDetailss->msg91_country_code           = $msg91_country_code;
                $results                                       = $gatewayDetailss->update();
            } else {

                $gatewayDetail = new SmSmsGateway();

                $gatewayDetail->msg91_authentication_key_sid = $msg91_authentication_key_sid;
                $gatewayDetail->msg91_sender_id              = $msg91_sender_id;
                $gatewayDetail->msg91_route                  = $msg91_route;
                $gatewayDetail->msg91_country_code           = $msg91_country_code;

                $results = $gatewayDetail->save();
            }
        }

        if ($results) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function activeSmsService()
    {
        $sms_service = $_POST['sms_service'];

        if ($sms_service) {
            $gatewayDetailss = SmSmsGateway::where('active_status', '=', 1)
                ->update(['active_status' => 0]);
        }

        $gatewayDetails                = SmSmsGateway::find($sms_service);
        $gatewayDetails->active_status = 1;
        $results                       = $gatewayDetails->update();

        if ($results) {
            echo "success";
        }
    }

    public function generalSettingsView(Request $request)
    {
        $editData = SmGeneralSettings::find(1);

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {

            return ApiBaseMethod::sendResponse($editData, null);
        }
        return view('backEnd.systemSettings.generalSettingsView', compact('editData'));
    }

    public function updateGeneralSettings(Request $request)
    {
        $editData    = SmGeneralSettings::find(1);
        $session_ids = SmSession::where('active_status', 1)->get();
        $dateFormats = SmDateFormat::where('active_status', 1)->get();
        $languages   = SmLanguage::all();
        $countries   = SmCountry::select('currency')->groupBy('currency')->get();
        $currencies  = SmCurrency::all();
        $academic_years  = SmAcademicYear::all();
        $time_zones = SmTimeZone::all();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data                = [];
            $data['editData']    = $editData;
            $data['session_ids'] = $session_ids->toArray();
            $data['dateFormats'] = $dateFormats->toArray();
            $data['languages']   = $languages->toArray();
            $data['countries']   = $countries->toArray();
            $data['currencies']  = $currencies->toArray();
            $data['academic_years']  = $academic_years->toArray();
            return ApiBaseMethod::sendResponse($data, 'apply leave');
        }
        return view('backEnd.systemSettings.updateGeneralSettings', compact('editData', 'session_ids', 'dateFormats', 'languages', 'countries', 'currencies', 'academic_years', 'time_zones'));
    }

    public function updateGeneralSettingsData(Request $request)
    {

        $input = $request->all();

        $validator = Validator::make($input, [
            'school_name'     => "required",
            'site_title'      => "required",
            'phone'           => "required",
            'email'           => "required",
            'session_id'      => "required",
            'language_id'     => "required",
            'date_format_id'  => "required",
            'currency'        => "required",
            'currency_symbol' => "required",
            'school_code' => "required",
            'time_zone' => "required",

        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id                               = 1;
        $generalSettData                  = SmGeneralSettings::find($id);
        $generalSettData->school_name     = $request->school_name;
        $generalSettData->site_title      = $request->site_title;
        $generalSettData->school_code     = $request->school_code;
        $generalSettData->address         = $request->address;
        $generalSettData->phone           = $request->phone;
        $generalSettData->email           = $request->email;
        $generalSettData->session_id      = $request->session_id;
        $generalSettData->language_id     = $request->language_id;
        $generalSettData->date_format_id  = $request->date_format_id;
        $generalSettData->currency        = $request->currency;
        $generalSettData->currency_symbol = $request->currency_symbol;
        $generalSettData->time_zone_id = $request->time_zone;

        $generalSettData->copyright_text = $request->copyright_text;

        $results = $generalSettData->save();


        if ($generalSettData->timeZone != "") {
            $value1 = $generalSettData->timeZone->time_zone;



            $key1 = 'APP_TIMEZONE';

            $path            = base_path() . "/.env";
            $APP_TIMEZONE       = env($key1);

            if (file_exists($path)) {
                file_put_contents($path, str_replace(
                    "$key1=" . $APP_TIMEZONE,
                    "$key1=" . $value1,
                    file_get_contents($path)
                ));
            }
        }








        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            if ($results) {
                return ApiBaseMethod::sendResponse(null, 'General Settings has been updated successfully');
            } else {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
        } else {
            if ($results) {
                Toastr::success('Operation successful', 'Success');
                return redirect('general-settings');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }
    }

    public function updateSchoolLogo(Request $request)
    {

        // for upload School Logo
        if ($request->file('main_school_logo') != "") {
            $main_school_logo = "";
            $file             = $request->file('main_school_logo');
            $main_school_logo = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/settings/', $main_school_logo);
            $main_school_logo      = 'public/uploads/settings/' . $main_school_logo;
            $generalSettData       = SmGeneralSettings::find(1);
            $generalSettData->logo = $main_school_logo;
            $results               = $generalSettData->update();
        }
        // for upload School favicon
        else if ($request->file('main_school_favicon') != "") {
            $main_school_favicon = "";
            $file                = $request->file('main_school_favicon');
            $main_school_favicon = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/settings/', $main_school_favicon);
            $main_school_favicon      = 'public/uploads/settings/' . $main_school_favicon;
            $generalSettData          = SmGeneralSettings::find(1);
            $generalSettData->favicon = $main_school_favicon;
            $results                  = $generalSettData->update();
        } else {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('No change applied, please try again');
            }
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
        if ($results) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendResponse(null, 'Logo has been updated successfully');
            }
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Something went wrong, please try again');
            }
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function emailSettings()
    {
        $editData = SmEmailSetting::find(1);


        return view('backEnd.systemSettings.emailSettingsView', compact('editData'));
    }

    public function updateEmailSettingsData(Request $request)
    {

        $request->validate([
            'from_name'         => "required",
            'from_email'        => "required",
        ]);


        if (
            $request->mail_username == ''
            || $request->mail_password == ''
            || $request->mail_encryption == ''
            || $request->mail_port == ''
            || $request->mail_host == '' || $request->mail_driver == ''
        ) {
            Toastr::error('All Field in Smtp Details Must Be filled Up', 'Failed');
            return redirect()->back();
        }


        $key1 = 'MAIL_USERNAME';
        $key2 = 'MAIL_PASSWORD';
        $key3 = 'MAIL_ENCRYPTION';
        $key4 = 'MAIL_PORT';
        $key5 = 'MAIL_HOST';
        $key6 = 'MAIL_DRIVER';

        $value1 = $request->mail_username;
        $value2 = $request->mail_password;
        $value3 = $request->mail_encryption;
        $value4 = $request->mail_port;
        $value5 = $request->mail_host;
        $value6 = $request->mail_driver;

        $path                   = base_path() . "/.env";
        $MAIL_USERNAME          = env($key1);
        $MAIL_PASSWORD          = env($key2);
        $MAIL_ENCRYPTION        = env($key3);
        $MAIL_PORT              = env($key4);
        $MAIL_HOST              = env($key5);
        $MAIL_DRIVER              = env($key6);

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "$key1=" . $MAIL_USERNAME,
                "$key1=" . $value1,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                "$key2=" . $MAIL_PASSWORD,
                "$key2=" . $value2,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                "$key3=" . $MAIL_ENCRYPTION,
                "$key3=" . $value3,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                "$key4=" . $MAIL_PORT,
                "$key4=" . $value4,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                "$key5=" . $MAIL_HOST,
                "$key5=" . $value5,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                "$key6=" . $MAIL_DRIVER,
                "$key6=" . $value6,
                file_get_contents($path)
            ));
        }



        $emailSettingsData = SmEmailSetting::select('id')->where('active_status', 1)->first();

        if (!empty($emailSettingsData)) {

            $emailSettData                    = SmEmailSetting::find(1);
            $emailSettData->from_name         = $request->from_name;
            $emailSettData->from_email        = $request->from_email;

            $emailSettData->mail_driver     = $request->mail_driver;
            $emailSettData->mail_host     = $request->mail_host;
            $emailSettData->mail_port       = $request->mail_port;
            $emailSettData->mail_username         = $request->mail_username;
            $emailSettData->mail_password     = $request->mail_password;
            $emailSettData->mail_encryption     = $request->mail_encryption;

            $results                          = $emailSettData->update();
        }

        if ($results) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function paymentMethodSettings()
    {

        $statement                = "SELECT P.id as PID, D.id as DID, P.active_status as IsActive, P.method, D.* FROM sm_payment_methhods as P, sm_payment_gateway_settings D WHERE P.gateway_id=D.id";
        $PaymentMethods           = DB::select($statement);
        $paymeny_gateway          = SmPaymentMethhod::all();
        $paymeny_gateway_settings = SmPaymentGatewaySetting::all();

        return view('backEnd.systemSettings.paymentMethodSettings', compact('PaymentMethods', 'paymeny_gateway', 'paymeny_gateway_settings'));
    }

    public function updatePaymentGateway(Request $request)
    {

        $paymeny_gateway = [
            'gateway_name', 'gateway_username', 'gateway_password', 'gateway_signature', 'gateway_client_id', 'gateway_mode',
            'gateway_secret_key', 'gateway_secret_word', 'gateway_publisher_key', 'gateway_private_key'
        ];
        $count          = 0;
        $gatewayDetails = SmPaymentGatewaySetting::where('gateway_name', $request->gateway_name)->first();

        foreach ($paymeny_gateway as $input_field) {
            if (isset($request->$input_field) && !empty($request->$input_field)) {
                $gatewayDetails->$input_field = $request->$input_field;
            }
        }
        $results = $gatewayDetails->save();

        /*********** all ********************** */
        $WriteENV = SmPaymentGatewaySetting::all();
        foreach ($WriteENV as $row) {
            switch ($row->gateway_name) {
                case 'PayPal':

                    $key1 = 'PAYPAL_ENV';
                    $key2 = 'PAYPAL_API_USERNAME';
                    $key3 = 'PAYPAL_API_PASSWORD';
                    $key4 = 'PAYPAL_API_SECRET';

                    $value1 = $row->gateway_mode;
                    $value2 = $row->gateway_username;
                    $value3 = $row->gateway_password;
                    $value4 = $row->gateway_secret_key;

                    $path                = base_path() . "/.env";
                    $PAYPAL_ENV          = env($key1);
                    $PAYPAL_API_USERNAME = env($key2);
                    $PAYPAL_API_PASSWORD = env($key3);
                    $PAYPAL_API_SECRET   = env($key4);

                    if (file_exists($path)) {
                        file_put_contents($path, str_replace(
                            "$key1=" . $PAYPAL_ENV,
                            "$key1=" . $value1,
                            file_get_contents($path)
                        ));
                        file_put_contents($path, str_replace(
                            "$key2=" . $PAYPAL_API_USERNAME,
                            "$key2=" . $value2,
                            file_get_contents($path)
                        ));
                        file_put_contents($path, str_replace(
                            "$key3=" . $PAYPAL_API_PASSWORD,
                            "$key3=" . $value3,
                            file_get_contents($path)
                        ));
                        file_put_contents($path, str_replace(
                            "$key4=" . $PAYPAL_API_SECRET,
                            "$key4=" . $value4,
                            file_get_contents($path)
                        ));
                    }

                    break;
                case 'Stripe':

                    $key1 = 'PUBLISHABLE_KEY';
                    $key2 = 'SECRET_KEY';

                    $value1 = $row->gateway_publisher_key;
                    $value2 = $row->gateway_secret_key;

                    $path            = base_path() . "/.env";
                    $PUBLISHABLE_KEY = env($key1);
                    $SECRET_KEY      = env($key2);

                    if (file_exists($path)) {
                        file_put_contents($path, str_replace(
                            "$key1=" . $PUBLISHABLE_KEY,
                            "$key1=" . $value1,
                            file_get_contents($path)
                        ));
                        file_put_contents($path, str_replace(
                            "$key2=" . $SECRET_KEY,
                            "$key2=" . $value2,
                            file_get_contents($path)
                        ));
                    }

                    break;

                case 'Paystack':

                    $key1 = 'PAYSTACK_PUBLIC_KEY';
                    $key2 = 'PAYSTACK_SECRET_KEY';
                    $key3 = 'PAYSTACK_PAYMENT_URL';
                    $key4 = 'MERCHANT_EMAIL';

                    $value1 = $row->gateway_publisher_key;
                    $value2 = $row->gateway_secret_key;
                    $value3 = 'https://api.paystack.co';
                    $value4 = $row->gateway_username;

                    $path                 = base_path() . "/.env";
                    $PAYSTACK_PUBLIC_KEY  = env($key1);
                    $PAYSTACK_SECRET_KEY  = env($key2);
                    $PAYSTACK_PAYMENT_URL = env($key3);
                    $MERCHANT_EMAIL       = env($key4);

                    if (file_exists($path)) {
                        file_put_contents($path, str_replace(
                            "$key1=" . $PAYSTACK_PUBLIC_KEY,
                            "$key1=" . $value1,
                            file_get_contents($path)
                        ));
                        file_put_contents($path, str_replace(
                            "$key2=" . $PAYSTACK_SECRET_KEY,
                            "$key2=" . $value2,
                            file_get_contents($path)
                        ));
                        file_put_contents($path, str_replace(
                            "$key3=" . $PAYSTACK_PAYMENT_URL,
                            "$key3=" . $value3,
                            file_get_contents($path)
                        ));
                        file_put_contents($path, str_replace(
                            "$key4=" . $MERCHANT_EMAIL,
                            "$key4=" . $value4,
                            file_get_contents($path)
                        ));
                    }

                    break;
            }
        }

        /*********** all ********************** */

        if ($results) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function isActivePayment(Request $request)
    {
        //  dd($request->gateways[1]);

        $request->validate(
            [
                'gateways' => 'required|array',
            ],
            [
                'gateways.required' => 'At least one gateway required!',
            ]
        );

        $update = SmPaymentMethhod::where('active_status', '=', 1)->update(['active_status' => 0]);

        foreach ($request->gateways as $pid => $isChecked) {
            $results = SmPaymentMethhod::where('id', '=', $pid)->update(['active_status' => 1]);
        }

        if ($results) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function updatePaypalData()
    {
        $gateway_id       = $_POST['gateway_id'];
        $paypal_username  = $_POST['paypal_username'];
        $paypal_password  = $_POST['paypal_password'];
        $paypal_signature = $_POST['paypal_signature'];
        $paypal_client_id = $_POST['paypal_client_id'];
        $paypal_secret_id = $_POST['paypal_secret_id'];

        if ($gateway_id) {
            $gatewayDetails = SmPaymentGatewaySetting::where('id', $gateway_id)->first();
            if (!empty($gatewayDetails)) {

                $gatewayDetailss                   = SmPaymentGatewaySetting::find($gatewayDetails->id);
                $gatewayDetailss->paypal_username  = $paypal_username;
                $gatewayDetailss->paypal_password  = $paypal_password;
                $gatewayDetailss->paypal_signature = $paypal_signature;
                $gatewayDetailss->paypal_client_id = $paypal_client_id;
                $gatewayDetailss->paypal_secret_id = $paypal_secret_id;
                $results                           = $gatewayDetailss->update();
            } else {

                $gatewayDetail                   = new SmPaymentGatewaySetting();
                $gatewayDetail->paypal_username  = $paypal_username;
                $gatewayDetail->paypal_password  = $paypal_password;
                $gatewayDetail->paypal_signature = $paypal_signature;
                $gatewayDetail->paypal_client_id = $paypal_client_id;
                $gatewayDetail->paypal_secret_id = $paypal_secret_id;
                $results                         = $gatewayDetail->save();
            }
        }

        if ($results) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {

            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function updateStripeData()
    {
        $gateway_id            = $_POST['gateway_id'];
        $stripe_api_secret_key = $_POST['stripe_api_secret_key'];
        $stripe_publisher_key  = $_POST['stripe_publisher_key'];

        if ($gateway_id) {
            $gatewayDetails = SmPaymentGatewaySetting::where('id', $gateway_id)->first();
            if (!empty($gatewayDetails)) {

                $gatewayDetailss                        = SmPaymentGatewaySetting::find($gatewayDetails->id);
                $gatewayDetailss->stripe_api_secret_key = $stripe_api_secret_key;
                $gatewayDetailss->stripe_publisher_key  = $stripe_publisher_key;
                $results                                = $gatewayDetailss->update();
            } else {

                $gatewayDetail                        = new SmPaymentGatewaySetting();
                $gatewayDetail->stripe_api_secret_key = $stripe_api_secret_key;
                $gatewayDetail->stripe_publisher_key  = $stripe_publisher_key;
                $results                              = $gatewayDetail->save();
            }
        }

        if ($results) {
            echo "success";
        }
    }

    public function updatePayumoneyData()
    {
        $gateway_id       = $_POST['gateway_id'];
        $pay_u_money_key  = $_POST['pay_u_money_key'];
        $pay_u_money_salt = $_POST['pay_u_money_salt'];

        if ($gateway_id) {
            $gatewayDetails = SmPaymentGatewaySetting::where('id', $gateway_id)->first();
            if (!empty($gatewayDetails)) {

                $gatewayDetailss                   = SmPaymentGatewaySetting::find($gatewayDetails->id);
                $gatewayDetailss->pay_u_money_key  = $pay_u_money_key;
                $gatewayDetailss->pay_u_money_salt = $pay_u_money_salt;
                $results                           = $gatewayDetailss->update();
            } else {

                $gatewayDetail                   = new SmPaymentGatewaySetting();
                $gatewayDetail->pay_u_money_key  = $pay_u_money_key;
                $gatewayDetail->pay_u_money_salt = $pay_u_money_salt;
                $results                         = $gatewayDetail->save();
            }
        }

        if ($results) {
            echo "success";
        }
    }

    public function activePaymentGateway()
    {
        $gateway_id = $_POST['gateway_id'];

        if ($gateway_id) {
            $gatewayDetailss = SmPaymentGatewaySetting::where('active_status', '=', 1)
                ->update(['active_status' => 0]);
        }

        $results = SmPaymentGatewaySetting::where('gateway_name', '=', $gateway_id)
            ->update(['active_status' => 1]);

        if ($results) {
            echo "success";
        }
    }

    public function languageDelete(Request $request)
    {

        $delete_directory = SmLanguage::find($request->id);

        DB::beginTransaction();

        try {

            if (DB::statement('ALTER TABLE sm_language_phrases DROP COLUMN ' . $delete_directory->language_universal)) {
                if ($delete_directory) {
                    $path = base_path() . '/resources/lang/' . $delete_directory->language_universal;
                    if (file_exists($path)) {
                        File::delete($path . '/lang.php');
                        rmdir($path);
                    }
                    $result = SmLanguage::destroy($request->id);
                    if ($result) {
                        Toastr::success('Operation successful', 'Success');
                        return redirect()->back();
                    }
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            } //end drop table column

            DB::commit();
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function changeLocale($locale)
    {
        Session::put('locale', $locale);
        return redirect()->back();
    }

    public function changeLanguage($id)
    {
        SmLanguage::where('active_status', '=', 1)->update(['active_status' => 0]);
        $language                = SmLanguage::find($id);
        $language->active_status = 1;
        $language->save();
        Session::flash('langChange', 'Successfully Language Changed');
        return redirect()->to('locale/' . $language->language_universal);
    }

    public function getTranslationTerms(Request $request)
    {
        $terms = SmLanguagePhrase::where('modules', $request->id)->get();
        return response()->json($terms);
    }

    public function translationTermUpdate(Request $request)
    {

        $request->validate(
            [
                'module_id' => 'required',
                'language_universal' => 'required',
            ],
            [
                'module_id.required' => 'Please select at least one module',
            ]
        );


        $InputId            = $request->InputId;
        $language_universal = $request->language_universal;
        $LU                 = $request->LU;

        foreach ($InputId as $id) {
            $data                      = SmLanguagePhrase::find($id);
            $data->$language_universal = $LU[$id];
            $data->save();
        }
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    //Update System is Availalbe

    public function recurse_copy($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    //Update System
    public function UpdateSystem()
    {
        // $client = new Client(); 
        // $r = $client->request('GET', 'https://infixedu.com/api/getSystemVersion'); 
        // $info         = $r->getBody()->getContents();
        // $versionInfo  = json_decode($info, true);
        // $version_name = $versionInfo['data']['SystemVersion']['version_name'];
        // $title        = $versionInfo['data']['SystemVersion']['title'];
        // $features     = $versionInfo['data']['SystemVersion']['features']; 
        // $existing = SmGeneralSettings::find(1);
        // $existing_version = $existing->system_version;
        if (file_exists('version.php')) {
            $data = file_get_contents('version.php');
        } else {
            $data = 'You are using old version, please upgrade.';
        }
        return view('backEnd.systemSettings.updateSettings', compact('data'));
    }

    public function admin_UpdateSystem(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'file' => "required",
        ]);


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $fileName = "";
        if ($request->file('file') != "") {
            $file = $request->file('file');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/', $fileName);
            $fileName =  'public/' . $fileName;
        }

        if (!file_exists('upgradeFiles')) {
            mkdir('upgradeFiles', 0777, true);
        }

        $zip = new ZipArchive;
        $res = $zip->open($fileName);
        if ($res === TRUE) {
            $zip->extractTo('upgradeFiles/');
            $zip->close();
        } else {
            return 'ops! sorry.';
        }

        $data = SmGeneralSettings::find(1);
        $data->system_version = $request->version_name;
        $data->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    public function UpgradeSettings(Request $request)
    {
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    public function ajaxSelectCurrency(Request $request)
    {

        $select_currency_symbol = SmCurrency::select('symbol')->where('code', '=', $request->id)->first();

        $currency_symbol['symbol'] = $select_currency_symbol->symbol;

        return response()->json([$currency_symbol]);
    }

    //ajax theme Style Active
    public function themeStyleActive(Request $request)
    {
        if ($request->id) {
            $modified = SmStyle::where('is_active', 1)->update(array('is_active' => 0));
            $selected = SmStyle::findOrFail($request->id);
            $selected->is_active = 1;
            $selected->save();
            return response()->json([$modified]);
        } else {
            return '';
        }
    }

    //ajax theme Style Active
    public function themeStyleRTL(Request $request)
    {
        if ($request->id) {
            $selected = SmGeneralSettings::find(1);
            $selected->ttl_rtl = $request->id;
            $selected->save();
            return response()->json([$selected]);
        } else {
            return '';
        }
    }

    /* ******************************** homePageBackend ******************************** */
    public function homePageBackend()
    {
        $links      = SmHomePageSetting::find(1);
        $permisions = SmFrontendPersmission::where('parent_id', 1)->get();
        return view('backEnd.systemSettings.homePageBackend', compact('links', 'permisions'));
    }

    public function homePageUpdate(Request $request)
    {
        $request->validate([
            'title'             => 'required',
            'long_title'        => 'required',
            'short_description' => 'required',
            'permisions'        => 'required|array',
        ]);

        $permisionsArray = $request->permisions;
        $permisions      = SmFrontendPersmission::where('parent_id', 1)->update(['is_published' => 0]);
        foreach ($permisionsArray as $value) {
            $permisions = SmFrontendPersmission::where('id', $value)->update(['is_published' => 1]);
        }

        $image = "";
        if ($request->file('image') != "") {
            $file       = $request->file('image');
            $image_name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $path       = 'public/uploads/homepage';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file->move($path . '/', $image_name);
            $image = $path . '/' . $image_name;
        }

        //Update Home Page
        $update                    = SmHomePageSetting::find(1);
        $update->title             = $request->title;
        $update->long_title        = $request->long_title;
        $update->short_description = $request->short_description;
        $update->link_label        = $request->link_label;
        $update->link_url          = $request->link_url;
        if ($request->file('image') != "") {
            $update->image = $image;
        }
        $result = $update->save();

        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    /* ******************************** homePageBackend ******************************** */

    /* ******************************** customLinks ******************************** */

    public function customLinks()
    {
        $links = SmCustomLink::find(1);
        return view('backEnd.systemSettings.customLinks', compact('links'));
    }
    public function customLinksUpdate(Request $request)
    {

        $links = SmCustomLink::find(1);
        $lists = ['title1', 'link_label1', 'link_href1', 'link_label2', 'link_href2', 'link_label3', 'link_href3', 'link_label4', 'title2', 'link_href4', 'link_label5', 'link_href5', 'link_label6', 'link_href6', 'link_label7', 'link_href7', 'link_label8', 'link_href8', 'title3', 'link_label9', 'link_href9', 'link_label10', 'link_href10', 'link_label11', 'link_href11', 'link_label12', 'link_href12', 'title4', 'link_label13', 'link_href13', 'link_label14', 'link_href14', 'link_label15', 'link_href15', 'link_label16', 'link_href16', 'facebook_url', 'twitter_url', 'dribble_url', 'behance_url'];

        foreach ($lists as $list) {
            if (isset($request->$list)) {
                $links->$list = $request->$list;
            }
            $result = $links->save();
        }

        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    /* ******************************** customLinks ******************************** */

    public function getSystemVersion(Request $request)
    {
        $version = SmSystemVersion::find(1);
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data['SystemVersion'] = $version;
            return ApiBaseMethod::sendResponse($data, null);
        }
    }

    public function getSystemUpdate(Request $request, $version_upgrade_id = null)
    {
        $data = [];
        if (Schema::hasTable('sm_update_files')) {
            $version = DB::table('sm_update_files')->where('version_name', $version_upgrade_id)->first();
            if (!empty($version->path)) {
                $url = url('/') . '/' . $version->path;
                header("Location: " . $url);
                die();
            } else {
                return redirect()->back();
            }
        }
        return redirect()->back();
    }

    public function apiPermission()
    {

        if (!Schema::hasColumn('sm_general_settings', 'api_url')) {
            Schema::table('sm_general_settings', function ($table) {
                $table->integer('api_url')->default(0)->nullable();
            });
        }
        $settings = SmGeneralSettings::find(1);

        return view('backEnd.systemSettings.apiPermission', compact('settings'));
    }





    public function apiPermissionUpdate(Request $request)
    {
        if ($request->status == 'on') {
            $status = 1;
        } else {
            $status = 0;
        }


        $user = SmGeneralSettings::find(1);
        $user->api_url = $status;
        $user->save();

        return response()->json($user);
    }





    /*** RTL TTL ***/

    public function create_a_dynamic_column($table_name, $column_name, $column_type, $column_limit)
    {
        try {
            if (!Schema::hasColumn($table_name, $column_name)) {
                Schema::table($table_name, function ($table) {
                    $table->$column_type($column_name, $column_limit)->nullable();
                });
                return true;
            } else {
                return true;
            }
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    public function enable_rtl(Request $request)
    {
        if ($this->create_a_dynamic_column('sm_general_settings', 'ttl_rtl', 'integer', 11)) {
            $s = SmGeneralSettings::find(1);
            $s->ttl_rtl = $request->status;
            $s->save();
            return response()->json($s);
        } else {
            $s['flag'] = false;
            $s['message'] = 'something went wrong!!';
            return response()->json($s);
        }
    }
}
