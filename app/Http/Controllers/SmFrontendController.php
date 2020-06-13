<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use App\User;
use App\SmExam;
use App\SmNews;
use App\SmClass;
use App\SmEvent;
use App\SmStaff;
use App\SmCourse;
use App\SmSection;
use App\SmStudent;
use App\SmSubject;
use App\SmVisitor;
use App\SmExamType;
use App\SmAboutPage;
use App\SmExamSetup;
use App\SmMarkStore;
use App\SmCustomLink;
use App\SmContactPage;
use App\SmNoticeBoard;
use App\SmResultStore;
use App\SmTestimonial;
use App\SmContactMessage;
use App\SmGeneralSettings;
use App\SmHomePageSetting;
use Illuminate\Http\Request;
use App\SmFrontendPersmission;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;

class SmFrontendController extends Controller
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
    public function index()
    {


        if (\Schema::hasTable('users')) {
            $testInstalled = DB::table('users')->get();
            if (count($testInstalled) < 1) {
                return view('install.welcome_to_infix');
            } else {
                $exams = SmExam::all();
                $news = SmNews::orderBy('order', 'asc')->limit(3)->get();
                $testimonial = SmTestimonial::all();
                $academics = SmCourse::orderBy('id', 'asc')->limit(3)->get();
                $exams_types = SmExamType::all();
                $events = SmEvent::all();
                $a = 2;
                $b = 3;
                $c = 9;
                $notice_board = SmNoticeBoard::where('is_published', 1)->orderBy('created_at', 'DESC')->take(3)->get();
                $classes = SmClass::where('active_status', 1)->get();
                $subjects = SmSubject::where('active_status', 1)->get();
                $sections = SmSection::where('active_status', 1)->get();
                $links = SmCustomLink::find(1);
                $homePage = SmHomePageSetting::find(1);
                $permisions = SmFrontendPersmission::where([['parent_id', 1], ['is_published', 1]])->get();
                $per = [];
                foreach ($permisions as $permision) {
                    $per[$permision->name] = 1;
                }
                return view('frontEnd.home.light_home', compact('exams', 'classes', 'subjects', 'exams_types', 'sections', 'news', 'testimonial', 'notice_board', 'events', 'academics', 'links', 'homePage', 'per'));
            }
        } else {
            return view('install.welcome_to_infix');
        }
    }


    public function about()
    {
        $exams = SmExam::all();
        $exams_types = SmExamType::all();
        $classes = SmClass::where('active_status', 1)->get();
        $subjects = SmSubject::where('active_status', 1)->get();
        $sections = SmSection::where('active_status', 1)->get();
        $about = SmAboutPage::first();
        $testimonial = SmTestimonial::all();
        $totalStudents = SmStudent::where('active_status', 1)->get();
        $totalTeachers = SmStaff::where('active_status', 1)->where('role_id', 4)->get();
        $history = SmNews::where('category_id', 2)->limit(3)->get();
        $mission = SmNews::where('category_id', 3)->limit(3)->get();
        return view('frontEnd.home.light_about', compact('exams', 'classes', 'subjects', 'exams_types', 'sections', 'about', 'testimonial', 'totalStudents', 'totalTeachers', 'history', 'mission'));
    }


    public function news()
    {
        $exams = SmExam::all();
        $exams_types = SmExamType::all();
        $classes = SmClass::where('active_status', 1)->get();
        $subjects = SmSubject::where('active_status', 1)->get();
        $sections = SmSection::where('active_status', 1)->get();
        return view('frontEnd.home.light_news', compact('exams', 'classes', 'subjects', 'exams_types', 'sections'));
    }


    public function contact()
    {
        $exams = SmExam::all();
        $exams_types = SmExamType::all();
        $classes = SmClass::where('active_status', 1)->get();
        $subjects = SmSubject::where('active_status', 1)->get();
        $sections = SmSection::where('active_status', 1)->get();

        $contact_info = SmContactPage::first();
        return view('frontEnd.home.light_contact', compact('exams', 'classes', 'subjects', 'exams_types', 'sections', 'contact_info'));
    }

    public function newsDetails($id)
    {
        $news = SmNews::find($id);
        $otherNews = SmNews::orderBy('id', 'asc')->whereNotIn('id', [$id])->limit(3)->get();
        $a = 2;
        $b = 3;
        $c = 9;
        $notice_board = SmNoticeBoard::where(function ($query) use ($a, $b, $c) {
            $query->where('inform_to', '=', $a)
                ->orWhere('inform_to', '=', $b)
                ->orWhere('inform_to', '=', $c);
        })->get();
        return view('frontEnd.home.light_news_details', compact('news', 'notice_board', 'otherNews'));
    }

    public function newsPage()
    {
        $news = SmNews::all();
        return view('frontEnd.home.light_news', compact('news'));
    }


    public function conpactPage()
    {
        $contact_us = SmContactPage::first();

        return view('frontEnd.contact_us', compact('contact_us'));
    }

    public function contactPageEdit()
    {
        $contact_us = SmContactPage::first();
        $update = "";

        return view('frontEnd.contact_us', compact('contact_us', 'update'));
    }

    public function contactPageStore(Request $request)
    {


        if ($request->file('image') == "") {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'button_text' => 'required',
                'button_url' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'google_map_address' => 'required'
            ]);
        } else {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'button_text' => 'required',
                'button_url' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'google_map_address' => 'required',
                'image' => 'dimensions:min_width=1420,min_height=450'
            ]);
        }


        $fileName = "";
        if ($request->file('image') != "") {
            $contact = SmContactPage::find(1);
            if ($contact != "") {
                if ($contact->image != "") {
                    if (file_exists($contact->image)) {
                        unlink($contact->image);
                    }
                }
            }

            $file = $request->file('image');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/contactPage/', $fileName);
            $fileName = 'public/uploads/contactPage/' . $fileName;
        }

        $contact = SmContactPage::first();
        if ($contact == "") {
            $contact = new SmContactPage();
        }
        $contact->title = $request->title;
        $contact->description = $request->description;
        $contact->button_text = $request->button_text;
        $contact->button_url = $request->button_url;

        $contact->address = $request->address;
        $contact->address_text = $request->address_text;
        $contact->phone = $request->phone;
        $contact->phone_text = $request->phone_text;
        $contact->email = $request->email;
        $contact->email_text = $request->email_text;
        $contact->latitude = $request->latitude;
        $contact->longitude = $request->longitude;
        $contact->google_map_address = $request->google_map_address;
        if ($fileName != "") {
            $contact->image = $fileName;
        }


        $result = $contact->save();

        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect('contact-page');
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function aboutPage()
    {
        $about_us = SmAboutPage::first();

        return view('frontEnd.about_us', compact('about_us'));
    }

    public function aboutPageEdit()
    {
        $about_us = SmAboutPage::first();
        $update = "";

        return view('frontEnd.about_us', compact('about_us', 'update'));
    }

    public function aboutPageStore(Request $request)
    {

        if ($request->file('image') == "" && $request->file('main_image') == "") {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'main_title' => 'required',
                'main_description' => 'required',
                'button_text' => 'required',
                'button_url' => 'required',
            ]);
        } elseif ($request->file('image') != "" && $request->file('main_image') != "") {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'main_title' => 'required',
                'main_description' => 'required',
                'button_text' => 'required',
                'button_url' => 'required',
                'image' => 'dimensions:min_width=1420,min_height=450',
                'main_image' => 'dimensions:min_width=1420,min_height=450'
            ]);
        } elseif ($request->file('image') != "" && $request->file('main_image') == "") {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'main_title' => 'required',
                'main_description' => 'required',
                'button_text' => 'required',
                'button_url' => 'required',
                'image' => 'dimensions:min_width=1420,min_height=450'
            ]);
        } elseif ($request->file('image') == "" && $request->file('main_image') != "") {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'main_title' => 'required',
                'main_description' => 'required',
                'button_text' => 'required',
                'button_url' => 'required',
                'main_image' => 'dimensions:min_width=1420,min_height=450'
            ]);
        }

        $fileName = "";
        if ($request->file('image') != "") {
            $about = SmAboutPage::find(1);
            if ($about != "") {
                if ($about->image != "") {
                    if (file_exists($about->image)) {
                        unlink($about->image);
                    }
                }
            }

            $file = $request->file('image');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/about_page/', $fileName);
            $fileName = 'public/uploads/about_page/' . $fileName;
        }

        $mainfileName = "";
        if ($request->file('main_image') != "") {
            $about = SmAboutPage::find(1);
            if ($about != "") {
                if ($about->main_image != "") {
                    if (file_exists($about->main_image)) {
                        unlink($about->main_image);
                    }
                }
            }

            $file = $request->file('main_image');
            $mainfileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/about_page/', $mainfileName);
            $mainfileName = 'public/uploads/about_page/' . $mainfileName;
        }

        $about = SmAboutPage::first();
        if ($about == "") {
            $about = new SmAboutPage();
        }
        $about->title = $request->title;
        $about->description = $request->description;
        $about->main_title = $request->main_title;
        $about->main_description = $request->main_description;
        $about->button_text = $request->button_text;
        $about->button_url = $request->button_url;
        if ($fileName != "") {
            $about->image = $fileName;
        }
        if ($mainfileName != "") {
            $about->main_image = $mainfileName;
        }
        $result = $about->save();

        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect('about-page');
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['subject'] = $request->subject;
        $data['message'] = $request->message;


        DB::beginTransaction();
        try {

            $contact_message = new SmContactMessage();
            $contact_message->name = $request->name;
            $contact_message->email = $request->email;
            $contact_message->subject = $request->subject;
            $contact_message->message = $request->message;
            $contact_message->address = $request->address;
            $contact_message->address_text = $request->address_text;
            $contact_message->phone = $request->phone;
            $contact_message->phone_text = $request->phone_text;
            $contact_message->email = $request->email;
            $contact_message->email_text = $request->email_text;
            $contact_message->save();

            Mail::send('frontEnd.contact_mail', compact('data'), function ($message) use ($request) {

                $setting = SmGeneralSettings::find(1);
                $email = $setting->email;
                $school_name = $setting->school_name;
                $message->to($email, $school_name)->subject($request->subject);
                $message->from($email, $school_name);
            });

            DB::commit();
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function contactMessage(Request $request)
    {
        $contact_messages = SmContactMessage::orderBy('id', 'desc')->get();

        return view('frontEnd.contact_message', compact('contact_messages'));
    }


    //user register method start
    public function register()
    {
        return view('frontEnd.register');
    }


    public function customer_register(Request $request)
    {

        $request->validate([
            'fullname' => 'required|min:3|max:100',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);
        //insert data into user table 
        $customer_register = new User();
        $customer_register->role_id = 10;
        $customer_register->full_name = $request->fullname;
        $customer_register->username = $request->email;
        $customer_register->email = $request->email;
        $customer_register->password = Hash::make($request->password);
        $customer_register->save();
        $result = $customer_register->toArray();
        $last_id = $customer_register->id;           //last id of user table

        //insert data into staff table 
        $staff_register = new SmStaff();
        $staff_register->school_id = 1;
        $staff_register->user_id = $last_id;
        $staff_register->role_id = 10;
        $staff_register->first_name = $request->fullname;
        $staff_register->full_name = $request->fullname;
        $staff_register->last_name = '';
        $staff_register->staff_no = 10;
        $staff_register->email = $request->email;
        $staff_register->save();

        $result = $staff_register->toArray();
        if (!empty($result)) {
            Toastr::success('Operation successful', 'Success');
            return redirect('login');
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function course()
    {
        $exams = SmExam::all();
        $course = SmCourse::all();
        $news = SmNews::orderBy('order', 'asc')->limit(4)->get();
        $exams_types = SmExamType::all();
        $classes = SmClass::where('active_status', 1)->get();
        $subjects = SmSubject::where('active_status', 1)->get();
        $sections = SmSection::where('active_status', 1)->get();
        return view('frontEnd.home.light_course', compact('exams', 'classes', 'subjects', 'exams_types', 'sections', 'course', 'news'));
    }

    public function courseDetails($id)
    {
        $course = SmCourse::find($id);
        $courses = SmCourse::orderBy('id', 'asc')->whereNotIn('id', [$id])->limit(3)->get();
        return view('frontEnd.home.light_course_details', compact('course', 'courses'));
    }
}
