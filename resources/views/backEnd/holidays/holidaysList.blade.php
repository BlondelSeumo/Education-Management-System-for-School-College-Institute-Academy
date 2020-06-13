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
            <h1>@lang('lang.holiday') @lang('lang.list')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.system_settings')</a>
                <a href="#">@lang('lang.holiday') @lang('lang.list')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($editData))
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('holiday')}}" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30">@if(isset($editData))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.holiday')
                            </h3>
                        </div>
                        @if(isset($editData))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'holiday/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                        @else
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'holiday',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
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

                                    <div class="col-lg-12 mb-20">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('holiday_title') ? ' is-invalid' : '' }}"
                                            type="text" name="holiday_title" autocomplete="off" value="{{isset($editData)? $editData->holiday_title : '' }}">
                                            <label>@lang('lang.holiday') @lang('lang.title') <span>*</span> </label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('holiday_title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('holiday_title') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">

                                </div>
                                <div class="row no-gutters input-right-icon mb-30">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control{{ $errors->has('from_date') ? ' is-invalid' : '' }}" id="event_from_date" type="text"
                                            name="from_date" value="{{isset($editData)? date('m/d/Y', strtotime($editData->from_date)): date('m/d/Y')}}" autocomplete="off">
                                            <label>@lang('lang.from_date') <span></span> </label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('from_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('from_date') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="event_start_date"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row no-gutters input-right-icon mb-30">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control{{ $errors->has('to_date') ? ' is-invalid' : '' }}" id="event_to_date" type="text"
                                            name="to_date" value="{{isset($editData)? date('m/d/Y', strtotime($editData->to_date)): date('m/d/Y')}}" autocomplete="off">
                                            <label>@lang('lang.to_date')<span></span> </label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('to_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('to_date') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="event_end_date"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row mb-20">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" cols="0" rows="4" name="details">{{isset($editData)? $editData->details: ''}}</textarea>
                                            <label>@lang('lang.description') <span>*</span> </label>
                                            <span class="focus-border textarea"></span>
                                            @if ($errors->has('details'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('details') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mb-30">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control" name="upload_file_name" type="text" 
                                            placeholder="{{isset($editData->upload_image_file) && $editData->upload_image_file != ""? showPicName($editData->upload_image_file):'Attach File'}}"
                                            id="placeholderHolidayFile" readonly>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="upload_holiday_image">@lang('lang.browse')</label>
                                            <input type="file" class="d-none form-control" name="upload_file_name" id="upload_holiday_image">
                                        </button>

                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg">
                                            <span class="ti-check"></span>
                                            @if(isset($editData))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
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
                        <h3 class="mb-0">@lang('lang.holiday') @lang('lang.list')</h3>
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
                            <th>@lang('lang.holiday') @lang('lang.title')</th>
                            <th>@lang('lang.from_date')</th>
                            <th>@lang('lang.to_date')</th>
                            <th>@lang('lang.days')</th>
                            <th>@lang('lang.details')</th>
                            <th>@lang('lang.action')</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(isset($holidays))
                        @foreach($holidays as $value)

                        @php

                            $start = strtotime($value->from_date);
                            $end = strtotime($value->to_date);

                            $days_between = ceil(abs($end - $start) / 86400);
                            $days = $days_between + 1;

                        @endphp
                        <tr>

                            <td>{{$value->holiday_title}}</td>
                            <td  data-sort="{{strtotime($value->from_date)}}" >
                                {{$value->from_date != ""? App\SmGeneralSettings::DateConvater($value->from_date):''}}

                            </td>
                            <td  data-sort="{{strtotime($value->to_date)}}" >
                               {{$value->to_date != ""? App\SmGeneralSettings::DateConvater($value->to_date):''}}

                            </td>
                            <td>{{$days == 1? $days.' day':$days.' days'}}</td>
                            <td>{{str_limit($value->details, 50)}}</td>


                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        @lang('lang.select')
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">

                                        <a class="dropdown-item" href="{{url('holiday/'.$value->id.'/edit')}}">@lang('lang.edit')</a>

                                        <a class="deleteUrl dropdown-item" data-modal-size="modal-md" title="Delete Holiday" href="{{url('delete-holiday-view/'.$value->id)}}">@lang('lang.delete')</a>
                                        @if($value->upload_image_file != "")
                                             <a class="dropdown-item" href="{{url('download-holiday-document/'.showPicName($value->upload_image_file))}}">
                                                 @lang('lang.download') <span class="pl ti-download"></span>
                                        @endif

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
</div>
</section>
@endsection
