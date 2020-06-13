@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.question_bank')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.examinations')</a>
                <a href="#">@lang('lang.question_bank')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($bank))
        @if(in_array(235, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('question-bank')}}" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30">@if(isset($bank))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.question_bank')
                            </h3>
                        </div>
                       
                        @if(isset($bank))

                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'question-bank/'.$bank->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'id' => 'question_bank']) }}

                        @else
                         @if(in_array(235, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'question-bank',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'question_bank']) }}

                        @endif
                        @endif
                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
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
                                       
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('group') ? ' is-invalid' : '' }}" name="group">
                                            <option data-display="@lang('lang.select_group') *" value="">@lang('lang.select_group') *</option>
                                            @foreach($groups as $group)
                                                @if(isset($bank))
                                                <option value="{{$group->id}}" {{$group->id == $bank->q_group_id? 'selected': ''}}>{{$group->title}}</option>
                                                @else
                                                <option value="{{$group->id}}" {{old('group')!=''? (old('group') == $group->id? 'selected':''):''}} >{{$group->title}}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                        @if ($errors->has('group'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('group') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                            <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select_class') *</option>
                                            @foreach($classes as $class)
                                                @if(isset($bank))
                                                <option value="{{$class->id}}" {{$bank->class_id == $class->id? 'selected': ''}}>{{$class->class_name}}</option>
                                                @else
                                                <option value="{{$class->id}}" {{old('class')!=''? (old('class') == $class->id? 'selected':''):''}}>{{$class->class_name}}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                        @if ($errors->has('class'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('class') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 mt-30-md" id="select_section_div">
                                        <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_section" id="select_section" name="section">
                                            <option data-display="@lang('lang.select_section') *" value="">@lang('lang.select_section') *</option>

                                                @foreach($sections as $section)
                                                @if(isset($bank))
                                                    <option value="{{$section->id}}" {{$bank->section_id == $section->id? 'selected': ''}}>{{$section->section_name}}</option>  
                                                @endif
                                                @endforeach
                                        </select>
                                        @if ($errors->has('section'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('section') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('question_type') ? ' is-invalid' : '' }}" name="question_type"  id="question-type">
                                            <option data-display="@lang('lang.question_type') *" value="">@lang('lang.question_type') *</option>
                                           
                                            <option value="M" {{isset($bank)? $bank->type == "M"? 'selected': '' : ''}}>@lang('lang.multiple_choice')</option>
                                            <option value="T" {{isset($bank)? $bank->type == "T"? 'selected': '' : ''}}>@lang('lang.true_false')</option>
                                            <option value="F" {{isset($bank)? $bank->type == "F"? 'selected': '' : ''}}>@lang('lang.fill_in_the_blanks')</option>
                                        </select>
                                        @if ($errors->has('group'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('group') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control{{ $errors->has('question') ? ' is-invalid' : '' }}" cols="0" rows="4" name="question">{{isset($bank)? $bank->question:(old('question')!=''?(old('question')):'')}}</textarea>
                                            <label>@lang('lang.question') *</label>
                                            <span class="focus-border textarea"></span>
                                            @if ($errors->has('question'))
                                                <span class="error text-danger"><strong>{{ $errors->first('question') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('marks') ? ' is-invalid' : '' }}" type="number" name="marks" value="{{isset($bank)? $bank->marks:(old('marks')!=''?(old('marks')):'')}}">
                                            <label>@lang('lang.marks') *</label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('marks'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('marks') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @php
                                    if(!isset($bank)){
                                        if(old('question_type') == "M"){
                                            $multiple_choice = "";
                                        }
                                    }else{
                                        if($bank->type == "M" || old('question_type') == "M"){
                                            $multiple_choice = "";
                                        }
                                    }
                                @endphp
                                <div class="multiple-choice" id="{{isset($multiple_choice)? $multiple_choice: 'multiple-choice'}}">
                                    <div class="row  mt-25">
                                        <div class="col-lg-8">
                                            <div class="input-effect">
                                                <input class="primary-input form-control{{ $errors->has('number_of_option') ? ' is-invalid' : '' }}"
                                                    type="number" name="number_of_option" autocomplete="off" id="number_of_option" value="{{isset($bank)? $bank->number_of_option: ''}}">
                                                <label>@lang('lang.number_of_options') *</label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('number_of_option'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('number_of_option') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" class="primary-btn small fix-gr-bg" id="create-option">@lang('lang.create')</button>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    if(!isset($bank)){
                                        if(old('question_type') == "M"){
                                            $multiple_options = "";
                                        }
                                    }else{
                                        if($bank->type == "M" || old('question_type') == "M"){
                                            $multiple_options = "";
                                        }
                                    }
                                @endphp
                                <div class="multiple-options" id="{{isset($multiple_options)? "": 'multiple-options'}}">
                                    @php 
                                        $i=0;
                                        $multiple_options = [];

                                        if(isset($bank)){
                                            if($bank->type == "M"){
                                                $multiple_options = $bank->questionMu;
                                            }
                                        }
                                    @endphp
                                    @foreach($multiple_options as $multiple_option)
                                    @php $i++; @endphp
                                    <div class='row  mt-25'>
                                        <div class='col-lg-10'>
                                            <div class='input-effect'>
                                                <input class='primary-input form-control' type='text' name='option[]' autocomplete='off' required value="{{$multiple_option->title}}">
                                                <label>@lang('lang.option') {{$i}}</label>
                                                <span class='focus-border'></span>
                                            </div>
                                        </div>
                                        <div class='col-lg-2'>
                                            <input type="checkbox" id="option_check_{{$i}}" class="common-checkbox" name="option_check_{{$i}}" value="1">
                                            <label for="option_check_{{$i}}">Yes</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @php
                                    if(!isset($bank)){
                                        if(old('question_type') == "T"){
                                            $true_false = "";
                                        }
                                    }else{
                                        if($bank->type == "T" || old('question_type') == "T"){
                                            $true_false = "";
                                        }
                                    }
                                @endphp
                                <div class="true-false" id="{{isset($true_false)? $true_false: 'true-false'}}">
                                    <div class="row  mt-25">
                                        <div class="col-lg-12 d-flex">
                                            <p class="text-uppercase fw-500 mb-10"></p>
                                            <div class="d-flex radio-btn-flex">
                                                <div class="mr-30">
                                                    <input type="radio" name="trueOrFalse" id="relationFather" value="T" class="common-radio relationButton" {{isset($bank)? $bank->trueFalse == "T"? 'checked': '' : 'checked'}}>
                                                    <label for="relationFather">@lang('lang.true')</label>
                                                </div>
                                                <div class="mr-30">
                                                    <input type="radio" name="trueOrFalse" id="relationMother" value="F" class="common-radio relationButton" {{isset($bank)? $bank->trueFalse == "F"? 'checked': '' : ''}}>
                                                    <label for="relationMother">@lang('lang.false')</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    if(!isset($bank)){
                                        if(old('question_type') == "F"){
                                            $fill_in = "";
                                        }
                                    }else{
                                        if($bank->type == "F" || old('question_type') == "F"){
                                            $fill_in = "";
                                        }
                                    }
                                @endphp
                                <div class="fill-in-the-blanks" id="{{isset($fill_in)? $fill_in : 'fill-in-the-blanks'}}">
                                    <div class="row  mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <textarea class="primary-input form-control{{ $errors->has('suitable_words') ? ' is-invalid' : '' }}" cols="0" rows="5" name="suitable_words">{{isset($bank)? $bank->suitable_words: ''}}</textarea>
                                                <label>@lang('lang.suitable_words') *</label>
                                                <span class="focus-border textarea"></span>
                                                @if ($errors->has('suitable_words'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong>{{ $errors->first('suitable_words') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 @php 
                                  $tooltip = "";
                                  if(in_array(235, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            @lang('lang.save') @lang('lang.question')
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
                            <h3 class="mb-0">@lang('lang.question_bank') @lang('lang.list')</h3>
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
                                    <td colspan="5">
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
                                    <th>@lang('lang.group')</th>
                                    <th>@lang('lang.class_Sec')</th>
                                    <th>@lang('lang.question')</th>
                                    <th>@lang('lang.type')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach($banks as $bank)
                                <tr>

                                    <td>{{($bank->questionGroup)!=''?$bank->questionGroup->title:''}}</td>
                                    <td>{{($bank->class)!=''?$bank->class->class_name:''}} ({{($bank->section)!=''?$bank->section->section_name:''}})</td>
                                    <td>{{$bank->question}}</td>
                                    <td>
                                        @if($bank->type == "M")
                                        {{"Multiple Choice"}}
                                        @elseif($bank->type == "T")
                                        {{"True False"}}
                                        @else
                                        {{"Fill in the blank"}}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                               @if(in_array(236, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                                               <a class="dropdown-item" href="{{url('question-bank', [$bank->id
                                                    ])}}">@lang('lang.edit')</a>
                                                @endif
                                                @if(in_array(237, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteQuestionBankModal{{$bank->id}}"
                                                    href="#">@lang('lang.delete')</a>
                                            @endif
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteQuestionBankModal{{$bank->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.question_bank')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                     {{ Form::open(['url' => 'question-bank/'.$bank->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
                                                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                                                     {{ Form::close() }}
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
