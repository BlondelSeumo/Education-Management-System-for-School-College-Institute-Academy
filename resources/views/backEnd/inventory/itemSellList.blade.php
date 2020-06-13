@extends('backEnd.master')
@section('mainContent')
@php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } @endphp

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.item_sell') @lang('lang.list')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.inventory')</a>
                <a href="#">@lang('lang.item_sell') @lang('lang.list')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8 col-md-6">
                
            </div>
             @if(in_array(340, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
            <div class="col-lg-4 text-md-right text-left col-md-6 mb-30-lg">
                <a href="{{url('item-sell')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.new') @lang('lang.item_sell')
                </a>
            </div>
            @endif
        </div>

 <div class="row mt-40">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-0">@lang('lang.item_sell') @lang('lang.list')</h3>
                    </div>
                </div>
            </div>

         <div class="row">
                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                        <thead>
                            @if(session()->has('message-success') != "" ||
                                session()->get('message-danger') != "")
                                <tr>
                                    <td colspan="10">
                                         @if(session()->has('message-success'))
                                          <div class="alert alert-success">
                                              {{ session()->get('message-success') }}
                                          </div>
                                        @elseif(session()->has('message-danger'))
                                          <div class="alert alert-danger">
                                              {{ session()->get('message-danger') }}
                                          </div>
                                        @endif
                                    </td>
                                </tr>
                                 @endif
                            <tr>
                                <th>@lang('lang.reference') @lang('lang.no')</th>
                                <th>@lang('lang.role') @lang('lang.name')</th>
                                <th>@lang('lang.buyer') @lang('lang.name')</th>
                                <th>@lang('lang.date')</th>
                                <th>@lang('lang.grand_total')</th>
                                <th>@lang('lang.total_quantity')</th>
                                <th>@lang('lang.paid')</th>
                                <th>@lang('lang.balance') ({{$currency}})</th>
                                <th>@lang('lang.Status')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(isset($allItemSellLists))
                            @foreach($allItemSellLists as $value)
                            <tr>
                                <td>{{$value->reference_no}}</td>
                                <td>{{$value->roles->name}}</td>
                                @if($value->role_id == 2)
                                @php
                                $getBuyerDetails = $value->studentDetails;
                                @endphp


                                @elseif($value->role_id == 3)

                                @php
                                $getBuyerDetails = $value->parentsDetails;
                                @endphp

                                @else

                                @php
                                $getBuyerDetails = $value->staffDetails;
                                @endphp
                                @endif

                                <td>
                                @if(!empty($getBuyerDetails))
                                {{$value->role_id == 3? $getBuyerDetails->fathers_name:$getBuyerDetails->full_name}}
                                @endif
                                </td>
                                <td  data-sort="{{strtotime($value->sell_date)}}" >
                                   {{$value->sell_date != ""? App\SmGeneralSettings::DateConvater($value->sell_date):''}} 
                                </td>
                                
                                <td>{{number_format( (float) $value->grand_total, 2, '.', '')}}</td>
                                <td>{{$value->total_quantity}}</td>
                                <td>{{number_format( (float) $value->total_paid, 2, '.', '')}}</td>
                                <td>{{number_format( (float) $value->total_due, 2, '.', '')}}</td>
                                <td>
                                    @if($value->paid_status == 'P')
                                    <button class="primary-btn small bg-success text-white border-0">@lang('lang.paid')</button>
                                    @elseif($value->paid_status == 'PP')
                                    <button class="primary-btn small bg-warning text-white border-0">@lang('lang.partial_paid')</button>
                                    @elseif($value->paid_status == 'U')
                                    <button class="primary-btn small bg-danger text-white border-0">@lang('lang.unpaid')</button>
                                    @else
                                    <button class="primary-btn small bg-info text-white border-0">@lang('lang.refund')</button>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            @lang('lang.select')
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{url('view-item-sell', $value->id)}}">@lang('lang.view')</a>
                                            @php
                                            $itemPaymentdetails = App\SmInventoryPayment::itemPaymentdetails($value->id);
                                            @endphp

                                            @if($value->paid_status != 'R')
                                            @if($itemPaymentdetails == 0)
                                             @if(in_array(341, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                                            <a class="dropdown-item" href="{{url('edit-item-sell', 
                                            $value->id)}}">@lang('lang.edit')</a>
                                            @endif
                                            @endif
                                            @endif

                                             @if($value->paid_status != 'R')
                                             @if($value->total_due > 0)
                                              @if(in_array(343, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                                             <a class="dropdown-item modalLink" title="Add Payment" data-modal-size="modal-md" href="{{url('add-payment-sell', $value->id)}}">@lang('lang.add') @lang('lang.payment')</a>
                                             @endif
                                             @endif
                                             @endif

                                             @if($value->paid_status != 'P')
                                               @if(in_array(344, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                                             <a class="dropdown-item modalLink" data-modal-size="modal-lg" title="View Payments" href="{{url('view-sell-payments', $value->id)}}">@lang('lang.view') @lang('lang.payment')</a>
                                              @endif
                                              @endif

                                                @if($value->paid_status != 'R')
                                                @if($value->total_paid == 0)
                                                 @if(in_array(342, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                                                <a class="dropdown-item deleteUrl" data-modal-size="modal-md" title="Delete Sold Item" href="{{url('delete-item-sale-view', $value->id)}}">@lang('lang.delete')</a>
                                                @endif
                                                @endif
                                                @endif

                                                @if($value->paid_status != 'R')
                                                @if($value->total_paid>0)

                                                <a class="dropdown-item deleteUrl" data-modal-size="modal-md" title="Cancel Item Sell" href="{{url('cancel-item-sell-view', $value->id)}}">@lang('lang.cancel')</a>
                                                @endif
                                                @endif

                                           
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
