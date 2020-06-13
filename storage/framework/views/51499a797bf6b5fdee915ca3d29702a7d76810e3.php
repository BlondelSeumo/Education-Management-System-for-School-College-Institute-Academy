<script src="<?php echo e(asset('public/backEnd/')); ?>/js/main.js"></script>
<div class="container-fluid">
    <div class="student-details">
        <div class="text-center mb-4">
            <div class="d-flex justify-content-center">
                <div>
                    <img class="logo-img" src="http://localhost/naim/schoolmanagementsystem/public/backEnd/img/logo.png"
                        alt="">
                </div>
                <div class="ml-30">
                    <h2><?php if(isset($schoolDetails)): ?><?php echo e($schoolDetails->school_name); ?> <?php endif; ?></h2>
                    <p class="mb-0"><?php if(isset($schoolDetails)): ?><?php echo e($schoolDetails->address); ?> <?php endif; ?></p>
                </div>
            </div>
            <h3 class="mt-3">Payslip for the period of <?php echo e($payrollDetails->payroll_month); ?> <?php echo e($payrollDetails->payroll_year); ?></h3>
        </div>

        <div class="single-meta d-flex justify-content-between mb-4">
            <div class="value text-left">
                Payslip #<?php if(isset($payrollDetails)): ?><?php echo e($payrollDetails->id); ?> <?php endif; ?>
            </div>
            <div class="name">
               
                Payment Date: <?php if(isset($payrollDetails)): ?>

                <?php echo e(App\SmGeneralSettings::DateConvater($payrollDetails->payment_date)); ?>

               
                <?php endif; ?>
            </div>
        </div>


        <div class="student-meta-box">
            <div class="single-meta">
                <div class="row">
                    <div class="col-lg-3 col-md-5">
                        <div class="value text-left">
                            Staff ID
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-7">
                        <div class="name">
                            <?php if(isset($payrollDetails)): ?><?php echo e($payrollDetails->staffs->staff_no); ?> <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5">
                        <div class="value text-left">
                            Name
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-7">
                        <div class="name">
                            <?php if(isset($payrollDetails)): ?><?php echo e($payrollDetails->staffDetails->full_name); ?> <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="single-meta">
                <div class="row">
                    <div class="col-lg-3 col-md-5">
                        <div class="value text-left">
                            Department
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-7">
                        <div class="name">
                            <?php if(isset($payrollDetails)): ?><?php echo e($payrollDetails->staffDetails->departments->name); ?> <?php endif; ?>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5">
                        <div class="value text-left">
                            Designation
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-7">
                        <div class="name">
                            <?php if(isset($payrollDetails)): ?><?php echo e($payrollDetails->staffDetails->designations->title); ?> <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="single-meta">
                <div class="row">
                    <div class="col-lg-3 col-md-5">
                        <div class="value text-left">
                            Payment Mode
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-7">
                        <div class="name">
                            <?php if($payrollDetails->payment_mode != ""): ?>
                            <?php echo e($payrollDetails->paymentMethods->method); ?>

                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5">
                        <div class="value text-left">
                            Basic Salary
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-7">
                        <div class="name">
                            <?php if(isset($payrollDetails)): ?><?php echo e($payrollDetails->basic_salary); ?> <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-meta">
                <div class="row">
                    <div class="col-lg-3 col-md-5">
                        <div class="value text-left">
                            Gross Salary
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-7">
                        <div class="name">
                            <?php if(isset($payrollDetails)): ?><?php echo e($payrollDetails->gross_salary); ?> <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5">
                        <div class="value text-left">
                            Net Salary
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-7">
                        <div class="name">
                            <?php if(isset($payrollDetails)): ?><?php echo e($payrollDetails->net_salary); ?> <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>