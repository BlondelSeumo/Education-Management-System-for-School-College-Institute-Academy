@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Add Class Routine </h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">Dashboard</a>
                <a href="#">Academics</a>
                <a href="{{route('class_routine')}}">Class Routine</a>
                <a href="{{route('class_routine_create')}}">Class Routine Create</a>
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
                    <div class="white-box">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'assign-routine-search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
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
                                <div class="col-lg-4 mt-30-md" id="select_subject_div">
                                    <select class="w-100 bb niceSelect form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" id="select_subject" name="subject">
                                        <option data-display="Select Subject *" value="">Select Subject *</option>
                                    </select>
                                    @if ($errors->has('subject'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('subject') }}</strong>
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
        </div>
    </section>
            

@if(isset($class_routine))

<section class="mt-20">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-6 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">Class Routine</h3>
                </div>
            </div>
        </div>


    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'assign-routine-store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }} 
    <input type="hidden" name="class_id" value="{{$class_id}}">
    <input type="hidden" name="section_id" value="{{$section_id}}">
    <input type="hidden" name="subject_id" value="{{$subject_id}}"> 
        <div class="row">
            <div class="col-lg-12">
                <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="10%">Day</th>
                            <th width="30%">Start Time</th>
                            <th width="30%">End Time</th>
                            <th width="30%">Room Number</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                        <tr>
                            <td>Monday</td>
                            <td>
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input time" type="text" placeholder="Start Time" name="monday_start_from" value="{{isset($class_routine->monday_start_from)? $class_routine->monday_start_from:''}}">
                                            <span class="focus-border"></span>
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
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input time" type="text" placeholder="End Time" name="monday_end_to" value="{{isset($class_routine->monday_end_to)? $class_routine->monday_end_to:''}}">
                                            <span class="focus-border"></span>
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
                                            <input class="primary-input" type="text" placeholder="Enter Room Number" name="monday_room" value="{{isset($class_routine->monday_room_id)? $class_routine->monday_room_id:''}}">
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tuesday</td>
                            <td>
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input time" type="text" placeholder="Start Time" name="tuesday_start_from" value="{{isset($class_routine->tuesday_start_from)? $class_routine->tuesday_start_from:''}}">
                                            <span class="focus-border"></span>
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
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input time" type="text" placeholder="End Time" name="tuesday_end_to" value="{{isset($class_routine->tuesday_end_to)? $class_routine->tuesday_end_to:''}}">
                                            <span class="focus-border"></span>
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
                                            <input class="primary-input" type="text" placeholder="Enter Room Number" name="tuesday_room" value="{{isset($class_routine->tuesday_room_id)? $class_routine->tuesday_room_id:''}}">
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Wednesday</td>
                            <td>
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input time" type="text" placeholder="Start Time" name="wednesday_start_from" value="{{isset($class_routine->wednesday_start_from)? $class_routine->wednesday_start_from:''}}">
                                            <span class="focus-border"></span>
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
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input time" type="text" placeholder="End Time" name="wednesday_end_to" value="{{isset($class_routine->wednesday_end_to)? $class_routine->wednesday_end_to:''}}">
                                            <span class="focus-border"></span>
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
                                            <input class="primary-input" type="text" placeholder="Enter Room Number" name="wednesday_room" value="{{isset($class_routine->wednesday_room_id)? $class_routine->wednesday_room_id:''}}">
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Thursday</td>
                            <td>
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input time" type="text" placeholder="Start Time" name="thursday_start_from" value="{{isset($class_routine->thursday_start_from)? $class_routine->thursday_start_from:''}}">
                                            <span class="focus-border"></span>
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
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input time" type="text" placeholder="End Time" name="thursday_end_to" value="{{isset($class_routine->thursday_end_to)? $class_routine->thursday_end_to:''}}">
                                            <span class="focus-border"></span>
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
                                            <input class="primary-input" type="text" placeholder="Enter Room Number" name="thursday_room" value="{{isset($class_routine->thursday_room_id)? $class_routine->thursday_room_id:''}}">
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Friday</td>
                            <td>
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input time" type="text" placeholder="Start Time" name="friday_start_from" value="{{isset($class_routine->friday_start_from)? $class_routine->friday_start_from:''}}">
                                            <span class="focus-border"></span>
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
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input time" type="text" placeholder="End Time" name="friday_end_to" value="{{isset($class_routine->friday_end_to)? $class_routine->friday_end_to:''}}">
                                            <span class="focus-border"></span>
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
                                            <input class="primary-input" type="text" placeholder="Enter Room Number" name="friday_room" value="{{isset($class_routine->friday_room_id)? $class_routine->friday_room_id:''}}">
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Saturday</td>
                            <td>
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input time" type="text" placeholder="Start Time" name="saturday_start_from" value="{{isset($class_routine->saturday_start_from)? $class_routine->saturday_start_from:''}}">
                                            <span class="focus-border"></span>
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
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input time" type="text" placeholder="End Time" name="saturday_end_to" value="{{isset($class_routine->saturday_end_to)? $class_routine->saturday_end_to:''}}">
                                            <span class="focus-border"></span>
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
                                            <input class="primary-input" type="text" placeholder="Enter Room Number" name="saturday_room" value="{{isset($class_routine->saturday_room_id)? $class_routine->saturday_room_id:''}}">
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Sunday</td>
                            <td>
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input time" type="text" placeholder="Start Time" name="sunday_start_from" value="{{isset($class_routine->sunday_start_from)? $class_routine->sunday_start_from:''}}">
                                            <span class="focus-border"></span>
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
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input time" type="text" placeholder="End Time" name="sunday_end_to" value="{{isset($class_routine->sunday_end_to)? $class_routine->sunday_end_to:''}}">
                                            <span class="focus-border"></span>
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
                                            <input class="primary-input" type="text" placeholder="Enter Room Number" name="sunday_room" value="{{isset($class_routine->sunday_room_id)? $class_routine->sunday_room_id:''}}">
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
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
