@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Exam Routine</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">Dashboard</a>
                <a href="#">Examinations</a>
                <a href="#">Exam Routine</a>
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
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_exam_schedule_search', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="col-lg-6 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control{{ $errors->has('exam') ? ' is-invalid' : '' }}" name="exam">
                                        <option data-display="Select Exam *" value="">Select Exam *</option>
                                        @foreach($exam_types as $exam)
                                            <option value="{{$exam->id}}" {{isset($exam_id)? ($exam->id == $exam_id? 'selected':''):''}}>{{$exam->title}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('exam'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('exam') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                
                                <div class="col-lg-6 mt-20 text-right">
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
        </div>
    </section>
@if(isset($assign_subjects))

<section class="mt-20">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-6 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">Exam Routine</h3>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        @if(session()->has('success') != "" || session()->has('danger') != "")
                        <tr>
                            <td colspan="20">
                                @if(session()->has('success') != "")
                            
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            
                                @else

                                <div class="alert alert-success">
                                    {{ session()->get('danger') }}
                                </div>

                            </td>

                            @endif
                        </tr>
                        @endif
                        <tr>
                            <th width="10%">Subject</th>
                            @foreach($exam_periods as $exam_period)
                            <th>{{$exam_period->period}}<br>{{date('h:i A', strtotime($exam_period->start_time)).'-'.date('h:i A', strtotime($exam_period->end_time))}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assign_subjects as $assign_subject)
                        <tr>
                            <td>{{$assign_subject->subject!=""?$assign_subject->subject->subject_name:""}}</td>
                            @foreach($exam_periods as $exam_period)
                            @php

                                $assignedRoutine = App\SmExamSchedule::assignedRoutine($class_id, $section_id, $exam_id, $assign_subject->subject_id, $exam_period->id);

                                $assigned_routine = App\SmExamSchedule::assignedRoutine($class_id, $section_id, $exam_id, $assign_subject->subject_id, $exam_period->id);
                                
                            @endphp
                            <td>
                                @if($assignedRoutine == "")
                                    
                                @else
                                    <div class="col-lg-6">
                                        <span class="">{{$assigned_routine->classRoom->room_no}}</span>
                                        <br>
                                        <span class="">
                                           
                                    {{ ($assigned_routine->date) != ""? App\SmGeneralSettings::DateConvater($assigned_routine->date):''}}

                                        </span></br>
                                        
                                @endif
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>  
    </div>
</section>

@endif



@endsection
