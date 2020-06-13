@extends('backEnd.master')
@section('mainContent')

@php  $setting = App\SmGeneralSettings::find(1);  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   @endphp 



<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.class_report') </h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.reports')</a>
                <a href="#">@lang('lang.class_report')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
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
                @if(session()->has('message-danger') != "")
                    @if(session()->has('message-danger'))
                    <div class="alert alert-danger">
                        {{ session()->get('message-danger') }}
                    </div>
                    @endif
                @endif
                <div class="white-box">
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'class_report', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                        <div class="row">
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                            <div class="col-lg-6 mt-30-md">
                                <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                    <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select_class') *</option>
                                    @foreach($classes as $class)
                                    <option value="{{$class->id}}"  {{( old("class") == $class->id ? "selected":"")}}>{{$class->class_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('class'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('class') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-6 mt-30-md" id="select_section_div">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }}" id="select_section" name="section">
                                    <option data-display="@lang('lang.select_section') *" value="">@lang('lang.select_section') *</option>
                                </select>
                                @if ($errors->has('section'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('section') }}</strong>
                                </span>
                                @endif
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
    </div>
</section>
@if(isset($students))
<section class="student-details">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-30 mt-30">Class Report for class {{$class->class_name}} {{$section != ""? 'section ('. $section->section_name.')': ''}}</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <div class="student-meta-box mb-40">
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="value text-left text-uppercase">
                                        @lang('lang.class') @lang('lang.information')
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="value text-left text-uppercase">
                                        @lang('lang.quantity')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        @lang('lang.number_of_student')
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        {{$students->count()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        @lang('lang.total_subjects_assigned')
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        {{count($assign_subjects)}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="student-meta-box mb-40">
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="value text-left text-uppercase">
                                        @lang('lang.subjects')
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="value text-left text-uppercase">
                                        @lang('lang.teacher')
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($assign_subjects as $assign_subject)
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        {{$assign_subject->subject !=""?$assign_subject->subject->subject_name:""}}
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        @if($assign_subject->teacher_id != "")
                                            {{$assign_subject->teacher->full_name}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                    @if($assign_class_teachers != "")

                    <div class="student-meta-box mb-40">
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="value text-left text-uppercase">
                                        @lang('lang.class_teacher')
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="value text-left text-uppercase">
                                        @lang('lang.information')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        @lang('lang.name')
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        {{$assign_class_teachers->teacher !=""?$assign_class_teachers->teacher->full_name:""}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        @lang('lang.mobile')
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        {{$assign_class_teachers !=""?$assign_class_teachers->teacher->mobile:""}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        @lang('lang.email')
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        {{$assign_class_teachers->teacher !=""?$assign_class_teachers->teacher->email:""}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        @lang('lang.address')
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        {{$assign_class_teachers->teacher !=""?$assign_class_teachers->teacher->current_address:""}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif

                    <div class="student-meta-box">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <div class="value text-left text-uppercase">
                                                @lang('lang.type')
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="value text-left text-uppercase">
                                                @lang('lang.collection')({{$currency}})
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="value text-left text-uppercase">
                                                @lang('lang.due')({{$currency}})
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <div class="name text-left">
                                                @lang('lang.fees_collection')
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="name text-left">
                                                {{number_format($total_collection, 2)}}<input type="hidden" id="total_collection" name="total_collection" value="{{$total_collection}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="name text-left">
                                                {{number_format($total_assign - $total_collection, 2)}}<input type="hidden" id="total_assign" name="total_assign" value="{{$total_assign}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="value text-left text-uppercase bb-15 pb-7">
                                                @lang('lang.fees_details')
                                            </div>

                                            <!-- <div id="commonBarChart" height="150px"></div> -->
                                            <div id="donutChart" height="200px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endsection
