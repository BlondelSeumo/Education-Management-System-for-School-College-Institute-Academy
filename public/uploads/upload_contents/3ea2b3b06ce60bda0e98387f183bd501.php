@extends('backEnd.master')
@section('mainContent')
@php
    function showPicName($data){
        $name = explode('/', $data);
        return $name[3];
    }

    $modules = [];
    $module_links = [];
    $permissions = App\SmRolePermission::where('role_id', Auth::user()->role_id)->get();

 
    foreach($permissions as $permission){ $module_links[] = $permission->module_link_id; $modules[] = $permission->moduleLink->module_id;}

 
    $modules = array_unique($modules);




    $generalSetting=App\SmGeneralSettings::where('id',1)->first();
    $currency_symbol = $generalSetting->currency_symbol; 

    if(isset($generalSetting->logo)){  $logo = $generalSetting->logo;  }
    else{ $logo = 'public/uploads/settings/logo.png'; }

@endphp
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.add') @lang('lang.income') </h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.accounts')</a>
                <a href="#">@lang('lang.add') @lang('lang.income')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        @if(in_array(47, $module_links) || Auth::user()->role_id == 1)
        @if(isset($add_income))
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('add-income')}}" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30">@if(isset($add_income))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.income')
                            </h3>
                        </div>
                        @if(isset($add_income))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'add_income_update',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'add-income-update']) }}
                        @else
                        @if(in_array(47, $module_links) || Auth::user()->role_id == 1)
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'add_income_store',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'add-income']) }}
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
                                        @if ($errors->any())
                                             <div class="error text-danger"><strong>{{ 'Please fill up the required fields' }}</strong></div>
                                        @endif
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                type="text" name="name" autocomplete="off" value="{{isset($add_income)? $add_income->name: old('name')}}">
                                            <input type="hidden" name="id" value="{{isset($add_income)? $add_income->id: ''}}">
                                            <label>@lang('lang.name') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row  mt-25">
                                    <div class="col-lg-12">

                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('income_head') ? ' is-invalid' : '' }}" name="income_head"  id="expense-head">
                                            <option data-display="@lang('lang.a_c_Head') *" value="">@lang('lang.a_c_Head') *</option>
                                            @foreach($income_heads as $income_head)
                                                @if(isset($add_income))
                                                <option value="{{$income_head->id}}"
                                                    {{$add_income->income_head_id == $income_head->id? 'selected': ''}}>{{$income_head->head}}</option>
                                                @else
                                                <option value="{{$income_head->id}}" {{old('income_head') == $income_head->id? 'selected' : ''}}>{{$income_head->head}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('income_head'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('income_head') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="row mt-30">
                                    <div class="col-lg-12" id="sub-head-div">
                                         <select class="niceSelect w-100 bb form-control{{ $errors->has('sub_head') ? ' is-invalid' : '' }}" name="sub_head" id="sub-head">
                                            <option data-display="Sub Head *" value="">sub head *</option>
                                            @if(isset($sub_heads))
                                            @foreach($sub_heads as $sub_head)
                                                <option value="{{$sub_head->id}}" {{$add_income->income_sub_head_id == $sub_head->id? 'selected':''}}>{{$sub_head->sub_head}}</option>
                                            @endforeach
                                            @endif


                                            
                                        </select>
                                        @if ($errors->has('sub_head'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('sub_head') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                </div>

                                


                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('payment_method') ? ' is-invalid' : '' }}" name="payment_method" id="payment_method">
                                            <option data-display="@lang('lang.payment_method') *" value="">@lang('lang.payment_method') *</option>
                                            @foreach($payment_methods as $payment_method)
                                            @if(isset($add_income))
                                            <option value="{{$payment_method->id}}"
                                                {{$add_income->payment_method_id == $payment_method->id? 'selected': ''}}>{{$payment_method->method}}</option>
                                            @else
                                            <option value="{{$payment_method->id}}">{{$payment_method->method}}</option>
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
                                            <option data-display="@lang('lang.accounts') *" value="">@lang('lang.accounts') *</option>
                                            @foreach($bank_accounts as $bank_account)
                                            @if(isset($add_income))
                                            <option value="{{$bank_account->id}}"
                                                {{$add_income->account_id == $bank_account->id? 'selected': ''}}>{{$bank_account->account_name}}</option>
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


                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control{{ $errors->has('date') ? ' is-invalid' : '' }}"
                                                id="startDate" type="text" placeholder="@lang('lang.date') *" name="date" value="{{isset($add_income)? date('m/d/Y', strtotime($add_income->date)): date('m/d/Y')}}">
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
                                <div class="row  mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                                type="number" name="amount" value="{{isset($add_income)? $add_income->amount: old('amount')}}" maxlength="10" step="any">
                                            <label>@lang('lang.amount') <span>*</span></label>
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
                                                    <input class="primary-input" type="text" id="placeholderFileOneName" placeholder="{{isset($add_income)? ($add_income->file != ""? showPicName($add_income->file):'File'):'file' }}" readonly
                                                        >
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg" for="document_file_1">@lang('lang.browse')</label>
                                                    <input type="file" class="d-none" name="file" id="document_file_1">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4" name="description">{{isset($add_income)? $add_income->description: old('description')}}</textarea>
                                            <label>@lang('lang.description') <span></span></label>
                                            <span class="focus-border textarea"></span>
                                        </div>
                                    </div>
                                </div>
                                @php 
                                  $tooltip = "";
                                   if(in_array(47, $module_links) ||  Auth::user()->role_id == 1){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            {{!isset($add_income)? "save":"update"}} @lang('lang.income')
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
                            <h3 class="mb-0">@lang('lang.income') @lang('lang.list')</h3>
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
                                    <th>@lang('lang.name')</th>
                                    <th>@lang('lang.payment_method')</th>
                                    <th>@lang('lang.date')</th>
                                    <th>@lang('lang.a_c_Head')</th>
                                    <th>@lang('lang.sub') @lang('lang.a_c_Head')  </th>
                                    <th>@lang('lang.amount') ({{$currency_symbol}} )</th>
                                    <th>@lang('lang.action')</th>
                                    <th>@lang('lang.author_details')</th> 
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($add_incomes as $add_income)
                                <tr>
                                    <td>{{$add_income->name}}</td>
                                    <td>{{$add_income->paymentMethod !=""?$add_income->paymentMethod->method:""}} {{$add_income->payment_method_id == "3"? '('.$add_income->account->account_name.')':''}}</td>
                                    <td>{{date('jS M, Y', strtotime($add_income->date))}}</td>
                                    <td>{{isset($add_income->ACHead->head)? $add_income->ACHead->head: ''}}</td>
                                    <td>{{isset($add_income->IncomeACSubHead)? $add_income->IncomeACSubHead->sub_head: ''}}</td>
                                    <td>{{number_format( $add_income->amount, 2, '.', '' )}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @if(in_array(48, $module_links) || Auth::user()->role_id == 1)
                                                <a class="dropdown-item" href="{{route('add_income_edit', [$add_income->id])}}">@lang('lang.edit')</a>
                                                @endif
                                                @if(in_array(49, $module_links) || Auth::user()->role_id == 1)
                                                <a class="dropdown-item deleteAddIncomeModal" href="#" data-toggle="modal" data-target="#deleteAddIncomeModal" data-id="{{$add_income->id}}">@lang('lang.delete')</a>
                                                @endif
                                                @if($add_income->file != "")
                                                <a class="dropdown-item" href="{{url('download-income/'.showPicName($add_income->file))}}">
                                                   
                                                        Download
                                                        <span class="pl ti-download"></span>
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        Created: {{App\User::getUserDetails($add_income->created_by)}} At {{date('d F Y, h:i:s A',strtotime($add_income->created_at))}}
                                    @if(!empty($add_income->updated_by)) <br> 
                                    Last Updated: {{App\User::getUserDetails($add_income->updated_by)}} At {{date('d F Y, h:i:s A',strtotime($add_income->updated_at))}} @endif
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



<div class="modal fade admin-query" id="deleteAddIncomeModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('lang.delete') @lang('lang.income')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                     {{ Form::open(['route' => 'add_income_delete', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                     <input type="hidden" name="id" value="" id="ncome_id">
                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                     {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
