<?php $__env->startSection('mainContent'); ?>
<?php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.search_income_expense'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.accounts'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.search_income_expense'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
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
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'search_account', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_income_expense'])); ?>

                            <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-3 mt-30-md">
                                    <div class="no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control<?php echo e($errors->has('date_from') ? ' is-invalid' : ''); ?>" id="startDate" type="text"
                                                     name="date_from" value="<?php echo e(isset($from_date)? date('m/d/Y', strtotime($from_date)):date('m/d/Y')); ?>" readonly>
                                                    <label><?php echo app('translator')->getFromJson('lang.date_from'); ?></label>
                                                    <span class="focus-border"></span>
                                                <?php if($errors->has('date_from')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('date_from')); ?></strong>
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
                                </div>
                                <div class="col-lg-3 mt-30-md">
                                    <div class="no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control<?php echo e($errors->has('date_to') ? ' is-invalid' : ''); ?>" id="startDate" type="text"
                                                     name="date_to" value="<?php echo e(isset($to_date)? date('m/d/Y', strtotime($to_date)):date('m/d/Y')); ?>" readonly>
                                                    <label><?php echo app('translator')->getFromJson('lang.date_to'); ?></label>
                                                    <span class="focus-border"></span>
                                                <?php if($errors->has('date_to')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('date_to')); ?></strong>
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
                                </div>
                                <div class="col-lg-3">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('type') ? ' is-invalid' : ''); ?>" name="type" id="account-type">
                                        <option data-display="Select Type *" value=""><?php echo app('translator')->getFromJson('lang.search'); ?> <?php echo app('translator')->getFromJson('lang.type'); ?>*</option>
                                        <option value="In" <?php echo e(isset($type_id)? ($type_id == "In"? 'selected':''):''); ?>><?php echo app('translator')->getFromJson('lang.income'); ?></option>
                                        <option value="Ex" <?php echo e(isset($type_id)? ($type_id == "Ex"? 'selected':''):''); ?>><?php echo app('translator')->getFromJson('lang.expense'); ?></option>
                                    </select>
                                    <?php if($errors->has('type')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('type')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-3" id="filtering_div">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('filtering') ? ' is-invalid' : ''); ?>" name="filtering" id="filtering_section">
                                    </select>
                                    <?php if($errors->has('type')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('type')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-3" id="income_div">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('filtering') ? ' is-invalid' : ''); ?>" name="filtering_income" id="filtering_section">
                                        <option value="all"><?php echo app('translator')->getFromJson('lang.all'); ?></option>
                                        <option value="sell"><?php echo app('translator')->getFromJson('lang.item_sell'); ?></option>
                                        <option value="fees"><?php echo app('translator')->getFromJson('lang.fees_collection'); ?></option>
                                        <option value="dormitory"><?php echo app('translator')->getFromJson('lang.dormitory'); ?></option>
                                        <option value="transport"><?php echo app('translator')->getFromJson('lang.transport'); ?></option>
                                    </select>
                                    
                                </div>
                                <div class="col-lg-3" id="expense_div">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('filtering') ? ' is-invalid' : ''); ?>" name="filtering_expense" id="filtering_section">
                                        <option value="all"><?php echo app('translator')->getFromJson('lang.all'); ?></option>
                                        <option value="receive"><?php echo app('translator')->getFromJson('lang.item_Receive'); ?></option>
                                        <option value="payroll"><?php echo app('translator')->getFromJson('lang.payroll'); ?></option>
                                    </select>
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

            
<?php if(isset($add_incomes)): ?>


            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.income'); ?> <?php echo app('translator')->getFromJson('lang.result'); ?></h3>
                            </div>
                        </div>
                    </div>

                
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->getFromJson('lang.name'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.income_Head'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.amount'); ?>(<?php echo e($currency); ?>)</th>
                                    </tr>
                                </thead>
                                <?php $total_income = 0;?>
                                <tbody>
                                    <?php $__currentLoopData = $add_incomes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $add_income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $total_income = $total_income + $add_income->amount; ?>
                                    <tr>
                                        <td><?php echo e($add_income->name); ?></td>
                                        <td><?php echo e($add_income->ACHead!=""?$add_income->ACHead->head:""); ?></td>
                                        <td><?php echo e(number_format($add_income->amount, 2)); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                    <?php if($fees_payments != ""): ?>
                                        <?php $total_income = $total_income + $fees_payments; ?>
                                        <tr>
                                            <td><?php echo app('translator')->getFromJson('lang.fees_collection'); ?></td>
                                            <td><?php echo app('translator')->getFromJson('lang.fees'); ?></td>
                                            <td><?php echo e(number_format($fees_payments, 2)); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if($item_sells != ""): ?>
                                    <?php $total_income = $total_income + $item_sells; ?>
                                    <tr>
                                        <td><?php echo app('translator')->getFromJson('lang.item_sell'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('lang.sells'); ?></td>
                                        <td><?php echo e(number_format($item_sells, 2)); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($dormitory != 0): ?>
                                    <?php $total_income = $total_income + $dormitory; ?>
                                    <tr>
                                        <td><?php echo app('translator')->getFromJson('lang.dormitory'); ?> <?php echo app('translator')->getFromJson('lang.fees'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('lang.dormitory'); ?></td>
                                        <td><?php echo e(number_format($dormitory, 2)); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th><?php echo app('translator')->getFromJson('lang.grand_total'); ?></th>
                                        <th><?php echo e(number_format($total_income, 2)); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

<?php endif; ?>

<?php if(isset($add_expenses)): ?>


            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.expense'); ?> <?php echo app('translator')->getFromJson('lang.result'); ?></h3>
                            </div>
                        </div>
                    </div>

                
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->getFromJson('lang.name'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.expense_head'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.amount'); ?>(<?php echo e($currency); ?>)</th>
                                    </tr>
                                </thead>
                                <?php $total_expense = 0;?>
                                <tbody>
                                    <?php $__currentLoopData = $add_expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $add_expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $total_expense = $total_expense + $add_expense->amount; ?>
                                    <tr>
                                        <td><?php echo e($add_expense->name); ?></td>
                                        <td><?php echo e($add_expense->ACHead!=""?$add_expense->ACHead->head:""); ?></td>
                                        <td><?php echo e(number_format($add_expense->amount, 2)); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($item_receives != 0): ?>
                                    <?php $total_expense = $total_expense + $item_receives; ?>
                                    <tr>
                                        <td><?php echo app('translator')->getFromJson('lang.item'); ?> <?php echo app('translator')->getFromJson('lang.purchase'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('lang.purchase'); ?></td>
                                        <td><?php echo e(number_format($item_receives, 2)); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($payroll_payments != 0): ?>
                                    <?php $total_expense = $total_expense + $payroll_payments; ?>
                                    <tr>
                                        <td><?php echo app('translator')->getFromJson('lang.from'); ?> <?php echo app('translator')->getFromJson('lang.payroll'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('lang.payroll'); ?></td>
                                        <td><?php echo e(number_format($payroll_payments, 2)); ?></td>
                                    </tr>
                                    <?php endif; ?>  
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th><?php echo app('translator')->getFromJson('lang.grand_total'); ?></th>
                                        <th><?php echo e(number_format($total_expense, 2)); ?></th>
                                    </tr>
                                </tfoot>
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