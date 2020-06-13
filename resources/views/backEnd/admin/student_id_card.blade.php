@extends('backEnd.master')
@section('mainContent')
@php
$setting = App\SmGeneralSettings::find(1);
    function showPicName($data){
        $name = explode('/', $data);
        return $name[3];
    }
@endphp
<section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.student_id_card')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.admin_section')</a>
                <a href="#">@lang('lang.student_id_card')</a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($id_card))
        @if(in_array(46, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('student-id-card')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.add')
                </a>
            </div>
        </div>
        @endif
        @endif
        <div class="row">
             
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">@if(isset($id_card))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.student_id_card')
                            </h3>
                        </div>
                        @if(isset($id_card))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'student-id-card/'.$id_card->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                        @else
                         @if(in_array(46, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'student-id-card',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        @endif
                        @endif
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row mt-25">
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
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                type="text" name="title" autocomplete="off" value="{{isset($id_card)? $id_card->title: old('title')}}">
                                            <label>@lang('lang.id_card_title') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('logo') ? ' is-invalid' : '' }}" type="text" id="placeholderFileThreeName" placeholder="{{isset($id_card)? ($id_card->logo != ""? showPicName($id_card->logo):'Logo *'): 'Logo *'}}"
                                                readonly>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('logo'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('logo') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="document_file_3">@</label>
                                            <input type="file" class="d-none" name="logo" id="document_file_3" value="{{isset($id_card)? ($id_card->file != ""? showPicName($id_card->logo):''): ''}}">
                                        </button>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}"
                                                type="text" name="designation" autocomplete="off" value="{{isset($id_card)? $id_card->designation: old('designation')}}">
                                            <input type="hidden" name="id" value="{{isset($id_card)? $id_card->id: ''}}">
                                            <label>@lang('lang.Designation_of_Signature_person')<span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('designation'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('designation') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('signature') ? ' is-invalid' : '' }}" type="text" id="placeholderFileFourName" placeholder="{{isset($id_card)? ($id_card->signature != ""? showPicName($id_card->signature):'Signiture *'): 'Signiture *'}}"
                                                readonly>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('signature'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('signature') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="document_file_4">@lang('lang.browse')</label>
                                            <input type="file" class="d-none" name="signature" id="document_file_4">
                                        </button>
                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" cols="0" rows="4" name="address">{{isset($id_card)? $id_card->address: old('address')}}</textarea>
                                            <label>@lang('lang.address')/@lang('lang.phone')/@lang('lang.email') <span>*</span></label>
                                            <span class="focus-border textarea"></span>
                                        </div>
                                        @if($errors->has('address'))
                                            <span class="error text-danger"><strong class="validate-textarea">{{ $errors->first('address') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10"> @lang('lang.admission') @lang('lang.number') </p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="admission_no" id="admission_no_yes" value="1" class="common-radio relationButton" {{isset($id_card)? ($id_card->admission_no == 1? 'checked': ''):'checked'}}>
                                                <label for="admission_no_yes">@lang('lang.yes')</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="admission_no" id="admission_no_no" value="0" class="common-radio relationButton" {{isset($id_card)? ($id_card->admission_no == 0? 'checked': ''):''}}>
                                                <label for="admission_no_no">@lang('lang.none')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10">@lang('lang.student') @lang('lang.name') </p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="student_name" id="student_name_yes" value="1" class="common-radio relationButton" {{isset($id_card)? ($id_card->student_name == 1? 'checked': ''):'checked'}}>
                                                <label for="student_name_yes">@lang('lang.yes')</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="student_name" id="student_name_no" value="0" class="common-radio relationButton" {{isset($id_card)? ($id_card->student_name == 0? 'checked': ''):''}}>
                                                <label for="student_name_no">@lang('lang.none')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10">@lang('lang.class') </p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="class" id="class_yes" value="1" class="common-radio relationButton" {{isset($id_card)? ($id_card->class == 1? 'checked': ''):'checked'}}>
                                                <label for="class_yes">@lang('lang.yes')</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="student_photo" id="class_no" value="0" class="common-radio relationButton" {{isset($id_card)? ($id_card->class == 0? 'checked': ''):''}}>
                                                <label for="class_no">@lang('lang.none')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10">@lang('lang.father') @lang('lang.name')</p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="father_name" id="father_name_yes" value="1" class="common-radio relationButton" {{isset($id_card)? ($id_card->father_name == 1? 'checked': ''):'checked'}}>
                                                <label for="father_name_yes">@lang('lang.yes')</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="father_name" id="father_name_no" value="0" class="common-radio relationButton" {{isset($id_card)? ($id_card->father_name == 0? 'checked': ''):''}}>
                                                <label for="father_name_no">@lang('lang.none')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10">@lang('lang.mother') @lang('lang.name')</p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="mother_name" id="mother_name_yes" value="1" class="common-radio relationButton" {{isset($id_card)? ($id_card->mother_name == 1? 'checked': ''):'checked'}}>
                                                <label for="mother_name_yes">@lang('lang.yes')</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="mother_name" id="mother_name_no" value="0" class="common-radio relationButton" {{isset($id_card)? ($id_card->mother_name == 0? 'checked': ''):''}}>
                                                <label for="mother_name_no">@lang('lang.none')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10">@lang('lang.student') @lang('lang.address')</p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="student_address" id="address_yes" value="1" class="common-radio relationButton" {{isset($id_card)? ($id_card->student_address == 1? 'checked': ''):'checked'}}>
                                                <label for="address_yes">@lang('lang.yes')</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="student_address" id="address_no" value="0" class="common-radio relationButton" {{isset($id_card)? ($id_card->student_address == 0? 'checked': ''):''}}>
                                                <label for="address_no">@lang('lang.none')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10">@lang('lang.phone')</p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="mobile" id="phone_yes" value="1" class="common-radio relationButton" {{isset($id_card)? ($id_card->phone == 1? 'checked': ''):'checked'}}>
                                                <label for="phone_yes">@lang('lang.yes')</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="mobile" id="phone_no" value="0" class="common-radio relationButton" {{isset($id_card)? ($id_card->phone == 0? 'checked': ''):''}}>
                                                <label for="phone_no">@lang('lang.none')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10">@lang('lang.date_of_birth')</p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="dob" id="dob_yes" value="1" class="common-radio relationButton" {{isset($id_card)? ($id_card->dob == 1? 'checked': ''):'checked'}}>
                                                <label for="dob_yes">@lang('lang.yes')</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="dob" id="dob_no" value="0" class="common-radio relationButton" {{isset($id_card)? ($id_card->dob == 0? 'checked': ''):''}}>
                                                <label for="dob_no">@lang('lang.none')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10">@lang('lang.blood_group')</p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="blood" id="blood_yes" value="1" class="common-radio relationButton" {{isset($id_card)? ($id_card->blood == 1? 'checked': ''):'checked'}}>
                                                <label for="blood_yes">@lang('lang.yes')</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="blood" id="blood_no" value="0" class="common-radio relationButton" {{isset($id_card)? ($id_card->blood == 0? 'checked': ''):''}}>
                                                <label for="blood_no">@lang('lang.none')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
  @php 
                                  $tooltip = "";
                                  if(in_array(46, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                                
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            @if(isset($id_card))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                            @lang('lang.id_card')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"> @lang('lang.id_card') @lang('lang.list') </h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                                @if(session()->has('message-success-delete') != "" ||
                                session()->get('message-danger-delete') != "")
                                <tr>
                                    <td colspan="6">
                                        @if(session()->has('message-success-delete'))
                                        <div class="alert alert-success">
                                            {{ session()->get('message-success-delete') }}
                                        </div>
                                        @elseif(session()->has('message-danger-delete'))
                                        <div class="alert alert-danger">
                                            {{ session()->get('message-danger-delete') }}
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <th>@lang('lang.title')</th>
                                    <th>@lang('lang.actions')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($id_cards as $id_card)
                                <tr>
                                    <td><a data-toggle="modal" data-target="#showCertificateModal{{$id_card->id}}"  href="#">{{$id_card->title}}</a></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" data-toggle="modal" data-target="#showCertificateModal{{$id_card->id}}"  href="#">Sample @lang('lang.view')</a>
                                                 @if(in_array(47, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)
                                                <a class="dropdown-item" href="{{url('student-id-card/'.$id_card->id.'/edit')}}">@lang('lang.edit')</a>
                                                @endif
                                                 @if(in_array(48, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteIDCardModal{{$id_card->id}}"  href="#">@lang('lang.delete')</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteIDCardModal{{$id_card->id}}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.id_card')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                    {{ Form::open(['url' => 'student-id-card/'.$id_card->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}

                                                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                                                    {{ Form::close() }}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade admin-query student-details" id="showCertificateModal{{$id_card->id}}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.view') @lang('lang.id_card')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            

                                            <div class="modal-body">
                                                <div class="white-box radius-t-y-0">
                                                    <div class="text-center mb-4">
                                                        <img class="img-180" src="{{asset('public/backEnd/img/student/student-meta-img.png')}}" alt="">
                                                    </div>

                                                    @if($id_card->student_name == 1)
                                                    <div class="single-meta">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="value text-left">
                                                                    @lang('lang.student') @lang('lang.name')
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="name">
                                                                    Bablu Mazumder
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if($id_card->admission_no == 1)
                                                    <div class="single-meta">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="value text-left">
                                                                    @lang('lang.admission') @lang('lang.no')
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="name text-left">
                                                                    9865412365
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if($id_card->class == 1)
                                                    <div class="single-meta">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="value text-left">
                                                                    @lang('lang.class')
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="name">
                                                                    Class 01(Sec A)
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif 

                                                    @if($id_card->father_name == 1)
                                                    <div class="single-meta">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="value text-left">
                                                                    @lang('lang.father_name')
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="name">
                                                                   Dr. Abdul Bari Dos
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if($id_card->mother_name == 1)
                                                    <div class="single-meta">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="value text-left">
                                                                    @lang('lang.mother_name')
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="name">
                                                                   Fatima Anta Dos
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if($id_card->blood == 1)
                                                    <div class="single-meta">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="value text-left">
                                                                    @lang('lang.blood_group')
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="name">
                                                                    B+
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if($id_card->phone == 1)
                                                    <div class="single-meta">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="value text-left">
                                                                    @lang('lang.phone')
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="name">
                                                                    +88019811843300
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if($id_card->dob == 1)
                                                    <div class="single-meta">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="value text-left">
                                                                    @lang('lang.date_of_birth')
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="name">
                                                                    12th Mar, 2019
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif


                                                    <div class="single-meta">
                                                        <div class="row align-items-center">
                                                            <div class="col-lg-6">
                                                                <div class="value text-left">
                                                                    {{$id_card->designation}}
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-5">
                                                                <img class="img-fluid" src="{{asset($id_card->signature)}}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="bottom-part text-center mt-5">
                                                        <img class="img-fluid w-25" src="{{asset($id_card->logo)}}">
                                                        <p class="mb-0 mt-3">{{$id_card->address}} </p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
