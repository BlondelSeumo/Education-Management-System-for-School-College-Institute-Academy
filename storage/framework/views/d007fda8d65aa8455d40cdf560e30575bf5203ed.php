<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.exam'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.examinations'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.exam'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($exam)): ?>
        <?php if(in_array(215, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(url('exam')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->getFromJson('lang.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>

    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'exam/'.$exam->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

 

        <div class="row">
           
            <div class="col-lg-12">
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">
                                    <?php echo app('translator')->getFromJson('lang.edit'); ?>
                                
                                <?php echo app('translator')->getFromJson('lang.exam'); ?>
                            </h3>
                        </div>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php if(Session()->has('message-success')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(Session()->get('message-success')); ?>

                                        </div>
                                        <?php elseif(Session()->has('message-danger')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e(Session()->get('message-danger')); ?>

                                        </div>
                                        <?php endif; ?>
                                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                        
                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                    <input type="hidden" name="id" id="id" value="<?php echo e($exam->id); ?>">
                                    
                                    <div class="col-lg-6 mt-30-md">
                                        <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class" disabled="">
                                            <option data-display="<?php echo app('translator')->getFromJson('lang.select_class'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_class'); ?> *</option>
                                            <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($class->id); ?>"  <?php echo e($class->id == $exam->class_id?'selected':''); ?>><?php echo e($class->class_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('class')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('class')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-lg-6 mt-30-md">
                                        <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="section"  disabled="">
                                            <option data-display="<?php echo app('translator')->getFromJson('lang.select_section'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_section'); ?> *</option>
                                            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($section->section_id); ?>" <?php echo e($section->section_id == $exam->section_id?'selected':''); ?>><?php echo e($section->sectionName->section_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('class')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('class')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <div class="col-lg-6 mt-30-md">
                                        <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="section" disabled="">
                                            <option data-display="<?php echo app('translator')->getFromJson('lang.select_subjects'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_subjects'); ?> *</option>
                                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($subject->subject_id); ?>" <?php echo e($subject->subject_id == $exam->subject_id?'selected':''); ?>><?php echo e($subject->subject->subject_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('class')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('class')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-lg-6 mt-30-md">
                                        <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="section" disabled="">
                                            <option data-display="<?php echo app('translator')->getFromJson('lang.select'); ?> <?php echo app('translator')->getFromJson('lang.exam_type'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select'); ?> <?php echo app('translator')->getFromJson('lang.exam_type'); ?> *</option>
                                            <?php $__currentLoopData = $exams_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exams_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($exams_type->id); ?>" <?php echo e($exams_type->id == $exam->exam_type_id?'selected':''); ?>><?php echo e($exams_type->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('class')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('class')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div class="row mt-25">
                                    <div class="col-lg-6">

                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('exam_marks') ? ' is-invalid' : ''); ?>"
                                            type="number" name="exam_marks" id="exam_mark_main" autocomplete="off" value="<?php echo e(isset($exam)? $exam->exam_mark: 0); ?>" required="" min="0">
                                            <label><?php echo app('translator')->getFromJson('lang.exam_mark'); ?> *</label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('exam_marks')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('exam_marks')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

  
                            </div>
                            <div class="row mt-40">
                                 <div class="col-lg-10">
                                    <div class="main-title">
                                        <h5><?php echo app('translator')->getFromJson('lang.add_mark_distributions'); ?> </h5>
                                    </div>
                                </div>
                                <div class="col-lg-2 text-right">
                                    <button type="button" class="primary-btn icon-only fix-gr-bg" onclick="addRowMark();" id="addRowBtn">
                                    <span class="ti-plus pr-2"></span></button>
                                </div>
                            </div>


                            <table class="table" id="productTable">
                                <thead>
                                    <tr>
                                      <th><?php echo app('translator')->getFromJson('lang.exam_title'); ?></th>
                                      <th><?php echo app('translator')->getFromJson('lang.exam_mark'); ?></th>
                                      <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; $totalMark = 0; ?>
                                <?php $__currentLoopData = $exam->GetExamSetup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $i++; $totalMark += $row->exam_mark; ?>
                                  <tr id="row1" class="mt-40">
                                    <td class="border-top-0">
                                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">  
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('exam_title') ? ' is-invalid' : ''); ?>"
                                                type="text" id="exam_title" name="exam_title[]" autocomplete="off" value="<?php echo e($row->exam_title); ?>">
                                                <label><?php echo app('translator')->getFromJson('lang.title'); ?></label>
                                        </div>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('exam_mark') ? ' is-invalid' : ''); ?> exam_mark"
                                            type="number" id="exam_mark" name="exam_mark[]" autocomplete="off"   value="<?php echo e($row->exam_mark); ?>">
                                        </div>
                                    </td> 
                                    <td  class="border-top">
                                         <button class="primary-btn icon-only fix-gr-bg" type="button" id="<?php echo e($i != 1? 'removeMark':''); ?>">
                                             <span class="ti-trash"></span>
                                        </button>
                                       
                                    </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <tfoot>
                                        <tr>
                                           <td class="border-top-0"><?php echo app('translator')->getFromJson('lang.total'); ?></td>

                                           <td class="border-top-0" id="totalMark">
                                             <input type="text" class="primary-input form-control" name="totalMark" readonly="true" value="<?php echo e($totalMark); ?>">
                                           </td>
                                           <td class="border-top-0"></td>
                                       </tr>
                                   </tfoot>
                               </tbody>
                            </table>                              
                            <div class="row mt-40">
                                <div class="col-lg-12 text-center">
                                    <button class="primary-btn fix-gr-bg">
                                        <span class="ti-check"></span>
                                        
                                            <?php echo app('translator')->getFromJson('lang.update'); ?>
                                        
                                        <?php echo app('translator')->getFromJson('lang.mark_distribution'); ?>

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo e(Form::close()); ?>


</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>