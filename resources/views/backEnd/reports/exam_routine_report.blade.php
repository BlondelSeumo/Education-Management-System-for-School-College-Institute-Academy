@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.exam_routine') @lang('lang.report')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.reports')</a>
                <a href="#">@lang('lang.exam_routine') @lang('lang.report')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.select_criteria') </h3>
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
                    <div class="white-box">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'exam_routine_report', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="col-lg-6 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control{{ $errors->has('exam') ? ' is-invalid' : '' }}" name="exam">
                                        <option data-display="@lang('lang.select_exam') *" value="">@lang('lang.select_exam') *</option>
                                        @foreach($exam_types as $exam)
                                            <option value="{{$exam->id}}" {{isset($exam_term_id)? ($exam->id == $exam_term_id? 'selected':''):''}}>{{$exam->title}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('exam'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('exam') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                
                                <div class="col-lg-3 mt-20 text-left">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        @lang('lang.search')
                                    </button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@if(isset($exam_routines))

<section class="mt-20">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-6 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.exam_routine')</h3>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="10%">@lang('lang.date')</th>
                            @foreach($exam_periods as $exam_period)
                            <th>{{$exam_period->period}}<br>{{date('h:i A', strtotime($exam_period->start_time)).'-'.date('h:i A', strtotime($exam_period->end_time))}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($exam_routines as $date => $exam_routine)
                        <tr>
                            <td>{{$date != ""? App\SmGeneralSettings::DateConvater($date):''}}

                        </td>
                            @foreach($exam_periods as $exam_period)
                            @php

                            $assigned_date_wise_exams = App\SmExamSchedule::assigned_date_wise_exams($exam_period->id, $exam_term_id, $date);

                            @endphp
                            <td>

                                @foreach($assigned_date_wise_exams as $assigned_date_wise_exam)
                                <span>
                                    {{$assigned_date_wise_exam->class->class_name}}({{$assigned_date_wise_exam->section->section_name}}) -
                                    {{$assigned_date_wise_exam->subject->subject_name}}
                                    
                                    {{'#'.$assigned_date_wise_exam->classRoom->room_no}}
                                    <br>
                                </span>


                                @endforeach
                                
                            </td>
                            @endforeach
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
