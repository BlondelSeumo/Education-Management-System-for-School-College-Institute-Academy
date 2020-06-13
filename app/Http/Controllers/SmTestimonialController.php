<?php

namespace App\Http\Controllers;

use App\SmNews;
use App\SmTestimonial;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SmTestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonial = SmTestimonial::all();
        return view('backEnd.testimonial.testimonial_page', compact('testimonial'));
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
            'name' => 'required',
            'designation' => 'required',
            'institution_name' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);
        $testimonial = new SmTestimonial();
        $image = "";
        if ($request->file('image') != "") {
            $file = $request->file('image');
            $image = 'stu-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/testimonial/', $image);
            $image =  'public/uploads/testimonial/' . $image;
        }
        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->institution_name = $request->institution_name;
        $testimonial->image = $image;
        $testimonial->description = $request->description;
        $result = $testimonial->save();
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
     * @param  \App\SmTestimonial  $smTestimonial
     * @return \Illuminate\Http\Response
     */
    public function show(SmTestimonial $smTestimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SmTestimonial  $smTestimonial
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimonial = SmTestimonial::all();
        $add_testimonial = SmTestimonial::find($id);
        return view('backEnd.testimonial.testimonial_page', compact('add_testimonial', 'testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SmTestimonial  $smTestimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $image = "";
        if ($request->file('image') != "") {
            $testimonial = SmTestimonial::find($request->id);
            if ($testimonial->image != "") {
                unlink($testimonial->image);
            }

            $file = $request->file('image');
            $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/testimonial/', $image);
            $image =  'public/uploads/testimonial/' . $image;
        }

        $testimonial = SmTestimonial::find($request->id);
        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->institution_name = $request->institution_name;
        if ($image != "") {
            $testimonial->image = $image;
        }
        $testimonial->description = $request->description;
        $result = $testimonial->save();
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect('testimonial');
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SmTestimonial  $smTestimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(SmTestimonial $smTestimonial)
    {
        //
    }
    public function testimonialDetails($id)
    {
        $testimonial = SmTestimonial::find($id);
        return view('backEnd.testimonial.testimonial_details', compact('testimonial'));
    }
    public function forDeleteTestimonial($id)
    {
        return view('backEnd.testimonial.delete_modal', compact('id'));
    }
    public function delete($id)
    {
        $testimonial = SmTestimonial::find($id);
        $result = $testimonial->delete();
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}
