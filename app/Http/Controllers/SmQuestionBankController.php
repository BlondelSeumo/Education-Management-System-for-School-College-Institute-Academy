<?php

namespace App\Http\Controllers;

use DB;
use App\SmClass;
use App\SmSection;
use App\SmQuestionBank;
use App\SmQuestionGroup;
use App\SmQuestionLevel;
use Illuminate\Http\Request;
use App\SmQuestionBankMuOption;
use Brian2694\Toastr\Facades\Toastr;

class SmQuestionBankController extends Controller
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
        $levels = SmQuestionLevel::where('active_status', 1)->get();
        $groups = SmQuestionGroup::where('active_status', 1)->get();
        $banks = SmQuestionBank::where('active_status', 1)->get();


        $classes = SmClass::where('active_status', 1)->get();
        $sections = SmSection::where('active_status', 1)->get();
        return view('backEnd.examination.question_bank', compact('banks', 'levels', 'groups', 'classes', 'sections'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->question_type == "") {
            $request->validate([
                'group' => "required",
                'class' => "required",
                'section' => "required",
                'question' => "required",
                'question_type' => "required",
                'marks' => "required"
            ]);
        } elseif ($request->question_type == "M") {
            $request->validate([
                'group' => "required",
                'class' => "required",
                'section' => "required",
                'question' => "required",
                'question_type' => "required",
                'marks' => "required",
                'number_of_option' => "required"
            ]);
        } elseif ($request->question_type == "F") {
            $request->validate([
                'group' => "required",
                'class' => "required",
                'section' => "required",
                'question' => "required",
                'question_type' => "required",
                'marks' => "required",
                'suitable_words' => "required"
            ]);
        }


        if ($request->question_type != 'M') {
            $online_question = new SmQuestionBank();
            $online_question->type = $request->question_type;
            $online_question->q_group_id = $request->group;
            $online_question->class_id = $request->class;
            $online_question->section_id = $request->section;
            $online_question->marks = $request->marks;
            $online_question->question = $request->question;
            if ($request->question_type == "F") {
                $online_question->suitable_words = $request->suitable_words;
            } elseif ($request->question_type == "T") {
                $online_question->trueFalse = $request->trueOrFalse;
            }
            $result = $online_question->save();
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } else {

            DB::beginTransaction();

            try {
                $online_question = new SmQuestionBank();
                $online_question->type = $request->question_type;
                $online_question->q_group_id = $request->group;
                $online_question->class_id = $request->class;
                $online_question->section_id = $request->section;
                $online_question->marks = $request->marks;
                $online_question->question = $request->question;
                $online_question->number_of_option = $request->number_of_option;
                $online_question->save();
                $online_question->toArray();
                $i = 0;
                if (isset($request->option)) {
                    foreach ($request->option as $option) {
                        $i++;
                        $option_check = 'option_check_' . $i;
                        $online_question_option = new SmQuestionBankMuOption();
                        $online_question_option->question_bank_id = $online_question->id;
                        $online_question_option->title = $option;
                        if (isset($request->$option_check)) {
                            $online_question_option->status = 1;
                        } else {
                            $online_question_option->status = 0;
                        }
                        $online_question_option->save();
                    }
                }
                DB::commit();
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } catch (Exception $e) {
                DB::rollBack();
            }
            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();


            // $bank = new SmQuestionBank();
            // $bank->question = $request->question;
            // $bank->question_group_id = $request->group;
            // $bank->question_level_id = $request->level;
            // $bank->explanation = $request->explanation;
            // $bank->file = $fileName;
            // $bank->hints = $request->hints;
            // $bank->question_type = $request->question_type;
            // $result = $bank->save();
            // if($result){
            //     return redirect('question-bank')->with('message-success', 'Question has been created successfully');
            // }else{
            //     return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            // }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            $levels = SmQuestionLevel::all();
            $groups = SmQuestionGroup::all();
            $banks = SmQuestionBank::all();
            $bank = SmQuestionBank::find($id);
            $classes = SmClass::where('active_status', 1)->get();
            $sections = SmSection::where('active_status', 1)->get();
            //return $bank;
            return view('backEnd.examination.question_bank', compact('levels', 'groups', 'banks', 'bank', 'classes', 'sections'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ($request->question_type == "") {
            $request->validate([
                'group' => "required",
                'class' => "required",
                'section' => "required",
                'question' => "required",
                'question_type' => "required",
                'marks' => "required"
            ]);
        } elseif ($request->question_type == "M") {
            $request->validate([
                'group' => "required",
                'class' => "required",
                'section' => "required",
                'question' => "required",
                'question_type' => "required",
                'marks' => "required",
                'number_of_option' => "required"
            ]);
        } elseif ($request->question_type == "F") {
            $request->validate([
                'group' => "required",
                'class' => "required",
                'section' => "required",
                'question' => "required",
                'question_type' => "required",
                'marks' => "required",
                'suitable_words' => "required"
            ]);
        }


        if ($request->question_type != 'M') {
            $online_question = SmQuestionBank::find($id);
            $online_question->type = $request->question_type;
            $online_question->q_group_id = $request->group;
            $online_question->class_id = $request->class;
            $online_question->section_id = $request->section;
            $online_question->marks = $request->marks;
            $online_question->question = $request->question;
            if ($request->question_type == "F") {
                $online_question->suitable_words = $request->suitable_words;
            } elseif ($request->question_type == "T") {
                $online_question->trueFalse = $request->trueOrFalse;
            }
            $result = $online_question->save();
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect('question-bank');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } else {

            DB::beginTransaction();

            try {
                $online_question = SmQuestionBank::find($id);
                $online_question->type = $request->question_type;
                $online_question->q_group_id = $request->group;
                $online_question->class_id = $request->class;
                $online_question->section_id = $request->section;
                $online_question->marks = $request->marks;
                $online_question->question = $request->question;
                $online_question->number_of_option = $request->number_of_option;
                $online_question->save();
                $online_question->toArray();
                $i = 0;
                if (isset($request->option)) {
                    SmQuestionBankMuOption::where('question_bank_id', $online_question->id)->delete();
                    foreach ($request->option as $option) {
                        $i++;
                        $option_check = 'option_check_' . $i;
                        $online_question_option = new SmQuestionBankMuOption();
                        $online_question_option->question_bank_id = $online_question->id;
                        $online_question_option->title = $option;
                        if (isset($request->$option_check)) {
                            $online_question_option->status = 1;
                        } else {
                            $online_question_option->status = 0;
                        }
                        $online_question_option->save();
                    }
                }
                DB::commit();
                Toastr::success('Operation successful', 'Success');
                return redirect('question-bank');
            } catch (Exception $e) {
                DB::rollBack();
            }
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $online_question = SmQuestionBank::find($id);
        if ($online_question->type == "M") {
            SmQuestionBankMuOption::where('question_bank_id', $online_question->id)->delete();
        }

        $result = $online_question->delete();

        if ($result) {
            Toastr::success('Operation successful', 'Success');
            return redirect('question-bank');
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}
