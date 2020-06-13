@extends('backEnd.master')
@section('mainContent')

@php
    function showPicName($data){
        $name = explode('/', $data);
        return $name[4];
    }
@endphp
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Exam Result</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">Dashboard</a>
                <a href="#">Examinations</a>
                <a href="{{route('parent_examination', [$student_detail->id])}}">Exam Result</a>
            </div>
        </div>
    </div>
</section>

<section class="student-details">
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

            <!-- Start Student Details -->
            <div class="col-lg-9">

                    @foreach($exams as $exam)

                    <div class="white-box no-search no-paginate no-table-info mb-2">
                        <div class="main-title">
                            <h3 class="mb-0">{{($exam->exam)!=''? $exam->exam->name :''}}</h3>
                        </div>
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Full Marks</th>
                                    <th>Passing Marks</th>
                                    <th>Obtained Marks</th>
                                    <th>Results</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $marks = App\SmStudent::marks($exam->exam_id, $student_detail->id);
                                    $grand_total = 0;
                                    $grand_total_marks = 0;
                                    $result = 0;

                                @endphp
                                @foreach($marks as $mark)
                                    @php
                                        $subject_marks = App\SmStudent::fullMarks($exam->id, $mark->subject_id);
                                        $result_subject = 0;
                                        $grand_total_marks += $subject_marks->full_mark;
                                        if($mark->abs == 0){
                                            $grand_total += $mark->marks;
                                            if($mark->marks < $subject_marks->pass_mark){
                                               $result_subject++;
                                               $result++;
                                            }

                                        }else{
                                            $result_subject++;
                                            $result++;
                                        }
                                    @endphp
                                <tr>
                                    <td>{{$mark->subject !=""?$mark->subject->subject_name:""}}</td>
                                    <td>{{$subject_marks->full_mark}}</td>
                                    <td>{{$subject_marks->pass_mark}}</td>
                                    <td>{{$mark->marks}}</td>
                                    <td>
                                        @if($result_subject == 0)
                                            <span class="primary-btn small bg-success text-white border-0">Pass</span>
                                        @else
                                            <span class="primary-btn small bg-danger text-white border-0">Fail</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @if(count($marks) != "")
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Grand Total: {{$grand_total}}/{{$grand_total_marks}}</th>
                                    <th></th>
                                    <th>Grade: 
                                        @php
                                            if($result == 0){
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
                                    </th>
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                    </div>
                    @endforeach
                    
            </div>
            <!-- End Student Details -->
        </div>

            
    </div>
</section>


@endsection
