<!DOCTYPE html>
<html>
<head>
    <title>Fees Group details</title>
    <style>
       
        .school-table-style {
            padding: 10px 0px!important;
        }
        .school-table-style tr th {
            font-size: 7px!important;
            text-align: left!important;
        }
        .school-table-style tr td {
            font-size: 8px!important;
            text-align: left!important;
            padding: 10px 0px!important;
        }
        .logo-image {
            width: 10%;
        }
    </style>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/style.css" />
</head>
<body>
<?php  $setting = App\SmGeneralSettings::find(1);  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   ?> 
   
 
    <table style="width: 100%;">
        <tr>
             
            <td style="width: 30%"> 
                <img src="<?php echo e(url($setting->logo)); ?>" alt="<?php echo e(url($setting->logo)); ?>"> 
            </td> 
            <td  style="width: 70%">  
                <h3><?php echo e($setting->school_name); ?></h3>
                <h4><?php echo e($setting->address); ?></h4>
            </td> 
        </tr> 
    </table>
    <hr>
    <table class="school-table school-table-style" cellspacing="0" width="100%">
        <tr>
            <td>Student Name</td>
            <td><?php echo e($student->full_name); ?></td>
            <td>Roll Number</td>
            <td><?php echo e($student->roll_no); ?></td>
        </tr>
        <tr>
            <td> Father's Name</td>
            <td><?php echo e($student->parents->fathers_name); ?></td>
            <td>Class</td>
            <td><?php echo e($student->className->class_name); ?></td>
        </tr>
        <tr>
            <td> Section</td>
            <td><?php echo e($student->section->section_name); ?></td>
            <td>Admission Number</td>
            <td><?php echo e($student->admission_no); ?></td>
        </tr>
    </table>
        <h4 class="text-center mt-1"><span>Fees Details</span></h4>
    
	<table class="school-table school-table-style" cellspacing="0" width="100%">
        <thead>
            <tr align="center">
                <th>Fees Group</th>
                <th>Fees Code</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Amount (<?php echo e($currency); ?>)</th>
                <th>Payment ID</th>
                <th>Mode</th>
                <th>Date</th>
                <th>Discount (<?php echo e($currency); ?>)</th>
                <th>Fine (<?php echo e($currency); ?>)</th>
                <th>Paid (<?php echo e($currency); ?>)</th>
                <th>Balance</th>
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
            <tr align="center">
                <td><?php echo e($fees_assigned->feesGroupMaster !=""?$fees_assigned->feesGroupMaster->feesGroups->name:""); ?></td>
                <td><?php echo e($fees_assigned->feesGroupMaster !=""?$fees_assigned->feesGroupMaster->feesTypes->name:""); ?></td>
                <td>
                    <?php if($fees_assigned->feesGroupMaster !=""): ?>
                        
                        <?php echo e($fees_assigned->feesGroupMaster->date != ""? App\SmGeneralSettings::DateConvater($fees_assigned->feesGroupMaster->date):''); ?>


                    <?php endif; ?>
                </td>
                <td>
                    <?php if($fees_assigned->feesGroupMaster->fees_group_id != 1 && $fees_assigned->feesGroupMaster->fees_group_id != 2): ?>
                        <?php if($fees_assigned->feesGroupMaster->amount == $total_paid): ?>
                        <span class="text-success">Paid</span>
                        <?php elseif($total_paid != 0): ?>
                        <span class="text-warning">Partial</span>
                        <?php elseif($total_paid == 0): ?>
                        <span class="text-danger">Unpaid</span>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if($fees_assigned->feesGroupMaster->fees_group_id == 1): ?>
                            <?php if($student->route->far == $total_paid): ?>
                            <span class="text-success">Paid</span>
                            <?php elseif($total_paid != 0): ?>
                            <span class="text-warning">Partial</span>
                            <?php elseif($total_paid == 0): ?>
                            <span class="text-danger">Unpaid</span>
                            <?php endif; ?>
                        <?php elseif($fees_assigned->feesGroupMaster->fees_group_id == 2): ?>
                            <?php if($student->room->cost_per_bed == $total_paid): ?>
                            <span class="text-success">Paid</span>
                            <?php elseif($total_paid != 0): ?>
                            <span class="text-warning">Partial</span>
                            <?php elseif($total_paid == 0): ?>
                            <span class="text-danger">Unpaid</span>
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
                <tr align="center">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right"><img src="<?php echo e(asset('public/backEnd/img/table-arrow.png')); ?>"></td>
                    <td><?php echo e($payment->fees_type_id.'/'.$payment->id); ?></td>
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
            
        </tbody>
    </table>

</body>
</html>
