@extends('backEnd.master')
@section('mainContent')
    @php
        function showPicName($data){
        $name = explode('/', $data);
        return $name[3];
        }
    @endphp
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.upload_content') @lang('lang.list')</h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.teacher')</a>
                    <a href="#">@lang('lang.upload_content') @lang('lang.list')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">

            <div class="row">

               


                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">
                                    @if(isset($editData))
                                        @lang('lang.edit')
                                    @else
                                    @endif
                                    @lang('lang.upload_content')
                                </h3>
                            </div>
                            @if(isset($editData))
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'approve-leave/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                            @else
                             @if(in_array(89, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'save-upload-content', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            @endif
                            @endif
                            <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row mb-25">
                                        @if(session()->has('message-success'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message-success') }}
                                            </div>
                                        @elseif(session()->has('message-danger'))
                                            <div class="alert alert-danger">
                                                {{ session()->get('message-danger') }}
                                            </div>
                                        @endif

                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control{{ $errors->has('content_title') ? ' is-invalid' : '' }}"
                                                    type="text" name="content_title" autocomplete="off"
                                                    value="{{isset($content_title)? $leave_type->type:''}}">
                                                <label> @lang('lang.content_title') <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('content_title'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('content_title') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb-30">
                                            <select
                                                class="niceSelect w-100 bb form-control{{ $errors->has('content_type') ? ' is-invalid' : '' }}"
                                                name="content_type" id="content_type">
                                                <option data-display="@lang('lang.content') @lang('lang.type') *" value="">@lang('lang.content') @lang('lang.type') *</option>
                                                <option value="as"> @lang('lang.assignment')</option>
                                                <option value="st">@lang('lang.study_material')</option>
                                                <option value="sy">@lang('lang.syllabus')</option>
                                                <option value="ot">@lang('lang.other_download')</option>

                                            </select>
                                            @if ($errors->has('content_type'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('content_type') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                        <div class="col-lg-12 mb-30">
                                            <label>@lang('lang.available_for') *</label><br>

                                            <div class="">
                                                <input type="checkbox" id="all_admin"
                                                       class="common-checkbox form-control{{ $errors->has('available_for') ? ' is-invalid' : '' }}"
                                                       name="available_for[]" value="admin">
                                                <label for="all_admin">@lang('lang.all') @lang('lang.admin')</label>
                                                <input type="checkbox" id="student"
                                                       class="common-checkbox form-control{{ $errors->has('available_for') ? ' is-invalid' : '' }}"
                                                       name="available_for[]" value="student">
                                                <label for="student">@lang('lang.student')</label>
                                            </div>
                                            @if($errors->has('available_for'))
                                                <span class="text-danger validate-textarea-checkbox" role="alert">
                                                <strong>{{ $errors->first('available_for') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <div class="col-lg-12 disabledbutton mb-30" id="availableClassesDiv">

                                            <div class="">
                                                <input type="checkbox" id="all_classes"
                                                       class="common-checkbox form-control" name="all_classes">
                                                <label for="all_classes">@lang('lang.available_for_all_classes')</label>
                                            </div>
                                        </div>

                                        <div
                                            class="forStudentWrapper col-lg-12 mb-20 {{$errors->has('class') || $errors->has('section')? '':'disabledbutton'}}"
                                            id="contentDisabledDiv">
                                            <div class="row">
                                                <div class="col-lg-12 mb-20">
                                                    <div class="input-effect">
                                                        <select
                                                            class="niceSelect w-100 bb form-control{{ $errors->has('class') ? ' is-invalid' : '' }}"
                                                            name="class" id="classSelectStudent">
                                                            <option data-display="@lang('lang.select_class') *"
                                                                    value="">@lang('lang.select')</option>
                                                            @foreach($classes as $value)
                                                                <option
                                                                    value="{{$value->id}}">{{$value->class_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('class'))
                                                            <span class="invalid-feedback invalid-select" role="alert">
                                                        <strong>{{ $errors->first('class') }}</strong>
                                                    </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 mb-30">
                                                    <div class="input-effect" id="sectionStudentDiv">
                                                        <select
                                                            class="niceSelect w-100 bb form-control{{ $errors->has('section') ? ' is-invalid' : '' }}"
                                                            name="section" id="sectionSelectStudent">
                                                            <option data-display="@lang('lang.select_section') *"
                                                                    value="">@lang('lang.section') *
                                                            </option>
                                                        </select>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('section'))
                                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('section') }}</strong>
                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">


                                    </div>
                                    <div class="row no-gutters input-right-icon mb-30">

                                        <div class="col">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input date form-control{{ $errors->has('upload_date') ? ' is-invalid' : '' }}"
                                                    id="upload_date" type="text"
                                                    name="upload_date"
                                                    value="{{isset($editData)? date('m/d/Y', strtotime($editData->upload_date)): date('m/d/Y')}}">
                                                <label>@lang('lang.update') @lang('lang.date') <span></span> </label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('upload_date'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('upload_date') }}</strong>
                                    </span>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="apply_date_icon"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row mb-20">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <textarea class="primary-input form-control" cols="0" rows="3"
                                                          name="description" id="description"></textarea>
                                                <label>@lang('lang.description') <span></span> </label>
                                                <span class="focus-border textarea"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters input-right-icon mb-20">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control {{ $errors->has('content_file') ? ' is-invalid' : '' }}"
                                                    readonly="true" type="text"
                                                    placeholder="{{isset($editData->file) && $editData->file != ""? showPicName($editData->file):'Attach File *'}}"
                                                    id="placeholderUploadContent">
                                                <span class="focus-border"></span>
                                                @if ($errors->has('content_file'))
                                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content_file') }}</strong>
                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg"
                                                       for="upload_content_file">@lang('lang.browse')</label>
                                                <input type="file" class="d-none form-control" name="content_file"
                                                       id="upload_content_file">
                                            </button>

                                        </div>
                                    </div>
                                      @php 
                                  $tooltip = "";
                                  if(in_array(89, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                                <span class="ti-check"></span>
                                                @lang('lang.upload_content')
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
                                <h3 class="mb-0"> @lang('lang.upload_content')  @lang('lang.list')</h3>
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
                                        <td colspan="6">
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
                                    <th> @lang('lang.content_title')</th>
                                    <th> @lang('lang.type')</th>
                                    <th> @lang('lang.date')</th>
                                    <th> @lang('lang.available_for')</th>
                                    <th> @lang('lang.class_section')</th>
                                    <th> @lang('lang.action')</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if(isset($uploadContents))
                                    @foreach($uploadContents as $value)
                                        <tr>

                                            <td>{{$value->content_title}}</td>
                                            <td>
                                                @if($value->content_type == 'as')
                                                    {{'Assignment'}}
                                                @elseif($value->content_type == 'st')
                                                    {{'Study Material'}}
                                                @elseif($value->content_type == 'sy')
                                                    {{'Syllabus'}}
                                                @else
                                                    {{'Others Download'}}
                                                @endif
                                            </td>
                                            <td  data-sort="{{strtotime($value->upload_date)}}" >
                                                 {{$value->upload_date != ""? App\SmGeneralSettings::DateConvater($value->upload_date):''}} </td>

                                            <td>
                                                @if($value->available_for_admin == 1)
                                                    {{'All admin'}}<br>
                                                @endif
                                                @if($value->available_for_all_classes == 1)
                                                    {{'All classes student'}}
                                                @endif
                                            </td>
                                            <td>

                                                @if($value->classes != "")
                                                    {{$value->classes->class_name}}
                                                @endif

                                                @if($value->sections != "")
                                                    ({{$value->sections->section_name}})
                                                @endif


                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle"
                                                            data-toggle="dropdown">
                                                        @lang('lang.select')
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">

                                                    <!--    <a data-modal-size="modal-lg" title="View Leave Details" class="dropdown-item modalLink" href="{{url('view-leave-details', $value->id)}}">Download</a> -->

                                                    <!--    <a class="dropdown-item" href="{{url('approve-leave/'.$value->id.'/edit')}}">edit</a> -->

                                                    @if(in_array(91, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                                                        <a class="dropdown-item" data-toggle="modal"
                                                           data-target="#deleteApplyLeaveModal{{$value->id}}"
                                                           href="#">@lang('lang.delete')</a>
                                                         @endif
                                                         
                                                        @if($value->upload_file != "")
                                                        @if(in_array(90, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                                                            <a class="dropdown-item"
                                                               href="{{url('download-content-document/'.showPicName($value->upload_file))}}">
                                                                @lang('lang.download') <span
                                                                    class="pl ti-download"></span>
                                                        @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade admin-query" id="deleteApplyLeaveModal{{$value->id}}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">@lang('lang.delete') @lang('lang.upload_content')</h4>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            &times;
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                        </div>

                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg"
                                                                    data-dismiss="modal">@lang('lang.cancel')</button>
                                                            <a href="{{url('delete-upload-content', [$value->id])}}"
                                                               class="text-light">
                                                                <button class="primary-btn fix-gr-bg"
                                                                        type="submit">@lang('lang.delete')</button>
                                                            </a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
