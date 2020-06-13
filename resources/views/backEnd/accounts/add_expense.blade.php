@extends('backEnd.master')
@section('mainContent')
@php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } @endphp
@php
    function showPicName($data){
        $name = explode('/', $data);
        return $name[3];
    }
@endphp
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.add_expense') </h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard') </a>
                <a href="#">@lang('lang.accounts') </a>
                <a href="#">@lang('lang.add_expense') </a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($add_expense))
        @if(in_array(144, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                       
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('add-expense')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.add')
                </a>
            </div>
        </div>

        @endif
        @endif
        <div class="row">
            
           
 
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">

                            <h3 class="mb-30">
                                @if(isset($add_expense))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.expense')
                            </h3>
                        </div>
                        @if(isset($add_expense))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true,  'url' => 'add-expense/'.$add_expense->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data' , 'id' => 'add-expense-update']) }}
                        @else
                        @if(in_array(144, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'add-expense',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'add-expense']) }}
                        @endif
                        @endif
                        
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @if(session()->has('message-success'))
                                        <div class="alert alert-success">
                                            {{ session()->get('message-success') }}
                                        </div>
                                        @elseif(session()->has('message-danger'))
                                        <div class="alert alert-danger">
                                            {{ session()->get('message-danger') }}
                                        </div>
                                        @endif
                                         {{-- @if ($errors->any())
                                             <div class="error text-danger"><strong>{{ 'Please fill up the required fields' }}</strong></div>
                                        @endif --}}
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                type="text" name="name" autocomplete="off" value="{{isset($add_expense)? $add_expense->name: old('name')}}">
                                            <input type="hidden" name="id" value="{{isset($add_expense)? $add_expense->id: ''}}">
                                            <label>@lang('lang.name')  <span>*</span></label>
                                            <span class="focus-border"></span>
                                             @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                 <div class="row  mt-40">
                                    <div class="col-lg-12">

                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('expense_head') ? ' is-invalid' : '' }}" name="expense_head">
                                            <option data-display="A/C Head *" value="">@lang('lang.a_c_Head') *</option>
                                            @foreach($expense_heads as $expense_head)
                                                @if(isset($add_expense))
                                                <option value="{{$expense_head->id}}"
                                                    {{$add_expense->expense_head_id == $expense_head->id? 'selected': ''}}>{{$expense_head->head}}</option>
                                                @else
                                                <option value="{{$expense_head->id}}" {{old('expense_head') == $expense_head->id? 'selected': ''}}>{{$expense_head->head}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                       @if ($errors->has('expense_head'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('expense_head') }}</strong>
                                        </span>
                                        @endif 
                                    </div>
                                </div>
                                
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('payment_method') ? ' is-invalid' : '' }}" name="payment_method" id="payment_method">
                                            <option data-display="@lang('lang.payment_method') *" value="">@lang('lang.payment_method') *</option>
                                            @foreach($payment_methods as $payment_method)
                                            @if(isset($add_expense))
                                            <option value="{{$payment_method->id}}"
                                                {{$add_expense->payment_method_id == $payment_method->id? 'selected': ''}}>{{$payment_method->method}}</option>
                                            @else
                                            {{-- <option value="{{$payment_method->id}}">{{$payment_method->method}}</option> --}}
                                             <option value="{{$payment_method->id}}" {{old('payment_method') == $payment_method->id? 'selected': ''}}>{{$payment_method->method}}</option>
                                               
                                            @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('payment_method'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('payment_method') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mt-25" id="bankAccount">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('accounts') ? ' is-invalid' : '' }}" name="accounts">
                                            <option data-display="@lang('lang.accounts') *" value="">@lang('lang.accounts')  *</option>
                                            @foreach($bank_accounts as $bank_account)
                                            @if(isset($add_expense))
                                            <option value="{{$bank_account->id}}"
                                                {{$add_expense->account_id == $bank_account->id? 'selected': ''}}>{{$bank_account->account_name}}</option>
                                            @else
                                            <option value="{{$bank_account->id}}">{{$bank_account->account_name}}</option>
                                            @endif
                                            @endforeach
                                        </select> 
                                        @if ($errors->has('accounts'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('accounts') }}</strong>
                                        </span>
                                        @endif 
                                    </div>
                                </div>

                                <div class="row no-gutters input-right-icon mt-40">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" id="startDate" type="text"
                                                placeholder="@lang('lang.date') " name="date" value="{{isset($add_expense)? date('m/d/Y',strtotime($add_expense->date)) : date('m/d/Y')}}">
                                            <span class="focus-border"></span>
                                              @if ($errors->has('date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('date') }}</strong>
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
                                <div class="row  mt-40">
                                    <div class="col-lg-12">

                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                                type="number" name="amount" autocomplete="off" value="{{isset($add_expense)? $add_expense->amount:old('amount')}}">
                                            <label>@lang('lang.amount')  <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('amount'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                            @endif 
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                     <div class="col">
                                        <div class="row no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input" type="text" id="placeholderFileOneName" placeholder="{{isset($add_expense)? ($add_expense->file != ""? showPicName($add_expense->file):'File') : ''}}"readonly
                                                        >
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg" for="document_file_1">@lang('lang.browse') </label>
                                                    <input type="file" class="d-none" name="file" id="document_file_1">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4" name="description">{{isset($add_expense)? $add_expense->description: old('description')}}</textarea>
                                            <label>@lang('lang.description')  <span></span></label>
                                            <span class="focus-border textarea"></span>
                                        </div>
                                    </div>
                                </div>
                                  @php 
                                  $tooltip = "";
                                  if(in_array(144, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            @if(isset($add_expense))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                            @lang('lang.expense')
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
                            <h3 class="mb-0">@lang('lang.expense')  @lang('lang.list') </h3>
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
                                    <td colspan="7">
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
                                    <th>@lang('lang.name') </th>
                                    <th>@lang('lang.payment_method') </th>
                                    <th>@lang('lang.date') </th>
                                    <th>@lang('lang.a_c_Head') </th>
                                    <th>@lang('lang.amount') ({{$currency}})</th>
                                    <th>@lang('lang.action') </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($add_expenses as $add_expense)
                                <tr>
                                    <td>{{$add_expense->name}}</td>
                                    <td>{{$add_expense->paymentMethod !=""?$add_expense->paymentMethod->method:""}} {{$add_expense->payment_method_id == "3"? '('.$add_expense->account->account_name.')':''}}</td>
                                    <td data-sort="{{strtotime($add_expense->date)}}">
                                        {{$add_expense->date != ""? App\SmGeneralSettings::DateConvater($add_expense->date):''}}</td>
                                    <td>{{isset($add_expense->ACHead->head)? $add_expense->ACHead->head: ''}}</td>
                                    <td>{{$add_expense->amount}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                @if(in_array(145, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                                                <a class="dropdown-item" href="{{url('add-expense', [$add_expense->id])}}">@lang('lang.edit') </a>
                                                @endif
                                                @if(in_array(146, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteAddExpenseModal{{$add_expense->id}}"
                                                    href="#">@lang('lang.delete') </a>
                                           @endif
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteAddExpenseModal{{$add_expense->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.item') </h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete') </h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel') </button>
                                                     {{ Form::open(['url' => 'add-expense/'.$add_expense->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
                                                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete') </button>
                                                     {{ Form::close() }}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
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
