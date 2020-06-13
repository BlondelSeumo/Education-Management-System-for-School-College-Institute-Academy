<script src="{{asset('public/backEnd/')}}/js/main.js"></script>

<?php

$start = strtotime($leaveDetails->leave_from);
$end = strtotime($leaveDetails->leave_to);

$days_between = ceil(abs($end - $start) / 86400);
$days = $days_between + 1;
?>
<div class="container-fluid">
<div class="student-details">
    <div class="row">
        <div class="{{isset($apply)? 'col-md-12':'col-md-8'}}">
            <div class="student-meta-box">
                <div class="single-meta">
                    <div class="row">
                        <div class="col-lg-2 col-md-5">
                            <div class="value text-left">
                                Leave Type
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-7">
                            <div class="name">
                                @if($leaveDetails->leaveDefine !="" && $leaveDetails->leaveDefine->leaveType !="")
                                        {{$leaveDetails->leaveDefine->leaveType->type}}
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-5">
                            <div class="value text-left">
                                Duration
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-7">
                            <div class="name">
                            {{$days == 1? $days.' day': $days.' days'}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="single-meta">
                    <div class="row">
                        <div class="col-lg-2 col-md-5">
                            <div class="value text-left">
                                Leave From
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-7">
                            <div class="name">
                               

 {{$leaveDetails->leave_from != ""? App\SmGeneralSettings::DateConvater($leaveDetails->leave_from):''}}

                            </div>
                        </div>
                        <div class="col-lg-2 col-md-5">
                            <div class="value text-left">
                                Leave To
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-7">
                            <div class="name">
                          
{{$leaveDetails->leave_to != ""? App\SmGeneralSettings::DateConvater($leaveDetails->leave_to):''}}


                            </div>
                        </div>
                    </div>
                </div>

                <div class="single-meta">
                    <div class="row">
                        <div class="col-lg-2 col-md-5">
                            <div class="value text-left">
                                Apply Date
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-7">
                            <div class="name"> 
{{$leaveDetails->apply_date != ""? App\SmGeneralSettings::DateConvater($leaveDetails->apply_date):''}}


                            </div>
                        </div>
                        
                </div>
            </div>
            <div class="single-meta">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="value text-left">
                            Reason
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-10">
                        <div class="name">
                            {{$leaveDetails->reason}}
                        </div>
                    </div>
                </div>
            </div>


            @if(!isset($apply))

            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'update-approve-leave',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        <input type="hidden" name="id" value="{{$leaveDetails->id}}">
            <div class="single-meta mt-40">
                <div class="row">
                    <div class="col-lg-2 col-md-5">
                        <div class="value text-left">
                            Leave Status
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-7">
                        <div class="d-flex radio-btn-flex flex-column">
                            <div class="">
                                <input type="radio" name="approve_status"  value="P" class="common-radio" id="P" {{$leaveDetails->approve_status == "P"? 'checked':''}}>
                                <label for="P">Pending</label>
                                
                            </div>
                            <div class="">
                                <input type="radio" name="approve_status"  value="A" class="common-radio" id="A" {{$leaveDetails->approve_status == "A"? 'checked':''}}>
                                <label for="A">Approve</label>
                                
                            </div>
                           <div class="">
                                <input type="radio" name="approve_status"  value="C" class="common-radio" id="C" {{$leaveDetails->approve_status == "C"? 'checked':''}}>
                                <label for="C">Cancel</label>
                               
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-meta mt-30">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <button class="primary-btn fix-gr-bg">
                            <span class="ti-check"></span>
                            Save leave Status
                        </button>
                    </div>
                       
                </div>
            </div>
            {{ Form::close() }}
            @endif
        </div>
        </div>
        @if(!isset($apply))
        <div class="col-md-4">
                <!-- Start Student Meta Information -->
                <div class="student-meta-box">
                    <h5 class="mt-20 mb-20">Staff Details</h5>
                    <div class="white-box-modal radius-t-y-0">

                        <div class="single-meta mt-10">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Staff Name
                                </div>
                                <div class="value">
                                    {{$leaveDetails->staffs != ""? $leaveDetails->staffs->full_name:''}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Staff No
                                </div>
                                <div class="value">
                                    {{$leaveDetails->staffs != ""? $leaveDetails->staffs->staff_no:''}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Joining Date
                                </div>
                                <div class="value">
                                   
{{$leaveDetails->staffs->date_of_joining != ""? App\SmGeneralSettings::DateConvater($leaveDetails->staffs->date_of_joining):''}}


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="leave-details">
                    <h5 class="mt-20 mb-20">Leave Details</h5>
                            <table class="display school-table school-table-style-modal" cellspacing="0" width="100%">

                            <thead>
                                
                                <tr>
                                    <th>Type</th>
                                    <th>Remaining Days</th>
                                    <th>Extra Taken</th>
                                    <th>Total Days</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach($staff_leaves as $staff_leave)
                            @php

                            $approved_leaves = App\SmLeaveRequest::approvedLeaveModal($staff_leave->id, $leaveDetails->role_id, $leaveDetails->staff_id);
                                $remaining_days = $staff_leave->days - $approved_leaves;
                            @endphp
                            <tr>
                                <td>{{$staff_leave->leaveType->type}}</td>
                                <td>{{$remaining_days >= 0? $remaining_days:0}}</td>

                                <td>{{$remaining_days < 0? $approved_leaves - $staff_leave->days:0}}</td>
                                <td>{{$staff_leave->days}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- End Student Meta Information -->

        </div>
        @endif
    </div>
    
</div>
</div>


<!-- <div class="col-lg-12 text-center mt-40">
    <div class="mt-40 d-flex justify-content-between">
        <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancel</button>

        <button class="primary-btn fix-gr-bg" id="" data-dismiss="modal" type="button">save information</button>
    </div>
</div> -->
