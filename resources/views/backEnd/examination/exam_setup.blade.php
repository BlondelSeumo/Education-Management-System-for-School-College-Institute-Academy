@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.exam')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.examinations')</a>
                <a href="#">@lang('lang.exam')</a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area">
    @if(isset($exam))
        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'exam-setup-store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
        @else
        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'exam',
        'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
        @endif
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">@if(isset($exam))
                                    @lang('lang.add')
                                @else
                                    @lang('lang.update')
                                @endif
                                @lang('lang.exam')
                            </h3>
                        </div>
                        
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
                                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                        
                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                            <label>@lang('lang.select') @lang('lang.classes')</label>
                                            @php $h = 0; @endphp
                                        @foreach($classes as $class)
                                            <div class="input-effect">
                                                <input type="checkbox" id="classes_{{$class->id}}" class="common-checkbox" name="class_ids[]" value="{{$class->id}}" {{ (is_array(old('class_ids')) and in_array($class->id, old('class_ids'))) ? ' checked' : '' }}>
                                                <label for="classes_{{$class->id}}">{{$class->class_name}}</label>
                                            </div>
                                            @php $h++; @endphp
                                        @endforeach

                                    </div>
                                    <div class="col-lg-12">

                                        @if($errors->has('class_ids'))
                                            <span class="text-danger validate-textarea-checkbox" role="alert">
                                                <strong>{{ $errors->first('class_ids') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                            <label>@lang('lang.select_section')</label>
                                        @foreach($sections as $section)
                                            <div class="input-effect">
                                                <input type="checkbox" id="sections_{{$section->id}}" class="common-checkbox" name="section_ids[]" value="{{$section->id}}">
                                                <label for="sections_{{$section->id}}">{{$section->section_name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-lg-12">

                                        @if($errors->has('section_ids'))
                                            <span class="text-danger validate-textarea-checkbox" role="alert">
                                                <strong>{{ $errors->first('section_ids') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                            <label>@lang('lang.select_subjects')</label>
                                        @foreach($subjects as $subject)
                                            <div class="input-effect">
                                                <input type="checkbox" id="subjects_{{$subject->id}}" class="common-checkbox" name="subjects_ids[]" value="{{$subject->id}}">
                                                <label for="subjects_{{$subject->id}}">{{$subject->subject_name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-lg-12">

                                        @if($errors->has('subjects_ids'))
                                            <span class="text-danger validate-textarea-checkbox" role="alert">
                                                <strong>{{ $errors->first('subjects_ids') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>






                                <div class="row mt-25">
                                    <div class="col-lg-12">

                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            type="number" name="name" id="name" autocomplete="off" value="{{isset($exam)? $exam->name:''}}" readonly="">
                                            <label>@lang('lang.exam_terms')</label>
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
                                        <input type="hidden" name="exam_term_id" value="{{$exam->id}}">
                                        <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                            <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select_class') *</option>
                                            @foreach($classes as $class)
                                                <option value="{{$class->id}}" {{isset($exam)? ($class->id == $exam->class_id? 'selected':''): (old('class') == $class->id? 'selected':'')}}>{{$class->class_name}}</option>

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
                                        <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_section" id="select_section" name="section"  readonly="">
                                            <option data-display="@lang('lang.select_section') *" value="">@lang('lang.select_section') *</option>
                                            @if(isset($exam))
                                                @foreach($sections as $section)
                                                    <option value="{{$section->id}}" {{$exam->section_id == $section->id? 'selected': ''}}>{{$section->section_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('section'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('section') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="row mt-25">
                                    <div class="col-lg-12" id="select_subject_div">
                                        <select class="w-100 bb niceSelect form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" id="select_subject" name="subject"  readonly="">
                                            <option data-display="@lang('lang.select_subjects') *" value="">@lang('lang.select_subjects') *</option>
                                            @if(isset($exam))
                                                @foreach($subjects as $subject)
                                                    <option value="{{$subject->id}}" {{$exam->subject_id == $subject->id? 'selected': ''}}>{{$subject->subject_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('subject'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div> 
                                <div class="row mt-25">
                                    <div class="col-lg-12">

                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                type="text" name="name" autocomplete="off" value="{{isset($exam)? $exam->name:''}}">
                                            <input type="hidden" name="id" value="{{isset($exam)? $exam->id: ''}}"  readonly="">
                                            <label>@lang('lang.exam_name')<span>*</span></label>
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
                                            <input class="primary-input form-control{{ $errors->has('exam_mark') ? ' is-invalid' : '' }}"
                                            type="number" name="total_exam_mark" id="exam_mark_main" autocomplete="off" value="{{isset($exam)? $exam->exam_mark:''}}" readonly="">
                                            <label>@lang('lang.exam_mark')</label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('exam_mark'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('exam_mark') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div> 
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
               <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.add_mark_distributions')</h3>
                    </div>
                </div>
                <div class="offset-lg-6 col-lg-2 text-right col-md-6">
                    <button type="button" class="primary-btn small fix-gr-bg" onclick="addRowMark();" id="addRowBtn">
                        <span class="ti-plus pr-2"></span>
                        @lang('lang.add')
                    </button>
                </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
               <div class="white-box">
                   <table class="table" id="productTable">
                    <thead>
                      <tr>
                          <th>@lang('lang.exam_title')</th>
                          <th>@lang('lang.exam_mark')</th>
                          <th>@lang('lang.action')</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr id="row1" class="0">
                            <td class="border-top-0">
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">  
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('exam_title') ? ' is-invalid' : '' }}"
                                    type="text" id="exam_title" name="exam_title[]" autocomplete="off" value="{{isset($editData)? $editData->exam_title : '' }}" placeholder="@lang('lang.exam_title')">


                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('exam_mark') ? ' is-invalid' : '' }} exam_mark"
                                    type="text" id="exam_mark" name="exam_mark[]" autocomplete="off"   value="{{isset($editData)? $editData->exam_mark : '' }}">
                                </div>
                            </td> 
                            <td>
                                 <button class="primary-btn icon-only bg-danger text-light" type="button">
                                     <span class="ti-trash"></span>
                                </button>
                               
                            </td>
                        </tr>
                        <tfoot>
                            <tr>
                               <th class="border-top-0">@lang('lang.total')</th>

                               <th class="border-top-0" id="totalMark">
                                 <input type="text" class="primary-input form-control" name="totalMark" readonly="true">
                               </th>
                               <th class="border-top-0"></th>
                           </tr>
                       </tfoot>

                   </tbody>
               </table>
           </div>
       </div>
   </div>
    <div class="row mt-30">
        <div class="col-lg-12">
            <div class="white-box">
                <div class="row mt-40">
                    <div class="col-lg-12 text-center">
                        <button class="primary-btn fix-gr-bg"> 
                            <span class="ti-check"></span>
                            @if(isset($exam))
                                @lang('lang.edit')
                            @else
                                @lang('lang.add')
                            @endif
                            @lang('lang.mark_distribution')
                        </button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


        </div>
    </div>
</div>

{{ Form::close() }}


</section>
@endsection
