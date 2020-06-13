@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.marks_register') </h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.examinations')</a>
                <a href="#">@lang('lang.marks_register')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.select_criteria') </h3>
                    </div>
                </div>
            @if(in_array(223, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                <div class="col-lg-4 text-md-right text-left col-md-6 mb-30-lg">
                    <a href="{{route('marks_register_create')}}" class="primary-btn small fix-gr-bg">
                        <span class="ti-plus pr-2"></span>
                        @lang('lang.add') @lang('lang.marks')
                    </a>

                </div>
            @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @if(session()->has('message-success') != "")
                    @if(session()->has('message-success'))
                    <div class="alert alert-success">
                        {{ session()->get('message-success') }}
                    </div>
                    @endif
                @endif
                 @if(session()->has('message-danger') != "")
                    @if(session()->has('message-danger'))
                    <div class="alert alert-danger">
                        {{ session()->get('message-danger') }}
                    </div>
                    @endif
                @endif
                <div class="white-box">
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'marks_register', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                        <div class="row">
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                            <div class="col-lg-3 mt-30-md">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('exam') ? ' is-invalid' : '' }}" name="exam">
                                    <option data-display="@lang('lang.select_exam') *" value="">@lang('lang.select_exam') *</option>
                                    @foreach($exam_types as $exam_type)
                                        <option value="{{$exam_type->id}}" {{isset($exam_id)? ($exam_id == $exam->id? 'selected':''):''}}>{{$exam_type->title}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('exam'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('exam') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-3 mt-30-md">
                                <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                    <option data-display="@lang('lang.select_class')*" value="">@lang('lang.select_class') *</option>
                                    @foreach($classes as $class)
                                    <option value="{{$class->id}}"  {{isset($class_id)? ($class_id == $class->id? 'selected':''):''}}>{{$class->class_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('class'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('class') }}</strong>
                                </span>
                                @endif
                            </div>


                            <div class="col-lg-3 mt-30-md" id="select_section_div">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_section" id="select_section" name="section">
                                    <option data-display="@lang('lang.select_section') *" value="">@lang('lang.select_section') *</option>
                                </select>
                                @if ($errors->has('section'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('section') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-lg-3 mt-30-md" id="select_subject_div">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('subject') ? ' is-invalid' : '' }} select_subject" id="select_subject" name="subject">
                                    <option data-display="Select subject *" value="">Select subject *</option>
                                </select>
                                @if ($errors->has('subject'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                                @endif
                            </div>


                            
                            <div class="col-lg-12 mt-20 text-right">
                                <button type="submit" class="primary-btn small fix-gr-bg">
                                    <span class="ti-search pr-2"></span>
                                    @lang('lang.search')
                                </button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        @if(isset($marks_registers))
        <div class="row mt-40">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-0">@lang('lang.marks_register')</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">



        <div class="row">
            <div class="col-lg-12">
                <table class="display school-table school-table-style" cellspacing="0" width="100%" >
                    <thead>
                        <tr>
                            <th rowspan="2" >Admission No.</th>
                            <th rowspan="2" >Roll No.</th>
                            <th rowspan="2" >Student</th>
                            <th colspan="{{$number_of_exam_parts}}"> {{$subjectNames->subject_name}}</th> 
                            <th rowspan="2">Is Absent</th>
                        </tr>
                        <tr>
                            @foreach($marks_entry_form as $part)
                            <th>{{$part->exam_title}} ( {{$part->exam_mark}} ) </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>                        
                        @php $colspan = 3; $counter = 0;  @endphp
                        @foreach($students as $student)
                        <tr>
                            <td>{{$student->admission_no}}
                                <input type="hidden" name="student_ids[]" value="{{$student->id}}">
                                <input type="hidden" name="student_rolls[{{$student->id}}]" value="{{$student->roll_no}}">
                                <input type="hidden" name="student_admissions[{{$student->id}}]" value="{{$student->admission_no}}">
                            </td>
                            <td>{{$student->roll_no}}</td>
                            <td>{{$student->full_name}}</td>
                            @php $entry_form_count=0; @endphp
                            @foreach($marks_entry_form as $part)
                            <td>
                                <div class="input-effect mt-10">
                                <input type="hidden" name="exam_setup_ids[]" value="{{$part->id}}">
 
                                    <input class="primary-input marks_input" type="text" name="marks[{{$student->id}}][{{$part->id}}]" value="0">
                                    <input class="primary-input marks_input" type="hidden" name="exam_Sids[{{$student->id}}][{{$entry_form_count++}}]" value="0">
                                    <label>{{$part->exam_title}} Mark</label>
                                    <span class="focus-border"></span>
                                </div>                                
                            </td>
                            @endforeach

                            <td>
                                <div class="input-effect">
                                    <input type="checkbox" id="subject_{{$student->id}}_{{$student->admission_no}}" class="common-checkbox" name="abs[{{$student->id}}]" value="1">
                                    <label for="subject_{{$student->id}}_{{$student->admission_no}}">Yes</label>
                                </div>
                                    
                            </td>

                        </tr>
                        @endforeach 
                    </tbody>
                </table>

                {{--
                <table id="" class="school-table-data school-table shadow-none" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>@lang('lang.admission') @lang('lang.no')</th>
                            <th>@lang('lang.roll') @lang('lang.no')</th>
                            <th>@lang('lang.student')</th>
                            <th>@lang('lang.father_name')</th>
                            @php
                                $subjects = $marks_register->marksRegisterChilds;
                               
                            @endphp
                            @foreach($subjects as $subject)
                            <th>{{$subject->subject !=""?$subject->subject->subject_name:""}}</th>
                            @endforeach

                            <th>@lang('lang.grand_total')</th>
                            <th>@lang('lang.percent')(%)</th>
                            <th>@lang('lang.result')</th>

                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $registerer_ids = [];
                        @endphp
                        @foreach($marks_registers as $marks_register)
                        @php
                            $registerer_ids[] = $marks_register->student_id;
                        @endphp
                        <tr>
                            <td>{{$marks_register->studentInfo !=""?$marks_register->studentInfo->admission_no:""}}</td>
                            <td>{{$marks_register->studentInfo !=""?$marks_register->studentInfo->roll_no:""}}</td>
                            <td>{{$marks_register->studentInfo !=""?$marks_register->studentInfo->full_name:""}}</td>
                            <td>{{$marks_register->studentInfo !=""?$marks_register->studentInfo->parents->fathers_name:""}}</td>
                            @php
                                $results = $marks_register->marksRegisterChilds;
                                $grand_total = 0;
                                $grand_total_marks = 0;
                                $final_result = 0;
                            @endphp
                            @foreach($results as $result)
                            @php
                                $subjectDetails = App\SmMarksRegister::subjectDetails($marks_register->exam_id, $marks_register->class_id, $marks_register->section_id, $result->subject_id);
                                $grand_total_marks += $subjectDetails->full_mark;

                                if($result->abs == 0){
                                    $grand_total += $result->marks;
                                    if($result->marks < $subjectDetails->pass_mark){
                                        $final_result++;
                                    }

                                }else{
                                    $final_result++;
                                }
                            @endphp
                            <td>{{$result->abs == 0? $result->marks: 'ABS'}} </td>
                            @endforeach
                            <td>{{$grand_total.'/'.$grand_total_marks}}</td>
                            <td>{{($grand_total==0)?0:number_format($grand_total/$grand_total_marks*100, 2)}}</td>
                            <td>
                                @if($final_result == 0)
                                    <button class="primary-btn small bg-success text-white border-0">Pass</button>
                                @else
                                    <button class="primary-btn small bg-danger text-white border-0">Fail</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @foreach($all_students as $student)
                            @if(!in_array($student->id, $registerer_ids))
                                <tr>
                                    <td>{{$student->admission_no}}</td>
                                    <td>{{$student->roll_no}}</td>
                                    <td>{{$student->full_name}}</td>
                                    <td>{{$student->parents !=""?$student->parents->fathers_name:""}}</td>
                                    @php
                                        $results = $marks_register->marksRegisterChilds;
                                    @endphp
                                    @foreach($results as $result)
                                    <td>{{'N/A'}}</td>
                                    @endforeach
                                    <td>{{'N/A'}}</td>
                                    <td>{{'N/A'}}</td>
                                    <td>{{'N/A'}}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                --}}
            </div>
        </div>
        @endif
    </div>
</section>
            

@endsection
