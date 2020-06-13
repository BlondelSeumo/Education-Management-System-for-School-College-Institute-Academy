@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.class_routine')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.academics')</a>
                <a href="#">@lang('lang.class_routine')</a>
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
                                            @lang('lang.n_a')
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
