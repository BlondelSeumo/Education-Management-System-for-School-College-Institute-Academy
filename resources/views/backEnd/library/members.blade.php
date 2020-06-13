@extends('backEnd.master')
@section('mainContent')
<style type="text/css">
    #selectStaffsDiv, .forStudentWrapper{
        display: none;
    }
</style>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.add_member')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.library')</a>
                <a href="#">@lang('lang.add_member')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($editData))
         @if(in_array(309, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
           
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('library-member')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.add')
                </a>
            </div>
        </div>
        @endif
        @endif
        <div class="row">
             
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">@if(isset($editData))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.member')
                            </h3>
                        </div>
                        @if(isset($editData))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'holiday/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                        @else
                        @if(in_array(309, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'library-member',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        @endif
                        @endif
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    @if(session()->has('message-success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message-success') }}
                                    </div>
                                    @elseif(session()->has('message-danger'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('message-danger') }}
                                    </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                {{ $error }}
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="col-lg-12 mb-30">
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('member_type') ? ' is-invalid' : '' }}" name="member_type" id="member_type">
                                            <option data-display=" @lang('lang.member_type') *" value="">@lang('lang.member_type') *</option>
                                            @foreach($roles as $value)
                                            @if(isset($editData))
                                            <option value="{{$value->id}}" {{$value->id == $editData->role_id? 'selected':''}}>{{$value->name}}</option>
                                            @else
                                            <option value="{{$value->id}}">{{$value->name}}</option>

                                            @endif

                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="forStudentWrapper col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-12 mb-30">
                                                <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                                    <option data-display="@lang('lang.select_class')" value="">@lang('lang.select_class')*</option>
                                                    @foreach($classes as $class)
                                                    <option value="{{$class->id}}"  {{( old("class") == $class->id ? "selected":"")}}>{{$class->class_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-lg-12 mb-30" id="select_section__member_div">
                                                <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }}" id="select_section_member" name="section">
                                                    <option data-display="@lang('lang.select_section')" value="">@lang('lang.select_section') *</option>
                                                </select>
                                            </div>


                                            <div class="col-lg-12 mb-30" id="select_student_div">
                                                <select class="w-100 bb niceSelect form-control{{ $errors->has('student') ? ' is-invalid' : '' }}" id="select_student" name="student">
                                                    <option data-display="@lang('lang.select_student') *" value="">@lang('lang.select_student') *</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-30" id="selectStaffsDiv">
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('staff_id') ? ' is-invalid' : '' }}" name="staff" id="selectStaffs">
                                            <option data-display="@lang('lang.name') *" value="">@lang('lang.name') *</option>

                                            @if(isset($staffsByRole))
                                            @foreach($staffsByRole as $value)
                                            <option value="{{$value->id}}" {{$value->id == $editData->staff_id? 'selected':''}}>{{$value->full_name}}</option>
                                            @endforeach
                                            @else

                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-lg-12 mb-30">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('member_ud_id') ? ' is-invalid' : '' }}"
                                            type="text" name="member_ud_id" autocomplete="off" value="{{isset($content_title)? $leave_type->type:''}}">
                                            <label>@lang('lang.member') @lang('lang.id') <span>*</span> </label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>

                                    <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">

                                </div>
  @php 
                                  $tooltip = "";
                                  if(in_array(309, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                            <span class="ti-check"></span>

                                            @if(isset($editData))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                            @lang('lang.member')

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
              <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-0">@lang('lang.member') @lang('lang.list')</h3>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                        <thead>
                            @if(session()->has('message-success-delete') != "" ||
                                session()->get('message-danger-delete') != "")
                            <tr>
                                <td colspan="6">
                                     @if(session()->has('message-success-delete'))
                                      <div class="alert alert-success">
                                          {{ session()->get('message-success-delete') }}
                                      </div>
                                    @elseif(session()->has('message-danger-delete'))
                                      <div class="alert alert-danger">
                                          {{ session()->get('message-danger-delete') }}
                                      </div>
                                    @endif
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <th>@lang('lang.name')</th>
                                <th>@lang('lang.member_type')</th>
                                <th>@lang('lang.member') @lang('lang.id')</th>
                                <th>@lang('lang.email')</th>
                                <th>@lang('lang.mobile')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(isset($libraryMembers))
                            @foreach($libraryMembers as $value)
                            <tr>
                                <td>
                                    <?php
                                    if($value->member_type == '2'){
                                        if(!empty($value->studentDetails) && !empty($value->studentDetails->full_name)) { echo $value->studentDetails->full_name; }
                                    }elseif($value->member_type == '3'){ 
                                        if(!empty($value->parentsDetails) && !empty($value->parentsDetails->fathers_name)) { echo $value->parentsDetails->fathers_name; }
                                    }else{ 
                                        if(!empty($value->staffDetails) && !empty($value->staffDetails->full_name)) { echo $value->staffDetails->full_name; }
                                    }

                                    ?>

                                </td>
                                <td>{{!empty($value->roles)?$value->roles->name:''}}</td>
                                <td>{{$value->member_ud_id}}</td>
                                <td>
                                 <?php
                                 if($value->member_type == '2'){
                                    if(!empty($value->studentDetails) && !empty($value->studentDetails->email)) {   echo $value->studentDetails->email;}
                                }elseif($value->member_type == '3'){
                                   if(!empty($value->parentsDetails) && !empty($value->parentsDetails->fathers_email)) { echo $value->parentsDetails->fathers_email;}
                                }else{
                                   if(!empty($value->staffDetails) && !empty($value->staffDetails->email)) {  echo $value->staffDetails->email;
                                }
                                }

                                ?>

                            </td>
                            <td>
                             <?php
                             if($value->member_type == '2'){
                                    if(!empty($value->staffDetails) && !empty($value->studentDetails->mobile)) {   echo $value->studentDetails->mobile;}
                            }elseif($value->member_type == '3'){
                                   if(!empty($value->parentsDetails) && !empty($value->parentsDetails->fathers_mobile)) {   echo $value->parentsDetails->fathers_mobile; }
                            }else{
                                   if(!empty($value->staffDetails) && !empty($value->staffDetails->mobile)) {  echo $value->staffDetails->mobile; }
                            }

                            ?>
                        </td>
                        <td>
                            <div class="dropdown">
 @if(in_array(310, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                            <a class="primary-btn fix-gr-bg" href="{{url('cancel-membership/'.$value->id)}}">Cancel Membership</a> 
                         @endif  
                        </div>
                        </td>
                    </tr>

                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
</section>
@endsection
