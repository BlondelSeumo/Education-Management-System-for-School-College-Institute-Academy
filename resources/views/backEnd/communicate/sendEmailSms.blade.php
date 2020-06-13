@extends('backEnd.master') @section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.send_email') </h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.communicate')</a>
                <a href="#"> @lang('lang.Send_Email_Sms')</a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.Send_Email_Sms') </h3>
                </div>
            </div>

        </div>
        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'send-email-sms', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
        <div class="row">
            <div class="col-lg-12">
                @if(session()->has('message-success'))
                <div class="alert alert-success">
                    {{ session()->get('message-success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                @elseif(session()->has('message-danger'))
                <div class="alert alert-danger">
                    {{ session()->get('message-danger') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-7">
                        <div class="white-box">
                            <div class="">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="input-effect mb-30">
                                            <input class="primary-input form-control{{ $errors->has('email_sms_title') ? ' is-invalid' : '' }}" type="text" name="email_sms_title" autocomplete="off" value="{{ old('email_sms_title') }}">
                                            <label>@lang('lang.title') <span>*</span> </label>
                                            <span class="focus-border"></span> @if ($errors->has('email_sms_title'))
                                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email_sms_title') }}</strong>
                        </span> @endif
                                        </div>
                                        <div class="col-lg-12 d-flex mb-20">
                                            <div class="row">
                                                <p class="text-uppercase fw-500 mb-10">Send Through</p>
                                                <div class="d-flex radio-btn-flex ml-40">
                                                    <div class="mr-30">
                                                        <input type="radio" name="send_through" id="Email" value="E" class="common-radio relationButton" checked>
                                                        <label for="Email">@lang('lang.email')</label>
                                                    </div>
                                                    <div class="mr-30">
                                                        <input type="radio" name="send_through" id="Sms" value="S" class="common-radio relationButton">
                                                        <label for="Sms">@lang('lang.sms')</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-effect">
                                            <textarea class="primary-input form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" cols="0" rows="4" name="description" id="details">{{ old('description') }}</textarea>
                                            <label>@lang('lang.description') <span>*</span> </label>
                                            <span class="focus-border textarea"></span> @if ($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span> @endif
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">

                        <div class="row student-details">

                            <!-- Start Sms Details -->
                            <div class="col-lg-12">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#group_email_sms" selectTab="G" role="tab" data-toggle="tab">@lang('lang.group')</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" selectTab="I" href="#indivitual_email_sms" role="tab" data-toggle="tab">@lang('lang.individual')</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" selectTab="C" href="#class_section_email_sms" role="tab" data-toggle="tab">@lang('lang.class')</a>
                                    </li>

                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <input type="hidden" name="selectTab" id="selectTab">
                                    <div role="tabpanel" class="tab-pane fade show active" id="group_email_sms">

                                        <div class="white-box">
                                            <div class="col-lg-12">
                                                <label>@lang('lang.message') @lang('lang.to') </label>
                                                <br> @foreach($roles as $role)
                                                <div class="">

                                                    <input type="checkbox" id="role_{{$role->id}}" class="common-checkbox" value="{{$role->id}}" name="role[]">
                                                    <label for="role_{{$role->id}}">{{$role->name}}</label>

                                                </div>
                                                @endforeach @if($errors->has('section'))
                                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('section') }}</strong>
                        </span> @endif
                                            </div>

                                        </div>

                                    </div>

                                    <div role="tabpanel" class="tab-pane fade" id="indivitual_email_sms">

                                        <div class="white-box">
                                            <div class="row mb-35">

                                                <div class="col-lg-12">
                                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="role_id" id="staffsByRoleCommunication">
                                                        <option data-display="@lang('lang.role')  *" value="">@lang('lang.role') *</option>
                                                        @foreach($roles as $value) @if(isset($editData))
                                                        <option value="{{$value->id}}" {{$value->id == $editData->role_id? 'selected':''}}>{{$value->name}}</option>
                                                        @else
                                                        <option value="{{$value->id}}">{{$value->name}}</option>

                                                        @endif @endforeach
                                                    </select>
                                                    @if ($errors->has('leave_type'))
                                                    <span class="invalid-feedback invalid-select" role="alert">
                                <strong>{{ $errors->first('leave_type') }}</strong>
                            </span> @endif
                                                </div>

                                                <div class="col-lg-12 mt-30" id="selectStaffsDiv">
                                                    <label for="checkbox" class="mb-2">@lang('lang.name')</label>
                                                    <select multiple id="selectStaffss" name="message_to_individual[]" style="width:300px">
                                                    </select>

                                                    <div class="">
                                                    <input type="checkbox" id="checkbox" class="common-checkbox">
                                                    <label for="checkbox" class="mt-3">@lang('lang.select_all') </label>
                                                    </div>

                                                    @if ($errors->has('staff_id'))
                                                    <span class="invalid-feedback invalid-select" role="alert">
                                <strong>{{ $errors->first('staff_id') }}</strong>
                            </span> @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- End Individual Tab -->

                                    <!-- Start Class Section Tab -->
                                    <div role="tabpanel" class="tab-pane fade" id="class_section_email_sms">
                                        <div class="white-box">
                                            <div class="row mb-35">

                                                <div class="col-lg-12">
                                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="class_id" id="class_id_email_sms">
                                                        <option data-display="@lang('lang.class')  *" value="">@lang('lang.class') *</option>
                                                    @if(isset($classes))
                                                    @foreach($classes as $value) 
                                                        <option value="{{$value->id}}">{{$value->class_name}}</option>

                                                    @endforeach
                                                    @endif
                                                    </select>
                                                    @if ($errors->has('leave_type'))
                                                    <span class="invalid-feedback invalid-select" role="alert">
                                <strong>{{ $errors->first('leave_type') }}</strong>
                            </span> @endif
                                                </div>

                                                <div class="col-lg-12 mt-30" id="selectSectionsDiv">
                                                <label for="checkbox" class="mb-2">@lang('lang.section')</label>
                                                    <select multiple id="selectSectionss" name="message_to_section[]" style="width:300px">
                                                      
                                                    </select>
                                                    <div class="">
                                                    <input type="checkbox" id="checkbox_section" class="common-checkbox">
                                                    <label for="checkbox_section" class="mt-3">@lang('lang.select_all')</label>
                                                    </div>
                                                    @if ($errors->has('staff_id'))
                                                    <span class="invalid-feedback invalid-select" role="alert">
                                <strong>{{ $errors->first('staff_id') }}</strong>
                            </span> @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-warning mt-30">
                    @lang('lang.For_Sending_Email')
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                 @if(in_array(292, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                <div class="white-box mt-30">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <button class="primary-btn fix-gr-bg">
                                <span class="ti-check"></span> @lang('lang.send')
                            </button>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
    {{ Form::close() }}
    </div>
</section>
@endsection
