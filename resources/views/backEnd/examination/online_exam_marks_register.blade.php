@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.examinations')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.examinations')</a>
                <a href="{{url('online-exam')}}">@lang('lang.online_exam')</a>
                <a href="{{route('online_exam_marks_register', [$online_exam_question->id])}}">@lang('lang.marking')</a>
            </div>
        </div>
    </div>
</section>
@if(isset($students))

<section class="mt-20">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-6 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.marking')</h3>
                </div>
            </div>
        </div>


    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'online_exam_marks_store',  'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'marks_register_store']) }} 

        <input type="hidden" name="exam_id" value="{{$online_exam_question->id}}">
        <input type="hidden" name="subject_id" value="{{$online_exam_question->subject_id}}">
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
                <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        <tr>


                            <th>@lang('lang.admission') @lang('lang.no')</th>
                            <th>@lang('lang.student')</th>
                            <th>@lang('lang.class_Sec')</th>
                            <th>@lang('lang.exam')</th>
                            <th>@lang('lang.subject')</th>
                            <th>@lang('lang.marking')</th>
                        </tr>
                    </thead>
                    <tbody>
                
                            @foreach($students as $student)
                            <tr>
                                <td>{{$student->admission_no}}</td>
                                <td>{{$student->full_name}}</td>
                                <td>{{$student->className !=""?$student->className->class_name: ""}} ({{$student->section !=""?$student->section->section_name: ""}})</td>
                                <td>{{$online_exam_question->title}}</td>
                                <td>{{$online_exam_question->subject !=""?$online_exam_question->subject->subject_name:""}}</td>
                                <td>
                                    @if(in_array($student->id, $present_students))
                                        <a class="primary-btn small bg-success text-white border-0" href="{{route('online_exam_marking', [$online_exam_question->id, $student->id])}}">
                                            @lang('lang.view_answer_marking')
                                     </a>
                                    @else
                                        <a class="primary-btn small bg-warning text-white border-0" href="#">
                                            @lang('lang.absent')
                                        </a>
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

@endif

@endsection
