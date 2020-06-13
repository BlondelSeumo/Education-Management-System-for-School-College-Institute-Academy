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
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/login2')); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/login2')); ?>/themify-icons.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/login2')); ?>/css/style.css">
    <title><?php echo e(isset($setting)? !empty($setting->site_title) ? $setting->site_title : 'System ': 'System '); ?> | <?php echo app('translator')->getFromJson('lang.login'); ?></title>
</head> 
  <body >
     <div class="in_login_part"  style="<?php echo e($css); ?>">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-lg-5 col-xl-4 col-md-6">
                    <div class="in_login_content">
                        <?php if(!empty($setting->logo)): ?><img src="<?php echo e(asset($setting->logo)); ?>" alt="Login Panel"><?php endif; ?>
                        <div class="in_login_page_iner">
                            <div class="in_login_page_header">
                                <h5><?php echo app('translator')->getFromJson('lang.login'); ?> <?php echo app('translator')->getFromJson('lang.details'); ?></h5>
                            </div>
                                <form method="POST" class="loginForm" action="<?php echo e(url('/login')); ?>">
                                    <?php echo csrf_field(); ?>
                                    
                                  <?php if(session()->has('message-danger') != ""): ?>
                                      <?php if(session()->has('message-danger')): ?>
                                      <p class="text-danger"><?php echo e(session()->get('message-danger')); ?></p>
                                      <?php endif; ?>
                                  <?php endif; ?>
                                    <input type="hidden" id="url" value="<?php echo e(url('/')); ?>"> 
                          
                                <div class="in_single_input">
                                    <input type="email" placeholder="<?php echo app('translator')->getFromJson('lang.enter'); ?> <?php echo app('translator')->getFromJson('lang.email'); ?>" name="email" class="<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('email')); ?>">
                                    <span class="addon_icon">
                                        <i class="ti-email"></i>
                                    </span>
                                    <?php if($errors->has('email')): ?>
                                        <span class="invalid-feedback text-left pl-3 d-block" role="alert">
                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="in_single_input">
                                    <input type="password" placeholder="<?php echo app('translator')->getFromJson('lang.enter'); ?>  <?php echo app('translator')->getFromJson('lang.password'); ?>" name="password" class="<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('password')); ?>">
                                    <span class="addon_icon">
                                        <i class="ti-key"></i>
                                    </span>
                                    <?php if($errors->has('password')): ?>
                                        <span class="invalid-feedback text-left pl-3 d-block" role="alert">
                                            <strong><?php echo e($errors->first('password')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="in_checkbox">
                                        <div class="boxes">
                                            <input type="checkbox" id="Remember">
                                            <label for="Remember"><?php echo app('translator')->getFromJson('lang.remember_me'); ?></label>
                                        </div>
                                    </div>
                                    <div class="in_forgot_pass">
                                        <a href="<?php echo e(url('recovery/passord')); ?>"><?php echo app('translator')->getFromJson('lang.forget'); ?> <?php echo app('translator')->getFromJson('lang.password'); ?> ? </a>
                                    </div>
                                </div>
                                <div class="in_login_button text-center">
                                    <button type="submit" class="in_btn">
                                        <span class="ti-lock"></span>
                                        <?php echo app('translator')->getFromJson('lang.login'); ?>
                                    </button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="<?php echo e(asset('public/backEnd/login2')); ?>/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo e(asset('public/backEnd/login2')); ?>/js/popper.min.js"></script>
    <script src="<?php echo e(asset('public/backEnd/login2')); ?>/js/bootstrap.min.js"></script> 
  </body>
</html>