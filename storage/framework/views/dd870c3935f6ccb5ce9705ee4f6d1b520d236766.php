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

    <?php if(isset($exam)): ?>
    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'exam/'.$exam->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

    <?php else: ?>
     <?php if(in_array(215, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'exam',
    'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

    <?php endif; ?>
    <?php endif; ?>

        <div class="row">
           
            <div class="col-lg-3">
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php if(isset($exam)): ?>
                                    <?php echo app('translator')->getFromJson('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->getFromJson('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->getFromJson('lang.exam'); ?>
                            </h3>
                        </div>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12" id="error-message">

                                    </div>
                                </div>

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
                                    <div class="col-lg-12">
                                        <label><?php echo app('translator')->getFromJson('lang.select'); ?> <?php echo app('translator')->getFromJson('lang.exam_type'); ?> *</label>
                                
                                        <?php $__currentLoopData = $exams_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exams_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="input-effect">
                                                <input type="checkbox" id="exams_types_<?php echo e($exams_type->id); ?>" class="common-checkbox exam-checkbox" name="exams_types[]" value="<?php echo e($exams_type->id); ?>" <?php echo e(isset($selected_exam_type_id)? ($exams_type->id == $selected_exam_type_id? 'checked':''):''); ?>>
                                                <label for="exams_types_<?php echo e($exams_type->id); ?>"><?php echo e($exams_type->title); ?></label>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="input-effect">
                                        <input type="checkbox" id="all_exams" class="common-checkbox" name="all_exams[]" value="0" <?php echo e((is_array(old('class_ids')) and in_array($class->id, old('class_ids'))) ? ' checked' : ''); ?>>
                                        <label for="all_exams">All Select</label>
                                    </div>

                                      
                                    </div>
                                    <div class="col-lg-12">

                                        <?php if($errors->has('exams_types')): ?>
                                            <span class="text-danger validate-textarea-checkbox" role="alert">
                                                <strong><?php echo e($errors->first('exams_types')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div> 



                                <div class="row mt-25">

                                    <div class="col-lg-12">

                                        <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class_ids') ? ' is-invalid' : ''); ?>" id="exam_class" name="class_ids">
                                            <option data-display="<?php echo app('translator')->getFromJson('lang.select_class'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_class'); ?> *</option>
                                            <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($class->id); ?>"><?php echo e($class->class_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('class_ids')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('class_ids')); ?></strong>
                                        </span>
                                        <?php endif; ?>

                                </div>
                            </div>




                               


                                <div class="row mt-25" id="exam_subejct">
                                    
                                </div>




                                
                                


                                <div class="row mt-25">
                                    <div class="col-lg-12">

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
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="white-box mt-10">
                            <div class="row">
                                 <div class="col-lg-10">
                                    <div class="main-title">
                                        <h5><?php echo app('translator')->getFromJson('lang.add_mark_distributions'); ?> </h5>
                                    </div>
                                </div>
                                <div class="col-lg-2">
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
                                  <tr id="row1" class="mt-40">
                                    <td class="border-top-0">
                                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">  
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('exam_title') ? ' is-invalid' : ''); ?>"
                                                type="text" id="exam_title" name="exam_title[]" autocomplete="off" value="<?php echo e(isset($editData)? $editData->exam_title : ''); ?>">
                                                <label><?php echo app('translator')->getFromJson('lang.title'); ?></label>
                                        </div>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('exam_mark') ? ' is-invalid' : ''); ?> exam_mark"
                                            type="number" id="exam_mark" name="exam_mark[]" autocomplete="off"   value="<?php echo e(isset($editData)? $editData->exam_mark : 0); ?>">
                                        </div>
                                    </td> 
                                    <td class="border-top">
                                         <button class="primary-btn icon-only fix-gr-bg" type="button">
                                             <span class="ti-trash"></span>
                                        </button>
                                       
                                    </td>
                                    </tr>
                                    <tfoot>
                                        <tr>
                                           <td class="border-top-0"><?php echo app('translator')->getFromJson('lang.total'); ?></td>

                                           <td class="border-top-0" id="totalMark">
                                             <input type="text" class="primary-input form-control" name="totalMark" readonly="true">
                                           </td>
                                           <td class="border-top-0"></td>
                                       </tr>
                                   </tfoot>
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                	  <?php 
                                  $tooltip = "";
                                  if(in_array(215, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                <div class="row mt-40">
                    <div class="col-lg-12">
                        <div class="white-box">                               
                            <div class="row mt-40">
                                <div class="col-lg-12 text-center">
                                  <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                        <span class="ti-check"></span>
                                        <?php if(isset($exam)): ?>
                                            <?php echo app('translator')->getFromJson('lang.update'); ?>
                                        <?php else: ?>
                                            <?php echo app('translator')->getFromJson('lang.save'); ?>
                                        <?php endif; ?>
                                        <?php echo app('translator')->getFromJson('lang.mark_distribution'); ?>

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php echo e(Form::close()); ?>


            <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.exam'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                    <thead>
                                <?php if(session()->has('message-success-delete') != "" ||
                                session()->get('message-danger-delete') != ""): ?>
                                <tr>
                                    <td colspan="7">
                                        <?php if(session()->has('message-success-delete')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session()->get('message-success-delete')); ?>

                                        </div>
                                        <?php elseif(session()->has('message-danger-delete')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e(session()->get('message-danger-delete')); ?>

                                        </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <th><?php echo app('translator')->getFromJson('lang.sl'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.exam_title'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.class'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.section'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.subject'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.total_mark'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.mark_distribution'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                                </tr>
                    </thead>

                    <tbody>
                    <?php $count =1 ; ?>
                                <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($count++); ?></td>

                                    <td><?php echo e($exam->GetExamTitle !=""?$exam->GetExamTitle->title:""); ?></td>
                                    <td><?php echo e($exam->getClassName !=""?$exam->getClassName->class_name:""); ?></td>
                                    <td><?php echo e($exam->GetSectionName !=""?$exam->GetSectionName->section_name:""); ?></td>
                                    <td><?php echo e($exam->GetSubjectName !=""?$exam->GetSubjectName->subject_name:""); ?></td>
                                    <td><?php echo e($exam->exam_mark); ?></td>

                                   <td>
                                        <?php $mark_distributions = App\SmExam::getMarkDistributions($exam->exam_type_id, $exam->class_id,  $exam->section_id, $exam->subject_id);  ?>                                  
                                      


                                        <?php $__currentLoopData = $exam->GetExamSetup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row">
                                           <div class="col-sm-6"> <?php echo e($row->exam_title); ?> </div> <div class="col-sm-4"><b> <?php echo e($row->exam_mark); ?> </b></div> 
                                       </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->getFromJson('lang.select'); ?>
                                            </button>


                                            <?php 

                                                $registered = App\SmExam::getMarkREgistered($exam->exam_type_id, $exam->class_id, $exam->section_id, $exam->subject_id);
                                                    

                                            ?>
                                                <?php if($registered == ""): ?>


                                            <div class="dropdown-menu dropdown-menu-right">

                                                

                                                <?php if(in_array(397, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

                                                    <a class="dropdown-item"
                                                        href="<?php echo e(url('exam', $exam->id)); ?>"><?php echo app('translator')->getFromJson('lang.edit'); ?></a>
                                                 <?php endif; ?>

                                                <?php if(in_array(216, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

                                                    <a class="dropdown-item" data-toggle="modal" data-target="#deleteExamModal<?php echo e($exam->id); ?>"
                                                        href="#"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
                                                 <?php endif; ?>
                                                 

                                            </div>
                                            <?php endif; ?>
                                        </div> 


                                    </td>
                                </tr>
                                    <div class="modal fade admin-query" id="deleteExamModal<?php echo e($exam->id); ?>" >
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.delete'); ?> <?php echo app('translator')->getFromJson('lang.exam'); ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4><?php echo app('translator')->getFromJson('lang.are_you_sure_to_delete'); ?></h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->getFromJson('lang.cancel'); ?></button>
                                                         <?php echo e(Form::open(['url' => 'exam/'.$exam->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

                                                        <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->getFromJson('lang.delete'); ?></button>
                                                         <?php echo e(Form::close()); ?>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>


    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>