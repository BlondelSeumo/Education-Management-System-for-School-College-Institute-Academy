<?php

namespace App\Http\Controllers;

use App\SmNews;
use App\SmCourse;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SmCourseController extends Controller
{
    public function index()
    {
        $course = SmCourse::all();
        return view('backEnd.course.course_page', compact('course'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required',
            'overview' => 'required',
            'outline' => 'required',
            'prerequisites' => 'required',
            'resources' => 'required',
            'stats' => 'required',
        ]);
        $course = new SmCourse();
        $image = "";
        if ($request->file('image') != "") {
            $file = $request->file('image');
            $image = 'stu-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/course/', $image);
            $image = 'public/uploads/course/' . $image;
        }
        $course->title = $request->title;
        $course->image = $image;
        $course->overview = $request->overview;
        $course->outline = $request->outline;
        $course->prerequisites = $request->prerequisites;
        $course->resources = $request->resources;
        $course->stats = $request->stats;
        $result = $course->save();
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $course = SmCourse::all();
        $add_course = SmCourse::find($id);
        return view('backEnd.course.course_page', compact('course', 'add_course'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'overview' => 'required',
            'outline' => 'required',
            'prerequisites' => 'required',
            'resources' => 'required',
            'stats' => 'required',
        ]);
        $course = SmCourse::find($request->id);
        $image = "";
        if ($request->file('image') != "") {
            $course = SmCourse::find($request->id);
            if ($course->image != "") {
                unlink($course->image);
            }

            $file = $request->file('image');
            $image = 'stu-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/course/', $image);
            $image = 'public/uploads/course/' . $image;
        }
        $course = SmCourse::find($request->id);
        $course->title = $request->title;
        if ($image != "") {
            $course->image = $image;
        }
        $course->overview = $request->overview;
        $course->outline = $request->outline;
        $course->prerequisites = $request->prerequisites;
        $course->resources = $request->resources;
        $course->stats = $request->stats;
        $result = $course->save();
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function destroy($id)
    {
        $course = SmCourse::find($id);
        $result = $course->delete();
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function forDeleteCourse($id)
    {
        return view('backEnd.course.delete_modal', compact('id'));
    }
    public function courseDetails($id)
    {
        $course = SmCourse::find($id);
        return view('backEnd.course.course_details', compact('course'));
    }
}
