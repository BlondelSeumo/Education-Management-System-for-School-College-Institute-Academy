<?php $__env->startSection('mainContent'); ?>
<?php  $setting = App\SmGeneralSettings::find(1);  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   ?> 

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.student_transport_report'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.transport'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.student_transport_report'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.select_criteria'); ?></h3>
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
                    <div class="white-box">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_transport_report', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                            <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-3 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_class'); ?>" value=""><?php echo app('translator')->getFromJson('lang.select_class'); ?></option>
                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($class->id); ?>"  <?php echo e(isset($class_id)? ($class_id == $class->id? 'selected':''):''); ?>><?php echo e($class->class_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-lg-3 mt-30-md" id="select_section_div">
                                    <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?> select_section" id="select_section" name="section">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_section'); ?>" value=""><?php echo app('translator')->getFromJson('lang.select_section'); ?></option>
                                    </select>
                                </div>
                                <div class="col-lg-3 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('route') ? ' is-invalid' : ''); ?>" name="route">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_route'); ?>" value=""><?php echo app('translator')->getFromJson('lang.select_route'); ?></option>
                                        <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($route->id); ?>"  <?php echo e(isset($route_id)? ($route_id == $route->id? 'selected':''):''); ?>><?php echo e($route->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-lg-3 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('vehicle') ? ' is-invalid' : ''); ?>" name="vehicle">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_vehicle'); ?>" value=""><?php echo app('translator')->getFromJson('lang.select_vehicle'); ?></option>
                                        <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($vehicle->id); ?>"  <?php echo e(isset($vechile_id)? ($vechile_id == $vehicle->id? 'selected':''):''); ?>><?php echo e($vehicle->vehicle_no); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
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
       
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.student_transport_report'); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id_table" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <?php if(session()->has('message-danger') != ""): ?>
                                    <tr>
                                        <td colspan="9">
                                            <?php if(session()->has('message-danger')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo e(session()->get('message-danger')); ?>

                                            </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th><?php echo app('translator')->getFromJson('lang.class_Sec'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.admission'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.student'); ?> <?php echo app('translator')->getFromJson('lang.name'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.mobile'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.father_name'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.father_phone'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.mother_name'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.mother_phone'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.route_title'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.vehicle'); ?> <?php echo app('translator')->getFromJson('lang.number'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.driver'); ?> <?php echo app('translator')->getFromJson('lang.name'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.driver'); ?> <?php echo app('translator')->getFromJson('lang.content'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.fare'); ?>(<?php echo e($currency); ?>)</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($student->className != ""? $student->className->class_name:""); ?> (<?php echo e($student->section->section_name); ?>)<input type="hidden" name="id[]" value="<?php echo e($student->student_id); ?>"></td>
                                        <td><?php echo e($student->admission_no); ?></td>
                                        <td><?php echo e($student->full_name); ?></td>
                                        <td><?php echo e($student->mobile); ?></td>
                                        <td><?php echo e($student->parents !=""?$student->parents->fathers_name:""); ?></td>
                                        <td><?php echo e($student->parents !=""?$student->parents->fathers_mobile:""); ?></td>
                                        <td><?php echo e($student->parents !=""?$student->parents->mothers_name:""); ?></td>
                                        <td><?php echo e($student->parents !=""?$student->parents->mothers_mobile:""); ?></td>
                                        <td><?php echo e($student->route !=""?$student->route->title:""); ?></td>
                                        <td><?php echo e($student->vehicle !=""?$student->vehicle->vehicle_no:""); ?></td>
                                        <td><?php echo e($student->vehicle !=""?$student->vehicle->driver_name:""); ?></td>
                                        <td><?php echo e($student->vehicle !=""?$student->vehicle->driver_contact:""); ?></td>
                                        <td><?php echo e(number_format( (float) $student->route->far, 2, '.', '')); ?></td>
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