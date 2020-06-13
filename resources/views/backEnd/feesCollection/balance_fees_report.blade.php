@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.balance_fees_report')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.reports')</a>
                <a href="#">@lang('lang.balance_fees_report')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.select_criteria')</h3>
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
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'balance_fees_search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="col-lg-6 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                        <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select_class') *</option>
                                        @foreach($classes as $class)
                                        <option value="{{$class->id}}" {{isset($class_id)? ($class_id == $class->id? 'selected':''):''}}>{{$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('class'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('class') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-6 mt-30-md" id="select_section_div">
                                    <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }}" id="select_section" name="section">
                                        <option data-display="@lang('lang.select_section')*" value="">@lang('lang.select_section') *</option>
                                    </select>
                                    @if ($errors->has('section'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('section') }}</strong>
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
            
@if(isset($balance_students))

            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">@lang('lang.student') @lang('lang.fees_report')</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">

                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                                <thead>
                                    <tr>
                                        <th>@lang('lang.name')</th>
                                        <th>@lang('lang.admission') @lang('lang.no')</th>
                                        <th>@lang('lang.roll') @lang('lang.no')</th>
                                        <th>@lang('lang.father_name')</th>
                                        <th>@lang('lang.amount')</th>
                                        <th>@lang('lang.discount')</th>
                                        <th>@lang('lang.fine')</th>
                                        <th>@lang('lang.paid_fees')</th>
                                        <th>@lang('lang.balance')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $grand_total = 0;
                                        $grand_discount = 0;
                                        $grand_fine = 0;
                                        $grand_deposit = 0;
                                        $grand_balance = 0;
                                    @endphp
                                    @foreach($balance_students as $student)
                                    <tr>
                                        <td>{{$student->full_name}}</td>
                                        <td>{{$student->admission_no}}</td>
                                        <td>{{$student->roll_no}}</td>
                                        <td>{{$student->parents!=""?$student->parents->fathers_name:""}}</td>
                                        <td>
                                            @php
                                            $total = App\SmStudent::totalFees($student->feesAssign, $student->route_list_id, $student->room_id);
                                            $grand_total += $total;
                                            echo $total;
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                            $discount = App\SmStudent::totalDiscount($student->feesAssign, $student->id);
                                            $grand_discount += $discount;
                                            echo $discount;
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                            $fine = App\SmStudent::totalFine($student->feesAssign, $student->id);
                                            $grand_fine += $fine;
                                            echo $fine;
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                            $deposit = App\SmStudent::totalDeposit($student->feesAssign, $student->id);
                                            $grand_deposit += $deposit;
                                            echo $deposit;
                                            @endphp
                                        </td>
                                        <td>@php
                                            $balance = App\SmStudent::totalFees($student->feesAssign, $student->route_list_id, $student->room_id) - App\SmStudent::totalDiscount($student->feesAssign, $student->id) - App\SmStudent::totalDeposit($student->feesAssign, $student->id);
                                            $grand_balance += $balance;
                                            echo $balance;
                                            @endphp
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>@lang('lang.grand_total')</th>
                                    <th>{{$grand_total}}</th>
                                    <th>{{$grand_discount}}</th>
                                    <th>{{$grand_fine}}</th>
                                    <th>{{$grand_deposit}}</th>
                                    <th>{{$grand_balance}}</th>
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
