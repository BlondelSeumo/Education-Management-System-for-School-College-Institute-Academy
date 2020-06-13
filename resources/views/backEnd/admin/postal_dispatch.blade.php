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
            <h1>@lang('lang.postal_dispatch')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.admin_section')</a>
                <a href="#">@lang('lang.postal_dispatch')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($postal_dispatch))
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('postal-dispatch')}}" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30">@if(isset($postal_dispatch))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.postal_dispatch')
                            </h3>
                        </div>
                        @if(isset($postal_dispatch))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'postal-dispatch/'.$postal_dispatch->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                        @else
                         @if(in_array(33, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'postal-dispatch',
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
                                            <input class="primary-input form-control{{ $errors->has('to_title') ? ' is-invalid' : '' }}" id="apply_date" type="text"
                                                name="to_title" value="{{isset($postal_dispatch)? $postal_dispatch->to_title: old('to_title')}}">
                                            <label>@lang('lang.to_title')<span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('to_title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('to_title') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>

                                <input type="hidden" name="id" value="{{isset($postal_dispatch)? $postal_dispatch->id: ''}}">

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('reference_no') ? ' is-invalid' : '' }}" id="apply_date" type="text"
                                                name="reference_no" value="{{isset($postal_dispatch)? $postal_dispatch->reference_no: old('reference_no')}}">
                                            <label>@lang('lang.reference') @lang('lang.no')</label>
                                            <span class="focus-border"></span>
                                             @if ($errors->has('reference_no'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('reference_no') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" id="apply_date" type="text"
                                                name="address" value="{{isset($postal_dispatch)? $postal_dispatch->address: old('address')}}">
                                            <label>@lang('lang.address')</label>
                                            <span class="focus-border"></span>
                                             @if ($errors->has('phone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            @isset($postal_dispatch)
                                            <textarea class="primary-input form-control" cols="0" rows="4"  name="note"> {{$postal_dispatch->note}}</textarea>
                                            @else
                                            <textarea class="primary-input form-control" cols="0" rows="4"  name="note">{{old('note')}}</textarea>
                                            @endif
                                            <span class="focus-border textarea"></span>
                                            <label>@lang('lang.note')</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('from_title') ? ' is-invalid' : '' }}" id="apply_date" type="text"
                                                name="from_title" value="{{isset($postal_dispatch)? $postal_dispatch->from_title: old('from_title')}}">
                                            <label>@lang('lang.from_title')</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" id="startDate" readonly type="text" name="date" value="{{isset($postal_dispatch)? $postal_dispatch->date: date('m/d/Y')}}">
                                            <span class="focus-border"></span>
                                            <label>@lang('lang.date')</label>
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
                                
                                <div class="row no-gutters input-right-icon mt-35">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input" id="placeholderInput" type="text" placeholder="{{isset($postal_dispatch)? ($postal_dispatch->file != ""? showPicName($postal_dispatch->file):'File Name'):'File Name'}}" readonly>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="browseFile">@lang('lang.browse')</label>
                                            <input type="file" class="d-none" id="browseFile" name="file">
                                        </button>
                                    </div>
                                </div>
                                  @php 
                                  $tooltip = "";
                                  if(in_array(33, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            @if(isset($postal_dispatch))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                            @lang('lang.postal_dispatch')
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
                            <h3 class="mb-0">@lang('lang.postal_dispatch') @lang('lang.list')</h3>
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
                                    <th>@lang('lang.to_title')</th>
                                    <th>@lang('lang.reference') @lang('lang.no')</th>
                                    <th>@lang('lang.address')</th>
                                    <th>@lang('lang.from_title')</th>
                                    <th>@lang('lang.note')</th>
                                    <th>@lang('lang.date')</th>
                                    <th>@lang('lang.actions')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($postal_dispatchs as $postal_dispatch)
                                <tr>
                                    <td>{{$postal_dispatch->to_title}}</td>
                                    <td>{{$postal_dispatch->reference_no}}</td>
                                    <td>{{$postal_dispatch->address}}</td>
                                    <td>{{$postal_dispatch->from_title}}</td>
                                    <td>{{$postal_dispatch->note}}</td>
                                    <td  data-sort="{{strtotime($postal_dispatch->date)}}" >{{ !empty($postal_dispatch->date)? App\SmGeneralSettings::DateConvater($postal_dispatch->date):''}} </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                 @if(in_array(34, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)
                                                <a class="dropdown-item" href="{{url('postal-dispatch', [$postal_dispatch->id
                                                    ])}}">@lang('lang.edit')</a>
                                               @endif
                                                @if(in_array(35, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)
                                               <a class="dropdown-item" data-toggle="modal" data-target="#deletePostalReceiveModal{{$postal_dispatch->id}}"
                                                    href="#">@lang('lang.delete')</a>
                                                @endif
                                                    @if($postal_dispatch->file != "")
                                                  @if(in_array(40, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)
                                                  
                                                  @if (@file_exists($postal_dispatch->file))
                                                        <a class="dropdown-item" href="{{url('public/uploads/postal-dispatch-document/'.showPicName($postal_dispatch->file))}}">
                                                            @lang('lang.download') <span class="pl ti-download"></span>
                                                        </a>
                                                    @endif
                                                @endif    
                                                @endif    
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deletePostalReceiveModal{{$postal_dispatch->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.postal_dispatch')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                     {{ Form::open(['url' => 'postal-dispatch/'.$postal_dispatch->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
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
