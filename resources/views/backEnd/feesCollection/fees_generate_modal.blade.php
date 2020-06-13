
<script src="{{asset('public/backEnd/')}}/js/main.js"></script>

<div class="container-fluid">
    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'fees-payment-store',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'myForm', 'onsubmit' => "return validateFormFees()"]) }}
        <div class="row">
            <div class="col-lg-12">
                <div class="row mt-25">
                    <div class="col-lg-12">
                        <div class="no-gutters input-right-icon">
                            <div class="col">
                                <div class="input-effect">
                                    <input class="primary-input date form-control" id="startDate" type="text"
                                         name="date" value="{{date('m/d/Y')}}" readonly>
                                        <label>Date</label>
                                        <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="" type="button">
                                    <i class="ti-calendar" id="start-date-icon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                <input type="hidden" name="real_amount" id="real_amount" value="{{$amount}}">
                <input type="hidden" name="student_id" value="{{$student_id}}">
                <input type="hidden" name="fees_type_id" value="{{$fees_type_id}}">

                <div class="row mt-25">
                    <div class="col-lg-12" id="sibling_class_div">
                        <div class="input-effect">
                            <input class="primary-input form-control" type="text" name="amount" value="{{$amount}}" id="amount">
                            <label>Amount <span>*</span> </label>
                            <span class="focus-border"></span>
                            
                            <span class=" text-danger" role="alert" id="amount_error">
                                
                            </span>
                            
                        </div>
                    </div>
                </div>
                <div class="row mt-25">
                    <div class="col-lg-12">
                        <select class="niceSelect w-100 bb" name="discount_group" id="discount_group">
                            <option data-display="Discount Group *" value="">Discount Group *</option>
                            @foreach($discounts as $discount)
                                @if($discount->feesDiscount->type != "year")
                                    @if(!in_array($discount->id, $applied_discount))
                                    <option value="{{$discount->id}}">{{$discount->feesDiscount !=""?$discount->feesDiscount->name:""}}</option>
                                    @endif
                                @else
                                    @for($i = 1; $i <= date('m'); $i++)
                                    @php
                                    $discount_year = App\SmFeesPayment::discountMonth($discount->id, $i);
                                    @endphp

                                    @if($discount_year == "")

                                    <option value="{{$discount->id.'-'.$i}}">{{$discount->feesDiscount->name.' for '. date('F', mktime(0, 0, 0, $i, 10))}} </option>

                                    @endif


                                    @endfor
                                @endif    

                            @endforeach  
                        </select>
                    </div>
                </div>
                <div class="row mt-25">
                    <div class="col-lg-6">
                        <div class="input-effect">
                            <input class="primary-input form-control" type="number" name="discount_amount" id="discount_amount" value="0">
                            <label>Discount <span>*</span> </label>
                            <span class="focus-border"></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-effect">
                            <input class="primary-input form-control" type="text" name="fine" value="0">
                            <label>Fine <span>*</span> </label>
                            <span class="focus-border"></span>
                        </div>
                    </div>
                </div>

                <div class="row mt-25">
                    <div class="col-lg-3">
                        <p class="text-uppercase fw-500 mb-10">Payment Mode *</p>
                    </div>
                    <div class="col-lg-6">
                            <div class="d-flex radio-btn-flex ml-40">
                                <div class="mr-30">
                                    <input type="radio" name="payment_mode" id="cash" value="C" class="common-radio" checked>
                                    <label for="cash">Cash</label>
                                </div>
                                <div class="mr-30">
                                    <input type="radio" name="payment_mode" id="cheque" value="Cq" class="common-radio">
                                    <label for="cheque">Cheque</label>
                                </div>
                                <div>
                                    <input type="radio" name="payment_mode" id="dd" value="D" class="common-radio">
                                    <label for="dd">DD</label>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="row mt-25">
                    <div class="col-lg-12" id="sibling_name_div">
                        <div class="input-effect mt-20">
                            <textarea class="primary-input form-control" cols="0" rows="3" name="note" id="note"></textarea>
                            <label>Note </label>
                            <span class="focus-border textarea"></span>
                           
                        </div>
                    </div>
                </div>
            </div>


            <!-- <div class="col-lg-12 text-center mt-40">
                <button class="primary-btn fix-gr-bg" id="save_button_sibling" type="button">
                    <span class="ti-check"></span>
                    save information
                </button>
            </div> -->
            <div class="col-lg-12 text-center mt-40">
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancel</button>

                    <button class="primary-btn fix-gr-bg" type="submit">save information</button>
                </div>
            </div>
        </div>
    {{ Form::close() }}
</div>
