@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.leave_define')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.human_resource')</a>
                <a href="#">@lang('lang.leave_define')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        @if(isset($leave_define))
         @if(in_array(200, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
               
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('leave-define')}}" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30">@if(isset($leave_define))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.leave_define')
                            </h3>
                        </div>
                @if(isset($leave_define))
                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'leave-define/'.$leave_define->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                @else
                 @if(in_array(200, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'leave-define',
                'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                @endif
                @endif
                <input type="hidden" name="id" value="{{isset($leave_define)? $leave_define->id:''}}">
                <div class="white-box">
                    <div class="add-visitor">
                        <div class="row mt-25">
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
                                <select class="niceSelect w-100 bb form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role">
                                    <option data-display="@lang('lang.role') *" value="">@lang('lang.role') *</option>
                                    @foreach($roles as $role)
                                            <option value="{{$role->id}}" {{isset($leave_define)? ($leave_define->role_id == $role->id? 'selected':''):''}}>{{$role->name}}</option>

                                    @endforeach
                                </select>
                                @if ($errors->has('role'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-25">
                            <div class="col-lg-12">
                                <select class="niceSelect w-100 bb form-control{{ $errors->has('leave_type') ? ' is-invalid' : '' }}" name="leave_type">
                                    <option data-display="@lang('lang.leave_type')  *" value="">@lang('lang.leave_type') *</option>
                                    @foreach($leave_types as $leave_type)
                                            <option value="{{$leave_type->id}}" {{isset($leave_define)? ($leave_define->type_id == $leave_type->id? 'selected':''):''}}>{{$leave_type->type}}</option>

                                    @endforeach
                                </select>
                                @if ($errors->has('leave_type'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('leave_type') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-30">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('days') ? ' is-invalid' : '' }}"
                                    type="text" name="days" autocomplete="off" value="{{isset($leave_define)? $leave_define->days:''}}">
                                    <label>@lang('lang.days') <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('days'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('days') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                                 @php 
                                  $tooltip = "";
                                  if(in_array(200, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                        <div class="row mt-40">
                            <div class="col-lg-12 text-center">
                                 <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                    <span class="ti-check"></span>
                                    @if(isset($leave_define))
                                        @lang('lang.update')
                                    @else
                                        @lang('lang.save')
                                    @endif
                                    @lang('lang.leave_define')
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
                            <h3 class="mb-0">@lang('lang.leave_define') @lang('lang.list')</h3>
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
                                <th>@lang('lang.role')</th>
                                <th>@lang('lang.leave_type')</th>
                                <th>@lang('lang.days')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($leave_defines as $leave_define)
                            <tr>
                                <td>{{$leave_define->role !=""?$leave_define->role->name:""}}</td>
                                <td>{{$leave_define->leaveType !=""?$leave_define->leaveType->type:""}}</td>
                                <td>{{$leave_define->days}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            @lang('lang.select')
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">

                                            @if(in_array(201, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                                            <a class="dropdown-item" href="{{url('leave-define', [$leave_define->id
                                                ])}}">@lang('lang.edit')</a>
                                                @endif
                                                @if(in_array(202, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteLeaveDefineModal{{$leave_define->id}}"
                                                    href="#">@lang('lang.delete')</a>
                                                @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade admin-query" id="deleteLeaveDefineModal{{$leave_define->id}}" >
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">@lang('lang.delete') @lang('lang.leave_define')</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                        {{ Form::open(['url' => 'leave-define/'.$leave_define->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
                                                        <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
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
