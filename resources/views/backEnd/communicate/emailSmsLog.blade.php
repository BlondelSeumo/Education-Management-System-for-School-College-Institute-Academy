@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.email_sms_log') @lang('lang.list') </h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.communicate')</a>
                <a href="#">@lang('lang.email_sms_log')</a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_admin_visitor">
<div class="container-fluid p-0">
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <a href="{{url('send-email-sms-view')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.send_email')
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                    <thead>
                        @if(session()->has('message-success-delete') != "" ||
                        session()->get('message-danger-delete') != "")
                        <tr>
                            <td colspan="2">
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
                            <th> @lang('lang.title')</th>
                            <th> @lang('lang.description')</th>
                            <th> @lang('lang.date')</th>
                            <th> @lang('lang.type')</th>
                            <th> @lang('lang.group')</th>
                            <th> @lang('lang.individual')</th>
                            <th> @lang('lang.class')</th>
                           
                        </tr>
                    </thead>

                    <tbody>
                        @if(isset($emailSmsLogs))
                        @foreach($emailSmsLogs as $value)
                        <tr>

                            <td>{{$value->title}}</td>
                            <td>{{$value->description}}</td>
                            <td  data-sort="{{strtotime($value->send_date)}}" >  

                                {{$value->send_date != ""? App\SmGeneralSettings::DateConvater($value->send_date):''}}

                            </td>
                            <td>@if($value->send_through == 'E')
                            <button class="primary-btn small bg-warning text-white border-0"> @lang('lang.email')</button>
                            @else
                            <button class="primary-btn small bg-success text-white border-0"> @lang('lang.sms')</button>
                            @endif
                            </td>
                            <td>
                            @if($value->send_to == 'G')
                            <input type="checkbox" id="asdasd" class="" value="1" name="send_to" checked>
                            @endif
                            </td>
                            <td>
                            @if($value->send_to == 'I')
                            <input type="checkbox" id=""  value="" checked>
                            @endif
                            </td>
                            <td>
                            @if($value->send_to != 'G' && $value->send_to != 'I')
                            <input type="checkbox" id=""  value="" checked>
                            @endif
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
