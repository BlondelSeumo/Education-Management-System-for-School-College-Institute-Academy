@extends('backEnd.master')
@section('mainContent')
@php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } @endphp

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.payroll_report')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.human_resource')</a>
                <a href="#">@lang('lang.payroll_report')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.select_criteria') </h3>
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
                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'searchPayrollReport', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                <div class="row">
                    <div class="col-lg-4 mt-30-md">
                        <select class="niceSelect w-100 bb form-control {{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="role_id" id="role_id">
                            <option data-display="@lang('lang.role')" value="">@lang('lang.select') </option>
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
                        <option data-display="@lang('lang.select_month') *" value="">@lang('lang.select_month')  *</option>
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
                    <option data-display="@lang('lang.select_year')*" value="">@lang('lang.select_year') *</option>

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
@if(isset($staffsPayroll))
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
                            <th>@lang('lang.staff') @lang('lang.name')</th>
                            <th>@lang('lang.role')</th>
                            <th>@lang('lang.description')</th>
                            <th>@lang('lang.month') - @lang('lang.year')</th>
                            <th>@lang('lang.payslip') #</th>
                            <th>@lang('lang.basic_salary')({{$currency}})</th>
                            <th>@lang('lang.earnings')({{$currency}})</th>
                            <th>@lang('lang.deductions')({{$currency}})</th>
                            <th>@lang('lang.gross_salary')({{$currency}})</th>
                            <th>@lang('lang.tax')({{$currency}})</th>
                            <th>@lang('lang.net_salary')({{$currency}})</th>
                        </tr>
                    </thead>

                    <tbody>
                      @php 
                        $basic_salary = 0; 
                        $earnings = 0;
                        $deductions = 0;
                        $gross_salary = 0;
                        $tax = 0;
                        $net_salary = 0;
                     @endphp
                      @foreach($staffsPayroll as $value)
                      <tr>
                        <td>{{$value->full_name}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->title}}</td>
                        <td>{{$value->payroll_month}} - {{$value->payroll_year}}</td>
                        <td>{{$value->id}}</td>
                        <td>{{$value->basic_salary}}</td>
                        <td>
                            @php
                            $totalEarnings = App\SmHrPayrollEarnDeduc::getTotalEarnings($value->id);
                            @endphp
                            @if($totalEarnings>0)
                            {{$totalEarnings}}
                            @php $earnings +=$totalEarnings; @endphp
                            @else
                            {{0}}
                            @endif
                        </td>
                        <td>
                            @php
                            $totalDeductions = App\SmHrPayrollEarnDeduc::getTotalDeductions($value->id);
                            @endphp
                            @if($totalDeductions>0)
                            {{$totalDeductions}}
                            @php $deductions +=$totalDeductions; @endphp
                            @else
                            {{0}}
                            @endif
                        </td>
                        <td>{{$value->gross_salary}}</td>
                        <td>{{$value->tax}}</td>
                        <td>{{$value->net_salary}}</td>
                        @php 
                        $basic_salary += $value->basic_salary;
                        $gross_salary += $value->gross_salary;
                        $tax += $value->tax;
                        $net_salary += $value->net_salary;
                        @endphp
                    </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>@lang('lang.grand_total')</th>
                        <th>${{$basic_salary}}</th>
                        <th>${{$earnings}}</th>
                        <th>${{$deductions}}</th>
                        <th>${{$gross_salary}}</th>
                        <th>${{$tax}}</th>
                        <th>${{$net_salary}}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</div>
@endif
</div>
</section>
@endsection
