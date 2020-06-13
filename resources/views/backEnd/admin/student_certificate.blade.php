@extends('backEnd.master')
@section('mainContent')
@php
    function showPicName($data){
        $name = explode('/', $data);
        return $name[3];
    }
@endphp
<section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.student_certificate')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.admin_section')</a>
                <a href="#">@lang('lang.student_certificate')</a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($certificate))
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('student-certificate')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.add')
                </a>
            </div>
        </div>
        @endif
        <div class="row">
           
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">@if(isset($certificate))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.certificate')
                            </h3>
                        </div>
                        @if(isset($certificate))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'student-certificate/'.$certificate->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                        @else
                          @if(in_array(50, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'student-certificate',
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
                                            <input class="primary-input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                type="text" name="name" autocomplete="off" value="{{isset($certificate)? $certificate->name: old('name')}}">
                                            <input type="hidden" name="id" value="{{isset($certificate)? $certificate->id: ''}}">
                                            <label>@lang('lang.certificate') @lang('lang.name') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('header_left_text') ? ' is-invalid' : '' }}"
                                                type="text" name="header_left_text" autocomplete="off" value="{{isset($certificate)? $certificate->header_left_text: old('header_left_text')}}">
                                            <label>@lang('lang.header_left_text')<span></span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('header_left_text'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('header_left_text') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" id="startDate" type="text" name="date" autocomplete="off" value="{{isset($certificate)? date('m/d/Y', strtotime($certificate->date)): date('m/d/Y')}}">
                                            <span class="focus-border"></span>
                                            <label>@lang('lang.date') <span></span></label>
                                            @if ($errors->has('date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('date') }}</strong>
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

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" cols="0" rows="4" name="body" maxlength="500">{{isset($certificate)? $certificate->body: old('body')}}</textarea>
                                            <label>@lang('lang.body') (@lang('lang.certificate_body_len')) <span></span></label>
                                            <span class="focus-border textarea"></span>

                                            @if($errors->has('body'))
                                                <span class="error text-danger"><strong>{{ $errors->first('body') }}</strong></span>
                                            @endif
                                        </div>
                                        <span class="text-primary">[name] [dob] [present_address] [guardian] [created_at] [admission_no] [roll_no] [class] [section] [gender] [admission_date] [category] [cast] [father_name] [mother_name] [religion] [email] [phone]</span>
                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('footer_left_text') ? ' is-invalid' : '' }}"
                                                type="text" name="footer_left_text" autocomplete="off" value="{{isset($certificate)? $certificate->footer_left_text: old('footer_left_text')}}">
                                            <label>@lang('lang.footer_left_text') <span></span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('footer_left_text'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('footer_left_text') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('footer_center_text') ? ' is-invalid' : '' }}"
                                                type="text" name="footer_center_text" autocomplete="off" value="{{isset($certificate)? $certificate->footer_center_text: old('footer_center_text')}}">
                                            <label>@lang('lang.footer_center_text')<span></span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('footer_center_text'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('footer_center_text') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('footer_right_text') ? ' is-invalid' : '' }}"
                                                type="text" name="footer_right_text" autocomplete="off" value="{{isset($certificate)? $certificate->footer_right_text: old('footer_right_text')}}">
                                            <label>@lang('lang.footer_right_text')<span></span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('footer_right_text'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('footer_right_text') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10">@lang('lang.student_photo')</p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="student_photo" id="relationFather" value="1" class="common-radio relationButton" {{isset($certificate)? ($certificate->student_photo == 1? 'checked': ''):'checked'}}>
                                                <label for="relationFather">@lang('lang.yes')</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="student_photo" id="relationMother" value="0" class="common-radio relationButton" {{isset($certificate)? ($certificate->student_photo == 0? 'checked': ''):''}}>
                                                <label for="relationMother">@lang('lang.none')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row no-gutters input-right-icon mt-35">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" id="placeholderInput" type="text" placeholder="{{isset($certificate)? ($certificate->file != ""? showPicName($certificate->file):'Background Image *'): 'Background Image(1100 X 850)px *'}}" readonly>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('file'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('file') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="browseFile">@lang('lang.browse')</label>
                                            <input type="file" class="d-none" id="browseFile" name="file" value="{{isset($certificate)? ($certificate->file != ""? showPicName($certificate->file):''): ''}}">
                                        </button>
                                    </div>
                                    
                                </div>
	  @php 
                                  $tooltip = "";
                                  if(in_array(50, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                                
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            @if(isset($certificate))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                            @lang('lang.certificate')
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
                            <h3 class="mb-0">  @lang('lang.certificate') @lang('lang.list')</h3>
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
                                    <th>@lang('lang.name')</th>
                                    <th>@lang('lang.background_image')</th>
                                    <th>@lang('lang.actions')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($certificates as $certificate)
                                <tr>
                                    <td><a class="text-color" data-toggle="modal" data-target="#showCertificateModal{{$certificate->id}}"  href="#">{{$certificate->name}}</a></td>
                                    <td><img src="{{url($certificate->file)}}" width="100"></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" data-toggle="modal" data-target="#showCertificateModal{{$certificate->id}}"  href="#">@lang('lang.view')</a>
                                                 @if(in_array(51, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)
                                                <a class="dropdown-item" href="{{url('student-certificate/'.$certificate->id.'/edit')}}">edit</a>
                                                @endif
                                                 @if(in_array(52, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteSectionModal{{$certificate->id}}"  href="#">@lang('lang.delete')</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteSectionModal{{$certificate->id}}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.certificate')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                    {{ Form::open(['url' => 'student-certificate/'.$certificate->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}

                                                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                                                    {{ Form::close() }}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade admin-query" id="showCertificateModal{{$certificate->id}}">
                                    <div class="modal-dialog modal-dialog-centered large-modal">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.view') @lang('lang.certificate')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body p-0">
                                                <div class="container student-certificate">
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-12 text-center">
                                                            <div class="mb-5">
								                                <img class="img-fluid" src="{{asset($certificate->file)}}">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-10 text-center certificate-position">
                                                            <div>
                                                                <div class="row justify-content-lg-between mb-5">
                                                                    <div class="col-md-5">
                                                                        <!-- <div class="input-effect text-left">
                                                                            <input class="primary-input form-control" type="text" name="name" value="">
                                                                            <label>Reff No.</label>
                                                                            <span class="focus-border"></span>
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>error</strong>
                                                                            </span>
                                                                        </div> -->

                                                                        <p class="m-0">{{$certificate->header_left_text}}:</p>

                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <!-- <div class="row no-gutters input-right-icon text-left">
                                                                            <div class="col">
                                                                                <div class="input-effect">
                                                                                    <input class="primary-input date form-control" id="endDate" type="text" name="date" value="">
                                                                                    <span class="focus-border"></span>
                                                                                    <label>Date <span></span></label>
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>Error</strong>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-auto">
                                                                                <button class="" type="button">
                                                                                    <i class="ti-calendar" id="end-date-icon"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div> -->
                                                                        <p class="m-0">@lang('lang.date'): {{$certificate->date}}</p>
                                                                    </div>
                                                                </div>

                                                                <div class="certificate-middle">
                                                                    <p>
                                                                        {{$certificate->body}}
                                                                    </p>
                                                                </div>

                                                                <div class="mt-80 mb-4">
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-center">
                                                                            <div class="signature bb-15">{{$certificate->footer_left_text}}</div>
                                                                        </div>
                                                                        <div class="col-md-4 text-center">
                                                                            <div class="signature bb-15">{{$certificate->footer_center_text}}</div>
                                                                        </div>
                                                                        <div class="col-md-4 text-center">
                                                                            <div class="signature bb-15">{{$certificate->footer_right_text}}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
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
