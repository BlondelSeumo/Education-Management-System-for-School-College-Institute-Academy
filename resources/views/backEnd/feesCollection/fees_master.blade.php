@extends('backEnd.master')
@section('mainContent')
@php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } @endphp
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.fees_master')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.fees_collection')</a>
                <a href="#">@lang('lang.fees_master')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($fees_master))
         @if(in_array(119, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                       
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('add-expense')}}" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30">@if(isset($fees_master))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.fees_master')
                            </h3>
                        </div>
                        @if(isset($fees_master))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true,  'url' => 'fees-master/'.$fees_master->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'id' => 'fees_master_form']) }}
                        @else
                         @if(in_array(119, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'fees-master',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'fees_master_form']) }}
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
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('fees_group') ||  session()->has('message-exist')? ' is-invalid' : '' }}" name="fees_group" id="fees_group" {{isset($fees_master)? 'disabled': ''}}>
                                            <option data-display="@lang('lang.fees_group') *" value="">@lang('lang.fees_group') *</option>
                                            @foreach($fees_groups as $fees_group)
                                                @if(isset($fees_master))
                                                    <option value="{{$fees_group->id}}" {{$fees_group->id == $fees_master->fees_group_id? 'selected':''}}>{{$fees_group->name}}</option>
                                                @else
                                                    <option value="{{$fees_group->id}}">{{$fees_group->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if (session()->has('message-exist'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ session()->get('message-exist') }}</strong>
                                        </span>
                                        @endif
                                        @if ($errors->has('fees_group'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('fees_group') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('fees_type') ? ' is-invalid' : '' }}" name="fees_type">
                                            <option data-display="@lang('lang.fees_type') *" value="">@lang('lang.fees_type') *</option>
                                            @foreach($fees_types as $fees_type)
                                                @if(isset($fees_master))
                                                    <option value="{{$fees_type->id}}" {{$fees_type->id == $fees_master->fees_type_id? 'selected':''}}>{{$fees_type->name}}</option>
                                                @else
                                                    <option value="{{$fees_type->id}}">{{$fees_type->name}}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                        @if ($errors->has('fees_type'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('fees_type') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{isset($fees_master)? $fees_master->id: ''}}">
                                <input type="hidden" name="fees_group_id" value="{{isset($fees_master)? $fees_master->fees_group_id: ''}}">

                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" id="startDate" type="text" name="date" value="{{isset($fees_master)? date('Y/m/d', strtotime($fees_master->date)) : date('m/d/Y')}}">
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
                                @if(old('fees_group') != 1 && old('fees_group') != 2)
                                    @if(isset($fees_master))
                                        @if($fees_master->fees_group_id != 1 && $fees_master->fees_group_id != 2)
                                        <div class="row  mt-25" id="fees_master_amount">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input class="primary-input form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                                        type="number" name="amount" autocomplete="off" value="{{isset($fees_master)? $fees_master->amount:''}}">
                                                        <label>@lang('lang.amount') <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('amount'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('amount') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @else
                                        <div class="row  mt-25" id="fees_master_amount">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input class="primary-input form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                                        type="number" name="amount" autocomplete="off" value="{{isset($fees_master)? $fees_master->amount:''}}">
                                                    <label>@lang('lang.amount') <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('amount'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('amount') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
	  @php 
                                  $tooltip = "";
                                  if(in_array(119, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp

                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            @if(isset($fees_master))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                            @lang('lang.master')
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
                            <h3 class="mb-0">@lang('lang.fees_master') @lang('lang.list')</h3>
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
                                    <td colspan="3">
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
                                    <th>@lang('lang.group')</th>
                                    <th>@lang('lang.type')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($fees_masters as $values)
                                    
                                <tr>
                                    <td valign="top">
                                        @php $i = 0; @endphp
                                        @foreach($values as $fees_master)
                                        @php $i++; @endphp
                                        @if($i == 1)
                                            {{$fees_master->feesGroups->name}} 
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($values as $fees_master)
 
                                        <div class="row">
                                            <div class="col-sm-4" style="border-bottom: 1px solid #d9dce7; padding-top: 5px">
                                                {{$fees_master->feesTypes !=""?$fees_master->feesTypes->name:''}} 
                                            </div>
                                            <div class="col-sm-2" style="border-bottom: 1px solid #d9dce7; padding-top: 5px">
                                                {{$currency}} {{ number_format((float)$fees_master->amount, 2, '.', '')}}
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="dropdown mb-20">
                                                     
                                                    <button type="button" class="btn dropdown-toggle ml-20" data-toggle="dropdown">
                                                        @lang('lang.select')
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                       @if(in_array(120, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                                                        <a class="dropdown-item" href="{{url('fees-master', [$fees_master->id])}}">@lang('lang.edit')</a>
                                                       @endif
                                                        @if(in_array(121, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                                                        <a class="dropdown-item deleteFeesMasterSingle" data-toggle="modal" data-target="#deleteFeesMasterSingle"
                                                            href="#" data-id="{{$fees_master->id}}">@lang('lang.delete')</a>
                                                   @endif
                                                        </div>
                                                </div>
 
                                            </div>
                                        </div>
                                         @endforeach
                                    </td>
                                    <td valign="top">
                                        @php $i = 0; @endphp
                                        @foreach($values as $fees_master)
                                        @php $i++; @endphp
                                        @if($i == 1)
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                @if(in_array(122, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                                                <a class="dropdown-item" href="{{route('fees_assign', [$fees_master->fees_group_id])}}">@lang('lang.assign')/@lang('lang.view')</a>
                                                @endif
                                                <a class="dropdown-item deleteFeesMasterGroup" data-toggle="modal" href="#" data-id="{{$fees_master->fees_group_id}}" data-target="#deleteFeesMasterGroup">@lang('lang.delete')</a>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach

                                    </td>
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

<div class="modal fade admin-query" id="deleteFeesMasterSingle" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('lang.delete') @lang('lang.item')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                     {{ Form::open(['url' => 'fees-master-single-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                     <input type="hidden" name="id" id="fees_master_single_id">
                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                     {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade admin-query" id="deleteFeesMasterGroup" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('lang.delete') @lang('lang.item')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                     {{ Form::open(['url' => 'fees-master-group-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                     <input type="hidden" name="id" id="fees_master_group_id">
                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                     {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
