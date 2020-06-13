<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SmQuestionLevel;

class SmQuestionLevelController extends Controller
{
    public function __construct(){
        $this->middleware('PM');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = SmQuestionLevel::where('active_status', 1)->get();

        return view('backEnd.examination.question_level', compact('levels'));
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
            'level' => "required|unique:sm_question_levels"
        ]);

        $level = new SmQuestionLevel();
        $level->level = $request->level;
        $result = $level->save();
        if($result){
            return redirect()->back()->with('message-success', 'Level has been created successfully');
        }else{
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
        $level = SmQuestionLevel::find($id);
        $levels = SmQuestionLevel::where('active_status', 1)->get();
        return view('backEnd.examination.question_level', compact('levels', 'level'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'level' => "required|unique:sm_question_levels,level,".$request->id
        ]);

        $level = SmQuestionLevel::find($request->id);
        $level->level = $request->level;
        $result = $level->save();
        if($result){
            return redirect()->back()->with('message-success', 'Level has been updated successfully');
        }else{
            return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
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
        $level = SmQuestionLevel::destroy($id);
        if($level){
            return redirect('question-level')->with('message-success-delete', 'Level has been deleted successfully');
        }else{
            return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        }
    }
}
