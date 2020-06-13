@extends('backEnd.master')
@section('mainContent')

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.dormitory_list')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.dormitory')</a>
                <a href="#">@lang('lang.dormitory_list')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($dormitory_list))
         @if(in_array(368, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('dormitory-list')}}" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30">@if(isset($dormitory_list))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.dormitory')
                            </h3>
                        </div>
                        @if(isset($dormitory_list))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'dormitory-list/'.$dormitory_list->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                        @else
                        @if(in_array(368, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'dormitory-list',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        @endif
                        @endif
                        <div class="white-box">
                            <div class="add-visitor">
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
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('dormitory_name') ? ' is-invalid' : '' }}"
                                                type="text" name="dormitory_name" autocomplete="off" value="{{isset($dormitory_list)? $dormitory_list->dormitory_name:''}}">
                                            <input type="hidden" name="id" value="{{isset($dormitory_list)? $dormitory_list->id: ''}}">
                                            <label>@lang('lang.dormitory') @lang('lang.name') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('dormitory_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('dormitory_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type">
                                            <option data-display="@lang('lang.type') *" value="">@lang('lang.type') *</option>
                                            @if(isset($dormitory_list))
                                            <option value="B" {{$dormitory_list->type == "B"? 'selected': ''}}>@lang('lang.boys')</option>
                                            <option value="G" {{$dormitory_list->type == "G"? 'selected': ''}}>@lang('lang.girls')</option>
                                            @else 
                                            <option value="B">@lang('lang.boys')</option>
                                            <option value="G"}}>@lang('lang.girls')</option>
                                            @endif

                                        </select>

                                        @if ($errors->has('type'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row  mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input" type="text" name="address" value="{{isset($dormitory_list)? $dormitory_list->address: ''}}">
                                            <label>@lang('lang.address') <span></span></label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('intake') ? ' is-invalid' : '' }}" type="number" name="intake" value="{{isset($dormitory_list)? $dormitory_list->intake: ''}}">
                                            <label>@lang('lang.intake') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('intake'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('intake') }}</strong>
                                        </span>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4" name="description">{{isset($dormitory_list)? $dormitory_list->description: ''}}</textarea>
                                            <label>@lang('lang.description') <span></span></label>
                                            <span class="focus-border textarea"></span>
                                        </div>
                                    </div>
                                </div>
                                 @php 
                                  $tooltip = "";
                                  if(in_array(368, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            @if(isset($dormitory_list))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                            @lang('lang.dormitory')
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
                            <h3 class="mb-0"> @lang('lang.dormitory') @lang('lang.list')</h3>
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
                                    <th>@lang('lang.dormitory') @lang('lang.name')</th>
                                    <th>@lang('lang.type')</th>
                                    <th>@lang('lang.address')</th>
                                    <th>@lang('lang.intake') </th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($dormitory_lists as $dormitory_list)
                                <tr>
                                    <td>{{$dormitory_list->dormitory_name}}</td>
                                    <td>{{$dormitory_list->type =='B'? 'Boys': 'Girls'}}</td>
                                    <td>{{$dormitory_list->address}}</td>
                                    <td>{{$dormitory_list->intake}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                               @if(in_array(369, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                                                <a class="dropdown-item" href="{{url('dormitory-list', [$dormitory_list->id])}}">@lang('lang.edit')</a>
                                               @endif
                                               @if(in_array(370, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteDormitoryListModal{{$dormitory_list->id}}"
                                                    href="#">@lang('lang.delete')</a>
                                            @endif
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteDormitoryListModal{{$dormitory_list->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.dormitory')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                     {{ Form::open(['url' => 'dormitory-list/'.$dormitory_list->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
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
