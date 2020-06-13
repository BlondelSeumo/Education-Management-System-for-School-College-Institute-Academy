@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Examinations </h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">Dashboard</a>
                <a href="#">Examinations</a>
                <a href="{{url('exam')}}">Exam</a>
                <a href="{{route('exam_schedule')}}">Exam Schedule</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
           
            <div class="row mt-40">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-0">{{$exam->name}} Exam Status</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <table id="" class="school-table-data school-table shadow-none" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Class(Section)</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                           @foreach($view_exams as $view_exam)
                            <tr>
                                <td width="85%">{{$view_exam->class !=""?$view_exam->class->class_name:" "}} ({{$view_exam->section !=""?$view_exam->section->section_name:""}})</td>
                                <td width="15%">
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            Select
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item modalLink" title="Exam {{$exam->name}}" data-modal-size="large-modal" href="{{route('view_exam_schedule', [$view_exam->class_id,$view_exam->section_id, $view_exam->id])}}">View</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</section>

@endsection
