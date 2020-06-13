@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.sms_settings')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.system_settings')</a>
                <a href="#">@lang('lang.sms_settings')</a>
            </div>
        </div>
    </div>
</section>
<section class="mb-40 student-details">
    <div class="container-fluid p-0">
        <div class="row">


            <!-- Start Sms Details -->
            <div class="col-lg-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#select_sms_service" role="tab" data-toggle="tab">@lang('lang.select_a_SMS_service')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#clickatell_settings" role="tab" data-toggle="tab">@lang('lang.clickatell') @lang('lang.settings')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#twilio_settings" role="tab" data-toggle="tab">@lang('lang.twilio') @lang('lang.settings')</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="#msg91_settings" role="tab" data-toggle="tab">MSG91 Settings</a>
                    </li> 
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane fade show active" id="select_sms_service">
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'update-clickatell-data', 'id' => 'select_a_service']) }}
                       <div class="white-box">
                       <div class="row">
                        <div class="col-lg-4 select_sms_services">
                                <div class="input-effect">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('book_category_id') ? ' is-invalid' : '' }}" name="sms_service" id="sms_service">
                                        <option data-display="@lang('lang.select_a_SMS_service')" value="">@lang('lang.select_a_SMS_service')</option>
                                        @if(isset($sms_services))
                                        @foreach($sms_services as $value)
                                        <option value="{{$value->id}}"  @if(isset($active_sms_service)) @if($active_sms_service->id == $value->id) selected @endif @endif >{{$value->gateway_name}}</option>
 
                                        @endforeach
                                        @endif
                                    </select>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('book_category_id'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('book_category_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div> 
                            <div class="col-lg-8">
                                
                                        @if(session()->has('message-success'))
                                          <div class="alert alert-success">
                                              {{ session()->get('message-success') }}
                                          </div>
                                        @elseif(session()->has('message-danger'))
                                          <div class="alert alert-danger">
                                              {{ session()->get('message-danger') }}
                                          </div>
                                        @endif
                            </div>
                            </div>
                       
                    </div>
                    {{ Form::close()}}
                </div>

                <div role="tabpanel" class="tab-pane fade" id="clickatell_settings">
                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'update-clickatell-data', 'id' => 'clickatell_form']) }}
                <div class="white-box">
                        <div class="">
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}"> 
                            <input type="hidden" name="clickatell_form" id="clickatell_form_url" value="update-clickatell-data">
                            <input type="hidden" name="gateway_id" id="gateway_id" value="1"> 
                            <div class="row mb-30">

                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control{{ $errors->has('clickatell_username') ? ' is-invalid' : '' }}"
                                                type="text" name="clickatell_username" id="clickatell_username" autocomplete="off" value="{{isset($sms_services)? $sms_services[0]->clickatell_username : ''}}">
                                                <label>@lang('lang.clickatell') @lang('lang.username') <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <span class="modal_input_validation red_alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control{{ $errors->has('book_title') ? ' is-invalid' : '' }}"
                                                type="text" name="clickatell_password" id="clickatell_password" autocomplete="off" value="{{isset($sms_services)? $sms_services[0]->clickatell_password : ''}}">
                                                <label>@lang('lang.clickatell') @lang('lang.password') <span>*</span> </label>
                                                <span class="focus-border"></span>
                                               <span class="modal_input_validation red_alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input class="primary-input form-control{{ $errors->has('clickatell_api_id') ? ' is-invalid' : '' }}"
                                                type="text" name="clickatell_api_id" id="clickatell_api_id" autocomplete="off" value="{{isset($sms_services)? $sms_services[0]->clickatell_api_id : ''}}">
                                                <label>@lang('lang.clickatell') @lang('lang.api') @lang('lang.id') <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('clickatell_api_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('clickatell_api_id') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <div class="row justify-content-center">
                                         <img class="logo" width="" height="" src="{{ URL::asset('public/backEnd/img/Clickatell.png') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-40">
                            <div class="col-lg-12 text-center">
                                <button class="primary-btn fix-gr-bg">
                                    <span class="ti-check"></span>
                                    @lang('lang.update')
                                </button>
                            </div>
                        </div>
                    </div>
            {{ Form::close() }}
            </div>
            <!-- End Profile Tab -->

            <!-- Start Exam Tab -->
            <div role="tabpanel" class="tab-pane fade" id="twilio_settings">
            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'update-twilio-data', 'id' => 'twilio_form']) }}
                <div class="white-box">
                        <div class="">
                            <input type="hidden" name="twilio_form" id="twilio_form_url" value="update-twilio-data">
                            <input type="hidden" name="gateway_id" id="gateway_id" value="2"> 
                            <div class="row mb-30">

                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control{{ $errors->has('book_title') ? ' is-invalid' : '' }}"
                                                type="text" name="twilio_account_sid" autocomplete="off" value="{{isset($sms_services)? $sms_services[1]->twilio_account_sid : ''}}" id="twilio_account_sid">
                                                <label>@lang('lang.twilio') @lang('lang.account') @lang('lang.sid') <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control{{ $errors->has('book_title') ? ' is-invalid' : '' }}"
                                                type="text" name="twilio_authentication_token" autocomplete="off" value="{{isset($sms_services)? $sms_services[1]->twilio_authentication_token : ''}}" id="twilio_authentication_token">
                                                <label>@lang('lang.authentication') @lang('lang.token') <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('book_title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('book_title') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input class="primary-input form-control{{ $errors->has('book_title') ? ' is-invalid' : '' }}"
                                                type="text" name="twilio_registered_no" autocomplete="off" value="{{isset($sms_services)? $sms_services[1]->twilio_registered_no : ''}}" id="twilio_registered_no">
                                                <label>@lang('lang.registered_phone_number') <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('book_title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('book_title') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <div class="row justify-content-center">
                                         <img class="logo" width="250" height="90" src="{{ URL::asset('public/backEnd/img/twilio.png') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-40">
                            <div class="col-lg-12 text-center">
                                <button class="primary-btn fix-gr-bg">
                                    <span class="ti-check"></span>
                                    @lang('lang.update')
                                </button>
                            </div>
                        </div>
                    </div>
            {{ Form::close() }}
            </div>
            

            <div role="tabpanel" class="tab-pane fade" id="msg91_settings"> 
            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'update-msg91-data', 'method'=>'POST']) }}
                <div class="white-box">  
                    <input type="hidden" name="msg91_form" id="msg91_form_url" value="update-msg91-data">
                    <input type="hidden" name="gateway_id" id="gateway_id" value="3"> 
                            <div class="row mb-30">
                               <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control{{ $errors->has('book_title') ? ' is-invalid' : '' }}"
                                                type="text" id="msg91_authentication_key_sid" name="msg91_authentication_key_sid" autocomplete="off" value="{{isset($sms_services)? $sms_services[2]->msg91_authentication_key_sid : ''}}"> 
                                                <label> Authentication KEY SID <span>*</span> </label> 
                                                <span class="focus-border"></span>
                                                @if ($errors->has('book_title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('book_title') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control{{ $errors->has('book_title') ? ' is-invalid' : '' }}"
                                                type="text" name="msg91_sender_id" autocomplete="off" value="{{isset($sms_services)? $sms_services[2]-> msg91_sender_id : ''}}" id="msg91_sender_id">
                                                <label>@lang('lang.sender') @lang('lang.id') <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('book_title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('book_title') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control{{ $errors->has('book_title') ? ' is-invalid' : '' }}"
                                                type="text" name="msg91_route" autocomplete="off" value="{{isset($sms_services)? $sms_services[2]-> msg91_route : ''}}" id="msg91_route">
                                                <label>@lang('lang.route') <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('book_title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('book_title') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input class="primary-input form-control{{ $errors->has('book_title') ? ' is-invalid' : '' }}"
                                                type="text" name="msg91_country_code" autocomplete="off" value="{{isset($sms_services)? $sms_services[2]-> msg91_country_code : ''}}" id="msg91_country_code">
                                                <label>@lang('lang.country_code') <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('book_title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('book_title') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <div class="row justify-content-center">
                                         <img class="logo" width="" height="" src="{{ URL::asset('public/backEnd/img/MSG91-logo.png') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-40">
                            <div class="col-lg-12 text-center"> 
                                <button class="primary-btn fix-gr-bg" type="submit"> 
                                    <span class="ti-check"></span>
                                    @lang('lang.update')
                                    
                                </button>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                   </div>
     
                </div>
            </div>
          </div>
    </div>
</section>
@endsection
