<?php

namespace App\Http\Controllers;

use App\SmNews;
use App\SmVisitor;
use App\ApiBaseMethod;
use App\SmNoticeBoard;
use App\SmNewsCategory;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;


class SmNewsController extends Controller
{

    public function index()
    {
        $news = SmNews::all();
        $news_category = SmNewsCategory::all();
        return view('backEnd.news.news_page', compact('news', 'news_category'));
    }

    public function create()
    { }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'date' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);
        $news = new SmNews();
        $image = "";
        $date = strtotime($request->date);
        $newformat = date('Y-m-d', $date);
        if ($request->file('image') != "") {
            $file = $request->file('image');
            $image = 'stu-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/news/', $image);
            $image = 'public/uploads/news/' . $image;
        }
        $news->news_title = $request->title;
        $news->category_id = $request->category_id;
        $news->publish_date = $newformat;
        $news->image = $image;
        $news->news_body = $request->description;
        $result = $news->save();
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function show()
    { }

    public function edit($id)
    {
        $news = SmNews::all();
        $add_news = SmNews::find($id);
        $news_category = SmNewsCategory::all();
        return view('backEnd.news.news_page', compact('add_news', 'news', 'news_category'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'date' => 'required',
            'description' => 'required',
        ]);
        $news = SmNews::find($request->id);
        $date = strtotime($request->date);
        $newformat = date('Y-m-d', $date);

        $image = "";
        if ($request->file('image') != "") {
            $news = SmNews::find($request->id);
            if ($news->image != "") {
                unlink($news->image);
            }


            $file = $request->file('image');
            $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/news/', $image);
            $image = 'public/uploads/news/' . $image;
        }

        $news = SmNews::find($request->id);
        $news->news_title = $request->title;
        $news->category_id = $request->category_id;
        $news->publish_date = $newformat;
        if ($image != "") {
            $news->image = $image;
        }
        $news->news_body = $request->description;
        $result = $news->save();
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect('news');
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function destroy(SmNews $smNews)
    {
        //
    }

    public function newsDetails($id)
    {
        $news = SmNews::find($id);
        return view('backEnd.news.news_details', compact('news'));
    }
    public function forDeleteNews($id)
    {
        return view('backEnd.news.delete_modal', compact('id'));
    }

    public function delete($id)
    {
        $news = SmNews::find($id);
        $result = $news->delete();
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function newsCategory()
    {
        $newsCategories = SmNewsCategory::all();
        return view('backEnd.news.news_category', compact('newsCategories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);
        $news_category = new SmNewsCategory();

        $news_category->category_name = $request->category_name;

        $result = $news_category->save();
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function editCategory($id)
    {
        $newsCategories = SmNewsCategory::all();
        $editData = SmNewsCategory::find($id);
        return view('backEnd.news.news_category', compact('newsCategories', 'editData'));
    }

    public function updateCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);
        $news_category = SmNewsCategory::find($request->id);
        $news_category->category_name = $request->category_name;
        $result = $news_category->save();
        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect('news-category');
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function forDeleteNewsCategory($id)
    {
        return view('backEnd.news.category_delete_modal', compact('id'));
    }

    public function deleteCategory(Request $request, $id)
    {

        $fk_id = 'category_id';

        $tables = \App\tableList::getTableList($fk_id);

        try {
            $delete_query = SmNewsCategory::destroy($id);
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                if ($delete_query) {
                    return ApiBaseMethod::sendResponse(null, 'News Category has been deleted successfully');
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

            return redirect()->back()->with('message-danger', $msg);
        } catch (\Exception $e) {
            //dd($e->getMessage(), $e->errorInfo);
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}
