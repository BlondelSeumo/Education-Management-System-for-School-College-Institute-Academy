@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.student_dormitory_report')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.dormitory')</a>
                <a href="#">@lang('lang.student_dormitory_report')</a>
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
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_dormitory_report', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="col-lg-4 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                        <option data-display="@lang('lang.select_class')" value="">@lang('lang.select_class')</option>
                                        @foreach($classes as $class)
                                        <option value="{{$class->id}}" {{isset($class_id)? ($class_id == $class->id? 'selected':''):''}}>{{$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4 mt-30-md" id="select_section_div">
                                    <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_section" id="select_section" name="section">
                                        <option data-display="@lang('lang.select_section')" value="">@lang('lang.select_section')</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control {{ $errors->has('dormitory') ? ' is-invalid' : '' }}" name="dormitory">
                                        <option data-display="@lang('lang.select_dormitory')" value="">@lang('lang.select_dormitory')</option>
                                        @foreach($dormitories as $dormitory)
                                        <option value="{{$dormitory->id}}"  {{isset($dormitory_id)? ($dormitory_id == $dormitory->id? 'selected':''):''}}>{{$dormitory->dormitory_name}}</option>
                                        @endforeach
                                    </select>
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
       
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"> @lang('lang.student_dormitory_report')</h3>
                            </div>
                        </div>
                    </div>
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
                                        <th> @lang('lang.class_Sec')</th>
                                        <th> @lang('lang.admission')  @lang('lang.no')</th>
                                        <th> @lang('lang.student')  @lang('lang.name')</th>
                                        <th> @lang('lang.mobile')</th>
                                        <th>@lang('lang.guardian_phone')</th>
                                        <th>@lang('lang.dormitory') @lang('lang.name')</th>
                                        <th>@lang('lang.room_number')</th>
                                        <th>@lang('lang.room_type')</th>
                                        <th>@lang('lang.cost_per_bed')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                        <td>{{$student->className != ""? $student->className->class_name:""}} ({{$student->section->section_name}})<input type="hidden" name="id[]" value="{{$student->student_id}}"></td>
                                        <td>{{$student->admission_no}}</td>
                                        <td>{{$student->full_name}}</td>
                                        <td>{{$student->mobile}}</td>
                                        <td>{{$student->parents->guardians_mobile}}</td>
                                        <td>{{ $student->dormitory != ""? $student->dormitory->dormitory_name: ''}}</td>
                                        <td>{{ $student->room != ""? $student->room->name: ''}}</td>
                                        <td>{{ $student->room != ""? $student->room->roomType->type: ''}}</td>
                                        <td>{{ $student->room != ""? number_format( (float) $student->room->cost_per_bed, 2, '.', ''): ''}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
