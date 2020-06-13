@extends('backEnd.master')
@section('mainContent')
<style type="text/css">
#productTable tbody tr{
    border-bottom: 1px solid #FFFFFF !important;
}
/*.forStudentWrapper, #selectStaffsDiv{
    display: none;
}*/
</style>

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Edit Sell Details</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">Dashboard</a>
                <a href="#">Inventory</a>
                <a href="{{url('item-sell-list')}}">Item Sell list</a>
                <a href="#">Edit Sell Details</a>
            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area">
<div class="container-fluid p-0">

   {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'update-item-sell-data', 'enctype' => 'multipart/form-data', 'id' => 'edit-item-sell-form']) }}

   <input type="hidden" name="id" value="{{$editData->id}}">

   <div class="row">
    <div class="col-lg-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title">
                    <h3 class="mb-30">
                        Edit Sell Details
                    </h3>
                </div>

                <div class="white-box">
                    <div class="add-visitor">
                        <div class="row">
                            
                            <div class="col-lg-12 mb-30">
                                <div class="alert alert-danger" id="errorMessage1">
                                    <div id="buyerError"></div>                    
                                    <div id="classError"></div>                    
                                    <div id="sectionError"></div>                    
                                    <div id="studentError"></div>                    
                                    <div id="nameError"></div>                    
                                </div>
                                <select class="niceSelect w-100 bb form-control{{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="role_id" id="buyer_type">
                                    <option data-display="Sale To *" value="">Sale To *</option>
                                    @foreach($roles as $value)
                                    <option value="{{$value->id}}" {{$value->id == $editData->role_id? 'selected':''}}>{{$value->name}}</option>

                                    @endforeach
                                </select>
                                @if ($errors->has('role_id'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('role_id') }}</strong>
                                </span>
                                @endif
                            </div>



                            <div class="col-lg-12 {{$editData->role_id == 2? 'displayBlock':'displayNone'}}" id="student-div">
                                <div class="row">
                                    <div class="col-lg-12 mb-30">
                                        <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                            <option data-display="Select Class *" value="">Select Class *</option>
                                                @foreach($classes as $class)
                                                <option value="{{$class->id}}" {{$editData->role_id == 2? ($class->id == $studentClassSection->class_id? 'selected':''):""}}>{{$class->class_name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('class'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('class') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <div class="col-lg-12 mb-30" id="select_section_div">

                                         @if($editData->role_id == 2)
                                         <select class="w-100 bb niceSelect form-control {{ $errors->has('section') ? ' is-invalid' : '' }}" id="section" name="section">
                                            <option data-display="Select Section *" value="">Select Section *</option>
                                            @foreach($sections as $section)
                                            <option value="{{$section->id}}"  {{( old("section") == $section->id ? "selected":"")}}
                                                @if($editData)
                                                @if($studentClassSection->section_id == $section->id)
                                                selected
                                                @endif
                                                @endif
                                                >{{$section->section_name}}</option>
                                                @endforeach
                                            </select>
                                            @else
                                            <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }}" id="select_section" name="section">
                                                <option data-display="Select section *" value="">Select section *</option>
                                            </select>
                                            @endif

                                            @if ($errors->has('section'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('section') }}</strong>
                                            </span>
                                            @endif
                                        </div>


                                        <div class="col-lg-12 mb-30" id="select_student_div">
                                         @if($editData->role_id == 2)
                                        
                                            <select class="w-100 bb niceSelect form-control {{ $errors->has('student') ? ' is-invalid' : '' }}" id="student" name="student">
                                                <option data-display="Select Student *" value="">Select Student *</option>
                                                @foreach($allStudentsSameClassSection as $student)
                                                <option value="{{$student->id}}"  {{( old("student") == $student->id ? "selected":"")}}
                                                    @if($editData)
                                                    @if($editData->student_staff_id == $student->id)
                                                    selected
                                                    @endif
                                                    @endif
                                                    >{{$student->full_name}}</option>
                                                    @endforeach
                                                </select>
                                                @else

                                                <select class="w-100 bb niceSelect form-control{{ $errors->has('student') ? ' is-invalid' : '' }}" id="select_student" name="student">
                                                    <option data-display="Select Student *" value="">Select Student *</option>
                                                </select>
                                                @endif

                                                @if ($errors->has('student'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong>{{ $errors->first('student') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-30 {{$editData->role_id != 2? 'displayBlock':'displayNone'}}" id="staff-div">
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('staff_id') ? ' is-invalid' : '' }}" name="staff_id" id="selectStaffs">
                                            <option data-display="Name *" value="">Name *</option>

                                            @if($staffsByRole != "")

                                            @foreach($staffsByRole as $value)

                                            @if($editData->role_id == 3)
                                                <option value="{{$value->id}}" 
                                            {{$value->id == $editData->student_staff_id? 'selected':''}}
                                            >{{$value->fathers_name}}</option>
                                            @else
                                                <option value="{{$value->id}}" 
                                            {{$value->id == $editData->student_staff_id? 'selected':''}}
                                            >{{$value->full_name}}</option>
                                            @endif

                                            @endforeach

                                            @endif
                                        </select>
                                        @if ($errors->has('staff_id'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('staff_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-12 mb-20">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('reference_no') ? ' is-invalid' : '' }}"
                                            type="text" name="reference_no" autocomplete="off" value="{{isset($editData)? $editData->reference_no : '' }}">
                                            <label>Reference No <span></span> </label>
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
                                                <input class="primary-input date form-control{{ $errors->has('sell_date') ? ' is-invalid' : '' }}"  id="sell_date" type="text"
                                                name="sell_date" value="{{isset($editData)? date('m/d/Y', strtotime($editData->sell_date)): ''}}" autocomplete="off">
                                                <label>Sell Date <span></span> </label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('sell_date'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('sell_date') }}</strong>
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
                                            <label>Description <span></span> </label>
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
                    
              <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-30">Item Sale</h3>
                    </div>
                </div>

                <div class="offset-lg-6 col-lg-2 text-right col-md-6">
                    <button type="button" class="primary-btn small fix-gr-bg" onclick="addRowInSell();" id="addRowBtn">
                        <span class="ti-plus pr-2"></span>
                        Add 
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
                          <th>Product Name</th>
                          <th>Sell Price</th>
                          <th>Quantity</th>
                          <th>Sub Total</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  @php $i = 0; $j=0; $total_quantity = 0; $grand_total = 0; @endphp
                  @if(isset($editDataChildren))
                  @foreach($editDataChildren as $editDataValue)
                      <tr id="row{{++$i}}" class="{{$j++}}">
                        <td>
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}"> 
                            <div class="input-effect">
                                <select class="niceSelect w-100 bb form-control{{ $errors->has('item_id') ? ' is-invalid' : '' }}" name="item_id[]" id="productName{{$j}}">
                                    <option data-display="Select Item " value="">Select</option>
                                    @foreach($items as $key=>$value)
                                    <option value="{{$value->id}}"
                                        @if(isset($editDataChildren))
                                        @if($editDataValue->item_id == $value->id)
                                        selected
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
                            <td>
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('sell_price') ? ' is-invalid' : '' }}"
                                    type="text" id="unit_price{{$i}}" name="unit_price[]" autocomplete="off" value="{{isset($editDataChildren)? $editDataValue->sell_price : '' }}" onkeyup="getTotalByPrice({{$i}})">

                                    <span class="focus-border"></span>
                                    @if ($errors->has('sell_price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sell_price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}"
                                    type="text" id="quantity{{$i}}" name="quantity[]" autocomplete="off" onkeyup="getTotalInSell({{$i}});" value="{{isset($editDataChildren)? $editDataValue->quantity : '' }}">

                                    <span class="focus-border"></span>
                                    @if ($errors->has('quantity'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('sub_total') ? ' is-invalid' : '' }}"
                                    type="text" name="total[]" id="total{{$i}}" autocomplete="off" value="{{isset($editDataChildren)? number_format( (float) $editDataValue->sub_total, 2, '.', '') : '' }}">

                                    <span class="focus-border"></span>
                                    @if ($errors->has('sub_total'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sub_total') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <input type="hidden" name="totalValue[]" id="totalValue{{$i}}" autocomplete="off" class="form-control" value="{{isset($editDataChildren)? $editDataValue->sub_total : '' }}"/>
                            </td>
                            <td><a>
                                <button class="primary-btn icon-only fix-gr-bg" type="button">
                                 <span class="ti-trash" id="removeSubject" onclick="deleteSubject(4)"></span>
                                 </button>
                            </a></td>
                        </tr>
                        @php 
                          $total_quantity += $editDataValue->quantity;
                          $grand_total += $editDataValue->sub_total; 
                        @endphp
                        @endforeach
                        @endif
                        <tfoot>
                            <tr>
                               <th colspan="2">Total</th>
                               <th>
                                   
                                   <input type="text" class="primary-input form-control" id="subTotalQuantity" name="subTotalQuantity" placeholder="0" readonly="" value="{{isset($editDataChildren)? $total_quantity : '' }}"/>

                                   <input type="hidden" class="form-control" id="subTotalQuantityValue" value="{{isset($editDataChildren)? $total_quantity : '' }}"  name="subTotalQuantityValue" />

                               </th>

                               <th>
                                   <input type="text" class="primary-input form-control" id="subTotal" name="subTotal" placeholder="0.00" readonly="" 
                                   value="{{ number_format( (float) $grand_total, 2, '.', '') }}"
                                   />

                                   <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" value="{{ number_format( (float) $grand_total, 2, '.', '') }}"/>

                               </th>
                               <th></th>
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

                    <input type="checkbox" id="full_paid" class="common-checkbox form-control{{ $errors->has('full_paid') ? ' is-invalid' : '' }}" name="full_paid" value="1" @if($editData->paid_status == 'P')
                    checked
                    @endif>                    
                    <label for="full_paid">Full Paid</label>
                </div>
            </div>
        </div>  

        <div class="col-lg-3 mt-30-md">
           <div class="col-lg-12">
            <div class="input-effect">
            <input class="primary-input" type="number"  name="totalPaid" id="totalPaid" onkeyup="paidAmount();" value="{{isset($editData)? $editData->total_paid : '' }}">
                <input type="hidden" id="totalPaidValue" name="totalPaidValue">
                <label>Total Paid</label>
                <span class="focus-border"></span>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mt-30-md">
       <div class="col-lg-12">
        <div class="input-effect">
            <input class="primary-input" type="text" value="{{isset($editData)? number_format( (float) $editData->total_due, 2, '.', '') : '' }}" id="totalDue" readonly>
            <input type="hidden" id="totalDueValue" name="totalDueValue" value="{{isset($editData)? $editData->total_due : '' }}">
            <label>Total Due</label>
            <span class="focus-border"></span>
        </div>
    </div>
</div>
<div class="col-lg-3">
  <select class="niceSelect w-100 bb form-control" name="payment_method" id="payment_method">
    <option data-display="Select Payment Method" value="">SELECT Payment Method </option>
    @foreach($paymentMethhods as $key=>$value)
    <option value="{{$value->id}}"
        @if(isset($editData))
        @if($editData->payment_method == $value->id)
        selected
        @endif
        @endif
    >{{$value->method}}</option>
    @endforeach
</select>
</div>
<div class="col-lg-12 mt-20 text-center">
 <button class="primary-btn fix-gr-bg">
    <span class="ti-check"></span>
    Update
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