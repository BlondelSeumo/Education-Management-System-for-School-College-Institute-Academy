<!DOCTYPE html>
<html lang="en">
<head>
  <title>Merit List </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<style>
   .marklist th, .marklist td{
        border: 1px solid black;
        padding:2px;
        font-size: 11px;
    }
    .marklist th{
        text-transform: capitalize;
        text-align: center; 
    }
    .marklist td{
        text-align: center;
    }
    body{
        padding: 0;
        font-family: "Poppins", sans-serif;
        font-weight: 400;

        margin-top: 35px; 
    }
    html{
        padding: 0px;
        margin: 0px;  
        font-family: "Poppins", sans-serif;
        font-weight: 400;


    }
    .container-fluid{ 
        padding-bottom: 50px;
    }
    h1,h2,h3,h4{

        font-family: "Poppins", sans-serif;
        font-weight: 400;
        margin-bottom: 15px;
    }
</style>
<body>
 

<?php 
    $generalSetting= App\SmGeneralSettings::find(1); 
    if(!empty($generalSetting)){
        $school_name =$generalSetting->school_name;
        $site_title =$generalSetting->site_title;
        $school_code =$generalSetting->school_code;
        $address =$generalSetting->address;
        $phone =$generalSetting->phone; 
    } 
?>
<div class="container-fluid"> 
    <table class="table">
        <thead>
            <tr >
                
                <th>
                    <img class="logo-img" src="<?php echo e(url('/')); ?>/<?php echo e($generalSetting->logo); ?>" alt=""> 
                </th>
                <th> 
                    <h3 class="text-white"> <?php echo e(isset($school_name)?$school_name:'Infix School Management ERP'); ?> </h3> 
                    <p class="text-white mb-0"> <?php echo e(isset($address)?$address:'Infix School Address'); ?> </p>
                </th>

            </tr>
        </thead> 
        <tbody>
            <tr>
                <td>
                    
                    <p class="mb-0"> <?php echo app('translator')->getFromJson('lang.academic_year'); ?> : <span class="primary-color fw-500"><?php echo e($generalSetting->session_year); ?></span> </p>
                    <p class="mb-0"> <?php echo app('translator')->getFromJson('lang.exam'); ?> : <span class="primary-color fw-500"><?php echo e($exam_name); ?></span> </p>
                    <p class="mb-0"> <?php echo app('translator')->getFromJson('lang.class'); ?> : <span class="primary-color fw-500"><?php echo e($class_name); ?></span> </p>
                    <p class="mb-0"> <?php echo app('translator')->getFromJson('lang.section'); ?> : <span class="primary-color fw-500"><?php echo e($section->section_name); ?></span> </p>
                </td>
                <td> 
                    <p style="font-weight: 500;"><?php echo app('translator')->getFromJson('lang.subjects'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></p> 
                    <div class="row">
                        <div class="col-md-12 w-100" style="columns: 2">
                            <?php $__currentLoopData = $assign_subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p class="mb-0"> <span class="primary-color fw-500"><?php echo e($subject->subject->subject_name); ?></span> </p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <h3 style="width: 100%; text-align: center; border-bottom: 1px solid black; padding: 10px;">Merit List</h3>
 

                                        <table class="marklist" style="width: 100%">
                                            <thead>
                                                <tr style="border-bottom: 1px solid black !important">
                                                    <th>Merit <?php echo app('translator')->getFromJson('lang.position'); ?></th>
                                                    <th><?php echo app('translator')->getFromJson('lang.admission'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?></th>
                                                    <th><?php echo app('translator')->getFromJson('lang.student'); ?></th>
                                                    <?php $__currentLoopData = $subjectlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <th><?php echo e($subject); ?></th>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <th><?php echo app('translator')->getFromJson('lang.total_mark'); ?></th>
                                                    <th><?php echo app('translator')->getFromJson('lang.average'); ?></th>
                                                    <th><?php echo app('translator')->getFromJson('lang.gpa'); ?></th>
                                                    <th><?php echo app('translator')->getFromJson('lang.result'); ?></th>
                                                </tr>
                                            </thead>

                                            <tbody>


                                                <?php $i=1; $subject_mark = []; $total_student_mark = 0; ?>
                                                <?php $__currentLoopData = $allresult_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                <tr>
                                                    <td><?php echo e($row->merit_order); ?></td>
                                                    <td><?php echo e($row->admission_no); ?></td>
                                                    <td style="text-align: left;"><?php echo e($row->student_name); ?></td>

                                                    <?php $markslist = explode(',',$row->marks_string);?>  
                                                    <?php if(!empty($markslist)): ?>
                                                        <?php $__currentLoopData = $markslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php 
                                                                $subject_mark[]= $mark;
                                                                $total_student_mark = $total_student_mark + $mark; 
                                                            ?> 
                                                            <td>  <?php echo e(!empty($mark)?$mark:0); ?></td> 
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                     
                                                    <?php endif; ?>



                                                    <td><?php echo e($total_student_mark); ?> </td>
                                                    <td><?php echo e(!empty($row->average_mark)?$row->average_mark:0); ?> <?php $total_student_mark=0; ?> </td> 
                                                    <td>
                                                        <?php 
                                                            $total_grade_point = 0;
                                                            $number_of_subject = count($subject_mark); 
                                                            foreach ($subject_mark as $mark) {
                                                                $grade_gpa = DB::table('sm_marks_grades')->where('percent_from','<=',$mark)->where('percent_upto','>=',$mark)->first();
                                                                $total_grade_point = $total_grade_point + $grade_gpa->gpa;
                                                            }
                                                            if($total_grade_point==0){
                                                                echo '0.00';
                                                            }else{
                                                                if($number_of_subject  == 0){
                                                                    echo '0.00';
                                                                }else{
                                                                    echo number_format((float)$total_grade_point/$number_of_subject, 2, '.', '');
                                                                } 
                                                            }

                                                        ?>
                                                        

                                                    </td> 
                                                    <td>  <?php echo e($row->result); ?> </td>
                                                </tr> 

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

                                            </tbody>
                                        </table> 
 

</body>
</html>
    
