
<div class="container-fluid">
    <div class="student-details">
        <div class="student-meta-box">
            <div class="single-meta">
                <div class="row">
                    <div class="col-lg-12 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0 text-center">Route: {{$route->title}}</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="student-meta-box">
                            <div class="single-meta mt-20">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="value text-left">
                                            Vehicle no:
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="name">
                                            {{$vehicle->vehicle_no}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="value text-left">
                                            Vehicle model:
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="name">
                                            {{$vehicle->vehicle_model}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="value text-left">
                                            Made
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="name">
                                            {{$vehicle->made_year}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="value text-left">
                                            Driver Name 
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="name">
                                            {{$vehicle->driver_name}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="value text-left">
                                           Driver Licence   
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="name">
                                            {{$vehicle->driver_license}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="value text-left">
                                            Driver Contact  
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="name">
                                            {{$vehicle->driver_contact}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
       