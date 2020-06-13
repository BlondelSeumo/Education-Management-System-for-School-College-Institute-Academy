<?php
$setting = App\SmGeneralSettings::find(1);
if(isset($setting->copyright_text)){ $copyright_text = $setting->copyright_text; }else{ $copyright_text = 'Copyright © 2019 All rights reserved | This template is made with by Codethemes'; }
if(isset($setting->logo)) { $logo = $setting->logo; } else{ $logo = 'public/uploads/settings/logo.png'; }

if(isset($setting->favicon)) { $favicon = $setting->favicon; } else{ $favicon = 'public/backEnd/img/favicon.png'; }
 
$login_background = App\SmBackgroundSetting::where([['is_default',1],['title','Login Background']])->first(); 
 
if(empty($login_background)){
    $css = "";
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

<!doctype html>
<html lang="en">

<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <link rel="stylesheet" href="{{asset('public/backEnd/login2')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/login2')}}/themify-icons.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/login2')}}/css/style.css">
    <title>{{isset($setting)? !empty($setting->site_title) ? $setting->site_title : 'System ': 'System '}} | @lang('lang.login')</title>
</head> 
  <body >
     <div class="in_login_part"  style="{{$css}}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-lg-5 col-xl-4 col-md-6">
                    <div class="in_login_content">
                        @if(!empty($setting->logo))<img src="{{asset($setting->logo)}}" alt="Login Panel">@endif
                        <div class="in_login_page_iner">
                            <div class="in_login_page_header">
                                <h5>@lang('lang.login') @lang('lang.details')</h5>
                            </div>
                                <form method="POST" class="loginForm" action="{{url('/login')}}">
                                    @csrf
                                    
                                  <?php if(session()->has('message-danger') != ""): ?>
                                      <?php if(session()->has('message-danger')): ?>
                                      <p class="text-danger"><?php echo e(session()->get('message-danger')); ?></p>
                                      <?php endif; ?>
                                  <?php endif; ?>
                                    <input type="hidden" id="url" value="{{url('/')}}"> 
                          
                                <div class="in_single_input">
                                    <input type="email" placeholder="@lang('lang.enter') @lang('lang.email')" name="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{old('email')}}">
                                    <span class="addon_icon">
                                        <i class="ti-email"></i>
                                    </span>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback text-left pl-3 d-block" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="in_single_input">
                                    <input type="password" placeholder="@lang('lang.enter')  @lang('lang.password')" name="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{old('password')}}">
                                    <span class="addon_icon">
                                        <i class="ti-key"></i>
                                    </span>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback text-left pl-3 d-block" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="in_checkbox">
                                        <div class="boxes">
                                            <input type="checkbox" id="Remember">
                                            <label for="Remember">@lang('lang.remember_me')</label>
                                        </div>
                                    </div>
                                    <div class="in_forgot_pass">
                                        <a href="{{url('recovery/passord')}}">@lang('lang.forget') @lang('lang.password') ? </a>
                                    </div>
                                </div>
                                <div class="in_login_button text-center">
                                    <button type="submit" class="in_btn">
                                        <span class="ti-lock"></span>
                                        @lang('lang.login')
                                    </button>
                                </div>
                                {{-- <div class="create_account text-center">
                                    <p>Don’t have an account? <a href="#">Create Here</a></p>
                                </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{asset('public/backEnd/login2')}}/js/jquery-3.4.1.min.js"></script>
    <script src="{{asset('public/backEnd/login2')}}/js/popper.min.js"></script>
    <script src="{{asset('public/backEnd/login2')}}/js/bootstrap.min.js"></script> 
  </body>
</html>