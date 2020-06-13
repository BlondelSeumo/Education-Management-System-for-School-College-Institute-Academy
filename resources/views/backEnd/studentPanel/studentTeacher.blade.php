@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Teachers List</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">Dashboard</a>
                <a href="#">Teachers</a>
                <a href="#">Teachers List</a>
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
                            <h3 class="mb-0">Teacher</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                                <tr> 
                                    <th>Teacher Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($teachers as $value)
                                <tr> 
                                    <td>
                                        <img src="{{asset($value->teacher->staff_photo)}}" class="img img-thumbnail" style="width: 60px; height: auto;">
                                        {{$value->teacher !=""?$value->teacher->full_name:""}}
                                    </td> 
                                    <td>{{$value->teacher !=""?$value->teacher->email:""}}</td>
                                    <td>{{$value->teacher !=""?$value->teacher->mobile:""}}</td>
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
