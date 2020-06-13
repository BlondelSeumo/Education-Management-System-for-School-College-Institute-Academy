<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/themify-icons.css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/style.css" />
</head>
<body class="login">

    <!--================ Start Login Area =================-->
	<section class="login-area">
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
						<form action="" id="loginForm">
							<div class="form-group input-group">
								<span class="input-group-addon">
									<i class="lnr lnr-user"></i>
								</span>
								<input class="form-control" type="email" name='username' placeholder="Enter Email address" required="required" />
							</div>
							<div class="form-group input-group">
								<span class="input-group-addon">
									<i class="fa fa-key"></i>
								</span>
								<input class="form-control" type="password" name='password' placeholder="Enter Password" required="required" />
							</div>
							<div class="d-flex justify-content-between">
								<div class="checkbox">
									<input type="checkbox" id="rememberMe">
									<label for="rememberMe">Remember Me</label>
								</div>
								<div>
									<a href="#">Forget Password?</a>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="primary-btn fix-gr-bg">
									<span class="ti-lock"></span>
									Login
                                </button>
							</div>
							<div class="form-group text-center">
								Don’t have an account? <a href="#">Create Here</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ Start End Login Area =================-->

	<!--================ Footer Area =================-->
	<footer class="footer_area">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-5">
					<p>Copyright © 2018 All rights reserved | This template is made by <a href="http://www.codepixar.com/">Codepixar</a></p>
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
