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
            <h1><?php echo app('translator')->getFromJson('lang.apply_leave'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.human_resource'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.apply_leave'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor pl_22">
<div class="container-fluid p-0">
    <div class="row mb-30">

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.my_remaining_leaves'); ?></h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">

                    <table class="display school-table school-table-style" cellspacing="0" width="100%">

                        <thead>
                            
                            <tr>
                                <th><?php echo app('translator')->getFromJson('lang.type'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.remaining_days'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.extra_taken'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.total_days'); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $my_leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $my_leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php

                            $approved_leaves = App\SmLeaveRequest::approvedLeave($my_leave->id);
                                $remaining_days = $my_leave->days - $approved_leaves;
                            ?>
                            <tr>
                                <td><?php echo e($my_leave->leaveType !=""?$my_leave->leaveType->type:""); ?></td>
                                <td><?php echo e($remaining_days >= 0? $remaining_days:0); ?></td>

                                <td><?php echo e($remaining_days < 0? $approved_leaves - $my_leave->days:0); ?></td>
                                <td><?php echo e($my_leave->days); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php if(isset($apply_leave)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(url('apply-leave')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->getFromJson('lang.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
<div class="row">
   

    <div class="col-lg-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title">
                    <h3 class="mb-30"><?php if(isset($apply_leave)): ?>
                            <?php echo app('translator')->getFromJson('lang.edit'); ?>
                        <?php else: ?>
                            <?php echo app('translator')->getFromJson('lang.add'); ?>
                        <?php endif; ?>
                        <?php echo app('translator')->getFromJson('lang.apply_leave'); ?>
                    </h3>
                </div>
                <?php if(isset($apply_leave)): ?>
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'apply-leave/'.$apply_leave->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                <?php else: ?>
                 <?php if(in_array(395, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'apply-leave',
                'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                <?php endif; ?>
                <?php endif; ?>
                <div class="white-box">
                    <div class="add-visitor">
                        <div class="row no-gutters input-right-icon">
                            <?php if(session()->has('message-success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session()->get('message-success')); ?>

                            </div>
                            <?php elseif(session()->has('message-danger')): ?>
                            <div class="alert alert-danger">
                                <?php echo e(session()->get('message-danger')); ?>

                            </div>
                            <?php endif; ?>
                            <div class="col">
                                <div class="input-effect">
                                    <input class="primary-input date form-control<?php echo e($errors->has('apply_date') ? ' is-invalid' : ''); ?>" id="apply_date" type="text"
                                        name="apply_date" value="<?php echo e(isset($apply_leave)? date('m/d/Y', strtotime($apply_leave->apply_date)) : date('m/d/Y')); ?>">
                                    <label><?php echo app('translator')->getFromJson('lang.apply_date'); ?><span>*</span> </label>
                                    <span class="focus-border"></span>
                                     <?php if($errors->has('apply_date')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('apply_date')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>

                            </div>
                            <div class="col-auto">
                                <button class="" type="button">
                                    <i class="ti-calendar" id="apply_date_icon"></i>
                                </button>
                            </div>
                           
                        </div>
                        <input type="hidden" name="id" value="<?php echo e(isset($apply_leave)? $apply_leave->id: ''); ?>">
                        <div class="row mt-25">
                            <div class="col-lg-12">
                                <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('leave_type') ? ' is-invalid' : ''); ?>" name="leave_type">
                                    <option data-display="<?php echo app('translator')->getFromJson('lang.leave_type'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.leave_type'); ?> *</option>
                                    <?php $__currentLoopData = $leave_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($leave_type->id); ?>" <?php echo e(isset($apply_leave)? ($apply_leave->leave_define_id == $leave_type->id? 'selected':''):''); ?>><?php echo e($leave_type->leaveType->type); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('leave_type')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('leave_type')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row no-gutters input-right-icon mt-25">
                            <div class="col">
                                <div class="input-effect">
                                    <input class="primary-input date form-control<?php echo e($errors->has('leave_from') ? ' is-invalid' : ''); ?>" id="startDate" type="text"
                                         name="leave_from"  autocomplete="off" value="<?php echo e(isset($apply_leave)? date('m/d/Y', strtotime($apply_leave->leave_from)):''); ?>">
                                    <label><?php echo app('translator')->getFromJson('lang.leave_from'); ?><span>*</span> </label>
                                    <span class="focus-border"></span>
                                     <?php if($errors->has('leave_from')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('leave_from')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="" type="button">
                                    <i class="ti-calendar" id="start-date-icon"></i>
                                </button>
                            </div>

                        </div>
                        <div class="row no-gutters input-right-icon mt-25">
                            <div class="col">
                                <div class="input-effect">
                                    <input class="primary-input date form-control<?php echo e($errors->has('leave_to') ? ' is-invalid' : ''); ?>" id="leave_to" type="text" name="leave_to" value="<?php echo e(isset($apply_leave)? date('m/d/Y', strtotime($apply_leave->leave_to)):''); ?>">
                                    <label><?php echo app('translator')->getFromJson('lang.leave_to'); ?><span>*</span> </label>
                                    <span class="focus-border"></span>
                                     <?php if($errors->has('leave_to')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('leave_to')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="" type="button">
                                    <i class="ti-calendar" id="to-date-icon"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row mt-25">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                    <textarea class="primary-input form-control" cols="0" rows="4" name="reason"><?php echo e(isset($apply_leave)? $apply_leave->reason: ''); ?></textarea>
                                     <label><?php echo app('translator')->getFromJson('lang.reason'); ?> <span>*</span> </label>
                                    <span class="focus-border textarea"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row no-gutters input-right-icon mt-25">
                            <div class="col">
                                <div class="input-effect">
                                    <input class="primary-input" type="text" 
                                    placeholder="<?php echo e(isset($apply_leave->file) && $apply_leave->file != ""? showPicName($apply_leave->file):'Attach File'); ?>"
                                    disabled id="placeholderAttachFile">
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="primary-btn-small-input" type="button">
                                    <label class="primary-btn small fix-gr-bg" for="attach_file"><?php echo app('translator')->getFromJson('lang.browse'); ?></label>
                                    <input type="file" class="d-none" name="attach_file" id="attach_file">
                                </button>
                            </div>
                        </div>
                          <?php 
                                  $tooltip = "";
                                  if(in_array(395, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                        <div class="row mt-40">
                            <div class="col-lg-12 text-center">
                                <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                    <span class="ti-check"></span>
                                    <?php if(isset($apply_leave)): ?>
                                        <?php echo app('translator')->getFromJson('lang.update'); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->getFromJson('lang.save'); ?>
                                    <?php endif; ?>
                                    <?php echo app('translator')->getFromJson('lang.apply_leave'); ?>
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
                    <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.leave'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?> </h3>
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
                            <td>
                                <?php if($apply_leave->leaveDefine != "" && $apply_leave->leaveDefine->leaveType !=""): ?>
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
                            <button class="primary-btn small tr-bg"><?php echo app('translator')->getFromJson('lang.cancelled'); ?></button>
                            <?php endif; ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        <?php echo app('translator')->getFromJson('lang.select'); ?>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">

                                        <?php if(in_array(194, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

                                        <a data-modal-size="modal-lg" title="View Leave Details" class="dropdown-item modalLink" href="<?php echo e(url('view-leave-details-apply', $apply_leave->id)); ?>"><?php echo app('translator')->getFromJson('lang.view'); ?></a>

                                        <?php endif; ?>
                                        <?php if($apply_leave->approve_status == 'P'): ?>
                                        <?php if(in_array(396, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

                                        <a class="dropdown-item" href="<?php echo e(url('apply-leave', [$apply_leave->id
                                            ])); ?>">edit</a> 

                                        <?php endif; ?>
                                        <?php if(in_array(195, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

                                         <a class="dropdown-item" data-toggle="modal" data-target="#deleteApplyLeaveModal<?php echo e($apply_leave->id); ?>"
                                            href="#"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade admin-query" id="deleteApplyLeaveModal<?php echo e($apply_leave->id); ?>" >
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.delete'); ?> <?php echo app('translator')->getFromJson('lang.apply_leave'); ?></h4>
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