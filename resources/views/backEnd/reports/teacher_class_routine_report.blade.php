@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.teacher_class_routine_report')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.reports')</a>
                <a href="#">@lang('lang.teacher_class_routine_report')</a>
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
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'teacher-class-routine-report', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="col-lg-6 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control {{ $errors->has('teacher') ? ' is-invalid' : '' }}" name="teacher">
                                        <option data-display="@lang('lang.select_teacher') *" value="">@lang('lang.select_teacher') *</option>
                                        @foreach($teachers as $teacher)
                                        <option value="{{$teacher->id}}" {{isset($teacher_id)? ($teacher_id == $teacher->id? 'selected':''):''}}>{{$teacher->full_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('teacher'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('teacher') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                
                                <div class="col-lg-3 mt-20 text-right">
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

@if(isset($class_times))
<section class="mt-20">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-6 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.class_routine')</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        @if(session()->has('success') != "")
                        <tr>
                            <td colspan="8">
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <th>Class Period</th>
                            @foreach($sm_weekends as $sm_weekend)
                            <th>{{$sm_weekend->name}}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($class_times as $class_time)


                        <tr>
                            <td>{{$class_time->period}}<br>{{date('h:i A', strtotime($class_time->start_time)).' - '.date('h:i A', strtotime($class_time->end_time))}}</td>

                            @foreach($sm_weekends as $sm_weekend)

                            <td>
                                @if($class_time->is_break == 0)
                                @if($sm_weekend->is_weekend != 1)


                                @php
                                    $assinged_class_routine = App\SmClassRoutineUpdate::teacherAssingedClassRoutine($class_time->id, $sm_weekend->id, $teacher_id);
                                @endphp
                                @if($assinged_class_routine == "")
                                N/A
                                @else
                                    <span class=""><strong>{{$assinged_class_routine->subject->subject_name}}</strong></span>
                                    <br>
                                    <span class="">class: {{$assinged_class_routine->class->class_name}}</span><br>
                                    <span class="">section : {{$assinged_class_routine->section->section_name}}</span></br>
                                    <span class="">{{$assinged_class_routine->classRoom->room_no}}</span></br>
                                    
                                @endif   




                                @else
                                        @lang('lang.weekend')

                                @endif
                                @endif
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
