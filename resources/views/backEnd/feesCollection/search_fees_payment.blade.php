@extends('backEnd.master')
@section('mainContent')
@php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } @endphp

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.search_fees_payment')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.fees_collection')</a>
                <a href="#">@lang('lang.search_fees_payment')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">
                                @lang('lang.select_criteria')
                            </h3>
                        </div>
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'fees_payment_search',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('payment_id') ? ' is-invalid' : '' }}"
                                                type="text" name="payment_id" autocomplete="off">
                                            <label>@lang('lang.payment') @lang('lang.id') <span>*</span> ex: 1/1 </label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('payment_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('payment_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-lg-12 text-right">
                                        <button type="submit" class="primary-btn small fix-gr-bg">
                                            <span class="ti-search pr-2"></span>
                                            @lang('lang.search')
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
                            <h3 class="mb-0"> @lang('lang.payment_ID_Details')</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                    <th>@lang('lang.payment') @lang('lang.id')</th>
                                    <th>@lang('lang.date')</th>
                                    <th>@lang('lang.name')</th>
                                    <th>@lang('lang.class')</th>
                                    <th>@lang('lang.fees_group')</th>
                                    <th>@lang('lang.fees_type')</th>
                                    <th>@lang('lang.mode')</th>
                                    <th>@lang('lang.amount') ({{$currency}}) </th>
                                    <th>@lang('lang.discount') ({{$currency}}) </th>
                                    <th>@lang('lang.fine') ({{$currency}}) </th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($fees_payments as $fees_payment)
                                <tr>
                                    <td>{{$fees_payment->id.'/'.$fees_payment->fees_type_id}}</td>
                                    <td>
                                        {{ App\SmGeneralSettings::DateConvater($fees_payment->payment_date)}}
                                      
                                    <!-- {{ $fees_payment->payment_date != ""? App\SmGeneralSettings::DateConvater($fees_payment->payment_date):''}} -->

                                    </td>
                                    <td>{{$fees_payment->studentInfo!=""?$fees_payment->studentInfo->full_name:""}}</td>
                                    <td>
                                        @if($fees_payment->studentInfo !="" && $fees_payment->studentInfo->className!="")
                                        {{$fees_payment->studentInfo->className->class_name}}
                                        @endif
                                    </td>
                                    <td>{{$fees_payment->feesMaster !=""?$fees_payment->feesMaster->feesGroups->name: ""}}</td>
                                    <td>{{$fees_payment->feesType!=""?$fees_payment->feesType->name:""}}</td>
                                    <td>
                                        @if($fees_payment->payment_mode == "C")
                                            {{'Cash'}}
                                        @elseif($fees_payment->payment_mode == "Cq")
                                            {{'Cheque'}}
                                        @else
                                            {{'DD'}}
                                        @endif
                                        
                                    </td>
                                    <td>{{$fees_payment->amount}}</td>
                                    <td>{{$fees_payment->discount_amount}}</td>
                                    <td>{{$fees_payment->fine}}</td>
                                    <td><div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>

                                            @if(in_array(115, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                                           

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{route('fees_collect_student_wise', [$fees_payment->student_id])}}">@lang('lang.view')</a>
                                            </div>
                                            @endif
                                        </div>
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
