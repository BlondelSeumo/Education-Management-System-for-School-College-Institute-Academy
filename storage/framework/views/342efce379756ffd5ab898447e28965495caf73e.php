<?php $__env->startSection('mainContent'); ?>
<?php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.fees_master'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.fees_collection'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.fees_master'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($fees_master)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(url('add-expense')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->getFromJson('lang.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <?php if(in_array(119, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php if(isset($fees_master)): ?>
                                    <?php echo app('translator')->getFromJson('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->getFromJson('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->getFromJson('lang.fees_master'); ?>
                            </h3>
                        </div>
                        <?php if(isset($fees_master)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true,  'url' => 'fees-master/'.$fees_master->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'id' => 'fees_master_form'])); ?>

                        <?php else: ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'fees-master',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'fees_master_form'])); ?>

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
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('fees_group') ||  session()->has('message-exist')? ' is-invalid' : ''); ?>" name="fees_group" id="fees_group" <?php echo e(isset($fees_master)? 'disabled': ''); ?>>
                                            <option data-display="<?php echo app('translator')->getFromJson('lang.fees_group'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.fees_group'); ?> *</option>
                                            <?php $__currentLoopData = $fees_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset($fees_master)): ?>
                                                    <option value="<?php echo e($fees_group->id); ?>" <?php echo e($fees_group->id == $fees_master->fees_group_id? 'selected':''); ?>><?php echo e($fees_group->name); ?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo e($fees_group->id); ?>"><?php echo e($fees_group->name); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if(session()->has('message-exist')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e(session()->get('message-exist')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                        <?php if($errors->has('fees_group')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('fees_group')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('fees_type') ? ' is-invalid' : ''); ?>" name="fees_type">
                                            <option data-display="<?php echo app('translator')->getFromJson('lang.fees_type'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.fees_type'); ?> *</option>
                                            <?php $__currentLoopData = $fees_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset($fees_master)): ?>
                                                    <option value="<?php echo e($fees_type->id); ?>" <?php echo e($fees_type->id == $fees_master->fees_type_id? 'selected':''); ?>><?php echo e($fees_type->name); ?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo e($fees_type->id); ?>"><?php echo e($fees_type->name); ?></option>
                                                <?php endif; ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('fees_type')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('fees_type')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo e(isset($fees_master)? $fees_master->id: ''); ?>">
                                <input type="hidden" name="fees_group_id" value="<?php echo e(isset($fees_master)? $fees_master->fees_group_id: ''); ?>">

                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control<?php echo e($errors->has('date') ? ' is-invalid' : ''); ?>" id="startDate" type="text" name="date" value="<?php echo e(isset($fees_master)? date('Y/m/d', strtotime($fees_master->date)) : date('m/d/Y')); ?>">
                                                <label><?php echo app('translator')->getFromJson('lang.date'); ?> <span></span></label>
                                            <span class="focus-border"></span>
                                             <?php if($errors->has('date')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('date')); ?></strong>
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
                                <?php if(old('fees_group') != 1 && old('fees_group') != 2): ?>
                                    <?php if(isset($fees_master)): ?>
                                        <?php if($fees_master->fees_group_id != 1 && $fees_master->fees_group_id != 2): ?>
                                        <div class="row  mt-25" id="fees_master_amount">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input class="primary-input form-control<?php echo e($errors->has('amount') ? ' is-invalid' : ''); ?>"
                                                        type="number" name="amount" autocomplete="off" value="<?php echo e(isset($fees_master)? $fees_master->amount:''); ?>">
                                                        <label><?php echo app('translator')->getFromJson('lang.amount'); ?> <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('amount')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('amount')); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="row  mt-25" id="fees_master_amount">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input class="primary-input form-control<?php echo e($errors->has('amount') ? ' is-invalid' : ''); ?>"
                                                        type="number" name="amount" autocomplete="off" value="<?php echo e(isset($fees_master)? $fees_master->amount:''); ?>">
                                                    <label><?php echo app('translator')->getFromJson('lang.amount'); ?> <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('amount')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('amount')); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg">
                                            <span class="ti-check"></span>
                                            <?php if(isset($fees_master)): ?>
                                                <?php echo app('translator')->getFromJson('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->getFromJson('lang.save'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->getFromJson('lang.master'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>

            <?php endif; ?>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.fees_master'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></h3>
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
                                    <td colspan="3">
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
                                    <th><?php echo app('translator')->getFromJson('lang.group'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.type'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $fees_masters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                <tr>
                                    <td valign="top">
                                        <?php $i = 0; ?>
                                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $i++; ?>
                                        <?php if($i == 1): ?>
                                            <?php echo e($fees_master->feesGroups->name); ?> 
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td>
                                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 
                                        <div class="row">
                                            <div class="col-sm-4" style="border-bottom: 1px solid #d9dce7; padding-top: 5px">
                                                <?php echo e($fees_master->feesTypes !=""?$fees_master->feesTypes->name:''); ?> 
                                            </div>
                                            <div class="col-sm-2" style="border-bottom: 1px solid #d9dce7; padding-top: 5px">
                                                <?php echo e($currency); ?> <?php echo e(number_format((float)$fees_master->amount, 2, '.', '')); ?>

                                            </div>
                                            <div class="col-sm-2">
                                                <div class="dropdown mb-20">
                                                     
                                                    <button type="button" class="btn dropdown-toggle ml-20" data-toggle="dropdown">
                                                        <?php echo app('translator')->getFromJson('lang.select'); ?>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                       <?php if(in_array(120, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

                                                        <a class="dropdown-item" href="<?php echo e(url('fees-master', [$fees_master->id])); ?>"><?php echo app('translator')->getFromJson('lang.edit'); ?></a>
                                                       <?php endif; ?>
                                                        <?php if(in_array(121, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

                                                        <a class="dropdown-item deleteFeesMasterSingle" data-toggle="modal" data-target="#deleteFeesMasterSingle"
                                                            href="#" data-id="<?php echo e($fees_master->id); ?>"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
                                                   <?php endif; ?>
                                                        </div>
                                                </div>
 
                                            </div>
                                        </div>
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td valign="top">
                                        <?php $i = 0; ?>
                                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $i++; ?>
                                        <?php if($i == 1): ?>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->getFromJson('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                <?php if(in_array(122, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

                                                <a class="dropdown-item" href="<?php echo e(route('fees_assign', [$fees_master->fees_group_id])); ?>"><?php echo app('translator')->getFromJson('lang.assign'); ?>/<?php echo app('translator')->getFromJson('lang.view'); ?></a>
                                                <?php endif; ?>
                                                <a class="dropdown-item deleteFeesMasterGroup" data-toggle="modal" href="#" data-id="<?php echo e($fees_master->fees_group_id); ?>" data-target="#deleteFeesMasterGroup"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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

<div class="modal fade admin-query" id="deleteFeesMasterSingle" >
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
                     <?php echo e(Form::open(['url' => 'fees-master-single-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                     <input type="hidden" name="id" id="fees_master_single_id">
                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->getFromJson('lang.delete'); ?></button>
                     <?php echo e(Form::close()); ?>

                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade admin-query" id="deleteFeesMasterGroup" >
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
                     <?php echo e(Form::open(['url' => 'fees-master-group-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                     <input type="hidden" name="id" id="fees_master_group_id">
                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->getFromJson('lang.delete'); ?></button>
                     <?php echo e(Form::close()); ?>

                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>