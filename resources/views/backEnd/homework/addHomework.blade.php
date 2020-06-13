@extends('backEnd.master')
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.add_homework')</h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.home_work')</a>
                    <a href="#">@lang('lang.add_homework')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
       
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="main-title">
                            <h3 class="mb-30">@lang('lang.add_homework')</h3>
                        </div>
                    </div>
                </div>
                @if(in_array(279, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'saveHomeworkData', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                @endif
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
                                <div class="row mb-30">
                                    <div class="col-lg-4">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('class_id') ? ' is-invalid' : '' }}"
                                                    name="class_id" id="classSelectStudent">
                                                <option data-display="Select Class *" value="">Select</option>
                                                @foreach($classes as $key=>$value)
                                                    <option value="{{$value->id}}" {{old('class_id') != ""? 'selected':''}}>{{$value->class_name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('class_id'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('class_id') }}</strong>
                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-effect" id="sectionStudentDiv">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('section_id') ? ' is-invalid' : '' }}"
                                                    name="section_id" id="sectionSelectStudent">
                                                <option data-display="@lang('lang.select_section') *"
                                                        value="">@lang('lang.section') *
                                                </option>
                                            </select>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('section_id'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong>{{ $errors->first('section_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-effect" id="subjectSelecttDiv">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('subject_id') ? ' is-invalid' : '' }}"
                                                    name="subject_id" id="subjectSelect">
                                                <option data-display="@lang('lang.select_subjects') *"
                                                        value="">@lang('lang.subject') *
                                                </option>
                                            </select>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('subject_id'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong>{{ $errors->first('subject_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-30">
                                    <div class="col-lg-3">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input date form-control{{ $errors->has('homework_date') ? ' is-invalid' : '' }}"
                                                           id="homework_date" type="text" name="homework_date"
                                                           value="{{old('homework_date') != ""? old('homework_date'): date('m/d/Y')}}"
                                                           readonly="true">
                                                    <label>@lang('lang.home_work') @lang('lang.date')
                                                        <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('homework_date'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('homework_date') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="homework_date_icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- @endif --}}
                                    <div class="col-lg-3">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input date form-control{{ $errors->has('submission_date') ? ' is-invalid' : '' }}"
                                                           id="submission_date" type="text" name="submission_date"
                                                           value="{{old('submission_date') != ""? old('submission_date') : date('m/d/Y')}}"
                                                           readonly="true">
                                                    <label>@lang('lang.submission') @lang('lang.date')
                                                        <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('submission_date'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('submission_date') }}</strong>
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
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="row no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input form-control{{ $errors->has('marks') ? ' is-invalid' : '' }}"
                                                           type="text" name="marks" value="{{old('marks')}}">
                                                    <label>@lang('lang.marks') <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('marks'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('marks') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="row no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input" type="text"
                                                           id="placeholderHomeworkName"
                                                           placeholder="@lang('lang.attach_file')"
                                                           disabled>
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                           for="homework_file">@lang('lang.browse')</label>
                                                    <input type="file" class="d-none" name="homework_file"
                                                           id="homework_file">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row md-20">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea
                                                    class="primary-input form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                    cols="0" rows="4" name="description"
                                                    id="description *">{{old('description')}}</textarea>
                                            <label>@lang('lang.description') <span>*</span> </label>
                                            <span class="focus-border textarea"></span>
                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                            </div>
                            	  @php 
                                  $tooltip = "";
                                  if(in_array(279, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                            <div class="row mt-40">
                                <div class="col-lg-12 text-center">
                                   <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                        <span class="ti-check"></span>
                                        @lang('lang.save') @lang('lang.home_work')
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
