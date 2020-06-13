<?php $__env->startSection('mainContent'); ?>

<?php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } ?>


<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.staffs_payroll'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="<?php echo e(url('payroll')); ?>"><?php echo app('translator')->getFromJson('lang.payroll'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.generate_payroll'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="student-details mb-40">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.generate_payroll'); ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="student-meta-box">
                    <div class="student-meta-top staff-meta-top"></div>
                    <img class="student-meta-img img-100" src="<?php echo e(asset($staffDetails->staff_photo)); ?>"  alt="">
                    <div class="white-box">
                        <div class="single-meta mt-20">
                            <div class="row">
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        <?php echo app('translator')->getFromJson('lang.name'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->full_name); ?><?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        <?php echo app('translator')->getFromJson('lang.staff_no'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->staff_no); ?><?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-3">
                                    <div class="value text-left">
                                        <?php echo app('translator')->getFromJson('lang.month'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-9 d-flex">
                                    <div class="value ml-20" data-toggle="tooltip" title="Present!">
                                        P
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip" title="Late!">
                                        L
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip" title="Absent!">
                                        A
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip" title="Half Day!">
                                        F
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip" title="Holiday!">
                                        H
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip" title="Approved Leave!">
                                        V
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        <?php echo app('translator')->getFromJson('lang.mobile'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                       <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->mobile); ?><?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        <?php echo app('translator')->getFromJson('lang.email'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->email); ?><?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-3">
                                    <div class="value text-left">
                                        <?php echo e($payroll_month); ?>

                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-9 d-flex">
                                    <div class="value ml-20">
                                        
                                        <?php echo e($p); ?>

                                    </div>
                                    <div class="value ml-20">
                                        
                                        <?php echo e($l); ?>

                                    </div>
                                    <div class="value ml-20">
                                        
                                        <?php echo e($a); ?>

                                    </div>
                                    <div class="value ml-20">
                                        
                                        <?php echo e($f); ?>

                                    </div>
                                    <div class="value ml-20">
                                        
                                        <?php echo e($h); ?>

                                    </div>
                                    <div class="value ml-20">
                                        V
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        <?php echo app('translator')->getFromJson('lang.role'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->roles->name); ?><?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        <?php echo app('translator')->getFromJson('lang.department'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->departments->name); ?><?php endif; ?>
                                    </div>
                                </div>
                                 
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        <?php echo app('translator')->getFromJson('lang.designation'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                       <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->designations->title); ?><?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        <?php echo app('translator')->getFromJson('lang.date_of_joining'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        <?php if(isset($staffDetails)): ?>
                                           <?php echo e($staffDetails->date_of_joining != ""? App\SmGeneralSettings::DateConvater($staffDetails->date_of_joining):''); ?>


                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'savePayrollData', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

<section class="">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="d-flex justify-content-between mb-20">
                    <div class="main-title">
                        <h3><?php echo app('translator')->getFromJson('lang.earnings'); ?></h3>
                    </div>

                    <div>
                        <button type="button" class="primary-btn icon-only fix-gr-bg" onclick="addMoreEarnings()">
                            <span class="ti-plus"></span>
                        </button>
                    </div>
                </div>

                <div class="white-box">
                    <table class="w-100 table-responsive" id="tableID">
                        <tbody id="addEarningsTableBody">
                            <tr id="row0">
                                <td width="70%" class="pr-30">
                                    <div class="input-effect mt-10">
                                        <input class="primary-input form-control" type="text" id="earningsType0" name="earningsType[]">
                                        <label for="earningsType0"><?php echo app('translator')->getFromJson('lang.type'); ?></label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                                <td width="20%" class="pr-30">
                                    <div class="input-effect mt-10">
                                        <input class="primary-input form-control" type="number" id="earningsValue0"  name="earningsValue[]">
                                        <label for="earningsValue0"><?php echo app('translator')->getFromJson('lang.value'); ?></label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-4 no-gutters">
                <div class="d-flex justify-content-between mb-20">
                    <div class="main-title">
                        <h3><?php echo app('translator')->getFromJson('lang.deductions'); ?></h3>
                    </div>

                    <div>
                        <button type="button" class="primary-btn icon-only fix-gr-bg" onclick="addDeductions()">
                            <span class="ti-plus"></span>
                        </button>
                    </div>
                </div>

                <div class="white-box">
                <table class="w-100 table-responsive" id="tableDeduction">
                        <tbody id="addDeductionsTableBody">
                            <tr id="DeductionRow0">
                                <td width="80%" class="pr-30">
                                    <div class="input-effect mt-10">
                                        <input class="primary-input form-control" type="text" id="deductionstype0" name="deductionstype[]">
                                        <label for="deductionstype0"><?php echo app('translator')->getFromJson('lang.type'); ?></label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                                <td width="20%">
                                    <div class="input-effect mt-10">
                                        <input class="primary-input form-control" type="number" id="deductionsValue0" name="deductionsValue[]">
                                        <label for="deductionsValue0"><?php echo app('translator')->getFromJson('lang.value'); ?></label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-4 no-gutters">
                <div class="d-flex justify-content-between mb-20">
                    <div class="main-title">
                        <h3><?php echo app('translator')->getFromJson('lang.payroll_summary'); ?></h3>
                    </div>

                    <div>
                        <button type="button" class="primary-btn small fix-gr-bg" onclick="calculateSalary()">
                            <?php echo app('translator')->getFromJson('lang.calculate'); ?>
                        </button>
                    </div>
                </div>

                <input type="hidden" name="staff_id" value="<?php echo e($staffDetails->id); ?>">
                <input type="hidden" name="payroll_month" value="<?php echo e($payroll_month); ?>">
                <input type="hidden" name="payroll_year" value="<?php echo e($payroll_year); ?>">


                <div class="white-box">
                <table class="w-100 table-responsive">
                        <tbody class="d-block">
                            <tr class="d-block">
                                <td width="100%" class="pr-30 d-block">
                                    <div class="input-effect mt-10">
                                        <input class="primary-input form-control" type="text" id="basicSalary" value="<?php echo e($staffDetails->basic_salary); ?>" name="basic_salary" readonly>
                                        <label for="basicSalary"><?php echo app('translator')->getFromJson('lang.basic_salary'); ?> (<?php echo e($currency); ?>)</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="d-block">
                                <td width="100%" class="pr-30 d-block">
                                    <div class="input-effect mt-30">
                                        <input class="primary-input form-control" type="text" id="total_earnings" name="total_earning">
                                        <label for="total_earnings"><?php echo app('translator')->getFromJson('lang.earning'); ?></label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="d-block">
                                <td width="100%" class="pr-30 d-block">
                                    <div class="input-effect mt-30">
                                        <input class="primary-input form-control" type="text" id="total_deduction" name="total_deduction">
                                        <label for="total_deduction"><?php echo app('translator')->getFromJson('lang.deduction'); ?></label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="d-block">
                                <td width="100%" class="pr-30 d-block">
                                    <div class="input-effect mt-30">
                                        <input class="primary-input form-control" type="text" id="gross_salary" value="0">
                                        <input type="hidden" name="final_gross_salary" id="final_gross_salary">
                                        <label for="gross_salary"><?php echo app('translator')->getFromJson('lang.gross_salary'); ?>  (<?php echo e($currency); ?>)</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="d-block">
                                <td width="100%" class="pr-30 d-block">
                                    <div class="input-effect mt-30">
                                        <input class="primary-input form-control" type="text" id="tax" value="0" name="tax">
                                        <label for="tax"><?php echo app('translator')->getFromJson('lang.tax'); ?></label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="d-block">
                                <td width="100%" class="pr-30 d-block">
                                    <div class="input-effect mt-30 mb-30">
                                        <input class="primary-input form-control<?php echo e($errors->has('net_salary') ? ' is-invalid' : ''); ?>" type="text" id="net_salary" name="net_salary">
                                        <label for="net_salary"><?php echo app('translator')->getFromJson('lang.net_salary'); ?> (<?php echo e($currency); ?>)</label>
                                        <span class="focus-border"></span>

                                        <?php if($errors->has('net_salary')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('net_salary')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12 mt-20 text-right">
                <!-- <button type="submit" class="primary-btn small fix-gr-bg">
                    Submit
                </button> -->

                <?php if(in_array(175, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

              

                <button class="primary-btn fix-gr-bg">
                    <span class="ti-check"></span>
                    <?php echo app('translator')->getFromJson('lang.submit'); ?>
                </button>
                <?php endif; ?>
            </div>
           
            </div>
        </div>
    </div>
</section>
<?php echo e(Form::close()); ?>

<!-- End Modal Area -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>