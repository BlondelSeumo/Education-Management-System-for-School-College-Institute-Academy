<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.homework_list'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.home_work'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.homework_list'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.select_criteria'); ?> </h3>
                </div>
            </div>
            <div class="col-lg-4 text-md-right text-left col-md-6 mb-30-lg">
                <a href="<?php echo e(route('add-homeworks')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->getFromJson('lang.add_homework'); ?>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'homework-list', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                    <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="input-effect">
                                <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('class_id') ? ' is-invalid' : ''); ?>" name="class_id" id="classSelectStudent">
                                <option data-display="<?php echo app('translator')->getFromJson('lang.select_class'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select'); ?></option>
                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->class_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="focus-border"></span>
                                <?php if($errors->has('class_id')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('class_id')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="input-effect" id="sectionStudentDiv">
                                <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('section_id') ? ' is-invalid' : ''); ?>" name="section_id" id="sectionSelectStudent">
                                     <option data-display="<?php echo app('translator')->getFromJson('lang.select_section'); ?>" value=""><?php echo app('translator')->getFromJson('lang.section'); ?></option>
                                 </select>
                                 <span class="focus-border"></span>
                                 <?php if($errors->has('section_id')): ?>
                                 <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('section_id')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="input-effect" id="subjectSelecttDiv">
                                <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('subject_id') ? ' is-invalid' : ''); ?>" name="subject_id" id="subjectSelect">
                                    <option data-display="<?php echo app('translator')->getFromJson('lang.select_subjects'); ?>" value=""><?php echo app('translator')->getFromJson('lang.subject'); ?></option>
                                </select>
                                <span class="focus-border"></span>
                                <?php if($errors->has('subject_id')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('subject_id')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-12 mt-20 text-right">
                            <button type="submit" class="primary-btn small fix-gr-bg">
                                <span class="ti-search pr-2"></span>
                                <?php echo app('translator')->getFromJson('lang.search'); ?>
                            </button>
                        </div>
                    </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
    <div class="row mt-40">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.homework_list'); ?></h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                        <thead>
                            
                            <?php if(session()->has('message-success') != "" ||
                            session()->get('message-danger') != ""): ?>
                            <tr>
                                <td colspan="9">
                                     <?php if(session()->has('message-success')): ?>
                                      <div class="alert alert-success">
                                          <?php echo e(session()->get('message-success')); ?>

                                      </div>
                                    <?php elseif(session()->has('message-danger')): ?>
                                      <div class="alert alert-danger">
                                          <?php echo e(session()->get('message-danger')); ?>

                                      </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                             <?php endif; ?>
                            
                            <tr>
                                <th><?php echo app('translator')->getFromJson('lang.class'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.section'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.subject'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.marks'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.home_work'); ?> <?php echo app('translator')->getFromJson('lang.date'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.submission'); ?> <?php echo app('translator')->getFromJson('lang.date'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.evaluation'); ?> <?php echo app('translator')->getFromJson('lang.date'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.created_by'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $homeworkLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($value->classes  !=""?$value->classes->class_name:""); ?></td>
                                <td><?php echo e($value->sections !=""?$value->sections->section_name:""); ?></td>
                                <td><?php echo e($value->subjects !=""?$value->subjects->subject_name:""); ?></td>
                                <td><?php echo e($value->marks); ?></td>
                                 <td>
                                   
<?php echo e($value->homework_date != ""? App\SmGeneralSettings::DateConvater($value->homework_date):''); ?>


                                </td>
                                 <td>

                                  
<?php echo e($value->submission_date != ""? App\SmGeneralSettings::DateConvater($value->submission_date):''); ?>


                                </td>
                                <td>
                                <?php if(!empty($value->evaluation_date)): ?>
                               

 <?php echo e($value->evaluation_date != ""? App\SmGeneralSettings::DateConvater($value->evaluation_date):''); ?>


                                <?php endif; ?>
                                </td>
                              
                               <td><?php echo e($value->users !=""? $value->users->full_name:""); ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            <?php echo app('translator')->getFromJson('lang.select'); ?>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                          <?php if(in_array(281, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                                            <a class="dropdown-item modalLink" title="Evaluation Homework" data-modal-size="full-width-modal" href="<?php echo e(url('evaluation-homework/'.$value->class_id.'/'.$value->section_id.'/'.$value->id)); ?>"><?php echo app('translator')->getFromJson('lang.evaluation'); ?></a>
                                         <?php endif; ?>
                                          <?php if(in_array(282, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                                           <a class="dropdown-item" href="<?php echo e(route('homework_edit', [$value->id])); ?>"><?php echo app('translator')->getFromJson('lang.edit'); ?></a>
                                           <?php endif; ?>
                                            <?php if(in_array(283, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                                           <a class="dropdown-item" data-toggle="modal" data-target="#deleteHomework<?php echo e($value->id); ?>"  href="#"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade admin-query" id="deleteHomework<?php echo e($value->id); ?>" >
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.delete'); ?> <?php echo app('translator')->getFromJson('lang.home_work'); ?></h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="text-center">
                                                <h4><?php echo app('translator')->getFromJson('lang.are_you_sure_to_delete'); ?></h4>
                                            </div>

                                            <div class="mt-40 d-flex justify-content-between">
                                                <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->getFromJson('lang.cancel'); ?></button>
                                                <a href="<?php echo e(route('homework_delete', [$value->id])); ?>" class="text-light">
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