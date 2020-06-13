

<div class="container-fluid">
    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'add-exam-routine-store',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'myForm', 'onsubmit' => "return validateAddNewExamRoutine()"]) }}
        <div class="row">
            <div class="col-lg-12">
                

                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                <input type="hidden" name="exam_period_id" id="exam_period_id" value="{{$exam_period_id}}">
                <input type="hidden" name="class_id" id="class_id" value="{{$class_id}}">
                <input type="hidden" name="section_id" id="section_id" value="{{$section_id}}">
                <input type="hidden" name="exam_term_id" id="exam_term_id" value="{{$exam_term_id}}">
                <input type="hidden" name="subject_id" id="subject_id" value="{{$subject_id}}">


                <input type="hidden" name="date_error_count" id="date_error_count" value="">

                <input type="hidden" name="assigned_id" id="assigned_id" value="{{isset($assigned_exam)? $assigned_exam->id:''}}">


                <span class="text-success" role="alert" id="holiday_message">
                </span>

                <div class="row no-gutters input-right-icon mt-35">
                    <div class="col">
                        <div class="input-effect">
                            <input class="primary-input date" id="startDate" type="text" name="date" onkeyup="examRoutineCheck()" value="{{isset($assigned_exam)? date('m/d/Y', strtotime($assigned_exam->date)):''}}" readonly="true">
                                <label>Date</label>
                            <span class="focus-border"></span>
                            <span class="text-danger" role="alert" id="date_error">
                            </span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button class="" type="button">
                            <i class="ti-calendar" id="start-date-icon"></i>
                        </button>
                    </div>
                </div>
                
                <div class="row mt-25">
                    <div class="col-lg-12 mt-30-md">
                        <select class="w-100 bb niceSelect form-control" name="room" id="room">
                            <option data-display="Select room *" value="">Select room *</option>
                            @foreach($rooms as $room)
                                <option value="{{$room->id}}" {{isset($assigned_exam)? ($assigned_exam->room_id == $room->id? 'selected':''):''}}>{{$room->room_no}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" role="alert" id="room_error">
                        </span>
                    </div>
                </div>
            </div>


            <!-- <div class="col-lg-12 text-center mt-40">
                <button class="primary-btn fix-gr-bg" id="save_button_sibling" type="button">
                    <span class="ti-check"></span>
                    save information
                </button>
            </div> -->
            <div class="col-lg-12 text-center mt-40">
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancel</button>

                    <button class="primary-btn fix-gr-bg" type="submit">save information</button>
                </div>
            </div>
        </div>
    {{ Form::close() }}
</div>
<script src="{{asset('public/backEnd/')}}/js/main.js"></script>