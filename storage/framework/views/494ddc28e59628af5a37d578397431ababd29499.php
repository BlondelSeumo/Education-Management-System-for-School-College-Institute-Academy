<?php $__env->startSection('mainContent'); ?>
<style type="text/css">
    .smtp_wrapper{
        display: none;
    }
    .smtp_wrapper_block{
        display: block;
    }
</style>

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.email_settings'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.system_settings'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.email_settings'); ?> </a>
            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30"> <?php echo app('translator')->getFromJson('lang.select'); ?><?php echo app('translator')->getFromJson('lang.email_settings'); ?></h3>
                </div>
            </div>
        </div>
        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'method' => 'POST', 'url' => 'update-email-settings-data', 'id' => 'email_settings1', 'enctype' => 'multipart/form-data'])); ?>

        <div class="row">
            <div class="col-lg-12">
                <?php if(session()->has('message-success')): ?>
                <div class="alert alert-success">
                  <?php echo e(session()->get('message-success')); ?>

              </div>
              <?php elseif(session()->has('message-danger')): ?>
              <div class="alert alert-danger">
                  <?php echo e(session()->get('message-danger')); ?>

              </div>
              <?php endif; ?>
              <div class="white-box">
                <div class="">
                     <input type="hidden" name="email_settings_url" id="email_settings_url" value="update-email-settings-data">
                     <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>"> 
                     <input type="hidden" name="engine_type" id="engine_type" value="0">
                    
                    <div class="row justify-content-center mb-30">
                        <div class="col-lg-4">
                            <div class="input-effect">
                                <input class="primary-input form-control<?php echo e($errors->has('from_name') ? ' is-invalid' : ''); ?>"
                                type="text" name="from_name" id="from_name" autocomplete="off" value="<?php echo e(isset($editData)? $editData->from_name : ''); ?>">
                                <label><?php echo app('translator')->getFromJson('lang.from_name'); ?><span>*</span> </label>
                                <span class="focus-border"></span>
                                <?php if($errors->has('from_name')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('from_name')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                   
                    <div class="row justify-content-center mb-30">
                        <div class="col-lg-4">
                            <div class="input-effect">
                                <input class="primary-input form-control<?php echo e($errors->has('from_email') ? ' is-invalid' : ''); ?>"
                                type="text" name="from_email" id="from_email" autocomplete="off" value="<?php echo e(isset($editData)? $editData->from_email : ''); ?>">
                                <label><?php echo app('translator')->getFromJson('lang.from'); ?> <?php echo app('translator')->getFromJson('lang.mail'); ?><span>*</span> </label>
                                <span class="focus-border"></span>
                                 <?php if($errors->has('from_email')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('from_email')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <?php if($editData->email_engine_type == 'email'): ?>
                    <div class="smtp_wrapper">
                    <?php else: ?>
                    <div class="smtp_wrapper_block">
                    <?php endif; ?>
              
                    <div class="smtp_inner_wrapper">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 mb-30">
                            <div class="input-effect">
                                <input class="primary-input form-control<?php echo e($errors->has('mail_driver') ? ' is-invalid' : ''); ?>"
                                type="text" name="mail_driver" id="mail_driver" autocomplete="off" value="<?php echo e(isset($editData)? $editData->mail_driver : ''); ?>">
                                <label><?php echo app('translator')->getFromJson('lang.mail'); ?> <?php echo app('translator')->getFromJson('lang.driver'); ?> <span>*</span> </label>
                                <span class="focus-border"></span>
                                <span class="modal_input_validation red_alert"></span>
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-center">
                        <div class="col-lg-4 mb-30">
                            <div class="input-effect">
                                <input class="primary-input form-control<?php echo e($errors->has('mail_host') ? ' is-invalid' : ''); ?>"
                                type="text" name="mail_host" id="mail_host" autocomplete="off" value="<?php echo e(isset($editData)? $editData->mail_host : ''); ?>">
                                <label><?php echo app('translator')->getFromJson('lang.mail'); ?> <?php echo app('translator')->getFromJson('lang.host'); ?> <span>*</span> </label>
                                <span class="focus-border"></span>
                                <span class="modal_input_validation red_alert"></span>
                            </div>
                        </div>
                      </div>

                       <div class="row justify-content-center">
                        <div class="col-lg-4 mb-30">
                            <div class="input-effect">
                                <input class="primary-input form-control<?php echo e($errors->has('mail_port') ? ' is-invalid' : ''); ?>"
                                type="text" name="mail_port" id="mail_port" autocomplete="off" value="<?php echo e(isset($editData)? $editData->mail_port : ''); ?>">
                                <label><?php echo app('translator')->getFromJson('lang.mail'); ?> <?php echo app('translator')->getFromJson('lang.port'); ?> <span>*</span> </label>
                                <span class="focus-border"></span>
                                <span class="modal_input_validation red_alert"></span>
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-center">
                        <div class="col-lg-4 mb-30">
                            <div class="input-effect">
                                <input class="primary-input form-control<?php echo e($errors->has('mail_username') ? ' is-invalid' : ''); ?>"
                                type="text" name="mail_username" id="mail_username" autocomplete="off" value="<?php echo e(isset($editData)? $editData->mail_username : ''); ?>">
                                <label><?php echo app('translator')->getFromJson('lang.mail'); ?> <?php echo app('translator')->getFromJson('lang.username'); ?> <span>*</span> </label>
                                <span class="focus-border"></span>
                                <span class="modal_input_validation red_alert"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4 mb-30">
                            <div class="input-effect">
                                <input class="primary-input form-control<?php echo e($errors->has('mail_password') ? ' is-invalid' : ''); ?>"
                                type="password" name="mail_password" id="mail_password" autocomplete="off" value="<?php echo e(isset($editData)? $editData->mail_password : ''); ?>">
                                <label><?php echo app('translator')->getFromJson('lang.mail'); ?> <?php echo app('translator')->getFromJson('lang.password'); ?> <span>*</span> </label>
                                <span class="focus-border"></span>
                                <span class="modal_input_validation red_alert"></span>
                            </div>
                        </div>
                    </div>
                    
                   
                    
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-4 mb-30">
                            <div class="input-effect">
                                <input class="primary-input form-control<?php echo e($errors->has('mail_encryption') ? ' is-invalid' : ''); ?>"
                                type="text" name="mail_encryption" id="mail_encryption" autocomplete="off" value="<?php echo e(isset($editData)? $editData->mail_encryption : ''); ?>">
                                <label><?php echo app('translator')->getFromJson('lang.mail'); ?> <?php echo app('translator')->getFromJson('lang.encryption'); ?> <span>*</span> </label>
                                <span class="focus-border"></span>
                                <span class="modal_input_validation red_alert"></span>
                            </div>
                        </div>
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
        </div>
    </div>
</div>
<?php echo e(Form::close()); ?>

</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>