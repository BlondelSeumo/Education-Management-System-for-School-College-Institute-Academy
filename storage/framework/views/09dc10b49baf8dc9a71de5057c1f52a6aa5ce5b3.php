<?php $__env->startSection('mainContent'); ?>
<?php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } ?>

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.fees_forward'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.fees_collection'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.fees_forward'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
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
                        <?php if(session()->has('message-success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('message-success')); ?>

                        </div>
                        <?php elseif(session()->has('message-danger')): ?>
                        <div class="alert alert-danger">
                            <?php echo e(session()->get('message-danger')); ?>

                        </div>
                        <?php endif; ?>
                    <div class="white-box">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'fees-forward-search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_studentA'])); ?>

                            <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-6 mt-30-md">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_class'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_class'); ?> *</option>
                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($class->id); ?>"  <?php echo e(isset($class_id)? ($class_id == $class->id? 'selected':''):''); ?>><?php echo e($class->class_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                     <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-6 mt-30-md" id="select_section_div">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_section'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_section'); ?> *</option>
                                    </select>
                                    <?php if($errors->has('section')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('section')); ?></strong>
                                    </span>
                                    <?php endif; ?>
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
    <?php if(isset($students)): ?>

        
            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'method' => 'POST', 'url' => 'fees-forward-store', 'enctype' => 'multipart/form-data'])); ?>

       


            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.previous_Session_Balance_Fees'); ?></h3>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="update" value="<?php echo e(isset($update)? 1: ''); ?>">
                      
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                
                                <thead>
                                    <?php if(isset($update)): ?>
                                    <tr>
                                        <td colspan="6">
                                            <div class="alert alert-success">
                                                <?php echo app('translator')->getFromJson('lang.previous_balance_can_only_update_now.'); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th width="15%"><?php echo app('translator')->getFromJson('lang.student'); ?> <?php echo app('translator')->getFromJson('lang.name'); ?></th>
                                        <th width="15%"><?php echo app('translator')->getFromJson('lang.admission'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?></th>
                                        <th width="15%"><?php echo app('translator')->getFromJson('lang.roll'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?></th>
                                        <th width="15%"><?php echo app('translator')->getFromJson('lang.admission'); ?> <?php echo app('translator')->getFromJson('lang.date'); ?></th>
                                        <th width="15%"><?php echo app('translator')->getFromJson('lang.father_name'); ?></th>
                                        <th width="25%"><?php echo app('translator')->getFromJson('lang.balance'); ?> (<?php echo e($currency); ?>)</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($student->first_name.' '.$student->last_name); ?> <input type="hidden" name="id[]" value="<?php echo e(isset($update)? $student->forwardBalance->id: $student->id); ?>"></td>
                                        <td><?php echo e($student->admission_no); ?></td>
                                        <td><?php echo e($student->roll_no); ?></td>
                                        <td  data-sort="<?php echo e(strtotime($student->admission_date)); ?>" >
                                            <?php echo e($student->admission_date != ""? App\SmGeneralSettings::DateConvater($student->admission_date):''); ?>


                                        </td>
                                        <td><?php echo e($student->parents !=""?$student->parents->fathers_name:""); ?></td>
                                        <td>
                                            <div class="input-effect">
                                                <input type="number" class="primary-input form-control" cols="0" rows="1" name="balance[<?php echo e(isset($update)? $student->forwardBalance->id:$student->id); ?>]" maxlength="8" value="<?php echo e(isset($update)?
                                                $student->forwardBalance->balance: ''); ?>">
                                                <label><?php echo app('translator')->getFromJson('lang.balance'); ?> <span></span></label>
                                                <span class="focus-border"></span>
                                                <span class="invalid-feedback">
                                                    <strong><?php echo app('translator')->getFromJson('lang.error'); ?></strong>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="text-center">
                                            <button type="submit" class="primary-btn fix-gr-bg mb-0">
                                                <span class="ti-save pr"></span>
                                                <?php echo app('translator')->getFromJson('lang.save'); ?>
                                            </button>
                                        </div>
                                    </td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    <?php echo e(Form::close()); ?>

    <?php endif; ?>

    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>