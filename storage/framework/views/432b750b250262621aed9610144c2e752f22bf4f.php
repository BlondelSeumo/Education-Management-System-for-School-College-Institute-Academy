<!DOCTYPE html>
<html>
<head>
    <title>Student ID Card</title>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/style.css" />
    <style media="print">
		body.admin {
			background: #fff;
            margin: 100px;
		}


        td{
            border-right: 1px solid #ddd; 
            border-left: 1px solid #ddd;
            border-bottom: 1px solid #ddd; 
            padding-top: 3px; padding-bottom: 3px;
        }
        table tr td{
            border: 1px solid #ddd !important; 

        }
		
    </style>
</head>
<body>
	
			<?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <table style="height: 800px">
                    <tr>
 
    			     <table cellpadding="0" cellspacing="0" border="0" width="280" height="321" align="center" style="margin-top: 55px;">
                        <tr style="border-right: 1px solid #ddd; border-left: 1px solid #ddd;  height: 100px; ">
                            <td colspan="3" style=" position: relative; text-align: center; background-color: #c738d8; border:1px solid #c738d8">
                               <!--  <center>
                                    <img src="<?php echo e(asset('public/backEnd/img/student/id-card-bg.png')); ?>" style="width: 100%; height: auto; padding: 0px; margin: 0px" >
                                </center> -->
                                <h3 style="padding: 5px; text-align: center; margin-bottom: 20px;  color: #fff; font-family: 'PT Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; ">View Student ID Card</h3>
                            </td>
                        </tr>
                        <tr >
                            <td colspan="3" style="text-align: center;   border-right: 1px solid #ddd; border-left: 1px solid #ddd;">
                                <img src="<?php echo e(asset('public/backEnd/img/student/id-card-img.jpg')); ?>" alt="" style="width: 50%; margin-top: 5px;">
                            </td>
                        </tr>
                        <?php if($id_card->student_name == 1): ?>
                        <tr >
                            <td colspan="2" style="padding-left: 20px; border-left: 1px solid #ddd">Name</td>
                            
                            <td style="text-align: right; margin-right: 40px !important; border-right: 1px solid #ddd"><?php echo e($student->full_name); ?></td>
                        </tr >
                        <?php endif; ?>
                        <?php if($id_card->admission_no == 1): ?>
                        <tr >
                            <td colspan="2" style="padding-left: 20px; border-left: 1px solid #ddd">Admission No.</td>
                            
                            <td style="text-align: right; margin-right: 40px !important; border-right: 1px solid #ddd"><?php echo e($student->admission_no); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if($id_card->class == 1): ?>
                        <tr >
                            <td colspan="2" style="padding-left: 20px; border-left: 1px solid #ddd;">Class</td>
                            
                            <td style="text-align: right; margin-right: 40px !important; border-right: 1px solid #ddd"><?php echo e($student->className!=""?$student->className->class_name:""); ?> (<?php echo e($student->section!=""?$student->section->section_name:""); ?>)</td>
                        </tr>
                        <?php endif; ?>
                        <?php if($id_card->father_name == 1): ?>
                        <tr >
                            <td colspan="2" style="padding-left: 20px; border-left: 1px solid #ddd">Father's Name</td>
                            
                            <td style="text-align: right; margin-right: 40px !important; border-right: 1px solid #ddd"><?php echo e($student->parents !=""?$student->parents->fathers_name:""); ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php if($id_card->mother_name == 1): ?>
                        <tr >
                            <td colspan="2" style="padding-left: 20px; border-left: 1px solid #ddd">Mother's Name</td>
                            
                            <td style="text-align: right; margin-right: 40px !important; border-right: 1px solid #ddd"><?php echo e($student->parents !=""?$student->parents->mothers_name:""); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if($id_card->blood == 1): ?>
                        <tr >
                            <td colspan="2" style="padding-left: 20px; border-left: 1px solid #ddd">Blood Group</td>
                           
                            <td style=" border-right: 1px solid #ddd; text-align: right; margin-right: 40px !important;"><?php echo e($student->bloodGroup!=""?$student->bloodGroup->base_setup_name:""); ?></td>
                        </tr >
                        <?php endif; ?>
                        <?php if($id_card->phone == 1): ?>
                        <tr >
                            <td colspan="2" style="padding-left: 20px; border-left: 1px solid #ddd">Phone</td>
                           
                            <td style=" border-right: 1px solid #ddd; text-align: right; margin-right: 40px !important;"><?php echo e($student->mobile); ?></td>
                        </tr >
                        <?php endif; ?>
                        <?php if($id_card->dob == 1): ?>
                        <tr >
                            <td colspan="2" style="padding-left: 20px; border-left: 1px solid #ddd">Date of birth</td>
                            
                            <td style=" border-right: 1px solid #ddd; text-align: right; margin-right: 40px !important;">
                              
                                <?php echo e($student->birth_of_birth != ""? App\SmGeneralSettings::DateConvater($student->birth_of_birth):''); ?>


                            </td>
                        </tr>
                        <?php endif; ?>

                        <tr >
                            <td colspan="2" style="padding-left: 20px; border-left: 1px solid #ddd"><?php echo e($id_card->designation); ?></td>
                            <td style=" border-right: 1px solid #ddd; text-align: right; padding-right: 20px;"><img src="<?php echo e(asset($id_card->signature)); ?>" width="40%" style="margin-right: 20px !important;"></td>
                        </tr>
                        <tr >
                            <td colspan="3" style="text-align: center; padding-top: 20px; border-bottom: 1px solid #ddd; border-right: 1px solid #ddd; border-left: 1px solid #ddd;">
                                <img src="<?php echo e(asset($id_card->logo)); ?>" width="50%" 
                                ><p><?php echo e($id_card->address); ?> </p></td>
                        </tr>


                     </table> 


                 </tr>
             </table>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		
	<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery-3.2.1.min.js"></script>
</body>
</html>
<!-- <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<h6><?php echo e($student->full_name); ?></h6>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php

	echo '<pre>';
		print_r($id_card);

?> -->
