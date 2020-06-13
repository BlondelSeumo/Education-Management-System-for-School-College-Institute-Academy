@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.update_system')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.system_settings')</a>
                <a href="#">@lang('lang.update_system')</a>

            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="white-box">
            <div class="add-visitor">  
                <div class="row no-gutters input-right-icon">
                    <h3 class="text-center gradient-color2" style="margin: 0 auto; color: green; ">{{$data}}</h3>
                </div>
            </div>
        </div>
       {{--  <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">@lang('lang.upload_from_local_directory')</h3>
                        </div>
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'admin/update-system', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        <input type="hidden" value="{{$version_name}}" name="version_name">
                        
                        <div class="white-box">
                            <div class="add-visitor">  
                                <div class="row no-gutters input-right-icon mb-20">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control {{ $errors->has('file') ? ' is-invalid' : '' }}" readonly="true" type="text" 
                                              id="placeholderUploadContent" name="file"  placeholder="upload zip file">
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
                                            <label class="primary-btn small fix-gr-bg" for="upload_content_file">@lang('lang.browse')</label>
                                            <input type="file" class="d-none form-control" name="file" id="upload_content_file" placeholder="upload zip file">
                                        </button>
                                       
                                    </div>
                                </div>
                                
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg">
                                            <span class="ti-check"></span>
                                                Activated
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div> 
                </div>  
            </div> 
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-30">@lang('lang.Version') @lang('lang.list')</h3>
                        </div>
                    </div>
                    <div class="col-lg-8 text-success text-right">
                        @if($existing_version==$version_name) You are using latest version  @endif
                    </div>
                </div>
              

                    <table class="display school-table school-table-style" cellspacing="0" width="100%">


                        <thead>
                            @if(session()->has('message-success') != "" ||
                            session()->get('message-danger-delete') != "")
                            <tr>
                                <td colspan="3">
                                    @if(session()->has('message-success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message-success') }}
                                    </div> 
                                    @endif
                                </td>
                            </tr>
                            @endif
                            <tr>  
                                <th> @lang('lang.Available') @lang('lang.Version') </th>  
                                <th>@lang('lang.New_Features')</th>
                                <th>@lang('lang.Alert')</th>
                            </tr>
                        </thead>
 
                        <tfoot>
                            <tr>
                                <td>
                                   {{$title}}
                                    
                                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'upgrade-settings', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                                    <input type="hidden" name="version" value="123"> 
                

                                    {{ Form::close() }}

                                </td>
                                <td>
                                    {!! $features !!}
                                </td>
                                <td>
                                    <ul>
                                        <li>Take Backup of your source code</li>
                                        <li>Take Backup and download your Database </li> 
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                     
                                    @if($existing_version<$version_name)
                                    <div class=" col-lg-12 text-right col-md-12">
                                       <a href="https://infixedu.com/api/getSystemUpdate/{{$version_name}}" class="primary-btn small fix-gr-bg "> <span class="ti-arrow-circle-down pr-2"></span>  Get Update</a>
                                    </div> 
                                    @endif
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div> 
        </div> --}}
    </div> 
</section>

@endsection
