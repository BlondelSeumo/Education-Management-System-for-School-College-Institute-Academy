<?php $__env->startSection('mainContent'); ?>
<?php
function showPicName($data){
$name = explode('/', $data);
return $name[3];
}
?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.approve_leave_request'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.human_resource'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.approve_leave_request'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">

        

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.apply_leave'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></h3>
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
                                <td colspan="7">
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
                                <th><?php echo app('translator')->getFromJson('lang.type'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.from'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.to'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.apply_date'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.Status'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $apply_leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $apply_leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($apply_leave->staffs != ""? $apply_leave->staffs->full_name:''); ?></td>
                                <td>
                                    <?php if($apply_leave->leaveDefine !="" && $apply_leave->leaveDefine->leaveType !=""): ?>
                                    <?php echo e($apply_leave->leaveDefine->leaveType->type); ?>

                                    <?php endif; ?>
                                </td>
                                <td  data-sort="<?php echo e(strtotime($apply_leave->leave_from)); ?>" >
                                    <?php echo e($apply_leave->leave_from != ""? App\SmGeneralSettings::DateConvater($apply_leave->leave_from):''); ?>


                                </td>
                                <td  data-sort="<?php echo e(strtotime($apply_leave->leave_to)); ?>" >
                                   <?php echo e($apply_leave->leave_to != ""? App\SmGeneralSettings::DateConvater($apply_leave->leave_to):''); ?>


                                </td>
                                <td  data-sort="<?php echo e(strtotime($apply_leave->apply_date)); ?>" >
                                   <?php echo e($apply_leave->apply_date != ""? App\SmGeneralSettings::DateConvater($apply_leave->apply_date):''); ?>


                                </td>
                                <td>

                                    <?php if($apply_leave->approve_status == 'P'): ?>
                                    <button class="primary-btn small tr-bg"><?php echo app('translator')->getFromJson('lang.pending'); ?></button><?php endif; ?>

                                    <?php if($apply_leave->approve_status == 'A'): ?>
                                    <button class="primary-btn small tr-bg"><?php echo app('translator')->getFromJson('lang.approved'); ?></button>
                                    <?php endif; ?>

                                    <?php if($apply_leave->approve_status == 'C'): ?>
                                    <button class="primary-btn small bg-danger text-white border-0"><?php echo app('translator')->getFromJson('lang.cancelled'); ?></button>
                                    <?php endif; ?>

                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            <?php echo app('translator')->getFromJson('lang.select'); ?>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">

                                            <?php if(in_array(191, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

                                            <a data-modal-size="modal-lg" title="View/Edit Leave Details" class="dropdown-item modalLink" href="<?php echo e(url('view-leave-details-approve', $apply_leave->id)); ?>"><?php echo app('translator')->getFromJson('lang.view'); ?>/<?php echo app('translator')->getFromJson('lang.approved'); ?></a>

                                            <?php endif; ?>

                                            <?php if(in_array(192, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteApplyLeaveModal<?php echo e($apply_leave->id); ?>"
                                                    href="#"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
                                               <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade admin-query" id="deleteApplyLeaveModal<?php echo e($apply_leave->id); ?>" >
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.delete'); ?> <?php echo app('translator')->getFromJson('lang.item'); ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4><?php echo app('translator')->getFromJson('lang.are_you_sure_to_delete'); ?></h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->getFromJson('lang.cancel'); ?></button>
                                                        <?php echo e(Form::open(['url' => 'apply-leave/'.$apply_leave->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

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