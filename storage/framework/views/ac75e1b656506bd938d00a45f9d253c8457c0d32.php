<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Language Settings</h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>">Dashboard</a>
                <a href="#">System Settings</a>
                <a href="#">Language Settings</a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <?php if(isset($edit_languages)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(url('marks-grade')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                            <?php echo app('translator')->getFromJson('lang.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-30"> 
                            <?php echo app('translator')->getFromJson('lang.language_setup'); ?></h3>
                        </div>
                    </div>
                </div>


                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'translation-term-update', 'method' => 'POST'])); ?>

                <div class="row">
                    <div class="col-lg-3 mb-30">
                        <div class="white-box onchangeSearch">
                            <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('module_id') ? ' is-invalid' : ''); ?>" id="module_id" name="module_id">
                                <option data-display="Select Module *" value="">Select Module *</option>
                                <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($module->order); ?>"><?php echo e($module->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select> 
                            <?php if($errors->any()): ?> 
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p class="text-danger"><?php echo e($error); ?></p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                            <?php endif; ?>
                                                    
                        </div>
                    </div>
                    <div class="col-lg-9">

                        <input type="hidden" id="url" value="<?php echo e(url('/')); ?>">
                        <input type="hidden" id="language_universal" value="<?php echo e($language_universal); ?>" name="language_universal">
                        <table class="display school-table school-table-style" cellspacing="0" width="100%" id="language_table">
                            <thead>

                                        

                                       

                                <?php if(session()->has('message-success-delete') != "" ||
                                session()->get('message-danger-delete') != "" || session()->has('message-success') !=""): ?>
                                <tr>
                                    <td colspan="4">
                                        <?php if(session()->has('message-success-delete')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session()->get('message-success-delete')); ?>

                                        </div>
                                        <?php elseif(session()->has('message-success')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session()->get('message-success')); ?>

                                        </div>
                                        <?php elseif(session()->has('message-danger-delete')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e(session()->get('message-danger-delete')); ?>

                                        </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>


                            </thead>
                            <tbody>
                                <tr> 
                                    <th>Default Phrases</th>
                                    <th><?php echo e($language_universal); ?> Phrases</th>
                                </tr>
                                <?php $count=1; $sms_languages =[]; ?>
                                <?php $__currentLoopData = $sms_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr> 
                                    <td><?php echo e($row->en); ?></td>
                                    <td> 

                                        <div class="input-effect">
                                            <input type="hidden" name="InputId[<?php echo e($row->id); ?>]" value="<?php echo e($row->id); ?>">
                                            <input class="primary-input form-control<?php echo e($errors->has('language_universal') ? ' is-invalid' : ''); ?>"
                                                type="text" name="LU[<?php echo e($row->id); ?>]" autocomplete="off" value="<?php echo e($row->$language_universal); ?>">
 
 
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('language_universal')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('language_universal')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>


                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                

                            </tbody>
                        </table>

                        <div class="pull-right">                               
                            <div class="row mt-40">
                                <div class="col-lg-12 text-center">
                                    <button class="primary-btn fix-gr-bg">
                                        <span class="ti-check"></span> 
                                        <?php echo app('translator')->getFromJson('lang.update_language'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>