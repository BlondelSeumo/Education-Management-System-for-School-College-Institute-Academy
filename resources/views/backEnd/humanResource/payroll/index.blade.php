@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.generate_payroll')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.human_resource')</a>
                <a href="#">@lang('lang.generate_payroll')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">

        @if(in_array(173, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )


        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.select_criteria')</h3>
                </div>
            </div>
        </div>
        <div class="row">
           <div class="col-lg-12">
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @elseif(session()->has('danger'))
            <div class="alert alert-danger">
                {{ session()->get('danger') }}
            </div>
            @endif
            <div class="white-box">
                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'payroll', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                <div class="row">
                    <div class="col-lg-4 mt-30-md">
                        <select class="niceSelect w-100 bb form-control {{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="role_id" id="role_id">
                            <option data-display="@lang('lang.role') *" value="">@lang('lang.select_role') *</option>
                            @foreach($roles as $key=>$value)
                            <option value="{{$value->id}}" {{isset($role_id)? ($role_id == $value->id? 'selected':''):''}}>{{$value->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('role_id'))
                        <span class="invalid-feedback invalid-select" role="alert">
                            <strong>{{ $errors->first('role_id') }}</strong>
                        </span>
                        @endif
                    </div>
                    @php $month = date('F'); @endphp
                    <div class="col-lg-4 mt-30-md">
                      <select class="niceSelect w-100 bb form-control {{$errors->has('payroll_month') ? 'is-invalid' : ''}}" name="payroll_month" id="payroll_month">
                        <option data-display="@lang('lang.select_month') *" value="">@lang('lang.select_month') *</option>
                        <option value="January" {{isset($payroll_month)? ($payroll_month == "January"? 'selected':''):($month == "January"? 'selected':'')}}>@lang('lang.january')</option>
                        <option value="February"  {{isset($payroll_month)? ($payroll_month == "February"? 'selected':''):($month == "February"? 'selected':'')}}>@lang('lang.february')</option>
                        <option value="March"  {{isset($payroll_month)? ($payroll_month == "March"? 'selected':''):($month == "March"? 'selected':'')}}>@lang('lang.march')</option>
                        <option value="April" {{isset($payroll_month)? ($payroll_month == "April"? 'selected':''):($month == "April"? 'selected':'')}}>@lang('lang.april')</option>
                        <option value="May" {{isset($payroll_month)? ($payroll_month == "May"? 'selected':''):($month == "May"? 'selected':'')}}>@lang('lang.may')</option>
                        <option value="June" {{isset($payroll_month)? ($payroll_month == "June"? 'selected':''):($month == "June"? 'selected':'')}}>@lang('lang.june')</option>
                        <option value="July" {{isset($payroll_month)? ($payroll_month == "July"? 'selected':''):($month == "July"? 'selected':'')}}>@lang('lang.july')</option>
                        <option value="August" {{isset($payroll_month)? ($payroll_month == "August"? 'selected':''):($month == "August"? 'selected':'')}}>@lang('lang.august')</option>
                        <option value="September" {{isset($payroll_month)? ($payroll_month == "September"? 'selected':''):($month == "September"? 'selected':'')}}>@lang('lang.september')</option>
                        <option value="October" {{isset($payroll_month)? ($payroll_month == "October"? 'selected':''):($month == "October"? 'selected':'')}}>@lang('lang.october')</option>
                        <option value="November" {{isset($payroll_month)? ($payroll_month == "November"? 'selected':''):($month == "November"? 'selected':'')}}>@lang('lang.november')</option>
                        <option value="December" {{isset($payroll_month)? ($payroll_month == "December"? 'selected':''):($month == "December"? 'selected':'')}}>@lang('lang.december')</option>
                    </select>
                    @if ($errors->has('payroll_month'))
                    <span class="invalid-feedback invalid-select" role="alert">
                        <strong>{{ $errors->first('payroll_month') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-lg-4">
                  <select class="niceSelect w-100 bb form-control {{$errors->has('payroll_year') ? 'is-invalid' : ''}}" name="payroll_year" id="payroll_year">
                    <option data-display="@lang('lang.select_year') *" value="">@lang('lang.select_year') *</option>

                    @php 
                        $year = date('Y');
                        $ini = date('y');
                        $limit = $ini + 30;

                    @endphp

                    @for($i = $ini; $i <= $limit; $i++)

                    <option value="{{$year}}" {{isset($payroll_year)? ($payroll_year == $year? 'selected':''):(date('Y') == $year? 'selected':'')}}>{{$year--}}</option>

                    @endfor
                </select>
                @if ($errors->has('payroll_year'))
                <span class="invalid-feedback invalid-select" role="alert">
                    <strong>{{ $errors->first('payroll_year') }}</strong>
                </span>
                @endif
            </div>
            <div class="col-lg-12 mt-20 text-right">
                <button type="submit" class="primary-btn small fix-gr-bg">
                    <span class="ti-search pr-2"></span>
                    @lang('lang.search')
                </button>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
</div>
@endif
@if(isset($staffs))
<div class="row mt-40">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-0">@lang('lang.staff_list')</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>@lang('lang.staff') @lang('lang.no')</th>
                            <th>@lang('lang.name')</th>
                            <th>@lang('lang.role')</th>
                            <th>@lang('lang.department')</th>
                            <th>@lang('lang.description')</th>
                            <th>@lang('lang.mobile')</th>
                            <th>@lang('lang.Status')</th>
                            <th>@lang('lang.action')</th>
                        </tr>
                    </thead>

                    <tbody>

                      
                      @foreach($staffs as $value)
                      <tr>
                        <td>{{$value->staff_no}}</td>
                        <td>{{$value->first_name}}&nbsp;{{$value->last_name}}</td>
                        <td>{{$value->roles !=""?$value->roles->name:""}}</td>
                        <td>{{$value->departments !=""?$value->departments->name:""}}</td>
                        <td>{{$value->designations !=""?$value->designations->title:""}}</td>
                        <td>{{$value->mobile}}</td>
                        <td>
                            @php
                            $getPayrollDetails = App\SmHrPayrollGenerate::getPayrollDetails($value->id, $payroll_month, $payroll_year);
                            @endphp

                            @if(!empty($getPayrollDetails))
                                @if($getPayrollDetails->payroll_status == 'G')
                                <button class="primary-btn small bg-warning text-white border-0"> @lang('lang.generated')</button>
                                @endif

                               @if($getPayrollDetails->payroll_status == 'P')
                                <button class="primary-btn small bg-success text-white border-0"> @lang('lang.paid') </button>
                                @endif
                                @else
                                <button class="primary-btn small bg-danger text-white border-0">@lang('lang.not') @lang('lang.generated')</button>

                            @endif
                        </td>
                        <td>
                        @if(!empty($getPayrollDetails))
                       
                        
                          @if($getPayrollDetails->payroll_status == 'G')

                          @if(in_array(176, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                            <a class="modalLink" data-modal-size="modal-lg" title="Proceed to pay" href="{{url('pay-payroll/'.$getPayrollDetails->id.'/'.$value->role_id)}}"><button class="primary-btn small tr-bg">@lang('lang.proceed_to_pay')</button></a>
                            @endif
                        
                        @endif

                        
                            @if($getPayrollDetails->payroll_status == 'P')

                            @if(in_array(177, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )


                            <a class="modalLink" data-modal-size="modal-lg" title="View Payslip Details" href="{{url('view-payslip', $getPayrollDetails->id)}}"><button class="primary-btn small tr-bg">@lang('lang.view_payslip')</button></a>
                            @endif
                        @endif
                        
                            @else

                            @if(in_array(174, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )


                            <a class="" href="{{url('generate-Payroll/'.$value->id.'/'.$payroll_month.'/'.$payroll_year)}}"><button class="primary-btn small tr-bg"> @lang('lang.generate_payroll')</button></a>
                            @endif
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
@endif
</div>
</section>
@endsection
