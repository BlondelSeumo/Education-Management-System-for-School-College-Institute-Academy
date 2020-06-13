<?php

    use App\SmBackgroundSetting;
    use App\SmGeneralSettings;
    use App\SmNotification;
    use App\SmParent;
    use App\SmRolePermission;
    use App\SmStaff;
    use App\SmStudent;
    use App\SmStyle;
    use App\User;

    if (Auth::user() == "") {
        header('location:' . url('/login'));
        exit();
    }

    $styles = SmStyle::where('active_status', 1)->get();
    if (!empty(Auth::user())) {

        $ROLE_ID = Auth::user()->role_id;

        if ($ROLE_ID != 1 && $ROLE_ID != 3 && $ROLE_ID != 10) {
            $notifications = SmNotification::notifications();
        } else {
            $notifications = [];
        }

        if ($ROLE_ID == 2) {

            $LoginUser = SmStudent::where('user_id', Auth::user()->id)->first();
            if (empty($LoginUser)) {
                $profile = 'public/backEnd/img/admin/message-thumb.png';
            } else {
                $profile = $LoginUser->student_photo;
            }
        } elseif ($ROLE_ID == 3) {
            $LoginUser = SmParent::where('user_id', Auth::user()->id)->first();
            if (empty($LoginUser)) {
                $profile = 'public/backEnd/img/admin/message-thumb.png';
            } else {
                $profile = $LoginUser->fathers_photo;
            }
        } else {
            $LoginUser = SmStaff::where('user_id', Auth::user()->id)->first();

            if (empty($LoginUser)) {
                $profile = 'public/backEnd/img/admin/message-thumb.png';
            } else {
                $profile = $LoginUser->staff_photo;
            }
        }

        if (Auth::user()->role_id == 3) {
            $childrens = SmParent::myChildrens();
        }
    }

    $dashboard_background = SmBackgroundSetting::where([['is_default', 1], ['title', 'Dashboard Background']])->first();
    if (empty($dashboard_background)) {
        $css = "background: url('/public/backEnd/img/body-bg.jpg')  no-repeat center; background-size: cover; ";
    } else {
        if (!empty($dashboard_background->image)) {
            $css = "background: url('" . url($dashboard_background->image) . "')  no-repeat center; background-size: cover; ";
        } else {
            $css = "background:" . $dashboard_background->color;
        }
    }
    $active_style = SmStyle::where('is_active', 1)->first();



    $generalSetting = $config = SmGeneralSettings::find(1);
    if(empty ( $config)){
                 DB::table('sm_general_settings')->insert([ 
          [
              'copyright_text'=>'Copyright &copy; 2019 All rights reserved | This template is made with <span class="ti-heart"> </span> by Codethemes',
              'logo'=>'public/uploads/settings/logo.png',
              'favicon'=>'public/uploads/settings/favicon.png',
              'currency'=>'USD',
              'school_name'=>'Infix Edu',
              'date_format_id'=>1,
              'site_title'=>'Infix Edu' 
          ]
         ]); 
    } 

    $generalSetting = $config = SmGeneralSettings::find(1);

    

    if (!empty($config->logo)) {
        $logo = $config->logo;
    } else {
        $logo = 'public/uploads/settings/logo.png';
    }

    if (!empty($config->favicon)) {
        $fav = $config->favicon;
    } else {
        $fav = 'public/backEnd/img/favicon.png';
    }
    if (!empty($config->site_title)) {
        $site_title = $config->site_title;
    } else {
        $site_title = 'School Management System';
    }
    if (!empty($config->school_name)) {
        $school_name = $config->school_name;
    } else {
        $school_name = 'Infix Edu ERP';
    }

    //DATE FORMAT
    $system_date_foramt = App\SmDateFormat::find($config->date_format_id);
    $DATE_FORMAT =  $system_date_foramt->format;

    $ttl_rtl = isset($config->ttl_rtl) ? $config->ttl_rtl : 2;
?><!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" <?php if(isset ($ttl_rtl ) && $ttl_rtl ==1): ?> dir="rtl" class="rtl" <?php endif; ?> >
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="icon" href="<?php echo e(url('/')); ?>/<?php echo e(isset($fav)?$fav:''); ?>" type="image/png"/>
    <title><?php echo e($school_name); ?> | <?php echo e($site_title); ?></title>
    <meta name="_token" content="<?php echo csrf_token(); ?>"/>
    <!-- Bootstrap CSS -->

    <?php if(isset ($ttl_rtl ) && $ttl_rtl ==1): ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/rtl/bootstrap.min.css"/>
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap.css"/>
    <?php endif; ?>


    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/jquery-ui.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/jquery.data-tables.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/responsive.dataTables.min.css">


    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/themify-icons.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/flaticon.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/nice-select.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/magnific-popup.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/fastselect.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/toastr.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/select2/select2.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/fullcalendar.min.css">
    
    <?php echo $__env->yieldContent('css'); ?>

    <?php if(isset ($ttl_rtl ) && $ttl_rtl ==1): ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/rtl/style.css"/>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/rtl/infix.css"/>
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/<?php echo e(@$active_style->path_main_style); ?>"/>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/<?php echo e(@$active_style->path_infix_style); ?>"/>
    <?php endif; ?>


    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: <?php echo e($active_style->primary_color2); ?>      !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: <?php echo e($active_style->primary_color2); ?>      !important;
        }

        ::placeholder {
            color: <?php echo e($active_style->primary_color); ?>      !important;
        }
    </style>

    <script type="text/javascript">
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>
    <script type="text/javascript">
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode != 46 && (charCode < 48 || charCode > 57)))
                return false;
            return true;
        }
    </script>
</head>
<body class="admin"
      style=" <?php if($active_style->id==1): ?> <?php echo e($css); ?> <?php else: ?> background:<?php echo e($active_style->dashboardbackground); ?> !important; <?php endif; ?> ">
<div class="main-wrapper" style="min-height: 600px">
    <!-- Sidebar  -->
<?php echo $__env->make('backEnd.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- Page Content  -->
    <div id="main-content">
<?php echo $__env->make('backEnd.partials.menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
