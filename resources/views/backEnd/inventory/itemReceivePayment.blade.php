<script src="{{asset('public/backEnd/')}}/js/main.js"></script>

<div class="container-fluid">
   {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'save-item-receive-payment',
   'method' => 'POST', 'enctype' => 'multipart/form-data', 'onsubmit' => 'return validateForm()']) }}

   <div class="row">
    <div class="col-lg-12">
        <div class="row mt-25">
            <div class="col-lg-12" id="">
               
            </div>
        </div>
        <input type="hidden" name="item_receive_id" value="{{$id}}">
        <div class="row mt-25">
            <div class="col-lg-6">
                <div class="input-effect">
                    <input class="read-only-input primary-input form-control{{ $errors->has('reference_no') ? ' is-invalid' : '' }}" type="text" name="reference_no" value="">
                    <label>Reference No <span>*</span> </label>
                    <span class="focus-border"></span>
                    @if ($errors->has('reference_no'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('reference_no') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6" id="">
                <div class="input-effect">
                    <input class="read-only-input primary-input date form-control{{ $errors->has('apply_date') ? ' is-invalid' : '' }}" id="payment_date" type="text"
                    name="payment_date" value="{{date('m/d/Y')}}">
                    <label>Payment Date <span>*</span> </label>
                    <span class="focus-border"></span>
                    @if ($errors->has('payment_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('payment_date') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row mt-25">
            <div class="col-lg-6">
                <div class="input-effect">
                    <input class="read-only-input primary-input form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" type="number" name="amount" value="{{$paymentDue->total_due}}" id="total_due" onkeyup="checkDue()">
                    <input type="hidden" id="total_due_value" value="{{$paymentDue->total_due}}">
                    <label>Payment Amounts <span>*</span> </label>
                    <span class="focus-border"></span>
                    @if ($errors->has('amount'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('amount') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-effect">

                    <select class="niceSelect w-100 bb form-control{{ $errors->has('payment_mode') ? ' is-invalid' : '' }}" name="payment_method" id="payment_mode">
                        <option data-display="Payment Method *" value="">Payment Method *</option>
                        @if(isset($paymentMethhods))
                        @foreach($paymentMethhods as $value)
                        <option value="{{$value->id}}" >{{$value->method}}</option>
                        @endforeach
                        @endif
                    </select>
                    <span class="modal_input_validation red_alert"></span>

                </div>
            </div>
        </div>

        <div class="row mt-25">
            <div class="col-lg-12" id="sibling_name_div">
                <div class="input-effect mt-20">
                    <textarea class="primary-input form-control" cols="0" rows="3" name="notes" id="notes"></textarea>
                    <label>Note </label>
                    <span class="focus-border textarea"></span>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 text-center mt-40">
        <div class="mt-40 d-flex justify-content-between">
            <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancel</button>

            <input class="primary-btn fix-gr-bg" type="submit" value="save information">
        </div>
    </div>
</div>
{{ Form::close() }}
</div>