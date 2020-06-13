<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.merit_list_report'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.reports'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.merit_list_report'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
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
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'merit_list_report', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                        <div class="row">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            <div class="col-lg-4 mt-30-md">
                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('exam') ? ' is-invalid' : ''); ?>" name="exam">
                                    <option data-display="<?php echo app('translator')->getFromJson('lang.select_exam'); ?>*" value=""><?php echo app('translator')->getFromJson('lang.select_exam'); ?> *</option>
                                    <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($exam->id); ?>" <?php echo e(isset($exam_id)? ($exam_id == $exam->id? 'selected':''):''); ?>><?php echo e($exam->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('exam')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('exam')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
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
                                    <option data-display="<?php echo app('translator')->getFromJson('lang.select_section'); ?>*" value=""><?php echo app('translator')->getFromJson('lang.select_section'); ?> *</option>
                                </select>
                                <?php if($errors->has('section')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('section')); ?></strong>
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
</section>


<?php if(isset($allresult_data)): ?>
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
                    <h3 class="mb-30 mt-30"><?php echo app('translator')->getFromJson('lang.merit_list_report'); ?></h3>
                </div>
            </div>
        </div>

        <div class="row">


            <div class="col-lg-12">
                <div class="white-box">

                        <div class="print_button pull-right">
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'merit-list/print', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                              <input type="hidden" name="InputClassId" value="<?php echo e($InputClassId); ?>">
                              <input type="hidden" name="InputExamId" value="<?php echo e($InputExamId); ?>">
                              <input type="hidden" name="InputSectionId" value="<?php echo e($InputSectionId); ?>">
                              <button type="submit" class="primary-btn small fix-gr-bg">  <i class="ti-printer"> </i> Print </button> 
                            </form> 
                        </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-11">
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
                                    </div>


                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h3><?php echo app('translator')->getFromJson('lang.order_of_merit_list'); ?></h3>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <p class="mb-0">
                                                                <?php echo app('translator')->getFromJson('lang.academic_year'); ?> : <span class="primary-color fw-500"><?php echo e($generalSetting->session_year); ?></span>
                                                            </p>
                                                            <p class="mb-0">
                                                                <?php echo app('translator')->getFromJson('lang.exam'); ?> : <span class="primary-color fw-500"><?php echo e($exam_name); ?></span>
                                                            </p>
                                                            <p class="mb-0">
                                                                <?php echo app('translator')->getFromJson('lang.class'); ?> : <span class="primary-color fw-500"><?php echo e($class_name); ?></span>
                                                            </p>
                                                            <p class="mb-0">
                                                                <?php echo app('translator')->getFromJson('lang.section'); ?> : <span class="primary-color fw-500"><?php echo e($section->section_name); ?></span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <h3><?php echo app('translator')->getFromJson('lang.subjects'); ?></h3>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <?php $__currentLoopData = $assign_subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <p class="mb-0">
                                                                <span class="primary-color fw-500"><?php echo e($subject->subject->subject_name); ?></span>
                                                            </p>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <table class="w-100 mt-30 mb-20">
                                            <thead>
                                                <tr>
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
                                                    <td><?php echo e($row->student_name); ?></td>

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
                                                    <td> 
                                                        <button class="primary-btn small <?php if($row->result=="F"): ?> bg-danger <?php else: ?> bg-success <?php endif; ?> text-white border-0"><?php echo e($row->result); ?></button>
                                                    </td>
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