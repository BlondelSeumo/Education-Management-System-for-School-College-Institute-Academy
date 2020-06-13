<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->getFromJson('lang.add_homework'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->getFromJson('lang.home_work'); ?></a>
                    <a href="#"><?php echo app('translator')->getFromJson('lang.add_homework'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
       
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="main-title">
                            <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.add_homework'); ?></h3>
                        </div>
                    </div>
                </div>
                <?php if(in_array(279, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'saveHomeworkData', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                <?php endif; ?>
                <div class="row">
                    <div class="col-lg-12">
                        <?php if(session()->has('message-success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session()->get('message-success')); ?>

                            </div>
                        <?php elseif(session()->has('message-danger')): ?>
                            <div class="alert alert-danger">
                                <?php echo e(session()->get('message-danger')); ?>

                            </div>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="row mb-30">
                                    <div class="col-lg-4">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('class_id') ? ' is-invalid' : ''); ?>"
                                                    name="class_id" id="classSelectStudent">
                                                <option data-display="Select Class *" value="">Select</option>
                                                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($value->id); ?>" <?php echo e(old('class_id') != ""? 'selected':''); ?>><?php echo e($value->class_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('class_id')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('class_id')); ?></strong>
                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-effect" id="sectionStudentDiv">
                                            <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('section_id') ? ' is-invalid' : ''); ?>"
                                                    name="section_id" id="sectionSelectStudent">
                                                <option data-display="<?php echo app('translator')->getFromJson('lang.select_section'); ?> *"
                                                        value=""><?php echo app('translator')->getFromJson('lang.section'); ?> *
                                                </option>
                                            </select>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('section_id')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong><?php echo e($errors->first('section_id')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-effect" id="subjectSelecttDiv">
                                            <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('subject_id') ? ' is-invalid' : ''); ?>"
                                                    name="subject_id" id="subjectSelect">
                                                <option data-display="<?php echo app('translator')->getFromJson('lang.select_subjects'); ?> *"
                                                        value=""><?php echo app('translator')->getFromJson('lang.subject'); ?> *
                                                </option>
                                            </select>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('subject_id')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong><?php echo e($errors->first('subject_id')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-30">
                                    <div class="col-lg-3">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input date form-control<?php echo e($errors->has('homework_date') ? ' is-invalid' : ''); ?>"
                                                           id="homework_date" type="text" name="homework_date"
                                                           value="<?php echo e(old('homework_date') != ""? old('homework_date'): date('m/d/Y')); ?>"
                                                           readonly="true">
                                                    <label><?php echo app('translator')->getFromJson('lang.home_work'); ?> <?php echo app('translator')->getFromJson('lang.date'); ?>
                                                        <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('homework_date')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('homework_date')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="homework_date_icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input date form-control<?php echo e($errors->has('submission_date') ? ' is-invalid' : ''); ?>"
                                                           id="submission_date" type="text" name="submission_date"
                                                           value="<?php echo e(old('submission_date') != ""? old('submission_date') : date('m/d/Y')); ?>"
                                                           readonly="true">
                                                    <label><?php echo app('translator')->getFromJson('lang.submission'); ?> <?php echo app('translator')->getFromJson('lang.date'); ?>
                                                        <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('submission_date')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('submission_date')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="submission_date_icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="row no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input form-control<?php echo e($errors->has('marks') ? ' is-invalid' : ''); ?>"
                                                           type="text" name="marks" value="<?php echo e(old('marks')); ?>">
                                                    <label><?php echo app('translator')->getFromJson('lang.marks'); ?> <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('marks')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('marks')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="row no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input" type="text"
                                                           id="placeholderHomeworkName"
                                                           placeholder="<?php echo app('translator')->getFromJson('lang.attach_file'); ?>"
                                                           disabled>
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                           for="homework_file"><?php echo app('translator')->getFromJson('lang.browse'); ?></label>
                                                    <input type="file" class="d-none" name="homework_file"
                                                           id="homework_file">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row md-20">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea
                                                    class="primary-input form-control<?php echo e($errors->has('description') ? ' is-invalid' : ''); ?>"
                                                    cols="0" rows="4" name="description"
                                                    id="description *"><?php echo e(old('description')); ?></textarea>
                                            <label><?php echo app('translator')->getFromJson('lang.description'); ?> <span>*</span> </label>
                                            <span class="focus-border textarea"></span>
                                            <?php if($errors->has('description')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('description')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            	  <?php 
                                  $tooltip = "";
                                  if(in_array(279, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                            <div class="row mt-40">
                                <div class="col-lg-12 text-center">
                                   <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                        <span class="ti-check"></span>
                                        <?php echo app('translator')->getFromJson('lang.save'); ?> <?php echo app('translator')->getFromJson('lang.home_work'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo e(Form::close()); ?>

            </div>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>