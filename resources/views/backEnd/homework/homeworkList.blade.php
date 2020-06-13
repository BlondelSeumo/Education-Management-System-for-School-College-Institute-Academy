@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.homework_list')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.home_work')</a>
                <a href="#">@lang('lang.homework_list')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.select_criteria') </h3>
                </div>
            </div>
            <div class="col-lg-4 text-md-right text-left col-md-6 mb-30-lg">
                <a href="{{route('add-homeworks')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.add_homework')
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'homework-list', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                    <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="input-effect">
                                <select class="niceSelect w-100 bb form-control{{ $errors->has('class_id') ? ' is-invalid' : '' }}" name="class_id" id="classSelectStudent">
                                <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select')</option>
                                    @foreach($classes as $key=>$value)
                                    <option value="{{$value->id}}">{{$value->class_name}}</option>
                                    @endforeach
                                </select>
                                <span class="focus-border"></span>
                                @if ($errors->has('class_id'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('class_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="input-effect" id="sectionStudentDiv">
                                <select class="niceSelect w-100 bb form-control{{ $errors->has('section_id') ? ' is-invalid' : '' }}" name="section_id" id="sectionSelectStudent">
                                     <option data-display="@lang('lang.select_section')" value="">@lang('lang.section')</option>
                                 </select>
                                 <span class="focus-border"></span>
                                 @if ($errors->has('section_id'))
                                 <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('section_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="input-effect" id="subjectSelecttDiv">
                                <select class="niceSelect w-100 bb form-control{{ $errors->has('subject_id') ? ' is-invalid' : '' }}" name="subject_id" id="subjectSelect">
                                    <option data-display="@lang('lang.select_subjects')" value="">@lang('lang.subject')</option>
                                </select>
                                <span class="focus-border"></span>
                                @if ($errors->has('subject_id'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('subject_id') }}</strong>
                                </span>
                                @endif
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
    <div class="row mt-40">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-0">@lang('lang.homework_list')</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                        <thead>
                            
                            @if(session()->has('message-success') != "" ||
                            session()->get('message-danger') != "")
                            <tr>
                                <td colspan="9">
                                     @if(session()->has('message-success'))
                                      <div class="alert alert-success">
                                          {{ session()->get('message-success') }}
                                      </div>
                                    @elseif(session()->has('message-danger'))
                                      <div class="alert alert-danger">
                                          {{ session()->get('message-danger') }}
                                      </div>
                                    @endif
                                </td>
                            </tr>
                             @endif
                            
                            <tr>
                                <th>@lang('lang.class')</th>
                                <th>@lang('lang.section')</th>
                                <th>@lang('lang.subject')</th>
                                <th>@lang('lang.marks')</th>
                                <th>@lang('lang.home_work') @lang('lang.date')</th>
                                <th>@lang('lang.submission') @lang('lang.date')</th>
                                <th>@lang('lang.evaluation') @lang('lang.date')</th>
                                <th>@lang('lang.created_by')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($homeworkLists as $value)
                            <tr>
                                <td>{{$value->classes  !=""?$value->classes->class_name:""}}</td>
                                <td>{{$value->sections !=""?$value->sections->section_name:""}}</td>
                                <td>{{$value->subjects !=""?$value->subjects->subject_name:""}}</td>
                                <td>{{$value->marks}}</td>
                                 <td  data-sort="{{strtotime($value->homework_date)}}" >
                                    {{$value->homework_date != ""? App\SmGeneralSettings::DateConvater($value->homework_date):''}}

                                </td>
                                 <td  data-sort="{{strtotime($value->submission_date)}}" >
                                    {{$value->submission_date != ""? App\SmGeneralSettings::DateConvater($value->submission_date):''}}

                                </td>
                                <td  data-sort="{{strtotime($value->evaluation_date)}}" >
                                @if(!empty($value->evaluation_date))
                                {{$value->evaluation_date != ""? App\SmGeneralSettings::DateConvater($value->evaluation_date):''}}

                                @endif
                                </td>
                              
                               <td>{{$value->users !=""? $value->users->full_name:""}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            @lang('lang.select')
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                          @if(in_array(281, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                                            <a class="dropdown-item modalLink" title="Evaluation Homework" data-modal-size="full-width-modal" href="{{url('evaluation-homework/'.$value->class_id.'/'.$value->section_id.'/'.$value->id)}}">@lang('lang.evaluation')</a>
                                         @endif
                                          @if(in_array(282, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                                           <a class="dropdown-item" href="{{route('homework_edit', [$value->id])}}">@lang('lang.edit')</a>
                                           @endif
                                            @if(in_array(283, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                                           <a class="dropdown-item" data-toggle="modal" data-target="#deleteHomework{{$value->id}}"  href="#">@lang('lang.delete')</a>
                                        @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade admin-query" id="deleteHomework{{$value->id}}" >
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">@lang('lang.delete') @lang('lang.home_work')</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="text-center">
                                                <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                            </div>

                                            <div class="mt-40 d-flex justify-content-between">
                                                <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                <a href="{{route('homework_delete', [$value->id])}}" class="text-light">
                                                <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                                                 </a>
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
