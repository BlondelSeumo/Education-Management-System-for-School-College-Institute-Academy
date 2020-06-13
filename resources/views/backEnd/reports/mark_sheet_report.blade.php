@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Marks Sheet report Section </h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">Dashboard</a>
                <a href="#">Reports</a>
                <a href="#">Marks Sheet report Section</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">Select Criteria </h3>
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
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'mark_sheet_report', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                        <div class="row">
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                            <div class="col-lg-4 mt-30-md">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('exam') ? ' is-invalid' : '' }}" name="exam">
                                    <option data-display="Select Exam *" value="">Select Exam *</option>
                                    @foreach($exams as $exam)
                                        <option value="{{$exam->id}}" {{isset($exam_id)? ($exam_id == $exam->id? 'selected':''):''}}>{{$exam->title}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('exam'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('exam') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-4 mt-30-md">
                                <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                    <option data-display="Select Class *" value="">Select Class *</option>
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
                            <div class="col-lg-4 mt-30-md" id="select_section_div">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_section" id="select_section" name="section">
                                    <option data-display="Select section *" value="">Select section *</option>
                                </select>
                                @if ($errors->has('section'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('section') }}</strong>
                                </span>
                                @endif
                            </div>
                            
                            <div class="col-lg-12 mt-20 text-right">
                                <button type="submit" class="primary-btn small fix-gr-bg">
                                    <span class="ti-search pr-2"></span>
                                    search
                                </button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
</section>


@if(isset($marks_registers))
<section class="student-details">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-30 mt-30">Mark Sheet Report Section wise</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="single-report-admit">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex">
                                            <div>
                                                <img class="logo-img" src="http://localhost/naim/schoolmanagementsystem/public/backEnd/img/logo.png" alt="">
                                            </div>
                                            <div class="ml-30">
                                                <h3 class="text-white">School Management System</h3>
                                                <p class="text-white mb-0">House 25, Road 27, Block B, 54th Floor, New York, United States of America</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h3>Exam info</h3>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <p class="mb-0">
                                                                Academic Year : <span class="primary-color fw-500">2018-19</span>
                                                            </p>
                                                            <p class="mb-0">
                                                                Exam : <span class="primary-color fw-500">{{$exam->name}}</span>
                                                            </p>
                                                            <p class="mb-0">
                                                                Class : <span class="primary-color fw-500">{{$class->class_name}}</span>
                                                            </p>
                                                            <p class="mb-0">
                                                                Section : <span class="primary-color fw-500">{{$section->section_name}}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <h3>Subjects</h3>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            @foreach($subjects as $subject)
                                                            <p class="mb-0">
                                                                <span class="primary-color fw-500">{{$subject->subject !=""?$subject->subject->subject_name:""}}</span>
                                                            </p>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="w-100 mt-30 mb-20">
                                            <thead>
                                                <tr>
                                                    <th>Student</th>
                                                    <th>Admission No.</th>
                                                    @php
                                                        $subjects = $marks_register->marksRegisterChilds;
                                                       
                                                    @endphp
                                                    @foreach($subjects as $subject)
                                                    <th>{{$subject->subject->subject_name}}</th>
                                                    @endforeach
                                                    <th>GPA</th>
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
                                                    <td>{{$marks_register->studentInfo->full_name}}</td>
                                                    <td>{{$marks_register->studentInfo->admission_no}}</td>
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
                                                    <td>
                                                        @php
                                                            if($final_result == 0){
                                                                $percent = $grand_total/$grand_total_marks*100;
                                                                foreach($grades as $grade){
                                                                   if(floor($percent) >= $grade->percent_from && floor($percent) <= $grade->percent_upto){
                                                                       echo $grade->grade_name;
                                                                   }
                                                                }
                                                            }else{
                                                                echo "F";
                                                            }
                                                        @endphp
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
                </div>
            </div>
        </div>
    </div>
</section>

@endif
            

@endsection
