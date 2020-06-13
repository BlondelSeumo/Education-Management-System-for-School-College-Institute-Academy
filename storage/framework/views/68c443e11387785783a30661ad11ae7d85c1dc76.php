<?php $__env->startSection('mainContent'); ?>
    <?php
        function showPicName($data){
        $name = explode('/', $data);
        return $name[3];
        }
    ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->getFromJson('lang.upload_content'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->getFromJson('lang.teacher'); ?></a>
                    <a href="#"><?php echo app('translator')->getFromJson('lang.upload_content'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">

            <div class="row">

               


                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">
                                    <?php if(isset($editData)): ?>
                                        <?php echo app('translator')->getFromJson('lang.edit'); ?>
                                    <?php else: ?>
                                    <?php endif; ?>
                                    <?php echo app('translator')->getFromJson('lang.upload_content'); ?>
                                </h3>
                            </div>
                            <?php if(isset($editData)): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'approve-leave/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                            <?php else: ?>
                             <?php if(in_array(89, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'save-upload-content', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                            <?php endif; ?>
                            <?php endif; ?>
                            <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row mb-25">
                                        <?php if(session()->has('message-success')): ?>
                                            <div class="alert alert-success">
                                                <?php echo e(session()->get('message-success')); ?>

                                            </div>
                                        <?php elseif(session()->has('message-danger')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo e(session()->get('message-danger')); ?>

                                            </div>
                                        <?php endif; ?>

                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control<?php echo e($errors->has('content_title') ? ' is-invalid' : ''); ?>"
                                                    type="text" name="content_title" autocomplete="off"
                                                    value="<?php echo e(isset($content_title)? $leave_type->type:''); ?>">
                                                <label> <?php echo app('translator')->getFromJson('lang.content_title'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('content_title')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('content_title')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb-30">
                                            <select
                                                class="niceSelect w-100 bb form-control<?php echo e($errors->has('content_type') ? ' is-invalid' : ''); ?>"
                                                name="content_type" id="content_type">
                                                <option data-display="<?php echo app('translator')->getFromJson('lang.content'); ?> <?php echo app('translator')->getFromJson('lang.type'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.content'); ?> <?php echo app('translator')->getFromJson('lang.type'); ?> *</option>
                                                <option value="as"> <?php echo app('translator')->getFromJson('lang.assignment'); ?></option>
                                                <option value="st"><?php echo app('translator')->getFromJson('lang.study_material'); ?></option>
                                                <option value="sy"><?php echo app('translator')->getFromJson('lang.syllabus'); ?></option>
                                                <option value="ot"><?php echo app('translator')->getFromJson('lang.other_download'); ?></option>

                                            </select>
                                            <?php if($errors->has('content_type')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('content_type')); ?></strong>
                                        </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-lg-12 mb-30">
                                            <label><?php echo app('translator')->getFromJson('lang.available_for'); ?> *</label><br>

                                            <div class="">
                                                <input type="checkbox" id="all_admin"
                                                       class="common-checkbox form-control<?php echo e($errors->has('available_for') ? ' is-invalid' : ''); ?>"
                                                       name="available_for[]" value="admin">
                                                <label for="all_admin"><?php echo app('translator')->getFromJson('lang.all'); ?> <?php echo app('translator')->getFromJson('lang.admin'); ?></label>
                                                <input type="checkbox" id="student"
                                                       class="common-checkbox form-control<?php echo e($errors->has('available_for') ? ' is-invalid' : ''); ?>"
                                                       name="available_for[]" value="student">
                                                <label for="student"><?php echo app('translator')->getFromJson('lang.student'); ?></label>
                                            </div>
                                            <?php if($errors->has('available_for')): ?>
                                                <span class="text-danger validate-textarea-checkbox" role="alert">
                                                <strong><?php echo e($errors->first('available_for')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-lg-12 disabledbutton mb-30" id="availableClassesDiv">

                                            <div class="">
                                                <input type="checkbox" id="all_classes"
                                                       class="common-checkbox form-control" name="all_classes">
                                                <label for="all_classes"><?php echo app('translator')->getFromJson('lang.available_for_all_classes'); ?></label>
                                            </div>
                                        </div>

                                        <div
                                            class="forStudentWrapper col-lg-12 mb-20 <?php echo e($errors->has('class') || $errors->has('section')? '':'disabledbutton'); ?>"
                                            id="contentDisabledDiv">
                                            <div class="row">
                                                <div class="col-lg-12 mb-20">
                                                    <div class="input-effect">
                                                        <select
                                                            class="niceSelect w-100 bb form-control<?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>"
                                                            name="class" id="classSelectStudent">
                                                            <option data-display="<?php echo app('translator')->getFromJson('lang.select_class'); ?> *"
                                                                    value=""><?php echo app('translator')->getFromJson('lang.select'); ?></option>
                                                            <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option
                                                                    value="<?php echo e($value->id); ?>"><?php echo e($value->class_name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <span class="focus-border"></span>
                                                        <?php if($errors->has('class')): ?>
                                                            <span class="invalid-feedback invalid-select" role="alert">
                                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                                    </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 mb-30">
                                                    <div class="input-effect" id="sectionStudentDiv">
                                                        <select
                                                            class="niceSelect w-100 bb form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>"
                                                            name="section" id="sectionSelectStudent">
                                                            <option data-display="<?php echo app('translator')->getFromJson('lang.select_section'); ?> *"
                                                                    value=""><?php echo app('translator')->getFromJson('lang.section'); ?> *
                                                            </option>
                                                        </select>
                                                        <span class="focus-border"></span>
                                                        <?php if($errors->has('section')): ?>
                                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong><?php echo e($errors->first('section')); ?></strong>
                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">


                                    </div>
                                    <div class="row no-gutters input-right-icon mb-30">

                                        <div class="col">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input date form-control<?php echo e($errors->has('upload_date') ? ' is-invalid' : ''); ?>"
                                                    id="upload_date" type="text"
                                                    name="upload_date"
                                                    value="<?php echo e(isset($editData)? date('m/d/Y', strtotime($editData->upload_date)): date('m/d/Y')); ?>">
                                                <label><?php echo app('translator')->getFromJson('lang.update'); ?> <?php echo app('translator')->getFromJson('lang.date'); ?> <span></span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('upload_date')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('upload_date')); ?></strong>
                                    </span>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="apply_date_icon"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row mb-20">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <textarea class="primary-input form-control" cols="0" rows="3"
                                                          name="description" id="description"></textarea>
                                                <label><?php echo app('translator')->getFromJson('lang.description'); ?> <span></span> </label>
                                                <span class="focus-border textarea"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters input-right-icon mb-20">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control <?php echo e($errors->has('content_file') ? ' is-invalid' : ''); ?>"
                                                    readonly="true" type="text"
                                                    placeholder="<?php echo e(isset($editData->file) && $editData->file != ""? showPicName($editData->file):'Attach File *'); ?>"
                                                    id="placeholderUploadContent">
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('content_file')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('content_file')); ?></strong>
                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg"
                                                       for="upload_content_file"><?php echo app('translator')->getFromJson('lang.browse'); ?></label>
                                                <input type="file" class="d-none form-control" name="content_file"
                                                       id="upload_content_file">
                                            </button>

                                        </div>
                                    </div>
                                      <?php 
                                  $tooltip = "";
                                  if(in_array(89, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                                <span class="ti-check"></span>
                                                <?php echo app('translator')->getFromJson('lang.upload_content'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                </div>
            
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"> <?php echo app('translator')->getFromJson('lang.upload_content'); ?>  <?php echo app('translator')->getFromJson('lang.list'); ?></h3>
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
                                        <td colspan="6">
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
                                    <th> <?php echo app('translator')->getFromJson('lang.content_title'); ?></th>
                                    <th> <?php echo app('translator')->getFromJson('lang.type'); ?></th>
                                    <th> <?php echo app('translator')->getFromJson('lang.date'); ?></th>
                                    <th> <?php echo app('translator')->getFromJson('lang.available_for'); ?></th>
                                    <th> <?php echo app('translator')->getFromJson('lang.class_section'); ?></th>
                                    <th> <?php echo app('translator')->getFromJson('lang.action'); ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php if(isset($uploadContents)): ?>
                                    <?php $__currentLoopData = $uploadContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>

                                            <td><?php echo e($value->content_title); ?></td>
                                            <td>
                                                <?php if($value->content_type == 'as'): ?>
                                                    <?php echo e('Assignment'); ?>

                                                <?php elseif($value->content_type == 'st'): ?>
                                                    <?php echo e('Study Material'); ?>

                                                <?php elseif($value->content_type == 'sy'): ?>
                                                    <?php echo e('Syllabus'); ?>

                                                <?php else: ?>
                                                    <?php echo e('Others Download'); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td  data-sort="<?php echo e(strtotime($value->upload_date)); ?>" >
                                                 <?php echo e($value->upload_date != ""? App\SmGeneralSettings::DateConvater($value->upload_date):''); ?> </td>

                                            <td>
                                                <?php if($value->available_for_admin == 1): ?>
                                                    <?php echo e('All admin'); ?><br>
                                                <?php endif; ?>
                                                <?php if($value->available_for_all_classes == 1): ?>
                                                    <?php echo e('All classes student'); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td>

                                                <?php if($value->classes != ""): ?>
                                                    <?php echo e($value->classes->class_name); ?>

                                                <?php endif; ?>

                                                <?php if($value->sections != ""): ?>
                                                    (<?php echo e($value->sections->section_name); ?>)
                                                <?php endif; ?>


                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle"
                                                            data-toggle="dropdown">
                                                        <?php echo app('translator')->getFromJson('lang.select'); ?>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">

                                                    <!--    <a data-modal-size="modal-lg" title="View Leave Details" class="dropdown-item modalLink" href="<?php echo e(url('view-leave-details', $value->id)); ?>">Download</a> -->

                                                    <!--    <a class="dropdown-item" href="<?php echo e(url('approve-leave/'.$value->id.'/edit')); ?>">edit</a> -->

                                                    <?php if(in_array(91, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                                                        <a class="dropdown-item" data-toggle="modal"
                                                           data-target="#deleteApplyLeaveModal<?php echo e($value->id); ?>"
                                                           href="#"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
                                                         <?php endif; ?>
                                                         
                                                        <?php if($value->upload_file != ""): ?>
                                                        <?php if(in_array(90, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                                                            <a class="dropdown-item"
                                                               href="<?php echo e(url('download-content-document/'.showPicName($value->upload_file))); ?>">
                                                                <?php echo app('translator')->getFromJson('lang.download'); ?> <span
                                                                    class="pl ti-download"></span>
                                                        <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade admin-query" id="deleteApplyLeaveModal<?php echo e($value->id); ?>">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.delete'); ?> <?php echo app('translator')->getFromJson('lang.upload_content'); ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            &times;
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <h4><?php echo app('translator')->getFromJson('lang.are_you_sure_to_delete'); ?></h4>
                                                        </div>

                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg"
                                                                    data-dismiss="modal"><?php echo app('translator')->getFromJson('lang.cancel'); ?></button>
                                                            <a href="<?php echo e(url('delete-upload-content', [$value->id])); ?>"
                                                               class="text-light">
                                                                <button class="primary-btn fix-gr-bg"
                                                                        type="submit"><?php echo app('translator')->getFromJson('lang.delete'); ?></button>
                                                            </a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
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