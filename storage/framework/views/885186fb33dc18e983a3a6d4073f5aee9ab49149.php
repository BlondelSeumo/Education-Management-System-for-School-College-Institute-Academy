<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.payment_method_settings'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.system_settings'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.payment_method_settings'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="mb-40 student-details">
    <div class="container-fluid p-0">
        <div class="row">

            
                <!-- Select a Payment Gateway -->    
                 <div class="col-lg-3">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.select_a_payment_gateway'); ?></h3>  
                    </div>
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'is-active-payment'])); ?>


                    <div class="white-box">
                        <div class="row mt-40">
                            <div class="col-lg-12">
                                 <?php $__currentLoopData = $paymeny_gateway; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="input-effect">
                                        <input type="checkbox" id="gateway_<?php echo e($value->method); ?>" class="common-checkbox class-checkbox" name="gateways[<?php echo e($value->id); ?>]" value="<?php echo e($value->id); ?>" <?php echo e($value->active_status == 1? 'checked':''); ?>>
                                        <label for="gateway_<?php echo e($value->method); ?>"><?php echo e($value->method); ?></label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                        <?php if($errors->has('gateways')): ?>
                                            <span class="text-danger validate-textarea-checkbox" role="alert">
                                                <strong><?php echo e($errors->first('gateways')); ?></strong>
                                            </span>
                                        <?php endif; ?>

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
                <!-- End Select a Payment Gateway -->  


            <div class="col-lg-9">
                 <ul class="nav nav-tabs justify-content-end" role="tablist">
                    <?php $__currentLoopData = $paymeny_gateway_settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        <li class="nav-item">
                            <a class="nav-link <?php if($row->gateway_name=='PayPal'): ?> active show <?php endif; ?> " href="#<?php echo e($row->gateway_name); ?>" role="tab" data-toggle="tab"><?php echo e($row->gateway_name); ?></a> 
                        </li> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                </ul>



                <!-- Tab panes -->
                <div class="tab-content">

                    <?php $__currentLoopData = $paymeny_gateway_settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 

                            <div role="tabpanel" class="tab-pane fade   <?php if($row->gateway_name=='PayPal'): ?> active show <?php endif; ?> " id="<?php echo e($row->gateway_name); ?>">
 

                                <form class="form-horizontal" action="<?php echo e(url('/update-payment-gateway')); ?>" method="POST">
                                    <?php echo csrf_field(); ?> 
                                    <div class="white-box">

                                        

                                        <div class="">
                                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>"> 
                                            <input type="hidden" name="gateway_name" id="gateway_<?php echo e($row->gateway_name); ?>" value="<?php echo e($row->gateway_name); ?>"> 
                                            <div class="row mb-30">
                                               <div class="col-md-5">
                                                <?php 
                                                if($row->gateway_name=="PayPal"){
                                                    $paymeny_gateway = ['gateway_name','gateway_username','gateway_password','gateway_signature','gateway_client_id','gateway_mode','gateway_secret_key'];
                                                } 
                                                else if($row->gateway_name=="Stripe"){ 
                                                    $paymeny_gateway = ['gateway_name','gateway_username','gateway_secret_key','gateway_publisher_key']; 
                                                }
                                                else{ 
                                                    $paymeny_gateway = ['gateway_name','gateway_username','gateway_secret_key','gateway_publisher_key'];
                                                }
                                                    $count=0;
                                                    foreach ($paymeny_gateway as $input_field) {
                                                        $newStr = $input_field;
                                                        $label_name = str_replace('_', ' ', $newStr);  
                                                        $value= $row->$input_field; ?>
                                                        <div class="row">
                                                            <div class="col-lg-12 mb-30">
                                                                <div class="input-effect">
                                                                    <input class="primary-input form-control<?php echo e($errors->has($input_field) ? ' is-invalid' : ''); ?>"
                                                                    type="text" name="<?php echo e($input_field); ?>" id="gateway_<?php echo e($input_field); ?>" autocomplete="off" value="<?php echo e(isset($value)? $value : ''); ?>" <?php if($count==0): ?> readonly="" <?php endif; ?>>
                                                                    <label><?php echo e($label_name); ?> <span></span> </label>
                                                                    <span class="focus-border"></span>
                                                                    <span class="modal_input_validation red_alert"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                

                                                    <?php $count++; } ?>


                                            </div>

                                            <div class="col-md-7">
                                                <div class="row justify-content-center">
                                                    <?php if(!empty($row->logo)): ?>
                                                        <img class="logo"  src="<?php echo e(URL::asset($row->logo)); ?>" style="width: auto; height: 100px; ">  

                                                    <?php endif; ?>


                                                </div>
                                                <div class="row justify-content-center">
                                                  
                                                        <?php if(session()->has('message-success')): ?>
                                                          <p class=" text-success">
                                                              <?php echo e(session()->get('message-success')); ?>

                                                          </p>
                                                        <?php elseif(session()->has('message-danger')): ?>
                                                          <p class=" text-danger">
                                                              <?php echo e(session()->get('message-danger')); ?>

                                                          </p>
                                                        <?php endif; ?> 
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
                            </form>



                        </div> 

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

                </div>
            </div>



        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>