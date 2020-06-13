<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Homework List</h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>">Dashboard</a>
                <a href="#">Homework</a>
                <a href="#">Homework List</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
 
    <div class="row mt-40">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-0">Homework List</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                        <thead>
                            
                            <?php if(session()->has('message-success') != "" ||
                            session()->get('message-danger') != ""): ?>
                            <tr>
                                <td colspan="9">
                                     <?php if(session()->has('message-success')): ?>
                                      <div class="alert alert-success">
                                          <?php echo e(session()->get('message-success')); ?>

                                      </div>
                                    <?php elseif(session()->has('message-danger')): ?>
                                      <div class="alert alert-danger">
                                          <?php echo e(session()->get('message-danger')); ?>

                                      </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                             <?php endif; ?>
                            
                            <tr>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Subject</th>
                                <th>Marks</th>
                                <th>Homework date</th>
                                <th>submission Date</th>
                                <th>Evaluation Date</th>
                                <th>Obtained Marks</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $homeworkLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php 
                               $student_result = App\SmHomework::evaluationHomework($student_detail->id, $value->id);
                            ?>
                          
                            <tr>
                                <td><?php echo e($value->classes !=""?$value->classes->class_name:""); ?></td>
                                <td><?php echo e($value->sections !=""?$value->sections->section_name:""); ?></td>
                                <td><?php echo e($value->subjects !=""?$value->subjects->subject_name:""); ?></td>
                                <td><?php echo e($value->marks); ?></td>
                                 <td>
                                   
<?php echo e($value->homework_date != ""? App\SmGeneralSettings::DateConvater($value->homework_date):''); ?>


                                </td>
                                 <td>
                                    
<?php echo e($value->submission_date != ""? App\SmGeneralSettings::DateConvater($value->submission_date):''); ?>


                                </td>
                                <td>
                                <?php if(!empty($value->evaluation_date)): ?>
                               
<?php echo e($value->evaluation_date != ""? App\SmGeneralSettings::DateConvater($value->evaluation_date):''); ?>



                                <?php endif; ?>
                                </td>

                                
                               <td><?php echo e($student_result != ""? $student_result->marks:''); ?></td>
                                <td>
                                    <?php if($student_result != ""): ?>
                                        
                                        <?php if($student_result->complete_status == "C"): ?>
                                        <button class="primary-btn small bg-success text-white border-0">Completed</button>
                                        <?php else: ?>
                                        <button class="primary-btn small bg-warning text-white border-0">Incompleted</button>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            Select
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">

                                         <a class="dropdown-item modalLink" title="Homework View" data-modal-size="modal-lg" href="<?php echo e(route('student_homework_view', [$value->class_id, $value->section_id, $value->id])); ?>">View</a>
                                        </div>
                                    </div>
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
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>