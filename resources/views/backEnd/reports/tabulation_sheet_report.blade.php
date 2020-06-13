@extends('backEnd.master')
@section('mainContent')
    <style type="text/css">
        .table tbody td {
            padding: 5px;
            text-align: center;
            vertical-align: middle;
        }

        .table head th {
            padding: 5px;
            text-align: center;
            vertical-align: middle;
        }

        .table head tr th {
            padding: 5px;
            text-align: center;
            vertical-align: middle;
        }

        tr, th, td {
            border: 1px solid #a2a6c5;
            text-align: center !important;
        }

        th, td {
            white-space: nowrap;
            text-align: center !important;
        }

        th.subject-list {
            white-space: inherit;
        }


        #main-content {
            width: auto !important;
        }

        .main-wrapper {
            display: inherit;
        }

        .table thead th {
            padding: 5px;
            vertical-align: middle;
        }

        .student_name, .subject-list {
            line-height: 12px;
        }

        .student_name b {
            min-width: 20%;
        }



        .gradeChart tbody td{
            padding: 0px;
            padding-left: 5px;
        }
        .gradeChart thead th{
            background: #f2f2f2;
        }
    </style>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.tabulation_sheet_report') </h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.reports')</a>
                    <a href="{{route('tabulation_sheet_report')}}">@lang('lang.tabulation_sheet_report')</a>
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
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'tabulation_sheet_report', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                    <div class="row">
                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                        <div class="col-lg-3 mt-30-md">
                            <select class="w-100 bb niceSelect form-control{{ $errors->has('exam') ? ' is-invalid' : '' }}"
                                    name="exam">
                                <option data-display="@lang('lang.select_exam')*" value="">@lang('lang.select_exam')*
                                </option>
                                @foreach($exam_types as $exam)
                                    <option value="{{$exam->id}}" {{isset($exam_id)? ($exam_id == $exam->id? 'selected':''):''}}>{{$exam->title}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('exam'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('exam') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-lg-3 mt-30-md">
                            <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}"
                                    id="select_class" name="class">
                                <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select_class')
                                    *
                                </option>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}" {{isset($class_id)? ($class_id == $class->id? 'selected':''):''}}>{{$class->class_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('class'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('class') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-lg-3 mt-30-md" id="select_section_div">
                            <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_section"
                                    id="select_section" name="section">
                                <option data-display="Select section *" value="">Select section *</option>
                            </select>
                            @if ($errors->has('section'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('section') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-lg-3 mt-30-md" id="select_student_div">
                            <select class="w-100 bb niceSelect form-control{{ $errors->has('student') ? ' is-invalid' : '' }}"
                                    id="select_student" name="student">
                                <option data-display="@lang('lang.select_student')"
                                        value="">@lang('lang.select_student')</option>
                            </select>
                            @if ($errors->has('student'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('student') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="col-lg-12 mt-20 text-right">
                            <button type="submit" class="primary-btn small fix-gr-bg">
                                <span class="ti-search"></span>
                                @lang('lang.search')
                            </button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>

    @if(isset($marks))

        @php
            $generalSetting= App\SmGeneralSettings::find(1);
            if(!empty($generalSetting)){
                $school_name =$generalSetting->school_name;
                $site_title =$generalSetting->site_title;
                $school_code =$generalSetting->school_code;
                $address =$generalSetting->address;
                $phone =$generalSetting->phone;
            }


        @endphp

        <section class="student-details mt-20">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-30 mt-30"> @lang('lang.tabulation_sheet_report')</h3>
                        </div>
                    </div>
                    <div class="col-lg-8 pull-right mt-20">

                        <div class="print_button pull-right">
                            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'tabulation-sheet/print', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                            <input type="hidden" name="exam_term_id" value="{{$exam_term_id}}">
                            <input type="hidden" name="class_id" value="{{$class_id}}">
                            <input type="hidden" name="section_id" value="{{$section_id}}">
                            @if(!empty($student_id))
                                <input type="hidden" name="student_id" value="{{$student_id}}">
                            @endif
                            
                            <button type="submit" class="primary-btn small fix-gr-bg"><i class="ti-printer"> </i> Print
                            </button>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single-report-admit">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-lg-4">
                                        <img class="logo-img" src="{{ $generalSetting->logo }}" alt="">
                                    </div>
                                    <div class=" col-lg-8 text-left text-lg-right mt-30-md">
                                        <h3 class="text-white"> {{isset($school_name)?$school_name:'Infix School Management ERP'}} </h3>
                                        <p class="text-white mb-0"> {{isset($address)?$address:'Infix School Adress'}} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h3 class="exam_title text-center text-capitalize">{{isset($school_name)?$school_name:'Infix School Management ERP'}} </h3>
                                    <h4 class="exam_title text-center text-capitalize">{{isset($address)?$address:'Infix School Adress'}} </h4>
                                    <h4 class="exam_title text-center text-uppercase"> tabulation sheet
                                        of {{$tabulation_details['exam_term']}} in {{date('Y')}}</h4>
                                    <hr>

                                    <div class="row">
                                        <div class=" col-lg-6">
                                            @if(@$tabulation_details['student_name'])
                                                @if(@$tabulation_details['student_name'])
                                                    <p class="student_name">
                                                        <b>@lang('lang.student') @lang('lang.name') </b> {{$tabulation_details['student_name']}}
                                                    </p>
                                                @endif
                                                @if(@$tabulation_details['student_roll'])
                                                    <p class="student_name">
                                                        <b>@lang('lang.student') @lang('lang.roll') </b> {{$tabulation_details['student_roll']}}
                                                    </p>
                                                @endif
                                                @if(@$tabulation_details['student_admission_no'])
                                                    <p class="student_name">
                                                        <b>@lang('lang.student') @lang('lang.admission') </b> {{$tabulation_details['student_admission_no']}}
                                                    </p>
                                                @endif
                                            @else
                                                @foreach($tabulation_details['subject_list'] as $d)
                                                    <p class="subject-list">{{$d}}</p>
                                                @endforeach

                                            @endif
                                        </div>
                                        <div class=" col-lg-6">

                                            @if(@$tabulation_details['student_class'])
                                                <p class="student_name">
                                                    <b>@lang('lang.class')  </b> {{$tabulation_details['student_class']}}
                                                </p>
                                            @endif
                                            @if(@$tabulation_details['student_section'])
                                                <p class="student_name">
                                                    <b>@lang('lang.section') </b> {{$tabulation_details['student_section']}}
                                                </p>
                                            @endif
                                            @if(@$tabulation_details['student_admission_no'])
                                                <p class="student_name">
                                                    <b> @lang('lang.exam') </b> {{$tabulation_details['exam_term']}}
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-4">
                                    @if(@$tabulation_details)
                                        <table class="table gradeChart">
                                            <thead>
                                            <th>SL</th>
                                            <th>Staring</th>
                                            <th>Ending</th>
                                            <th>GPA</th>
                                            <th>Grade</th>
                                            <th>Evalution</th>
                                            </thead>
                                            <tbody>
                                            @php $gdare_count =1; @endphp
                                            @foreach($tabulation_details['grade_chart'] as $d)
                                                <tr>
                                                    <td>{{$gdare_count++}}</td>
                                                    <td>{{$d['start']}}</td>
                                                    <td>{{$d['end']}}</td>
                                                    <td>{{$d['gpa']}}</td>
                                                    <td>{{$d['grade_name']}}</td>
                                                    <td class="text-left">{{$d['description']}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="mt-30 mb-20 table table-striped table-bordered ">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">@lang('lang.sl')</th>
                                        <th rowspan="2">@lang('lang.student') @lang('lang.name')</th>
                                        <th rowspan="2">@lang('lang.admission') @lang('lang.no')</th>
                                        @foreach($subjects as $subject)
                                            @php
                                                $subject_ID     = $subject->subject_id;
                                                $subject_Name   = $subject->subject->subject_name;
                                                $mark_parts      = App\SmAssignSubject::getNumberOfPart($subject_ID, $class_id, $section_id, $exam_term_id);
                                            @endphp
                                            <th colspan="{{count($mark_parts)+2}}" class="subject-list"> {{$subject_Name}}</th>
                                        @endforeach
                                        <th rowspan="2">@lang('lang.total_mark')</th>
                                        <th rowspan="2">@lang('lang.gpa')</th>
                                        <th rowspan="2">@lang('lang.gpa') @lang('lang.grade')</th>
                                    </tr>
                                    <tr>

                                        @foreach($subjects as $subject)
                                            @php
                                                $subject_ID     = $subject->subject_id;
                                                $subject_Name   = $subject->subject->subject_name;
                                                $mark_parts     = App\SmAssignSubject::getNumberOfPart($subject_ID, $class_id, $section_id, $exam_term_id);
                                            @endphp

                                            @foreach($mark_parts as $sigle_part)
                                                <th>{{$sigle_part->exam_title}}</th>
                                            @endforeach
                                            <th>@lang('lang.total')</th>
                                            <th>@lang('lang.gpa')</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php  $count=1;  @endphp
                                    @foreach($students as $student)
                                        @php $this_student_failed=0; $tota_grade_point= 0; $marks_by_students = 0; @endphp
                                        <tr>
                                            <td>{{$count++}}</td>
                                            <td> {{$student->full_name}}</td>
                                            <td> {{$student->admission_no}}</td>

                                            @foreach($subjects as $subject)
                                                @php
                                                        $subject_ID     = $subject->subject_id;
                                                        $subject_Name   = $subject->subject->subject_name;
                                                        $mark_parts     = App\SmAssignSubject::getMarksOfPart($student->id, $subject_ID, $class_id, $section_id, $exam_term_id);
                                                @endphp
                                                @foreach($mark_parts as $sigle_part)
                                                    <td class="total">{{$sigle_part->total_marks}}</td>
                                                @endforeach
                                                <td class="total">
                                                    @php
                                                        $tola_mark_by_subject = App\SmAssignSubject::getSumMark($student->id, $subject_ID, $class_id, $section_id, $exam_term_id);
                                                        $marks_by_students  = $marks_by_students + $tola_mark_by_subject;
                                                    @endphp
                                                    {{$tola_mark_by_subject }}
                                                </td>
                                                <td>
                                                    @php
                                                        $mark_grade = App\SmMarksGrade::where([['percent_from', '<=', $tola_mark_by_subject], ['percent_upto', '>=', $tola_mark_by_subject]])->first();
                                                        $tota_grade_point = $tota_grade_point + $mark_grade->gpa ;
                                                        if($mark_grade->gpa<1){
                                                            $this_student_failed =1;
                                                        }
                                                    @endphp
                                                    {{$mark_grade->gpa }}
                                                </td>

                                            @endforeach
                                            <td>{{$marks_by_students}}
                                                @php $marks_by_students = 0; @endphp
                                            </td>
                                            <td>
                                                @if(isset($this_student_failed) && $this_student_failed==1)
                                                    0.00
                                                @else
                                                    @php
                                                        if(!empty($tota_grade_point)){
                                                            $number = number_format($tota_grade_point/ count($subjects ), 2, '.', '');
                                                        }else{
                                                            $number = 0;
                                                        }
                                                    @endphp
                                                    {{$number==0?'0.00':$number}} @php $tota_grade_point= 0; @endphp
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($this_student_failed) && $this_student_failed==1)
                                                    <span class="text-warning font-weight-bold">F</span>
                                                @else
                                                    @php
                                                    $mark_grade = App\SmMarksGrade::where([['from', '<=', $number], ['up', '>=', $number]])->first();
                                                    @endphp
                                                    {{$mark_grade->grade_name }}
                                                 @endif


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
    @endif


@endsection
