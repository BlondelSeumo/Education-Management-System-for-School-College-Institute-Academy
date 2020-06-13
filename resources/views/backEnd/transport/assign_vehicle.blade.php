@extends('backEnd.master')

@section('mainContent')
<section class="sms-breadcrumb mb-25 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.assign_vehicle')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.transport')</a>
                <a href="#">@lang('lang.assign_vehicle')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($assign_vehicle))
         @if(in_array(358, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1  )

        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('assign-vehicle')}}" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30">@if(isset($assign_vehicle))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.assign_vehicle')
                            </h3>
                        </div>
                        @if(isset($assign_vehicle))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'assign-vehicle/'.$assign_vehicle->id, 'method' => 'PUT']) }}
                        @else
                         @if(in_array(358, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1  )

                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'assign-vehicle', 'method' => 'POST']) }}
                        @endif
                        @endif
                        <input type="hidden" name="id" value="{{isset($assign_vehicle)? $assign_vehicle->id:''}}">
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

                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('route') ? ' is-invalid' : '' }}" name="route">
                                            <option data-display="@lang('lang.select_route') *" value="">@lang('lang.select_route') *</option>
                                            @foreach($routes as $routes)
                                                @if(isset($assign_vehicle))
                                                    <option value="{{$routes->id}}" {{$assign_vehicle->route_id == $routes->id? 'selected':''}}>{{$routes->title}}</option>
                                                @else
                                                    <option value="{{$routes->id}}">{{$routes->title}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('route'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('route') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <label>@lang('lang.vehicle') *</label><br>
                                        @foreach($vehicles as $vehicle)
                                            @if(isset($assign_vehicle))
                                                <div class="">
                                                    <input type="checkbox" id="vehicle{{$vehicle->id}}" class="common-checkbox" name="vehicles[]" value="{{$vehicle->id}}" {{in_array($vehicle->id, $vehiclesIds)? 'checked': ''}}>
                                                    <label for="vehicle{{$vehicle->id}}">{{$vehicle->vehicle_no}}</label>
                                                </div>
                                            @else
                                                <div class="">
                                                    <input type="checkbox" id="vehicle{{$vehicle->id}}" class="common-checkbox" name="vehicles[]" value="{{$vehicle->id}}">
                                                    <label for="vehicle{{$vehicle->id}}">{{$vehicle->vehicle_no}}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                        @if($errors->has('vehicles'))
                                            <span class="text-danger validate-textarea-checkbox" role="alert">
                                                <strong>{{ $errors->first('vehicles') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                    @php 
                                  $tooltip = "";
                                  if(in_array(358, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                         <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            @if(isset($assign_vehicle))
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
                            <h3 class="mb-0">@lang('lang.assign_vehicle') @lang('lang.list')</h3>
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
                                    <th>@lang('lang.route')</th>
                                    <th>@lang('lang.vehicle')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($assign_vehicles as $assign_vehicle)
                                <tr>
                                    <td valign="top">{{$assign_vehicle->route !=""?$assign_vehicle->route->title:""}}</td>
                                    <td>
                                        <table>
                                            @php
                                              $vehicles = explode(",",$assign_vehicle->vehicle_id);
                                             // dd($assign_vehicles->toArray());
                                            @endphp
                                            @foreach($vehicles as $vehicle)
                                          
                                            <tr>
                                                <td class="pt-0 border-0">
                                                    @php $vehicle = App\SmVehicle::find($vehicle);
                                                   
                                                    @endphp
                                                    
                                                    {{ $vehicle->vehicle_no }}
                                                </td>
                                            </tr>
                                            @endforeach

                                        </table>
                                    </td>
                                    
                                    <td valign="top">
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">

                                               @if(in_array(359, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1  )
                                                <a class="dropdown-item" href="{{url('assign-vehicle/'.$assign_vehicle->id.'/'.'edit')}}">@lang('lang.edit')</a>
                                                @endif
                                               
                                                @if(in_array(360, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                                                <a class="dropdown-item deleteAssignVehicle" data-toggle="modal" href="#" data-id="{{$assign_vehicle->id}}" data-target="#deleteAssignVehicle">@lang('lang.delete')</a>
                                           @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade admin-query" id="deleteAssignVehicle" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('lang.delete')@lang('lang.assign_vehicle')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                     {{ Form::open(['url' => 'assign-vehicle-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                     <input type="hidden" name="id" id="assign_vehicle_id">
                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                     {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
