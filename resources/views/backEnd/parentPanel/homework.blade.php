@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Homework List</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">Dashboard</a>
                <a href="#">Homework</a>
                <a href="#">Homework List</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
 
    <div class="row mt-40">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-0">Homework List</h3>
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
                                <td colspan="9">
                                     @if(session()->has('message-success'))
                                      <div class="alert alert-success">
                                          {{ session()->get('message-success') }}
                                      </div>
                                    @elseif(session()->has('message-danger'))
                                      <div class="alert alert-danger">
                                          {{ session()->get('message-danger') }}
                                      </div>
                                    @endif
                                </td>
                            </tr>
                             @endif
                            
                            <tr>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Subject</th>
                                <th>Marks</th>
                                <th>Homework date</th>
                                <th>submission Date</th>
                                <th>Evaluation Date</th>
                                <th>Obtained Marks</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($homeworkLists as $value)
                            @php 
                               $student_result = App\SmHomework::evaluationHomework($student_detail->id, $value->id);
                            @endphp
                          
                            <tr>
                                <td>{{$value->classes  !=""?$value->classes->class_name:""}}</td>
                                <td>{{$value->sections !=""?$value->sections->section_name:""}}</td>
                                <td>{{$value->subjects !=""?$value->subjects->subject_name:""}}</td>
                                <td>{{$value->marks}}</td>
                                 <td  data-sort="{{strtotime($value->homework_date)}}" >
                                   {{$value->homework_date != ""? App\SmGeneralSettings::DateConvater($value->homework_date):''}}
                                </td>
                                 <td  data-sort="{{strtotime($value->submission_date)}}" >{{$value->submission_date != ""? App\SmGeneralSettings::DateConvater($value->submission_date):''}}</td>
                                <td  data-sort="{{strtotime($value->evaluation_date)}}" >
                                @if(!empty($value->evaluation_date))
                               {{$value->evaluation_date != ""? App\SmGeneralSettings::DateConvater($value->evaluation_date):''}}

                                @endif
                                </td>

                                
                               <td>{{$student_result != ""? $student_result->marks:''}}</td>
                                <td>
                                    @if($student_result != "")
                                        
                                        @if($student_result->complete_status == "C")
                                        <button class="primary-btn small bg-success text-white border-0">Completed</button>
                                        @else
                                        <button class="primary-btn small bg-warning text-white border-0">Incompleted</button>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            Select
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">

                                         <a class="dropdown-item modalLink" title="Homework View" data-modal-size="modal-lg" href="{{route('parent_homework_view', [$value->class_id, $value->section_id, $value->id])}}">View</a>
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
    </div>
    </div>
</section>
@endsection
