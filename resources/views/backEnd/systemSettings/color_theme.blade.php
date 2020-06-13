@extends('backEnd.master')
@section('mainContent')
    @php
        function showPicName($data){
            $name = explode('/', $data);
            return $name[3];
        }
    @endphp
    <style type="text/css">
        .bg-color{
            width: 20px;
            height: 20px;
            text-align: center;
            padding: 0px;
            margin: 0 auto;
        }
    </style>
    <section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.color') @lang('lang.style')</h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.system_settings')</a>
                    <a href="#">@lang('lang.color') @lang('lang.style')</a>
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
                            <div class="main-title">
                                <h3 class="mb-0">@lang('lang.color') @lang('lang.style') @lang('lang.list')</h3>
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
                                                    @lang('lang.deleted_message')
                                                </div>
                                            @elseif(session()->has('message-danger-delete'))
                                                <div class="alert alert-danger">
                                                    @lang('lang.error_message')
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endif

                                <tr>
                                    <th>@lang('lang.sl')</th>
                                    <th>@lang('lang.title')</th>
                                    <th>@lang('lang.primary_color')</th>
                                    <th>@lang('lang.primary_color2')</th>
                                    <th>@lang('lang.primary_color3')</th>
                                    <th>@lang('lang.title_color')</th>
                                    <th>@lang('lang.text_color')</th>
                                    <th>@lang('lang.sidebar_bg')</th>
                                    <th>@lang('lang.status')</th>
                                </tr>
                                </thead>

                                <tbody>
                                @php $count=1; @endphp
                                @foreach($color_styles as $background_setting)
                                    <tr>
                                        <td>{{$count++}}</td>
                                        <td>{{$background_setting->style_name}}</td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: {{$background_setting->primary_color}}"></div>
                                                </div>
                                                <div class="col-lg-9">{{$background_setting->primary_color}}</div>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: {{$background_setting->primary_color2}}"></div>
                                                </div>
                                                <div class="col-lg-9">{{$background_setting->primary_color2}}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: {{$background_setting->primary_color3}}"></div>
                                                </div>
                                                <div class="col-lg-9">{{$background_setting->primary_color3}}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: {{$background_setting->title_color}}"></div>
                                                </div>
                                                <div class="col-lg-9">{{$background_setting->title_color}}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: {{$background_setting->text_color}}"></div>
                                                </div>
                                                <div class="col-lg-9">{{$background_setting->text_color}}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: {{$background_setting->sidebar_bg}}"></div>
                                                </div>
                                                <div class="col-lg-9">{{$background_setting->sidebar_bg}}</div>
                                            </div>
                                        </td>
                                        <td>

                                            @if($background_setting->is_active==1)
                                                <a class="primary-btn small fix-gr-bg "
                                                   href="#">  Activated </a>
                                            @else
                                                <a class="primary-btn small tr-bg"
                                                   href="{{url('/make-default-theme')}}/{{$background_setting->id}}">
                                                    Make Default</a>
                                            @endif
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
@endsection
