<?php $__env->startSection('mainContent'); ?>
<?php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } ?>


<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.search_fees_due'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.fees_collection'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.search_fees_due'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.select_criteria'); ?> </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php if(session()->has('message-success') != ""): ?>
                        <?php if(session()->has('message-success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('message-success')); ?>

                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="white-box">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'fees_due_search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                            <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-4 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('fees_group') ? ' is-invalid' : ''); ?>" name="fees_group">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.fees_group'); ?>*" value=""><?php echo app('translator')->getFromJson('lang.fees_group'); ?> *</option>fees_groups
                                        <?php $__currentLoopData = $fees_masters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_master): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="" disabled><?php echo e($fees_master->feesGroups->name); ?></option>
                                             <?php $__currentLoopData = $fees_master->feesTypeIds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feesTypeId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($fees_master->fees_group_id.'-'.$feesTypeId->feesTypes->id); ?>" <?php echo e(isset($fees_group_id)? ($fees_group_id == $feesTypeId->feesTypes->id? 'selected':''):''); ?>><?php echo e($feesTypeId->feesTypes->name); ?></option>
                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('fees_group')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('fees_group')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-4 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_class'); ?>*" value=""><?php echo app('translator')->getFromJson('lang.select_class'); ?> *</option>
                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($class->id); ?>" <?php echo e(isset($class_id)? ($class_id == $class->id? 'selected':''):''); ?>><?php echo e($class->class_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-4 mt-30-md" id="select_section_div">
                                    <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
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
            
<?php if(isset($fees_dues)): ?>

            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"> <?php echo app('translator')->getFromJson('lang.fees_due_list'); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">

                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                                <thead>
                                    <tr>
                                        <th> <?php echo app('translator')->getFromJson('lang.admission'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?></th>
                                        <th> <?php echo app('translator')->getFromJson('lang.roll'); ?>  <?php echo app('translator')->getFromJson('lang.no'); ?></th>
                                        <th> <?php echo app('translator')->getFromJson('lang.name'); ?></th>
                                        <th> <?php echo app('translator')->getFromJson('lang.date_of_birth'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.due_birth'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.amount'); ?> (<?php echo e($currency); ?>)</th>
                                        <th><?php echo app('translator')->getFromJson('lang.deposit'); ?> (<?php echo e($currency); ?>)</th>
                                        <th><?php echo app('translator')->getFromJson('lang.discount'); ?> (<?php echo e($currency); ?>)</th>
                                        <th><?php echo app('translator')->getFromJson('lang.fine'); ?> (<?php echo e($currency); ?>)</th>
                                        <th><?php echo app('translator')->getFromJson('lang.balance'); ?> (<?php echo e($currency); ?>)</th>
                                        <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php $__currentLoopData = $fees_dues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_due): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($fees_due->studentInfo !=""?$fees_due->studentInfo->admission_no:""); ?></td>
                                        <td><?php echo e($fees_due->studentInfo !=""?$fees_due->studentInfo->roll_no:""); ?></td>
                                        <td><?php echo e($fees_due->studentInfo !=""?$fees_due->studentInfo->full_name:""); ?></td>
                                        <td>
                                            <?php if($fees_due->studentInfo !=""): ?>
                                           

                                           <?php echo e($fees_due->studentInfo->date_of_birth != ""? App\SmGeneralSettings::DateConvater($fees_due->studentInfo->date_of_birth):''); ?>

 
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($fees_due->feesGroupMaster !=""): ?>
                                            
  <?php echo e($fees_due->feesGroupMaster->date != ""? App\SmGeneralSettings::DateConvater($fees_due->feesGroupMaster->date):''); ?>


                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($fees_due->feesGroupMaster->fees_group_id != 1 && $fees_due->feesGroupMaster->fees_group_id != 2){
                                                    echo $fees_due->feesGroupMaster->amount;
                                                }else{
                                                    if($fees_due->feesGroupMaster->fees_group_id == 1){
                                                        echo $fees_due->studentInfo->route->far;
                                                    }else{
                                                        echo $fees_due->studentInfo->room->cost_per_bed;
                                                    }
                                                }
                                                
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                $amount = App\SmFeesAssign::discountSum($fees_due->student_id, $fees_due->feesGroupMaster->feesTypes->id, 'amount');
                                                echo $amount;
                                            ?>
                                        </td>
                                        <td>
                                        <?php
                                            $discount_amount = App\SmFeesAssign::discountSum($fees_due->student_id, $fees_due->feesGroupMaster->feesTypes->id, 'discount_amount');
                                            echo $discount_amount;
                                        ?>
                                        </td>
                                        <td>
                                        <?php
                                            $fine = App\SmFeesAssign::discountSum($fees_due->student_id, $fees_due->feesGroupMaster->feesTypes->id, 'fine');
                                            echo $fine;
                                        ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($fees_due->feesGroupMaster->fees_group_id != 1 && $fees_due->feesGroupMaster->fees_group_id != 2){
                                                    echo $fees_due->feesGroupMaster->amount - $discount_amount - $amount;
                                                }else{
                                                    if($fees_due->feesGroupMaster->fees_group_id == 1){
                                                        echo $fees_due->studentInfo->route->far - $discount_amount - $amount;
                                                    }else{
                                                        echo $fees_due->studentInfo->room->cost_per_bed - $discount_amount - $amount;
                                                    }
                                                }
                                                
                                            ?>
                                        </td>
                                        <td><div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                    <?php echo app('translator')->getFromJson('lang.select'); ?>
                                                </button>


                                                <?php if(in_array(117, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

                                            

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="<?php echo e(route('fees_collect_student_wise', [$fees_due->student_id])); ?>"><?php echo app('translator')->getFromJson('lang.view'); ?></a>
                                                </div>

                                                <?php endif; ?>
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

<?php endif; ?>

    </div>
</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>