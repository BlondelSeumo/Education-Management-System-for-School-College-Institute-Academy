@extends('frontEnd.home.front_master')
@section('main_content')

    <!--================ Home Banner Area =================-->
    <section class="container box-1420">
        <div class="banner-area">
            <div class="banner-inner">
                <div class="banner-content">
                    <h2>Course Details</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <a class="primary-btn fix-gr-bg semi-large" href="#">Learn More About Us</a>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Home Banner Area =================-->

    <!--================ Course Overview Area =================-->
    <section class="overview-area student-details section-gap-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs mb-50 ml-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#overviewTab" role="tab" data-toggle="tab">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#outlineTab" role="tab" data-toggle="tab">Outline</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#prerequisitesTab" role="tab" data-toggle="tab">Prerequisites</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#resourcesTab" role="tab" data-toggle="tab">Resources</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#statsTab" role="tab" data-toggle="tab">Stats</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Start Overview Tab -->
                        <div role="tabpanel" class="tab-pane fade show active" id="overviewTab">
                            <p>
                               {{$course->overview}}
                            </p>
                        </div>
                        <!-- End Overview Tab -->

                        <!-- Start Outline Tab -->
                        <div role="tabpanel" class="tab-pane fade" id="outlineTab">
                            <p>
                                {{$course->outline}}
                            </p>
                        </div>
                        <!-- End Outline Tab -->

                        <!-- Start Prerequisites Tab -->
                        <div role="tabpanel" class="tab-pane fade" id="prerequisitesTab">
                            <p>
                                {{$course->prerequisites}}
                            </p>
                        </div>
                        <!-- End Prerequisites Tab -->

                        <!-- Start Resources Tab -->
                        <div role="tabpanel" class="tab-pane fade" id="resourcesTab">
                            <p>
                                {{$course->resources}}
                            </p>
                        </div>
                        <!-- End Resources Tab -->

                        <!-- Start Stats Tab -->
                        <div role="tabpanel" class="tab-pane fade" id="statsTab">
                            <p>
                                {{$course->stats}}
                            </p>
                        </div>
                        <!-- End Stats Tab -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Course Overview Area =================-->

    <!--================ Related Course Area =================-->
    <section class="academics-area section-gap-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="title">Related Courses</h3>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($courses as $course)
                        <div class="col-lg-4 col-md-6">
                            <div class="academic-item">
                                <div class="academic-img">
                                    <img class="img-fluid" src="{{asset($course->image)}}" alt="">
                                </div>
                                <div class="academic-text">
                                    <h4>
                                        <a href="{{url('course-Details/'.$course->id)}}">{{$course->title}}</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Related Course Area =================-->
@endsection

