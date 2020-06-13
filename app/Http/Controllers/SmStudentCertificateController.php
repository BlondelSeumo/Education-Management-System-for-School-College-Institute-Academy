<?php

namespace App\Http\Controllers;

use PDF;
use App\SmClass;
use App\SmSession;
use App\SmStudent;
use Illuminate\Http\Request;
use App\SmStudentCertificate;
use Illuminate\Support\Facades\DB;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class SmStudentCertificateController extends Controller
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
        $certificates = SmStudentCertificate::where('active_status', 1)->get();
        return view('backEnd.admin.student_certificate', compact('certificates'));
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
        $request->validate([
            'name' => "required",
            'file' => "required|dimensions:width=1100,height=850"
        ]);


        $fileName = "";
        if ($request->file('file') != "") {
            $file = $request->file('file');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/certificate/', $fileName);
            $fileName = 'public/uploads/certificate/' . $fileName;
        }

        $certificate = new SmStudentCertificate();
        $certificate->name = $request->name;
        $certificate->header_left_text = $request->header_left_text;
        $certificate->date = date('Y-m-d', strtotime($request->date));
        $certificate->body = $request->body;
        $certificate->footer_left_text = $request->footer_left_text;
        $certificate->footer_center_text = $request->footer_center_text;
        $certificate->footer_right_text = $request->footer_right_text;
        $certificate->student_photo = $request->student_photo;
        $certificate->file = $fileName;

        $result = $certificate->save();
        if ($result) {
            Toastr::success('Operation successful', 'Success');

            return redirect()->back();
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
        $certificate = SmStudentCertificate::find($id);
        $certificates = SmStudentCertificate::where('active_status', 1)->get();
        return view('backEnd.admin.student_certificate', compact('certificates', 'certificate'));
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
            'name' => "required"
        ]);

        $fileName = "";
        if ($request->file('file') != "") {
            $certificate = SmStudentCertificate::find($request->id);
            if ($certificate->file != "") {
                unlink($certificate->file);
            }


            $file = $request->file('file');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/certificate/', $fileName);
            $fileName = 'public/uploads/certificate/' . $fileName;
        }

        $certificate = SmStudentCertificate::find($request->id);
        $certificate->name = $request->name;
        $certificate->header_left_text = $request->header_left_text;
        $certificate->date = date('Y-m-d', strtotime($request->date));
        $certificate->body = $request->body;
        $certificate->footer_left_text = $request->footer_left_text;
        $certificate->footer_center_text = $request->footer_center_text;
        $certificate->footer_right_text = $request->footer_right_text;
        $certificate->student_photo = $request->student_photo;
        if ($fileName != "") {
            $certificate->file = $fileName;
        }

        $result = $certificate->save();
        if ($result) {
            Toastr::success('Operation successful', 'Success');

            return redirect('student-certificate');
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
        $certificate = SmStudentCertificate::find($id);
        unlink($certificate->file);
        $result = $certificate->delete();

        if ($result) {
            Toastr::success('Operation successful', 'Success');

            return redirect('student-certificate');
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    // for get route
    public function generateCertificate()
    {
        $classes = SmClass::where('active_status', 1)->get();
        $certificates = SmStudentCertificate::where('active_status', 1)->get();
        return view('backEnd.admin.generate_certificate', compact('classes', 'certificates'));
    }

    // for post route
    public function generateCertificateSearch(Request $request)
    {
        $request->validate([
            'class' => 'required',
            'certificate' => 'required'
        ]);
        $certificate_id = $request->certificate;
        $class_id = $request->class;
        $students = SmStudent::query();
        $students->where('active_status', 1);
        $students->where('class_id', $request->class);

        if ($request->section != "") {
            $students->where('section_id', $request->section);
        }

        $students = $students->get();

        $classes = SmClass::where('active_status', 1)->get();
        $certificates = SmStudentCertificate::where('active_status', 1)->get();
        return view('backEnd.admin.generate_certificate', compact('classes', 'certificates', 'certificate_id', 'certificates', 'students', 'class_id'));
    }

    public function generateCertificateGenerate($s_id, $c_id)
    {
        $s_ids = explode('-', $s_id);
        $students = [];
        foreach ($s_ids as $sId) {
            $students[] = SmStudent::find($sId);
        }

        $certificate = SmStudentCertificate::find($c_id);

        //return view('backEnd.admin.student_certificate_print', ['students' => $students, 'certificate' => $certificate]);




        $pdf = PDF::loadView('backEnd.admin.student_certificate_print', ['students' => $students, 'certificate' => $certificate]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('certificate.pdf');
    }
}
