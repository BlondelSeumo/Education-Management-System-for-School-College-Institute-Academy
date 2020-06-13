<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SmInstruction;

class SmInstructionController extends Controller
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
        $instructions = SmInstruction::all();
        return view('backEnd.examination.instruction', compact('instructions'));
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
            'title' => "required|unique:sm_instructions",
            'description' => "required"
        ]);

        $instruction = new SmInstruction();
        $instruction->title = $request->title;
        $instruction->description = $request->description;
        $result = $instruction->save();
        if($result){
            return redirect()->back()->with('message-success', 'Instruction has been created successfully');
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
        $instruction = SmInstruction::find($id);
        $instructions = SmInstruction::all();
        return view('backEnd.examination.instruction', compact('instruction', 'instructions'));
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
            'title' => "required|unique:sm_instructions,title,".$request->id,
            'description' => "required"
        ]);

        $instruction = SmInstruction::find($request->id);
        $instruction->title = $request->title;
        $instruction->description = $request->description;
        $result = $instruction->save();
        if($result){
            return redirect('instruction')->with('message-success', 'Instruction has been updated successfully');
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
        $instruction = SmInstruction::destroy($id);
        if($instruction){
            return redirect('assign-vehicle')->with('message-success-delete', 'Instruction has been deleted successfully');
        }else{
            return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        }
    }
}
