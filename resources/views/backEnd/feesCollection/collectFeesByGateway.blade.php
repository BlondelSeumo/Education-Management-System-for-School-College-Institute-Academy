@extends('backEnd.master')
@section('mainContent')
<style type="text/css">
    .smtp_wrapper{
        display: none;
    }
    .smtp_wrapper_block{
        display: block;
    }
</style>

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Collect Fees Online</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">Dashboard</a>
                <a href="{{url('student-fees')}}">All Fees</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">Collect Fees Online</h3>
                </div>
            </div>
        </div>
     {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'method' => 'POST', 'url' => 'payByPaypal', 'id' => 'payment-form', 'enctype' => 'multipart/form-data']) }}
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
              <div class="white-box">
                <div class="">
                    <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                    <input type="hidden" name="real_amount" id="real_amount" value="{{$amount}}">
                    <input type="hidden" name="student_id" value="{{$student_id}}">
                    <input type="hidden" name="fees_type_id" value="{{$fees_type_id}}"> 
                     
                     <div class="row justify-content-center mb-30">
                        <div class="col-lg-4">
                            <div class="input-effect">
                                <input class="primary-input form-control{{ $errors->has('from_name') ? ' is-invalid' : '' }}"
                                type="text" name="amount" id="amount" autocomplete="off" value="{{isset($amount)? $amount : ''}}" readonly="readonly">
                                <label>Fees Amount <span>*</span> </label>
                                <span class="focus-border"></span>
                                @if ($errors->has('from_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('from_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                  </div>
                    
                </div>
                <div class="row mt-40">
                    <div class="col-lg-12 text-center">
                        <button class="primary-btn fix-gr-bg">
                            <span class="ti-check"></span>
                            Pay with PayPal
                        </button>
                    </div>
                </div>
            </div>
        </div> 
{{ Form::close() }}
    </div>
</div>

</div>
</section>
@endsection


