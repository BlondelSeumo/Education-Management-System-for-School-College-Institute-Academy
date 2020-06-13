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
                <h1><?php echo app('translator')->getFromJson('lang.visitor_book'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->getFromJson('lang.admin_section'); ?></a>
                    <a href="#"><?php echo app('translator')->getFromJson('lang.visitor_book'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <?php if(isset($visitor)): ?>
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="<?php echo e(url('visitor')); ?>" class="primary-btn small fix-gr-bg">
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
                                    <h3 class="mb-30">
                                        <?php if(isset($visitor)): ?>
                                            <?php echo app('translator')->getFromJson('lang.edit'); ?>
                                        <?php else: ?>
                                            <?php echo app('translator')->getFromJson('lang.add'); ?>
                                        <?php endif; ?>
                                        <?php echo app('translator')->getFromJson('lang.visitor'); ?>
                                    </h3>
                                </div>
                                <?php if(isset($visitor)): ?>
                                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'visitor_update',
                                    'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                <?php else: ?>
                                  <?php if(in_array(17, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>
                                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'visitor_store',
                                    'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                <?php endif; ?>
                                <?php endif; ?>
                                <div class="white-box">
                                    <div class="add-visitor">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <?php if(session()->has('message-success')): ?>
                                                    <div class="alert alert-success">
                                                        <?php echo app('translator')->getFromJson('lang.inserted_message'); ?>
                                                    </div>
                                                <?php elseif(session()->has('message-danger')): ?>
                                                    <div class="alert alert-danger">
                                                        <?php echo app('translator')->getFromJson('lang.error_message'); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="input-effect">
                                                    <input
                                                            class="primary-input form-control<?php echo e($errors->has('purpose') ? ' is-invalid' : ''); ?>"
                                                            type="text" name="purpose" autocomplete="off"
                                                            value="<?php echo e(isset($visitor)? $visitor->purpose: old('purpose')); ?>">

                                                    <input type="hidden" name="id"
                                                           value="<?php echo e(isset($visitor)? $visitor->id: ''); ?>">
                                                    <label><?php echo app('translator')->getFromJson('lang.purpose'); ?><span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('purpose')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('purpose')); ?></strong>
                                                </span>
                                                    <?php endif; ?>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="row mt-35">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input
                                                            class="primary-input form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                                                            type="text" name="name" autocomplete="off"
                                                            value="<?php echo e(isset($visitor)? $visitor->name: old('name')); ?>">
                                                    <label><?php echo app('translator')->getFromJson('lang.name'); ?><span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('name')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('name')); ?></strong>
                                                </span>
                                                    <?php endif; ?>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row mt-35">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input
                                                            class="primary-input form-control<?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?>"
                                                            type="text" name="phone"
                                                            value="<?php echo e(isset($visitor)? $visitor->phone: old('phone')); ?>">
                                                    <label><?php echo app('translator')->getFromJson('lang.phone'); ?> <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('phone')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('phone')); ?></strong>
                                                </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-35">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input class="primary-input" type="text" name="visitor_id"
                                                           value="<?php echo e(isset($visitor)? $visitor->visitor_id: old('visitor_id')); ?>">
                                                    <label><?php echo app('translator')->getFromJson('lang.id'); ?></label>
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-35">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input class="primary-input" type="number" name="no_of_person"
                                                           value="<?php echo e(isset($visitor)? $visitor->no_of_person: old('no_of_person')); ?>">
                                                    <label><?php echo app('translator')->getFromJson('lang.no_of_person'); ?></label>
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row no-gutters input-right-icon mt-35">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input date" id="startDate" type="text"
                                                           name="date"
                                                           value="<?php echo e(isset($visitor)? date('m/d/Y', strtotime($visitor->date)): date('m/d/Y')); ?>">
                                                    <label><?php echo app('translator')->getFromJson('lang.date'); ?></label>
                                                    <span class="focus-border"></span>
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
                                                    <input class="primary-input time form-control<?php echo e($errors->has('in_time') ? ' is-invalid' : ''); ?>"
                                                           type="text" name="in_time"
                                                           value="<?php echo e(isset($visitor)? $visitor->in_time: old('in_time')); ?>">
                                                    <label><?php echo app('translator')->getFromJson('lang.in_time'); ?></label>
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="" type="button">
                                                    <i class="ti-timer"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row no-gutters input-right-icon mt-25">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input time  form-control<?php echo e($errors->has('out_time') ? ' is-invalid' : ''); ?>"
                                                           type="text" name="out_time"
                                                           value="<?php echo e(isset($visitor)? $visitor->out_time: old('out_time')); ?>">
                                                    <label><?php echo app('translator')->getFromJson('lang.out_time'); ?></label>
                                                    <span class="focus-border"></span>

                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="" type="button">
                                                    <i class="ti-timer"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row no-gutters input-right-icon mt-35">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input" id="placeholderInput" type="text"
                                                           placeholder="<?php echo e(isset($visitor)? ($visitor->file != ""? showPicName($visitor->file):'File Name'):'File Name'); ?>"
                                                           readonly>
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                           for="browseFile"><?php echo app('translator')->getFromJson('lang.browse'); ?></label>
                                                    <input type="file" class="d-none" id="browseFile" name="file">
                                                </button>
                                            </div>
                                        </div>
	                                 <?php 
                                  $tooltip = "";
                                  if(in_array(17, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>

                                        <div class="row mt-40">
                                            <div class="col-lg-12 text-center">
                                               <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                                    <span class="ti-check"></span>
                                                    <?php if(isset($visitor)): ?>
                                                        <?php echo app('translator')->getFromJson('lang.update'); ?>
                                                    <?php else: ?>
                                                        <?php echo app('translator')->getFromJson('lang.save'); ?>
                                                    <?php endif; ?>
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
                                <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.visitor_list'); ?></h3>
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
                                        <td colspan="8">
                                            <?php if(session()->has('message-success-delete')): ?>
                                                <div class="alert alert-success">
                                                    <?php echo app('translator')->getFromJson('lang.deleted_message'); ?>
                                                </div>
                                            <?php elseif(session()->has('message-danger-delete')): ?>
                                                <div class="alert alert-danger">
                                                    <?php echo app('translator')->getFromJson('lang.error_message'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <th><?php echo app('translator')->getFromJson('lang.name'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.no_of_person'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.phone'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.purpose'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.date'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.in_time'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.out_time'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.actions'); ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php $__currentLoopData = $visitors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visitor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($visitor->name); ?></td>
                                        <td><?php echo e($visitor->no_of_person); ?></td>
                                        <td><?php echo e($visitor->phone); ?></td>
                                        <td><?php echo e($visitor->purpose); ?></td>
                                        <td  data-sort="<?php echo e(strtotime($visitor->date)); ?>" ><?php echo e(!empty($visitor->date)? App\SmGeneralSettings::DateConvater($visitor->date):''); ?></td>
                                        <td><?php echo e($visitor->in_time); ?></td>
                                        <td><?php echo e($visitor->out_time); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <?php echo app('translator')->getFromJson('lang.select'); ?>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <?php if(in_array(18, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>

                                                        <a class="dropdown-item"
                                                           href="<?php echo e(route('visitor_edit', [$visitor->id])); ?>"><?php echo app('translator')->getFromJson('lang.edit'); ?></a>
                                                    <?php endif; ?>
                                                    <?php if(in_array(19, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>

                                                        <a class="dropdown-item" data-toggle="modal"
                                                           data-target="#deleteVisitorModal<?php echo e($visitor->id); ?>"
                                                           href="#"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
                                                        <?php if($visitor->file != ""): ?>
                                                            <?php if(in_array(20, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>

                                                                <a class="dropdown-item"
                                                                   href="<?php echo e(url('download-visitor-document/'.showPicName($visitor->file))); ?>">
                                                                    <?php echo app('translator')->getFromJson('lang.download'); ?> <span
                                                                            class="pl ti-download"></span>
                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade admin-query" id="deleteVisitorModal<?php echo e($visitor->id); ?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.delete'); ?> <?php echo app('translator')->getFromJson('lang.visitor'); ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4><?php echo app('translator')->getFromJson('lang.are_you_sure_to_delete'); ?></h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg"
                                                                data-dismiss="modal"><?php echo app('translator')->getFromJson('lang.cancel'); ?>
                                                        </button>

                                                        <a href="<?php echo e(route('visitor_delete', [$visitor->id])); ?>"
                                                           class="primary-btn fix-gr-bg"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>

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