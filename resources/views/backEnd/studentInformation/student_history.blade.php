@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.student_history')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.reports')</a>
                <a href="#">@lang('lang.student_history')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
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
                    <div class="white-box">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_history_search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="col-lg-6 mt-30-md">
                                    <select class="w-100 niceSelect bb form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" name="class">
                                        <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select_class') *</option>
                                        @foreach($classes as $class)
                                        <option value="{{$class->id}}"  {{isset($class_id)? ($class_id == $class->id? 'selected': ''):''}}>{{$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('class'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('class') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-6 mt-30-md">
                                    <select class="w-100 niceSelect bb form-control{{ $errors->has('current_section') ? ' is-invalid' : '' }}" name="admission_year">
                                        <option data-display="@lang('lang.select_admission_year')" value="">@lang('lang.select_admission_year')</option>
                                        @foreach($years as $key => $value)
                                        <option value="{{$key}}" {{isset($year)? ($year == $key? 'selected': ''):''}}>{{$key}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                                <div class="col-lg-12 mt-20 text-right">
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
            
@if(isset($students))

            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">@lang('lang.student_report')</h3>
                            </div>
                        </div>
                    </div>

                

                    <!-- <div class="d-flex justify-content-between mb-20"> -->
                        <!-- <button type="submit" class="primary-btn fix-gr-bg mr-20" onclick="javascript: form.action='{{url('student-attendance-holiday')}}'">
                            <span class="ti-hand-point-right pr"></span>
                            mark as holiday
                        </button> -->

                        
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    @if(session()->has('message-danger') != "")
                                    <tr>
                                        <td colspan="9">
                                            @if(session()->has('message-danger'))
                                            <div class="alert alert-danger">
                                                {{ session()->get('message-danger') }}
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>@lang('lang.admission') @lang('lang.no')</th>
                                        <th>@lang('lang.name')</th>
                                        <th>@lang('lang.admission') @lang('lang.date')</th>
                                        <th>@lang('lang.class')(@lang('lang.start_end'))</th>
                                        <th>@lang('lang.session')(@lang('lang.start_end'))</th>
                                        <th>@lang('lang.mobile')</th>
                                        <th>@lang('lang.guardian') @lang('lang.name')</th>
                                        <th>@lang('lang.guardian_phone')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                        <td>{{$student->admission_no}}</td>
                                        <td>{{$student->first_name.' '.$student->last_name}}</td>
                                        <td  data-sort="{{strtotime($student->admission_date)}}" >                                            
                                        {{$student->admission_date != ""? App\SmGeneralSettings::DateConvater($student->admission_date):''}}

                                        </td>
                                        

                                        <td>
                                            @php
                                                $histories = $student->promotion;
                                                if(count($histories) != 0){
                                                    $maxClass = App\SmStudent::classPromote($student->promotion->max('current_class_id'));
                                                    $minClass = App\SmStudent::classPromote($student->promotion->min('previous_class_id'));
                                                    echo $minClass.' - '. $maxClass;
                                                }else{
                                                    echo $student->className->class_name.' - '.$student->className->class_name;
                                                }
                                            @endphp
                                        </td>

                                        <td>
                                            @php
                                                $histories = $student->promotion;
                                                if(count($histories) != 0){
                                                    $maxSession = App\SmStudent::sessionPromote($student->promotion->max('current_session_id'));
                                                    $minSession = App\SmStudent::sessionPromote($student->promotion->min('previous_session_id'));
                                                    echo $minSession.' - '. $maxSession;
                                                }else{
                                                    echo $student->session->session.' - '.$student->session->session;
                                                }
                                            @endphp
                                        </td>
                                        <td>{{$student->mobile}}</td>
                                        <td>{{$student->parents !=""?$student->parents->guardians_name:""}}</td>
                                        <td>{{$student->parents !=""?$student->parents->guardians_mobile:""}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

@endif

    </div>
</section>


@endsection
