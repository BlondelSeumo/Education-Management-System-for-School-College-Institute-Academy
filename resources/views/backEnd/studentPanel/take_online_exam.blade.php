@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Examinations </h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">Dashboard</a>
                <a href="#">Examinations</a>
                <a href="{{url('student-online-exam')}}">Online Exam</a>
                <a href="{{url('take-online-exam/'.$online_exam->id)}}">Take Online Exam</a>
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
                            <h3 class="mb-30">Take Online Exam</h3>
                        </div>
                    </div>
                </div>
                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_online_exam_submit', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'online_take_exam']) }}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="white-box">
                            <table  class="" cellspacing="0" width="100%">
                                <tbody>
                                    <tr align="center" class="exam-bg">
                                        <td colspan="2" class="pt-4 pb-3 px-sm-5">
                                            <h1>Exam Name : {{$online_exam->title}}</h1>
                                            <h2><b>Subject : </b>{{$online_exam->subject !=""?$online_exam->subject->subject_name:""}}</h2>
                                            <h6><b>Class(Sec.) : </b>{{$online_exam->class !=""?$online_exam->class->class_name:""}} ({{$online_exam->section !=""?$online_exam->section->section_name:""}})</h6>
                                            <h3 class="mb-20"><b>Total Marks: </b>
                                            @php
                                            $total_marks = 0;
                                                foreach($online_exam->assignQuestions as $question){
                                                    $total_marks = $total_marks + $question->questionBank->marks;
                                                }
                                                echo $total_marks;
                                            @endphp</h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><b>Instruction : </b>{{$online_exam->instruction}}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-2"><strong>Exam Has To Be Submitted Within: </strong>{{$online_exam->date}} {{$online_exam->end_time}}</p>
                                                <p id="countDownTimer"></p>
                                                </div>
                                            </div>
                                            <input type="hidden" id="count_date" value="{{$online_exam->date}}">
                                            <input type="hidden" id="count_start_time" value="{{date('Y-m-d H:i:s', strtotime($online_exam->start_time))}}">
                                            <input type="hidden" id="count_end_time" value="{{date('Y-m-d H:i:s', strtotime($online_exam->end_time))}}">
                                        </td>
                                    </tr>
                                    @php $j=0; @endphp
                                    @foreach($assigned_questions as $question)
                                    <input type="hidden" name="online_exam_id" value="{{$question->online_exam_id}}">
                                    <input type="hidden" name="question_ids[]" value="{{$question->question_bank_id}}">

                                    
                                    <tr>
                                        <td width="80%" class="pt-5">
                                            {{++$j.'.'}} {{$question->questionBank->question}}
                                            @if($question->questionBank->type == "M")
                                                @php
                                                    $multiple_options = $question->questionBank->questionMu;
                                                    $number_of_option = $question->questionBank->questionMu->count();
                                                    $i = 0;
                                                @endphp
                                                @foreach($multiple_options as $multiple_option)
                                                <div class="mt-20">
                                                    <input type="checkbox" id="answer{{$multiple_option->id}}" class="common-checkbox" name="options_{{$question->question_bank_id}}_{{$i++}}" value="1">
                                                    <label for="answer{{$multiple_option->id}}">{{$multiple_option->title}}</label>
                                                </div>
                                                @endforeach

                                            @elseif($question->questionBank->type == "T")
                                            <div class="d-flex radio-btn-flex mt-20">
                                                <div class="mr-30">
                                                    <input type="radio" name="trueOrFalse_{{$question->question_bank_id}}" id="true_{{$question->question_bank_id}}" value="T" class="common-radio relationButton">
                                                    <label for="true_{{$question->question_bank_id}}">True</label>
                                                </div>
                                                <div class="mr-30">
                                                    <input type="radio" name="trueOrFalse_{{$question->question_bank_id}}" id="false_{{$question->question_bank_id}}" value="F" class="common-radio relationButton">
                                                    <label for="false_{{$question->question_bank_id}}">False</label>
                                                </div>
                                            </div>
                                            @else

                                                <div class="input-effect mt-20">
                                                    <textarea class="primary-input form-control mt-10" cols="0" rows="3" name="suitable_words_{{$question->question_bank_id}}"></textarea>
                                                    <label>Suitable Words</label>
                                                    <span class="focus-border textarea"></span>
                                                </div>
                                            @endif
                                        </td>
                                        <td width="20%" class="text-right"><b>{{$question->questionBank!=""?$question->questionBank->marks:""}}</b></td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2" class="text-center pt-4">
                                            <button class="primary-btn fix-gr-bg" id="online_take_exam_button" type="">
                                                <span class="ti-check"></span>
                                                Submit Exam
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 {{ Form::close() }}
            </div>
        </div>
    </div>
</section>



@endsection
