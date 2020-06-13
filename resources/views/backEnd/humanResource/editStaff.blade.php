@extends('backEnd.master')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('public/backEnd/')}}/css/croppie.css">
@endsection
@section('mainContent')
@php
function showPicName($data){
$name = explode('/', $data);
return $name[3];
}
@endphp
<style type="text/css">
    .form-control:disabled{
        background-color: #FFFFFF;
    }
</style>
<input type="text" hidden id="urlStaff" value="{{ route('staffProfileUpdate',$editData->id) }}">
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.edit_staff')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{route('staff_directory')}}">@lang('lang.staff_list')</a>
                <a href="{{route('editStaff', $editData->id)}}">@lang('lang.edit_staff')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.edit_staff')</h3>
                </div>
            </div>
        </div>
        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'staffUpdate', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h4>@lang('lang.basic_info')</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <hr>
                        </div>
                    </div>

                    <input type="hidden" name="staff_id" value="{{@$editData->id}}" id="_id"> 
                    <div class="row mb-30 mt-20">
                        <div class="col-lg-3">
                            <div class="input-effect">
                                <input class="primary-input form-control{{ $errors->has('staff_no') ? ' is-invalid' : '' }}" type="text"  name="staff_no" readonly value="@if(isset($editData)){{$editData->staff_no}} @endif">
                                <span class="focus-border"></span>
                                <label>@lang('lang.staff_number')</label>
                                @if ($errors->has('staff_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('staff_no') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="input-effect">
                                <select class="niceSelect w-100 bb form-control{{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="role_id" id="role_id">
                                    <option data-display="@lang('lang.role') *" value="">@lang('lang.select')</option>
                                    @foreach($roles as $key=>$value)
                                    <option value="{{$value->id}}" 
                                        @if(isset($editData))
                                        @if($editData->role_id == $value->id)
                                        selected
                                        @endif
                                        @endif
                                        >{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('role_id'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('role_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('department_id') ? ' is-invalid' : '' }}" name="department_id" id="department_id">
                                        <option data-display="@lang('lang.department') *" value="">@lang('lang.select') </option>
                                        @foreach($departments as $key=>$value)
                                        <option value="{{$value->id}}"
                                            @if(isset($editData))
                                            @if($editData->department_id == $value->id)
                                            selected
                                            @endif
                                            @endif
                                            >{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('department_id'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('department_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('designation_id') ? ' is-invalid' : '' }}" name="designation_id" id="designation_id">
                                            <option data-display="@lang('lang.designation') *" value="">@lang('lang.select') </option>
                                            @foreach($designations as $key=>$value)
                                            <option value="{{$value->id}}"
                                                @if(isset($editData))
                                                @if($editData->designation_id == $value->id)
                                                selected
                                                @endif
                                                @endif
                                                >{{$value->title}}</option>
                                                @endforeach
                                            </select>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('designation_id'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('designation_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-30">
                                    <div class="col-lg-3">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" type="text" name="first_name" value="@if(isset($editData)){{$editData->first_name}} @endif">
                                            <span class="focus-border"></span>
                                            <label>@lang('lang.first') @lang('lang.name')</label>
                                            @if ($errors->has('first_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" type="text" name="last_name" value="@if(isset($editData)){{$editData->last_name}} @endif">
                                            <span class="focus-border"></span>
                                            <label>@lang('lang.last') @lang('lang.name')</label>
                                            @if ($errors->has('last_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('fathers_name') ? ' is-invalid' : '' }}" type="text"  name="fathers_name" value="@if(isset($editData)){{$editData->fathers_name}} @endif">
                                            <span class="focus-border"></span>
                                            <label>@lang('lang.father_name')</label>
                                            @if ($errors->has('fathers_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('fathers_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('mothers_name') ? ' is-invalid' : '' }}" type="text" name="mothers_name" value="@if(isset($editData)){{$editData->mothers_name}} @endif">
                                            <span class="focus-border"></span>
                                            <label>@lang('lang.mother_name')</label>
                                            @if ($errors->has('mothers_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('mothers_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-30">
                                 <div class="col-lg-3">
                                    <div class="input-effect">
                                        <input class="primary-input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" value="@if(isset($editData)){{$editData->email}} @endif">
                                        <span class="focus-border"></span>
                                        <label>@lang('lang.email')</label>
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('gender_id') ? ' is-invalid' : '' }}" name="gender_id">
                                            <option data-display="@lang('lang.gender') *" value="">@lang('lang.gender') *</option>
                                            @foreach($genders as $gender)
                                            <option value="{{$gender->id}}"
                                                @if(isset($editData))
                                                @if($editData->gender_id == $gender->id)
                                                selected
                                                @endif
                                                @endif
                                                >{{$gender->base_setup_name}}</option>
                                                @endforeach

                                            </select>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('gender_id'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('gender_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input date form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" id="startDate" type="text"
                                                    name="date_of_birth" value="{{date('m/d/Y', strtotime($editData->date_of_birth))}}">
                                                    <span class="focus-border"></span>
                                                    <label>@lang('lang.date_of_birth')</label>
                                                    @if ($errors->has('date_of_birth'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
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
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input date form-control{{ $errors->has('date_of_joining') ? ' is-invalid' : '' }}" id="date_of_joining" type="text"
                                                    name="date_of_joining" value="{{date('m/d/Y', strtotime($editData->date_of_joining))}} ">
                                                    <span class="focus-border"></span>
                                                    <label>@lang('lang.date_of_joining')</label>
                                                    @if ($errors->has('date_of_joining'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('date_of_joining') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="date_of_joining"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-30">
                                   <div class="col-lg-3">
                                    <div class="input-effect">
                                        <input class="primary-input form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" type="text" name="mobile" value="@if(isset($editData)){{$editData->mobile}} @endif">
                                        <span class="focus-border"></span>
                                        <label>@lang('lang.mobile')</label>
                                        @if ($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <select class="niceSelect w-100 bb form-control" name="marital_status">
                                            <option data-display="Marital Status" value="">Marital Status</option>
                                            
                                            <option value="married" {{$editData->marital_status == "married"? 'selected':''}}>Married</option>
                                            <option value="unmarried" {{$editData->marital_status == "unmarried"? 'selected':''}}>Unmarried</option>
                                            
                                        </select>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <input class="primary-input form-control{{ $errors->has('emergency_mobile') ? ' is-invalid' : '' }}" type="text"  name="emergency_mobile" value="@if(isset($editData)){{$editData->emergency_mobile}} @endif">
                                        <span class="focus-border"></span>
                                        <label>@lang('lang.emergency_mobile')</label>
                                        @if ($errors->has('emergency_mobile'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('emergency_mobile') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <input class="primary-input form-control{{ $errors->has('driving_license') ? ' is-invalid' : '' }}" type="text"  name="driving_license" value="{{$editData->driving_license}}">
                                        <span class="focus-border"></span>
                                        <label>Driving License </label>
                                        @if ($errors->has('driving_license'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('driving_license') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                
                        </div>
                        <div class="row mb-20">
                            <div class="col-lg-6">
                                 <div class="row no-gutters input-right-icon mb-20">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control {{ $errors->has('staff_photo') ? ' is-invalid' : '' }}" id="placeholderStaffsName" type="text" placeholder="{{$editData->staff_photo != ""? showPicName($editData->staff_photo):'Staff Photo'}}"
                                            readonly >
                                            <span class="focus-border"></span>
                                            @if ($errors->has('staff_photo'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('staff_photo') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button" id="pic">
                                            <label class="primary-btn small fix-gr-bg" for="staff_photo">@lang('lang.browse')</label>
                                            <input type="file" class="d-none form-control" name="staff_photo" id="staff_photo">
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-30">
                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <textarea class="primary-input form-control" cols="0" rows="4" name="current_address" id="current_address">@if(isset($editData)){{$editData->current_address}} @endif</textarea>
                                    <span class="focus-border textarea "></span>
                                    <label>@lang('lang.current_address')</label>
                                    @if ($errors->has('current_address'))
                                    <span class="danger text-danger">
                                        <strong>{{ $errors->first('current_address') }}</strong>
                                    </span>
                                    @endif 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <textarea class="primary-input form-control" cols="0" rows="4"  name="permanent_address" id="permanent_address">@if(isset($editData)){{$editData->permanent_address}} @endif</textarea>
                                    <span class="focus-border textarea"></span>
                                    <label>@lang('lang.permanent_address')</label>
                                    @if ($errors->has('permanent_address'))
                                    <span class="danger text-danger">
                                        <strong>{{ $errors->first('permanent_address') }}</strong>
                                    </span>
                                    @endif 
                                </div>
                            </div>
                        </div>
                        <div class="row mb-30">
                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <textarea class="primary-input form-control" cols="0" rows="4"  name="qualification" id="qualification">@if(isset($editData)){{$editData->qualification}} @endif</textarea>
                                    <span class="focus-border textarea"></span>
                                    <label>@lang('lang.qualifications')</label>
                                    @if ($errors->has('qualification'))
                                    <span class="danger text-danger">
                                        <strong>{{ $errors->first('qualification') }}</strong>
                                    </span>
                                    @endif 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <textarea class="primary-input form-control" cols="0" rows="4"  name="experience" id="experience">@if(isset($editData)){{$editData->experience}} @endif
                                    </textarea>
                                    <span class="focus-border textarea"></span>
                                    <label>@lang('lang.experience')</label>
                                    @if ($errors->has('experience'))
                                    <span class="danger text-danger">
                                        <strong>{{ $errors->first('experience') }}</strong>
                                    </span>
                                    @endif 
                                </div>
                            </div>
                        </div>


                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4>@lang('lang.payroll_details')</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-20">
                            <div class="col-lg-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row mb-30 mt-20">
                            <div class="col-lg-3">
                             <div class="input-effect">
                                <input class="primary-input form-control{{ $errors->has('epf_no') ? ' is-invalid' : '' }}" type="text"  name="epf_no" value="{{$editData->epf_no}}">
                                <span class="focus-border"></span>
                                <label>@lang('lang.epf_no')</label>
                                @if ($errors->has('epf_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('epf_no') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-3">
                         <div class="input-effect">
                             <input class="primary-input form-control{{ $errors->has('basic_salary') ? ' is-invalid' : '' }}" type="text"  name="basic_salary" value="{{$editData->basic_salary}}">
                             <span class="focus-border"></span>
                             <label>@lang('lang.basic_salary')</label>
                             @if ($errors->has('basic_salary'))
                             <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('basic_salary') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="input-effect">
                            <select class="niceSelect w-100 bb form-control" name="contract_type">
                                <option data-display="@lang('lang.select')" value=""> @lang('lang.select')</option>
                                <option value="permanent"
                                @if(isset($editData))
                                @if($editData->contract_type == 'permanent')
                                selected
                                @endif
                                @endif
                                >Permanent </option>
                                <option value="contract"
                                @if(isset($editData))
                                @if($editData->contract_type == 'contract')
                                selected
                                @endif
                                @endif
                                > Contract</option>
                            </select>
                            <span class="focus-border"></span>

                        </div>
                    </div>

                    <div class="col-lg-3">
                     <div class="input-effect">
                        <input class="primary-input form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" type="text"  name="location" value="{{$editData->location}}">
                        <span class="focus-border"></span>
                        <label>@lang('lang.location')</label>
                        @if ($errors->has('location'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('location') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mt-40 mt-20">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h4>@lang('lang.location')</h4>
                    </div>
                </div>
            </div>
            <div class="row mb-30">
                <div class="col-lg-12">
                    <hr>
                </div>
            </div>
            <div class="row mb-20">
                <div class="col-lg-3">
                 <div class="input-effect">
                    <input class="primary-input form-control{{ $errors->has('bank_account_name') ? ' is-invalid' : '' }}" type="text"  name="bank_account_name" value="{{$editData->bank_account_name}}">
                    <span class="focus-border"></span>
                    <label>@lang('lang.bank_account_name')</label>
                </div>
            </div>

            <div class="col-lg-3">
             <div class="input-effect">
                <input class="primary-input form-control{{ $errors->has('bank_account_no') ? ' is-invalid' : '' }}" type="text"  name="bank_account_no" value="{{$editData->bank_account_no}}">
                <span class="focus-border"></span>
                <label>@lang('lang.account') @lang('lang.no')</label>
            </div>
        </div>

        <div class="col-lg-3">
         <div class="input-effect">
            <input class="primary-input form-control{{ $errors->has('bank_name') ? ' is-invalid' : '' }}" type="text"  name="bank_name" value="{{$editData->bank_name}}">
            <span class="focus-border"></span>
            <label>@lang('lang.bank_name')</label>
        </div>
    </div>

    <div class="col-lg-3">
     <div class="input-effect">
        <input class="primary-input form-control{{ $errors->has('bank_brach') ? ' is-invalid' : '' }}" type="text" name="bank_brach" value="{{$editData->bank_brach}}">
        <span class="focus-border"></span>
        <label>@lang('lang.branch_name')</label>
    </div>
</div>

</div>

<div class="row mt-40 mt-20">
    <div class="col-lg-12">
        <div class="main-title">
            <h4>@lang('lang.social_links_details')</h4>
        </div>
    </div>
</div>
<div class="row mb-30">
    <div class="col-lg-12">
        <hr>
    </div>
</div>
<div class="row mb-20">
    <div class="col-lg-3">
     <div class="input-effect">
        <input class="primary-input form-control{{ $errors->has('facebook_url') ? ' is-invalid' : '' }}" type="text"  name="facebook_url" value="{{$editData->facebook_url}}">
        <span class="focus-border"></span>
        <label>@lang('lang.facebook_url')</label>
    </div>
</div>

<div class="col-lg-3">
 <div class="input-effect">
    <input class="primary-input form-control{{ $errors->has('twiteer_url') ? ' is-invalid' : '' }}" type="text" name="twiteer_url" value="{{$editData->twiteer_url}}">
    <span class="focus-border"></span>
    <label>@lang('lang.twitter_url')</label>
</div>
</div>

<div class="col-lg-3">
 <div class="input-effect">
    <input class="primary-input form-control{{ $errors->has('linkedin_url') ? ' is-invalid' : '' }}" type="text"  name="linkedin_url" value="{{$editData->linkedin_url}}">
    <span class="focus-border"></span>
    <label>@lang('lang.linkedin_url')</label>
</div>
</div>

<div class="col-lg-3">
 <div class="input-effect">
    <input class="primary-input form-control{{ $errors->has('instragram_url') ? ' is-invalid' : '' }}" type="text"  name="instragram_url" value="{{$editData->instragram_url}}">
    <span class="focus-border"></span>
    <label>@lang('lang.instragram_url')</label>
</div>
</div>

</div>

<div class="row mt-40 mt-20">
    <div class="col-lg-12">
        <div class="main-title">
            <h4>@lang('lang.document_info')</h4>
        </div>
    </div>
</div>
<div class="row mb-30">
    <div class="col-lg-12">
        <hr>
    </div>
</div>
<div class="row mb-20">
    <div class="col-lg-4">
     <div class="row no-gutters input-right-icon mb-20">
        <div class="col">
            <div class="input-effect">
                <input class="primary-input form-control {{ $errors->has('resume') ? ' is-invalid' : '' }}" type="text" placeholder="{{isset($editData->resume) && $editData->resume != ""? showPicName($editData->resume):'Resume'}}"
                readonly  id="placeholderResume">
                <span class="focus-border"></span>
                @if ($errors->has('resume'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('resume') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-auto">
            <button class="primary-btn-small-input" type="button">
                <label class="primary-btn small fix-gr-bg" for="resume">@lang('lang.browse')</label>
                <input type="file" class="d-none form-control" name="resume" id="resume">
            </button>

        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="row no-gutters input-right-icon mb-20">
            <div class="col">
                <div class="input-effect">
                    <input class="primary-input form-control {{ $errors->has('joining_letter') ? ' is-invalid' : '' }}" type="text" placeholder="{{isset($editData->joining_letter) && $editData->joining_letter != ""? showPicName($editData->joining_letter):'Joining Letter'}}"
                    readonly  id="placeholderJoiningLetter">
                    <span class="focus-border"></span>
                    @if ($errors->has('joining_letter'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('joining_letter') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-auto">
                <button class="primary-btn-small-input" type="button">
                    <label class="primary-btn small fix-gr-bg" for="joining_letter">@lang('lang.browse')</label>
                    <input type="file" class="d-none form-control" name="joining_letter" id="joining_letter">
                </button>

            </div>
    </div>
</div>

<div class="col-lg-4">
    <div class="row no-gutters input-right-icon mb-20">
            <div class="col">
                <div class="input-effect">
                    <input class="primary-input form-control {{ $errors->has('other_document') ? ' is-invalid' : '' }}" type="text" placeholder="{{isset($editData->other_document) && $editData->other_document != ""? showPicName($editData->joining_letter):'Others Documents'}}"
                    readonly  id="placeholderOthersDocument">
                    <span class="focus-border"></span>
                    @if ($errors->has('other_document'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('other_document') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-auto">
                <button class="primary-btn-small-input" type="button">
                    <label class="primary-btn small fix-gr-bg" for="other_document">@lang('lang.browse')</label>
                    <input type="file" class="d-none form-control" name="other_document" id="other_document">
                </button>

            </div>
    </div>
</div>
</div>
<div class="row mt-40">
    <div class="col-lg-12 text-center">
        <button class="primary-btn fix-gr-bg">
            <span class="ti-check"></span>
            @lang('lang.update_staff')
        </button>
    </div>
</div>
</div>
</div>
</div>
</div>
{{ Form::close() }}
</div>
</section>


<div class="modal" id="LogoPic">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Crop Image And Upload</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="resize"></div>
                <button class="btn rotate float-lef" data-deg="90" > 
                <i class="ti-back-right"></i></button>
                <button class="btn rotate float-right" data-deg="-90" > 
                <i class="ti-back-left"></i></button>
                <hr>
                
                <button class="primary-btn fix-gr-bg pull-right" id="upload_logo">Crop</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('public/backEnd/')}}/js/croppie.js"></script>
<script src="{{asset('public/backEnd/')}}/js/editStaff.js"></script>
@endsection
