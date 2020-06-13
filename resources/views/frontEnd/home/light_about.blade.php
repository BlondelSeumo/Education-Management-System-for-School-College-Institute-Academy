@php $page_title="All about Infix School management system; School management software"; @endphp
@extends('frontEnd.home.front_master')
@section('main_content')

    <!--================ Home Banner Area =================-->
    <section class="container box-1420">
        <div class="banner-area" style="background: linear-gradient(0deg, rgba(124, 50, 255, 0.6), rgba(199, 56, 216, 0.6)), url({{$about->image != ""? $about->image : '../img/client/common-banner1.jpg'}}) no-repeat center;" >
            <div class="banner-inner">
                <div class="banner-content">
                    <h2>{{$about->title}}</h2>
                    <p>{{$about->description}}</p>
                    <a class="primary-btn fix-gr-bg semi-large" href="{{$about->button_url}}">{{$about->button_text}}</a>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Home Banner Area =================-->

    <!--================ Start Facts Area =================-->
    <section class="fact-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>Opened in</h3>
                                    <p class="mb-0">Total Students count</p>
                                </div>
                                <h1 class="gradient-color2">
                                    @if(isset($totalStudents))
                                        {{count($totalStudents)}}
                                    @endif
                                </h1>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 mt-20-lg">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>Students</h3>
                                    <p class="mb-0">Total Students count</p>
                                </div>
                                <h1 class="gradient-color2">
                                    @if(isset($totalStudents))
                                        {{count($totalStudents)}}
                                    @endif
                                </h1>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 mt-20-lg">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>Faculty</h3>
                                    <p class="mb-0">Total Teachers count</p>
                                </div>
                                <h1 class="gradient-color2">
                                    @if(isset($totalTeachers))
                                        {{count($totalTeachers)}}
                                    @endif</h1>
                                </h1>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Facts Area =================-->

    <!--================ Our History Area =================-->
    <section class="academics-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="title">Our History</h3>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($history as $value)
                        <div class="col-lg-4 col-md-6">
                            <div class="academic-item">
                                <div class="academic-img">
                                    <img class="img-fluid" src="{{asset($value->image)}}" alt="">
                                </div>
                                <div class="academic-text">
                                    <h4>
                                        <a href="{{url('news-details/'.$value->id)}}">{{$value->news_title}}</a>
                                    </h4>
                                    <p>
                                        {{$value->news_body}}
                                    </p>
                                    <div>
                                        <a href="{{url('news-details/'.$value->id)}}" class="client-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Our History Area =================-->

    <!--================ Start About Us Area =================-->
    <section class="info-area section-gap-bottom">
        <div class="container">				
            <div class="single-info row mt-40 align-items-center">
                <div class="col-lg-6 col-md-12 text-center pr-lg-0 info-left">
                    <div class="info-thumb">
                        <img src="{{asset($about->main_image)}}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 pl-lg-0 info-rigth">
                    <div class="info-content">
                        <h2>{{$about->main_title}}</h2>
                        <p>
                            {{$about->main_description}}
                        </p>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End About Us Area =================-->

    <!--================ Our Mission and Vision Area =================-->
    <section class="academics-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="title">Our Mission and Vision</h3>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($mission as $value)
                        <div class="col-lg-4 col-md-6">
                            <div class="academic-item">
                                <div class="academic-img">
                                    <img class="img-fluid" src="{{asset($value->image)}}" alt="">
                                </div>
                                <div class="academic-text">
                                    <h4>
                                        <a href="{{url('news-details/'.$value->id)}}">{{$value->news_title}}</a>
                                    </h4>
                                    <p>
                                        {{$value->news_body}}
                                    </p>
                                    <div>
                                        <a href="{{url('news-details/'.$value->id)}}" class="client-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Our Mission and Vision Area =================-->

    <!--================ Start Testimonial Area =================-->
    <section class="testimonial-area relative section-gap">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="active-testimonial owl-carousel">

                    @foreach($testimonial as $value)
                        {{--                        {{dd($value->image)}}--}}
                        <div class="single-testimonial text-center">
                            <div class="d-flex justify-content-center">
                                <div class="thumb">
                                    @if(!empty($value->image))
                                        <img class="img-fluid rounded-circle" src="{{asset($value->image)}}" alt="">
                                    @else
                                        <img class="img-fluid rounded-circle" src="{{asset('public/uploads/sample.jpg')}}" alt="">
                                    @endif
                                </div>
                                <div class="meta text-left">
                                    <h4>{{$value->name}}</h4>
                                    <p>{{$value->designation}}, {{$value->institution_name}}</p>
                                </div>
                            </div>
                            <p class="desc">
                                {{$value->description}}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!--================ End Testimonial Area =================-->
@endsection

