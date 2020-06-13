@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.edit') @lang('lang.notice')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.communicate')</a>
                <a href="#">@lang('lang.edit') @lang('lang.notice')</a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.edit') @lang('lang.notice') </h3>
                </div>
            </div>
            <div class="offset-lg-6 col-lg-2 text-right col-md-6">
                <a href="{{url('notice-list')}}" class="primary-btn small fix-gr-bg">
                    @lang('lang.notice_board')
                </a>
            </div>
        </div>
        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'update-notice-data', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
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
                    <input type="hidden" name="notice_id"  value="{{$noticeDataDetails->id}}">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="input-effect mb-30">
                                <input class="primary-input form-control{{ $errors->has('notice_title') ? ' is-invalid' : '' }}"
                                type="text" name="notice_title" autocomplete="off" value="{{isset($noticeDataDetails)? $noticeDataDetails->notice_title : ''}}">
                                <label>@lang('lang.title')<span>*</span> </label>
                                <span class="focus-border"></span>
                                @if ($errors->has('notice_title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('notice_title') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="input-effect mt-40">
                                <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
                                <textarea class="primary-input form-control" cols="0" rows="4" name="notice_message" id="notice_message">{!! (isset($noticeDataDetails)) ? $noticeDataDetails->notice_message : '' !!}
                                </textarea>


                                <script>
                                        CKEDITOR.replace( 'notice_message' );
                                </script>

                                <label  class="textarea-label">@lang('lang.notice') <span></span> </label>
                                <span class="focus-border textarea"></span>

                            </div>
                        </div>
                        <div class="col-lg-5">
                         <div class="no-gutters input-right-icon mb-30">
                            <div class="col">
                                <div class="input-effect">
                                    <input class="primary-input date form-control{{ $errors->has('notice_date') ? ' is-invalid' : '' }}" id="notice_date" type="text" name="notice_date" value="{{(isset($noticeDataDetails)) ? date('d/m/y', strtotime($noticeDataDetails->notice_date)) : ' ' }}">
                                    <label>@lang('lang.notice_date')<span>*</span> </label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('notice_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('notice_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="" type="button">
                                    <i class="ti-calendar" id="submission_date_icon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="no-gutters input-right-icon">
                            <div class="col">
                                <div class="input-effect">
                                    <input class="primary-input date form-control{{ $errors->has('publish_on') ? ' is-invalid' : '' }}" id="publish_on" type="text"
                                    name="publish_on" value="{{(isset($noticeDataDetails)) ? date('d/m/y', strtotime($noticeDataDetails->publish_on)) : ' ' }}">
                                    <label>@lang('lang.publish_on') <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('publish_on'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('publish_on') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="" type="button">
                                    <i class="ti-calendar" id="submission_date_icon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-lg-12 mt-50">
                            <label>@lang('lang.message') @lang('lang.to') </label><br>
                        @if(isset($noticeDataDetails))
                             @php 
                             $inform_to = explode(',' ,$noticeDataDetails->inform_to);
                             @endphp
                        @endif                            
                               @foreach($roles as $role)
                               <div class="">

                                 <input type="checkbox" id="role{{$role->id}}" class="common-checkbox" name="role[]" value="{{$role->id}}" 
                                    
                                    @foreach($inform_to as $value)
                                    @if($role->id == $value)
                                    checked
                                    @endif
                                    @endforeach
                                    >
                                    <label for="role{{$role->id}}"> {{$role->name}}</label>
                                    
                                </div>
                                @endforeach
                                        @if($errors->has('role'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-40">
                            <div class="col-lg-12 text-center">
                                <button class="primary-btn fix-gr-bg">
                                    <span class="ti-check"></span>
                                    @lang('lang.update_content')
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
@endsection
