<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.supplier'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.inventory'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.supplier'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
         <?php if(isset($editData)): ?>
          <?php if(in_array(329, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
           
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(url('suppliers')); ?>" class="primary-btn small fix-gr-bg">
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
                                <?php echo app('translator')->getFromJson('lang.supplier'); ?>
                            </h3>
                        </div>
                        <?php if(isset($editData)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'suppliers/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                         <?php if(in_array(329, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'suppliers',
                        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <?php if(session()->has('message-success')): ?>
                                    <div class="alert alert-success mb-20">
                                        <?php echo e(session()->get('message-success')); ?>

                                    </div>
                                    <?php elseif(session()->has('message-danger')): ?>
                                    <div class="alert alert-danger">
                                        <?php echo e(session()->get('message-danger')); ?>

                                    </div>
                                    <?php endif; ?>
                                   <div class="col-lg-12 mb-30">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('company_name') ? ' is-invalid' : ''); ?>"
                                            type="text" name="company_name" autocomplete="off" value="<?php echo e(isset($editData)? $editData->company_name : old('company_name')); ?>">
                                            <label> <?php echo app('translator')->getFromJson('lang.company'); ?>  <?php echo app('translator')->getFromJson('lang.name'); ?> <span>*</span> </label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('company_name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('company_name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-30">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control<?php echo e($errors->has('company_address') ? 'is-invalid' : ''); ?>" cols="0" rows="4" name="company_address" id="company_address"><?php echo e(isset($editData) ? $editData->company_address : old('company_address')); ?></textarea>
                                            <label> <?php echo app('translator')->getFromJson('lang.company'); ?>  <?php echo app('translator')->getFromJson('lang.address'); ?> <span></span> </label>
                                            <span class="focus-border textarea"></span>
                                            <?php if($errors->has('company_address')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('company_address')); ?></strong>
                                            </span>
                                            <?php endif; ?>

                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-30">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('contact_person_name') ? ' is-invalid' : ''); ?>"
                                            type="text" name="contact_person_name" autocomplete="off" value="<?php echo e(isset($editData)? $editData->contact_person_name : old('contact_person_name')); ?>">
                                            <label><?php echo app('translator')->getFromJson('lang.contact_person_name'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('contact_person_name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('contact_person_name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-30">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('contact_person_mobile') ? ' is-invalid' : ''); ?>"
                                            type="number" name="contact_person_mobile" autocomplete="off" value="<?php echo e(isset($editData)? $editData->contact_person_mobile : old('contact_person_mobile')); ?>">
                                            <label><?php echo app('translator')->getFromJson('lang.contact_person'); ?> <?php echo app('translator')->getFromJson('lang.mobile'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('contact_person_mobile')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('contact_person_mobile')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-30">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('contact_person_email') ? ' is-invalid' : ''); ?>"
                                            type="text" name="contact_person_email" autocomplete="off" value="<?php echo e(isset($editData)? $editData->contact_person_email : old('contact_person_email')); ?>">
                                            <label><?php echo app('translator')->getFromJson('lang.contact_person'); ?> <?php echo app('translator')->getFromJson('lang.email'); ?> </label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('contact_person_email')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('contact_person_email')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-30">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4" name="description" id="description"><?php echo e(isset($editData) ? $editData->description : old('description')); ?></textarea>
                                            <label><?php echo app('translator')->getFromJson('lang.description'); ?> <span></span> </label>
                                            <span class="focus-border textarea"></span>

                                        </div>
                                    </div>

                                </div>
                                	  <?php 
                                  $tooltip = "";
                                  if(in_array(329, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
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
                        <h3 class="mb-0"> <?php echo app('translator')->getFromJson('lang.supplier'); ?>  <?php echo app('translator')->getFromJson('lang.list'); ?></h3>
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
                                <th> <?php echo app('translator')->getFromJson('lang.supplier'); ?>  <?php echo app('translator')->getFromJson('lang.name'); ?></th>
                                <th> <?php echo app('translator')->getFromJson('lang.company'); ?>  <?php echo app('translator')->getFromJson('lang.name'); ?></th>
                                <th> <?php echo app('translator')->getFromJson('lang.company'); ?>  <?php echo app('translator')->getFromJson('lang.address'); ?></th>
                                <th> <?php echo app('translator')->getFromJson('lang.email'); ?></th>
                                <th> <?php echo app('translator')->getFromJson('lang.mobile'); ?></th>
                                <th> <?php echo app('translator')->getFromJson('lang.action'); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if(isset($suppliers)): ?>
                            <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>

                                <td><?php echo e($value->contact_person_name); ?></td>
                                <td><?php echo e($value->company_name); ?></td>
                                <td><?php echo e($value->company_address); ?></td>
                                <td><?php echo e($value->contact_person_email); ?></td>
                                <td><?php echo e($value->contact_person_mobile); ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            <?php echo app('translator')->getFromJson('lang.select'); ?>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
 <?php if(in_array(330, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                                            <a class="dropdown-item" href="<?php echo e(url('suppliers/'.$value->id.'/edit')); ?>"> <?php echo app('translator')->getFromJson('lang.edit'); ?></a>
<?php endif; ?>
 <?php if(in_array(331, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                                            <a class="deleteUrl dropdown-item" data-modal-size="modal-md" title="Delete Supplier" href="<?php echo e(url('delete-supplier-view/'.$value->id)); ?>"> <?php echo app('translator')->getFromJson('lang.delete'); ?></a>
<?php endif; ?>
                                        </div>
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