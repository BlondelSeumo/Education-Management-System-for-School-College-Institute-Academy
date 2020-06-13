@extends('backEnd.master')
@section('mainContent')

@php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } @endphp


<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.staffs_payroll')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{url('payroll')}}">@lang('lang.payroll')</a>
                <a href="#">@lang('lang.generate_payroll')</a>
            </div>
        </div>
    </div>
</section>
<section class="student-details mb-40">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.generate_payroll')</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="student-meta-box">
                    <div class="student-meta-top staff-meta-top"></div>
                    <img class="student-meta-img img-100" src="{{asset($staffDetails->staff_photo)}}"  alt="">
                    <div class="white-box">
                        <div class="single-meta mt-20">
                            <div class="row">
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        @lang('lang.name')
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        @if(isset($staffDetails)){{$staffDetails->full_name}}@endif
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        @lang('lang.staff_no')
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        @if(isset($staffDetails)){{$staffDetails->staff_no}}@endif
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-3">
                                    <div class="value text-left">
                                        @lang('lang.month')
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-9 d-flex">
                                    <div class="value ml-20" data-toggle="tooltip" title="Present!">
                                        P
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip" title="Late!">
                                        L
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip" title="Absent!">
                                        A
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip" title="Half Day!">
                                        F
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip" title="Holiday!">
                                        H
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip" title="Approved Leave!">
                                        V
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        @lang('lang.mobile')
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                       @if(isset($staffDetails)){{$staffDetails->mobile}}@endif
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        @lang('lang.email')
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        @if(isset($staffDetails)){{$staffDetails->email}}@endif
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-3">
                                    <div class="value text-left">
                                        {{$payroll_month}}
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-9 d-flex">
                                    <div class="value ml-20">
                                        
                                        {{$p}}
                                    </div>
                                    <div class="value ml-20">
                                        
                                        {{$l}}
                                    </div>
                                    <div class="value ml-20">
                                        
                                        {{$a}}
                                    </div>
                                    <div class="value ml-20">
                                        
                                        {{$f}}
                                    </div>
                                    <div class="value ml-20">
                                        
                                        {{$h}}
                                    </div>
                                    <div class="value ml-20">
                                        V
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        @lang('lang.role')
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        @if(isset($staffDetails)){{$staffDetails->roles->name}}@endif
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        @lang('lang.department')
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        @if(isset($staffDetails)){{$staffDetails->departments->name}}@endif
                                    </div>
                                </div>
                                 
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        @lang('lang.designation')
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                       @if(isset($staffDetails)){{$staffDetails->designations->title}}@endif
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        @lang('lang.date_of_joining')
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        @if(isset($staffDetails))
                                           {{$staffDetails->date_of_joining != ""? App\SmGeneralSettings::DateConvater($staffDetails->date_of_joining):''}}

                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'savePayrollData', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
<section class="">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="d-flex justify-content-between mb-20">
                    <div class="main-title">
                        <h3>@lang('lang.earnings')</h3>
                    </div>

                    <div>
                        <button type="button" class="primary-btn icon-only fix-gr-bg" onclick="addMoreEarnings()">
                            <span class="ti-plus"></span>
                        </button>
                    </div>
                </div>

                <div class="white-box">
                    <table class="w-100 table-responsive" id="tableID">
                        <tbody id="addEarningsTableBody">
                            <tr id="row0">
                                <td width="70%" class="pr-30">
                                    <div class="input-effect mt-10">
                                        <input class="primary-input form-control" type="text" id="earningsType0" name="earningsType[]">
                                        <label for="earningsType0">@lang('lang.type')</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                                <td width="20%" class="pr-30">
                                    <div class="input-effect mt-10">
                                        <input class="primary-input form-control" type="number" id="earningsValue0"  name="earningsValue[]">
                                        <label for="earningsValue0">@lang('lang.value')</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-4 no-gutters">
                <div class="d-flex justify-content-between mb-20">
                    <div class="main-title">
                        <h3>@lang('lang.deductions')</h3>
                    </div>

                    <div>
                        <button type="button" class="primary-btn icon-only fix-gr-bg" onclick="addDeductions()">
                            <span class="ti-plus"></span>
                        </button>
                    </div>
                </div>

                <div class="white-box">
                <table class="w-100 table-responsive" id="tableDeduction">
                        <tbody id="addDeductionsTableBody">
                            <tr id="DeductionRow0">
                                <td width="80%" class="pr-30">
                                    <div class="input-effect mt-10">
                                        <input class="primary-input form-control" type="text" id="deductionstype0" name="deductionstype[]">
                                        <label for="deductionstype0">@lang('lang.type')</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                                <td width="20%">
                                    <div class="input-effect mt-10">
                                        <input class="primary-input form-control" type="number" id="deductionsValue0" name="deductionsValue[]">
                                        <label for="deductionsValue0">@lang('lang.value')</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-4 no-gutters">
                <div class="d-flex justify-content-between mb-20">
                    <div class="main-title">
                        <h3>@lang('lang.payroll_summary')</h3>
                    </div>

                    <div>
                        <button type="button" class="primary-btn small fix-gr-bg" onclick="calculateSalary()">
                            @lang('lang.calculate')
                        </button>
                    </div>
                </div>

                <input type="hidden" name="staff_id" value="{{$staffDetails->id}}">
                <input type="hidden" name="payroll_month" value="{{$payroll_month}}">
                <input type="hidden" name="payroll_year" value="{{$payroll_year}}">


                <div class="white-box">
                <table class="w-100 table-responsive">
                        <tbody class="d-block">
                            <tr class="d-block">
                                <td width="100%" class="pr-30 d-block">
                                    <div class="input-effect mt-10">
                                        <input class="primary-input form-control" type="text" id="basicSalary" value="{{$staffDetails->basic_salary}}" name="basic_salary" readonly>
                                        <label for="basicSalary">@lang('lang.basic_salary') ({{$currency}})</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="d-block">
                                <td width="100%" class="pr-30 d-block">
                                    <div class="input-effect mt-30">
                                        <input class="primary-input form-control" type="text" id="total_earnings" name="total_earning">
                                        <label for="total_earnings">@lang('lang.earning')</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="d-block">
                                <td width="100%" class="pr-30 d-block">
                                    <div class="input-effect mt-30">
                                        <input class="primary-input form-control" type="text" id="total_deduction" name="total_deduction">
                                        <label for="total_deduction">@lang('lang.deduction')</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="d-block">
                                <td width="100%" class="pr-30 d-block">
                                    <div class="input-effect mt-30">
                                        <input class="primary-input form-control" type="text" id="gross_salary" value="0">
                                        <input type="hidden" name="final_gross_salary" id="final_gross_salary">
                                        <label for="gross_salary">@lang('lang.gross_salary')  ({{$currency}})</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="d-block">
                                <td width="100%" class="pr-30 d-block">
                                    <div class="input-effect mt-30">
                                        <input class="primary-input form-control" type="text" id="tax" value="0" name="tax">
                                        <label for="tax">@lang('lang.tax')</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="d-block">
                                <td width="100%" class="pr-30 d-block">
                                    <div class="input-effect mt-30 mb-30">
                                        <input class="primary-input form-control{{ $errors->has('net_salary') ? ' is-invalid' : '' }}" type="text" id="net_salary" name="net_salary">
                                        <label for="net_salary">@lang('lang.net_salary') ({{$currency}})</label>
                                        <span class="focus-border"></span>

                                        @if ($errors->has('net_salary'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('net_salary') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12 mt-20 text-right">
                <!-- <button type="submit" class="primary-btn small fix-gr-bg">
                    Submit
                </button> -->

                @if(in_array(175, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

              

                <button class="primary-btn fix-gr-bg">
                    <span class="ti-check"></span>
                    @lang('lang.submit')
                </button>
                @endif
            </div>
           
            </div>
        </div>
    </div>
</section>
{{ Form::close() }}
<!-- End Modal Area -->
@endsection
