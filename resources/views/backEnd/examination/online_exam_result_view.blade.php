@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.examinations') </h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.examinations')</a>
                <a href="{{url('online-exam')}}">@lang('lang.online_exam')</a>
                <a href="{{route('online_exam_result', [$online_exam_question->id])}}">@lang('lang.result_view')</a>
            </div>
        </div>
    </div>
</section>

<section class="mt-20">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-6 col-md-6">
                <div class="main-title">
                    <h3 class="mb-0">@lang('lang.result_view')</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                 @if(session()->has('message-success') != "")
                    @if(session()->has('message-success'))
                    <div class="alert alert-success">
                        {{ session()->get('message-success') }}
                    </div>
                    @endif
                @endif
                 @if(session()->has('message-danger') != "")
                    @if(session()->has('message-danger'))
                    <div class="alert alert-danger">
                        {{ session()->get('message-danger') }}
                    </div>
                    @endif
                @endif
                <table id="table_id" class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>@lang('lang.admission') @lang('lang.no')</th>
                            <th>@lang('lang.student')</th>
                            <th>@lang('lang.class_Sec')</th>
                            <th>@lang('lang.exam')</th>
                            <th>@lang('lang.subject')</th>
                            <th>@lang('lang.total_marks')</th>
                            <th>@lang('lang.obtained_marks')</th>
                            <th>@lang('lang.result')</th>
                        </tr>
                    </thead>
                    <tbody>
                
                            @foreach($students as $student)
                            <tr>
                                <td>{{$student->admission_no}}</td>
                                <td>{{$student->full_name}}</td>
                                <td>{{$student->className!=""?$student->className->class_name:""}} ({{$student->section!=""?$student->section->section_name:""}})</td>
                                <td>{{$online_exam_question->title}}</td>
                                <td>{{$online_exam_question->subject!=""?$online_exam_question->subject->subject_name:""}}</td>
                                <td>{{$total_marks}}</td>
                                <td>
                                    @if(in_array($student->id, $present_students))
                                        @php
                                            $obtained_marks = App\SmOnlineExam::obtainedMarks($online_exam_question->id, $student->id);
                                            if($obtained_marks->status == 1){
                                                echo "Waiting for marks";
                                            }else{
                                                echo $obtained_marks->total_marks;
                                            }
                                        @endphp
                                    @else
                                        @lang('lang.absent')
                                    @endif
                                    
                                </td>
                                <td>
                                    @if(in_array($student->id, $present_students))
                                        @php
                                            if($obtained_marks->status == 1){
                                                echo "Waiting for marks";
                                            }else{
                                                
                                                $result = $obtained_marks->total_marks * 100 / $total_marks;
                                                if($result >= $online_exam_question->percentage){
                                                    echo "Pass";  
                                                }else{
                                                    echo "Fail";
                                                }
                                            }
                                        @endphp
                                    @else

                                        @lang('lang.absent')
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


@endsection
