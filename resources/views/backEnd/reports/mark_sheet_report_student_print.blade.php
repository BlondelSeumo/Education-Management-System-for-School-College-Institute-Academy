<!DOCTYPE html>
<html lang="en">
<head>
  <title>Merit List </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head> 
<style>
    th{
        border: 1px solid #ddd;
        text-align: center;
        padding: 5px !important;
        font-size: 11px;
    }
    td{
        text-align: center;
        padding: 5px !important;
        font-size: 11px;
    }
    td.subject-name{
        text-align: left;
        padding-left: 10px !important;
    }
  

    .studentInfoTable{
        width: 100%;
        padding: 0px !important;
    }

    .studentInfoTable td{
        padding: 0px !important;
        text-align: left;
        padding-left: 15px !important;
    }
    h4{
        text-align: left !important;
    }
</style>
 <body>

 
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

<div class="container-fluid"> 
    <table  style="width: 100%; border: 0px;"> 
            <tr > 
                <td style="width: 30%">
                    <img class="logo-img" src="{{ url('/')}}/{{$generalSetting->logo }}" alt=""> 
                </td>
                <td style="text-align: left; width: 70%"> 
                    <h3 class="text-white"> {{isset($school_name)?$school_name:'Infix School Management ERP'}} </h3> 
                    <p class="text-white mb-0"> {{isset($address)?$address:'Infix School Address'}} </p>
                </td> 
            </tr> 
    </table>



 
    <div class="container-fluid p-0"> 
        <div class="row">
            <div class="col-lg-12"> 
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="single-report-admit">
                            <div class="card"> 
                               
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="offset-2 col-md-8">

                                                <table class="table">
                                                    <tr>
                                                        <td>
                                                            <p class="text-center">Student Info</p> 
                                                            <hr>
                                                            <table class="studentInfoTable">
                                                                <tr>
                                                                    <td class="font-weight-bold">
                                                                        Name of Student :
                                                                    </td>
                                                                    <td>
                                                                        {{$student_detail->full_name}}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="font-weight-bold">
                                                                        Father's Name :
                                                                    </td>
                                                                    <td>
                                                                        {{$student_detail->parents->fathers_name}}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="font-weight-bold">
                                                                        Mother's Name :
                                                                    </td>
                                                                    <td>
                                                                        {{$student_detail->parents->mothers_name}}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="font-weight-bold">
                                                                        Roll Number :
                                                                    </td>
                                                                    <td>
                                                                        {{$student_detail->roll_no}}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="font-weight-bold">
                                                                        Admission Number :
                                                                    </td>
                                                                    <td>
                                                                        {{$student_detail->admission_no}}
                                                                    </td>
                                                                </tr>


                                                            </table>
                                                        </td>
                                                        <td style="padding-left: 30px">
                                                            <p class="text-center">Exam Info</p>
                                                            <hr>
                                                            <table class="studentInfoTable">
                                                                <tr>
                                                                    <td class="font-weight-bold">
                                                                        Exam Title :
                                                                    </td>
                                                                    <td>
                                                                        {{$exam_details->title}}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="font-weight-bold">
                                                                        Academic Class :
                                                                    </td>
                                                                    <td>
                                                                        {{$class_name->class_name}}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="font-weight-bold">
                                                                        Academic Section :
                                                                    </td>
                                                                    <td>
                                                                        {{$section->section_name}}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="font-weight-bold">
                                                                        Date of birth :
                                                                    </td>
                                                                    <td>
                                                                        {{$student_detail->date_of_birth}}
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                        </div>
                                    </div>
                                    <h4 style="text-align: center;">Marks Sheet of {{$exam_details->title}}</h4>
                                    <hr>

                                    <table class="w-100 mt-40 mb-20 table   table-bordered marksheet">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Subject Name</th>
                                                <th>Marks Obtained</th>
                                                <th>Letter Grade</th>
                                                <th>Grade Point</th>
                                                <th>GPA</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        @php $sum_gpa= 0;  $resultCount=1; $subject_count=1; $tota_grade_point=0; $this_student_failed=0; @endphp
                                        @foreach($subjects as $data)
                                            
                                            <tr>
                                                <td>{{$subject_count++}}</td>
                                                <td class="subject-name">{{$data->subject->subject_name}} </td>
                                                <td>
                                                         {{$tola_mark_by_subject=App\SmAssignSubject::getSumMark($student_detail->id, $data->subject_id, $class_id, $section_id, $exam_type_id)}}
                                                </td>
                                                <td>

                                                    @php
                                                        $mark_grade = App\SmMarksGrade::where([['percent_from', '<=', $tola_mark_by_subject], ['percent_upto', '>=', $tola_mark_by_subject]])->first();

                                                    @endphp
                                                    {{$mark_grade->grade_name }}
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
                                                @if($subject_count==2)
                                                    <td rowspan="{{count($subjects)}}" style="vertical-align: middle">{{  App\SmAssignSubject::get_student_result($student_detail->id, $data->subject_id, $class_id, $section_id, $exam_type_id) }}</td>
                                                @endif

                                            </tr>

                                            @endforeach

                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p class="result-date">
                                                @php
                                                 $data = App\SmMarkStore::select('created_at')->where([
                                                    ['student_id',$student_detail->id],
                                                    ['class_id',$class_id],
                                                    ['section_id',$section_id],
                                                    ['exam_term_id',$exam_type_id],
                                                ])->first(); 
                                                @endphp
                                                Date of Publication of Result : <b> {{date_format(date_create($data->created_at),"F j, Y, g:i a")}}</b>
                                            </p>
                                        </div>
                                    </div>


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
</body>
</html>
