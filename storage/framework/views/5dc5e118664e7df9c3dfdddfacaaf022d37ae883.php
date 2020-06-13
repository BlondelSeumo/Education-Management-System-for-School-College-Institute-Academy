<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.progress_card_report'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.reports'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.progress_card_report'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area mb-40">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.select_criteria'); ?> </h3>
                    </div>
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
                 <?php if(session()->has('message-danger') != ""): ?>
                    <?php if(session()->has('message-danger')): ?>
                    <div class="alert alert-danger">
                        <?php echo e(session()->get('message-danger')); ?>

                    </div>
                    <?php endif; ?>
                <?php endif; ?>



                                 

                <div class="white-box">
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'progress_card_report', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

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
                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?> select_section" id="select_section" name="section">
                                    <option data-display="<?php echo app('translator')->getFromJson('lang.select_section'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_section'); ?> *</option>
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
</section>

<?php if(isset($is_result_available)): ?>
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
    <section class="student-details">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.progress_card_report'); ?></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="single-report-admit">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex">
                                                <div>
                                                    <img class="logo-img" src="<?php echo e($generalSetting->logo); ?>" alt="">
                                                </div>
                                                <div class="ml-30">
                                                    <h3 class="text-white"> <?php echo e(isset($school_name)?$school_name:'Infix School Management ERP'); ?> </h3>
                                                
                                                <p class="text-white mb-0"> <?php echo e(isset($address)?$address:'Infix School Address'); ?> </p>
                                                </div>
                                            </div>
                                            <div>
                                                
                                                <img class="report-admit-img" src="<?php echo e(asset($studentDetails->student_photo)); ?>" width="100" height="100" alt="">
                                            </div>
                                        </div>
                              
                                        <div class="card-body">
                                            <div>
                                                    
                                                    
                                                <h3><?php echo e($studentDetails->full_name); ?></h3>
                                                
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <p class="mb-0">
                                                            <?php echo app('translator')->getFromJson('lang.academic_year'); ?> : <span class="primary-color fw-500"><?php echo e($studentDetails->session); ?></span>
                                                        </p>
                                                        <p class="mb-0">
                                                                <?php echo app('translator')->getFromJson('lang.roll'); ?> : <span class="primary-color fw-500"><?php echo e($studentDetails->roll_no); ?></span>
                                                            </p>

                                                        
                                                        
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <p class="mb-0">
                                                            <?php echo app('translator')->getFromJson('lang.class'); ?> : <span class="primary-color fw-500"><?php echo e($studentDetails->class_name); ?></span>
                                                        </p>
                                                        <p class="mb-0">
                                                                <?php echo app('translator')->getFromJson('lang.admission'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?> : <span class="primary-color fw-500"><?php echo e($studentDetails->admission_no); ?></span>
                                                            </p>
                                                        

                                                        
                                                    </div>

                                                    <div class="col-lg-3">
                                                            <p class="mb-0">
                                                                    <?php echo app('translator')->getFromJson('lang.section'); ?> : <span class="primary-color fw-500"><?php echo e($studentDetails->section_name); ?></span>
                                                                </p>
                                                        <p class="mb-0">
                                                            <?php echo app('translator')->getFromJson('lang.position_in_class'); ?> : <span class="primary-color fw-500">1st</span>
                                                        </p>
                                                        
                                                    </div>
                                                </div>
                                            </div>


                                            <table class="w-100 mt-30 mb-20">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th rowspan="2"><?php echo app('translator')->getFromJson('lang.subjects'); ?></th>
                                                        <?php $__currentLoopData = $exam_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <th colspan="6" style="text-align: center;"><?php echo e($exam_type->title); ?></th>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </tr>
                                                <tr  style="text-align: center;">
                                                    <?php $__currentLoopData = $exam_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <th>Ex</th>
                                                        <th>AT</th>
                                                        <th>CT</th>
                                                        <th>AS</th>
                                                        <th>Total</th>
                                                        <th>Grade</th>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                    <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr style="text-align: center">
                                                        <td><?php echo e($data->subject !=""?$data->subject->subject_name:""); ?></td>
                                                        <?php
                                                            $TotalSum=[];
                                                        foreach($exam_types as $exam_type){
                                                            $mark_parts     =   App\SmAssignSubject::getNumberOfPart($data->subject_id, $class_id, $section_id, $exam_type->id);
                                                            $result         =   App\SmResultStore::GetResultBySubjectId($class_id, $section_id, $data->subject_id,$exam_type->id ,$student_id);
                                                            if(!empty($result)){
                                                                $final_results         =   App\SmResultStore::GetFinalResultBySubjectId($class_id, $section_id, $data->subject_id,$exam_type->id ,$student_id);

                                                            }

                                                            if($result->count()>0){
                                                                foreach($result as $r){
                                                                    if(!isset($TotalSum[$data->subject_id])){
                                                                        $TotalSum[$data->subject_id]=0;
                                                                    }
                                                                    $TotalSum[$data->subject_id] = $TotalSum[$data->subject_id] + $r->total_marks; ?>
                                                                    <td><?php echo e(!empty($r->total_marks)?$r->total_marks:'0'); ?></td>
                                                                <?php }?>
                                                                    <td><?php echo e(!empty($final_results)? $final_results->total_marks:0); ?></td>
                                                                    <td><?php echo e(!empty($final_results)? $final_results->total_gpa_grade:'-'); ?></td>
                                                        <?php
                                                                }else{ ?>
                                                                    <td>0</td>
                                                                    <td>0</td>
                                                                    <td>0</td>
                                                                    <td>0</td>
                                                                    <td>0</td>
                                                                    <td>-</td>
                                                                <?php

                                                                }
                                                                    }
                                                                ?>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                </tbody>
                                            </table>
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
<?php endif; ?>

            

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>