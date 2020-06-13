@extends('frontEnd.home.front_master')
@section('main_content')
<?php
    $css= "background: linear-gradient(0deg, rgba(124, 50, 255, 0.6), rgba(199, 56, 216, 0.6)), url(".url($homePage->image).") no-repeat center;    background-size: cover;";
?>

 <style type="text/css">
     .client .events-item .card .card-body .date {
        max-width: 80px !important; 
     }
 </style>

  @if(isset($per["Image Banner"]))
    <!--================ Home Banner Area =================-->
    <section class="container box-1420">
        <div class="home-banner-area" style="{{$css}}">
            <div class="banner-inner">
                <div class="banner-content">
                    <h5>{{$homePage->title}}</h5>
                    <h2>{{$homePage->long_title}}</h2>
                    <p>{{$homePage->short_description}}</p>
                    <a class="primary-btn fix-gr-bg semi-large" href="{{$homePage->link_url}}">{{$homePage->link_label}}</a>
                </div>
            </div>
        </div>
    </section>
    @endif


    <!--================ End Home Banner Area =================-->

    <!--================ News Area =================-->
    <section class="news-area section-gap-top">
        <div class="container">
            <div class="row">
                  @if(isset($per["Latest News"]))
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <h3 class="title">Latest News</h3>
                        </div>
                        <div class="col-lg-6 col-md-5 text-md-right text-left mb-30-lg">
                            <a href="{{url('news-page')}}" class="primary-btn small fix-gr-bg">Browse All</a>
                        </div>
                    </div>
                    <div class="row">
                          @foreach($news as $value)
                        <div class="col-lg-4 col-md-6">
                            <div class="news-item">
                                <div class="news-img">
                                    <img class="img-fluid w-100" src="{{asset($value->image)}}" alt="">
                                </div>
                                <div class="news-text">
                                    <p class="date">
                                       
{{$value->publish_date != ""? App\SmGeneralSettings::DateConvater($value->publish_date):''}}

                                    </p>
                                    <h4>
                                        <a href="{{url('news-details/'.$value->id)}}">
                                            {{$value->news_title}}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                      @endforeach
                    </div>
                </div>
                @endif
                  @if(isset($per["Notice Board"]))

                <div class="col-lg-3 notice-board-area">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="title">Notice Board</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="notice-board">
                                @foreach($notice_board as $notice)
                                <div class="notice-item">
                                    <p class="date">
                                       
{{$notice->publish_on != ""? App\SmGeneralSettings::DateConvater($notice->publish_on):''}}

                                    </p>
                                    <a href="#" data-toggle="modal" data-target="#NoticeDetails{{$notice->id}}" ><h4>{{$notice->notice_title}}</h4></a> 
                                  <div class="modal fade admin-query" id="NoticeDetails{{$notice->id}}" >
                                    <div class="modal-dialog modal-dialog-centered  modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title dialog-notice-title">{{$notice->notice_title}}</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div> 
                                            <div class="modal-body">
                                                <div class="text-left">
                                                    <p class="text-left">{!! $notice->notice_message !!}</p>
                                                </div> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>

                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>   
                @endif
            </div>
        </div>
    </section>

 

    <!--================End News Area =================-->
    
  @if(isset($per["Academics"]))
    <!--================ Academics Area =================-->
    <section class="academics-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <h3 class="title">Academics</h3>
                        </div>
                        <div class="col-lg-6 col-md-5 text-md-right text-left mb-30-lg">
                            <a href="{{url('course')}}" class="primary-btn small fix-gr-bg">Browse All</a>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($academics as $academic)
                        <div class="col-lg-4 col-md-6">
                            <div class="academic-item">
                                <div class="academic-img">
                                    <img class="img-fluid" src="{{asset($academic->image)}}" alt="">
                                </div>
                                <div class="academic-text">
                                    <h4>
                                        <a href="{{url('course-Details/'.$academic->id)}}">{{$academic->title}}</a>
                                    </h4>
                                    <p>
                                        {!! substr($academic->overview, 0, 50) !!}
                                    </p>
                                    <div>
                                        <a href="{{url('course-Details/'.$academic->id)}}" class="client-btn">Read More</a>
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
@endif

  @if(isset($per["Event List"]))
    <!--================ End Academics Area =================-->

    <!--================ Events Area =================-->
    <section class="events-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <h3 class="title">Event List</h3>
                        </div>
                        <div class="col-lg-6 col-md-5 text-md-right text-left mb-30-lg">
                            <a href="#" class="primary-btn small fix-gr-bg">Browse All</a>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($events as $event)
                        <div class="col-lg-3 col-md-6">
                            <div class="events-item">
                                <div class="card">
                                    <img class="card-img-top" class="img-fluid" src="{{asset($event->uplad_image_file)}}" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            {{$event->event_title}}
                                        </h5>
                                        <p class="card-text">
                                            {{$event->event_location}}
                                        </p>
                                        <div class="date">
                                           
{{$event->from_date != ""? App\SmGeneralSettings::DateConvater($event->from_date):''}}


                                        </div>
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

    @endif
  @if(isset($per["Testimonial"]))

    <!--================ End Events Area =================-->

    <!--================ Start Testimonial Area =================-->
    <section class="testimonial-area relative section-gap">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="active-testimonial owl-carousel">

                     @foreach($testimonial as $value)
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

    @endif 

    <!--================ End Testimonial Area =================-->
@endsection
