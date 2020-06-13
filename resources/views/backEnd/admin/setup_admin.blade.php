@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
    <div class="container-fluid">
        <div class="row justify-content-between">

        <h1>@lang('lang.admin_setup')</h1>
        <div class="bc-pages">
            <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
            <a href="#">@lang('lang.admin_section')</a>
            <a href="#">@lang('lang.admin_setup')</a>

        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($admin_setup))
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('setup-admin')}}" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30">@if(isset($admin_setup))
                                    @lang('lang.edit')

                                @else
                                    @lang('lang.add')

                                @endif
                                @lang('lang.admin_setup')
                            </h3>
                        </div>
                        @if(isset($admin_setup))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'setup-admin/'.$admin_setup->id,
                        'method' => 'PUT']) }}
                        @else
                          @if(in_array(42, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'setup-admin',
                        'method' => 'POST']) }}
                        @endif
                        @endif
                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
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
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('type') ? ' is-invalid' : '' }}"
                                            name="type">
                                            <option data-display="@lang('lang.type') *" value="">@lang('lang.type') *</option>
                                           
                                            <option value="1" {{isset($admin_setup)? ($admin_setup->type == '1'? 'selected':''):''}}>@lang('lang.purpose')</option>
                                            <option value="2" {{isset($admin_setup)? ($admin_setup->type == '2'? 'selected':''):''}}>@lang('lang.complaint') @lang('lang.type')</option>
                                            <option value="3" {{isset($admin_setup)? ($admin_setup->type == '3'? 'selected':''):''}}>@lang('lang.source')</option>
                                            <option value="4" {{isset($admin_setup)? ($admin_setup->type == '4'? 'selected':''):''}}>@lang('lang.reference')</option>
                                           
                                        </select>
                                        @if($errors->has('type'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row  mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                type="text" name="name" value="{{isset($admin_setup)? $admin_setup->name: ''}}">
                                            <input type="hidden" name="id" value="{{isset($admin_setup)? $admin_setup->id: ''}}">
                                            <label>@lang('lang.name') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4" name="description">{{isset($admin_setup)? $admin_setup->description: ''}}</textarea>
                                            <label>@lang('lang.description') <span></span></label>
                                            <span class="focus-border textarea"></span>
                                        </div>
                                    </div>
                                </div>
                                    @php 
                                  $tooltip = "";
                                  if(in_array(42, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            @if(isset($admin_setup))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                           Setup
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
                            <h3 class="mb-0">@lang('lang.admin_setup') @lang('lang.list')</h3>
                        </div>
                    </div>
                </div>

                <div class="row base-setup">
                    <div class="col-lg-12">
                        <table class="display school-table school-table-data" cellspacing="0" width="100%">
                            <thead>
                                @if(session()->has('message-success-delete') != "" ||
                                session()->get('message-danger-delete') != "")
                                <tr>
                                    <td colspan="3">
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
                                    <th width="33%">@lang('lang.type')</th>
                                    <th width="33%">@lang('lang.name')</th>
                                    <th width="33%">@lang('lang.actions')</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr>
                                    <td colspan="3" class="pr-0">
                                        <div id="accordion" role="tablist">
                                            @php $i = 0; @endphp
                                            @foreach($admin_setups as $key => $values)

                                            <div class="card">
                                                <div class="card-header d-flex justify-content-between" role="tab" id="headingOne{{$key}}">
                                                    <div class="row w-100 align-items-center">
                                                        <div class="col-lg-6">
                                                            <a data-toggle="collapse" href="#collapseOne{{$key}}" aria-expanded="true" aria-controls="collapseOne{{$key}}">
                                                            @php

                                                            	if($key == 1){
                                                            		echo 'Purpose';
	                                                            }elseif($key == 2){
		                                                            echo 'Complaint Type';
		                                                        }elseif($key == 3){
		                                                            echo 'Source';
		                                                        }elseif($key == 4){
																	echo 'Reference';
		                                                        }



                                                            @endphp
                                                            </a>
                                                        </div>
                                                        <div class="col-lg-6 text-right">
                                                            <a class="primary-btn icon-only tr-bg" data-toggle="collapse" href="#collapseOne{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                                                <span class="ti-arrow-down"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                        
                                                <div id="collapseOne{{$key}}" class="collapse {{$i++ == 0? 'show':''}}" role="tabpanel" aria-labelledby="headingOne{{$key}}" data-parent="#accordion">
                                                    <div class="card-body">
                                                        @foreach($values as $admin_setup)
                                                        <div class="row py-3 border-bottom align-items-center">
                                                            <div class="offset-lg-4 col-lg-4">{{$admin_setup->name}}</div>
                                                            <div class="col-lg-4">
                                                                <div class="dropdown">
                                                                    <button type="button" class="btn dropdown-toggle"
                                                                        data-toggle="dropdown">
                                                                        @lang('lang.select')
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        @if(in_array(43, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)
                                                                       <a class="dropdown-item" href="{{url('setup-admin', [$admin_setup->id
                                                    ])}}">@lang('lang.edit')</a>
                                                                        @endif
                                                                         @if(in_array(44, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)
                                                                        <a class="dropdown-item deleteSetupAdminModal" href="#" data-toggle="modal" data-target="#deleteSetupAdminModal" data-id="{{$admin_setup->id}}">@lang('lang.delete')</a>
                                                                    @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            @endforeach
                                            
                                        </div>
                                    </td>
                                    <td></td>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<div class="modal fade admin-query" id="deleteSetupAdminModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('lang.delete') @lang('lang.admin_setup')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                </div>


                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                    <a href="" class="primary-btn fix-gr-bg">@lang('lang.delete')</a>
                     
                </div>
            </div>

        </div>
    </div>
</div>



@endsection
