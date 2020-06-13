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
                <h1><?php echo app('translator')->getFromJson('lang.background_settings'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->getFromJson('lang.system_settings'); ?></a>
                    <a href="#"><?php echo app('translator')->getFromJson('lang.background_settings'); ?></a>
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
                                    <?php echo app('translator')->getFromJson('lang.add'); ?>   <?php echo app('translator')->getFromJson('lang.style'); ?>
                                </h3>
                            </div>
                            <?php if(isset($visitor)): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'background-settings-update',
                                'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                            <?php else: ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'background-settings-store',
                                'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                            <?php endif; ?>
                            <div class="white-box">
                                <div class="add-visitor">


                                            <?php if(session()->has('message-success-add')): ?>
                                                <div class="alert alert-success">
                                                    <?php echo app('translator')->getFromJson('lang.inserted_message'); ?>
                                                </div>
                                            <?php elseif(session()->has('message-danger')): ?>
                                                <div class="alert alert-danger">
                                                    <?php echo app('translator')->getFromJson('lang.error_message'); ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if($errors->any()): ?>
                                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="alert alert-danger">
                                                    <?php echo e($error); ?>

                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>



                                    <div class="row mt-40">
                                        <div class="col-lg-12">
                                            <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('style') ? ' is-invalid' : ''); ?>" name="style" id="style">
                                                <option data-display="<?php echo app('translator')->getFromJson('lang.select_position'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_position'); ?> *</option>
                                                <option value="1">Dashboard Background</option>
                                                <option value="2">Login Page Background</option>
                                            </select>
                                            <?php if($errors->has('style')): ?>
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong><?php echo e($errors->first('style')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>




                                    <div class="row mt-40">
                                        <div class="col-lg-12"> 
                                            <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('background_type') ? ' is-invalid' : ''); ?>" name="background_type" id="background-type">
                                                <option data-display="<?php echo app('translator')->getFromJson('lang.background_type'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.background_type'); ?> *</option>            
                                                <option value="color">Color</option>
                                                <option value="image">Image (1920x1400)</option>
                                            </select>
                                            <?php if($errors->has('background_type')): ?>
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong><?php echo e($errors->first('background_type')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>



                                    <div class="row mt-40" id="background-color">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('color') ? ' is-invalid' : ''); ?>" type="color" name="color" autocomplete="off" value="<?php echo e(isset($visitor)? $visitor->purpose: old('color')); ?>">
                                                <input type="hidden" name="id" value="<?php echo e(isset($visitor)? $visitor->id: ''); ?>">
                                                <label><?php echo app('translator')->getFromJson('lang.color'); ?><span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('color')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('color')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>






                                    <div class="row no-gutters input-right-icon mt-35" id="background-image">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input" id="placeholderInput" type="text" placeholder="<?php echo e(isset($visitor)? ($visitor->file != ""? showPicName($visitor->file):'Background Image *'):'Background Image *'); ?>"
                                                       readonly>
                                                <span class="focus-border"></span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="browseFile"><?php echo app('translator')->getFromJson('lang.browse'); ?></label>
                                                <input type="file" class="d-none" id="browseFile" name="image">
                                            </button>
                                        </div>
                                    </div>


                                    


                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg">
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
                                <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.view'); ?></h3>
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
                                        <td colspan="4">
                                            <?php if(session()->has('message-success-status')): ?>
                                                <div class="alert alert-success">
                                                    <?php echo app('translator')->getFromJson('lang.inserted_message'); ?>
                                                </div>
                                            <?php elseif(session()->has('message-danger')): ?>
                                                <div class="alert alert-danger">
                                                    <?php echo app('translator')->getFromJson('lang.error_message'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <th><?php echo app('translator')->getFromJson('lang.title'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.type'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.background'); ?> <?php echo app('translator')->getFromJson('lang.image'); ?></th> 
                                    <th><?php echo app('translator')->getFromJson('lang.status'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $background_settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $background_setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($background_setting->title); ?></td>
                                        <td><p class="primary-btn small tr-bg"><?php echo e($background_setting->type); ?></p></td>
                                        <td>
                                            <?php if($background_setting->type == 'image'): ?>
                                            <img src="<?php echo e(asset($background_setting->image)); ?>" width="200px" height="100px">
                                            <?php else: ?>
                                             <div style="width: 200px; height: 100px; background-color:<?php echo e($background_setting->color); ?> "></div>
                                            <?php endif; ?>
                                        </td> 
                                        <td>
                                            <div class="col-md-12">
                                            
                                            <?php if($background_setting->is_default==1): ?> 
                                                <a  class="primary-btn small fix-gr-bg " href="<?php echo e(url('/background_setting-status')); ?>/<?php echo e($background_setting->id); ?>"> Activated </a> 
                                            <?php else: ?>
                                                <a  class="primary-btn small tr-bg" href="<?php echo e(url('/background_setting-status')); ?>/<?php echo e($background_setting->id); ?>"> Make Default</a> 

                                           

                                            <?php endif; ?>
                                        </div>
                                        </td>

                                        <td>
                                            <?php if($background_setting->id==1): ?>
                                            <p class="primary-btn small tr-bg">Disable</p>
                                            <?php else: ?>

                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <?php echo app('translator')->getFromJson('lang.select'); ?>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" data-toggle="modal"
                                                       data-target="#deletebackground_settingModal"
                                                       href="#"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
                                                </div>
                                            </div>

                                            <div class="modal fade admin-query" id="deletebackground_settingModal">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.delete'); ?></h4>
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

                                                                <a href="<?php echo e(url('background-setting-delete')); ?>/<?php echo e($background_setting->id); ?>"
                                                                   class="primary-btn fix-gr-bg"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <?php endif; ?>
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