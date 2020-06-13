<?php

namespace App\Http\Controllers;

use PDF;
use App\SmClass;
use App\SmStudent;
use App\SmStudentIdCard;
use Illuminate\Http\Request;
use App\SmStudentCertificate;
use Brian2694\Toastr\Facades\Toastr;

class SmStudentIdCardController extends Controller
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
        $id_cards = SmStudentIdCard::where('active_status', 1)->get();
        return view('backEnd.admin.student_id_card', compact('id_cards'));
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
        //dd($request->all());
        $request->validate([
            'address' => 'required',
            'title' => 'required',
            'designation' => 'required',
            'logo' => 'required',
            'signature' => 'required'
        ]);

        $fileNameLogo = "";
        if ($request->file('logo') != "") {
            $file = $request->file('logo');
            $fileNameLogo = 'logo-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/studentIdCard/', $fileNameLogo);
            $fileNameLogo = 'public/uploads/studentIdCard/' . $fileNameLogo;
        }

        $fileNameSignature = "";
        if ($request->file('signature') != "") {
            $file = $request->file('signature');
            $fileNameSignature = 'signature-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/studentIdCard/', $fileNameSignature);
            $fileNameSignature = 'public/uploads/studentIdCard/' . $fileNameSignature;
        }

        $id_card = new SmStudentIdCard();
        $id_card->title = $request->title;
        $id_card->logo = $fileNameLogo;
        $id_card->designation = $request->designation;

        if (isset($fileNameSignature))
            $id_card->signature = $fileNameSignature;

        $id_card->address = $request->address;
        $id_card->admission_no = $request->admission_no;
        $id_card->student_name = $request->student_name;
        $id_card->class = $request->class;
        $id_card->father_name = $request->father_name;
        $id_card->mother_name = $request->mother_name;
        $id_card->student_address = $request->student_address;
        $id_card->phone = $request->mobile;
        $id_card->dob = $request->dob;
        $id_card->blood = $request->blood;

        $result = $id_card->save();
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
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
        $id_cards = SmStudentIdCard::where('active_status', 1)->get();
        $id_card = SmStudentIdCard::find($id);
        return view('backEnd.admin.student_id_card', compact('id_cards', 'id_card'));
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
        $request->validate([
            'address' => 'required',
            'title' => 'required',
            'designation' => 'required',
        ]);


        $fileNamelogo = "";
        if ($request->file('logo') != "") {
            $id_card = SmStudentIdCard::find($request->id);
            if ($id_card->logo != "") {
                if (file_exists($id_card->logo)) {
                    unlink($id_card->logo);
                }
            }

            $file = $request->file('logo');
            $fileNamelogo = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/studentIdCard/', $fileNamelogo);
            $fileNamelogo = 'public/uploads/studentIdCard/' . $fileNamelogo;
        }

        $fileNameSignature = "";
        if ($request->file('signature') != "") {
            $id_card = SmStudentIdCard::find($request->id);
            if ($id_card->signature != "") {
                if (file_exists($id_card->signature)) {
                    unlink($id_card->signature);
                }
            }

            $file = $request->file('signature');
            $fileNameSignature = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/studentIdCard/', $fileNameSignature);
            $fileNameSignature = 'public/uploads/studentIdCard/' . $fileNameSignature;
        }

        $id_card = SmStudentIdCard::find($request->id);
        $id_card->title = $request->title;
        if ($fileNamelogo != "") {
            $id_card->logo = $fileNamelogo;
        }
        $id_card->designation = $request->designation;
        if ($fileNameSignature != "") {
            $id_card->signature = $fileNameSignature;
        }
        $id_card->address = $request->address;
        $id_card->admission_no = $request->admission_no;
        $id_card->student_name = $request->student_name;
        $id_card->class = $request->class;
        $id_card->father_name = $request->father_name;
        $id_card->mother_name = $request->mother_name;
        $id_card->student_address = $request->student_address;
        $id_card->phone = $request->mobile;
        $id_card->dob = $request->dob;
        $id_card->blood = $request->blood;

        $result = $id_card->save();
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect('student-id-card');
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
        $id_card = SmStudentIdCard::find($id);
        if ($id_card->logo != "") {
            unlink($id_card->logo);
        }

        if ($id_card->signature != "") {
            unlink($id_card->signature);
        }

        $result = $id_card->delete();
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect('student-id-card');
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function generateIdCard()
    {
        $id_cards = SmStudentIdCard::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        return view('backEnd.admin.generate_id_card', compact('id_cards', 'classes'));
    }

    public function generateIdCardSearch(Request $request)
    {

        $request->validate([
            'class' => 'required',
            'id_card' => 'required'
        ]);

        $card_id = $request->id_card;
        $class_id = $request->class;


        $students = SmStudent::query();
        $students->where('active_status', 1);
        $students->where('class_id', $request->class);
        if ($request->section != "") {
            $students->where('section_id', $request->section);
        }

        $students = $students->get();

        $classes = SmClass::where('active_status', 1)->get();
        $id_cards = SmStudentIdCard::where('active_status', 1)->get();
        return view('backEnd.admin.generate_id_card', compact('id_cards', 'class_id', 'classes', 'students', 'card_id'));
    }

    public function ajaxStudentIdCardPrint()
    {

        $pdf = PDF::loadView('backEnd.admin.student_id_card_print');
        return response()->$pdf->stream('certificate.pdf');
    }

    public function generateIdCardPrint($s_id, $c_id)
    {
        $s_ids = explode('-', $s_id);
        $students = [];
        foreach ($s_ids as $sId) {
            $students[] = SmStudent::find($sId);
        }

        $id_card = SmStudentIdCard::find($c_id);


        //return view('backEnd.admin.student_id_card_print_2', ['id_card' => $id_card, 'students' => $students]);

        $pdf = PDF::loadView('backEnd.admin.student_id_card_print_2', ['id_card' => $id_card, 'students' => $students]);
        return $pdf->stream($id_card->title . '.pdf');
    }
}
