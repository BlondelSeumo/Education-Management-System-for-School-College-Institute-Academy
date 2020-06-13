<?php $__env->startSection('mainContent'); ?>
<?php  $setting = App\SmGeneralSettings::find(1);  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   ?> 

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.fees_statement'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.reports'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.fees_statement'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area student-details">
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
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'fees_statement_search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                            <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-4 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_class'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_class'); ?> *</option>
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
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_section'); ?>*" value=""><?php echo app('translator')->getFromJson('lang.select_section'); ?> *</option>
                                    </select>
                                    <?php if($errors->has('section')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('section')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-4 mt-30-md" id="select_student_div">
                                    <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('student') ? ' is-invalid' : ''); ?>" id="select_student" name="student">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_student'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_student'); ?> *</option>
                                    </select>
                                    <?php if($errors->has('student')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('student')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search"></span>
                                        <?php echo app('translator')->getFromJson('lang.search'); ?>
                                    </button>
                                </div>
                        </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
            
    <?php if(isset($fees_assigneds)): ?>
    <div class="row mt-40">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.fees_statement'); ?></h3>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="student-meta-box">
                    <div class="student-meta-top staff-meta-top"></div>
                    <img class="student-meta-img img-100" src="<?php echo e(asset($student->student_photo)); ?>" alt="">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="single-meta mt-20">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php echo app('translator')->getFromJson('lang.name'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo e($student->full_name); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php echo app('translator')->getFromJson('lang.father_name'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo e($student->parents !=""?$student->parents->fathers_name:""); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php echo app('translator')->getFromJson('lang.mobile'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo e($student->mobile); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php echo app('translator')->getFromJson('lang.category'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo e($student->category!=""?$student->category->category_name:""); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="offset-lg-2 col-lg-5 col-md-6">
                                <div class="single-meta mt-20">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php echo app('translator')->getFromJson('lang.class'); ?> <?php echo app('translator')->getFromJson('lang.section'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php if($student->className !="" && $student->section !=""): ?>
                                                <?php echo e($student->className->class_name .'('.$student->section->section_name.')'); ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php echo app('translator')->getFromJson('lang.admission'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo e($student->admission_no); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                <?php echo app('translator')->getFromJson('lang.roll'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                <?php echo e($student->roll_no); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>             
    </div>
</div>

<?php endif; ?>

    </div>
</section>

<?php if(isset($fees_assigneds)): ?>

<section class="mt-20">
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-lg-12">
                <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('lang.fees_group'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.fees_code'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.due_date'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.status'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.amount'); ?> (<?php echo e($currency); ?>)</th>
                            <th><?php echo app('translator')->getFromJson('lang.payment'); ?> <?php echo app('translator')->getFromJson('lang.id'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.mode'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.date'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.discount'); ?> (<?php echo e($currency); ?>)</th>
                            <th><?php echo app('translator')->getFromJson('lang.fine'); ?> (<?php echo e($currency); ?>)</th>
                            <th><?php echo app('translator')->getFromJson('lang.paid'); ?> (<?php echo e($currency); ?>)</th>
                            <th><?php echo app('translator')->getFromJson('lang.balance'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $grand_total = 0;
                            $total_fine = 0;
                            $total_discount = 0;
                            $total_paid = 0;
                            $total_grand_paid = 0;
                            $total_balance = 0;
                        ?>
                        <?php $__currentLoopData = $fees_assigneds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_assigned): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                if($fees_assigned->feesGroupMaster->fees_group_id != 1 && $fees_assigned->feesGroupMaster->fees_group_id != 2){
                                    $grand_total += $fees_assigned->feesGroupMaster->amount;
                                }else{
                                    if($fees_assigned->feesGroupMaster->fees_group_id == 1){
                                        $grand_total += $student->route->far;
                                    }else{
                                        $grand_total += $student->room->cost_per_bed;
                                    }
                                }
                                
                            ?>

                            <?php
                                $discount_amount = App\SmFeesAssign::discountSum($fees_assigned->student_id, $fees_assigned->feesGroupMaster->feesTypes->id, 'discount_amount');
                                $total_discount += $discount_amount;
                                $student_id = $fees_assigned->student_id;
                            ?>
                            <?php
                                $paid = App\SmFeesAssign::discountSum($fees_assigned->student_id, $fees_assigned->feesGroupMaster->feesTypes->id, 'amount');
                                $total_grand_paid += $paid;
                            ?>
                            <?php
                                $fine = App\SmFeesAssign::discountSum($fees_assigned->student_id, $fees_assigned->feesGroupMaster->feesTypes->id, 'fine');
                                $total_fine += $fine;
                            ?>
                             
                            <?php
                                $total_paid = $discount_amount + $paid;
                            ?>
                        <tr>
                            <td><?php echo e($fees_assigned->feesGroupMaster!=""?$fees_assigned->feesGroupMaster->feesGroups->name:""); ?></td>
                            <td><?php echo e($fees_assigned->feesGroupMaster!=""?$fees_assigned->feesGroupMaster->feesTypes->name:""); ?></td>
                            <td>
                                <?php if($fees_assigned->feesGroupMaster!=""): ?>
                                
     <?php echo e($fees_assigned->feesGroupMaster->date != ""? App\SmGeneralSettings::DateConvater($fees_assigned->feesGroupMaster->date):''); ?>


                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($fees_assigned->feesGroupMaster->fees_group_id != 1 && $fees_assigned->feesGroupMaster->fees_group_id != 2): ?>
                                    <?php if($fees_assigned->feesGroupMaster->amount == $total_paid): ?>
                                    <button class="primary-btn small bg-success text-white border-0"><?php echo app('translator')->getFromJson('lang.paid'); ?></button>
                                    <?php elseif($total_paid != 0): ?>
                                    <button class="primary-btn small bg-warning text-white border-0"><?php echo app('translator')->getFromJson('lang.partial'); ?></button>
                                    <?php elseif($total_paid == 0): ?>
                                    <button class="primary-btn small bg-danger text-white border-0"><?php echo app('translator')->getFromJson('lang.unpaid'); ?></button>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if($fees_assigned->feesGroupMaster->fees_group_id == 1): ?>
                                        <?php if($student->route->far == $total_paid): ?>
                                        <button class="primary-btn small bg-success text-white border-0"><?php echo app('translator')->getFromJson('lang.paid'); ?></button>
                                        <?php elseif($total_paid != 0): ?>
                                        <button class="primary-btn small bg-warning text-white border-0"><?php echo app('translator')->getFromJson('lang.partial'); ?></button>
                                        <?php elseif($total_paid == 0): ?>
                                        <button class="primary-btn small bg-danger text-white border-0"><?php echo app('translator')->getFromJson('lang.unpaid'); ?></button>
                                        <?php endif; ?>
                                    <?php elseif($fees_assigned->feesGroupMaster->fees_group_id == 2): ?>
                                        <?php if($student->room->cost_per_bed == $total_paid): ?>
                                        <button class="primary-btn small bg-success text-white border-0"><?php echo app('translator')->getFromJson('lang.paid'); ?></button>
                                        <?php elseif($total_paid != 0): ?>
                                        <button class="primary-btn small bg-warning text-white border-0"><?php echo app('translator')->getFromJson('lang.partial'); ?></button>
                                        <?php elseif($total_paid == 0): ?>
                                        <button class="primary-btn small bg-danger text-white border-0"><?php echo app('translator')->getFromJson('lang.unpaid'); ?></button>
                                        <?php endif; ?>
                                    <?php endif; ?>    
                                <?php endif; ?>    
                            </td>
                            <td>
                                <?php
                                    if($fees_assigned->feesGroupMaster->fees_group_id != 1 && $fees_assigned->feesGroupMaster->fees_group_id != 2){
                                        echo $fees_assigned->feesGroupMaster->amount;
                                    }else{
                                        if($fees_assigned->feesGroupMaster->fees_group_id == 1){
                                            echo $student->route->far;
                                        }else{
                                            echo $student->room->cost_per_bed;
                                        }
                                    }
                                    
                                ?>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td> <?php echo e($discount_amount); ?> </td>
                            <td><?php echo e($fine); ?></td>
                            <td><?php echo e($paid); ?></td>
                            <td>
                                <?php 

                                    if($fees_assigned->feesGroupMaster->fees_group_id != 1 && $fees_assigned->feesGroupMaster->fees_group_id != 2){
                                        $rest_amount = $fees_assigned->feesGroupMaster->amount - $total_paid;
                                    }else{
                                        if($fees_assigned->feesGroupMaster->fees_group_id == 1){
                                           $rest_amount = $student->route->far - $total_paid;
                                        }else{
                                           $rest_amount = $student->room->cost_per_bed - $total_paid;
                                        }
                                    }

                                    $total_balance +=  $rest_amount;
                                    echo $rest_amount;
                                ?>
                            </td>
                        </tr>
                            <?php 
                                $payments = App\SmFeesAssign::feesPayment($fees_assigned->feesGroupMaster->feesTypes->id, $fees_assigned->student_id);
                                $i = 0;
                            ?>

                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right"><img src="<?php echo e(asset('public/backEnd/img/table-arrow.png')); ?>"></td>
                                <td>
                                   
                                    <?php
                                        $created_by = App\User::find($payment->created_by);
                                    ?>
                                    <a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo e('Collected By: '.$created_by->full_name); ?>"><?php echo e($payment->fees_type_id.'/'.$payment->id); ?></a></td>
                                <td>
                                <?php if($payment->payment_mode == "C"): ?>
                                        <?php echo e('Cash'); ?>

                                <?php elseif($payment->payment_mode == "Cq"): ?>
                                    <?php echo e('Cheque'); ?>

                                <?php else: ?>
                                    <?php echo e('DD'); ?>

                                <?php endif; ?> 
                                </td>
                                <td>
                                    
<?php echo e($payment->payment_date != ""? App\SmGeneralSettings::DateConvater($payment->payment_date):''); ?>


                                </td>
                                <td><?php echo e($payment->discount_amount); ?></td>
                                <td><?php echo e($payment->fine); ?></td>
                                <td><?php echo e($payment->amount); ?></td>
                                <td></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $fees_discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_discount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>Discount</td>
                            <td><?php echo e($fees_discount->feesDiscount !=""?$fees_discount->feesDiscount->name:""); ?></td>
                            <td></td>
                            <td><?php if(in_array($fees_discount->id, $applied_discount)): ?>
                                <?php
                                    $createdBy = App\SmFeesAssign::createdBy($student_id, $fees_discount->id);
                                    $created_by = App\User::find($createdBy->created_by);

                                ?>
                                <a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo e('Collected By: '.$created_by->full_name); ?>">Discount of $<?php echo e($fees_discount->feesDiscount->amount); ?> Applied : <?php echo e($createdBy->id.'/'.$createdBy->created_by); ?></a>
                                
                                <?php else: ?>
                                <?php echo app('translator')->getFromJson('lang.discount_of'); ?> $<?php echo e($fees_discount->feesDiscount !=""?$fees_discount->feesDiscount->amount:""); ?> <?php echo app('translator')->getFromJson('lang.assigned'); ?>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($fees_discount->name); ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th><?php echo app('translator')->getFromJson('lang.grand_total'); ?> (<?php echo e($currency); ?>)</th>
                            <th></th>
                            <th><?php echo e($grand_total); ?></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><?php echo e($total_discount); ?></th>
                            <th><?php echo e($total_fine); ?></th>
                            <th><?php echo e($total_grand_paid); ?></th>
                            <th><?php echo e($total_balance); ?></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>