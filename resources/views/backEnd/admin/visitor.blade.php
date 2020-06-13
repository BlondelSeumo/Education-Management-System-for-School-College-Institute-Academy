@extends('backEnd.master')
@section('mainContent')
    @php
        function showPicName($data){
            $name = explode('/', $data);
            return $name[3];
        }
    @endphp
    <section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.visitor_book')</h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.admin_section')</a>
                    <a href="#">@lang('lang.visitor_book')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            @if(isset($visitor))
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="{{url('visitor')}}" class="primary-btn small fix-gr-bg">
                            <span class="ti-plus pr-2"></span>
                            @lang('lang.add')
                        </a>
                    </div>
                </div>
            @endif
            <div class="row">
              

                    <div class="col-lg-3">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h3 class="mb-30">
                                        @if(isset($visitor))
                                            @lang('lang.edit')
                                        @else
                                            @lang('lang.add')
                                        @endif
                                        @lang('lang.visitor')
                                    </h3>
                                </div>
                                @if(isset($visitor))
                                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'visitor_update',
                                    'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                                @else
                                  @if(in_array(17, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)
                                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'visitor_store',
                                    'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                                @endif
                                @endif
                                <div class="white-box">
                                    <div class="add-visitor">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                @if(session()->has('message-success'))
                                                    <div class="alert alert-success">
                                                        @lang('lang.inserted_message')
                                                    </div>
                                                @elseif(session()->has('message-danger'))
                                                    <div class="alert alert-danger">
                                                        @lang('lang.error_message')
                                                    </div>
                                                @endif
                                                <div class="input-effect">
                                                    <input
                                                            class="primary-input form-control{{ $errors->has('purpose') ? ' is-invalid' : '' }}"
                                                            type="text" name="purpose" autocomplete="off"
                                                            value="{{isset($visitor)? $visitor->purpose: old('purpose')}}">

                                                    <input type="hidden" name="id"
                                                           value="{{isset($visitor)? $visitor->id: ''}}">
                                                    <label>@lang('lang.purpose')<span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('purpose'))
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('purpose') }}</strong>
                                                </span>
                                                    @endif
                                                </div>


                                            </div>
                                        </div>
                                        <div class="row mt-35">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input
                                                            class="primary-input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                            type="text" name="name" autocomplete="off"
                                                            value="{{isset($visitor)? $visitor->name: old('name')}}">
                                                    <label>@lang('lang.name')<span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row mt-35">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input
                                                            class="primary-input form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                            type="text" name="phone"
                                                            value="{{isset($visitor)? $visitor->phone: old('phone')}}">
                                                    <label>@lang('lang.phone') <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('phone'))
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-35">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input class="primary-input" type="text" name="visitor_id"
                                                           value="{{isset($visitor)? $visitor->visitor_id: old('visitor_id')}}">
                                                    <label>@lang('lang.id')</label>
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-35">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input class="primary-input" type="number" name="no_of_person"
                                                           value="{{isset($visitor)? $visitor->no_of_person: old('no_of_person')}}">
                                                    <label>@lang('lang.no_of_person')</label>
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row no-gutters input-right-icon mt-35">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input date" id="startDate" type="text"
                                                           name="date"
                                                           value="{{isset($visitor)? date('m/d/Y', strtotime($visitor->date)): date('m/d/Y')}}">
                                                    <label>@lang('lang.date')</label>
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="start-date-icon"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row no-gutters input-right-icon mt-25">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input time form-control{{ $errors->has('in_time') ? ' is-invalid' : '' }}"
                                                           type="text" name="in_time"
                                                           value="{{isset($visitor)? $visitor->in_time: old('in_time')}}">
                                                    <label>@lang('lang.in_time')</label>
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="" type="button">
                                                    <i class="ti-timer"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row no-gutters input-right-icon mt-25">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input time  form-control{{ $errors->has('out_time') ? ' is-invalid' : '' }}"
                                                           type="text" name="out_time"
                                                           value="{{isset($visitor)? $visitor->out_time: old('out_time')}}">
                                                    <label>@lang('lang.out_time')</label>
                                                    <span class="focus-border"></span>

                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="" type="button">
                                                    <i class="ti-timer"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row no-gutters input-right-icon mt-35">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input" id="placeholderInput" type="text"
                                                           placeholder="{{isset($visitor)? ($visitor->file != ""? showPicName($visitor->file):'File Name'):'File Name'}}"
                                                           readonly>
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                           for="browseFile">@lang('lang.browse')</label>
                                                    <input type="file" class="d-none" id="browseFile" name="file">
                                                </button>
                                            </div>
                                        </div>
	                                 @php 
                                  $tooltip = "";
                                  if(in_array(17, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp

                                        <div class="row mt-40">
                                            <div class="col-lg-12 text-center">
                                               <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                                    <span class="ti-check"></span>
                                                    @if(isset($visitor))
                                                        @lang('lang.update')
                                                    @else
                                                        @lang('lang.save')
                                                    @endif
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
                                <h3 class="mb-0">@lang('lang.visitor_list')</h3>
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
                                        <td colspan="8">
                                            @if(session()->has('message-success-delete'))
                                                <div class="alert alert-success">
                                                    @lang('lang.deleted_message')
                                                </div>
                                            @elseif(session()->has('message-danger-delete'))
                                                <div class="alert alert-danger">
                                                    @lang('lang.error_message')
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>@lang('lang.name')</th>
                                    <th>@lang('lang.no_of_person')</th>
                                    <th>@lang('lang.phone')</th>
                                    <th>@lang('lang.purpose')</th>
                                    <th>@lang('lang.date')</th>
                                    <th>@lang('lang.in_time')</th>
                                    <th>@lang('lang.out_time')</th>
                                    <th>@lang('lang.actions')</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($visitors as $visitor)
                                    <tr>
                                        <td>{{$visitor->name}}</td>
                                        <td>{{$visitor->no_of_person}}</td>
                                        <td>{{$visitor->phone}}</td>
                                        <td>{{$visitor->purpose}}</td>
                                        <td  data-sort="{{strtotime($visitor->date)}}" >{{ !empty($visitor->date)? App\SmGeneralSettings::DateConvater($visitor->date):''}}</td>
                                        <td>{{$visitor->in_time}}</td>
                                        <td>{{$visitor->out_time}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    @lang('lang.select')
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @if(in_array(18, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)

                                                        <a class="dropdown-item"
                                                           href="{{route('visitor_edit', [$visitor->id])}}">@lang('lang.edit')</a>
                                                    @endif
                                                    @if(in_array(19, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)

                                                        <a class="dropdown-item" data-toggle="modal"
                                                           data-target="#deleteVisitorModal{{$visitor->id}}"
                                                           href="#">@lang('lang.delete')</a>
                                                        @if($visitor->file != "")
                                                            @if(in_array(20, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)

                                                                <a class="dropdown-item"
                                                                   href="{{url('download-visitor-document/'.showPicName($visitor->file))}}">
                                                                    @lang('lang.download') <span
                                                                            class="pl ti-download"></span>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endif

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade admin-query" id="deleteVisitorModal{{$visitor->id}}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">@lang('lang.delete') @lang('lang.visitor')</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg"
                                                                data-dismiss="modal">@lang('lang.cancel')
                                                        </button>

                                                        <a href="{{route('visitor_delete', [$visitor->id])}}"
                                                           class="primary-btn fix-gr-bg">@lang('lang.delete')</a>

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
