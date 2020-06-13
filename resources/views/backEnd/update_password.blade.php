@extends('backEnd.master')

@section('mainContent')

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Change Password</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">Dashboard</a>
                <a href="#">Change Password</a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area mb-40">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">Change Password </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                
                <div class="white-box">
                	@if(session()->has('message-success') != "")
	                    @if(session()->has('message-success'))
	                    <div class="alert alert-success">
	                        {{ session()->get('message-success') }}
	                    </div>
	                    @endif
	                @endif
	                 @if(session()->has('message-danger') != "")
	                    @if(session()->has('message-danger'))
	                    <div class="alert alert-danger">
	                        {{ session()->get('message-danger') }}
	                    </div>
	                    @endif
	                @endif
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'admin-change-password', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">

                            <div class="row mb-25">
	                            <div class="col-lg-6 offset-lg-3">
		                            <div class="input-effect">
		                                <input class="primary-input form-control{{ $errors->has('current_password') || session()->has('password-error') ? ' is-invalid' : '' }}" type="text" name="current_password">
		                                <label>Current Password</label>
		                                <span class="focus-border"></span>
		                                @if ($errors->has('current_password'))
		                                <span class="invalid-feedback" role="alert">
		                                    <strong>{{ $errors->first('current_password') }}</strong>
		                                </span>
		                                @endif
		                                @if (session()->has('password-error'))
		                                <span class="invalid-feedback" role="alert">
		                                    <strong>{{ session()->get('password-error') }}</strong>
		                                </span>
		                                @endif
		                            </div>
		                        </div>
		                    </div>

                            <div class="row mb-25">
	                            <div class="col-lg-6 offset-lg-3">
		                            <div class="input-effect">
		                                <input class="primary-input form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" type="text" name="new_password">
		                                <label>New Password</label>
		                                <span class="focus-border"></span>
		                                @if ($errors->has('new_password'))
		                                <span class="invalid-feedback" role="alert">
		                                    <strong>{{ $errors->first('new_password') }}</strong>
		                                </span>
		                                @endif
		                            </div>
		                        </div>
		                    </div>

                            <div class="row mb-25">
	                            <div class="col-lg-6 offset-lg-3">
		                            <div class="input-effect">
		                                <input class="primary-input form-control{{ $errors->has('confirm_password') ? ' is-invalid' : '' }}" type="text" name="confirm_password">
		                                <label>Confirm Password</label>
		                                <span class="focus-border"></span>
		                                @if ($errors->has('confirm_password'))
		                                <span class="invalid-feedback" role="alert">
		                                    <strong>{{ $errors->first('confirm_password') }}</strong>
		                                </span>
		                                @endif
		                            </div>
		                        </div>
		                    </div>


                            

                            <div class="row">
	                            <div class="col-lg-12 mt-20 text-center"> 

	                                <button type="submit" class="primary-btn fix-gr-bg">
	                                    <span class="ti-check"></span>
	                                    Change Password
	                                </button>
	                            </div>
	                        </div>
                       
                    {{ Form::close() }}
                </div>
            </div>
        </div>
</section>


@endsection
