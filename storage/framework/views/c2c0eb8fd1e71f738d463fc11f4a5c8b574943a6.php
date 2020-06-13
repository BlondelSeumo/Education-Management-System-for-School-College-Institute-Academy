<?php $__env->startSection('mainContent'); ?>
<?php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } ?>

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.payroll_report'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.human_resource'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.payroll_report'); ?></a>
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
            <?php if(session()->has('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session()->get('success')); ?>

            </div>
            <?php elseif(session()->has('danger')): ?>
            <div class="alert alert-danger">
                <?php echo e(session()->get('danger')); ?>

            </div>
            <?php endif; ?>
            <div class="white-box">
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'searchPayrollReport', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                <div class="row">
                    <div class="col-lg-4 mt-30-md">
                        <select class="niceSelect w-100 bb form-control <?php echo e($errors->has('role_id') ? ' is-invalid' : ''); ?>" name="role_id" id="role_id">
                            <option data-display="<?php echo app('translator')->getFromJson('lang.role'); ?>" value=""><?php echo app('translator')->getFromJson('lang.select'); ?> </option>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value->id); ?>" <?php echo e(isset($role_id)? ($role_id == $value->id? 'selected':''):''); ?>><?php echo e($value->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('role_id')): ?>
                        <span class="invalid-feedback invalid-select" role="alert">
                            <strong><?php echo e($errors->first('role_id')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>

                     <?php $month = date('F'); ?>
                    <div class="col-lg-4 mt-30-md">
                      <select class="niceSelect w-100 bb form-control <?php echo e($errors->has('payroll_month') ? 'is-invalid' : ''); ?>" name="payroll_month" id="payroll_month">
                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_month'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_month'); ?>  *</option>
                        <option value="January" <?php echo e(isset($payroll_month)? ($payroll_month == "January"? 'selected':''):($month == "January"? 'selected':'')); ?>><?php echo app('translator')->getFromJson('lang.january'); ?></option>
                        <option value="February"  <?php echo e(isset($payroll_month)? ($payroll_month == "February"? 'selected':''):($month == "February"? 'selected':'')); ?>><?php echo app('translator')->getFromJson('lang.february'); ?></option>
                        <option value="March"  <?php echo e(isset($payroll_month)? ($payroll_month == "March"? 'selected':''):($month == "March"? 'selected':'')); ?>><?php echo app('translator')->getFromJson('lang.march'); ?></option>
                        <option value="April" <?php echo e(isset($payroll_month)? ($payroll_month == "April"? 'selected':''):($month == "April"? 'selected':'')); ?>><?php echo app('translator')->getFromJson('lang.april'); ?></option>
                        <option value="May" <?php echo e(isset($payroll_month)? ($payroll_month == "May"? 'selected':''):($month == "May"? 'selected':'')); ?>><?php echo app('translator')->getFromJson('lang.may'); ?></option>
                        <option value="June" <?php echo e(isset($payroll_month)? ($payroll_month == "June"? 'selected':''):($month == "June"? 'selected':'')); ?>><?php echo app('translator')->getFromJson('lang.june'); ?></option>
                        <option value="July" <?php echo e(isset($payroll_month)? ($payroll_month == "July"? 'selected':''):($month == "July"? 'selected':'')); ?>><?php echo app('translator')->getFromJson('lang.july'); ?></option>
                        <option value="August" <?php echo e(isset($payroll_month)? ($payroll_month == "August"? 'selected':''):($month == "August"? 'selected':'')); ?>><?php echo app('translator')->getFromJson('lang.august'); ?></option>
                        <option value="September" <?php echo e(isset($payroll_month)? ($payroll_month == "September"? 'selected':''):($month == "September"? 'selected':'')); ?>><?php echo app('translator')->getFromJson('lang.september'); ?></option>
                        <option value="October" <?php echo e(isset($payroll_month)? ($payroll_month == "October"? 'selected':''):($month == "October"? 'selected':'')); ?>><?php echo app('translator')->getFromJson('lang.october'); ?></option>
                        <option value="November" <?php echo e(isset($payroll_month)? ($payroll_month == "November"? 'selected':''):($month == "November"? 'selected':'')); ?>><?php echo app('translator')->getFromJson('lang.november'); ?></option>
                        <option value="December" <?php echo e(isset($payroll_month)? ($payroll_month == "December"? 'selected':''):($month == "December"? 'selected':'')); ?>><?php echo app('translator')->getFromJson('lang.december'); ?></option>
                    </select>
                    <?php if($errors->has('payroll_month')): ?>
                    <span class="invalid-feedback invalid-select" role="alert">
                        <strong><?php echo e($errors->first('payroll_month')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4">
                  <select class="niceSelect w-100 bb form-control <?php echo e($errors->has('payroll_year') ? 'is-invalid' : ''); ?>" name="payroll_year" id="payroll_year">
                    <option data-display="<?php echo app('translator')->getFromJson('lang.select_year'); ?>*" value=""><?php echo app('translator')->getFromJson('lang.select_year'); ?> *</option>

                    <?php 
                        $year = date('Y');
                        $ini = date('y');
                        $limit = $ini + 30;

                    ?>

                    <?php for($i = $ini; $i <= $limit; $i++): ?>

                    <option value="<?php echo e($year); ?>" <?php echo e(isset($payroll_year)? ($payroll_year == $year? 'selected':''):(date('Y') == $year? 'selected':'')); ?>><?php echo e($year--); ?></option>

                    <?php endfor; ?>
                </select>
                <?php if($errors->has('payroll_year')): ?>
                <span class="invalid-feedback invalid-select" role="alert">
                    <strong><?php echo e($errors->first('payroll_year')); ?></strong>
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
<?php if(isset($staffsPayroll)): ?>
<div class="row mt-40">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.staff_list'); ?></h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('lang.staff'); ?> <?php echo app('translator')->getFromJson('lang.name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.role'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.description'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.month'); ?> - <?php echo app('translator')->getFromJson('lang.year'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.payslip'); ?> #</th>
                            <th><?php echo app('translator')->getFromJson('lang.basic_salary'); ?>(<?php echo e($currency); ?>)</th>
                            <th><?php echo app('translator')->getFromJson('lang.earnings'); ?>(<?php echo e($currency); ?>)</th>
                            <th><?php echo app('translator')->getFromJson('lang.deductions'); ?>(<?php echo e($currency); ?>)</th>
                            <th><?php echo app('translator')->getFromJson('lang.gross_salary'); ?>(<?php echo e($currency); ?>)</th>
                            <th><?php echo app('translator')->getFromJson('lang.tax'); ?>(<?php echo e($currency); ?>)</th>
                            <th><?php echo app('translator')->getFromJson('lang.net_salary'); ?>(<?php echo e($currency); ?>)</th>
                        </tr>
                    </thead>

                    <tbody>
                      <?php 
                        $basic_salary = 0; 
                        $earnings = 0;
                        $deductions = 0;
                        $gross_salary = 0;
                        $tax = 0;
                        $net_salary = 0;
                     ?>
                      <?php $__currentLoopData = $staffsPayroll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($value->full_name); ?></td>
                        <td><?php echo e($value->name); ?></td>
                        <td><?php echo e($value->title); ?></td>
                        <td><?php echo e($value->payroll_month); ?> - <?php echo e($value->payroll_year); ?></td>
                        <td><?php echo e($value->id); ?></td>
                        <td><?php echo e($value->basic_salary); ?></td>
                        <td>
                            <?php
                            $totalEarnings = App\SmHrPayrollEarnDeduc::getTotalEarnings($value->id);
                            ?>
                            <?php if($totalEarnings>0): ?>
                            <?php echo e($totalEarnings); ?>

                            <?php $earnings +=$totalEarnings; ?>
                            <?php else: ?>
                            <?php echo e(0); ?>

                            <?php endif; ?>
                        </td>
                        <td>
                            <?php
                            $totalDeductions = App\SmHrPayrollEarnDeduc::getTotalDeductions($value->id);
                            ?>
                            <?php if($totalDeductions>0): ?>
                            <?php echo e($totalDeductions); ?>

                            <?php $deductions +=$totalDeductions; ?>
                            <?php else: ?>
                            <?php echo e(0); ?>

                            <?php endif; ?>
                        </td>
                        <td><?php echo e($value->gross_salary); ?></td>
                        <td><?php echo e($value->tax); ?></td>
                        <td><?php echo e($value->net_salary); ?></td>
                        <?php 
                        $basic_salary += $value->basic_salary;
                        $gross_salary += $value->gross_salary;
                        $tax += $value->tax;
                        $net_salary += $value->net_salary;
                        ?>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><?php echo app('translator')->getFromJson('lang.grand_total'); ?></th>
                        <th>$<?php echo e($basic_salary); ?></th>
                        <th>$<?php echo e($earnings); ?></th>
                        <th>$<?php echo e($deductions); ?></th>
                        <th>$<?php echo e($gross_salary); ?></th>
                        <th>$<?php echo e($tax); ?></th>
                        <th>$<?php echo e($net_salary); ?></th>
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