@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.phone_call_log')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.admin_section')</a>
                <a href="#">@lang('lang.phone_call_log')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($phone_call_log))
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('phone-call')}}" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30">@if(isset($phone_call_log))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.phone_call')
                            </h3>
                        </div>
                        @if(isset($phone_call_log))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'phone-call/'.$phone_call_log->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                        @else
                        @if(in_array(37, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'phone-call',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        @endif
                        @endif
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
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
                                            <input class="primary-input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="apply_date" type="text"
                                                name="name" value="{{isset($phone_call_log)? $phone_call_log->name: old('name')}}">
                                            <label>@lang('lang.name')</label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>

                                <input type="hidden" name="id" value="{{isset($phone_call_log)? $phone_call_log->id: ''}}">

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" id="apply_date" type="text"
                                                name="phone" value="{{isset($phone_call_log)? $phone_call_log->phone: old('phone')}}">
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
                                            <input class="primary-input date form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" id="startDate" type="text" name="date" value="{{isset($phone_call_log)? $phone_call_log->date: date('m/d/Y')}}" autocomplete="off">
                                            <span class="focus-border"></span>
                                            <label>@lang('lang.date') <span></span></label>
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
                                
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" id="startDate" type="text" name="follow_up_date" value="{{isset($phone_call_log)? $phone_call_log->date: date('m/d/Y')}}" autocomplete="off">
                                            <span class="focus-border"></span>
                                            <label>@lang('lang.follow_up_date') <span></span></label>
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
                                            <input class="primary-input form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" id="apply_date" type="text"
                                                name="call_duration" value="{{isset($phone_call_log)? $phone_call_log->call_duration: old('call_duration')}}">
                                            <label>@lang('lang.call_duration')</label>
                                            <span class="focus-border"></span>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            @isset($phone_call_log)
                                            <textarea class="primary-input form-control" cols="0" rows="4"  name="description"> {{$phone_call_log->description}}</textarea>
                                            @else
                                            <textarea class="primary-input form-control" cols="0" rows="4"  name="description">{{old('description')}}</textarea>
                                            @endif
                                            <span class="focus-border textarea"></span>
                                            <label>@lang('lang.description') <span></span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10">@lang('lang.type')</p>
                                        <div class=" radio-btn-flex ml-20">
                                            @if(isset($phone_call_log))
                                            <div class="mr-30">
                                                <input type="radio" name="call_type" id="relationFather" value="I" {{$phone_call_log->call_type == 'I'? 'checked': ''}} class="common-radio relationButton">
                                                <label for="relationFather">@lang('lang.incoming')</label>
                                            </div><br>
                                            <div class="mr-30">
                                                <input type="radio" name="call_type" id="relationMother" value="O" {{$phone_call_log->call_type == 'O'? 'checked': ''}} class="common-radio relationButton">
                                                <label for="relationMother">@lang('lang.outgoing')</label>
                                            </div>
                                            @else
                                            <div class="mr-30">
                                                <input type="radio" name="call_type" id="relationFather" value="I" class="common-radio relationButton" checked>
                                                <label for="relationFather">@lang('lang.incoming')</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="call_type" id="relationMother" value="O" class="common-radio relationButton">
                                                <label for="relationMother">@lang('lang.outgoing')</label>
                                            </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                  @php 
                                  $tooltip = "";
                                  if(in_array(37, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            @if(isset($phone_call_log))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                            @lang('lang.phone_call')
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
                            <h3 class="mb-0">@lang('lang.phone_call') @lang('lang.list')</h3>
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
                                    <td colspan="8">
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
                                    <th>@lang('lang.phone')</th>
                                    <th>@lang('lang.date')</th>
                                    <th>@lang('lang.follow_up_date')</th>
                                    <th>@lang('lang.call_duration')</th>
                                    <th>@lang('lang.description')</th>
                                    <th>@lang('lang.call') @lang('lang.type')</th>
                                    <th>@lang('lang.actions')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($phone_call_logs as $phone_call_log)
                                <tr>
                                    <td>{{$phone_call_log->name}}</td>
                                    <td>{{$phone_call_log->phone}}</td>
                                    <td>
                                        {{$phone_call_log->date != ""? App\SmGeneralSettings::DateConvater($phone_call_log->date):''}}

                                   
                                    </td>
                                    <td>
                                        {{$phone_call_log->next_follow_up_date != ""? App\SmGeneralSettings::DateConvater($phone_call_log->next_follow_up_date):''}}

                                       
                                    </td>

                                    <td>{{$phone_call_log->call_duration}}</td>
                                    <td>{{$phone_call_log->description}}</td>
                                    <td>{{$phone_call_log->call_type == "I"? 'Incoming': 'outgoing'}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @if(in_array(38, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                                                <a class="dropdown-item" href="{{url('phone-call', [$phone_call_log->id
                                                    ])}}">@lang('lang.edit')</a>
                                                    @endif
                                                     @if(in_array(39, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                                               
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteCallLogModal{{$phone_call_log->id}}"
                                                    href="#">@lang('lang.delete')</a>
                                            @endif
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteCallLogModal{{$phone_call_log->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.phone_call')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                     {{ Form::open(['url' => 'phone-call/'.$phone_call_log->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
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
