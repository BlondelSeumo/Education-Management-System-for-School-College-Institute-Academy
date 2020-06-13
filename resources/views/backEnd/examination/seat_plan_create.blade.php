@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Examinations </h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">Dashboard</a>
                <a href="#">Examinations</a>
                <a href="{{route('seat_plan')}}">Seat Plan</a>
                <a href="{{route('seat_plan_create')}}">Assign Students </a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-6">
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
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'seat_plan_search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                        <div class="row">
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                            <div class="col-lg-2 mt-30-md">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('exam') ? ' is-invalid' : '' }}" name="exam">
                                    <option data-display="Select Exam *" value="">Select Exam *</option>
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
                            <div class="col-lg-2 mt-30-md">
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
                            <div class="col-lg-2 mt-30-md" id="select_section_div">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_section" id="select_section" name="section">
                                    <option data-display="Select section *" value="">Select section *</option>
                                    @if(isset($section_id))
                                        <option value="" selected>@php $section = App\SmSection::select('section_name')->where('id', $section_id)->first();
                                echo $section->section_name; @endphp</option>
                                    @endif
                                </select>
                                @if ($errors->has('section'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('section') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-2 mt-30-md" id="select_subject_div">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" id="select_subject" name="subject">
                                    <option data-display="Select Subject *" value="">Select Subject *</option>
                                    @if(isset($subject_id))
                                        <option value="" selected>@php $subject = App\SmSubject::select('subject_name')->where('id', $subject_id)->first(); echo $subject->subject_name; @endphp</option>
                                    @endif
                                </select>
                                @if ($errors->has('subject'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-4 mt-30-md">
                                <div class="no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date" id="startDate" type="text" name="date" value="{{isset($date)? date('m/d/Y', strtotime($date)):date('m/d/Y')}}" readonly="true">
                                                <label>Date</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="start-date-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            
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
    </div>
</section>

@if(isset($students))
<section class="mt-40">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6">
                <div class="main-title">
                    <h3 class="mb-30">Assign Exam Room</h3>
                </div>
            </div>
            <div class="col-lg-6 text-right">
                <button class="primary-btn icon-only fix-gr-bg">
                    <span class="ti-plus" id="addNewRoom"></span>
                </button>
            </div>
        </div>
        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'seat_plan_store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'seat_plan_store']) }}
        <input type="hidden" name="exam_id" value="{{$exam_id}}">
        <input type="hidden" name="subject_id" value="{{$subject_id}}">
        <input type="hidden" name="class_id" value="{{$class_id}}">
        <input type="hidden" name="section_id" value="{{$section_id}}">
        <input type="hidden" name="exam_date" value="{{$date}}" id="exam_date">
        <div class="row">
            <div class="col-lg-12">
                <table class="display school-table school-table-style" cellspacing="0" width="100%" id="assign_exam_room">
                    <thead>
                        <tr>
                            <th width="10%">Total Students</th>
                            <th width="15%">Start Time</th>
                            <th width="15%">End Time</th>
                            <th width="15%">Room No</th>
                            <th width="10%">Capacity</th>
                            <th width="10%">Assign Student No.</th>
                            <th width="10%" class="text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(count($seat_plan_assign_childs) == 0)
                        <tr id="1">
                            
                            <td>{{$students->count()}} <input type="hidden" name="total_student" id="total_student" value="{{$students->count()}}"></td>

                            <td>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input time form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{date('h:i a')}}">
                                            <label>Start Time</label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('start_time'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('start_time') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-timer"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row no-gutters input-right-icon mt-25">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input time  form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" type="text" name="end_time" id="end_time"  value="{{date('h:i a')}}">
                                                <label>End time</label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('end_time'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('end_time') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-timer"></i>
                                            </button>
                                        </div>
                                    </div>
                            </td>

                            <td>
                               <div class="row">
                                    <div class="col">
                                        <div class="input-effect">
                                            <select class="w-100 bb niceSelect class_room room_select" name="room[]" id="room_1">
                                                <option data-display="Select *" value="">Select *</option>
                                                @foreach($class_rooms as $class_room)
                                                    @if(!in_array($class_room->id, $fill_uped))
                                                        <option value="{{$class_room->id}}">{{$class_room->room_no}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <span id="room_error-1" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input capacity" placeholder="Room Capacity" type="text" name="capacity[]" id="capacity-1" readonly>
                                            <input type="hidden" name="already_assigned" id="already_assigned-{{1}}">
                                            <input type="hidden" name="room_capacity" id="room_capacity-{{1}}">
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input assign_student assign_student_input" type="text" name="assign_student[]" id="assign_student-1">
                                            <label>Enter Student No<span></span> </label>
                                            <span class="focus-border"></span>
                                            <span id="assign_student_error-1" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-right">
                                <button class="primary-btn icon-only fix-gr-bg" type="button">
                                    <span class="ti-trash text-white"></span>
                                </button>
                            </td>
                        </tr>
                        @else
                        @php $i = 0; @endphp
                            @foreach($seat_plan_assign_childs as $seat_plan_assign_child)
                            @php $i++; @endphp
                                <tr id="{{$i}}">
                                    
                                    <td>{{$i == 1? $students->count(): ''}} <input type="hidden" name="total_student" id="total_student" value="{{$students->count()}}"></td>
                                    <td>
                                        @if($i == 1)
                                        <div class="row no-gutters input-right-icon mt-25">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input time form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{date('h:i a', strtotime($seat_plan_assign_child->start_time))}}">
                                                    <label>Start Time</label>
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('start_time'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('start_time') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="" type="button">
                                                    <i class="ti-timer"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($i == 1)
                                        <div class="row no-gutters input-right-icon mt-25">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input time  form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" type="text" name="end_time" id="end_time"  value="{{date('h:i a', strtotime($seat_plan_assign_child->end_time))}}">
                                                    <label>End time</label>
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('end_time'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('end_time') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="" type="button">
                                                    <i class="ti-timer"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                       <div class="row">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <select class="w-100 bb niceSelect class_room room_select" name="room[]" id="room_{{$i}}">
                                                        <option data-display="Select *" value="">Select *</option>
                                                        @foreach($class_rooms as $class_room)
                                                            @if(!in_array($class_room->id, $fill_uped) || $seat_plan_assign_child->room_id == $class_room->id)
                                                                <option value="{{$class_room->id}}" {{$seat_plan_assign_child->room_id == $class_room->id? 'selected': ''}}>{{$class_room->room_no}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <span id="room_error-{{$i}}" class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    @php
                                        $used_room = App\SmSeatPlanChild::usedRoomCapacity($seat_plan_assign_child->room_id);
                                        $class_room = $seat_plan_assign_child->class_room;
                                        $alreday_assigned = $class_room->capacity - $used_room;
                                    @endphp
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input capacity" type="text" name="capacity[]" id="capacity-{{$i}}" value="Assigned {{$used_room.' of '.$class_room->capacity}}" readonly>
                                                    <input type="hidden" name="already_assigned" id="already_assigned-{{$i}}" value="{{$used_room}}">
                                                    <input type="hidden" name="room_capacity" id="room_capacity-{{$i}}" value="{{$class_room->capacity}}">

                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input assign_student assign_student_input" type="text" placeholder="Enter Student No" name="assign_student[]" id="assign_student-{{$i}}" value="{{$seat_plan_assign_child->assign_students}}">
                                                    <span class="focus-border"></span>
                                                    <span id="assign_student_error-{{$i}}" class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <button class="primary-btn icon-only fix-gr-bg" type="button">
                                        <span class="ti-trash text-white" 
                                        @if($i != 1)
                                        onclick="deleteExamRow({{$i}})"
                                        @endif

                                        "></span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        <tr>
                            <td colspan="7">
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn fix-gr-bg">
                                        <span class="ti-check"></span>
                                        Save
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</section>
@endif
            

@endsection
