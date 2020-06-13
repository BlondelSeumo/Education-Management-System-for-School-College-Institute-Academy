@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.fees_assign')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.fees_collection')</a>
                <a href="{{route('fees_assign', [$fees_group_id])}}">@lang('lang.fees_assign')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.select_criteria')</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                        @if(session()->has('message-success'))
                        <div class="alert alert-success">
                            {{ session()->get('message-success') }}
                        </div>
                        @elseif(session()->has('message-danger'))
                        <div class="alert alert-danger">
                            {{ session()->get('message-danger') }}
                        </div>
                        @endif
                    <div class="white-box">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'fees-assign-search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_studentA']) }}
                            <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <input type="hidden" name="fees_group_id" id="fees_group_id" value="{{$fees_group_id}}">
                                <div class="col-lg-3 mt-30-md">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                        <option data-display="@lang('lang.select_class')" value="">@lang('lang.select_class')</option>
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
                                <div class="col-lg-3 mt-30-md" id="select_section_div">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('section') ? ' is-invalid' : '' }}" id="select_section" name="section">
                                        <option data-display="@lang('lang.select_section')" value="">@lang('lang.select_section')</option>
                                    </select>
                                    @if ($errors->has('section'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('section') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-3 mt-30-md">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" name="category">
                                        <option data-display="@lang('lang.select') @lang('lang.category')" value="">@lang('lang.select') @lang('lang.category')</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{isset($category_id)? ($category_id == $category->id? 'selected':''):''}}>{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-3 mt-30-md">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('section') ? ' is-invalid' : '' }}" name="gender">
                                        <option data-display="@lang('lang.select') @lang('lang.gender')" value="">@lang('lang.select') @lang('lang.gender')</option>
                                        @foreach($genders as $gender)
                                        <option value="{{$gender->id}}" {{isset($gender_id)? ($gender_id == $gender->id? 'selected':''):''}}>{{$gender->base_setup_name}}</option>
                                        @endforeach
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
    @if(isset($students))

        
            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'method' => 'POST', 'url' => 'fees-assign-store', 'enctype' => 'multipart/form-data'])}}
       


            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row mb-30">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">@lang('lang.assign') @lang('lang.fees_group')</h3>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="fees_group_id" value="{{$fees_group_id}}" id="fees_group_id">
                      
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-lg-4">
                            <table id="table_id_table" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        @php $i = 0; @endphp
                                        @foreach($fees_assign_groups as $fees_assign_group)
                                        @php $i++; @endphp
                                        @if($i == 1)
                                        
                                            <tr>
                                                <th>{{$fees_assign_group->feesGroups->name}}</th>
                                                <th></th>
                                            </tr>
                                        @endif   
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($fees_assign_groups as $fees_assign_group)
                                    <tr>
                                        <td>
                                            {{$fees_assign_group->feesTypes !=""?$fees_assign_group->feesTypes->name:""}}
                                        </td>
                                        <td>{{$fees_assign_group->amount}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>     
                            </table>
                        </div>
                        <div class="col-lg-8">
                            <table id="table_id_table_one" class="display school-table" cellspacing="0" width="100%">
                                        
                                <thead>
                                    <tr>
                                        <th width="10%">
                                            <input type="checkbox" id="checkAll" class="common-checkbox" name="checkAll"  @php
                                                if(count($students) > 0){
                                                    if(count($students) == count($pre_assigned)){
                                                        echo 'checked';
                                                    }
                                                           
                                                }
                                            @endphp>
                                            <label for="checkAll" 
                                                
                                           
                                            >@lang('lang.all')</label>
                                        </th>
                                        <th width="20%">@lang('lang.student') @lang('lang.name')</th>
                                        <th width="15%">@lang('lang.admission') @lang('lang.no')</th>
                                        <th width="15%">@lang('lang.class')</th>
                                        <th width="20%">@lang('lang.father_name')</th>
                                        <th width="10%">@lang('lang.category')</th>
                                        <th width="10%">@lang('lang.gender')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                        <td>
                                            <input type="checkbox" id="student.{{$student->id}}" class="common-checkbox" name="student_checked[]" value="{{$student->id}}" {{in_array($student->id, $pre_assigned)? 'checked':''}}>
                                            <label for="student.{{$student->id}}"></label>
                                        </td>
                                        <td>{{$student->first_name.' '.$student->last_name}} <input type="hidden" name="id[]" value="{{isset($update)? $student->forwardBalance->id: $student->id}}"></td>
                                        <td>{{$student->admission_no}}</td>
                                        <td>{{$student->className!=""?$student->className->class_name:"".'('.$student->section!=""?$student->section->section_name:"".')'}}</td>
                                        
                                        <td>{{$student->parents != ""? $student->parents->fathers_name:""}}</td>
                                        <td>{{$student->category->category_name}}</td>
                                        <td>{{$student->gender->base_setup_name}}</td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                                @if($students->count() > 0)
                                <tr>
                                    <td colspan="7">
                                        <div class="text-center">
                                            <button type="button" class="primary-btn fix-gr-bg mb-0" id="btn-assign-fees-group">
                                                <span class="ti-save pr"></span>
                                                @lang('lang.save') @lang('lang.fees')
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endif      
                            </table>
                        </div>

                    </div>
                </div>
            </div>
    {{ Form::close() }}
    @endif

    </div>
</section>


@endsection
