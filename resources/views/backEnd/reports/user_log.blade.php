@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.user_log')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.reports')</a>
                <a href="#">@lang('lang.user_log')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
            

            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">@lang('lang.user_log') @lang('lang.report')</h3>
                            </div>
                        </div>
                    </div>

                

                    <!-- <div class="d-flex justify-content-between mb-20"> -->
                        <!-- <button type="submit" class="primary-btn fix-gr-bg mr-20" onclick="javascript: form.action='{{url('student-attendance-holiday')}}'">
                            <span class="ti-hand-point-right pr"></span>
                            mark as holiday
                        </button> -->

                        
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>@lang('lang.user')</th>
                                        <th>@lang('lang.role')</th>
                                        <th>@lang('lang.ip') @lang('lang.address')</th>
                                        <th>@lang('lang.login_time')</th>
                                        <th>@lang('lang.user_agent')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($user_logs as $user_log)
                                    <tr>
                                        <td>{{$user_log->user!=""?$user_log->user->username:""}}</td>
                                        <td>{{$user_log->role!=""?$user_log->role->name:""}}</td>
                                        <td>{{$user_log->ip_address}}</td>
                                        <td  data-sort="{{strtotime($user_log->created_at)}}" >
                                            {{$user_log->created_at != ""? App\SmGeneralSettings::DateConvater($user_log->created_at):''}}

                                        </td>
                                        <td>{{$user_log->user_agent}}</td>
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
