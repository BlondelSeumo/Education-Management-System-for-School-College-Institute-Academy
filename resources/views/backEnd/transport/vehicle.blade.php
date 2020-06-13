@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1> @lang('lang.vehicle')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.transport')</a>
                <a href="#">@lang('lang.vehicle')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        @if(isset($assign_vehicle))
        @if(in_array(354, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1  )

        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('vehicle')}}" class="primary-btn small fix-gr-bg">
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
                                @lang('lang.vehicle')
                            </h3>
                        </div>
                        @if(isset($assign_vehicle))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'vehicle/'.$assign_vehicle->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                        @else
                         @if(in_array(354, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1  )

                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'vehicle',
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
                                            <input class="primary-input form-control{{ $errors->has('vehicle_number') ? ' is-invalid' : '' }}"
                                                type="text" name="vehicle_number" autocomplete="off" value="{{isset($assign_vehicle)? $assign_vehicle->vehicle_no:old('vehicle_number')}}">
                                            <input type="hidden" name="id" value="{{isset($assign_vehicle)? $assign_vehicle->id: ''}}">
                                            <label>@lang('lang.vehicle') @lang('lang.number') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('vehicle_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('vehicle_number') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div> 
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('vehicle_model') ? ' is-invalid' : '' }}"
                                                type="text" name="vehicle_model" autocomplete="off" value="{{isset($assign_vehicle)? $assign_vehicle->vehicle_model:old('vehicle_model')}}">
                                            <label>@lang('lang.vehicle') @lang('lang.model') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('vehicle_model'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('vehicle_model') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('year_made') ? ' is-invalid' : '' }}"
                                                type="text" name="year_made" autocomplete="off" value="{{isset($assign_vehicle)? $assign_vehicle->made_year:old('year_made')}}">
                                            <label>@lang('lang.year_made')</label>
                                            <span class="focus-border"></span>
                                        </div>
                                        
                                    </div>
                                </div>
                          

                            <div class="row mt-25">
                                <div class="col-lg-12">
                                    <select class="w-100 bb niceSelect form-control {{ $errors->has('driver_id') ? ' is-invalid' : '' }}" id="select_class" name="driver_id">
                                        <option data-display="@lang('lang.select_driver') *" value="">@lang('lang.select_driver') *</option>
                                        @foreach($drivers as $driver)
                                        <option value="{{$driver->id}}" {{isset($assign_vehicle)? ($assign_vehicle->driver_id == $driver->id? 'selected':''):''}} > {{$driver->full_name}}</option>

                                        @endforeach
                                    </select>
                                    @if ($errors->has('driver_id'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('driver_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4" name="note">{{isset($assign_vehicle)? $assign_vehicle->note:old('note')}}</textarea>
                                            <label>@lang('lang.note')</label>
                                            <span class="focus-border textarea"></span>
                                        </div>
                                    </div>
                                </div>
                                @php 
                                  $tooltip = "";
                                  if(in_array(354, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
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
                                            @lang('lang.vehicle')
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
                            <h3 class="mb-0">  @lang('lang.vehicle')  @lang('lang.list')</h3>
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
                                    <td colspan="7">
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
                                    <th> @lang('lang.vehicle')  @lang('lang.no')</th>
                                    <th> @lang('lang.model')  @lang('lang.no')</th>
                                    <th> @lang('lang.year_made')</th>
                                    <th> @lang('lang.driver')  @lang('lang.name')</th>
                                    <th> @lang('lang.driver')  @lang('lang.license')</th>
                                    <th> @lang('lang.phone')</th>
                                    <th> @lang('lang.action')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($assign_vehicles as $assign_vehicle)
                                <tr>
                                    <td>{{$assign_vehicle->vehicle_no}}</td>
                                    <td>{{$assign_vehicle->vehicle_model}}</td>
                                    <td>{{$assign_vehicle->made_year}}</td>
                                    <td>{{(empty($assign_vehicle->driver->full_name))?'-':$assign_vehicle->driver->full_name}}   </td> 

                                    <td>{{$assign_vehicle->driver_license}}</td>
                                    <td>{{(empty($assign_vehicle->driver->mobile))?'-':$assign_vehicle->driver->mobile}}   </td> 

                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                @if(in_array(355, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1  )
                                                <a class="dropdown-item" href="{{url('vehicle', [$assign_vehicle->id])}}"> @lang('lang.edit')</a>
                                                @endif
                                               
                                                @if(in_array(356, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1  )
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteRoomTypeModal{{$assign_vehicle->id}}"
                                                    href="#"> @lang('lang.delete')</a>
                                                @endif
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteRoomTypeModal{{$assign_vehicle->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"> @lang('lang.delete')  @lang('lang.vehicle')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4> @lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"> @lang('lang.cancel')</button>
                                                     {{ Form::open(['url' => 'vehicle/'.$assign_vehicle->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
                                                    <button class="primary-btn fix-gr-bg" type="submit"> @lang('lang.delete')</button>
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
