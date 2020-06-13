@extends('backEnd.master')
@section('mainContent')
@php  $setting = App\SmGeneralSettings::find(1);  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   @endphp 
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Accounts</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">Dashboard</a>
                <a href="#">Accounts</a>
                <a href="{{route('search_expense')}}">Search Expense</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">Select Criteria </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    @if(session()->has('message-success') != "")
                        @if(session()->has('message-success'))
                        <div class="alert alert-success">
                            {{ session()->get('message-success') }}
                        </div>
                        @endif
                    @endif
                    <div class="white-box">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'search_expense_report_by_date', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="col-lg-6 mt-30-md">
                                    <div class="no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control{{ $errors->has('date_from') ? ' is-invalid' : '' }}" id="startDate" type="text"
                                                     name="date_from" value="{{date('m/d/Y')}}" readonly>
                                                    <label>Date From</label>
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
                                                    <label>Date To</label>
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
                                        search
                                    </button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>

                <div class="col-lg-6">
                    @if(session()->has('message-success') != "")
                        @if(session()->has('message-success'))
                        <div class="alert alert-success">
                            {{ session()->get('message-success') }}
                        </div>
                        @endif
                    @endif
                    <div class="white-box">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'search_expense_report_by_income', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                    <div class="col-lg-12 mt-30-md">
                                        <div class="input-effect">
                                        <input class="primary-input form-control{{ $errors->has('expense') ? ' is-invalid' : '' }}" type="text" name="expense">
                                        <label>Search by Expense<span> *</span></label>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('expense'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('expense') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        search
                                    </button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>

            
@if(isset($add_expenses))


            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">Expense Result</h3>
                            </div>
                        </div>
                    </div>

                
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Expense Head</th>
                                        <th>Payment Method</th>
                                        <th>Date</th>
                                        <th>Amount({{$currency}})</th>
                                    </tr>
                                </thead>
                                @php $total_expense = 0;@endphp
                                <tbody>
                                    @foreach($add_expenses as $add_expense)
                                    @php $total_expense = $total_expense + $add_expense->amount; @endphp
                                    <tr>
                                        <td>{{$add_expense->name}}</td>
                                        <td>{{$add_expense->expenseHead !=""? $add_expense->expenseHead->name:""}}</td>
                                        <td>{{$add_expense->paymentMethod!=""?$add_expense->paymentMethod->method:""}}</td>

                                        <td>
                                            
{{$add_expense->date != ""? App\SmGeneralSettings::DateConvater($add_expense->date):''}}

                                        </td>
                                        <td>{{number_format($add_expense->amount, 2)}}</td>
                                    </tr>
                                    @endforeach
                                    @if($item_receives != 0)
                                    @php $total_expense = $total_expense + $item_receives; @endphp
                                    <tr>
                                        <td>to item receives</td>
                                        <td>item receive</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{number_format($item_receives, 2)}}</td>
                                    </tr>
                                    @endif
                                    @if($payroll_payments != 0)
                                    @php $total_expense = $total_expense + $payroll_payments; @endphp
                                    <tr>
                                        <td>from payroll</td>
                                        <td>payroll</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{number_format($payroll_payments, 2)}}</td>
                                    </tr>
                                    @endif  
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>Grand Total</th>
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
