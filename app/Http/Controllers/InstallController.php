<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SmGeneralSettings;
use DB;
use App\User;
use App\Quotation;
use Session;
use App\Envato\Envato;
use Hash;
use App\SmStaff;
use GuzzleHttp\Client;

class InstallController extends Controller
{

    //step1
    public function index()
    {

        if (\Schema::hasTable('users')) {
            $testInstalled = DB::table('users')->get();
            if (count($testInstalled) < 1) {
                Session::put('step1', 1);
                return view('install.welcome_to_infix');
            } else {
                return redirect('login');
            }
        } else {
            Session::put('step1', 1);
            return view('install.welcome_to_infix');
        }
    }

    public function confirmation()
    {
        return view('install.confirmation');
    }


    public function CheckPurchaseVerificationPage()
    {
        if (Session::get('step1') != 1) {
            return redirect('install');
        }

        if (\Schema::hasTable('sm_general_settings')) {
            $GetData = DB::table('sm_general_settings')->find(1);
            if (empty($GetData)) {
                return view('install.check_purchase_page');
            } else {
                $envatouser = $GetData->envato_user;
                $purchasecode = $GetData->system_purchase_code;
                $domain = $GetData->system_domain;

                $UserData = Envato::verifyPurchase($purchasecode);
                if (!empty($UserData['verify-purchase']['item_id']) && (User::$item == $UserData['verify-purchase']['item_id'])) {

                    $setting                        = new SmGeneralSettings();
                    $setting->system_domain         = $domain;
                    $setting->envato_user           = $envatouser;
                    $setting->system_purchase_code  = $purchasecode;
                    $setting->envato_item_id        = $UserData['verify-purchase']['item_id'];
                    $setting->system_activated_date = date('Y-m-d');
                    $setting->save();


                    Session::put('envatouser', $envatouser);
                    Session::put('purchasecode', $purchasecode);
                    Session::put('domain', $domain);
                    Session::put('item_id', $UserData['verify-purchase']['item_id']);



                    \Session::flash("message-success", "Congratulations! Your Purchase code already verified.");
                    return redirect()->back();
                } else {
                    \Session::flash("message-danger", "Ops! Purchase Code is not valid. Please try again.");
                    return view('install.check_purchase_page');
                }
            }
        } else {
            return view('install.check_purchase_page');
        }
    }

    public function is_valid_domain_name($domain_name)
    {
		return TRUE;
    }
    public function CheckVerifiedInput(Request $request)
    {

        $request->validate([
            'envatouser' => 'required',
            'purchasecode' => 'required',
            'installationdomain' => 'required',
        ]);

            $envatouser = htmlspecialchars($request->input('envatouser'));
            $purchasecode = htmlspecialchars($request->input('purchasecode'));
            $domain = htmlspecialchars($request->input('installationdomain'));

            $UserData = Envato::verifyPurchase($purchasecode);

            Session::put('CheckVerifiedInput', 'success');
            \Session::flash("message-success", "Congratulations! Purchase code is verified. ProWebber.ru");
            return redirect('check-environment');

    }



    public function installStep2(Request $request)
    {

        $database_Name = $request->input('database_name');
        $database_user = $request->input('database_user');
        $database_password = $request->input('database_password');

        //$servername = 'localhost';
        // $connect = mysqli_connect($servername, $database_user, $database_password, $database_Name);
        // $connect = new mysqli($servername, $database_user, $database_password, $database_Name);


        $key1 = 'DB_DATABASE';
        $key2 = 'DB_USERNAME';
        $key3 = 'DB_PASSWORD';
        $value = $database_Name;
        $value2 = $database_user;
        $value3 = $database_password;

        $path = base_path() . "/.env";
        $DB_DATABASE = env($key1);
        $DB_USERNAME = env($key2);
        $DB_PASSWORD = env($key3);


        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "$key1=" . $DB_DATABASE,
                "$key1=" . $value,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                "$key2=" . $DB_USERNAME,
                "$key2=" . $value2,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                "$key3=" . $DB_PASSWORD,
                "$key3=" . $value3,
                file_get_contents($path)
            ));
        } else {
            \Session::flash("message-danger", "Ops! .env file is not found ! Please check your project.");
            return redirect('/install2');
        }


        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            \Session::flash("message-danger", "Ops! Could not connect to the database.  Please check your configuration.");
            return redirect('/install2');
        }

        Session::put('install2', 'success');
        return redirect('/install3');
    }

    public function checkEnvironmentPage()
    {

        $path = '';
        $folders = array(
            $path . "/route",
            $path . "/resources",
            $path . "/public",
            $path . "/storage",
        );
        return view('install.checkEnvironmentPage')->with('folders', $folders);
    }

    public function checkEnvironment(Request $request)
    {
        $path = '';
        $folders = array(
            $path . "/route",
            $path . "/resources",
            $path . "/public",
            $path . "/storage",
        );


        if (phpversion() >= '7.1' && OPENSSL_VERSION_NUMBER > 0x009080bf && extension_loaded('mbstring') && extension_loaded('tokenizer') && extension_loaded('xml') && extension_loaded('ctype')  && extension_loaded('json')) {
            Session::put('install3', 'success');
            return redirect('system-setup-page');
        } else {
            \Session::flash("message-danger", "Ops! Extension are disabled.  Please check requirements!");
            return redirect()->back()->with("message-danger", "Ops! Extension are disabled.  Please check requirements!");
        }
    }

    public function systemSetupPage()
    {
        return view('install.systemSetupPage');
    }

    public function confirmInstalling(Request $request)
    {
        set_time_limit(900);

        // dd($request->input());

        $this->validate($request, [
            'institution_name' => 'required',
            'institution_code' => 'required',
            'institution_address' => 'required',
            'session_year' => 'required',
            'system_admin_email' => 'required',
            'system_admin_password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);


        Session::put('system_admin_email', $request->system_admin_email);
        Session::put('system_admin_password', $request->system_admin_password);




        \Artisan::call('migrate:refresh');
        if ($request->install_mode == 1) {
            \Artisan::call('db:seed');
        }



        if (\Schema::hasTable('migrations')) {
            $migration = DB::table('migrations')->get();
            if (count($migration) > 0) {
                $id = 1;
                $is_existing_settings = SmGeneralSettings::find($id);
                if ($is_existing_settings != "") {
                    $is_existing_settings->school_name = $request->input('institution_name');
                    $is_existing_settings->school_code = $request->input('institution_code');
                    $is_existing_settings->address = $request->input('institution_address');
                    $is_existing_settings->session_year = $request->input('session_year');
                    $is_existing_settings->language_id = $request->input('currency_format');
                    $is_existing_settings->currency = $request->input('institution_name');
                    $is_existing_settings->system_purchase_code = Session::get('purchasecode');


                    $is_existing_settings->save();
                } else {
                    $setting = new SmGeneralSettings();
                    $setting->school_name = $request->input('institution_name');
                    $setting->school_code = $request->input('institution_code');
                    $setting->address = $request->input('institution_address');
                    $setting->session_year = $request->input('session_year');
                    $setting->language_id = $request->input('language_select');
                    $setting->currency = $request->input('currency_format');
                    $setting->system_purchase_code = Session::get('purchasecode');
                    $setting->save();
                }

                $user = User::find(1);
                if (empty($user)) {
                    $user = new User();
                }
                $user->role_id = 1;
                $user->username = $request->input('system_admin_email');
                $user->full_name = 'system administrator';
                $user->email = $request->input('system_admin_email');
                $user->password = Hash::make($request->input('system_admin_password'));
                $user->save();
                $user->toArray();



                $staff = SmStaff::find(1);
                if (empty($staff)) {
                    $staff = new SmStaff();
                }
                $staff->user_id  = $user->id;
                $staff->role_id  = 1;
                $staff->staff_no  = 1;
                $staff->designation_id  = 1;
                $staff->department_id  = 1;
                $staff->first_name  = 'System';
                $staff->last_name  = 'Administrator';
                $staff->full_name  = 'System Administrator';
                $staff->fathers_name  = 'NA';
                $staff->mothers_name  = 'NA';

                $staff->date_of_birth  = '1980-12-26';
                $staff->date_of_joining  = '2019-05-26';

                $staff->gender_id  = 1;
                $staff->email  = $request->input('system_admin_email');
                $staff->mobile  = '+880123456790';
                $staff->emergency_mobile  = '+880123456790';
                $staff->merital_status  = 'NA';
                $staff->staff_photo  = 'public/uploads/staff/staff.jpg';


                $staff->current_address  = 'NA';
                $staff->permanent_address  = 'NA';
                $staff->qualification  = 'NA';
                $staff->experience  = 'NA';



                $staff->casual_leave  = '12';
                $staff->medical_leave  = '15';
                $staff->metarnity_leave  = '45';


                $staff->driving_license  = '56776987453';
                $staff->driving_license_ex_date  = '2019-02-23';
                $staff->save();

                if (!empty($user)) {
                    return redirect('confirmation');
                } else {
                    \Artisan::call('migrate:reset');
                    return redirect()->back();
                }
            }
        }
    }


    public function verifiedCode()
    {
        if (\Schema::hasTable('sm_general_settings')) {
            $GetData = DB::table('sm_general_settings')->find(1);
            if (!empty($GetData)) {
                $UserData = Envato::verifyPurchase($GetData->system_purchase_code);
                if (!empty($UserData['verify-purchase']['item_id']) && (User::$item == $UserData['verify-purchase']['item_id'])) {
                    return redirect('/login');
                }
            } else {
                return view('install.verified_code');
            }
        } else {
            return redirect('install');
        }
    }

    public function verifiedCodeStore(Request $request)
    {
        $envatouser = htmlspecialchars($request->input('envatouser'));
        $purchasecode = htmlspecialchars($request->input('purchasecode'));
        $domain = htmlspecialchars($request->input('installationdomain'));

        $obj = Envato::verifyPurchase($purchasecode);


        if (!empty($obj)) {
            foreach ($obj as $data) {
                if (!empty($data['item_id'])) {

                    $setting = SmGeneralSettings::first();
                    $setting->system_domain = $domain;
                    $setting->envato_user = $envatouser;
                    $setting->system_purchase_code = $purchasecode;
                    $setting->envato_item_id = $data['item_id'];
                    $setting->system_activated_date = date('Y-m-d');
                    $setting->save();

                    $url = Session::get('url');

                    return redirect($url);
                }
            }
        } else {
            \Session::flash("message-danger", "Ops! Purchase Code is not vaild. Please try again.");
            return redirect()->back();
        }
        \Session::flash("message-danger", "Ops! Purchase Code is not vaild. Please try again.");
        return redirect()->back();
    }




    // public function verifiedCodeStore(Request $request){
    //     $client = new Client(); 
    //     $email = htmlspecialchars($request->input('email'));
    //     $purchase_code = htmlspecialchars($request->input('purchase_code'));
    //     $domain = htmlspecialchars($request->input('purchase_domain')); 
    //     $product_info = $client->request('GET', 'http://salespanel.infixedu.com/api/installation/'.$purchase_code.'/'.$domain.'/'.$email); 
    //     $product_info = $product_info->getBody()->getContents(); 
    //     $product_info = json_decode($product_info);  

    //     if($product_info->data->product_info != ""){ 
    //         $res = $client->request('GET', 'http://salespanel.infixedu.com/api/verified/email/'.$purchase_code.'/'.$email); 
    //         return redirect('login');

    //     }else{

    //         \Session::flash("message-danger", "Ops! Purchase Code is not vaild. Please try again.");
    //         return redirect()->back();

    //     }
    // }


}
