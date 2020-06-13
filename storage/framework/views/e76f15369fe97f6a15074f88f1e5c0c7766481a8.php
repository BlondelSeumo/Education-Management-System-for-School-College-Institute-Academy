<?php $__env->startSection('mainContent'); ?>

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Change Password</h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>">Dashboard</a>
                <a href="#">Change Password</a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area mb-40">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">Change Password </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                
                <div class="white-box">
                	<?php if(session()->has('message-success') != ""): ?>
	                    <?php if(session()->has('message-success')): ?>
	                    <div class="alert alert-success">
	                        <?php echo e(session()->get('message-success')); ?>

	                    </div>
	                    <?php endif; ?>
	                <?php endif; ?>
	                 <?php if(session()->has('message-danger') != ""): ?>
	                    <?php if(session()->has('message-danger')): ?>
	                    <div class="alert alert-danger">
	                        <?php echo e(session()->get('message-danger')); ?>

	                    </div>
	                    <?php endif; ?>
	                <?php endif; ?>
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'admin-change-password', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">

                            <div class="row mb-25">
	                            <div class="col-lg-6 offset-lg-3">
		                            <div class="input-effect">
		                                <input class="primary-input form-control<?php echo e($errors->has('current_password') || session()->has('password-error') ? ' is-invalid' : ''); ?>" type="text" name="current_password">
		                                <label>Current Password</label>
		                                <span class="focus-border"></span>
		                                <?php if($errors->has('current_password')): ?>
		                                <span class="invalid-feedback" role="alert">
		                                    <strong><?php echo e($errors->first('current_password')); ?></strong>
		                                </span>
		                                <?php endif; ?>
		                                <?php if(session()->has('password-error')): ?>
		                                <span class="invalid-feedback" role="alert">
		                                    <strong><?php echo e(session()->get('password-error')); ?></strong>
		                                </span>
		                                <?php endif; ?>
		                            </div>
		                        </div>
		                    </div>

                            <div class="row mb-25">
	                            <div class="col-lg-6 offset-lg-3">
		                            <div class="input-effect">
		                                <input class="primary-input form-control<?php echo e($errors->has('new_password') ? ' is-invalid' : ''); ?>" type="text" name="new_password">
		                                <label>New Password</label>
		                                <span class="focus-border"></span>
		                                <?php if($errors->has('new_password')): ?>
		                                <span class="invalid-feedback" role="alert">
		                                    <strong><?php echo e($errors->first('new_password')); ?></strong>
		                                </span>
		                                <?php endif; ?>
		                            </div>
		                        </div>
		                    </div>

                            <div class="row mb-25">
	                            <div class="col-lg-6 offset-lg-3">
		                            <div class="input-effect">
		                                <input class="primary-input form-control<?php echo e($errors->has('confirm_password') ? ' is-invalid' : ''); ?>" type="text" name="confirm_password">
		                                <label>Confirm Password</label>
		                                <span class="focus-border"></span>
		                                <?php if($errors->has('confirm_password')): ?>
		                                <span class="invalid-feedback" role="alert">
		                                    <strong><?php echo e($errors->first('confirm_password')); ?></strong>
		                                </span>
		                                <?php endif; ?>
		                            </div>
		                        </div>
		                    </div>


                            

                            <div class="row">
	                            <div class="col-lg-12 mt-20 text-center">


                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo ">
                      <button class="primary-btn small fix-gr-bg  demo_view" style="pointer-events: none;" type="button" disabled>Change Password </button>
                    </span>





	                            </div>
	                        </div>
                       
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>