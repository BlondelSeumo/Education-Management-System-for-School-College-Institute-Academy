@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.update') @lang('lang.general_settings')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{url('general-settings')}}">@lang('lang.general_settings') @lang('lang.view')</a>
              </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6">
                <div class="main-title">
                    <h3 class="mb-30">
                        @lang('lang.update')
                   </h3>
                </div>
            </div>
        </div>
       
        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'update-general-settings-data', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
        
{{--        @if ($errors->any())--}}
{{--            <div class="alert alert-danger">--}}
{{--                <ul>--}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <li>{{ $error }}</li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        @endif--}}

        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <div class="">
                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}"> 
                        <div class="row mb-40">
                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('school_name') ? ' is-invalid' : '' }}"
                                    type="text" name="school_name" autocomplete="off" value="{{isset($editData)? $editData->school_name : old('school_name')}}">
                                    <label>@lang('lang.school_name') <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('school_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('school_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('site_title') ? ' is-invalid' : '' }}"
                                    type="text" name="site_title" autocomplete="off" value="{{isset($editData)? $editData->site_title : old('site_title')}}">
                                    <label>@lang('lang.site_title') <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('site_title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('site_title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('session_id') ? ' is-invalid' : '' }}" name="session_id" id="session_id">
                                        <option data-display="@lang('lang.select_session') *" value="">@lang('lang.select')</option>
                                        @foreach($academic_years as $key=>$value)
                                        <option value="{{$value->id}}"
                                        @if(isset($editData))
                                        @if($editData->session_id == $value->id)
                                        selected
                                        @endif
                                        @endif
                                        >{{$value->year}}</option>
                                        @endforeach
                                    </select>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('session_id'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('session_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('school_code') ? ' is-invalid' : '' }}"
                                    type="text" name="school_code" autocomplete="off" value="{{isset($editData)? $editData->school_code: old('school_code')}}">
                                    <label>@lang('lang.school_code') <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('school_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('school_code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                        </div>

                        <div class="row mb-40">
                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                    type="number" name="phone" autocomplete="off" value="{{isset($editData)? $editData->phone: old('phone')}}">
                                    <label>@lang('lang.phone') <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    type="text" name="email" autocomplete="off" value="{{isset($editData)? $editData->email: old('email')}}">
                                    <label>@lang('lang.email') <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                           <div class="col-lg-3">
                                <div class="input-effect">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('language_id') ? ' is-invalid' : '' }}" name="language_id" id="language_id">
                                        <option data-display="@lang('lang.language') *" value="">@lang('lang.select') <span>*</span></option>
                                        @if(isset($languages))
                                        @foreach($languages as $key=>$value)
                                        <option value="{{$value->id}}"
                                        @if(isset($editData))
                                        @if($editData->language_id == $value->id)
                                        selected
                                        @endif
                                        @endif
                                        >{{$value->language_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('language_id'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('language_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('date_format_id') ? ' is-invalid' : '' }}" name="date_format_id" id="date_format_id">
                                        <option data-display="@lang('lang.select_date_format') *" value="">@lang('lang.select') <span>*</span></option>
                                        @if(isset($dateFormats))
                                        @foreach($dateFormats as $key=>$value)
                                        <option value="{{$value->id}}"
                                        @if(isset($editData))
                                        @if($editData->date_format_id == $value->id)
                                        selected
                                        @endif
                                        @endif
                                        >{{$value->normal_view}} [{{$value->format}}]</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('date_format_id'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('date_format_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="row mb-40">

                            {{-- <div class="col-lg-3">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('currency') ? ' is-invalid' : '' }}"
                                    type="text" name="currency" autocomplete="off" value="{{isset($editData)? $editData->currency : old('currency')}}">
                                    <label>Currency <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('currency'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('currency') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div> --}}

                            <div class="col-lg-3">
                                    <div class="input-effect">
                                         <select name="time_zone" class="niceSelect w-100 bb form-control {{ $errors->has('time_zone') ? ' is-invalid' : '' }}" id="time_zone">
                                            <option data-display="@lang('lang.select') @lang('lang.time_zone') *" value="">@lang('lang.select') @lang('lang.time_zone') *</option>

                                            @foreach($time_zones as $time_zone)
                                            <option value="{{$time_zone->id}}" {{$time_zone->id == $editData->time_zone_id? 'selected':''}}>{{$time_zone->time_zone}}</option>
                                            @endforeach
      

                                             
                                        </select>

                                        <span class="focus-border"></span>
                                            @if ($errors->has('time_zone'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('time_zone') }}</strong>
                                            </span>
                                            @endif
                                        
                                       
                                     </div>
                                </div>



                                <div class="col-lg-3">
                                    <div class="input-effect">
                                         <select name="currency" class="niceSelect w-100 bb form-control {{ $errors->has('currency') ? ' is-invalid' : '' }}" id="currency">
                                            <option data-display="@lang('lang.select_currency')" value="">@lang('lang.select_currency')</option>
                                             @foreach($currencies as $currency)
                                                <option value="{{$currency->code}}" {{isset($editData)? ($editData->currency  == $currency->code? 'selected':''):''}}>{{$currency->name}} ({{$currency->code}})</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('currency'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('currency') }}</strong>
                                        </span>
                                        @endif
                                       
                                     </div>
                                </div>


                            


                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('currency_symbol') ? ' is-invalid' : '' }}"
                                    type="text" name="currency_symbol" autocomplete="off" value="{{isset($editData)? $editData->currency_symbol : old('currency_symbol')}}" id="currency_symbol" readonly="">
                                    <label>@lang('lang.currency_symbol') <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('currency_symbol'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('currency_symbol') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="row md-30">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                <textarea class="primary-input form-control" cols="0" rows="4" name="address" id="address">{{isset($editData) ? $editData->address : old('address')}}</textarea>
                                    <label>@lang('lang.school_address') <span></span> </label>
                                    <span class="focus-border textarea"></span>

                                </div>
                            </div>
                        </div>
                        <div class="row md-30 mt-40">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                <textarea class="primary-input form-control" cols="0" rows="4" name="copyright_text" id="copyright_text">{{isset($editData) ? $editData->copyright_text : old('copyright_text')}}</textarea>
                                    <label>@lang('lang.copyright_text') <span></span> </label>
                                    <span class="focus-border textarea"></span>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-40">
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="primary-btn fix-gr-bg">
                                <span class="ti-check"></span>
                                @lang('lang.update')
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
    
</div>
</section>
@endsection
