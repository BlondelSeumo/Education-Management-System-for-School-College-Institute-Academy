<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\SmClass;
use App\SmSection;
use App\tableList;
use App\ApiBaseMethod;
use App\SmClassSection;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;

class SmClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }


    public function index(Request $request)
    {
        $sections = SmSection::where('active_status', '=', 1)->get();
        $classes = SmClass::where('active_status', '=', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['classes'] = $classes->toArray();
            $data['sections'] = $sections->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.academics.class', compact('classes', 'sections'));
    }

    public function store(Request $request)
    {

        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'name' => "required|unique:sm_classes,class_name",
                'section' => 'required|array',
            ],
            [
                'section.required' => 'At least one checkbox required!'
            ]
        );

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {
            $class = new SmClass();
            $class->class_name = $request->name;
            $class->save();
            $class->toArray();
            try {
                $sections = $request->section;

                foreach ($sections as $section) {
                    $smClassSection = new SmClassSection();
                    $smClassSection->class_id = $class->id;
                    $smClassSection->section_id = $section;
                    $smClassSection->save();
                }

                DB::commit();

                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    return ApiBaseMethod::sendResponse(null, 'Class has been created successfully');
                }
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } catch (Exception $e) {
                DB::rollBack();
            }
        } catch (Exception $e) {
            DB::rollBack();
        }
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendError('Something went wrong, please try again.');
        }
        Toastr::error('Operation Failed', 'Failed');
        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {

        $classById = SmCLass::find($id);

        $sectionByNames = SmClassSection::select('section_id')->where('class_id', '=', $classById->id)->get();

        $sectionId = array();
        foreach ($sectionByNames as $sectionByName) {
            $sectionId[] = $sectionByName->section_id;
        }

        $sections = SmSection::where('active_status', '=', 1)->get();

        $classes = SmClass::where('active_status', '=', 1)->orderBy('id', 'desc')->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['sections'] = $sections->toArray();
            $data['classes'] = $classes->toArray();
            $data['classById'] = $classById;
            $data['sectionId'] = $sectionId;
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.academics.class', compact('classById', 'classes', 'sections', 'sectionId', 'className'));
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'name' => "required|unique:sm_classes,class_name," . $request->id,
                'section' => 'required|array',
            ],
            [
                'section.required' => 'At least one checkbox required!'
            ]
        );

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        SmCLassSection::where('class_id', $request->id)->delete();


        DB::beginTransaction();

        try {
            $class = SmClass::find($request->id);
            $class->class_name = $request->name;
            $class->save();
            $class->toArray();
            try {
                $sections = $request->section;

                foreach ($sections as $section) {
                    $smClassSection = new SmClassSection();
                    $smClassSection->class_id = $class->id;
                    $smClassSection->section_id = $section;
                    $smClassSection->save();
                }

                DB::commit();

                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    return ApiBaseMethod::sendResponse(null, 'Class has been updated successfully');
                }
                Toastr::success('Operation successful', 'Success');
                return redirect('class');
            } catch (Exception $e) {
                DB::rollBack();
            }
        } catch (Exception $e) {
            DB::rollBack();
        }

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendError('Something went wrong, please try again.');
        }
        Toastr::error('Operation Failed', 'Failed');
        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        $column_name = 'class_id';
        $t = FALSE;
        $tables = tableList::ONLY_TABLE_LIST($column_name);
        foreach ($tables as $table) {
            try {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $d = DB::table($table)->where($column_name, '=', $id)->update(['active_status' => 0]);
            } catch (\Illuminate\Database\QueryException $e) {
                $tableName = $table;
                if (!Schema::hasColumn($tableName, 'active_status')) {
                    Schema::table($tableName, function ($table) {
                        $table->integer('active_status')->default(1)->nullable();
                    });
                }
                // $msg = 'Ops! Something went wrong. You are not allowed to remove this class.';
                Toastr::error('Ops! Something went wrong. You are not allowed to remove this class', 'Failed');
                return redirect()->back();
            }
        } //end foreach

        try {

            $delete_query = SmClassSection::where('class_id', $request->id)->update(['active_status' => 0]);
            $delete_query = SmClass::where('id', $request->id)->update(['active_status' => 0]);
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($delete_query) {
                    return ApiBaseMethod::sendResponse(null, 'Class has been deleted successfully');
                } else {
                    return ApiBaseMethod::sendError('Something went wrong, please try again.');
                }
            } else {
                if ($delete_query) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect()->back();
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
            return redirect()->back()->with('message-danger-delete', $msg);
        } catch (\Exception $e) {
            // dd($e);
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}
