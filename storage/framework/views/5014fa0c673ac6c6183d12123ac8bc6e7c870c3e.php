<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.exam_type'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.examinations'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.add_exam_type'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">

        <div class="row">
            <div class="offset-lg-9 col-lg-3 text-right col-md-12 mb-20">
                <a href="<?php echo e(url('exam')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->getFromJson('lang.exam_setup'); ?>
                </a>
            </div>

        </div>
        <?php if(isset($exam_type_edit)): ?>
         <?php if(in_array(209, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                       
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(url('exam-type')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->getFromJson('lang.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>
        <div class="row">
           

            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php if(isset($exam_type_edit)): ?>
                                    <?php echo app('translator')->getFromJson('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->getFromJson('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->getFromJson('lang.exam'); ?>
                            </h3>
                        </div>
                        <?php if(isset($exam_type_edit)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'exam_type_update', 'method' => 'POST'])); ?>

                        <?php else: ?>
                         <?php if(in_array(209, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'exam_type_store', 'method' => 'POST'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
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
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('exam_type_title') ? ' is-invalid' : ''); ?>" type="text" name="exam_type_title" autocomplete="off" value="<?php echo e(isset($exam_type_edit)? $exam_type_edit->title : ''); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($exam_type_edit)? $exam_type_edit->id: ''); ?>">
                                            <label> <?php echo app('translator')->getFromJson('lang.exam_name'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('exam_type_title')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('exam_type_title')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>


                                    </div>
                                </div>  

                                <div class="row mt-25">
                                    <?php if(isset($exam_type_edit)): ?>
                                        <div class="col-lg-12 mt-30-md">
                                            <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('active_status') ? ' is-invalid' : ''); ?>" id="active_status" name="active_status">
                                                <option data-display=" <?php echo app('translator')->getFromJson('lang.select_status'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_status'); ?> *</option>
                                                <option value="1" <?php echo e(($exam_type_edit->active_status ==1) ? 'selected' :''); ?>> Active</option> 
                                                <option value="0" <?php echo e(($exam_type_edit->active_status ==0) ? 'selected' :''); ?>> Inactive</option> 
                                            </select>
                                            <?php if($errors->has('active_status')): ?>
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong><?php echo e($errors->first('active_status')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

	  <?php 
                                  $tooltip = "";
                                  if(in_array(209, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>

                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($exam_type_edit)): ?>
                                                <?php echo app('translator')->getFromJson('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->getFromJson('lang.save'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->getFromJson('lang.exam_type'); ?>

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.exam_type'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                               <?php if(session()->has('message-success-delete') != "" ||
                                session()->get('message-danger-delete') != ""): ?>
                                <tr>
                                    <td colspan="5">
                                         <?php if(session()->has('message-success-delete')): ?>
                                          <div class="alert alert-success">
                                              <?php echo e(session()->get('message-success-delete')); ?>

                                          </div>
                                        <?php elseif(session()->has('message-danger-delete')): ?>
                                          <div class="alert alert-danger">
                                              <?php echo e(session()->get('message-danger-delete')); ?>

                                          </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <th><?php echo app('translator')->getFromJson('lang.sl'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.exam_name'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.Status'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i=0; ?>
                                <?php $__currentLoopData = $exams_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exams_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$i); ?></td>
                                    <td><?php echo e($exams_type->title); ?></td>
                                    <td><?php echo e(($exams_type->active_status == 1) ? 'Active' : 'Inactive'); ?></td> 
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                        <?php echo app('translator')->getFromJson('lang.select'); ?>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">

                                                        <?php if(in_array(210, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

                                                        <a class="dropdown-item" href="<?php echo e(route('exam_type_edit', [$exams_type->id])); ?>"><?php echo app('translator')->getFromJson('lang.edit'); ?></a>
                                                        <?php endif; ?>
                                                        <?php if(in_array(211, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

                                                        <a class="dropdown-item" data-toggle="modal" data-target="#deleteSubjectModal<?php echo e($exams_type->id); ?>"  href="#"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
                                                   <?php endif; ?>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-lg-6">
                                                 <a  class="primary-btn small tr-bg" href="<?php echo e(url('/exam-marks-setup/'.$exams_type->id)); ?>">
                                                    <span class="pl ti-settings"></span> <?php echo app('translator')->getFromJson('lang.exam_setup'); ?>
                                                </a>
                                            </div>
                                        </div>


                                       

                                    </td>
                                </tr>
                                 <div class="modal fade admin-query" id="deleteSubjectModal<?php echo e($exams_type->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.delete'); ?> <?php echo app('translator')->getFromJson('lang.exam_type'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->getFromJson('lang.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->getFromJson('lang.cancel'); ?></button>
                                                    <a href="<?php echo e(route('exam_type_delete', [$exams_type->id])); ?>" class="text-light">
                                                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->getFromJson('lang.delete'); ?></button>
                                                     </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>