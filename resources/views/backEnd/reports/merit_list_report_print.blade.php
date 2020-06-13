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
   .marklist th, .marklist td{
        border: 1px solid black;
        padding:2px;
        font-size: 11px;
    }
    .marklist th{
        text-transform: capitalize;
        text-align: center; 
    }
    .marklist td{
        text-align: center;
    }
    body{
        padding: 0;
        font-family: "Poppins", sans-serif;
        font-weight: 400;

        margin-top: 35px; 
    }
    html{
        padding: 0px;
        margin: 0px;  
        font-family: "Poppins", sans-serif;
        font-weight: 400;


    }
    .container-fluid{ 
        padding-bottom: 50px;
    }
    h1,h2,h3,h4{

        font-family: "Poppins", sans-serif;
        font-weight: 400;
        margin-bottom: 15px;
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
    <table class="table">
        <thead>
            <tr >
                
                <th>
                    <img class="logo-img" src="{{ url('/')}}/{{$generalSetting->logo }}" alt=""> 
                </th>
                <th> 
                    <h3 class="text-white"> {{isset($school_name)?$school_name:'Infix School Management ERP'}} </h3> 
                    <p class="text-white mb-0"> {{isset($address)?$address:'Infix School Address'}} </p>
                </th>

            </tr>
        </thead> 
        <tbody>
            <tr>
                <td>
                    
                    <p class="mb-0"> @lang('lang.academic_year') : <span class="primary-color fw-500">{{$generalSetting->session_year}}</span> </p>
                    <p class="mb-0"> @lang('lang.exam') : <span class="primary-color fw-500">{{$exam_name}}</span> </p>
                    <p class="mb-0"> @lang('lang.class') : <span class="primary-color fw-500">{{$class_name}}</span> </p>
                    <p class="mb-0"> @lang('lang.section') : <span class="primary-color fw-500">{{$section->section_name}}</span> </p>
                </td>
                <td> 
                    <p style="font-weight: 500; border-bottom:1px solid #ddd">@lang('lang.subjects') @lang('lang.list')</p> 
                    <div class="row">
                        <div class="col-md-12 w-100" style="columns: 2">
                            @foreach($assign_subjects as $subject)
                            <p class="mb-0"> <span class="primary-color fw-500">{{$subject->subject->subject_name}}</span> </p>
                            @endforeach 
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <h3 style="width: 100%; text-align: center; border-bottom: 1px solid black; padding: 10px;">Merit List</h3>
 

                                        <table class="marklist" style="width: 100%">
                                            <thead>
                                                <tr style="border-bottom: 1px solid black !important">
                                                    <th>Merit @lang('lang.position')</th>
                                                    <th>@lang('lang.admission') @lang('lang.no')</th>
                                                    <th>@lang('lang.student')</th>
                                                    @foreach($subjectlist as $subject)
                                                    <th>{{$subject}}</th>
                                                    @endforeach

                                                    <th>@lang('lang.total_mark')</th>
                                                    <th>@lang('lang.average')</th>
                                                    <th>@lang('lang.gpa')</th>
                                                    <th>@lang('lang.result')</th>
                                                </tr>
                                            </thead>

                                            <tbody>


                                                @php $i=1; $subject_mark = []; $total_student_mark = 0; @endphp
                                                @foreach($allresult_data as $row) 
                                                <tr>
                                                    <td>{{$row->merit_order}}</td>
                                                    <td>{{$row->admission_no}}</td>
                                                    <td style="text-align: left;">{{$row->student_name}}</td>

                                                    @php $markslist = explode(',',$row->marks_string);@endphp  
                                                    @if(!empty($markslist))
                                                        @foreach($markslist as $mark)
                                                            @php 
                                                                $subject_mark[]= $mark;
                                                                $total_student_mark = $total_student_mark + $mark; 
                                                            @endphp 
                                                            <td>  {{!empty($mark)?$mark:0}}</td> 
                                                        @endforeach
                                                     
                                                    @endif



                                                    <td>{{$total_student_mark}} </td>
                                                    <td>{{!empty($row->average_mark)?$row->average_mark:0}} @php $total_student_mark=0; @endphp </td> 
                                                    <td>
                                                        <?php 
                                                            $total_grade_point = 0;
                                                            $number_of_subject = count($subject_mark); 
                                                            foreach ($subject_mark as $mark) {
                                                                $grade_gpa = DB::table('sm_marks_grades')->where('percent_from','<=',$mark)->where('percent_upto','>=',$mark)->first();
                                                                $total_grade_point = $total_grade_point + $grade_gpa->gpa;
                                                            }
                                                            if($total_grade_point==0){
                                                                echo '0.00';
                                                            }else{
                                                                if($number_of_subject  == 0){
                                                                    echo '0.00';
                                                                }else{
                                                                    echo number_format((float)$total_grade_point/$number_of_subject, 2, '.', '');
                                                                } 
                                                            }

                                                        ?>
                                                        

                                                    </td> 
                                                    <td>  {{$row->result}} </td>
                                                </tr> 

                                                @endforeach 

                                            </tbody>
                                        </table> 
 

</body>
</html>
    
