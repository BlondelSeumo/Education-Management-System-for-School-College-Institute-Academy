<?php
$setting = App\SmGeneralSettings::find(1);
if(isset($setting->copyright_text)){ $copyright_text = $setting->copyright_text; }else{ $copyright_text = 'Copyright © 2019 All rights reserved | This template is made with by Codethemes'; }
if(isset($setting->logo)) { $logo = $setting->logo; } else{ $logo = 'public/uploads/settings/logo.png'; }

if(isset($setting->favicon)) { $favicon = $setting->favicon; } else{ $favicon = 'public/backEnd/img/favicon.png'; }


 

$login_background = App\SmBackgroundSetting::where([['is_default',1],['title','Login Background']])->first(); 
 
if(empty($login_background)){
    $css = "background: url(".url('public/backEnd/img/login-bg.jpg').")  no-repeat center; background-size: cover; ";
}else{
    if(!empty($login_background->image)){
        $css = "background: url('". url($login_background->image) ."')  no-repeat center;  background-size: cover;";
    }else{
        $css = "background:".$login_background->color;
    }
} 
$active_style = App\SmStyle::where('is_active', 1)->first();
?> 
<!DOCTYPE html>
<html lang="en" <?php if(isset ($ttl_rtl ) && $ttl_rtl ==1): ?> dir="rtl" class="rtl" <?php endif; ?> >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?php echo e(asset($favicon)); ?>" type="image/png"/>
    <title>Login</title>
    <meta name="_token" content="<?php echo csrf_token(); ?>"/>

	<?php if(isset ($ttl_rtl ) && $ttl_rtl ==1): ?>
		<link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/rtl/bootstrap.min.css"/>
	<?php else: ?>
		<link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap.css"/>
	<?php endif; ?>

	<link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/themify-icons.css" />

	<?php if(isset ($ttl_rtl ) && $ttl_rtl ==1): ?>
		<link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/rtl/style.css"/>
	<?php else: ?>
		<link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/<?php echo e(@$active_style->path_main_style); ?>"/>	
	<?php endif; ?>
</head>
<body class="login admin hight_100" style="<?php echo e($css); ?>">

    <!--================ Start Login Area =================-->
	<section class="login-area up_login">
		<div class="container"> 
			<input type="hidden" id="url" value="<?php echo e(url('/')); ?>">
			<div class="row login-height justify-content-center align-items-center">
				<div class="col-lg-5 col-md-8">
					<div class="form-wrap text-center">
						<div class="logo-container">
							<a href="<?php echo e(url('/')); ?>">
								<img src="<?php echo e(asset($setting->logo)); ?>" alt="" class="logoimage">
							</a>
						</div>
						<div class="text-center">
                    		<h5 class="text-uppercase font-bold">Reset Password</h5>
		                    <?php if(session()->has('message-success') != ""): ?>
			                    <?php if(session()->has('message-success')): ?>
			                    <p class="text-success"><?php echo e(session()->get('message-success')); ?></p>
			                    <?php endif; ?>
			                <?php endif; ?>
			                <?php if(session()->has('message-danger') != ""): ?>
			                    <?php if(session()->has('message-danger')): ?>
			                    <p class="text-danger"><?php echo e(session()->get('message-danger')); ?></p>
			                    <?php endif; ?>
			                <?php endif; ?>

		                </div>
						<form method="POST" class="" action="<?php echo e(url('email/verify')); ?>">
                        <?php echo csrf_field(); ?>
							<div class="form-group input-group mb-4 mx-3">
								<span class="input-group-addon">
									<i class="ti-email"></i>
								</span>
								<input class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" type="email" name='email' placeholder="Enter Email address"/>
								<?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback text-left pl-3" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
							</div>
							

							<div class="form-group mt-30 mb-30">
								<button type="submit" class="primary-btn fix-gr-bg">
									<span class="ti-lock mr-2"></span>
									Next
                                </button>
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
				<div class="col-lg-12 text-center"> 
					<p><?php echo $copyright_text; ?></p>    
				</div>
			</div>
		</div>
	</footer>
	<!--================ End Footer Area =================-->


    <script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/popper.js"></script>
	<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/bootstrap.min.js"></script>
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
