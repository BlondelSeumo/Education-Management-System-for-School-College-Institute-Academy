@extends('backEnd.master')
@section('mainContent')
@php  $setting = App\SmGeneralSettings::find(1);  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   @endphp 

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.transaction_report')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.reports')</a>
                <a href="#">@lang('lang.transaction_report')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
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
                    @if(session()->has('message-success') != "")
                        @if(session()->has('message-success'))
                        <div class="alert alert-success">
                            {{ session()->get('message-success') }}
                        </div>
                        @endif
                    @endif
                    <div class="white-box">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'transaction_report_search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="col-lg-6 mt-30-md">
                                    <div class="no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control{{ $errors->has('date_from') ? ' is-invalid' : '' }}" id="startDate" type="text"
                                                     name="date_from" value="{{date('m/d/Y')}}" readonly>
                                                    <label>@lang('lang.date_from')</label>
                                                    <span class="focus-border"></span>
                                                @if ($errors->has('date_from'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('date_from') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-30-md">
                                    <div class="no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control{{ $errors->has('date_to') ? ' is-invalid' : '' }}" id="startDate" type="text"
                                                     name="date_to" value="{{date('m/d/Y')}}" readonly>
                                                    <label>@lang('lang.date_to')</label>
                                                    <span class="focus-border"></span>
                                                @if ($errors->has('date_to'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('date_to') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
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
            
@if(isset($fees_payments))

            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">@lang('lang.fees_collection_details')</h3>
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
                                        <th>@lang('lang.fees_type')</th>
                                        <th>@lang('lang.mode')</th>
                                        <th>@lang('lang.amount') ({{$currency}})</th>
                                        <th>@lang('lang.discount') ({{$currency}})</th>
                                        <th>@lang('lang.fine') ({{$currency}})</th>
                                        <th>@lang('lang.total') ({{$currency}})</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $grand_amount = 0;
                                        $grand_total = 0;
                                        $grand_discount = 0;
                                        $grand_fine = 0;
                                        $total = 0;
                                    @endphp
                                    @foreach($fees_payments as $students)
                                        @foreach($students as $fees_payment)
                                        @php $total = 0; @endphp
                                        <tr>
                                            <td>{{$fees_payment->fees_type_id.'/'.$fees_payment->id}}</td>
                                            <td  data-sort="{{strtotime($fees_payment->payment_date)}}" >
                                                {{$fees_payment->payment_date != ""? App\SmGeneralSettings::DateConvater($fees_payment->payment_date):''}}

                                            </td>
                                            <td>{{$fees_payment->studentInfo !=""?$fees_payment->studentInfo->full_name:""}}</td>
                                            <td>
                                                @if($fees_payment->studentInfo!="" && $fees_payment->studentInfo->className!="")
                                                {{$fees_payment->studentInfo->className->class_name}}
                                                @endif
                                            </td>
                                            <td>{{$fees_payment->feesType!=""?$fees_payment->feesType->name:""}}</td>
                                            <td>
                                                @if($fees_payment->payment_mode == 'C')
                                                    {{'Cash'}}
                                                @elseif($fees_payment->payment_mode == 'Cq')
                                                    {{'Cheque'}}
                                                @else
                                                    {{'DD'}}
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $total =  $total + $fees_payment->amount;
                                                    $grand_amount =  $grand_amount + $fees_payment->amount;
                                                    echo $fees_payment->amount;
                                                @endphp
                                            </td>
                                            <td>
                                                @php
                                                    $total =  $total + $fees_payment->discount_amount;
                                                    $grand_discount =  $grand_discount + $fees_payment->discount_amount;
                                                    echo $fees_payment->discount_amount;
                                                @endphp
                                            </td>
                                            <td>
                                                @php
                                                    $total =  $total + $fees_payment->fine;
                                                    $grand_fine =  $grand_fine + $fees_payment->fine;
                                                    echo $fees_payment->fine;
                                                @endphp
                                            </td>
                                            <td>
                                                @php
                                                    $grand_total =  $grand_total + $total;
                                                    echo $total;
                                                @endphp
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>@lang('lang.grand_total') </th>
                                    <th>{{$grand_amount}}</th>
                                    <th>{{$grand_discount}}</th>
                                    
                                    <th>{{$grand_fine}}</th>
                                    <th>{{$grand_total}}</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    
                </div>
            </div>

@endif


@if(isset($add_incomes))


            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">@lang('lang.income') @lang('lang.result')</h3>
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>@lang('lang.name')</th>
                                        <th>@lang('lang.income_Head')</th>
                                        <th>@lang('lang.payment_method')</th>
                                        <th>@lang('lang.date')</th>
                                        <th>@lang('lang.amount')({{$currency}})</th>
                                    </tr>
                                </thead>
                                @php $total_income = 0; @endphp
                                <tbody>
                                    @foreach($add_incomes as $add_income)
                                    @php $total_income = $total_income + $add_income->amount; @endphp
                                    <tr>
                                        <td>{{$add_income->name}}</td>
                                        <td>{{$add_income->ACHead!=""?$add_income->ACHead->head:""}}</td>
                                        <td>{{$add_income->paymentMethod!=""?$add_income->paymentMethod->method:""}}</td>
                                        <td>
                                           
                                            {{$add_income->date != ""? App\SmGeneralSettings::DateConvater($add_income->date):''}}

                                        </td>
                                        <td>{{number_format($add_income->amount, 2)}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>@lang('lang.grand_total')</th>
                                        <th></th>
                                        <th>{{number_format($total_income, 2)}}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

@endif


@if(isset($add_expenses))


            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">@lang('lang.expense') @lang('lang.result')</h3>
                            </div>
                        </div>
                    </div>

                
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>@lang('lang.name')</th>
                                        <th>@lang('lang.expense') @lang('lang.head')</th>
                                        <th>@lang('lang.payment_method')</th>
                                        <th>@lang('lang.date')</th>
                                        <th>@lang('lang.amount')({{$currency}})</th>
                                    </tr>
                                </thead>
                                @php $total_expense = 0;@endphp
                                <tbody>
                                    @foreach($add_expenses as $add_expense)
                                    @php $total_expense = $total_expense + $add_expense->amount; @endphp
                                    <tr>
                                        <td>{{$add_expense->name}}</td>
                                        <td>{{$add_expense->ACHead!=""?$add_expense->ACHead->head:""}}</td>
                                        <td>{{$add_expense->paymentMethod!=""?$add_expense->paymentMethod->method:""}}</td>
                                        <td>
                                            
{{$add_expense->date != ""? App\SmGeneralSettings::DateConvater($add_expense->date):''}}

                                        </td>
                                        <td>{{number_format($add_expense->amount, 2)}}</td>
                                    </tr>
                                    @endforeach 
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>@lang('lang.grand_total')</th>
                                        <th></th>
                                        <th>{{number_format($total_expense, 2)}}</th>
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
