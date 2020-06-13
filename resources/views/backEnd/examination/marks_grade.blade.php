@extends('backEnd.master')
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.marks_grade') </h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.examinations')</a>
                    <a href="#">@lang('lang.marks_grade')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            @if(isset($marks_grade))
             @if(in_array(226, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="{{url('marks-grade')}}" class="primary-btn small fix-gr-bg">
                            <span class="ti-plus pr-2"></span>
                            @lang('lang.add')
                        </a>
                    </div>
                </div>
            @endif
            @endif
            <div class="row">
                
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">@if(isset($marks_grade))
                                        @lang('lang.edit')
                                    @else
                                        @lang('lang.add')
                                    @endif
                                    @lang('lang.grade')
                                </h3>
                            </div>
                            @if(isset($marks_grade))
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'marks-grade/'.$marks_grade->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                            @else
                            @if(in_array(226, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'marks-grade',
                                'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            @endif
                            @endif
                            <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if(session()->has('message-success'))
                                                <div class="alert alert-success">
                                                    {{ session()->get('message-success') }}
                                                </div>
                                            @elseif(session()->has('message-danger'))
                                                <div class="alert alert-danger">
                                                    {{ session()->get('message-danger') }}
                                                </div>
                                            @endif
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control{{ $errors->has('grade_name') ? ' is-invalid' : '' }}"
                                                    type="text" name="grade_name" autocomplete="off"
                                                    value="{{isset($marks_grade)? $marks_grade->grade_name:''}}">
                                                <input type="hidden" name="id"
                                                       value="{{isset($marks_grade)? $marks_grade->id: ''}}">
                                                <label> @lang('lang.grade') @lang('lang.name') <span>*</span></label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('grade_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('grade_name') }}</strong>
                                            </span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control{{ $errors->has('gpa') ? ' is-invalid' : '' }}"
                                                    type="text" name="gpa" autocomplete="off"
                                                    value="{{isset($marks_grade)? $marks_grade->gpa:''}}">
                                                <input type="hidden" name="id"
                                                       value="{{isset($marks_grade)? $marks_grade->id: ''}}">
                                                <label>@lang('lang.gpa') <span>*</span></label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('gpa'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('gpa') }}</strong>
                                            </span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control{{ $errors->has('percent_from') ? ' is-invalid' : '' }}"
                                                    type="number" name="percent_from" autocomplete="off"
                                                    value="{{isset($marks_grade)? $marks_grade->percent_from:''}}">
                                                <label>@lang('lang.percent_from')<span>*</span></label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('percent_from'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('percent_from') }}</strong>
                                            </span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control{{ $errors->has('percent_upto') ? ' is-invalid' : '' }}"
                                                    type="number" name="percent_upto" autocomplete="off"
                                                    value="{{isset($marks_grade)? $marks_grade->percent_upto:''}}">
                                                <input type="hidden" name="id"
                                                       value="{{isset($marks_grade)? $marks_grade->id: ''}}">
                                                <label>@lang('lang.percent_upto')<span>*</span></label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('percent_upto'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('percent_upto') }}</strong>
                                            </span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <textarea class="primary-input form-control" cols="0" rows="4"
                                                          name="description">{{isset($marks_grade)? $marks_grade->description: ''}}</textarea>
                                                <label>@lang('lang.description') <span></span></label>
                                                <span class="focus-border textarea"></span>
                                                @if ($errors->has('description'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
	                                @php 
                                  $tooltip = "";
                                  if(in_array(226, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp

                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                           <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                                <span class="ti-check"></span>

                                                @if(isset($marks_grade))
                                                    @lang('lang.update')
                                                @else
                                                    @lang('lang.save')
                                                @endif
                                                @lang('lang.grade')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">@lang('lang.grade') @lang('lang.list')</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">

                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                                <thead>
                                @if(session()->has('message-success-delete') != "" ||
                                session()->get('message-danger-delete') != "")
                                    <tr>
                                        <td colspan="4">
                                            @if(session()->has('message-success-delete'))
                                                <div class="alert alert-success">
                                                    {{ session()->get('message-success-delete') }}
                                                </div>
                                            @elseif(session()->has('message-danger-delete'))
                                                <div class="alert alert-danger">
                                                    {{ session()->get('message-danger-delete') }}
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>@lang('lang.grade') @lang('lang.name')</th>
                                    <th>@lang('lang.gpa')</th>
                                    <th>@lang('lang.percent_from')</th>
                                    <th>@lang('lang.percent_upto')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($marks_grades as $marks_grade)
                                    <tr>
                                        <td>{{$marks_grade->grade_name}}</td>
                                        <td>{{$marks_grade->gpa}}</td>
                                        <td>{{$marks_grade->percent_from}}</td>
                                        <td>{{$marks_grade->percent_upto}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    @lang('lang.select')
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                   @if(in_array(227, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                                                   <a class="dropdown-item" href="{{url('marks-grade', [$marks_grade->id
                                                    ])}}">@lang('lang.edit')</a>
                                                   @endif
                                                   @if(in_array(228, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                                                   <a class="dropdown-item" data-toggle="modal"
                                                       data-target="#deleteMarksGradeModal{{$marks_grade->id}}"
                                                       href="#">@lang('lang.delete')</a>
                                               @endif
                                                    </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade admin-query" id="deleteMarksGradeModal{{$marks_grade->id}}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">@lang('lang.delete') @lang('lang.grade')</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg"
                                                                data-dismiss="modal">@lang('lang.cancel')</button>
                                                        {{ Form::open(['url' => 'marks-grade/'.$marks_grade->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
                                                        <button class="primary-btn fix-gr-bg"
                                                                type="submit">@lang('lang.delete')</button>
                                                        {{ Form::close() }}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
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
