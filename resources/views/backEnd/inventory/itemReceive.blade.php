@extends('backEnd.master')
@section('mainContent')
<style type="text/css">
    #productTable tbody tr{
        border-bottom: 1px solid #FFFFFF !important;
    }
</style>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.item_receive')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.inventory')</a>
                <a href="#">@lang('lang.item_receive')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
       @if(isset($editData))
       {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'item-list/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
       @else
       @if(in_array(333, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
       {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'save-item-receive-data',
       'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'item-receive-form']) }}
       @endif
       @endif
       <div class="row">
            
        <div class="col-lg-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h3 class="mb-30">@if(isset($editData))
                                @lang('lang.edit')
                            @else

                            @endif
                            @lang('lang.receive_details')
                        </h3>
                    </div>

                    <div class="white-box">
                        <div class="add-visitor">
                            <div class="row">
                                

                                <div class="col-lg-12 mb-30">
                                    <div class="alert alert-danger" id="errorMessage1">
                                        <div id="supplierError"></div>
                                        <div id="storeError"></div>                     
                                    </div>
                                    <div class="input-effect">
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('supplier_id') ? ' is-invalid' : '' }}" name="supplier_id" id="supplier_id">
                                            <option data-display=" @lang('lang.select_supplier') *" value=""> @lang('lang.select')</option>
                                            @if(isset($suppliers))
                                            @foreach($suppliers as $key=>$value)
                                            <option value="{{$value->id}}"
                                                @if(isset($editData))
                                                @if($editData->category_name == $value->id)
                                                    @lang('lang.selected')
                                                @endif
                                                @endif
                                                >{{$value->company_name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('supplier_id'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('supplier_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-30">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('store_id') ? ' is-invalid' : '' }}" name="store_id" id="store_id">
                                                <option data-display="Select Store/WareHouse *" value="">Select</option>
                                                @if(isset($itemStores))
                                                @foreach($itemStores as $key=>$value)
                                                <option value="{{$value->id}}"
                                                    @if(isset($editData))
                                                    @if($editData->category_name == $value->id)
                                                        @lang('lang.selected')
                                                    @endif
                                                    @endif
                                                    >{{$value->store_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('store_id'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong>{{ $errors->first('store_id') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control{{ $errors->has('reference_no') ? ' is-invalid' : '' }}"
                                                type="text" name="reference_no" autocomplete="off" value="{{isset($editData)? $editData->reference_no : '' }}">
                                                <label>@lang('lang.reference') @lang('lang.no') <span></span> </label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('reference_no'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('reference_no') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-12 no-gutters input-right-icon mb-30">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input date form-control{{ $errors->has('from_date') ? ' is-invalid' : '' }}"  id="receive_date" type="text"
                                                    name="receive_date" value="{{isset($editData)? date('m/d/Y', strtotime($editData->receive_date)): date('m/d/Y')}}" autocomplete="off">
                                                    <label>@lang('lang.receive_date') <span></span> </label>
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('receive_date'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('receive_date') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="col-auto">
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="receive_date_icon"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb-20">
                                            <div class="input-effect">
                                                <textarea class="primary-input form-control" cols="0" rows="4" name="description" id="description">{{isset($editData) ? $editData->description : ''}}</textarea>
                                                <label>@lang('lang.description') <span></span> </label>
                                                <span class="focus-border textarea"></span>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
              <div class="row xm_3">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.item_receive')</h3>
                    </div>
                </div>

                <div class="offset-lg-6 col-lg-2 text-right col-md-6">
                    <button type="button" class="primary-btn small fix-gr-bg" onclick="addRow();" id="addRowBtn">
                        <span class="ti-plus pr-2"></span>
                        @lang('lang.add')
                    </button>
                </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
               <div class="white-box">
                    <div class="alert alert-danger" id="errorMessage2">
                        <div id="itemError"></div>
                        <div id="priceError"></div>
                        <div id="quantityError"></div>                     
                    </div>
                   <table class="table" id="productTable">
                    <thead>
                      <tr>
                          <th> @lang('lang.product_name') </th>
                          <th> @lang('lang.unit_price') </th>
                          <th> @lang('lang.quantity') </th>
                          <th>@lang('lang.sub_total')</th>
                          <th>@lang('lang.action')</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr id="row1" class="0">
                        <td class="border-top-0">
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}"> 
                            <div class="input-effect">
                                <select class="niceSelect w-100 bb form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="item_id[]" id="productName1">
                                    <option data-display="Select Item " value="">Select</option>
                                    @foreach($items as $key=>$value)
                                    <option value="{{$value->id}}"
                                        @if(isset($editData))
                                        @if($editData->category_name == $value->id)
                                            @lang('lang.selected')
                                        @endif
                                        @endif
                                        >{{$value->item_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('item_id'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('item_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('unit_price') ? ' is-invalid' : '' }}"
                                    type="text" id="unit_price1" name="unit_price[]" autocomplete="off" value="{{isset($editData)? $editData->unit_price : '' }}" onkeyup="getTotalByPrice(1)">

                                    <span class="focus-border"></span>
                                    @if ($errors->has('unit_price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('unit_price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}"
                                    type="text" id="quantity1" name="quantity[]" autocomplete="off" onkeyup="getTotal(1);" value="{{isset($editData)? $editData->quantity : '' }}">

                                    <span class="focus-border"></span>
                                    @if ($errors->has('quantity'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('sub_total') ? ' is-invalid' : '' }}"
                                    type="text" name="total[]" id="total1" autocomplete="off" value="{{isset($editData)? $editData->sub_total : '0.00' }}">

                                    <span class="focus-border"></span>
                                    @if ($errors->has('sub_total'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sub_total') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <input type="hidden" name="totalValue[]" id="totalValue1" autocomplete="off" class="form-control" />
                            </td>
                            <td>
                                 <button class="primary-btn icon-only fix-gr-bg" type="button">
                                     <span class="ti-trash"></span>
                                </button>
                               
                            </td>
                        </tr>
                        <tfoot>
                            <tr>
                               <th class="border-top-0" colspan="2">Total</th>
                               <th class="border-top-0">
                                   <input type="text" class="primary-input form-control" readonly=""  id="subTotalQuantity" name="subTotalQuantity" placeholder="0.00"/>

                                   <input type="hidden" class="form-control" id="subTotalQuantityValue" name="subTotalQuantityValue" />

                               </th>

                               <th class="border-top-0">
                                   <input type="text" class="primary-input form-control" id="subTotal" name="subTotal" placeholder="0.00" readonly=""/>

                                   <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />

                               </th>
                               <th class="border-top-0"></th>
                           </tr>
                       </tfoot>

                   </tbody>
               </table>
           </div>
       </div>
   </div>

   <div class="row mt-30">
    <div class="col-lg-12">
        <div class="white-box">

            <div class="row">
              <div class="col-lg-2 mt-30-md">
               <div class="col-lg-12">
                <div class="input-effect">


                    <input type="checkbox" id="full_paid" class="common-checkbox form-control{{ $errors->has('full_paid') ? ' is-invalid' : '' }}" name="full_paid" value="1">                    
                    <label for="full_paid">@lang('lang.full_paid')</label>
                </div>
            </div>
        </div>  

        <div class="col-lg-3 mt-30-md">
           <div class="col-lg-12">
            <div class="input-effect">
            <input class="primary-input" type="number" value="0" name="totalPaid" id="totalPaid" onkeyup="paidAmount();">
                <input type="hidden" id="totalPaidValue" name="totalPaidValue">
                <label>@lang('lang.total_paid')</label>
                <span class="focus-border"></span>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mt-30-md">
       <div class="col-lg-12">
        <div class="input-effect">
            <input class="primary-input" type="text" value="0.00" id="totalDue" readonly>
            <input type="hidden" id="totalDueValue" name="totalDueValue">
            <label>@lang('lang.total_due')</label>
            <span class="focus-border"></span>
        </div>
    </div>
</div>
<div class="col-lg-3">
  <select class="niceSelect w-100 bb form-control" name="payment_method" id="payment_method">
    <option data-display="Select Payment Method" value="">SELECT Payment Method </option>
    @foreach($paymentMethhods as $key=>$value)
    <option value="{{$value->id}}">{{$value->method}}</option>
    @endforeach
</select>
</div>
  @php 
                                  $tooltip = "";
                                  if(in_array(333, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
<div class="col-lg-12 mt-20 text-center">
 <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
    <span class="ti-check"></span>
     @lang('lang.receive')
</button>
</div>
</div>


</div>
</div>
</div>
</div>
</div>
{{ Form::close() }}
</div>
</section>
@endsection
