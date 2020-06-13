<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl" class="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="{{asset('public/backEnd/')}}/img/favicon.png" type="image/png" />
    <title>School Management System</title>
    <meta name="_token" content="{!! csrf_token() !!}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/jquery-ui.css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/themify-icons.css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/nice-select.css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/magnific-popup.css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fastselect.min.css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/owl.carousel.min.css" />
    <!-- main css -->
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/style.css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/software.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fullcalendar.min.css">
    <link rel="stylesheet" media="print" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css">




</head>

<body class="client light">

    <!--================ Start Header Menu Area =================-->
    <header class="header-area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container box-1420">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand" href="#">
                        <img class="w-75" src="{{asset('public/backEnd/img/logo.png')}}" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="ti-menu"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item active"><a class="nav-link" href="{{url('/')}}/home">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{url('/')}}/about">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="speakers.html">Speakers</a>
                            {{-- <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="schedule.html">Schedule</a>
                                    <li class="nav-item"><a class="nav-link" href="venue.html">Venue</a>
                                    <li class="nav-item"><a class="nav-link" href="price.html">Pricing</a>
                                    <li class="nav-item"><a class="nav-link" href="elements.html">Elements</a></li>
                                </ul>
                            </li> --}}
                            <li class="nav-item"><a class="nav-link" href="{{url('/')}}/contact">Contact</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <ul class="nav navbar-nav mr-auto search-bar">
                                <li class="">
                                    <div class="input-group">
                                        <span>
                                            <i class="ti-search" aria-hidden="true" id="search-icon"></i>
                                        </span>
                                        <input type="text" class="form-control primary-input input-left-icon" placeholder="Search" id="search" />
                                        <span class="focus-border"></span>
                                    </div>
                                </li>
                            </ul>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!--================ End Header Menu Area =================-->

    <!--================ Home Banner Area =================-->
    <section class="container box-1420">
        <div class="home-banner-area">
            <div class="banner-inner">
                <div class="banner-content">
                    <h5>The Ultimate Education ERP</h5>
                    <h2>Infix</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <a class="primary-btn fix-gr-bg semi-large" href="#">Learn More About Us</a>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Home Banner Area =================-->

    <!--================ News Area =================-->
    <section class="news-area section-gap-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <h3 class="title">Latest News</h3>
                        </div>
                        <div class="col-lg-6 col-md-5 text-md-right text-left mb-30-lg">
                            <a href="#" class="primary-btn small fix-gr-bg">Browse All</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="news-item">
                                <div class="news-img">
                                    <img class="img-fluid w-100" src="{{asset('public/backEnd/img/client/news/news1.jpg')}}" alt="">
                                </div>
                                <div class="news-text">
                                    <p class="date">17th Nov, 2018</p>
                                    <h4>
                                        <a href="#">
                                            Structural study of
                                            antibiotic opens the way
                                            for new TB treatments
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="news-item">
                                <div class="news-img">
                                    <img class="img-fluid w-100" src="{{asset('public/backEnd/img/client/news/news2.jpg')}}" alt="">
                                </div>
                                <div class="news-text">
                                    <p class="date">17th Nov, 2018</p>
                                    <h4>
                                        <a href="#">
                                            Structural study of
                                            antibiotic opens the way
                                            for new TB treatments
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mt-30-md">
                            <div class="news-item">
                                <div class="news-img">
                                    <img class="img-fluid w-100" src="{{asset('public/backEnd/img/client/news/news1.jpg')}}" alt="">
                                </div>
                                <div class="news-text">
                                    <p class="date">17th Nov, 2018</p>
                                    <h4>
                                        <a href="#">
                                            Structural study of
                                            antibiotic opens the way
                                            for new TB treatments
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 notice-board-area">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="title">Notice Board</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="notice-board">
                                <div class="notice-item">
                                    <p class="date">17th Nov, 2018</p>
                                    <h4>Structural study of antibiotic opens disorder</h4>
                                </div>
                                <div class="notice-item">
                                    <p class="date">17th Nov, 2018</p>
                                    <h4>Structural study of antibiotic opens disorder</h4>
                                </div>
                                <div class="notice-item">
                                    <p class="date">17th Nov, 2018</p>
                                    <h4>Structural study of antibiotic opens disorder</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End News Area =================-->

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
                            <a href="#" class="primary-btn small fix-gr-bg">Browse All</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="academic-item">
                                <div class="academic-img">
                                    <img class="img-fluid" src="{{asset('public/backEnd/img/client/academics/academic1.jpg')}}" alt="">
                                </div>
                                <div class="academic-text">
                                    <h4>
                                        <a href="#">Under Graduate Education</a>
                                    </h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adip isicing elit, sed do eiusmod tempor.
                                    </p>
                                    <div>
                                        <a href="#" class="client-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="academic-item">
                                <div class="academic-img">
                                    <img class="img-fluid" src="{{asset('public/backEnd/img/client/academics/academic2.jpg')}}" alt="">
                                </div>
                                <div class="academic-text">
                                    <h4>
                                        <a href="#">Under Graduate Education</a>
                                    </h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adip isicing elit, sed do eiusmod tempor.
                                    </p>
                                    <div>
                                        <a href="#" class="client-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="academic-item">
                                <div class="academic-img">
                                    <img class="img-fluid" src="{{asset('public/backEnd/img/client/academics/academic3.jpg')}}" alt="">
                                </div>
                                <div class="academic-text">
                                    <h4>
                                        <a href="#">Under Graduate Education</a>
                                    </h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adip isicing elit, sed do eiusmod tempor.
                                    </p>
                                    <div>
                                        <a href="#" class="client-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Academics Area =================-->

    <!--================ Events Area =================-->
    <section class="events-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <h3 class="title">Academics</h3>
                        </div>
                        <div class="col-lg-6 col-md-5 text-md-right text-left mb-30-lg">
                            <a href="#" class="primary-btn small fix-gr-bg">Browse All</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="events-item">
                                <div class="card">
                                    <img class="card-img-top" class="img-fluid" src="{{asset('public/backEnd/img/client/events/event1.jpg')}}" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Structural study of
                                            antibiotic opens the way
                                            for new TB treatments
                                        </h5>
                                        <p class="card-text">
                                            Main Town Hall Campus
                                        </p>
                                        <div class="date">
                                            17th Nov
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="events-item">
                                <div class="card">
                                    <img class="card-img-top" class="img-fluid" src="{{asset('public/backEnd/img/client/events/event2.jpg')}}" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Structural study of
                                            antibiotic opens the way
                                            for new TB treatments
                                        </h5>
                                        <p class="card-text">
                                            Main Town Hall Campus
                                        </p>
                                        <div class="date">
                                            17th Nov
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="events-item">
                                <div class="card">
                                    <img class="card-img-top" class="img-fluid" src="{{asset('public/backEnd/img/client/events/event3.jpg')}}" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Structural study of
                                            antibiotic opens the way
                                            for new TB treatments
                                        </h5>
                                        <p class="card-text">
                                            Main Town Hall Campus
                                        </p>
                                        <div class="date">
                                            17th Nov
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="events-item">
                                <div class="card">
                                    <img class="card-img-top" class="img-fluid" src="{{asset('public/backEnd/img/client/events/event4.jpg')}}" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Structural study of
                                            antibiotic opens the way
                                            for new TB treatments
                                        </h5>
                                        <p class="card-text">
                                            Main Town Hall Campus
                                        </p>
                                        <div class="date">
                                            17th Nov
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Events Area =================-->

    <!--================ Start Testimonial Area =================-->
    <section class="testimonial-area relative section-gap">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="active-testimonial owl-carousel">
                    <div class="single-testimonial text-center">
                        <div class="d-flex justify-content-center">
                            <div class="thumb">
                                <img class="img-fluid rounded-circle" src="{{asset('public/backEnd/img/client/testimonial/person1.jpg')}}" alt="">
                            </div>
                            <div class="meta text-left">
                                <h4>Marvel Maison</h4>
                                <p>Chief Executive, Amazon</p>
                            </div>
                        </div>
                        <p class="desc">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                    </div>
                    <div class="single-testimonial text-center">
                        <div class="d-flex justify-content-center">
                            <div class="thumb">
                                <img class="img-fluid rounded-circle" src="{{asset('public/backEnd/img/client/testimonial/person1.jpg')}}" alt="">
                            </div>
                            <div class="meta text-left">
                                <h4>Marvel Maison</h4>
                                <p>Chief Executive, Amazon</p>
                            </div>
                        </div>
                        <p class="desc">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Testimonial Area =================-->

    <!--================Footer Area =================-->
	<footer class="footer_area section-gap-top">
		<div class="container">
			<div class="row footer_inner">
				<div class="col-lg-3 col-sm-6">
					<aside class="f_widget ab_widget">
						<div class="f_title">
							<h4>Departments</h4>
						</div>
						<ul>
							<li><a href="#"></a>Business</a></li><a href="#">
                            <li><a href="#"></a>Energy & Environmental Sciences</a></li>
							<li><a href="#"></a>Education Engineering</a></li>
							<li><a href="#"></a>Humanities & Sciences</a></li>
							<li><a href="#"></a>Law and Medicine</a></li>
						</ul>
					</aside>
				</div>
				<div class="col-lg-3 col-sm-6">
					<aside class="f_widget ab_widget">
						<div class="f_title">
							<h4>Health Care</h4>
						</div>
						<ul>
							<li><a href="#"></a>Infix Health Care</a></li><a href="#">
                            <li><a href="#"></a>Infix Children’s Health</a></li>
							<li><a href="#"></a>Interdisciplinary Research</a></li>
							<li><a href="#"></a>Infix Online</a></li>
							<li><a href="#"></a>Infix Research Centers</a></li>
						</ul>
					</aside>
				</div>
				<div class="col-lg-3 col-sm-6">
					<aside class="f_widget ab_widget">
						<div class="f_title">
							<h4>About Infix</h4>
						</div>
						<ul>
							<li><a href="#"></a>Infix Health Care</a></li><a href="#">
                            <li><a href="#"></a>Infix Children’s Health</a></li>
							<li><a href="#"></a>Interdisciplinary Research</a></li>
							<li><a href="#"></a>Infix Online</a></li>
							<li><a href="#"></a>Infix Research Centers</a></li>
						</ul>
					</aside>
				</div>
				<div class="col-lg-3 col-sm-6">
					<aside class="f_widget ab_widget">
						<div class="f_title">
							<h4>Resources</h4>
						</div>
						<ul>
							<li><a href="#"></a>Business</a></li><a href="#">
                            <li><a href="#"></a>Energy & Environmental Sciences</a></li>
							<li><a href="#"></a>Education Engineering</a></li>
							<li><a href="#"></a>Humanities & Sciences</a></li>
							<li><a href="#"></a>Law and Medicine</a></li>
						</ul>
					</aside>
				</div>
			</div>
			<div class="row single-footer-widget">
				<div class="col-lg-8 col-md-9">
					<div class="copy_right_text">
						<p>Copyright © 2018 All rights reserved <a href="#">Infix</a>. The Ultimate Education ERP</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-3">
					<div class="social_widget">
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-dribbble"></i></a>
						<a href="#"><i class="fa fa-behance"></i></a>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!--================End Footer Area =================-->


<script src="{{asset('public/backEnd/')}}/vendors/js/jquery-3.2.1.min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/jquery-ui.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/popper.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/bootstrap.min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/nice-select.min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/jquery.magnific-popup.min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/raphael-min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/morris.min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/bootstrap-datepicker.min.js">
</script>
<script src="{{asset('public/backEnd/')}}/js/main.js"></script>
<script src="{{asset('public/backEnd/')}}/js/custom.js"></script>
<script src="{{asset('public/backEnd/')}}/js/developer.js"></script>




</body>

</html>
