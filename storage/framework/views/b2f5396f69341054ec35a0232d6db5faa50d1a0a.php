<?php $__env->startSection('mainContent'); ?>
<style type="text/css">
    #selectStaffsDiv, .forStudentWrapper{
        display: none;
    }
    .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background: linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
}

input:focus + .slider {
  box-shadow: 0 0 1px linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.login_permission'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.system_settings'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.login_permission'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.select_criteria'); ?></h3>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'login-access-control', 'enctype' => 'multipart/form-data', 'method' => 'POST'])); ?>

                        
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-6 mb-30">
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
                                                <?php echo e($error); ?> <br>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                    <div class="col-lg-12 mb-30">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('role') ? ' is-invalid' : ''); ?>" name="role" id="member_type">
                                            <option data-display=" <?php echo app('translator')->getFromJson('lang.select_role'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_role'); ?> *</option>
                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                           

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="forStudentWrapper col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6 mb-30">
                                                <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                                    <option data-display="<?php echo app('translator')->getFromJson('lang.select_class'); ?>" value=""><?php echo app('translator')->getFromJson('lang.select_class'); ?>*</option>
                                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($class->id); ?>"  <?php echo e(( old("class") == $class->id ? "selected":"")); ?>><?php echo e($class->class_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                            <div class="col-lg-6 mb-30" id="select_section__member_div">
                                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section_member" name="section">
                                                    <option data-display="<?php echo app('translator')->getFromJson('lang.select_section'); ?>" value=""><?php echo app('translator')->getFromJson('lang.select_section'); ?> *</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>



                                    <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">

                                </div>

                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        <?php echo app('translator')->getFromJson('lang.search'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>


        <?php if(isset($students)): ?>
            <div class="row mt-40">
                

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.student_list'); ?> (<?php echo e($students->count()); ?>)</h3>
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
                                        <td colspan="10">
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
                                        <th><?php echo app('translator')->getFromJson('lang.admission'); ?><?php echo app('translator')->getFromJson('lang.no'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.roll'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.name'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.class'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.father_name'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.date_of_birth'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.gender'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.type'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.phone'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.login_permission'); ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr id="<?php echo e($student->user_id); ?>">
                                        <input type="hidden" id="id" value="<?php echo e($student->user_id); ?>">
                                        <input type="hidden" id="role" value="<?php echo e($role); ?>">
                                        <td><?php echo e($student->admission_no); ?></td>
                                        <td><?php echo e($student->roll_no); ?></td>
                                        <td><?php echo e($student->first_name.' '.$student->last_name); ?></td> 
                                        <td><?php echo e(!empty($student->className)?$student->className->class_name:''); ?></td>

                                        <td><?php echo e(!empty($student->parents->fathers_name)?$student->parents->fathers_name:''); ?></td>
                                        <td  data-sort="<?php echo e(strtotime($student->date_of_birth)); ?>" >
                                            <?php echo e($student->date_of_birth != ""? App\SmGeneralSettings::DateConvater($student->date_of_birth):''); ?>


                                        </td>
                                        <td><?php echo e($student->gender != ""? $student->gender->base_setup_name :''); ?></td>
                                        <td><?php echo e(!empty($student->student_category_id)? $student->category->category_name:''); ?></td>
                                        <td><?php echo e($student->mobile); ?></td>
                                        <td>
                                            <label class="switch">
                                              <input type="checkbox" class="switch-input" <?php echo e($student->user->access_status == 0? '':'checked'); ?>>
                                              <span class="slider round"></span>
                                            </label>
                                        </td>
                                    </tr>
                                    
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(isset($staffs)): ?>
             <div class="row mt-40">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.staff_list'); ?></h3>
                    </div>
                </div>
            </div>

         <div class="row">
                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->getFromJson('lang.staff'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.name'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.role'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.department'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.description'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.mobile'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.email'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.login_permission'); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="<?php echo e($value->user_id); ?>">
                                <input type="hidden" id="id" value="<?php echo e($value->user_id); ?>">
                                        <input type="hidden" id="role" value="<?php echo e($role); ?>">
                                <td><?php echo e($value->staff_no); ?></td>
                                <td><?php echo e($value->first_name); ?>&nbsp;<?php echo e($value->last_name); ?></td>
                                <td><?php echo e(!empty($value->roles->name)?$value->roles->name:''); ?></td>
                                <td><?php echo e($value->departments !=""?$value->departments->name:""); ?></td>
                                <td><?php echo e($value->designations !=""?$value->designations->title:""); ?></td>
                                <td><?php echo e($value->mobile); ?></td>
                                <td><?php echo e($value->email); ?></td>
                                <td>
                                            <label class="switch">
                                              <input type="checkbox" class="switch-input" <?php echo e($value->staff_user->access_status == 0? '':'checked'); ?>>
                                              <span class="slider round"></span>
                                            </label>
                                        </td>

                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        <?php endif; ?>

        <?php if(isset($parents)): ?>
            <div class="row mt-40">
                

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.parents'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></h3>
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
                                        <td colspan="10">
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
                                        <th><?php echo app('translator')->getFromJson('lang.guardian_phone'); ?> </th>
                                        <th><?php echo app('translator')->getFromJson('lang.father_name'); ?> </th>
                                        <th><?php echo app('translator')->getFromJson('lang.father_phone'); ?> </th>
                                        <th><?php echo app('translator')->getFromJson('lang.mother_name'); ?> </th>
                                        <th><?php echo app('translator')->getFromJson('lang.mother_phone'); ?> </th>
                                        <th><?php echo app('translator')->getFromJson('lang.login_permission'); ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr id="<?php echo e($parent->user_id); ?>">
                                        <input type="hidden" id="id" value="<?php echo e($parent->user_id); ?>">
                                        <input type="hidden" id="role" value="<?php echo e($role); ?>">
                                        <td><?php echo e($parent->guardians_mobile); ?></td>
                                        <td><?php echo e($parent->fathers_name); ?></td>
                                        <td><?php echo e($parent->fathers_mobile); ?></td>
                                        <td><?php echo e($parent->mothers_name); ?></td>
                                        <td><?php echo e($parent->mothers_mobile); ?></td>
                                        <td>
                                            <label class="switch">
                                              <input type="checkbox" class="switch-input" <?php echo e($parent->parent_user->access_status == 0? '':'checked'); ?>>
                                              <span class="slider round"></span>
                                            </label>
                                        </td>
                                    </tr>
                                    
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>


    </div>
</div>
</div>
</div>
</section>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>