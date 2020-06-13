@extends('backEnd.master')
@section('mainContent')
@php
    $user = Auth::user()->student;
@endphp
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.online_exam') </h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.online_exam')</a>
                <a href="{{url('student-online-exam')}}">@lang('lang.active_exams')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">@lang('lang.online_active_exams')</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                                @if(session()->has('message-success') != "" ||
                                session()->get('message-danger') != "")
                                <tr>
                                    <td colspan="6">
                                        @if(session()->has('message-success'))
                                        <div class="alert alert-success alert-dismissible fade show"  role="alert">
                                            {{ session()->get('message-success') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @elseif(session()->has('message-danger'))
                                        <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                                            {{ session()->get('message-danger') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <th>@lang('lang.title')</th>
                                    <th>@lang('lang.class_Sec')</th>
                                    <th>@lang('lang.subject')</th>
                                    <th>@lang('lang.exam_date')</th>
                                    <th>@lang('lang.status')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($online_exams as $online_exam)
                                    @php
                                        $submitted_answer = App\SmStudentTakeOnlineExam::submittedAnswer($online_exam->id, $user->id);
                                    @endphp
                                    @if(!in_array($online_exam->id, $marks_assigned))
                                    <tr>
                                        <td>{{$online_exam->title}}</td>
                                        <td>{{$online_exam->class->class_name.'  ('.$online_exam->section->section_name.')'}}</td>
                                        <td>{{$online_exam->subject !=""?$online_exam->subject->subject_name:""}}</td>
                                        <td  data-sort="{{strtotime($online_exam->date)}}" >
                                           {{$online_exam->date != ""? App\SmGeneralSettings::DateConvater($online_exam->date):''}}

                                            <br> Time: {{$online_exam->start_time.' - '.$online_exam->end_time}}</td>
                                        <td>
                                            @if($submitted_answer != "")
                                                @if($submitted_answer->status == 0)
                                                    <a class="btn btn-success" href="{{route("take_online_exam", [$online_exam->id])}}">@lang('lang.take_exam')</a>
                                                @else
                                                    <span class="btn btn-success">Already Submitted</span>
                                                @endif
                                            @else
                                                <a class="btn btn-success" href="{{route("take_online_exam", [$online_exam->id])}}">@lang('lang.take_exam')</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade admin-query" id="deleteOnlineExam" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('lang.delete') @lang('lang.item')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                     {{ Form::open(['url' => 'online-exam-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                     <input type="hidden" name="id" id="online_exam_id">
                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                     {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</div>



@endsection
