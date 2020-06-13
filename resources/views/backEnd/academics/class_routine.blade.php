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
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.select_criteria') </h3>
                    </div>
                </div>
                <div class="col-lg-4 text-md-right text-left col-md-6 mb-30-lg">
                    <a href="{{route('class_routine_create')}}" class="primary-btn small fix-gr-bg">
                        <span class="ti-plus pr-2"></span>
                        @lang('lang.add') @lang('lang.class_routine')
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
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'class-routine-report-search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="col-lg-6 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                        <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select_class') *</option>
                                        @foreach($classes as $class)
                                        <option value="{{$class->id}}"  {{isset($class_id)? ($class_id == $class->id?'selected':''):''}}>{{$class->class_name}}</option>
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

@if(isset($class_routines))
<section class="mt-20">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-6 col-md-6">
                <div class="main-title">
                    <h3 class="mb-0">@lang('lang.class_routine')</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                    <thead>

                        <tr>
                            <th>@lang('lang.subject')</th>
                            <th>@lang('lang.teacher')</th>
                            <th>@lang('lang.monday')</th>
                            <th>@lang('lang.tuesday')</th>
                            <th>@lang('lang.wednesday')</th>
                            <th>@lang('lang.thursday')</th>
                            <th>@lang('lang.friday')</th>
                            <th>@lang('lang.Saturday')</th>
                            <th>@lang('lang.sunday')</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($class_routines as $class_routine)

                        @php
                            $teacher_id = App\SmClassRoutine::teacherId($class_routine->class_id, $class_routine->section_id, $class_routine->subject_id);

                            if($teacher_id != ""){
                                $teacher = $teacher_id->teacher->full_name;
                            }else{
                                $teacher = "";
                            }
                        @endphp



                        <tr>
                            <td>{{$class_routine->subject !=""?$class_routine->subject->subject_name:""}}</td>
                            <td>{{$teacher}}</td>
                            <td>@if($class_routine->monday_start_from != "")
                                <span class="">{{$class_routine->monday_start_from .'-'. $class_routine->monday_end_to}}<br> @lang('lang.room_number'): {{$class_routine->monday_room_id}}</span>
                                @else
                                    {{"@lang('lang.not_scheduled')"}}
                                @endif
                            </td>
                            <td>@if($class_routine->tuesday_start_from != "")
                                <span class="">{{$class_routine->tuesday_start_from .'-'. $class_routine->tuesday_end_to}}<br> @lang('lang.room_number'): {{$class_routine->tuesday_room_id}}</span>
                                @else
                                    {{"@lang('lang.not_scheduled')"}}
                                @endif
                            </td>
                            <td>@if($class_routine->wednesday_start_from != "")
                                <span class="">{{$class_routine->wednesday_start_from .'-'. $class_routine->wednesday_end_to}}<br> @lang('lang.room_number'): {{$class_routine->wednesday_room_id}}</span>
                                @else
                                    {{"@lang('lang.not_scheduled')"}}
                                @endif
                            </td>
                            <td>@if($class_routine->thursday_start_from != "")
                                <span class="">{{$class_routine->thursday_start_from .'-'. $class_routine->thursday_end_to}}<br> @lang('lang.room_number'): {{$class_routine->thursday_room_id}}</span>
                                @else
                                    {{"@lang('lang.not_scheduled')"}}
                                @endif
                            </td>
                            <td>@if($class_routine->friday_start_from != "")
                                <span class="">{{$class_routine->friday_start_from .'-'. $class_routine->friday_end_to}}<br> @lang('lang.room_number'): {{$class_routine->friday_room_id}}</span>
                                @else
                                    {{"@lang('lang.not_scheduled')"}}
                                @endif
                            </td>
                            <td>@if($class_routine->saturday_start_from != "")
                                <span class="">{{$class_routine->saturday_start_from .'-'. $class_routine->saturday_end_to}}<br> @lang('lang.room_number'): {{$class_routine->saturday_room_id}}</span>
                                @else
                                    {{"@lang('lang.not_scheduled')"}}
                                @endif
                            </td>
                            <td>@if($class_routine->sunday_start_from != "")
                                <span class="text-success">{{$class_routine->sunday_start_from .'-'. $class_routine->sunday_end_to}}<br> @lang('lang.room_number'): {{$class_routine->sunday_room_id}}</span>
                                @else
                                    {{"@lang('lang.not_scheduled')"}}
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
