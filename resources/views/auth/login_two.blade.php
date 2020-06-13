<?php
$setting = App\SmGeneralSettings::find(1);
if(isset($setting->copyright_text)){ $copyright_text = $setting->copyright_text; }else{ $copyright_text = 'Copyright © 2019 All rights reserved | This template is made with by Codethemes'; }
if(isset($setting->logo)) { $logo = $setting->logo; } else{ $logo = 'public/uploads/settings/logo.png'; }

if(isset($setting->favicon)) { $favicon = $setting->favicon; } else{ $favicon = 'public/backEnd/img/favicon.png'; }
 
$login_background = App\SmBackgroundSetting::where([['is_default',1],['title','Login Background']])->first(); 
 
if(empty($login_background)){
    $css = "background: url(".url('public/backEnd/img/login-bg.png').")  no-repeat center; background-size: cover; ";
}else{
    if(!empty($login_background->image)){
        $css = "background: url('". url($login_background->image) ."')  no-repeat center;  background-size: cover;";
 
    }else{
        $css = "background:".$login_background->color;
    }
}
$active_style = App\SmStyle::where('is_active', 1)->first();
$ttl_rtl = $setting->ttl_rtl;
?>
<!DOCTYPE html>
<html lang="en" @if(isset ($ttl_rtl ) && $ttl_rtl ==1) dir="rtl" class="rtl" @endif >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{asset($favicon)}}" type="image/png"/>
    <title>Login</title>
    <meta name="_token" content="{!! csrf_token() !!}"/>

	@if(isset ($ttl_rtl ) && $ttl_rtl ==1)
		<link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/rtl/bootstrap.min.css"/>
	@else
		<link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css"/>
	@endif

	<link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/themify-icons.css" />

	@if(isset ($ttl_rtl ) && $ttl_rtl ==1)
		<link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/rtl/style.css"/>
	@else
		<link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/{{@$active_style->path_main_style}}"/>	
	@endif
<style>
/* .login-area .form-group i {
    color: #828bb2;
    display: inline-block;
    position: relative;
    top: 6px;
    left: 14px;
    font-size: 12px;
    font-weight: 400;
} */






 .login-height {
    margin: 0 !important;
}
@media (max-width: 991px) {
  .up_login .pl-30{
    padding-left: 0;
  }
}
.login-area .form-wrap {
    background: rgba(28, 0, 78, 0.25);
    padding: 50px 70px;
}
.logoimage{
 max-width: 150px !important;
  height: auto;
  padding: 2px;
}
.loginButton{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}
.singleLoginButton{
    flex: 22% 0 0;
}

.loginButton .get-login-access {
    display: block;
    width: 100%;
    border: 1px solid #fff;
    border-radius: 5px;
    margin-bottom: 20px;
    padding: 5px;
}
@media (max-width: 576px) {
  .singleLoginButton{
    flex: 49% 0 0;
  }
}
@media (max-width: 576px) {
  .singleLoginButton{
    flex: 49% 0 0;
  }
}
html{
	height:100% !important;
}
body{
	/* height:100% !important; */
	/* background-image: (../login-bg.png) */
}

.loginButton {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}
p{
	color: #828bb2;
}

.login-area h5 {
    margin-top: 40px;
    margin-bottom: 25px;
    color: #ffffff;
    letter-spacing: 2px;
    font-size: 14px;
    font-weight: 700;
}

.login-area .form-wrap {
	background: rgba(28, 0, 78, 0.25);
	padding: 15px 70px;
}
/* wert */
/* .login-area .form-group .form-control {
	color: #828bb2;
	border: 0px;
	border-bottom: 1px solid rgba(247, 247, 255, 0.2);
	border-radius: 0px;
	background: transparent !important;
	padding: 0px 30px;
	font-size: 12px;
	font-weight: 400;
	letter-spacing: 1px;
} */
/* .login-area .form-group .form-control::placeholder{
	color: #828bb2;
	text-transform: uppercase;
	/* opacity:.2; */
/* } */ */
/* 
.login-area .form-group .form-control:focus{
	outline: none !important;
}
.form-control:focus {
	color: #495057;
	background-color: #fff;
	border-color: #80bdff;
	outline: 0;
	box-shadow: none !important;;
} */


.login-area .form-wrap {
	background: rgba(28, 0, 78, 0.25);
	padding: 25px 70px;
}
.form-group.input-group.mb-4.p-3 {
    padding: 10px !important;
    margin-bottom: 10px !important;
}
</style>
</head>
<body  style="{{$css}}">
 
	<section class="login-area up_login">
 
		<div class="container">
			
			<div class="row justify-content-center align-items-center" style="margin-top: 25px !important;">
				<div class="col-lg-6 col-md-8 text-center mt-30 btn-group" id="btn-group">

					<div class="loginButton">
						<div class="singleLoginButton">
							
								<form method="POST" class="loginForm" action="<?php echo e(route('login')); ?>">
			                        <?php 
			                        echo csrf_field();
			                        $user =  DB::table('users')->select('email')->where('role_id',1)->first();
			                        $email = $user->email;

			                        ?>
			                        <input type="hidden" name="email" value="{{$email}}">
			                        <input type="hidden" name="password" value="123456">
			                        <button type="submit" class="white get-login-access">Super Admin</button>
			                    </form>

						</div>
						<div class="singleLoginButton">
							
								<form method="POST" class="loginForm" action="<?php echo e(route('login')); ?>">
			                        <?php 
			                        echo csrf_field();
			                        $user =  DB::table('users')->select('email')->where('role_id',5)->first();
			                        $email = $user->email; ?>
			                        <input type="hidden" name="email" value="{{$email}}">
			                        <input type="hidden" name="password" value="123456">

			                        <button type="submit" class="white get-login-access">Admin</button>
			                    </form>
						</div>
						<div class="singleLoginButton">
							
								<form method="POST" class="loginForm" action="<?php echo e(route('login')); ?>">
			                        <?php 
			                        echo csrf_field();
			                        $user =  DB::table('users')->select('email')->where('role_id',4)->first();
			                        $email = $user->email; ?>

			                        <input type="hidden" name="email" value="{{$email}}">
			                        <input type="hidden" name="password" value="123456">

			                        <button type="submit" class="white get-login-access">Teacher</button>
			                    </form>
						</div>
						<div class="singleLoginButton">
							
								<form method="POST" class="loginForm" action="<?php echo e(route('login')); ?>">
			                        <?php 
			                        echo csrf_field();
			                        $user =  DB::table('users')->select('email')->where('role_id',6)->first();
			                        $email = $user->email; ?>
			                        <input type="hidden" name="email" value="{{$email}}">

			                        <input type="hidden" name="password" value="123456">

			                        <button type="submit" class="white get-login-access">Accountant</button>
			                    </form>
						</div>
						<div class="singleLoginButton">
							
								<form method="POST" class="loginForm" action="<?php echo e(route('login')); ?>">
			                        <?php 
			                        echo csrf_field();
			                        $user =  DB::table('users')->select('email')->where('role_id',7)->first();
			                        $email = $user->email; ?>
			                        <input type="hidden" name="email" value="{{$email}}">
			                        <input type="hidden" name="password" value="123456">

			                        <button type="submit" class="white get-login-access">Receptionist</button>
			                    </form>
						</div>
						<div class="singleLoginButton">
							
								<form method="POST" class="loginForm" action="<?php echo e(route('login')); ?>">
			                        <?php 
			                        echo csrf_field();
			                        $user =  DB::table('users')->select('email')->where('role_id',8)->first();
			                        $email = $user->email; ?>
			                        <input type="hidden" name="email" value="{{$email}}">
			                        <input type="hidden" name="password" value="123456">

			                        <button type="submit" class="white get-login-access">Librarian</button>
			                    </form>
						</div>
						<div class="singleLoginButton">
							
								<form method="POST" class="loginForm" action="<?php echo e(route('login')); ?>">
			                        <?php 
			                        echo csrf_field();
			                        $user =  DB::table('users')->select('email')->where('role_id',2)->first();
			                        $email = $user->email; ?>
			                        <input type="hidden" name="email" value="{{$email}}">
			                        <input type="hidden" name="password" value="123456">

			                        <button type="submit" class="white get-login-access">Student</button>
			                    </form>
						</div>
						<div class="singleLoginButton">
							
								<form method="POST" class="loginForm" action="<?php echo e(route('login')); ?>">
			                        <?php 
			                        echo csrf_field();
			                        $user =  DB::table('users')->select('email')->where('role_id',3)->first();
			                        $email = $user->email; ?>
			                        <input type="hidden" name="email" value="{{$email}}">
			                        <input type="hidden" name="password" value="123456">

			                        <button type="submit" class="white get-login-access">Parents</button>
			                    </form>
						</div> 
					</div> 
							
				</div>
			</div>
			
			<input type="hidden" id="url" value="{{url('/')}}">
			<div class="row login-height justify-content-center align-items-center">
				<div class="col-lg-5 col-md-8">
					<div class="form-wrap text-center">
						<div class="logo-container">
							<a href="{{url('/')}}"> 
								<img src="{{asset($setting->logo)}}" alt="" class="logoimage">
							</a>
						</div>
						<h5 class="text-uppercase">Login Details</h5>

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
						<form method="POST" class="" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>

							<div class="form-group input-group mb-4 p-3">
								<span class="input-group-addon">
									<i class="ti-email"></i>
								</span>
								<input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name='email' id="email" placeholder="Enter Email address"/>
								@if ($errors->has('email'))
                                    <span class="invalid-feedback text-left pl-3" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
							</div>

							<div class="form-group input-group mb-4 p-3">
								<span class="input-group-addon">
									<i class="ti-key"></i>
								</span>
								<input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name='password' id="password" placeholder="Enter Password"/>
								@if ($errors->has('password'))
                                    <span class="invalid-feedback text-left pl-3" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
							</div>
							
							<div class="d-flex justify-content-between pl-30">
								<div class="checkbox">
									<input class="form-check-input" type="checkbox" name="remember" id="rememberMe" {{ old('remember') ? 'checked' : '' }}>
									<label for="rememberMe">Remember Me</label>
								</div>
								<div>
									<a href="<?php echo e(url('recovery/passord')); ?>">Forget Password?</a>
								</div>
							</div>

							<div class="form-group mt-30">
								<button type="submit" class="primary-btn fix-gr-bg">
									<span class="ti-lock mr-2"></span>
									Login
                                </button>
							</div>
						</form>
					</div>
					
				</div>
			</div>
			
			<div class="row justify-content-center d-none d-md-block">
				<div class="col-lg-12 text-center">
					<p  style="margin-top: 25px !important;">{!! $copyright_text !!}</p>
				</div>
			</div>
		</div> 
	</section> 
    <script src="{{asset('public/backEnd/')}}/vendors/js/jquery-3.2.1.min.js"></script>
    <script src="{{asset('public/backEnd/')}}/vendors/js/popper.js"></script>
	<script src="{{asset('public/backEnd/')}}/vendors/js/bootstrap.min.js"></script>
	<script src="{{asset('public/backEnd/')}}/js/login.js"></script>
	 

</body>
</html> 
