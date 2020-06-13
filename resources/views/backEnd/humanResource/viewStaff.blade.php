@extends('backEnd.master')
@section('mainContent')

@php
function showPicName($data){
$name = explode('/', $data);
return $name[4];
}
function showJoiningLetter($data){
$name = explode('/', $data);
return $name[3];
}
function showResume($data){
$name = explode('/', $data);
return $name[3];
}
function showOtherDocument($data){
$name = explode('/', $data);
return $name[3];
}

@endphp
@php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } @endphp
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Human Resource</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">Dashboard</a>
                <a href="{{route('staff_directory')}}">Staff List</a>
            </div>
        </div>
    </div>
</section>
<section class="mb-40 student-details">
    @if(session()->has('message-success'))
    <div class="alert alert-success">
        {{ session()->get('message-success') }}
    </div>
    @elseif(session()->has('message-danger'))
    <div class="alert alert-danger">
        {{ session()->get('message-danger') }}
    </div>
    @endif
    <div class="container-fluid p-0">
        <div class="row">
         <div class="col-lg-3">
            <!-- Start Student Meta Information -->
            <div class="main-title">
                <h3 class="mb-20">Staff Details</h3>
            </div>
            <div class="student-meta-box">
                <div class="student-meta-top"></div>
                @if(!empty($staffDetails->staff_photo))
                <img class="student-meta-img img-100" src="{{asset($staffDetails->staff_photo)}}"  alt="">
                @else
                <img class="student-meta-img img-100" src="{{asset('public/uploads/sample.jpg')}}"  alt="">
                @endif
                <div class="white-box">
                    <div class="single-meta mt-10">
                        <div class="d-flex justify-content-between">
                            <div class="name">
                                Staff Name
                            </div>
                            <div class="value">

                                @if(isset($staffDetails)){{$staffDetails->full_name}}@endif

                            </div>
                        </div>
                    </div>
                    <div class="single-meta">
                        <div class="d-flex justify-content-between">
                            <div class="name">
                                Role 
                            </div>
                            <div class="value">
                               @if(isset($staffDetails)){{$staffDetails->roles->name}}@endif
                           </div>
                       </div>
                   </div>
                   <div class="single-meta">
                    <div class="d-flex justify-content-between">
                        <div class="name">
                            Designation
                        </div>
                        <div class="value">
                           @if(isset($staffDetails)){{ !empty($staffDetails->designations)?$staffDetails->designations->title:''}}@endif
                            
                       </div>
                   </div>
               </div>
               <div class="single-meta">
                <div class="d-flex justify-content-between">
                    <div class="name">
                        Department
                    </div>
                    <div class="value">
                        
                           @if(isset($staffDetails)){{ !empty($staffDetails->departments)?$staffDetails->departments->name:''}}@endif 

                    </div>
                </div>
            </div>
            <div class="single-meta">
                <div class="d-flex justify-content-between">
                    <div class="name">
                        EPF No
                    </div>
                    <div class="value">
                       @if(isset($staffDetails)){{$staffDetails->epf_no}}@endif
                   </div>
               </div>
           </div>
           <div class="single-meta">
            <div class="d-flex justify-content-between">
                <div class="name">
                    Basic Salary
                </div>
                <div class="value">
                    ({{$currency}}) @if(isset($staffDetails)){{$staffDetails->basic_salary}}@endif
                </div>
            </div>
        </div>
        <div class="single-meta">
            <div class="d-flex justify-content-between">
                <div class="name">
                    Contarct Type
                </div>
                <div class="value">
                   @if(isset($staffDetails)){{$staffDetails->contract_type}}@endif
               </div>
           </div>
       </div>
       <div class="single-meta">
        <div class="d-flex justify-content-between">
            <div class="name">
                Date of Joining
            </div>
            <div class="value">
                @if(isset($staffDetails))
               
{{$staffDetails->date_of_joining != ""? App\SmGeneralSettings::DateConvater($staffDetails->date_of_joining):''}}


                @endif
            </div>
        </div>
    </div>
</div>
</div>
<!-- End Student Meta Information -->

</div>

<!-- Start Student Details -->
<div class="col-lg-9 staff-details">
    
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#studentProfile" role="tab" data-toggle="tab">profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#payroll" role="tab" data-toggle="tab">Payroll</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#leaves" role="tab" data-toggle="tab">Leaves</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#staffDocuments" role="tab" data-toggle="tab">documents</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#staffTimeline" role="tab" data-toggle="tab">timeline</a>
        </li>
        <li class="nav-item edit-button">
            <a href="{{url('edit-staff/'.$staffDetails->id)}}" class="primary-btn small fix-gr-bg">@lang('lang.edit')
            </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Start Profile Tab -->
        <div role="tabpanel" class="tab-pane fade show active" id="studentProfile">
            <div class="white-box">
                <h4 class="stu-sub-head">Personal info</h4>
                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="">
                                Mobile No
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="">
                                @if(isset($staffDetails)){{$staffDetails->mobile}}@endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="single-info">
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <div class="">
                               Emergency Mobile
                           </div>
                       </div>

                       <div class="col-lg-7 col-md-7">
                        <div class="">
                         @if(isset($staffDetails)){{$staffDetails->emergency_mobile}}@endif
                     </div>
                 </div>
             </div>
         </div>

         <div class="single-info">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="">
                        Email
                    </div>
                </div>

                <div class="col-lg-7 col-md-7">
                    <div class="">
                        @if(isset($staffDetails)){{$staffDetails->email}}@endif
                    </div>
                </div>
            </div>
        </div>

        <div class="single-info">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="">
                        Gender
                    </div>
                </div>

                <div class="col-lg-7 col-md-7">
                    <div class="">

                        @if(isset($staffDetails)) {{$staffDetails->genders->base_setup_name}} @endif 
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="single-info">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="">
                        Date of Birth
                    </div>
                </div>

                <div class="col-lg-7 col-md-7">
                    <div class="">
                        @if(isset($staffDetails))
                       
{{$staffDetails->date_of_birth != ""? App\SmGeneralSettings::DateConvater($staffDetails->date_of_birth):''}}


                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="single-info">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="">
                       Marital Status
                   </div>
               </div>

               <div class="col-lg-7 col-md-7">
                <div class="">
                    @if(isset($staffDetails)){{$staffDetails->marital_status}}@endif
                </div>
            </div>
        </div>
    </div>

    <div class="single-info">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="">
                    Father Name
                </div>
            </div>

            <div class="col-lg-7 col-md-7">
                <div class="">
                    @if(isset($staffDetails)){{$staffDetails->fathers_name}}@endif
                </div>
            </div>
        </div>
    </div>

    <div class="single-info">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="">
                    Mother Name
                </div>
            </div>

            <div class="col-lg-7 col-md-7">
                <div class="">
                    @if(isset($staffDetails)){{$staffDetails->mothers_name}}@endif
                </div>
            </div>
        </div>
    </div>

    <div class="single-info">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="">
                    Qualification
                </div>
            </div>

            <div class="col-lg-7 col-md-7">
                <div class="">
                    @if(isset($staffDetails)){{$staffDetails->qualification}}@endif
                </div>
            </div>
        </div>
    </div>

    <div class="single-info">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="">
                   Work Experience
               </div>
           </div>

           <div class="col-lg-7 col-md-7">
            <div class="">
                @if(isset($staffDetails)){{$staffDetails->experience}}@endif
            </div>
        </div>
    </div>
</div>

<!-- Start Parent Part -->
<h4 class="stu-sub-head mt-40">Addresses</h4>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                Current Address
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                @if(isset($staffDetails)){{$staffDetails->current_address}}@endif
            </div>
        </div>
    </div>
</div>

<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
             Permanent Address
         </div>
     </div>

     <div class="col-lg-7 col-md-6">
        <div class="">
            @if(isset($staffDetails)){{$staffDetails->permanent_address}}@endif
        </div>
    </div>
</div>
</div>
<!-- End Parent Part -->

<!-- Start Transport Part -->
<h4 class="stu-sub-head mt-40">Bank Account Details</h4>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                Account Name
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                @if(isset($staffDetails)){{$staffDetails->bank_account_name}}@endif
            </div>
        </div>
    </div>
</div>

<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                Acount Number
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                @if(isset($staffDetails)){{$staffDetails->bank_account_no}}@endif
            </div>
        </div>
    </div>
</div>

<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                Bank Name
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                @if(isset($staffDetails)){{$staffDetails->bank_name}}@endif
            </div>
        </div>
    </div>
</div>

<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
               Bank branch Name
           </div>
       </div>

       <div class="col-lg-7 col-md-6">
        <div class="">
            @if(isset($staffDetails)){{$staffDetails->bank_brach}}@endif
        </div>
    </div>
</div>
</div>


<!-- End Transport Part -->

<!-- Start Other Information Part -->
<h4 class="stu-sub-head mt-40">Social Media Link</h4>
<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                Facebook Url 
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                @if(isset($staffDetails)){{$staffDetails->facebook_url}}@endif
            </div>
        </div>
    </div>
</div>

<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                Twitter Url
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                @if(isset($staffDetails)){{$staffDetails->twiteer_url}}@endif
            </div>
        </div>
    </div>
</div>

<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                Linkedin Url
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                @if(isset($staffDetails)){{$staffDetails->linkedin_url}}@endif
            </div>
        </div>
    </div>
</div>

<div class="single-info">
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="">
                Instrgram Url
            </div>
        </div>

        <div class="col-lg-7 col-md-6">
            <div class="">
                @if(isset($staffDetails)){{$staffDetails->instragram_url}}@endif
            </div>
        </div>
    </div>
</div>

<!-- End Other Information Part -->
</div>
</div>
<!-- End Profile Tab -->

<!-- Start payroll Tab -->
<div role="tabpanel" class="tab-pane fade" id="payroll">
    <div class="white-box">
        <table id="" class="table simple-table table-responsive school-table"
        cellspacing="0">
        <thead>
            <tr>
                <th width="5%">Payslip ID</th>
                <th width="20%">Month-Year</th>
                <th width="15%">Date</th>
                <th width="15%">Mode of Payment</th>
                <th width="15%">Net Salary({{$currency}})</th>
                <th width="12%">Status</th>
                <th width="20%">Action</th>
            </tr>
        </thead>

        <tbody>
            @if(count($staffPayrollDetails)>0)
            @foreach($staffPayrollDetails as $value)
            <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->payroll_month}} - {{$value->payroll_year}}</td>
                <td>
                    
{{$value->created_at != ""? App\SmGeneralSettings::DateConvater($value->created_at):''}}

                </td>
                <td><?php $payment_mode = ''; 
                    if(!empty($value->payment_mode)){
                        $payment_mode = App\SmHrPayrollGenerate::getPaymentMode($value->payment_mode);
                    }else{
                        $payment_mode = '';
                    }
                    ?>
                    {{$payment_mode}}
                </td>
                <td>{{$value->net_salary}}</td>
                <td>
                    @if($value->payroll_status == 'G')
                    <button class="primary-btn small bg-warning text-white border-0"> generated</button>
                    @endif

                    @if($value->payroll_status == 'P')
                    <button class="primary-btn small bg-success text-white border-0"> paid </button>
                    @endif
                </td>
                <td>
                    @if($value->payroll_status == 'P')
                    <a class="modalLink" data-modal-size="modal-lg" title="View Payslip Details" href="{{url('view-payslip', $value->id)}}"><button class="primary-btn small tr-bg"> View Payslip</button></a>
                    @endif
                </td>
            </tr>
            @endforeach
            @else
            <tr class="justify-content-center">
                <td colspan="7" class="justify-content-center text-center">No Payroll Data</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
</div>
<!-- End payroll Tab -->

<!-- Start leave Tab -->
<div role="tabpanel" class="tab-pane fade" id="leaves">
    <div class="white-box">
        <div class="row mt-30">
            <div class="col-lg-12">
                <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Leave Type</th>
                            <th>Leave From </th>
                            <th>Leave To</th>
                            <th>Apply Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    {{-- {{ dd($staffLeaveDetails) }} --}}
                    <tbody>
                       @php $diff = ''; @endphp
                       @if(count($staffLeaveDetails)>0)
                       @foreach($staffLeaveDetails as $value)
                       <tr>
                        <td>{{@$value->leaveType->type}}</td>
                        <td>
                            
{{$value->leave_from != ""? App\SmGeneralSettings::DateConvater($value->leave_from):''}}


                        </td>
                        <td>
                           
{{$value->leave_to != ""? App\SmGeneralSettings::DateConvater($value->leave_to):''}}

                        </td>
                        <td>
                            
{{$value->apply_date != ""? App\SmGeneralSettings::DateConvater($value->apply_date):''}}

                        </td>
                        <td>

                            @if($value->approve_status == 'P')
                            <button class="primary-btn small bg-warning text-white border-0"> pending</button>
                            @endif

                            @if($value->approve_status == 'A')
                            <button class="primary-btn small bg-success text-white border-0"> Approved</button>
                            @endif

                            @if($value->approve_status == 'C')
                            <button class="primary-btn small bg-danger text-white border-0"> Cancelled</button>
                            @endif

                        </td>
                        <td>
                            <a class="modalLink" data-modal-size="modal-md" title="View Leave Details" href="{{url('view-leave-details', $value->id)}}"><button class="primary-btn small tr-bg"> View </button></a>
                        </td>
                    </tr>
                    @endforeach
                    @else 
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Not Leaves Data</td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endif 
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!-- End leave Tab -->

<!-- Start Documents Tab -->
<div role="tabpanel" class="tab-pane fade" id="staffDocuments">
    <div class="white-box">
        <div class="text-right mb-20">
            <button type="button" data-toggle="modal" data-target="#add_document_madal" class="primary-btn tr-bg text-uppercase bord-rad">
                                    upload document
                                    <span class="pl ti-upload"></span>
                                </button>
        </div>
        <table id="" class="table simple-table table-responsive school-table"
        cellspacing="0">
            <thead class="d-block">
                <tr class="d-flex">
                    <th class="col-8">Document Title</th>
                    <th class="col-4">Action</th>
                </tr>
            </thead>

            <tbody class="d-block">
                @if($staffDetails->joining_letter != '')
                <tr class="d-flex">
                    <td class="col-8">Joining Letter</td>
                    <td class="col-4">
                        <a href="{{url('download-staff-joining-letter/'.showJoiningLetter($staffDetails->joining_letter))}}">
                            <button class="primary-btn tr-bg text-uppercase bord-rad">
                                Download
                                <span class="pl ti-download"></span>
                            </button>
                        </a>
                    </td>
                </tr>
                @endif
                @if($staffDetails->resume != '')
                <tr class="d-flex">
                    <td class="col-8">Resume</td>
                    <td class="col-4">
                        <a href="{{url('download-resume/'.showResume($staffDetails->resume))}}">
                            <button class="primary-btn tr-bg text-uppercase bord-rad">
                                Download
                                <span class="pl ti-download"></span>
                            </button>
                        </a>
                    </td>
                </tr>
                @endif
                @if($staffDetails->other_document != '')
                <tr class="d-flex">
                    <td class="col-8">Other Documents</td>
                    <td class="col-4">
                        <a href="{{url('download-other-document/'.showOtherDocument($staffDetails->other_document))}}">
                            <button class="primary-btn tr-bg text-uppercase bord-rad">
                                Download
                                <span class="pl ti-download"></span>
                            </button>
                        </a>
                    </td>
                </tr>
                @endif
                @if(isset($staffDocumentsDetails))
                @foreach($staffDocumentsDetails as $key=>$value)
                <tr class="d-flex">
                    <td class="col-8">{{$value->title}}</td>
                    <td class="col-4">
                        <a class="primary-btn tr-bg text-uppercase bord-rad" href="{{url('download-staff-document/'.showPicName($value->file))}}">
                            Download
                                <span class="pl ti-download"></span>
                        </a>
                        <a class="primary-btn icon-only fix-gr-bg modalLink" title="Delete Document" data-modal-size="modal-md"  href="{{url('delete-staff-document-view/'.$value->student_staff_id)}}">
                        <span class="ti-trash pt-30"></span>
                        </a>
                        
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<!-- End Documents Tab -->

<!-- Add Document modal form start-->
    <div class="modal fade admin-query" id="add_document_madal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload Document</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                   <div class="container-fluid">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'save_upload_document',
                            'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'document_upload']) }}
                            <div class="row">
                                <div class="col-lg-12">
                                <input type="hidden" name="staff_id" value="{{$staffDetails->id}}">
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input class="primary-input form-control" type="text" name="title" id="title" required>
                                                <label>Title <span>*</span> </label>
                                                <span class="focus-border"></span>

                                                <span class=" text-danger" role="alert" id="amount_error">

                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-30">
                                    <div class="row no-gutters input-right-icon mt-35">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input" id="placeholderInput" type="text"
                                                       placeholder="New Document"
                                                       readonly>
                                                <span class="focus-border"></span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg"
                                                       for="browseFile">@lang('lang.browse')</label>
                                                <input type="file" class="d-none" id="browseFile" name="staff_upload_document" required>
                                            </button>
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

                                            <button class="primary-btn fix-gr-bg" type="submit">save</button>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                              
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Add Document modal form end-->

<!-- Start Timeline Tab -->

           

            <div role="tabpanel" class="tab-pane fade" id="staffTimeline">
                <div class="white-box">
                    <div class="text-right mb-20">
                    <button type="button" data-toggle="modal" data-target="#add_timeline_madal" class="primary-btn tr-bg text-uppercase bord-rad">
                                    add
                                    <span class="pl ti-plus"></span>
                                </button>
                    </div>
                    @if(isset($timelines))
                    @foreach($timelines as $timeline)
                    <div class="student-activities">
                        <div class="single-activity">
                            <h4 class="title text-uppercase">
                                
{{$timeline->date != ""? App\SmGeneralSettings::DateConvater($timeline->date):''}}


                            </h4>
                            <div class="sub-activity-box d-flex">
                                <h6 class="time text-uppercase">{{date('h:i a', strtotime($timeline->created_at))}}</h6>
                                <div class="sub-activity">
                                    <h5 class="subtitle text-uppercase"> {{$timeline->title}}</h5>
                                    <p>
                                        {{$timeline->description}}
                                    </p>
                                </div>

                                <div class="close-activity">
                                    
                                    <a class="primary-btn icon-only fix-gr-bg modalLink" title="Delete Timeline" data-modal-size="modal-md"  href="{{url('delete-staff-timeline-view/'.$timeline->id)}}">
                                        <span class="ti-trash"></span>
                                    </a>
                                    @if($timeline->file != "")
                                    <a href="{{url('download-staff-timeline-doc/'.showPicName($timeline->file))}}" class="primary-btn tr-bg text-uppercase bord-rad">
                                        Download<span class="pl ti-download"></span>
                                    </a>
                                    @endif
                                </div>
                            </div>
                          </div>
                       @endforeach
                       @endif
                      </div>
                    </div>
                </div>
            </div>
        </div>
         <!-- End Timeline Tab -->
         <!-- timeline form modal start-->
        <div class="modal fade admin-query" id="add_timeline_madal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Timeline</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                       <div class="container-fluid">
                                                
                             {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'staff_timeline_store',
                             'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'document_upload']) }}
                             <div class="row">
                                <div class="col-lg-12">
                                    <input type="hidden" name="staff_student_id" value="{{$staffDetails->id}}">
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input class="primary-input form-control{" type="text" name="title" value="" id="title" required>
                                                <span class="focus-border"></span>
                                                <label>Title <span>*</span> </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-30">
                                    <div class="no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" id="startDate" type="text"
                                                name="date" autocomplete="off" value="{{date('m/d/Y')}}" required>
                                                <span class="focus-border"></span>
                                                <label>Date <span>*</span> </label>
                                                @if ($errors->has('date_of_birth'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('date_of_birth') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-30">
                                    <div class="input-effect">
                                        <textarea class="primary-input form-control" cols="0" rows="3" name="description" id="Description" required></textarea>
                                        <label>Description<span></span> </label>
                                        <span class="focus-border textarea"></span>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-30">
                                    <div class="row no-gutters input-right-icon mt-35">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input" id="placeholderFileFourName" type="text"
                                                       placeholder="Document"
                                                       readonly>
                                                <span class="focus-border"></span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg"
                                                       for="document_file_4">@lang('lang.browse')</label>
                                                <input type="file" class="d-none" id="document_file_4" name="document_file_4">
                                            </button>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12 mt-30">

                                    <input type="checkbox" id="currentAddressCheck" class="common-checkbox" name="visible_to_student" value="1">
                                    <label for="currentAddressCheck">Visible to this person</label>
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

                                        <button class="primary-btn fix-gr-bg" type="submit">save</button>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
<!-- timeline form modal end-->
    </div>
</div>
</section>
@endsection
