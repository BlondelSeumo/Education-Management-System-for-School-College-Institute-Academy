<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.sms_settings'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.system_settings'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.sms_settings'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="mb-40 student-details">
    <div class="container-fluid p-0">
        <div class="row">


            <!-- Start Sms Details -->
            <div class="col-lg-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#select_sms_service" role="tab" data-toggle="tab"><?php echo app('translator')->getFromJson('lang.select_a_SMS_service'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#clickatell_settings" role="tab" data-toggle="tab"><?php echo app('translator')->getFromJson('lang.clickatell'); ?> <?php echo app('translator')->getFromJson('lang.settings'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#twilio_settings" role="tab" data-toggle="tab"><?php echo app('translator')->getFromJson('lang.twilio'); ?> <?php echo app('translator')->getFromJson('lang.settings'); ?></a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="#msg91_settings" role="tab" data-toggle="tab">MSG91 Settings</a>
                    </li> 
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane fade show active" id="select_sms_service">
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'update-clickatell-data', 'id' => 'select_a_service'])); ?>

                       <div class="white-box">
                       <div class="row">
                        <div class="col-lg-4 select_sms_services">
                                <div class="input-effect">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('book_category_id') ? ' is-invalid' : ''); ?>" name="sms_service" id="sms_service">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_a_SMS_service'); ?>" value=""><?php echo app('translator')->getFromJson('lang.select_a_SMS_service'); ?></option>
                                        <?php if(isset($sms_services)): ?>
                                        <?php $__currentLoopData = $sms_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value->id); ?>"  <?php if(isset($active_sms_service)): ?> <?php if($active_sms_service->id == $value->id): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e($value->gateway_name); ?></option>
 
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('book_category_id')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('book_category_id')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div> 
                            <div class="col-lg-8">
                                
                                        <?php if(session()->has('message-success')): ?>
                                          <div class="alert alert-success">
                                              <?php echo e(session()->get('message-success')); ?>

                                          </div>
                                        <?php elseif(session()->has('message-danger')): ?>
                                          <div class="alert alert-danger">
                                              <?php echo e(session()->get('message-danger')); ?>

                                          </div>
                                        <?php endif; ?>
                            </div>
                            </div>
                       
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>

                <div role="tabpanel" class="tab-pane fade" id="clickatell_settings">
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'update-clickatell-data', 'id' => 'clickatell_form'])); ?>

                <div class="white-box">
                        <div class="">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>"> 
                            <input type="hidden" name="clickatell_form" id="clickatell_form_url" value="update-clickatell-data">
                            <input type="hidden" name="gateway_id" id="gateway_id" value="1"> 
                            <div class="row mb-30">

                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('clickatell_username') ? ' is-invalid' : ''); ?>"
                                                type="text" name="clickatell_username" id="clickatell_username" autocomplete="off" value="<?php echo e(isset($sms_services)? $sms_services[0]->clickatell_username : ''); ?>">
                                                <label><?php echo app('translator')->getFromJson('lang.clickatell'); ?> <?php echo app('translator')->getFromJson('lang.username'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <span class="modal_input_validation red_alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('book_title') ? ' is-invalid' : ''); ?>"
                                                type="text" name="clickatell_password" id="clickatell_password" autocomplete="off" value="<?php echo e(isset($sms_services)? $sms_services[0]->clickatell_password : ''); ?>">
                                                <label><?php echo app('translator')->getFromJson('lang.clickatell'); ?> <?php echo app('translator')->getFromJson('lang.password'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                               <span class="modal_input_validation red_alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('clickatell_api_id') ? ' is-invalid' : ''); ?>"
                                                type="text" name="clickatell_api_id" id="clickatell_api_id" autocomplete="off" value="<?php echo e(isset($sms_services)? $sms_services[0]->clickatell_api_id : ''); ?>">
                                                <label><?php echo app('translator')->getFromJson('lang.clickatell'); ?> <?php echo app('translator')->getFromJson('lang.api'); ?> <?php echo app('translator')->getFromJson('lang.id'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('clickatell_api_id')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('clickatell_api_id')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <div class="row justify-content-center">
                                         <img class="logo" width="" height="" src="<?php echo e(URL::asset('public/backEnd/img/Clickatell.png')); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-40">
                            <div class="col-lg-12 text-center">
                                <button class="primary-btn fix-gr-bg">
                                    <span class="ti-check"></span>
                                    <?php echo app('translator')->getFromJson('lang.update'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
            <?php echo e(Form::close()); ?>

            </div>
            <!-- End Profile Tab -->

            <!-- Start Exam Tab -->
            <div role="tabpanel" class="tab-pane fade" id="twilio_settings">
            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'update-twilio-data', 'id' => 'twilio_form'])); ?>

                <div class="white-box">
                        <div class="">
                            <input type="hidden" name="twilio_form" id="twilio_form_url" value="update-twilio-data">
                            <input type="hidden" name="gateway_id" id="gateway_id" value="2"> 
                            <div class="row mb-30">

                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('book_title') ? ' is-invalid' : ''); ?>"
                                                type="text" name="twilio_account_sid" autocomplete="off" value="<?php echo e(isset($sms_services)? $sms_services[1]->twilio_account_sid : ''); ?>" id="twilio_account_sid">
                                                <label><?php echo app('translator')->getFromJson('lang.twilio'); ?> <?php echo app('translator')->getFromJson('lang.account'); ?> <?php echo app('translator')->getFromJson('lang.sid'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('book_title') ? ' is-invalid' : ''); ?>"
                                                type="text" name="twilio_authentication_token" autocomplete="off" value="<?php echo e(isset($sms_services)? $sms_services[1]->twilio_authentication_token : ''); ?>" id="twilio_authentication_token">
                                                <label><?php echo app('translator')->getFromJson('lang.authentication'); ?> <?php echo app('translator')->getFromJson('lang.token'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('book_title')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('book_title')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('book_title') ? ' is-invalid' : ''); ?>"
                                                type="text" name="twilio_registered_no" autocomplete="off" value="<?php echo e(isset($sms_services)? $sms_services[1]->twilio_registered_no : ''); ?>" id="twilio_registered_no">
                                                <label><?php echo app('translator')->getFromJson('lang.registered_phone_number'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('book_title')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('book_title')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <div class="row justify-content-center">
                                         <img class="logo" width="250" height="90" src="<?php echo e(URL::asset('public/backEnd/img/twilio.png')); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-40">
                            <div class="col-lg-12 text-center">
                                <button class="primary-btn fix-gr-bg">
                                    <span class="ti-check"></span>
                                    <?php echo app('translator')->getFromJson('lang.update'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
            <?php echo e(Form::close()); ?>

            </div>
            

            <div role="tabpanel" class="tab-pane fade" id="msg91_settings"> 
            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'update-msg91-data', 'method'=>'POST'])); ?>

                <div class="white-box">  
                    <input type="hidden" name="msg91_form" id="msg91_form_url" value="update-msg91-data">
                    <input type="hidden" name="gateway_id" id="gateway_id" value="3"> 
                            <div class="row mb-30">
                               <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('book_title') ? ' is-invalid' : ''); ?>"
                                                type="text" id="msg91_authentication_key_sid" name="msg91_authentication_key_sid" autocomplete="off" value="<?php echo e(isset($sms_services)? $sms_services[2]->msg91_authentication_key_sid : ''); ?>"> 
                                                <label> Authentication KEY SID <span>*</span> </label> 
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('book_title')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('book_title')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('book_title') ? ' is-invalid' : ''); ?>"
                                                type="text" name="msg91_sender_id" autocomplete="off" value="<?php echo e(isset($sms_services)? $sms_services[2]-> msg91_sender_id : ''); ?>" id="msg91_sender_id">
                                                <label><?php echo app('translator')->getFromJson('lang.sender'); ?> <?php echo app('translator')->getFromJson('lang.id'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('book_title')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('book_title')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('book_title') ? ' is-invalid' : ''); ?>"
                                                type="text" name="msg91_route" autocomplete="off" value="<?php echo e(isset($sms_services)? $sms_services[2]-> msg91_route : ''); ?>" id="msg91_route">
                                                <label><?php echo app('translator')->getFromJson('lang.route'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('book_title')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('book_title')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('book_title') ? ' is-invalid' : ''); ?>"
                                                type="text" name="msg91_country_code" autocomplete="off" value="<?php echo e(isset($sms_services)? $sms_services[2]-> msg91_country_code : ''); ?>" id="msg91_country_code">
                                                <label><?php echo app('translator')->getFromJson('lang.country_code'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('book_title')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('book_title')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <div class="row justify-content-center">
                                         <img class="logo" width="" height="" src="<?php echo e(URL::asset('public/backEnd/img/MSG91-logo.png')); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-40">
                            <div class="col-lg-12 text-center"> 
                                <button class="primary-btn fix-gr-bg" type="submit"> 
                                    <span class="ti-check"></span>
                                    <?php echo app('translator')->getFromJson('lang.update'); ?>
                                    
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                   </div>
     
                </div>
            </div>
          </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>