<?php

namespace App\Http\Controllers;

use App\SmBookCategory;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SmBookCategoryController extends Controller
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
        $bookCategories = SmBookCategory::all();
        return view('backEnd.library.bookCategoryList', compact('bookCategories'));
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
            'category_name' => "required|unique:sm_book_categories,category_name",
        ]);


        $categories = new SmBookCategory();
        $categories->category_name = $request->category_name;
        $results = $categories->save();

        if ($results) {
            Toastr::success('Operation successful', 'Success');
            return redirect('book-category-list');
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
        $editData = SmBookCategory::find($id);
        $bookCategories = SmBookCategory::all();
        return view('backEnd.library.bookCategoryList', compact('bookCategories', 'editData'));
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
            'category_name' => "required|unique:sm_book_categories,category_name," . $id,
        ]);


        $categories =  SmBookCategory::find($id);
        $categories->category_name = $request->category_name;
        $results = $categories->update();

        if ($results) {
            Toastr::success('Operation successful', 'Success');
            return redirect('book-category-list');
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
        $tables = \App\tableList::getTableList('book_category_id');
        try {
            $result = SmBookCategory::destroy($id);
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Illuminate\Database\QueryException $e) {

            $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
            return redirect()->back()->with('message-danger-delete', $msg);
        } catch (\Exception $e) {
            //dd($e->getMessage(), $e->errorInfo);
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function deleteBookCategoryView(Request $request, $id)
    {

        $title = "Are you sure to detete this Book category?";
        $url = url('delete-book-category/' . $id);
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($id, null);
        }
        return view('backEnd.modal.delete', compact('id', 'title', 'url'));
    }

    public function deleteBookCategory($id)
    {

        //dd($id);


        $tables = \App\tableList::getTableList('book_category_id');
        try {
            $result = SmBookCategory::destroy($id);
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Illuminate\Database\QueryException $e) {

            $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
            return redirect()->back()->with('message-danger-delete', $msg);
        } catch (\Exception $e) {
            //dd($e->getMessage(), $e->errorInfo);
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}
