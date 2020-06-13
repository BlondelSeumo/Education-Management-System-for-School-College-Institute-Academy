@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.seat_plan_report') </h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.examinations')</a>
                <a href="#">@lang('lang.seat_plan_report')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.select_criteria') </h3>
                </div>
            </div>
            <div class="offset-lg-4 col-lg-4 text-right col-md-6">
                <a href="{{route('seat_plan_create')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.assign_students')
                </a>
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
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'seat_plan_report_search', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        <div class="row">
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                            <div class="col-lg-2 mt-30-md">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('exam') ? ' is-invalid' : '' }}" name="exam">
                                    <option data-display="@lang('lang.select_exam')" value="">@lang('lang.select_exam')</option>
                                    @foreach($exam_types as $exam)
                                        <option value="{{$exam->id}}">{{$exam->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('exam'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('exam') }}</strong>
                                </span>
                                @endif
                            </div>
                            
                            <div class="col-lg-2 mt-30-md">
                                <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                    <option data-display="@lang('lang.select_class')" value="">@lang('lang.select_class')</option>
                                    @foreach($classes as $class)
                                    <option value="{{$class->id}}"  {{( old('class') == $class->id ? "selected":"")}}>{{$class->class_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('class'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('class') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-2 mt-30-md" id="select_section_div">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_section" id="select_section" name="section">
                                    <option data-display="@lang('lang.select_section')" value="">@lang('lang.select_section')</option>
                                </select>
                                @if ($errors->has('section'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('section') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-lg-2 mt-30-md" id="select_subject_div">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" id="select_subject" name="subject">
                                    <option data-display="@lang('lang.select_subjects')" value="">@lang('lang.select_subjects')</option>
                                </select>
                                @if ($errors->has('subject'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-lg-4 mt-30-md">
                                <div class="no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date" id="startDate" type="text" name="date" autocomplete="off">
                                                <label>@lang('lang.date')</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="start-date-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-12 mt-20 text-right">
                                <button type="submit" class="primary-btn small fix-gr-bg">
                                    <span class="ti-search pr-2"></span>
                                    @lang('lang.date')
                                </button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</section>
@if(isset($seat_plans))
<section class="mt-40">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.seat_plan_report')</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="10%">@lang('lang.exam')</th>
                            <th width="10%">@lang('lang.date')</th>
                            <th width="10%">@lang('lang.start_end_time')</th>
                            <th width="10%">@lang('lang.student')</th>
                            <th width="10%">@lang('lang.class_Sec')</th>
                            <th width="10%">@lang('lang.total_students')</th>
                            <th width="15%">@lang('lang.roll') @lang('lang.no')</th>
                            <th width="10%">@lang('lang.category')</th>
                            <th width="10%">@lang('lang.assign_students')</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                        @foreach($seat_plans as $seat_plan)
                            
                            @php 
                                $seat_plan_childs = $seat_plan->seatPlanChild;
                            @endphp
                            @php $i = 0; @endphp
                            @foreach($seat_plan_childs as $seat_plan_child)
                            @php $i++; @endphp
                            <tr>
                                <td>
                                    @php 
                                    $exam = $seat_plan->exam; 
                                    if($i == 1){ 
                                        echo $exam->name; 
                                    }
                                    @endphp
                                </td>
                                <td>
                                    @php 
                                    $exam = $seat_plan->exam; 
                                    if($i == 1){ 

                                    
                                    echo App\SmGeneralSettings::DateConvater($seat_plan->date);
                                    }
                                    @endphp
                                </td>
                                <td>
                                    @php 
                                    $subject = $seat_plan->subject; 
                                    if($i == 1){ 
                                        echo date('h:i a', strtotime($seat_plan_child->start_time)).'-'.date('h:i a', strtotime($seat_plan_child->end_time)); 
                                    }
                                    @endphp
                                </td>
                                <td>
                                    @php 
                                    $subject = $seat_plan->subject; 
                                    if($i == 1){ 
                                        echo $subject->subject_name; 
                                    }
                                    @endphp
                                </td>
                                <td>
                                    @php 
                                    $class = $seat_plan->class; 
                                    $section = $seat_plan->section; 
                                    if($i == 1){ 
                                        echo $class->class_name.' ('.$section->section_name.')'; 
                                    }
                                    @endphp
                                </td>
                                <td>
                                    @php 
                                    if($i == 1){ 
                                        echo App\SmSeatPlan::total_student($seat_plan->class_id, $seat_plan->section_id);
                                    }
                                    @endphp
                                </td>
                                <td>@php $class_room = $seat_plan_child->class_room; echo $class_room->room_no; @endphp</td>
                                <td>{{$class_room->capacity}}</td>
                                <td>{{$seat_plan_child->assign_students}}</td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endif           

@endsection
