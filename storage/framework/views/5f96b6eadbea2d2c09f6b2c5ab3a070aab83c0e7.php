<?php $__env->startSection('mainContent'); ?>
<?php
    function showPicName($data){
        $name = explode('/', $data);
        return $name[3];
    }
?>
<section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.postal_dispatch'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.admin_section'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.postal_dispatch'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($postal_dispatch)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(url('postal-dispatch')); ?>" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30"><?php if(isset($postal_dispatch)): ?>
                                    <?php echo app('translator')->getFromJson('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->getFromJson('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->getFromJson('lang.postal_dispatch'); ?>
                            </h3>
                        </div>
                        <?php if(isset($postal_dispatch)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'postal-dispatch/'.$postal_dispatch->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                         <?php if(in_array(33, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'postal-dispatch',
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
                                            <input class="primary-input form-control<?php echo e($errors->has('to_title') ? ' is-invalid' : ''); ?>" id="apply_date" type="text"
                                                name="to_title" value="<?php echo e(isset($postal_dispatch)? $postal_dispatch->to_title: old('to_title')); ?>">
                                            <label><?php echo app('translator')->getFromJson('lang.to_title'); ?><span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('to_title')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('to_title')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div>

                                <input type="hidden" name="id" value="<?php echo e(isset($postal_dispatch)? $postal_dispatch->id: ''); ?>">

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('reference_no') ? ' is-invalid' : ''); ?>" id="apply_date" type="text"
                                                name="reference_no" value="<?php echo e(isset($postal_dispatch)? $postal_dispatch->reference_no: old('reference_no')); ?>">
                                            <label><?php echo app('translator')->getFromJson('lang.reference'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?></label>
                                            <span class="focus-border"></span>
                                             <?php if($errors->has('reference_no')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('reference_no')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('address') ? ' is-invalid' : ''); ?>" id="apply_date" type="text"
                                                name="address" value="<?php echo e(isset($postal_dispatch)? $postal_dispatch->address: old('address')); ?>">
                                            <label><?php echo app('translator')->getFromJson('lang.address'); ?></label>
                                            <span class="focus-border"></span>
                                             <?php if($errors->has('phone')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('phone')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <?php if(isset($postal_dispatch)): ?>
                                            <textarea class="primary-input form-control" cols="0" rows="4"  name="note"> <?php echo e($postal_dispatch->note); ?></textarea>
                                            <?php else: ?>
                                            <textarea class="primary-input form-control" cols="0" rows="4"  name="note"><?php echo e(old('note')); ?></textarea>
                                            <?php endif; ?>
                                            <span class="focus-border textarea"></span>
                                            <label><?php echo app('translator')->getFromJson('lang.note'); ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('from_title') ? ' is-invalid' : ''); ?>" id="apply_date" type="text"
                                                name="from_title" value="<?php echo e(isset($postal_dispatch)? $postal_dispatch->from_title: old('from_title')); ?>">
                                            <label><?php echo app('translator')->getFromJson('lang.from_title'); ?></label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control<?php echo e($errors->has('date') ? ' is-invalid' : ''); ?>" id="startDate" readonly type="text" name="date" value="<?php echo e(isset($postal_dispatch)? $postal_dispatch->date: date('m/d/Y')); ?>">
                                            <span class="focus-border"></span>
                                            <label><?php echo app('translator')->getFromJson('lang.date'); ?></label>
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
                                
                                <div class="row no-gutters input-right-icon mt-35">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input" id="placeholderInput" type="text" placeholder="<?php echo e(isset($postal_dispatch)? ($postal_dispatch->file != ""? showPicName($postal_dispatch->file):'File Name'):'File Name'); ?>" readonly>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="browseFile"><?php echo app('translator')->getFromJson('lang.browse'); ?></label>
                                            <input type="file" class="d-none" id="browseFile" name="file">
                                        </button>
                                    </div>
                                </div>
                                  <?php 
                                  $tooltip = "";
                                  if(in_array(33, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($postal_dispatch)): ?>
                                                <?php echo app('translator')->getFromJson('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->getFromJson('lang.save'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->getFromJson('lang.postal_dispatch'); ?>
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
                            <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.postal_dispatch'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></h3>
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
                                    <th><?php echo app('translator')->getFromJson('lang.to_title'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.reference'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.address'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.from_title'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.note'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.date'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.actions'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $postal_dispatchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postal_dispatch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($postal_dispatch->to_title); ?></td>
                                    <td><?php echo e($postal_dispatch->reference_no); ?></td>
                                    <td><?php echo e($postal_dispatch->address); ?></td>
                                    <td><?php echo e($postal_dispatch->from_title); ?></td>
                                    <td><?php echo e($postal_dispatch->note); ?></td>
                                    <td  data-sort="<?php echo e(strtotime($postal_dispatch->date)); ?>" ><?php echo e(!empty($postal_dispatch->date)? App\SmGeneralSettings::DateConvater($postal_dispatch->date):''); ?> </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->getFromJson('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                 <?php if(in_array(34, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>
                                                <a class="dropdown-item" href="<?php echo e(url('postal-dispatch', [$postal_dispatch->id
                                                    ])); ?>"><?php echo app('translator')->getFromJson('lang.edit'); ?></a>
                                               <?php endif; ?>
                                                <?php if(in_array(35, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>
                                               <a class="dropdown-item" data-toggle="modal" data-target="#deletePostalReceiveModal<?php echo e($postal_dispatch->id); ?>"
                                                    href="#"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
                                                <?php endif; ?>
                                                    <?php if($postal_dispatch->file != ""): ?>
                                                  <?php if(in_array(40, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>
                                                  
                                                  <?php if(@file_exists($postal_dispatch->file)): ?>
                                                        <a class="dropdown-item" href="<?php echo e(url('public/uploads/postal-dispatch-document/'.showPicName($postal_dispatch->file))); ?>">
                                                            <?php echo app('translator')->getFromJson('lang.download'); ?> <span class="pl ti-download"></span>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>    
                                                <?php endif; ?>    
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deletePostalReceiveModal<?php echo e($postal_dispatch->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.delete'); ?> <?php echo app('translator')->getFromJson('lang.postal_dispatch'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->getFromJson('lang.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->getFromJson('lang.cancel'); ?></button>
                                                     <?php echo e(Form::open(['url' => 'postal-dispatch/'.$postal_dispatch->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

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