@extends('backEnd.master')
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.language_settings')</h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.system_settings')</a>
                    <a href="#">@lang('lang.language_settings')</a>

                </div>
            </div>
        </div>
    </section>

    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            @if(isset($edit_languages))
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="{{url('marks-grade')}}" class="primary-btn small fix-gr-bg">
                            <span class="ti-plus pr-2"></span>
                            @lang('lang.add')
                        </a>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">@if(isset($edit_languages))
                                        @lang('lang.edit')
                                    @else
                                        @lang('lang.add')
                                    @endif
                                    @lang('lang.language')
                                </h3>
                            </div>
                            @if(isset($selected_languages))
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'language-update', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            @else
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'language-add',
                                'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            @endif
                            <div class="white-box">
                                <div class="add-visitor">
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

                                        </div>
                                    </div>

                                    @if(isset($selected_languages))
                                        <input type="hidden" name="id" value="{{$selected_languages->id}}">

                                    @endif

                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <select
                                                    class="niceSelect w-100 bb form-control {{ $errors->has('lang_id') ? ' is-invalid' : '' }}"
                                                    name="lang_id" id="lang_id">
                                                    <option data-display="@lang('lang.select_language')"
                                                            value="">@lang('lang.select_language')</option>
                                                    @foreach($all_languages as $lang)
                                                        <option value="{{$lang->id}}"
                                                            {{isset($selected_languages) ? ($selected_languages->lang_id == $lang->id )? 'selected':'':'' }}
                                                        > {{$lang->name}} - {{$lang->native}} </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('lang_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('lang_id') }}</strong>
                                                </span>
                                                @endif
                                            </div>


                                        </div>
                                    </div>


                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg">
                                                <span class="ti-check"></span>
                                                @if(isset($selected_languages))
                                                    @lang('lang.update')
                                                @else
                                                    @lang('lang.save')
                                                @endif
                                                @lang('lang.language')
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
                                <h3 class="mb-30">@lang('lang.language') @lang('lang.list')</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <?php

                            ?>


                            <table class="display school-table school-table-style" cellspacing="0" width="100%">


                                <thead>
                                @if(session()->has('message-success-delete') != "" ||session()->has('langChange')!= "" ||
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
                                            @if(session()->has('langChange'))
                                                <div class="alert alert-success">
                                                    {{ session()->get('langChange') }}
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>@lang('lang.sl')</th>
                                    <th>@lang('lang.language')</th>
                                    <th>@lang('lang.native')</th>
                                    <th>@lang('lang.universal')</th>

                                    <th>@lang('lang.Status')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                                </thead>

                                <tbody>
                                @php
                                    $i=0;
                                    $active     = 'primary-btn-small-input primary-btn small fix-gr-bg';
                                    $inactive   =  'primary-btn small tr-bg';
                                @endphp

                                @foreach($sms_languages as $sms_language)
                                    <tr>
                                        <td>{{++$i}}
                                        <td>{{$sms_language->language_name}}</td>
                                        <td>{{$sms_language->native}}</td>
                                        <td>{{$sms_language->language_universal}}</td>


                                        <td>
                                        @if($sms_language->active_status==1)
                                            <!-- <span class="badge badge-pill badge-success"></span> -->
                                                <b>Active</b>

                                        @else
                                            <!-- <span class="badge badge-pill badge-secondary"></span> -->
                                                In Active
                                            @endif

                                        </td>
                                        <td>

                                            @if($sms_language->active_status==1)
                                                <a href="{{URL::to('/change-language/'.$sms_language->id)}}"
                                                   class="{{$sms_language->active_status==1?$active:$inactive}} "   > <span
                                                        class="ti-check"></span> @lang('lang.default')</a>
                                            @else
                                               <a href="{{URL::to('/change-language/'.$sms_language->id)}}"
                                                   class="{{$sms_language->active_status==1?$active:$inactive}} "   > <span
                                                        class="ti-check"></span> @lang('lang.make_default')</a>
                                            @endif

                                            {{-- <a href="{{URL::to('/locale/'.$sms_language->language_universal)}}" class="primary-btn small tr-bg "  > <span class="ti-check"></span> @lang('lang.make_default')</a>--}}

                                            <a href="{{url('/')}}/language-setup/{{$sms_language->language_universal}} "
                                               class="primary-btn small tr-bg  "   > <span
                                                    class="ti-settings"></span> @lang('lang.setup') </a>

                                            @if($sms_language->language_universal !='en')
                                            {{-- data-toggle="modal"
                                                   data-target="#deleteLanguage{{$sms_language->id}}" --}}
                                              <a 
                                                   href="{{url('/')}}/language-delete" class="primary-btn small tr-bg " data-toggle="modal"
                                                   data-target="#deleteLanguage{{$sms_language->id}}" >
                                                    <span class="ti-close"></span> @lang('lang.remove') 
                                              </a>
                                            @else
                                            <!--      <a class="primary-btn small tr-bg" disabled="true"> <span class="ti-na"></span>  Delete  </a>
                                        <a class="primary-btn small tr-bg" disabled="true"> <span class="ti-na"></span>  Edit  </a> -->
                                            @endif


                                            <div class="modal fade admin-query"
                                                 id="deleteLanguage{{$sms_language->id}}">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">@lang('lang.delete') @lang('lang.language')</h4>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                &times;
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="text-center">
                                                                <h4>@lang('lang.are_you_sure_to_remove')</h4>
                                                            </div>

                                                            <div class="mt-40 d-flex justify-content-between">
                                                                <button type="button" class="primary-btn tr-bg"
                                                                        data-dismiss="modal">@lang('lang.cancel')</button>
                                                                {{ Form::open(['url' => 'language-delete/', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                                                                <input type="hidden" name="id"
                                                                       value="{{$sms_language->id}}">
                                                                <button class="primary-btn fix-gr-bg"
                                                                        type="submit">@lang('lang.remove')</button>
                                                                {{ Form::close() }}
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                        </td>
                                    </tr>
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
