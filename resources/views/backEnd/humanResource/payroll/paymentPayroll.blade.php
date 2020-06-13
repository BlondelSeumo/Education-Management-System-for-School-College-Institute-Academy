<script src="{{asset('public/backEnd/')}}/js/main.js"></script>
<div class="container-fluid">
   {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'savePayrollPaymentData',
   'method' => 'POST', 'enctype' => 'multipart/form-data', 'onsubmit' => 'return validateForm()']) }}

   <div class="row">
    <div class="col-lg-12">
        <div class="row mt-25">
            <div class="col-lg-12" id="sibling_class_div">
                <div class="input-effect">
                    <input readonly class="read-only-input primary-input form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" type="text" name="amount" value="{{$payrollDetails->staffs->full_name}} ({{$payrollDetails->staffs->staff_no}})">
                    <input type="hidden" name="payroll_generate_id" value="{{$payrollDetails->id}}">
                    <input type="hidden" name="role_id" value="{{$role_id}}">
                    <input type="hidden" name="payroll_month" value="{{$payrollDetails->payroll_month}}">
                    <input type="hidden" name="payroll_year" value="{{$payrollDetails->payroll_year}}">
                    <label>Staff Name <span></span> </label>
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
            <div class="col-lg-6" id="">
                <div class="input-effect">
                    <input readonly class="read-only-input primary-input form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" type="text" name="amount" value="{{$payrollDetails->payroll_month}} - {{$payrollDetails->payroll_year}}">
                    <label>Month Year <span></span> </label>
                    <span class="focus-border"></span>
                    @if ($errors->has('amount'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('amount') }}</strong>
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
                    <input class="read-only-input primary-input form-control{{ $errors->has('discount') ? ' is-invalid' : '' }}" type="text" name="" value="{{$payrollDetails->net_salary}}" readonly>
                    <label>Payment Amounts <span>*</span> </label>
                    <span class="focus-border"></span>
                    @if ($errors->has('discount'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('discount') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-effect">

                    <select class="niceSelect w-100 bb form-control{{ $errors->has('payment_mode') ? ' is-invalid' : '' }}" name="payment_mode" id="payment_mode">
                        <option data-display="Payment Method *" value="">Payment Method *</option>
                        @if(isset($paymentMethods))
                        @foreach($paymentMethods as $value)
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
                    <textarea class="primary-input form-control" cols="0" rows="3" name="note" id="note"></textarea>
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