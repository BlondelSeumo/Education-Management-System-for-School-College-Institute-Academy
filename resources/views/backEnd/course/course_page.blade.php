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
                <h1>Add Course</h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">Course</a>
                    <a href="#">Add Course</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            @if(isset($add_course))
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="{{url('course-list')}}" class="primary-btn small fix-gr-bg">
                            <span class="ti-plus pr-2"></span>
                            @lang('lang.add')
                        </a>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">@if(isset($add_course))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                Course
                            </h3>
                        </div>
                        @if(isset($add_course))
                            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update_course',
                            'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'add-income-update']) }}
                        @else
                            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'store_course',
                            'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'add-income']) }}
                        @endif
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if(session()->has('message-success'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message-success') }}
                                            </div>
                                        @elseif(session()->has('message-danger'))
                                            <div class="alert alert-danger">
                                                {{ session()->get('message-danger') }}
                                            </div>
                                        @endif
                                        @if ($errors->any())
                                            <div class="error text-danger">
                                                <strong>{{ 'Please fill up the required fields' }}</strong></div>
                                        @endif
                                    </div>
                                    <div class="col-lg-12 mt-40">
                                        <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input class="primary-input form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                           type="text" name="title" autocomplete="off"
                                                           value="{{isset($add_course)? $add_course->title: old('title')}}">
                                                    <input type="hidden" name="id"
                                                           value="{{isset($add_course)? $add_course->id: ''}}">
                                                    <label>@lang('lang.title') <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('title'))
                                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 ">
                                        <div class="row mt-40">
                                            <div class="col-md-6 mt-40">
                                                <div class="row mt-40">
                                                    <div class="input-effect">
                                                             <textarea class="primary-input form-control" cols="0"
                                                                       rows="9"
                                                                       name="overview">{{isset($add_course)? $add_course->overview: old('overview')}}</textarea>
                                                        <label>Overview <span></span></label>
                                                        <span class="focus-border textarea"></span>
                                                    </div>
                                                </div>
                                                <div class="row mt-40">
                                                    <div class="col-lg-12 mt-40">
                                                        <div class="input-effect">
                                                        <textarea class="primary-input form-control" cols="0" rows="9"
                                                                  name="outline">{{isset($add_course)? $add_course->outline: old('outline')}}</textarea>
                                                            <label>Outline <span></span></label>
                                                            <span class="focus-border textarea"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-40">
                                                    <div class="col-lg-12 mt-40">
                                                        <div class="input-effect">
                                                                <textarea class="primary-input form-control" cols="0"
                                                                          rows="9"
                                                                          name="prerequisites">{{isset($add_course)? $add_course->prerequisites: old('prerequisites')}}</textarea>
                                                            <label>Prerequisites <span></span></label>
                                                            <span class="focus-border textarea"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-40">
                                                <div class="row ">
                                                    <div class="col-lg-12 mt-40">
                                                        <div class="input-effect">
                                                        <textarea class="primary-input form-control" cols="0" rows="9"
                                                                  name="resources">{{isset($add_course)? $add_course->resources: old('resources')}}</textarea>
                                                            <label>resources<span></span></label>
                                                            <span class="focus-border textarea"></span>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-lg-12 mt-40">
                                                        <div class="input-effect">
                                                        <textarea class="primary-input form-control" cols="0" rows="9"
                                                                  name="stats">{{isset($add_course)? $add_course->stats: old('stats')}}</textarea>
                                                            <label>stats <span></span></label>
                                                            <span class="focus-border textarea"></span>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row no-gutters input-right-icon mt-50">
                                                    <div class="col">
                                                        <div class="row no-gutters input-right-icon">
                                                            <div class="col">
                                                                <div class="input-effect">
                                                                    <input class="primary-input" type="text"
                                                                           id="placeholderFileOneName"
                                                                           placeholder="{{isset($add_course)? ($add_course->image !="") ? showPicName($add_course->image) :'image' :'image' }}"
                                                                           readonly
                                                                    >
                                                                    <span class="focus-border"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <button class="primary-btn-small-input" type="button">
                                                                    <label class="primary-btn small fix-gr-bg"
                                                                           for="document_file_1">@lang('lang.browse')</label>
                                                                    <input type="file" class="d-none" name="image"
                                                                           id="document_file_1">
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg">
                                            <span class="ti-check"></span>
                                            @if(isset($add_course))
                                                @lang('lang.edit')
                                            @else
                                                @lang('lang.add')
                                            @endif
                                            Course
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-40">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">Course List</h3>
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
                                <th>@lang('lang.title')</th>
                                <th>overview</th>
                                <th>@lang('lang.image')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if(isset($course))
                                @foreach($course as $value)
                                    <tr>
                                        <td>{{$value->title}}</td>
                                        <td>{!! substr($value->overview, 0, 50) !!}</td>
                                        <td><img src="{{asset($value->image)}}" width="60px" height="50px"></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    @lang('lang.select')
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="{{url('course-Details-admin/'.$value->id)}}"
                                                       class="dropdown-item small fix-gr-bg modalLink"
                                                       title="Course Details" data-modal-size="full-width-modal">
                                                        @lang('lang.view')
                                                    </a>
                                                    <a class="dropdown-item"
                                                       href="{{url('edit-course/'.$value->id)}}">@lang('lang.edit')</a>
                                                    <a href="{{url('for-delete-course/'.$value->id)}}"
                                                       class="dropdown-item small fix-gr-bg modalLink"
                                                       title="Delete Course" data-modal-size="modal-md">
                                                        @lang('lang.delete')
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

