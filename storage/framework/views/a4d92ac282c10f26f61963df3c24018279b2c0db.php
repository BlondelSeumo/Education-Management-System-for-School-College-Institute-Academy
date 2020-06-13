<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tabulation Sheet </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<style>
    table.tabluationsheet {
        width: 100%;
    }

    .tabluationsheet th, .tabluationsheet td {
        border: 1px solid #ddd;
        font-size: 11px;
        padding: 5px;
    }



    .tabluationsheet td {
        text-align: center;
    }

    body {
        padding: 0;
        font-family: "Poppins", sans-serif;
        font-weight: 400;

        margin-top: 35px;
    }

    html {
        padding: 0px;
        margin: 0px;
        font-family: "Poppins", sans-serif;
        font-weight: 400;


    }

    .container-fluid {
        padding-bottom: 50px;
    }

    h1, h2, h3, h4 {

        font-family: "Poppins", sans-serif;
        font-weight: 400;
        margin-bottom: 15px;
    }

    .gradeChart tbody td{
        padding: 0;
        border-collapse: 1px solid #ddd;
    }
    table.gradeChart{
        padding: 0px;
        margin: 0px;
        width: 60%;
        text-align: right;
        font-size: 11px;
    }
    table.gradeChart thead th{
        border: 1px solid #000000;
        border-collapse: collapse;
        text-align: center !important;
        padding: 0px;
        margin: 0px;
    }
    table.gradeChart tbody td{
        border: 1px solid #000000;
        border-collapse: collapse;
        text-align: center !important;
        padding: 0px;
        margin: 0px;
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
    <table class="table" style="width: 100%;">
        <thead>
        <tr>

            <th class="" style="vertical-align: middle; text-align: right;">
                <img class="logo-img" src="<?php echo e(url('/')); ?>/<?php echo e($generalSetting->logo); ?>" alt="">
            </th>
            <th class="text-left">

                <h3 class="exam_title text-left text-capitalize"><?php echo e(isset($school_name)?$school_name:'Infix School Management ERP'); ?> </h3>
                <h4 class="exam_title text-left text-capitalize"><?php echo e(isset($address)?$address:'Infix School Adress'); ?> </h4>
                <h4 class="exam_title text-left text-uppercase"> tabulation sheet
                    of <?php echo e($tabulation_details['exam_term']); ?> in <?php echo e(date('Y')); ?></h4>
            </th>

        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <table>
                    <tr>
                        <td>


                            <?php if(@$tabulation_details['student_name']): ?>
                                <?php if(@$tabulation_details['student_name']): ?>
                                    <p class="student_name">
                                        <b><?php echo app('translator')->getFromJson('lang.student'); ?> <?php echo app('translator')->getFromJson('lang.name'); ?> </b> <?php echo e($tabulation_details['student_name']); ?>

                                    </p>
                                <?php endif; ?>
                                <?php if(@$tabulation_details['student_roll']): ?>
                                    <p class="student_name">
                                        <b><?php echo app('translator')->getFromJson('lang.student'); ?> <?php echo app('translator')->getFromJson('lang.roll'); ?> </b> <?php echo e($tabulation_details['student_roll']); ?>

                                    </p>
                                <?php endif; ?>
                                <?php if(@$tabulation_details['student_admission_no']): ?>
                                    <p class="student_name">
                                        <b><?php echo app('translator')->getFromJson('lang.student'); ?> <?php echo app('translator')->getFromJson('lang.admission'); ?> </b> <?php echo e($tabulation_details['student_admission_no']); ?>

                                    </p>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php $__currentLoopData = $tabulation_details['subject_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p class="subject-list"><?php echo e($d); ?></p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php endif; ?>
                        </td>
                        <td>

                            <?php if(@$tabulation_details['student_class']): ?>
                                <p class="student_name">
                                    <b><?php echo app('translator')->getFromJson('lang.class'); ?>  </b> <?php echo e($tabulation_details['student_class']); ?>

                                </p>
                            <?php endif; ?>
                            <?php if(@$tabulation_details['student_section']): ?>
                                <p class="student_name">
                                    <b><?php echo app('translator')->getFromJson('lang.section'); ?> </b> <?php echo e($tabulation_details['student_section']); ?>

                                </p>
                            <?php endif; ?>
                            <?php if(@$tabulation_details['student_admission_no']): ?>
                                <p class="student_name">
                                    <b> <?php echo app('translator')->getFromJson('lang.exam'); ?> </b> <?php echo e($tabulation_details['exam_term']); ?>

                                </p>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <?php if(@$tabulation_details): ?>
                    <table class="table gradeChart table-bordered">
                        <thead>
                        <tr>
                            <th>Staring</th>
                            <th>Ending</th>
                            <th>GPA</th>
                            <th>Grade</th>
                            <th>Evalution</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $__currentLoopData = $tabulation_details['grade_chart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($d['start']); ?></td>
                                <td><?php echo e($d['end']); ?></td>
                                <td><?php echo e($d['gpa']); ?></td>
                                <td><?php echo e($d['grade_name']); ?></td>
                                <td class="text-left"><?php echo e($d['description']); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php endif; ?>

            </td>
        </tr>
        </tbody>
    </table>


    <h3 style="width: 100%; text-align: center; border-bottom: 1px solid #ddd; padding: 10px;">Tabulation Sheet</h3>

    <table class="w-100 mt-30 mb-20 tabluationsheet">
        <thead>
        <tr>
            <th rowspan="2"><?php echo app('translator')->getFromJson('lang.sl'); ?></th>
            <th rowspan="2"><?php echo app('translator')->getFromJson('lang.student'); ?> <?php echo app('translator')->getFromJson('lang.name'); ?></th>
            <th rowspan="2"><?php echo app('translator')->getFromJson('lang.admission'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?></th>
            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $subject_ID     = $subject->subject_id;
                    $subject_Name   = $subject->subject->subject_name;
                    $mark_parts      = App\SmAssignSubject::getNumberOfPart($subject_ID, $class_id, $section_id, $exam_term_id);
                ?>
                <th colspan="<?php echo e(count($mark_parts)+2); ?>" class="text-center" > <?php echo e($subject_Name); ?></th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <th rowspan="2" class=" "><?php echo app('translator')->getFromJson('lang.total_mark'); ?></th>
            <th rowspan="2" class=" "><?php echo app('translator')->getFromJson('lang.gpa'); ?></th>
            <th rowspan="2" class="  text-center" nowrap><?php echo app('translator')->getFromJson('lang.gpa'); ?> <?php echo app('translator')->getFromJson('lang.grade'); ?></th>
        </tr>
        <tr>

            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $subject_ID     = $subject->subject_id;
                    $subject_Name   = $subject->subject->subject_name;
                    $mark_parts     = App\SmAssignSubject::getNumberOfPart($subject_ID, $class_id, $section_id, $exam_term_id);
                ?>

                <?php $__currentLoopData = $mark_parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sigle_part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th style="text-align: center;" class="total"><?php echo e($sigle_part->exam_title); ?> </th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <th><?php echo app('translator')->getFromJson('lang.total'); ?></th>
                <th><?php echo app('translator')->getFromJson('lang.gpa'); ?></th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        </thead>

        <tbody>
        <?php  $count=1;  ?>
        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $this_student_failed=0; $tota_grade_point= 0; $marks_by_students = 0; ?>
            <tr>
                <td><?php echo e($count++); ?></td>
                <td> <?php echo e($student->full_name); ?></td>
                <td> <?php echo e($student->admission_no); ?></td>

                <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php

                        $subject_ID     = $subject->subject_id;
                        $subject_Name   = $subject->subject->subject_name;
                        $mark_parts     = App\SmAssignSubject::getMarksOfPart($student->id, $subject_ID, $class_id, $section_id, $exam_term_id);
                    ?>
                    <?php $__currentLoopData = $mark_parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sigle_part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td class="total"><?php echo e($sigle_part->total_marks); ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <td class="total">
                        <?php
                            $tola_mark_by_subject = App\SmAssignSubject::getSumMark($student->id, $subject_ID, $class_id, $section_id, $exam_term_id);
                            $marks_by_students  = $marks_by_students + $tola_mark_by_subject;
                        ?>
                        <?php echo e($tola_mark_by_subject); ?>

                    </td>
                    <td>
                        <?php
                            $mark_grade = App\SmMarksGrade::where([['percent_from', '<=', $tola_mark_by_subject], ['percent_upto', '>=', $tola_mark_by_subject]])->first();
                            $tota_grade_point = $tota_grade_point + $mark_grade->gpa ;
                            if($mark_grade->gpa<1){
                                $this_student_failed =1;
                            }


                        ?>
                      <?php echo e($mark_grade->gpa); ?>

                    </td>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <td><?php echo e($marks_by_students); ?>

                    <?php $marks_by_students = 0; ?>
                </td>
                <td>
                    <?php if(isset($this_student_failed) && $this_student_failed==1): ?>
                        0.00
                    <?php else: ?>
                        <?php
                            if(!empty($tota_grade_point)){
                                $number = number_format($tota_grade_point/ count($subjects ), 2, '.', '');
                            }else{
                                $number = 0;
                            }
                        ?>
                        <?php echo e($number==0?'0.00':$number); ?> <?php $tota_grade_point= 0; ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if(isset($this_student_failed) && $this_student_failed==1): ?>
                        <span class="text-warning font-weight-bold">F</span>
                    <?php else: ?>
                        <?php
                            $mark_grade = App\SmMarksGrade::where([['from', '<=', $number], ['up', '>=', $number]])->first();
                        ?>
                        <?php echo e($mark_grade->grade_name); ?>

                    <?php endif; ?>


                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
