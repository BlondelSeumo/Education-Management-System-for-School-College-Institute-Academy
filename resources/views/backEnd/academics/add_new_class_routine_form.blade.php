<script src="{{asset('public/backEnd/')}}/js/main.js"></script>

<div class="container-fluid">
    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'add-new-class-routine-store',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'myForm', 'onsubmit' => "return validateAddNewroutine()"]) }}
        <div class="row">
            <div class="col-lg-12">
                

                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                <input type="hidden" name="day" id="day" value="{{$day}}">
                <input type="hidden" name="class_time_id" id="class_time_id" value="{{$class_time_id}}">
                <input type="hidden" name="class_id" id="class_id" value="{{$class_id}}">
                <input type="hidden" name="section_id" id="section_id" value="{{$section_id}}">


                <input type="hidden" name="update_teacher_id" id="update_teacher_id" value="{{isset($teacher_detail)? $teacher_detail->id:''}}">

                @if(isset($assigned_id))
                    <input type="hidden" name="assigned_id" id="assigned_id" value="{{$assigned_id}}">
                @endif

                <div class="row mt-25">
                    <div class="col-lg-12 mt-30-md">
                        <select class="w-100 bb niceSelect form-control" name="subject" id="subject" onchange="changeSubject()">
                            <option data-display="@lang('lang.select') @lang('lang.subject') *" value="">@lang('lang.select') @lang('lang.subject') *</option>
                            @foreach($subjects as $subject)
                                @if(!in_array($subject->subject_id, $assinged_subject))
                                <option value="{{$subject->subject_id}}" {{isset($subject_id)? ($subject_id == $subject->subject_id?'selected':''):''}}>{{$subject->subject->subject_name}}</option>
                                @endif
                            @endforeach
                        </select>
                        <span class="text-danger" role="alert" id="subject_error">
                        </span>
                        
                    </div>
                </div>
                <div class="row mt-25">
                    <div class="col-lg-12 mt-30-md">
                        <div class="input-effect">

                         <input name="teacher_name" class="primary-input" type="text" readonly="true" id="teacher_name" value="{{isset($teacher_detail)? $teacher_detail->full_name:''}}">

                         <input name="teacher_id" class="primary-input" type="hidden" readonly="true" id="teacher_id"  value="{{isset($teacher_detail)? $teacher_detail->id:''}}">

                         <span class="focus-border"></span>
                         <label>@lang('lang.teacher') <span>*</span></label>
                        <span class="text-danger" role="alert" id="teacher_error">
                        </span>
                     </div>
                        
                    </div>
                </div>
                <div class="row mt-25">
                    <div class="col-lg-12 mt-30-md">
                        <select class="w-100 bb niceSelect form-control" name="room" id="room">
                            <option data-display="@lang('lang.select') @lang('lang.room') *" value="">@lang('lang.select') @lang('lang.room') *</option>
                            @foreach($rooms as $room)
                                @if(!in_array($room->id, $assinged_room))
                                <option value="{{$room->id}}" {{isset($room_id)? ($room_id == $room->id?'selected':''):''}}>{{$room->room_no}}</option>
                                @endif
                            @endforeach
                        </select>
                        <span class="text-danger" role="alert" id="room_error">
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 text-center mt-40">
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>

                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.save') @lang('lang.information')</button>
                </div>
            </div>
        </div>
    {{ Form::close() }}
</div>
