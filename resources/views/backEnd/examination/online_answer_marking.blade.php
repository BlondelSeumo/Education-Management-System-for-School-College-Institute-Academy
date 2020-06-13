@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Examinations </h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">Dashboard</a>
                <a href="#">Examinations</a>
                <a href="{{url('online-exam')}}">Online Exam</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-30">Marking Online Exam</h3>
                        </div>
                    </div>
                </div>
                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'online_exam_marks_store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                <input type="hidden" name="online_exam_id" value="{{$take_online_exam->online_exam_id}}">
                <input type="hidden" name="student_id" value="{{$take_online_exam->student_id}}">
                <div class="row">
                    <div class="col-lg-12">
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                            <tbody>
                                <tr align="center">
                                    <td colspan="3">
                                        <h4>{{$take_online_exam->onlineExam !=""?$take_online_exam->onlineExam->question:""}}</h4>
                                        <h3><b>Subject: </b>{{$take_online_exam->onlineExam!=""?$take_online_exam->onlineExam->subject->subject_name:""}}</h3>
                                        <h3><b>Total Marks: </b></h3>
                                        <h3><b>Exam Has To Be Submitted Within: </b>{{$take_online_exam->onlineExam !=""?$take_online_exam->onlineExam->date:""}} {{$take_online_exam->onlineExam!=""?$take_online_exam->onlineExam->end_time:""}}</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Question</th>
                                    <th class="text-right">Marks</th>
                                    <th class="text-right">Currect</th>
                                </tr>
                                @php 
                                    $j=0;
                                    $answered_questions = $take_online_exam->answeredQuestions;
                                @endphp
                                @foreach($answered_questions as $question)
                                <tr>
                                    <td width="60%">
                                        {{++$j.'.'}} {{$question->questionBank->question}}
                                        @if($question->questionBank->type == "M")
                                            @php

                                                $multiple_options = $question->takeQuestionMu;
                                                $number_of_option = $question->takeQuestionMu->count();
                                                $i = 0;
                                            @endphp
                                            @foreach($multiple_options as $multiple_option)
                                            <div class="mt-20">
                                                <input type="checkbox" id="answer{{$multiple_option->id}}" class="common-checkbox" name="options_{{$question->question_bank_id}}_{{$i++}}" value="1" {{$multiple_option->status == 1? 'checked': ''}}>
                                                <label for="answer{{$multiple_option->id}}">{{$multiple_option->title}}</label>
                                            </div>
                                            @endforeach

                                        @elseif($question->questionBank->type == "T")
                                        <div class="d-flex radio-btn-flex mt-20">
                                            <div class="mr-30">
                                                <input type="radio" name="trueOrFalse_{{$question->question_bank_id}}" id="true_{{$question->question_bank_id}}" value="T" class="common-radio relationButton" {{$question->trueFalse == "T"? 'checked': ''}}>
                                                <label for="true_{{$question->question_bank_id}}">True</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="trueOrFalse_{{$question->question_bank_id}}" id="false_{{$question->question_bank_id}}" value="F" class="common-radio relationButton" {{$question->trueFalse == "F"? 'checked': ''}}>
                                                <label for="false_{{$question->question_bank_id}}">False</label>
                                            </div>
                                        </div>

                                        
                                        @else

                                            <div class="input-effect mt-20">
                                                <textarea class="primary-input form-control mt-10" cols="0" rows="5" name="suitable_words_{{$question->question_bank_id}}">{{$question->suitable_words}}</textarea>
                                                <label>Suitable Words</label>
                                                <span class="focus-border textarea"></span>
                                            </div>
                                        @endif

                                        <div class="mt-20">
                                            @if($question->questionBank->type == "M")
                                            @php
                                                $ques_bank_multiples = $question->questionBank->questionMu;
                                                $currect_multiple = '';
                                                $k = 0;
                                                foreach($ques_bank_multiples as $ques_bank_multiple){
                                                
                                                    if($ques_bank_multiple->status == 1){
                                                    $k++;
                                                        if($k == 1){
                                                            $currect_multiple .= $ques_bank_multiple->title;
                                                        }else{
                                                            $currect_multiple .= ','.$ques_bank_multiple->title;
                                                        }
                                                    }
                                                }

                                            @endphp
                                            <h4>[Currect Answer: {{$currect_multiple}}]</h4>
                                            @elseif($question->questionBank->type == "T")
                                                <h4>[Currect Answer: {{$question->questionBank->trueFalse == "T"? 'True': 'False'}}]</h4>
                                            @else 
                                                <h4>[Currect Answer: {{$question->questionBank->suitable_words}}]</h4>
                                            @endif
                                        </div>
                                    </td>
                                    <td width="20%" class="text-right"><b>{{$question->questionBank !=""?$question->questionBank->marks:""}}</b></td>
                                    <td width="20%" class="text-right">
                                        <div class="mt-20">
                                            <input type="checkbox" id="marks_{{$question->questionBank !=""?$question->questionBank->id:""}}" class="common-checkbox" name="marks[]" value="{{$question->questionBank!=""?$question->questionBank->id:""}}">
                                            <label for="marks_{{$question->questionBank!=""?$question->questionBank->id:""}}"></label>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="text-center">
                                        <button class="primary-btn fix-gr-bg">
                                            <span class="ti-check"></span>
                                            Submit Marks
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                 {{ Form::close() }}
            </div>
        </div>
    </div>
</section>



@endsection
