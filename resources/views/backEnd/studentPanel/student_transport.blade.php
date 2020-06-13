@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Transport</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">Dashboard</a>
                <a href="{{route('student_subject')}}">Transport</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
       
        <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-30">Transport Route list</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                    <th>Route</th>
                                    <th>Vehicle</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($routes as $route)
                                <tr>
                                    <td valign="top">{{$route->route->title}}</td>
                                    <td>
                                        <table>
                                            @php
                                              $vehicles = explode(",",$route->vehicle_id);
                                            @endphp
                                            @foreach($vehicles as $vehicle)
                                            <tr>
                                                <td>
                                                    @php $vehicle = App\SmVehicle::find($vehicle);
                                                    @endphp
                                                    {{$vehicle->vehicle_no}}


                                                </td>
                                                <td >
                                                    <div class="col-sm-6">
                                                        
                                                    @if($student_detail->route_list_id == $route->route->id && $student_detail->vechile_id == $vehicle->id)
                                                        <a href="javascript:void(0)" class="primary-btn small fix-gr-bg">Assigned</a> 
                                                    @endif
                                                    </div>
                                                     
                                                    <div class="col-sm-6">
                                                         
                                                         <a class="primary-btn small fix-gr-bg modalLink" title="Transport Details" data-modal-size="modal" href="{{route('student_transport_view_modal', [$route->route->id, $vehicle->id])}}">View</a>
                                                   
                                                    </div>
                                                    

                                                </td>

                                                
                                            </tr>
                                            @endforeach

                                        </table>
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
@endsection