@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.class_routine_create')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.academics')</a>
                <a href="#">@lang('lang.class_routine_create')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.select_criteria') </h3>
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
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'class-routine-new', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="col-lg-6 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                        <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select_class') *</option>
                                        @foreach($classes as $class)
                                        <option value="{{$class->id}}"  {{isset($class_id)? ($class_id == $class->id?'selected':''):''}}>{{$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('class'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('class') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-6 mt-30-md" id="select_section_div">
                                    <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }}" id="select_section" name="section">
                                        <option data-display="@lang('lang.select_section') *" value="">@lang('lang.select_section') *</option>
                                    </select>
                                    @if ($errors->has('section'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('section') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        @lang('lang.search')
                                    </button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
    </div>
</section>

@if(isset($class_times))
<section class="mt-20">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-6 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.class_routine_create')</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        @if(session()->has('success') != "" || session()->has('danger') != "")
                        <tr>
                            <td colspan="8">
                                @if(session()->has('success') != "")
                            
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            
                                @else

                                <div class="alert alert-success">
                                    {{ session()->get('danger') }}
                                </div>

                            </td>

                            @endif
                        </tr>
                        @endif
                        <tr>
                            <th>Class Period</th>
                            @foreach($sm_weekends as $sm_weekend)
                            <th>{{$sm_weekend->name}}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($class_times as $class_time)
                        <tr>
                            <td>
                                {{$class_time->period}}
                                <br>
                                {{date('h:i A', strtotime($class_time->start_time)).' - '.date('h:i A', strtotime($class_time->end_time))}}
                            </td>

                            @foreach($sm_weekends as $sm_weekend)

                            <td>
                                @if($class_time->is_break == 0)
                                @if($sm_weekend->is_weekend != 1)
                                

                                @php
                                    $assinged_class_routine = App\SmClassRoutineUpdate::assingedClassRoutine($class_time->id, $sm_weekend->id, $class_id, $section_id);
                                @endphp
                                @if($assinged_class_routine == "")

                                @if(in_array(247, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                                <div class="col-lg-6 text-right">
                                    <a href="{{url('add-new-routine', [$class_time->id, $sm_weekend->id, $class_id, $section_id])}}" class="primary-btn small tr-bg icon-only mr-10 modalLink" data-modal-size="modal-md" title="Create Class routine">
                                        <span class="ti-plus" id="addClassRoutine"></span>
                                    </a>
                                </div>
                                @endif

                                @else
                                    <span class="">{{$assinged_class_routine->subject !=""?$assinged_class_routine->subject->subject_name:""}}</span>
                                    <br>
                                    <span class="">{{$assinged_class_routine->classRoom!=""?$assinged_class_routine->classRoom->room_no:""}}</span></br>
                                    <span class="tt">{{$assinged_class_routine->teacherDetail!=""?$assinged_class_routine->teacherDetail->full_name:""}}</span></br>
                                    @if(in_array(248, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                                    <a href="{{url('edit-class-routine', [$class_time->id, $sm_weekend->id, $class_id, $section_id, $assinged_class_routine->subject_id, $assinged_class_routine->room_id, $assinged_class_routine->id, $assinged_class_routine->teacher_id])}}" class="modalLink" data-modal-size="modal-md" title="Edit Class routine"><span class="ti-pencil-alt" id="addClassRoutine"></span></a>
                                    @endif
                                    @if(in_array(249, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                                    <a href="{{url('delete-class-routine-modal', [$assinged_class_routine->id])}}" class="modalLink" data-modal-size="modal-md" title="Delete Class routine"><span class="ti-trash" id="addClassRoutine"></span></a>
                               
                                    @endif
                                    @endif

                                
                                @else
                                        @lang('lang.weekend')

                                @endif
                                @endif
                            </td>

                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endif



@endsection
