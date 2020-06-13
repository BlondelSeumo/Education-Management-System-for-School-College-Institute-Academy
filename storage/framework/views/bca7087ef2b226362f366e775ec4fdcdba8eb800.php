<?php $__env->startSection('mainContent'); ?>
<?php
    function showPicName($data){
        $name = explode('/', $data);
        return $name[3];
    }
?>
<section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.student_certificate'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.admin_section'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.student_certificate'); ?></a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($certificate)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(url('student-certificate')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->getFromJson('lang.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
           
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php if(isset($certificate)): ?>
                                    <?php echo app('translator')->getFromJson('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->getFromJson('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->getFromJson('lang.certificate'); ?>
                            </h3>
                        </div>
                        <?php if(isset($certificate)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'student-certificate/'.$certificate->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                          <?php if(in_array(50, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'student-certificate',
                        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row mt-25">
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
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                                                type="text" name="name" autocomplete="off" value="<?php echo e(isset($certificate)? $certificate->name: old('name')); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($certificate)? $certificate->id: ''); ?>">
                                            <label><?php echo app('translator')->getFromJson('lang.certificate'); ?> <?php echo app('translator')->getFromJson('lang.name'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('header_left_text') ? ' is-invalid' : ''); ?>"
                                                type="text" name="header_left_text" autocomplete="off" value="<?php echo e(isset($certificate)? $certificate->header_left_text: old('header_left_text')); ?>">
                                            <label><?php echo app('translator')->getFromJson('lang.header_left_text'); ?><span></span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('header_left_text')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('header_left_text')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control<?php echo e($errors->has('date') ? ' is-invalid' : ''); ?>" id="startDate" type="text" name="date" autocomplete="off" value="<?php echo e(isset($certificate)? date('m/d/Y', strtotime($certificate->date)): date('m/d/Y')); ?>">
                                            <span class="focus-border"></span>
                                            <label><?php echo app('translator')->getFromJson('lang.date'); ?> <span></span></label>
                                            <?php if($errors->has('date')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('date')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="start-date-icon"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control<?php echo e($errors->has('body') ? ' is-invalid' : ''); ?>" cols="0" rows="4" name="body" maxlength="500"><?php echo e(isset($certificate)? $certificate->body: old('body')); ?></textarea>
                                            <label><?php echo app('translator')->getFromJson('lang.body'); ?> (<?php echo app('translator')->getFromJson('lang.certificate_body_len'); ?>) <span></span></label>
                                            <span class="focus-border textarea"></span>

                                            <?php if($errors->has('body')): ?>
                                                <span class="error text-danger"><strong><?php echo e($errors->first('body')); ?></strong></span>
                                            <?php endif; ?>
                                        </div>
                                        <span class="text-primary">[name] [dob] [present_address] [guardian] [created_at] [admission_no] [roll_no] [class] [section] [gender] [admission_date] [category] [cast] [father_name] [mother_name] [religion] [email] [phone]</span>
                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('footer_left_text') ? ' is-invalid' : ''); ?>"
                                                type="text" name="footer_left_text" autocomplete="off" value="<?php echo e(isset($certificate)? $certificate->footer_left_text: old('footer_left_text')); ?>">
                                            <label><?php echo app('translator')->getFromJson('lang.footer_left_text'); ?> <span></span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('footer_left_text')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('footer_left_text')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('footer_center_text') ? ' is-invalid' : ''); ?>"
                                                type="text" name="footer_center_text" autocomplete="off" value="<?php echo e(isset($certificate)? $certificate->footer_center_text: old('footer_center_text')); ?>">
                                            <label><?php echo app('translator')->getFromJson('lang.footer_center_text'); ?><span></span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('footer_center_text')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('footer_center_text')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('footer_right_text') ? ' is-invalid' : ''); ?>"
                                                type="text" name="footer_right_text" autocomplete="off" value="<?php echo e(isset($certificate)? $certificate->footer_right_text: old('footer_right_text')); ?>">
                                            <label><?php echo app('translator')->getFromJson('lang.footer_right_text'); ?><span></span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('footer_right_text')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('footer_right_text')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->getFromJson('lang.student_photo'); ?></p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="student_photo" id="relationFather" value="1" class="common-radio relationButton" <?php echo e(isset($certificate)? ($certificate->student_photo == 1? 'checked': ''):'checked'); ?>>
                                                <label for="relationFather"><?php echo app('translator')->getFromJson('lang.yes'); ?></label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="student_photo" id="relationMother" value="0" class="common-radio relationButton" <?php echo e(isset($certificate)? ($certificate->student_photo == 0? 'checked': ''):''); ?>>
                                                <label for="relationMother"><?php echo app('translator')->getFromJson('lang.none'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row no-gutters input-right-icon mt-35">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('file') ? ' is-invalid' : ''); ?>" id="placeholderInput" type="text" placeholder="<?php echo e(isset($certificate)? ($certificate->file != ""? showPicName($certificate->file):'Background Image *'): 'Background Image(1100 X 850)px *'); ?>" readonly>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('file')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('file')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="browseFile"><?php echo app('translator')->getFromJson('lang.browse'); ?></label>
                                            <input type="file" class="d-none" id="browseFile" name="file" value="<?php echo e(isset($certificate)? ($certificate->file != ""? showPicName($certificate->file):''): ''); ?>">
                                        </button>
                                    </div>
                                    
                                </div>
	  <?php 
                                  $tooltip = "";
                                  if(in_array(50, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($certificate)): ?>
                                                <?php echo app('translator')->getFromJson('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->getFromJson('lang.save'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->getFromJson('lang.certificate'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">  <?php echo app('translator')->getFromJson('lang.certificate'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></h3>
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
                                    <th><?php echo app('translator')->getFromJson('lang.name'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.background_image'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.actions'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><a class="text-color" data-toggle="modal" data-target="#showCertificateModal<?php echo e($certificate->id); ?>"  href="#"><?php echo e($certificate->name); ?></a></td>
                                    <td><img src="<?php echo e(url($certificate->file)); ?>" width="100"></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->getFromJson('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" data-toggle="modal" data-target="#showCertificateModal<?php echo e($certificate->id); ?>"  href="#"><?php echo app('translator')->getFromJson('lang.view'); ?></a>
                                                 <?php if(in_array(51, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>
                                                <a class="dropdown-item" href="<?php echo e(url('student-certificate/'.$certificate->id.'/edit')); ?>">edit</a>
                                                <?php endif; ?>
                                                 <?php if(in_array(52, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteSectionModal<?php echo e($certificate->id); ?>"  href="#"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteSectionModal<?php echo e($certificate->id); ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.delete'); ?> <?php echo app('translator')->getFromJson('lang.certificate'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->getFromJson('lang.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->getFromJson('lang.cancel'); ?></button>
                                                    <?php echo e(Form::open(['url' => 'student-certificate/'.$certificate->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>


                                                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->getFromJson('lang.delete'); ?></button>
                                                    <?php echo e(Form::close()); ?>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade admin-query" id="showCertificateModal<?php echo e($certificate->id); ?>">
                                    <div class="modal-dialog modal-dialog-centered large-modal">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.view'); ?> <?php echo app('translator')->getFromJson('lang.certificate'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body p-0">
                                                <div class="container student-certificate">
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-12 text-center">
                                                            <div class="mb-5">
								                                <img class="img-fluid" src="<?php echo e(asset($certificate->file)); ?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-10 text-center certificate-position">
                                                            <div>
                                                                <div class="row justify-content-lg-between mb-5">
                                                                    <div class="col-md-5">
                                                                        <!-- <div class="input-effect text-left">
                                                                            <input class="primary-input form-control" type="text" name="name" value="">
                                                                            <label>Reff No.</label>
                                                                            <span class="focus-border"></span>
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>error</strong>
                                                                            </span>
                                                                        </div> -->

                                                                        <p class="m-0"><?php echo e($certificate->header_left_text); ?>:</p>

                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <!-- <div class="row no-gutters input-right-icon text-left">
                                                                            <div class="col">
                                                                                <div class="input-effect">
                                                                                    <input class="primary-input date form-control" id="endDate" type="text" name="date" value="">
                                                                                    <span class="focus-border"></span>
                                                                                    <label>Date <span></span></label>
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>Error</strong>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-auto">
                                                                                <button class="" type="button">
                                                                                    <i class="ti-calendar" id="end-date-icon"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div> -->
                                                                        <p class="m-0"><?php echo app('translator')->getFromJson('lang.date'); ?>: <?php echo e($certificate->date); ?></p>
                                                                    </div>
                                                                </div>

                                                                <div class="certificate-middle">
                                                                    <p>
                                                                        <?php echo e($certificate->body); ?>

                                                                    </p>
                                                                </div>

                                                                <div class="mt-80 mb-4">
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-center">
                                                                            <div class="signature bb-15"><?php echo e($certificate->footer_left_text); ?></div>
                                                                        </div>
                                                                        <div class="col-md-4 text-center">
                                                                            <div class="signature bb-15"><?php echo e($certificate->footer_center_text); ?></div>
                                                                        </div>
                                                                        <div class="col-md-4 text-center">
                                                                            <div class="signature bb-15"><?php echo e($certificate->footer_right_text); ?></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
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