@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.assign_class_teacher') </h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.academics')</a>
                <a href="#">@lang('lang.assign_class_teacher')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($assign_class_teacher))
 @if(in_array(254, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1  ) 
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('assign-class-teacher')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.assign')
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
                            <h3 class="mb-30">
                                @if(isset($assign_class_teacher))
                                    @lang('lang.edit')
                                @endif
                                    @lang('lang.assign_class_teacher')
                            </h3>
                        </div>
                        @if(isset($assign_class_teacher))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'assign-class-teacher/'.$assign_class_teacher->id, 'method' => 'PUT']) }}
                        @else
                         @if(in_array(254, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1  ) 
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'assign-class-teacher', 'method' => 'POST']) }}
                        @endif
                        @endif
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                        @if(session()->has('message-success'))
                                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                                              {{ session()->get('message-success') }}
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                        @elseif(session()->has('message-danger'))
                                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                              {{ session()->get('message-danger') }}
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                          </div>
                                        @endif
                                        <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                            <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select_class') *</option>
                                            @foreach($classes as $class)
                                             @if(isset($assign_class_teacher)) 
                                            <option value="{{$class->id}}" {{$class->id == $assign_class_teacher->class_id? 'selected':''}}>{{$class->class_name}}</option>
                                            @else
                                            <option value="{{$class->id}}">{{$class->class_name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('class'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('class') }}</strong>
                                        </span>
                                        @endif

                                        
                                    </div>
                                </div>

                                <input type="hidden" name="id" value="{{isset($assign_class_teacher)? $assign_class_teacher->id: ''}}">

                                <div class="row  mt-40">
                                    <div class="col-lg-12" id="select_section_div">
                                        <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }}" id="select_section" name="section">
                                        <option data-display="@lang('lang.select_section') *" value="">@lang('lang.select_section') *</option>
                                        @if(isset($assign_class_teacher))
                                            @foreach($sections as $section)
                                            <option value="{{$section->id}}" {{$section->id == $assign_class_teacher->section_id? 'selected':''}}>{{$section->section_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('section'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('section') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <label>@lang('lang.teacher') *</label><br>
                                        @foreach($teachers as $teacher)
                                        @if(isset($assign_class_teacher))
                                        <div class="">
                                            <input type="checkbox" id="tecaher{{$teacher->id}}" class="common-checkbox" name="teacher[]" value="{{$teacher->id}}" {{in_array($teacher->id, $teacherId)? 'checked':''}}>
                                            <label for="tecaher{{$teacher->id}}">{{$teacher->full_name}}</label>
                                        </div>
                                        @else
                                        <div class="">
                                            <input type="checkbox" id="tecaher{{$teacher->id}}" class="common-checkbox" name="teacher[]" value="{{$teacher->id}}">
                                            <label for="tecaher{{$teacher->id}}">{{$teacher->full_name}}</label>
                                        </div>
                                        @endif
                                        @endforeach

                                        @if($errors->has('teacher'))
                                            <span class="text-danger validate-textarea-checkbox" role="alert">
                                                <strong>{{ $errors->first('teacher') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                  @php 
                                  $tooltip = "";
                                  if(in_array(254, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            @if(isset($assign_class_teacher))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                            @lang('lang.class_teacher')
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
                            <h3 class="mb-0">@lang('lang.class_teacher') @lang('lang.list')</h3>
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
                                    <td colspan="4">
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
                                    <th>@lang('lang.class')</th>
                                    <th>@lang('lang.section')</th>
                                    <th>@lang('lang.teacher')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assign_class_teachers as $assign_class_teacher)
                                <tr>
                                    <td valign="top">{{$assign_class_teacher->className !=""? $assign_class_teacher->className->class_name:""}}</td>
                                    <td valign="top">{{$assign_class_teacher->section != ""? $assign_class_teacher->section->section_name:""}}</td>
                                    <td valign="top">
                                        
                                            @php
                                              $classTeachers = $assign_class_teacher->classTeachers;

                                            @endphp
                                            @if($classTeachers !="")
                                            @foreach($classTeachers as $classTeacher)
                                           
                                                    @php $teacher = $classTeacher->teacher;

                                                    @endphp
                                                    {{$teacher->full_name}} <br><br>
                                                
                                            @endforeach
                                            @endif


                                        
                                    </td>
                                    
                                    <td valign="top">
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @if(in_array(255, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                                                <a class="dropdown-item" href="{{url('assign-class-teacher/'.$assign_class_teacher->id.'/edit')}}">@lang('lang.edit')</a>
                                               @endif
                                                @if(in_array(256, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteClassModal{{$assign_class_teacher->id}}"  href="{{route('class_delete', [$assign_class_teacher->id])}}">@lang('lang.delete')</a>
                                           @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteClassModal{{$assign_class_teacher->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete')@lang('lang.assign_teacher')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                    {{ Form::open(['url' => 'assign-class-teacher/'.$assign_class_teacher->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
                                                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                                                     {{ Form::close() }}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
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
