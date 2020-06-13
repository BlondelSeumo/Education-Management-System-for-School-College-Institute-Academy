<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.staff_list'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.human_resource'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.staff_list'); ?></a>
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
<?php if(in_array(162, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

            <div class="col-lg-4 text-md-right text-left col-md-6 mb-30-lg">
                <a href="<?php echo e(route('addStaff')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->getFromJson('lang.add_staff'); ?>
                </a>
            </div>
<?php endif; ?>
        </div>
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
              </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'searchStaff', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <div class="row">
                            <div class="col-lg-4">
                              <select class="niceSelect w-100 bb form-control" name="role_id" id="role_id">
                                    <option data-display="Role" value=""> <?php echo app('translator')->getFromJson('lang.select'); ?> </option>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-lg-4 mt-30-md">
                               <div class="col-lg-12">
                                <div class="input-effect">
                                    <input class="primary-input" type="text" placeholder=" <?php echo app('translator')->getFromJson('lang.search_by_staff_id'); ?>" name="staff_no">
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                           </div>
                            <div class="col-lg-4 mt-30-md">
                               <div class="col-lg-12">
                                <div class="input-effect">
                                    <input class="primary-input" type="text" placeholder="<?php echo app('translator')->getFromJson('lang.search_by_name'); ?>" name="staff_name">
                                    <span class="focus-border"></span>
                                </div>
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
                                <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($value->staff_no); ?></td>
                                <td><?php echo e($value->first_name); ?>&nbsp;<?php echo e($value->last_name); ?></td>
                                <td><?php echo e(!empty($value->roles->name)?$value->roles->name:''); ?></td>
                                <td><?php echo e($value->departments !=""?$value->departments->name:""); ?></td>
                                <td><?php echo e($value->designations !=""?$value->designations->title:""); ?></td>
                                <td><?php echo e($value->mobile); ?></td>
                                <td><?php echo e($value->email); ?></td>

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            <?php echo app('translator')->getFromJson('lang.select'); ?>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="<?php echo e(route('viewStaff', $value->id)); ?>"><?php echo app('translator')->getFromJson('lang.view'); ?></a>
                                           <?php if(in_array(163, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

                                            <a class="dropdown-item" href="<?php echo e(route('editStaff', $value->id)); ?>"><?php echo app('translator')->getFromJson('lang.edit'); ?></a>
                                           <?php endif; ?>
                                           <?php if(in_array(164, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

                                            <?php if($value->role_id != Auth::user()->role_id ): ?>
                                           
                                            <a class="dropdown-item modalLink" title="Delete Staff" data-modal-size="modal-md" href="<?php echo e(route('deleteStaffView', $value->id)); ?>"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                       
                                        </div>
                                    </div>
                                </td>
                            </tr>
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