<!DOCTYPE html>
<html>
<head>
    <title>Fees Payment</title>
    <style>
    
        .school-table-style {
            padding: 10px 0px!important;
        }
        .school-table-style tr th {
            font-size: 8px!important;
            text-align: left!important;
        }
        .school-table-style tr td {
            font-size: 9px!important;
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
    <div class="text-center"> 
        <h4 class="text-center mt-1"><span>Fees Payment</span></h4>
    </div>
	<table class="school-table school-table-style" cellspacing="0" width="100%">
        <thead>
            <tr align="center">
                <th>Date</th>
                <th>Fees Group</th>
                <th>Fees Code</th>
                <th>Mode</th>
                <th>Amount (<?php echo e($currency); ?>)</th>
                <th>Discount (<?php echo e($currency); ?>)</th>
                <th>Fine (<?php echo e($currency); ?>)</th>
            </tr>
        </thead>

        <tbody>
            
            <tr align="center">
                <td>
                   
<?php echo e($payment->payment_date != ""? App\SmGeneralSettings::DateConvater($payment->payment_date):''); ?>


                </td>
                <td><?php echo e($group); ?></td>
                <td><?php echo e($payment->feesType->code); ?></td>
                <td>
                <?php if($payment->payment_mode == "C"): ?>
                        <?php echo e('Cash'); ?>

                <?php elseif($payment->payment_mode == "Cq"): ?>
                    <?php echo e('Cheque'); ?>

                <?php else: ?>
                    <?php echo e('DD'); ?>

                <?php endif; ?> 
                </td>
                <td><?php echo e($payment->amount); ?></td>
                <td><?php echo e($payment->discount_amount); ?></td>
                <td><?php echo e($payment->fine); ?></td>
                <td></td>
            </tr>
            
        </tbody>
    </table>
</body>
</html>
