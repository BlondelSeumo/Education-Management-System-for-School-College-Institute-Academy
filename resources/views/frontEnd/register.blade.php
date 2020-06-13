{{-- @extends('frontEnd.home.front_master')
@section('main_content')
@endsection
 --}}

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer register</title>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/themify-icons.css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/style.css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/infix.css" />
</head>
<body class="login admin">

    <!--================ Start Login Area =================-->
    <section class="login-area min-height-90">
        <div class="container">
            <div class="row login-height justify-content-center align-items-center">
                <div class="col-lg-5 col-md-8">
                    <div class="form-wrap text-center">
                        <div class="logo-container">
                            <a href="#">
                                <img src="{{asset('public/backEnd/img/logo.png')}}" alt="">
                            </a>
                        </div>
                        <h5 class="text-uppercase">Login Details</h5>
                        @if(session()->has('message-success') != "")
                            @if(session()->has('message-success'))
                            <p class="text-success">{{session()->get('message-success')}}</p>
                            @endif
                        @endif
                        @if(session()->has('message-danger') != "")
                            @if(session()->has('message-danger'))
                            <p class="text-danger">{{session()->get('message-danger')}}</p>
                            @endif
                        @endif
                        <form method="POST" class="" action="{{ url('register') }}">
                        @csrf



                            <div class="form-group input-group mb-4 mx-3">
                                <span class="input-group-addon">
                                    <i class="ti-user"></i>
                                </span>
                                <input class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}" type="text" name='fullname' placeholder="Enter Name"/>
                                @if ($errors->has('fullname'))
                                    <span class="invalid-feedback text-left pl-3" role="alert">
                                        <strong>{{ $errors->first('fullname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        
                            <div class="form-group input-group mb-4 mx-3">
                                <span class="input-group-addon">
                                    <i class="ti-email"></i>
                                </span>
                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name='email' placeholder="Enter Email"/>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback text-left pl-3" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group input-group mb-4 mx-3">
                                <span class="input-group-addon">
                                    <i class="ti-key"></i>
                                </span>
                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name='password' placeholder="Enter Password"/>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback text-left pl-3" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group input-group mb-4 mx-3">
                                <span class="input-group-addon">
                                    <i class="ti-check"></i>
                                </span>
                                <input class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" type="password" name='password_confirmation' placeholder="Confirm Password"/>
                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback text-left pl-3" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group mt-30 mb-30">
                                <button type="submit" class="primary-btn fix-gr-bg">
                                    <span class="ti-lock mr-2"></span>
                                    Login
                                </button>
                            </div>

                            <div class="d-flex justify-content-between pl-30">
                                <div>
                                    <a href="{{url('recovery/passord')}}">Have already an account ? Login here</a>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Start End Login Area =================-->

    <!--================ Footer Area =================-->
    <footer class="footer_area min-height-10">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <p>Copyright © 2019 All rights reserved | This template is made with <span class="ti-heart"></span>  by Codethemes</p> 
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!--================ End Footer Area =================-->


    <script src="{{asset('public/backEnd/')}}/vendors/js/jquery-3.2.1.min.js"></script>
    <script src="{{asset('public/backEnd/')}}/vendors/js/popper.js"></script>
    <script src="{{asset('public/backEnd/')}}/vendors/js/bootstrap.min.js"></script>
    <script>
        $('.primary-btn').on('click', function(e) {
        // Remove any old one
        $('.ripple').remove();

        // Setup
        var primaryBtnPosX = $(this).offset().left,
            primaryBtnPosY = $(this).offset().top,
            primaryBtnWidth = $(this).width(),
            primaryBtnHeight = $(this).height();

        // Add the element
        $(this).prepend("<span class='ripple'></span>");

        // Make it round!
        if (primaryBtnWidth >= primaryBtnHeight) {
            primaryBtnHeight = primaryBtnWidth;
        } else {
            primaryBtnWidth = primaryBtnHeight;
        }

        // Get the center of the element
        var x = e.pageX - primaryBtnPosX - primaryBtnWidth / 2;
        var y = e.pageY - primaryBtnPosY - primaryBtnHeight / 2;

        // Add the ripples CSS and start the animation
        $('.ripple')
            .css({
                width: primaryBtnWidth,
                height: primaryBtnHeight,
                top: y + 'px',
                left: x + 'px'
            })
            .addClass('rippleEffect');
        });
    </script>
</body>
</html>
