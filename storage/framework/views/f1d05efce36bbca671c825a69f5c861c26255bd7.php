<?php $__env->startSection('mainContent'); ?>
<?php
$setting = App\SmGeneralSettings::find(1);
    function showPicName($data){
        $name = explode('/', $data);
        return $name[3];
    }
?>
<section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.student_id_card'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.admin_section'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.student_id_card'); ?></a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($id_card)): ?>
        <?php if(in_array(46, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(url('student-id-card')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->getFromJson('lang.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>
        <div class="row">
             
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php if(isset($id_card)): ?>
                                    <?php echo app('translator')->getFromJson('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->getFromJson('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->getFromJson('lang.student_id_card'); ?>
                            </h3>
                        </div>
                        <?php if(isset($id_card)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'student-id-card/'.$id_card->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                         <?php if(in_array(46, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'student-id-card',
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
                                            <input class="primary-input form-control<?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>"
                                                type="text" name="title" autocomplete="off" value="<?php echo e(isset($id_card)? $id_card->title: old('title')); ?>">
                                            <label><?php echo app('translator')->getFromJson('lang.id_card_title'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('title')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('title')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('logo') ? ' is-invalid' : ''); ?>" type="text" id="placeholderFileThreeName" placeholder="<?php echo e(isset($id_card)? ($id_card->logo != ""? showPicName($id_card->logo):'Logo *'): 'Logo *'); ?>"
                                                readonly>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('logo')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('logo')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="document_file_3">@</label>
                                            <input type="file" class="d-none" name="logo" id="document_file_3" value="<?php echo e(isset($id_card)? ($id_card->file != ""? showPicName($id_card->logo):''): ''); ?>">
                                        </button>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('designation') ? ' is-invalid' : ''); ?>"
                                                type="text" name="designation" autocomplete="off" value="<?php echo e(isset($id_card)? $id_card->designation: old('designation')); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($id_card)? $id_card->id: ''); ?>">
                                            <label><?php echo app('translator')->getFromJson('lang.Designation_of_Signature_person'); ?><span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('designation')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('designation')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('signature') ? ' is-invalid' : ''); ?>" type="text" id="placeholderFileFourName" placeholder="<?php echo e(isset($id_card)? ($id_card->signature != ""? showPicName($id_card->signature):'Signiture *'): 'Signiture *'); ?>"
                                                readonly>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('signature')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('signature')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="document_file_4"><?php echo app('translator')->getFromJson('lang.browse'); ?></label>
                                            <input type="file" class="d-none" name="signature" id="document_file_4">
                                        </button>
                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control<?php echo e($errors->has('address') ? ' is-invalid' : ''); ?>" cols="0" rows="4" name="address"><?php echo e(isset($id_card)? $id_card->address: old('address')); ?></textarea>
                                            <label><?php echo app('translator')->getFromJson('lang.address'); ?>/<?php echo app('translator')->getFromJson('lang.phone'); ?>/<?php echo app('translator')->getFromJson('lang.email'); ?> <span>*</span></label>
                                            <span class="focus-border textarea"></span>
                                        </div>
                                        <?php if($errors->has('address')): ?>
                                            <span class="error text-danger"><strong class="validate-textarea"><?php echo e($errors->first('address')); ?></strong></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10"> <?php echo app('translator')->getFromJson('lang.admission'); ?> <?php echo app('translator')->getFromJson('lang.number'); ?> </p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="admission_no" id="admission_no_yes" value="1" class="common-radio relationButton" <?php echo e(isset($id_card)? ($id_card->admission_no == 1? 'checked': ''):'checked'); ?>>
                                                <label for="admission_no_yes"><?php echo app('translator')->getFromJson('lang.yes'); ?></label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="admission_no" id="admission_no_no" value="0" class="common-radio relationButton" <?php echo e(isset($id_card)? ($id_card->admission_no == 0? 'checked': ''):''); ?>>
                                                <label for="admission_no_no"><?php echo app('translator')->getFromJson('lang.none'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->getFromJson('lang.student'); ?> <?php echo app('translator')->getFromJson('lang.name'); ?> </p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="student_name" id="student_name_yes" value="1" class="common-radio relationButton" <?php echo e(isset($id_card)? ($id_card->student_name == 1? 'checked': ''):'checked'); ?>>
                                                <label for="student_name_yes"><?php echo app('translator')->getFromJson('lang.yes'); ?></label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="student_name" id="student_name_no" value="0" class="common-radio relationButton" <?php echo e(isset($id_card)? ($id_card->student_name == 0? 'checked': ''):''); ?>>
                                                <label for="student_name_no"><?php echo app('translator')->getFromJson('lang.none'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->getFromJson('lang.class'); ?> </p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="class" id="class_yes" value="1" class="common-radio relationButton" <?php echo e(isset($id_card)? ($id_card->class == 1? 'checked': ''):'checked'); ?>>
                                                <label for="class_yes"><?php echo app('translator')->getFromJson('lang.yes'); ?></label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="student_photo" id="class_no" value="0" class="common-radio relationButton" <?php echo e(isset($id_card)? ($id_card->class == 0? 'checked': ''):''); ?>>
                                                <label for="class_no"><?php echo app('translator')->getFromJson('lang.none'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->getFromJson('lang.father'); ?> <?php echo app('translator')->getFromJson('lang.name'); ?></p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="father_name" id="father_name_yes" value="1" class="common-radio relationButton" <?php echo e(isset($id_card)? ($id_card->father_name == 1? 'checked': ''):'checked'); ?>>
                                                <label for="father_name_yes"><?php echo app('translator')->getFromJson('lang.yes'); ?></label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="father_name" id="father_name_no" value="0" class="common-radio relationButton" <?php echo e(isset($id_card)? ($id_card->father_name == 0? 'checked': ''):''); ?>>
                                                <label for="father_name_no"><?php echo app('translator')->getFromJson('lang.none'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->getFromJson('lang.mother'); ?> <?php echo app('translator')->getFromJson('lang.name'); ?></p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="mother_name" id="mother_name_yes" value="1" class="common-radio relationButton" <?php echo e(isset($id_card)? ($id_card->mother_name == 1? 'checked': ''):'checked'); ?>>
                                                <label for="mother_name_yes"><?php echo app('translator')->getFromJson('lang.yes'); ?></label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="mother_name" id="mother_name_no" value="0" class="common-radio relationButton" <?php echo e(isset($id_card)? ($id_card->mother_name == 0? 'checked': ''):''); ?>>
                                                <label for="mother_name_no"><?php echo app('translator')->getFromJson('lang.none'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->getFromJson('lang.student'); ?> <?php echo app('translator')->getFromJson('lang.address'); ?></p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="student_address" id="address_yes" value="1" class="common-radio relationButton" <?php echo e(isset($id_card)? ($id_card->student_address == 1? 'checked': ''):'checked'); ?>>
                                                <label for="address_yes"><?php echo app('translator')->getFromJson('lang.yes'); ?></label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="student_address" id="address_no" value="0" class="common-radio relationButton" <?php echo e(isset($id_card)? ($id_card->student_address == 0? 'checked': ''):''); ?>>
                                                <label for="address_no"><?php echo app('translator')->getFromJson('lang.none'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->getFromJson('lang.phone'); ?></p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="mobile" id="phone_yes" value="1" class="common-radio relationButton" <?php echo e(isset($id_card)? ($id_card->phone == 1? 'checked': ''):'checked'); ?>>
                                                <label for="phone_yes"><?php echo app('translator')->getFromJson('lang.yes'); ?></label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="mobile" id="phone_no" value="0" class="common-radio relationButton" <?php echo e(isset($id_card)? ($id_card->phone == 0? 'checked': ''):''); ?>>
                                                <label for="phone_no"><?php echo app('translator')->getFromJson('lang.none'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->getFromJson('lang.date_of_birth'); ?></p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="dob" id="dob_yes" value="1" class="common-radio relationButton" <?php echo e(isset($id_card)? ($id_card->dob == 1? 'checked': ''):'checked'); ?>>
                                                <label for="dob_yes"><?php echo app('translator')->getFromJson('lang.yes'); ?></label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="dob" id="dob_no" value="0" class="common-radio relationButton" <?php echo e(isset($id_card)? ($id_card->dob == 0? 'checked': ''):''); ?>>
                                                <label for="dob_no"><?php echo app('translator')->getFromJson('lang.none'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->getFromJson('lang.blood_group'); ?></p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="blood" id="blood_yes" value="1" class="common-radio relationButton" <?php echo e(isset($id_card)? ($id_card->blood == 1? 'checked': ''):'checked'); ?>>
                                                <label for="blood_yes"><?php echo app('translator')->getFromJson('lang.yes'); ?></label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="blood" id="blood_no" value="0" class="common-radio relationButton" <?php echo e(isset($id_card)? ($id_card->blood == 0? 'checked': ''):''); ?>>
                                                <label for="blood_no"><?php echo app('translator')->getFromJson('lang.none'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
  <?php 
                                  $tooltip = "";
                                  if(in_array(46, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($id_card)): ?>
                                                <?php echo app('translator')->getFromJson('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->getFromJson('lang.save'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->getFromJson('lang.id_card'); ?>
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
                            <h3 class="mb-0"> <?php echo app('translator')->getFromJson('lang.id_card'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?> </h3>
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
                                    <th><?php echo app('translator')->getFromJson('lang.title'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.actions'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $id_cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id_card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><a data-toggle="modal" data-target="#showCertificateModal<?php echo e($id_card->id); ?>"  href="#"><?php echo e($id_card->title); ?></a></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->getFromJson('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" data-toggle="modal" data-target="#showCertificateModal<?php echo e($id_card->id); ?>"  href="#">Sample <?php echo app('translator')->getFromJson('lang.view'); ?></a>
                                                 <?php if(in_array(47, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>
                                                <a class="dropdown-item" href="<?php echo e(url('student-id-card/'.$id_card->id.'/edit')); ?>"><?php echo app('translator')->getFromJson('lang.edit'); ?></a>
                                                <?php endif; ?>
                                                 <?php if(in_array(48, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteIDCardModal<?php echo e($id_card->id); ?>"  href="#"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteIDCardModal<?php echo e($id_card->id); ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.delete'); ?> <?php echo app('translator')->getFromJson('lang.id_card'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->getFromJson('lang.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->getFromJson('lang.cancel'); ?></button>
                                                    <?php echo e(Form::open(['url' => 'student-id-card/'.$id_card->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>


                                                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->getFromJson('lang.delete'); ?></button>
                                                    <?php echo e(Form::close()); ?>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade admin-query student-details" id="showCertificateModal<?php echo e($id_card->id); ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.view'); ?> <?php echo app('translator')->getFromJson('lang.id_card'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            

                                            <div class="modal-body">
                                                <div class="white-box radius-t-y-0">
                                                    <div class="text-center mb-4">
                                                        <img class="img-180" src="<?php echo e(asset('public/backEnd/img/student/student-meta-img.png')); ?>" alt="">
                                                    </div>

                                                    <?php if($id_card->student_name == 1): ?>
                                                    <div class="single-meta">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="value text-left">
                                                                    <?php echo app('translator')->getFromJson('lang.student'); ?> <?php echo app('translator')->getFromJson('lang.name'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="name">
                                                                    Bablu Mazumder
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>

                                                    <?php if($id_card->admission_no == 1): ?>
                                                    <div class="single-meta">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="value text-left">
                                                                    <?php echo app('translator')->getFromJson('lang.admission'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="name text-left">
                                                                    9865412365
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>

                                                    <?php if($id_card->class == 1): ?>
                                                    <div class="single-meta">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="value text-left">
                                                                    <?php echo app('translator')->getFromJson('lang.class'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="name">
                                                                    Class 01(Sec A)
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?> 

                                                    <?php if($id_card->father_name == 1): ?>
                                                    <div class="single-meta">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="value text-left">
                                                                    <?php echo app('translator')->getFromJson('lang.father_name'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="name">
                                                                   Dr. Abdul Bari Dos
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>

                                                    <?php if($id_card->mother_name == 1): ?>
                                                    <div class="single-meta">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="value text-left">
                                                                    <?php echo app('translator')->getFromJson('lang.mother_name'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="name">
                                                                   Fatima Anta Dos
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>

                                                    <?php if($id_card->blood == 1): ?>
                                                    <div class="single-meta">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="value text-left">
                                                                    <?php echo app('translator')->getFromJson('lang.blood_group'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="name">
                                                                    B+
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>

                                                    <?php if($id_card->phone == 1): ?>
                                                    <div class="single-meta">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="value text-left">
                                                                    <?php echo app('translator')->getFromJson('lang.phone'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="name">
                                                                    +88019811843300
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>

                                                    <?php if($id_card->dob == 1): ?>
                                                    <div class="single-meta">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="value text-left">
                                                                    <?php echo app('translator')->getFromJson('lang.date_of_birth'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="name">
                                                                    12th Mar, 2019
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>


                                                    <div class="single-meta">
                                                        <div class="row align-items-center">
                                                            <div class="col-lg-6">
                                                                <div class="value text-left">
                                                                    <?php echo e($id_card->designation); ?>

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-5">
                                                                <img class="img-fluid" src="<?php echo e(asset($id_card->signature)); ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="bottom-part text-center mt-5">
                                                        <img class="img-fluid w-25" src="<?php echo e(asset($id_card->logo)); ?>">
                                                        <p class="mb-0 mt-3"><?php echo e($id_card->address); ?> </p>
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