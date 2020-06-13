<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.assign_class_teacher'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.academics'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.assign_class_teacher'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($assign_class_teacher)): ?>
 <?php if(in_array(254, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1  ): ?> 
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(url('assign-class-teacher')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->getFromJson('lang.assign'); ?>
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
                            <h3 class="mb-30">
                                <?php if(isset($assign_class_teacher)): ?>
                                    <?php echo app('translator')->getFromJson('lang.edit'); ?>
                                <?php endif; ?>
                                    <?php echo app('translator')->getFromJson('lang.assign_class_teacher'); ?>
                            </h3>
                        </div>
                        <?php if(isset($assign_class_teacher)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'assign-class-teacher/'.$assign_class_teacher->id, 'method' => 'PUT'])); ?>

                        <?php else: ?>
                         <?php if(in_array(254, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1  ): ?> 
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'assign-class-teacher', 'method' => 'POST'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                        <?php if(session()->has('message-success')): ?>
                                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                                              <?php echo e(session()->get('message-success')); ?>

                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                        <?php elseif(session()->has('message-danger')): ?>
                                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                              <?php echo e(session()->get('message-danger')); ?>

                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                          </div>
                                        <?php endif; ?>
                                        <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                            <option data-display="<?php echo app('translator')->getFromJson('lang.select_class'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_class'); ?> *</option>
                                            <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <?php if(isset($assign_class_teacher)): ?> 
                                            <option value="<?php echo e($class->id); ?>" <?php echo e($class->id == $assign_class_teacher->class_id? 'selected':''); ?>><?php echo e($class->class_name); ?></option>
                                            <?php else: ?>
                                            <option value="<?php echo e($class->id); ?>"><?php echo e($class->class_name); ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('class')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('class')); ?></strong>
                                        </span>
                                        <?php endif; ?>

                                        
                                    </div>
                                </div>

                                <input type="hidden" name="id" value="<?php echo e(isset($assign_class_teacher)? $assign_class_teacher->id: ''); ?>">

                                <div class="row  mt-40">
                                    <div class="col-lg-12" id="select_section_div">
                                        <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_section'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_section'); ?> *</option>
                                        <?php if(isset($assign_class_teacher)): ?>
                                            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($section->id); ?>" <?php echo e($section->id == $assign_class_teacher->section_id? 'selected':''); ?>><?php echo e($section->section_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                    <?php if($errors->has('section')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('section')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <label><?php echo app('translator')->getFromJson('lang.teacher'); ?> *</label><br>
                                        <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(isset($assign_class_teacher)): ?>
                                        <div class="">
                                            <input type="checkbox" id="tecaher<?php echo e($teacher->id); ?>" class="common-checkbox" name="teacher[]" value="<?php echo e($teacher->id); ?>" <?php echo e(in_array($teacher->id, $teacherId)? 'checked':''); ?>>
                                            <label for="tecaher<?php echo e($teacher->id); ?>"><?php echo e($teacher->full_name); ?></label>
                                        </div>
                                        <?php else: ?>
                                        <div class="">
                                            <input type="checkbox" id="tecaher<?php echo e($teacher->id); ?>" class="common-checkbox" name="teacher[]" value="<?php echo e($teacher->id); ?>">
                                            <label for="tecaher<?php echo e($teacher->id); ?>"><?php echo e($teacher->full_name); ?></label>
                                        </div>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php if($errors->has('teacher')): ?>
                                            <span class="text-danger validate-textarea-checkbox" role="alert">
                                                <strong><?php echo e($errors->first('teacher')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                  <?php 
                                  $tooltip = "";
                                  if(in_array(254, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($assign_class_teacher)): ?>
                                                <?php echo app('translator')->getFromJson('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->getFromJson('lang.save'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->getFromJson('lang.class_teacher'); ?>
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
                            <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.class_teacher'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></h3>
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
                                    <td colspan="4">
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
                                    <th><?php echo app('translator')->getFromJson('lang.class'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.section'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.teacher'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $assign_class_teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assign_class_teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td valign="top"><?php echo e($assign_class_teacher->className !=""? $assign_class_teacher->className->class_name:""); ?></td>
                                    <td valign="top"><?php echo e($assign_class_teacher->section != ""? $assign_class_teacher->section->section_name:""); ?></td>
                                    <td valign="top">
                                        
                                            <?php
                                              $classTeachers = $assign_class_teacher->classTeachers;

                                            ?>
                                            <?php if($classTeachers !=""): ?>
                                            <?php $__currentLoopData = $classTeachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classTeacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           
                                                    <?php $teacher = $classTeacher->teacher;

                                                    ?>
                                                    <?php echo e($teacher->full_name); ?> <br><br>
                                                
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>


                                        
                                    </td>
                                    
                                    <td valign="top">
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->getFromJson('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <?php if(in_array(255, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                                                <a class="dropdown-item" href="<?php echo e(url('assign-class-teacher/'.$assign_class_teacher->id.'/edit')); ?>"><?php echo app('translator')->getFromJson('lang.edit'); ?></a>
                                               <?php endif; ?>
                                                <?php if(in_array(256, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteClassModal<?php echo e($assign_class_teacher->id); ?>"  href="<?php echo e(route('class_delete', [$assign_class_teacher->id])); ?>"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
                                           <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteClassModal<?php echo e($assign_class_teacher->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.delete'); ?><?php echo app('translator')->getFromJson('lang.assign_teacher'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->getFromJson('lang.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->getFromJson('lang.cancel'); ?></button>
                                                    <?php echo e(Form::open(['url' => 'assign-class-teacher/'.$assign_class_teacher->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

                                                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->getFromJson('lang.delete'); ?></button>
                                                     <?php echo e(Form::close()); ?>

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