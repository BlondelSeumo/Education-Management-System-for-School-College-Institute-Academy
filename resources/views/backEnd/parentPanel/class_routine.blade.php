@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Class Routine </h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">Dashboard</a>
                <a href="{{route('parent_class_routine', [$student_detail->id])}}">Class Routine</a>
            </div>
        </div>
    </div>
</section>

<section class="mt-20">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-6 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">Student Information</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <!-- Start Student Meta Information -->
                <div class="student-meta-box">
                    <div class="student-meta-top"></div>
                    <img class="student-meta-img img-100" src="{{asset($student_detail->student_photo)}}" alt="">
                    <div class="white-box radius-t-y-0">
                        <div class="single-meta mt-10">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Student Name
                                </div>
                                <div class="value">
                                    {{$student_detail->first_name.' '.$student_detail->last_name}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Admission Number
                                </div>
                                <div class="value">
                                    {{$student_detail->admission_no}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Roll Number
                                </div>
                                <div class="value">
                                     {{$student_detail->roll_no}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Class
                                </div>
                                <div class="value">
                                    @if($student_detail->className !="" && $student_detail->session !="")
                                   {{$student_detail->className->class_name}} ({{$student_detail->session->session}})
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Section
                                </div>
                                <div class="value">
                                    {{$student_detail->section !=""?$student_detail->section->section_name:""}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Gender
                                </div>
                                <div class="value">
                                    {{$student_detail->gender !=""?$student_detail->gender->base_setup_name:""}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Student Meta Information -->

            </div>
            <div class="col-lg-9">
                <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Class Period</th>
                            @foreach($sm_weekends as $sm_weekend)
                            <th>{{$sm_weekend->name}}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($class_times as $class_time)
                        <tr>
                            <td>{{$class_time->period}}<br>{{date('h:i A', strtotime($class_time->start_time)).' - '.date('h:i A', strtotime($class_time->end_time))}}</td>
                            @foreach($sm_weekends as $sm_weekend)

                            <td>
                                @if($class_time->is_break == 0)
                                @if($sm_weekend->is_weekend != 1)
                                

                                @php
                                    $assinged_class_routine = App\SmClassRoutineUpdate::assingedClassRoutine($class_time->id, $sm_weekend->id, $class_id, $section_id);
                                @endphp
                                @if($assinged_class_routine != "")
                                    <span class="">{{$assinged_class_routine->subject !=""?$assinged_class_routine->subject->subject_name:""}}</span>
                                    <br>
                                    <span class="">{{$assinged_class_routine->classRoom !=""?$assinged_class_routine->classRoom->room_no:""}}</span></br>
                                    <span class="tt">{{$assinged_class_routine->teacherDetail !=""?$assinged_class_routine->teacherDetail->full_name:""}}</span></br>
                                @endif

                                
                                @else
                                    Weekend

                                @endif
                                @endif
                            </td>

                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</section>


@endsection
