 <?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.send_email'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.communicate'); ?></a>
                <a href="#"> <?php echo app('translator')->getFromJson('lang.Send_Email_Sms'); ?></a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.Send_Email_Sms'); ?> </h3>
                </div>
            </div>

        </div>
        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'send-email-sms', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

        <div class="row">
            <div class="col-lg-12">
                <?php if(session()->has('message-success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session()->get('message-success')); ?>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <?php elseif(session()->has('message-danger')): ?>
                <div class="alert alert-danger">
                    <?php echo e(session()->get('message-danger')); ?>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-7">
                        <div class="white-box">
                            <div class="">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="input-effect mb-30">
                                            <input class="primary-input form-control<?php echo e($errors->has('email_sms_title') ? ' is-invalid' : ''); ?>" type="text" name="email_sms_title" autocomplete="off" value="<?php echo e(old('email_sms_title')); ?>">
                                            <label><?php echo app('translator')->getFromJson('lang.title'); ?> <span>*</span> </label>
                                            <span class="focus-border"></span> <?php if($errors->has('email_sms_title')): ?>
                                            <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('email_sms_title')); ?></strong>
                        </span> <?php endif; ?>
                                        </div>
                                        <div class="col-lg-12 d-flex mb-20">
                                            <div class="row">
                                                <p class="text-uppercase fw-500 mb-10">Send Through</p>
                                                <div class="d-flex radio-btn-flex ml-40">
                                                    <div class="mr-30">
                                                        <input type="radio" name="send_through" id="Email" value="E" class="common-radio relationButton" checked>
                                                        <label for="Email"><?php echo app('translator')->getFromJson('lang.email'); ?></label>
                                                    </div>
                                                    <div class="mr-30">
                                                        <input type="radio" name="send_through" id="Sms" value="S" class="common-radio relationButton">
                                                        <label for="Sms"><?php echo app('translator')->getFromJson('lang.sms'); ?></label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-effect">
                                            <textarea class="primary-input form-control <?php echo e($errors->has('description') ? ' is-invalid' : ''); ?>" cols="0" rows="4" name="description" id="details"><?php echo e(old('description')); ?></textarea>
                                            <label><?php echo app('translator')->getFromJson('lang.description'); ?> <span>*</span> </label>
                                            <span class="focus-border textarea"></span> <?php if($errors->has('description')): ?>
                                            <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('description')); ?></strong>
                        </span> <?php endif; ?>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">

                        <div class="row student-details">

                            <!-- Start Sms Details -->
                            <div class="col-lg-12">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#group_email_sms" selectTab="G" role="tab" data-toggle="tab"><?php echo app('translator')->getFromJson('lang.group'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" selectTab="I" href="#indivitual_email_sms" role="tab" data-toggle="tab"><?php echo app('translator')->getFromJson('lang.individual'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" selectTab="C" href="#class_section_email_sms" role="tab" data-toggle="tab"><?php echo app('translator')->getFromJson('lang.class'); ?></a>
                                    </li>

                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <input type="hidden" name="selectTab" id="selectTab">
                                    <div role="tabpanel" class="tab-pane fade show active" id="group_email_sms">

                                        <div class="white-box">
                                            <div class="col-lg-12">
                                                <label><?php echo app('translator')->getFromJson('lang.message'); ?> <?php echo app('translator')->getFromJson('lang.to'); ?> </label>
                                                <br> <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="">

                                                    <input type="checkbox" id="role_<?php echo e($role->id); ?>" class="common-checkbox" value="<?php echo e($role->id); ?>" name="role[]">
                                                    <label for="role_<?php echo e($role->id); ?>"><?php echo e($role->name); ?></label>

                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php if($errors->has('section')): ?>
                                                <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('section')); ?></strong>
                        </span> <?php endif; ?>
                                            </div>

                                        </div>

                                    </div>

                                    <div role="tabpanel" class="tab-pane fade" id="indivitual_email_sms">

                                        <div class="white-box">
                                            <div class="row mb-35">

                                                <div class="col-lg-12">
                                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('role_id') ? ' is-invalid' : ''); ?>" name="role_id" id="staffsByRoleCommunication">
                                                        <option data-display="<?php echo app('translator')->getFromJson('lang.role'); ?>  *" value=""><?php echo app('translator')->getFromJson('lang.role'); ?> *</option>
                                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if(isset($editData)): ?>
                                                        <option value="<?php echo e($value->id); ?>" <?php echo e($value->id == $editData->role_id? 'selected':''); ?>><?php echo e($value->name); ?></option>
                                                        <?php else: ?>
                                                        <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>

                                                        <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <?php if($errors->has('leave_type')): ?>
                                                    <span class="invalid-feedback invalid-select" role="alert">
                                <strong><?php echo e($errors->first('leave_type')); ?></strong>
                            </span> <?php endif; ?>
                                                </div>

                                                <div class="col-lg-12 mt-30" id="selectStaffsDiv">
                                                    <label for="checkbox" class="mb-2"><?php echo app('translator')->getFromJson('lang.name'); ?></label>
                                                    <select multiple id="selectStaffss" name="message_to_individual[]" style="width:300px">
                                                    </select>

                                                    <div class="">
                                                    <input type="checkbox" id="checkbox" class="common-checkbox">
                                                    <label for="checkbox" class="mt-3"><?php echo app('translator')->getFromJson('lang.select_all'); ?> </label>
                                                    </div>

                                                    <?php if($errors->has('staff_id')): ?>
                                                    <span class="invalid-feedback invalid-select" role="alert">
                                <strong><?php echo e($errors->first('staff_id')); ?></strong>
                            </span> <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- End Individual Tab -->

                                    <!-- Start Class Section Tab -->
                                    <div role="tabpanel" class="tab-pane fade" id="class_section_email_sms">
                                        <div class="white-box">
                                            <div class="row mb-35">

                                                <div class="col-lg-12">
                                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('role_id') ? ' is-invalid' : ''); ?>" name="class_id" id="class_id_email_sms">
                                                        <option data-display="<?php echo app('translator')->getFromJson('lang.class'); ?>  *" value=""><?php echo app('translator')->getFromJson('lang.class'); ?> *</option>
                                                    <?php if(isset($classes)): ?>
                                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                        <option value="<?php echo e($value->id); ?>"><?php echo e($value->class_name); ?></option>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                    </select>
                                                    <?php if($errors->has('leave_type')): ?>
                                                    <span class="invalid-feedback invalid-select" role="alert">
                                <strong><?php echo e($errors->first('leave_type')); ?></strong>
                            </span> <?php endif; ?>
                                                </div>

                                                <div class="col-lg-12 mt-30" id="selectSectionsDiv">
                                                <label for="checkbox" class="mb-2"><?php echo app('translator')->getFromJson('lang.section'); ?></label>
                                                    <select multiple id="selectSectionss" name="message_to_section[]" style="width:300px">
                                                      
                                                    </select>
                                                    <div class="">
                                                    <input type="checkbox" id="checkbox_section" class="common-checkbox">
                                                    <label for="checkbox_section" class="mt-3"><?php echo app('translator')->getFromJson('lang.select_all'); ?></label>
                                                    </div>
                                                    <?php if($errors->has('staff_id')): ?>
                                                    <span class="invalid-feedback invalid-select" role="alert">
                                <strong><?php echo e($errors->first('staff_id')); ?></strong>
                            </span> <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-warning mt-30">
                    <?php echo app('translator')->getFromJson('lang.For_Sending_Email'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                 <?php if(in_array(292, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                <div class="white-box mt-30">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <button class="primary-btn fix-gr-bg">
                                <span class="ti-check"></span> <?php echo app('translator')->getFromJson('lang.send'); ?>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <?php echo e(Form::close()); ?>

    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>