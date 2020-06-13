@extends('backEnd.master')
@section('mainContent')
    @php
        function showPicName($data){
            $name = explode('/', $data);
            return $name[3];
        }
    @endphp
    <section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.complaint')</h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.admin_section')</a>
                    <a href="#">@lang('lang.complaint')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            @if(isset($complaint))
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="{{url('complaint')}}" class="primary-btn small fix-gr-bg">
                            <span class="ti-plus pr-2"></span>
                            @lang('lang.add')
                        </a>
                    </div>
                </div>
            @endif
            <div class="row">
               

                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">@if(isset($complaint))
                                        @lang('lang.edit')
                                    @else
                                        @lang('lang.add')
                                    @endif
                                    @lang('lang.complaint')
                                </h3>
                            </div>
                            @if(isset($complaint))
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'complaint/'.$complaint->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                            @else
                             @if(in_array(22, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'complaint',
                                'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            @endif
                            @endif
                            <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row no-gutters input-right-icon">
                                        @if(session()->has('message-success'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message-success') }}
                                            </div>
                                        @elseif(session()->has('message-danger'))
                                            <div class="alert alert-danger">
                                                {{ session()->get('message-danger') }}
                                            </div>
                                        @endif
                                        <div class="col">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control{{ $errors->has('complaint_by') ? ' is-invalid' : '' }}"
                                                    id="apply_date" type="text"
                                                    name="complaint_by"
                                                    value="{{isset($complaint)? $complaint->complaint_by: old('complaint_by')}}">
                                                <label>@lang('lang.complaint') @lang('lang.by')<span>*</span></label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('complaint_by'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('complaint_by') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    <input type="hidden" name="id" value="{{isset($complaint)? $complaint->id: ''}}">

                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <select
                                                class="niceSelect w-100 bb form-control{{ $errors->has('complaint_type') ? ' is-invalid' : '' }}"
                                                name="complaint_type">
                                                <option data-display="@lang('lang.complaint') @lang('lang.type')*" value="">@lang('lang.type') *</option>
                                                @foreach($complaint_types as $complaint_type)
                                                    @if(isset($complaint))
                                                        <option
                                                            value="{{$complaint_type->id}}" {{$complaint_type->id == $complaint->complaint_type? 'selected':''}}>{{$complaint_type->name}}</option>
                                                    @else
                                                        <option
                                                            value="{{$complaint_type->id}}" {{old('complaint_type') == $complaint_type->id? 'selected':''}}>{{$complaint_type->name}}</option>
                                                    @endif

                                                @endforeach
                                            </select>
                                            @if ($errors->has('complaint_type'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('complaint_type') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <select
                                                class="niceSelect w-100 bb form-control{{ $errors->has('complaint_source') ? ' is-invalid' : '' }}"
                                                name="complaint_source">
                                                <option data-display="@lang('lang.complaint') @lang('lang.source')" value="">@lang('lang.complaint') @lang('lang.source')
                                                </option>
                                                @foreach($complaint_sources as $complaint_source)
                                                    @if(isset($complaint))
                                                        <option
                                                            value="{{$complaint_source->id}}" {{$complaint_source->id == $complaint->complaint_source? 'selected':''}}>{{$complaint_source->name}}</option>
                                                    @else
                                                        <option
                                                            value="{{$complaint_source->id}}">{{$complaint_source->name}}</option>
                                                    @endif

                                                @endforeach
                                            </select>
                                            @if ($errors->has('complaint_source'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('complaint_source') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                    id="apply_date" type="text"
                                                    name="phone" value="{{isset($complaint)? $complaint->phone: ''}}">
                                                <label>@lang('lang.phone') <span>*</span></label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('phone'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters input-right-icon mt-25">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input date form-control{{ $errors->has('date') ? ' is-invalid' : '' }}"
                                                    id="startDate" type="text" name="date"
                                                    value="{{isset($complaint)? date('m/d/Y', strtotime($complaint->date)): (old('date') != ""? old('date'):date('m/d/Y'))}}">
                                                <label>@lang('lang.date') <span></span></label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('date'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('date') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>

                                    </div>

                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control{{ $errors->has('action_taken') ? ' is-invalid' : '' }}"
                                                    id="apply_date" type="text"
                                                    name="action_taken"
                                                    value="{{isset($complaint)? $complaint->action_taken: old('action_taken')}}">
                                                <label>@lang('lang.actions') @lang('lang.taken')</label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('action_taken'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('action_taken') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control{{ $errors->has('assigned') ? ' is-invalid' : '' }}"
                                                    id="apply_date" type="text" name="assigned"
                                                    value="{{isset($complaint)? $complaint->assigned: old('assigned')}}">
                                                <label>@lang('lang.assigned')</label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('assigned'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('assigned') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                @isset($complaint)
                                                    <textarea class="primary-input form-control" cols="0" rows="4"
                                                              name="description">{{ $complaint->description}}</textarea>
                                                @else
                                                    <textarea class="primary-input form-control" cols="0" rows="4"
                                                              name="description">{{old('description')}}</textarea>
                                                @endif
                                                <span class="focus-border textarea"></span>
                                                <label>@lang('lang.description') <span></span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters input-right-icon mt-35">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input" id="placeholderInput" type="text"
                                                       placeholder="{{isset($complaint)? ($complaint->file != ""? showPicName($complaint->file):'File Name'):'File Name'}}"
                                                       readonly>
                                                <span class="focus-border"></span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg"
                                                       for="browseFile">@lang('lang.browse')</label>
                                                <input type="file" class="d-none" id="browseFile" name="file">
                                            </button>
                                        </div>
                                    </div>
                                @php 
                                  $tooltip = "";
                                  if(in_array(22, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                           <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                                <span class="ti-check"></span>
                                                @if(isset($complaint))
                                                    @lang('lang.update')
                                                @else
                                                    @lang('lang.save')
                                                    @endif
                                                @lang('lang.complaint')
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
                                <h3 class="mb-0">@lang('lang.complaint') @lang('lang.list')</h3>
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
                                    <th>@lang('lang.complaint') @lang('lang.by')</th>
                                    <th>@lang('lang.complaint') @lang('lang.type')</th>
                                    <th>@lang('lang.source')</th>
                                    <th>@lang('lang.phone')</th>
                                    <th>@lang('lang.date')</th>
                                    <th>@lang('lang.actions')</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($complaints as $complaint)
                                    <tr>
                                        <td>{{$complaint->complaint_by}}</td>
                                        <td>{{$complaint->complaint_type != ""? $complaint->complaintType->name:''}}</td>
                                        <td>{{$complaint->complaint_source != ""? $complaint->complaintSource->name:''}}</td>

                                        <td>{{$complaint->phone}}</td>
                                        <td data-sort="{{strtotime($complaint->date)}}">{{ !empty($complaint->date)? App\SmGeneralSettings::DateConvater($complaint->date):''}} </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    @lang('lang.select')
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @if(in_array(26, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)

                                                    <a class="dropdown-item modalLink" title="Complaint Details"
                                                       data-modal-size="large-modal"
                                                       href="{{url('complaint', [$complaint->id])}}">@lang('lang.view')</a>
                                                    @endif
                                                       @if(in_array(23, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)

                                                       <a class="dropdown-item"
                                                       href="{{url('complaint/'.$complaint->id.'/edit')}}">@lang('lang.edit')</a>
                                                   @endif
                                                   @if(in_array(24, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)

                                                       <a class="dropdown-item" data-toggle="modal"
                                                       data-target="#deleteComplaintModal{{$complaint->id}}"
                                                       href="#">@lang('lang.delete')</a>
                                                    @endif
                                                       @if($complaint->file != "")
                                                     @if(in_array(25, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)
                                                   @if (@file_exists($complaint->file))
                                                        <a class="dropdown-item"
                                                            href="{{url('download-complaint-document/'.showPicName($complaint->file))}}">
                                                                @lang('lang.download') <span class="pl ti-download"></span>
                                                        </a>
                                                    @endif    
                                                    @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade admin-query" id="deleteComplaintModal{{$complaint->id}}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">@lang('lang.delete') @lang('lang.complaint')</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg"
                                                                data-dismiss="modal">@lang('lang.cancel')
                                                        </button>
                                                        {{ Form::open(['url' => 'complaint/'.$complaint->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
                                                        <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')
                                                        </button>
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
