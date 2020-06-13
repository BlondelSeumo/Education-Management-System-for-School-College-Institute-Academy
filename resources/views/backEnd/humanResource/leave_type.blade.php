@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.leave_type')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.human_resource')</a>
                <a href="#">@lang('lang.leave_type')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($leave_type))
        @if(in_array(204, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('leave-type')}}" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30">@if(isset($leave_type))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif 
                                @lang('lang.leave_type')
                            </h3>
                        </div>
                @if(isset($leave_type))
                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'leave-type/'.$leave_type->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                @else
                 @if(in_array(204, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'leave-type',
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
                                    <input class="primary-input form-control{{ $errors->has('type') ? ' is-invalid' : '' }}"
                                    type="text" name="type" autocomplete="off" value="{{isset($leave_type)? $leave_type->type:''}}">
                                    <label>@lang('lang.type_name') <span>*</span> </label>
                                    <input type="hidden" name="id" value="{{isset($leave_type)? $leave_type->id: ''}}">

                                    <span class="focus-border"></span>
                                    @if ($errors->has('type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="input-effect mt-25">
                                    <input class="primary-input form-control{{ $errors->has('total_days') ? ' is-invalid' : '' }}"
                                    type="number" name="total_days" autocomplete="off" value="{{isset($leave_type)? $leave_type->total_days:''}}" min="0">
                                    <label>@lang('lang.total_days') <span>*</span> </label>
                                   <span class="focus-border"></span>
                                    @if ($errors->has('total_days'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('total_days') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                          @php 
                                  $tooltip = "";
                                  if(in_array(204, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                        <div class="row mt-40">
                            <div class="col-lg-12 text-center">
                                <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                    <span class="ti-check"></span>

                                    @if(isset($leave_type))
                                        @lang('lang.update')
                                    @else
                                        @lang('lang.save')
                                    @endif
                                    @lang('lang.type')
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
                            <h3 class="mb-0">@lang('lang.leave_type_list')</h3>
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
                                <th>@lang('lang.type')</th>
                                <th>@lang('lang.total_days')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($leave_types as $leave_type)
                            <tr>
                                <td>{{$leave_type->type}}</td>
                                <td>{{$leave_type->total_days}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            @lang('lang.select')
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @if(in_array(205, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                                            <a class="dropdown-item" href="{{url('leave-type', [$leave_type->id
                                                ])}}">@lang('lang.edit')</a>
                                               @endif
                                               @if(in_array(206, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                                               <a class="dropdown-item" data-toggle="modal" data-target="#deleteLeaveTypeModal{{$leave_type->id}}"
                                                    href="#">@lang('lang.delete')</a>
                                               @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade admin-query" id="deleteLeaveTypeModal{{$leave_type->id}}" >
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">@lang('lang.delete') @lang('lang.leave_type')</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                        {{ Form::open(['url' => 'leave-type/'.$leave_type->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
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
