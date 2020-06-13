<?php $__env->startSection('mainContent'); ?>
<style type="text/css">
    #selectStaffsDiv, .forStudentWrapper{
        display: none;
    }
</style>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.add_member'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.library'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.add_member'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($editData)): ?>
         <?php if(in_array(309, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
           
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(url('library-member')); ?>" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30"><?php if(isset($editData)): ?>
                                    <?php echo app('translator')->getFromJson('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->getFromJson('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->getFromJson('lang.member'); ?>
                            </h3>
                        </div>
                        <?php if(isset($editData)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'holiday/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                        <?php if(in_array(309, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'library-member',
                        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <?php if(session()->has('message-success')): ?>
                                    <div class="alert alert-success">
                                        <?php echo e(session()->get('message-success')); ?>

                                    </div>
                                    <?php elseif(session()->has('message-danger')): ?>
                                    <div class="alert alert-danger">
                                        <?php echo e(session()->get('message-danger')); ?>

                                    </div>
                                    <?php endif; ?>

                                    <?php if($errors->any()): ?>
                                        <div class="alert alert-danger">
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e($error); ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="col-lg-12 mb-30">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('member_type') ? ' is-invalid' : ''); ?>" name="member_type" id="member_type">
                                            <option data-display=" <?php echo app('translator')->getFromJson('lang.member_type'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.member_type'); ?> *</option>
                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(isset($editData)): ?>
                                            <option value="<?php echo e($value->id); ?>" <?php echo e($value->id == $editData->role_id? 'selected':''); ?>><?php echo e($value->name); ?></option>
                                            <?php else: ?>
                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>

                                            <?php endif; ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="forStudentWrapper col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-12 mb-30">
                                                <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                                    <option data-display="<?php echo app('translator')->getFromJson('lang.select_class'); ?>" value=""><?php echo app('translator')->getFromJson('lang.select_class'); ?>*</option>
                                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($class->id); ?>"  <?php echo e(( old("class") == $class->id ? "selected":"")); ?>><?php echo e($class->class_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                            <div class="col-lg-12 mb-30" id="select_section__member_div">
                                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section_member" name="section">
                                                    <option data-display="<?php echo app('translator')->getFromJson('lang.select_section'); ?>" value=""><?php echo app('translator')->getFromJson('lang.select_section'); ?> *</option>
                                                </select>
                                            </div>


                                            <div class="col-lg-12 mb-30" id="select_student_div">
                                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('student') ? ' is-invalid' : ''); ?>" id="select_student" name="student">
                                                    <option data-display="<?php echo app('translator')->getFromJson('lang.select_student'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_student'); ?> *</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-30" id="selectStaffsDiv">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('staff_id') ? ' is-invalid' : ''); ?>" name="staff" id="selectStaffs">
                                            <option data-display="<?php echo app('translator')->getFromJson('lang.name'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.name'); ?> *</option>

                                            <?php if(isset($staffsByRole)): ?>
                                            <?php $__currentLoopData = $staffsByRole; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>" <?php echo e($value->id == $editData->staff_id? 'selected':''); ?>><?php echo e($value->full_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>

                                            <?php endif; ?>
                                        </select>
                                    </div>

                                    <div class="col-lg-12 mb-30">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('member_ud_id') ? ' is-invalid' : ''); ?>"
                                            type="text" name="member_ud_id" autocomplete="off" value="<?php echo e(isset($content_title)? $leave_type->type:''); ?>">
                                            <label><?php echo app('translator')->getFromJson('lang.member'); ?> <?php echo app('translator')->getFromJson('lang.id'); ?> <span>*</span> </label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>

                                    <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">

                                </div>
  <?php 
                                  $tooltip = "";
                                  if(in_array(309, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                            <span class="ti-check"></span>

                                            <?php if(isset($editData)): ?>
                                                <?php echo app('translator')->getFromJson('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->getFromJson('lang.save'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->getFromJson('lang.member'); ?>

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
                        <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.member'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></h3>
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
                                <td colspan="6">
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
                                <th><?php echo app('translator')->getFromJson('lang.name'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.member_type'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.member'); ?> <?php echo app('translator')->getFromJson('lang.id'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.email'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.mobile'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if(isset($libraryMembers)): ?>
                            <?php $__currentLoopData = $libraryMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php
                                    if($value->member_type == '2'){
                                        if(!empty($value->studentDetails) && !empty($value->studentDetails->full_name)) { echo $value->studentDetails->full_name; }
                                    }elseif($value->member_type == '3'){ 
                                        if(!empty($value->parentsDetails) && !empty($value->parentsDetails->fathers_name)) { echo $value->parentsDetails->fathers_name; }
                                    }else{ 
                                        if(!empty($value->staffDetails) && !empty($value->staffDetails->full_name)) { echo $value->staffDetails->full_name; }
                                    }

                                    ?>

                                </td>
                                <td><?php echo e(!empty($value->roles)?$value->roles->name:''); ?></td>
                                <td><?php echo e($value->member_ud_id); ?></td>
                                <td>
                                 <?php
                                 if($value->member_type == '2'){
                                    if(!empty($value->studentDetails) && !empty($value->studentDetails->email)) {   echo $value->studentDetails->email;}
                                }elseif($value->member_type == '3'){
                                   if(!empty($value->parentsDetails) && !empty($value->parentsDetails->fathers_email)) { echo $value->parentsDetails->fathers_email;}
                                }else{
                                   if(!empty($value->staffDetails) && !empty($value->staffDetails->email)) {  echo $value->staffDetails->email;
                                }
                                }

                                ?>

                            </td>
                            <td>
                             <?php
                             if($value->member_type == '2'){
                                    if(!empty($value->staffDetails) && !empty($value->studentDetails->mobile)) {   echo $value->studentDetails->mobile;}
                            }elseif($value->member_type == '3'){
                                   if(!empty($value->parentsDetails) && !empty($value->parentsDetails->fathers_mobile)) {   echo $value->parentsDetails->fathers_mobile; }
                            }else{
                                   if(!empty($value->staffDetails) && !empty($value->staffDetails->mobile)) {  echo $value->staffDetails->mobile; }
                            }

                            ?>
                        </td>
                        <td>
                            <div class="dropdown">
 <?php if(in_array(310, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                            <a class="primary-btn fix-gr-bg" href="<?php echo e(url('cancel-membership/'.$value->id)); ?>">Cancel Membership</a> 
                         <?php endif; ?>  
                        </div>
                        </td>
                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
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