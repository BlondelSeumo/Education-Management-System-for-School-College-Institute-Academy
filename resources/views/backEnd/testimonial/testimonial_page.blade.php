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
                <h1>@lang('lang.add_testimonial')</h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.testimonial')</a>
                    <a href="#">@lang('lang.add_testimonial')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            @if(isset($add_testimonial))
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="{{url('testimonial')}}" class="primary-btn small fix-gr-bg">
                            <span class="ti-plus pr-2"></span>
                            @lang('lang.add')
                        </a>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">@if(isset($add_testimonial))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.testimonial')
                            </h3>
                        </div>
                        @if(isset($add_testimonial))
                            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update_testimonial',
                            'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'add-income-update']) }}
                        @else
                            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'store_testimonial',
                            'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'add-income']) }}
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
                                        @if ($errors->any())
                                            <div class="error text-danger">
                                                <strong>{{ 'Please fill up the required fields' }}</strong></div>
                                        @endif
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                type="text" name="name" autocomplete="off"
                                                value="{{isset($add_testimonial)? $add_testimonial->name: old('name')}}">
                                            <input type="hidden" name="id" value="{{isset($add_testimonial)? $add_testimonial->id: ''}}">
                                            <label>@lang('lang.name') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>



                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}"
                                                   type="text" name="designation" autocomplete="off"
                                                   value="{{isset($add_testimonial)? $add_testimonial->designation: old('designation')}}">
                                            <label>@lang('lang.designation') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('designation'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('designation') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('institution_name') ? ' is-invalid' : '' }}"
                                                   type="text" name="institution_name" autocomplete="off"
                                                   value="{{isset($add_testimonial)? $add_testimonial->institution_name: old('institution_name')}}">
                                            <label>@lang('lang.institution_name') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('institution_name'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('institution_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="row no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input" type="text" id="placeholderFileOneName"
                                                           placeholder="{{isset($add_testimonial)? ($add_testimonial->image !="") ? showPicName($add_testimonial->image) :'image' :'image' }}"
                                                           readonly
                                                    >
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                           for="document_file_1">@lang('lang.browse')</label>
                                                    <input type="file" class="d-none" name="image" id="document_file_1">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4"
                                                      name="description">{{isset($add_testimonial)? $add_testimonial->description: old('description')}}</textarea>
                                            <label>@lang('lang.description') <span></span></label>
                                            <span class="focus-border textarea"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg">
                                            <span class="ti-check"></span>
                                            @if(isset($add_testimonial))
                                                @lang('lang.edit')
                                            @else
                                                @lang('lang.add')
                                            @endif
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
                            <h3 class="mb-0">@lang('lang.news_list')</h3>
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
                                    <td colspan="7">
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
                                <th>@lang('lang.name')</th>
                                <th>@lang('lang.designation')</th>
                                <th>@lang('lang.institution_name')</th>
                                <th>@lang('lang.image')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($testimonial as $value)
                                <tr>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->designation}}</td>
                                    <td>{{$value->institution_name}}</td>
                                    <td><img src="{{asset($value->image)}}" width="60px" height="50px"></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{url('testimonial-details/'.$value->id)}}" class="dropdown-item small fix-gr-bg modalLink" title="Testimonial Details" data-modal-size="modal-lg">
                                                    @lang('lang.view')
                                                </a>
                                                <a class="dropdown-item" href="{{url('edit-testimonial/'.$value->id)}}">@lang('lang.edit')</a>
                                                <a href="{{url('for-delete-testimonial/'.$value->id)}}" class="dropdown-item small fix-gr-bg modalLink" title="Delete News" data-modal-size="modal-md">
                                                    @lang('lang.delete')
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

