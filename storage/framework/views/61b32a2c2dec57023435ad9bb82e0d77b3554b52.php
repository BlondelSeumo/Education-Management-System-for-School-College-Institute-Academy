<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('public/backEnd/')); ?>/css/croppie.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php
function showPicName($data){
$name = explode('/', $data);
return $name[3];
}
?>
<style type="text/css">
    .form-control:disabled{
        background-color: #FFFFFF;
    }
</style>
<input type="text" hidden id="urlStaff" value="<?php echo e(route('staffPicStore')); ?>">
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Add New Staff</h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>">Dashboard</a>
                <a href="#">Human Resource</a>
                <a href="#">Add New Staff</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">Staff Information </h3>
                </div>
            </div>
            <div class="col-lg-4 text-md-right text-left col-md-6 mb-30-lg">
                <a href="<?php echo e(route('staff_directory')); ?>" class="primary-btn small fix-gr-bg">
                    All Staff List
                </a>
            </div>
        </div>
        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'staffStore', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h4>Basic Info</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-lg-12">
                            <hr>
                        </div>
                    </div>

                    <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>"> 
                    <div class="row mb-30">
                        <div class="col-lg-3">
                            <div class="input-effect">
                                <input class="primary-input form-control<?php echo e($errors->has('staff_no') ? ' is-invalid' : ''); ?>" type="text"  name="staff_no" value="<?php echo e($max_staff_no != ''? $max_staff_no + 1 : 1); ?>" readonly>
                                <span class="focus-border"></span>
                                <label>Staff No <span>*</span> </label>
                                <?php if($errors->has('staff_no')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('staff_no')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="input-effect">
                                <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('role_id') ? ' is-invalid' : ''); ?>" name="role_id" id="role_id">

                                    <option data-display="Role *" value="">Select</option>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>" <?php echo e((old("role_id") ==  $value->id? "selected":"")); ?>><?php echo e($value->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="focus-border"></span>
                                <?php if($errors->has('role_id')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('role_id')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="input-effect">
                                <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('department_id') ? ' is-invalid' : ''); ?>" name="department_id" id="department_id">
                                    <option data-display="Department *" value="">Select </option>
                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>" <?php echo e(old('department_id')==$value->id? 'selected': ''); ?>  ><?php echo e($value->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="focus-border"></span>
                                <?php if($errors->has('department_id')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('department_id')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-effect">
                                <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('designation_id') ? ' is-invalid' : ''); ?>" name="designation_id" id="designation_id">
                                    <option data-display="Designations *" value="">SELECT </option>
                                    <?php $__currentLoopData = $designations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>" <?php echo e(old('designation_id')==$value->id? 'selected': ''); ?> ><?php echo e($value->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="focus-border"></span>
                                <?php if($errors->has('designation_id')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('designation_id')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-30">
                        <div class="col-lg-3">
                            <div class="input-effect">
                                <input class="primary-input form-control <?php echo e($errors->has('first_name') ? 'is-invalid' : ' '); ?>" type="text"  name="first_name" value="<?php echo e(old('first_name')); ?>">
                                <span class="focus-border"></span>
                                <label>First Name <span>*</span> </label>
                                <?php if($errors->has('first_name')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('first_name')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-effect">
                                <input class="primary-input form-control<?php echo e($errors->has('last_name') ? ' is-invalid' : ''); ?>" type="text"  name="last_name" value="<?php echo e(old('last_name')); ?>">
                                <span class="focus-border"></span>
                                <label>Last Name <span>*</span> </label>
                                <?php if($errors->has('last_name')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('last_name')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-effect">
                                <input class="primary-input form-control<?php echo e($errors->has('fathers_name') ? ' is-invalid' : ''); ?>" type="text"  name="fathers_name" value="<?php echo e(old('first_name')); ?>">
                                <span class="focus-border"></span>
                                <label>Father's Name</label>
                                <?php if($errors->has('fathers_name')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('fathers_name')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-effect">
                                <input class="primary-input form-control<?php echo e($errors->has('mothers_name') ? ' is-invalid' : ''); ?>" type="text" name="mothers_name" value="<?php echo e(old('mothers_name')); ?>">
                                <span class="focus-border"></span>
                                <label>Mother's Name</label>
                                <?php if($errors->has('mothers_name')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('mothers_name')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-30">
                       <div class="col-lg-3">
                        <div class="input-effect">
                            <input class="primary-input form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" type="email"  name="email" value="<?php echo e(old('email')); ?>">
                            <span class="focus-border"></span>
                            <label>Email <span>*</span> </label>
                            <?php if($errors->has('email')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="input-effect">
                            <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('gender_id') ? ' is-invalid' : ''); ?>" name="gender_id">
                                <option data-display="Gender *" value="">Gender *</option>
                                <?php $__currentLoopData = $genders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($gender->id); ?>" <?php echo e(old('gender_id') == $gender->id? 'selected': ''); ?>><?php echo e($gender->base_setup_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span class="focus-border"></span>
                            <?php if($errors->has('gender_id')): ?>
                            <span class="invalid-feedback invalid-select" role="alert">
                                <strong><?php echo e($errors->first('gender_id')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="no-gutters input-right-icon">
                            <div class="col">
                                <div class="input-effect">
                                    <input class="primary-input date form-control<?php echo e($errors->has('date_of_birth') ? ' is-invalid' : ''); ?>" id="startDate" type="text"
                                     name="date_of_birth" value="<?php echo e(old('date_of_birth')); ?>" autocomplete="off">
                                    <span class="focus-border"></span>
                                    <label>Date of Birth</label>
                                    <?php if($errors->has('date_of_birth')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('date_of_birth')); ?></strong>
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
                    </div>
                    <div class="col-lg-3">
                        <div class="no-gutters input-right-icon">
                            <div class="col">
                                <div class="input-effect">
                                    <input class="primary-input date form-control<?php echo e($errors->has('date_of_joining') ? ' is-invalid' : ''); ?>" id="date_of_joining" type="text"
                                     name="date_of_joining" value="<?php echo e(date('m/d/Y')); ?>">
                                    <span class="focus-border"></span>
                                    <label>Date of Joining <span>*</span> </label>
                                    <?php if($errors->has('date_of_joining')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('date_of_joining')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="" type="button">
                                    <i class="ti-calendar" id="date_of_joining"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-20">
                 <div class="col-lg-3">
                    <div class="input-effect">
                        <input class="primary-input form-control<?php echo e($errors->has('mobile') ? ' is-invalid' : ''); ?>" type="text"  name="mobile" value="<?php echo e(old('mobile')); ?>">
                        <span class="focus-border"></span>
                        <label>Mobile <span>*</span> </label>
                        <?php if($errors->has('mobile')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('mobile')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="input-effect">
                        <select class="niceSelect w-100 bb form-control" name="marital_status">
                            <option data-display="Marital Status" value="">Marital Status</option>
                            
                            <option <?php echo e(old('marital_status') == 'married'? 'selected': ''); ?> value="married">Married</option>
                            <option <?php echo e(old('marital_status') == 'unmarried'? 'selected': ''); ?> value="unmarried">Unmarried</option>
                            
                        </select>
                        <span class="focus-border"></span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="input-effect">
                        <input class="primary-input form-control<?php echo e($errors->has('emergency_mobile') ? ' is-invalid' : ''); ?>" type="text"  name="emergency_mobile" value="<?php echo e(old('emergency_mobile')); ?>">
                        <span class="focus-border"></span>
                        <label>Emergency Mobile </label>
                        <?php if($errors->has('emergency_mobile')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('emergency_mobile')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-lg-3">
                    <div class="input-effect">
                        <input class="primary-input form-control<?php echo e($errors->has('driving_license') ? ' is-invalid' : ''); ?>" type="text"  name="driving_license" value="<?php echo e(old('driving_license')); ?>">
                        <span class="focus-border"></span>
                        <label>Driving License </label>
                        <?php if($errors->has('driving_license')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('driving_license')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                

            </div>
            <div class="row mb-20">
                <div class="col-lg-6">
                    <div class="row no-gutters input-right-icon">
                        <div class="col">
                            <div class="input-effect">

                                <input class="primary-input form-control <?php echo e($errors->has('staff_photo') ? ' is-invalid' : ''); ?>" type="text" id="placeholderStaffsName" 
                                placeholder="<?php echo e(isset($editData->file) && $editData->file != '' ? showPicName($editData->file):'Staff Photo *'); ?>"
                                disabled> 
                                <span class="focus-border"></span>

                                <?php if($errors->has('staff_photo')): ?>
                                     <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('staff_photo')); ?></strong>
                                    </span>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <button class="primary-btn-small-input" type="button">
                                <label class="primary-btn small fix-gr-bg" for="staff_photo">browse</label>
                                <input type="file" class="d-none" name="staff_photo" id="staff_photo">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-30">
                <div class="col-lg-6">
                    <div class="input-effect">
                        <textarea class="primary-input form-control <?php echo e($errors->has('current_address') ? 'is-invalid' : ''); ?>" cols="0" rows="4" name="current_address" id="current_address"><?php echo e(old('current_address')); ?></textarea>
                        <label>Current Address <span>*</span> </label>
                        <span class="focus-border textarea"></span>

                        <?php if($errors->has('current_address')): ?>
                         <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('current_address')); ?></strong>
                        </span>
                        <?php endif; ?> 
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-effect">
                        <textarea class="primary-input form-control <?php echo e($errors->has('permanent_address') ? 'is-invalid' : ''); ?>" cols="0" rows="4"  name="permanent_address" id="permanent_address"><?php echo e(old('permanent_address')); ?></textarea>
                        <label>Permanent Address <span></span> </label>
                        <span class="focus-border textarea"></span>
                         <?php if($errors->has('permanent_address')): ?>
                         <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('permanent_address')); ?></strong>
                        </span>
                        <?php endif; ?> 
                    </div>
                </div>
            </div>
            <div class="row md-20">
                <div class="col-lg-6">
                    <div class="input-effect">
                        <textarea class="primary-input form-control" cols="0" rows="4" name="qualification" id="qualification"><?php echo e(old('qualification')); ?></textarea>
                        <label>Qualifications </label>
                        <span class="focus-border textarea"></span>
                        <?php if($errors->has('qualification')): ?>
                        <span class="danger text-danger">
                            <strong><?php echo e($errors->first('qualification')); ?></strong>
                        </span>
                        <?php endif; ?> 
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-effect">
                        <textarea class="primary-input form-control" cols="0" rows="4"  name="experience" id="experience" value="<?php echo e(old('experience')); ?>"></textarea>
                        <label>Experience </label>
                        <span class="focus-border textarea"></span>
                        <?php if($errors->has('experience')): ?>
                        <span class="danger text-danger">
                            <strong><?php echo e($errors->first('experience')); ?></strong>
                        </span>
                        <?php endif; ?> 
                    </div>
                </div>
            </div>


            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h4>Payroll Details</h4>
                    </div>
                </div>
            </div>
            <div class="row mb-30">
                <div class="col-lg-12">
                    <hr>
                </div>
            </div>
            <div class="row mb-20">
                <div class="col-lg-3">
                   <div class="input-effect">
                    <input class="primary-input form-control<?php echo e($errors->has('epf_no') ? ' is-invalid' : ''); ?>" type="text"  name="epf_no" value="<?php echo e(old('epf_no')); ?>">
                    <label>EPF No</label>
                    <span class="focus-border"></span>
                    <?php if($errors->has('epf_no')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('epf_no')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-3">
               <div class="input-effect">
                   <input class="primary-input form-control<?php echo e($errors->has('basic_salary') ? ' is-invalid' : ''); ?>" type="number"  name="basic_salary" value="<?php echo e(old('basic_salary')); ?>" autocomplete="off">
                   <label>Basic Salary *</label>
                   <span class="focus-border"></span>
                   <?php if($errors->has('basic_salary')): ?>
                   <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($errors->first('basic_salary')); ?></strong>
                </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="input-effect">
                <select class="niceSelect w-100 bb form-control" name="contract_type">
                    <option data-display="Select" value=""> Select</option>
                    <option value="permanent">Permanent </option>
                    <option value="contract"> Contract</option>
                </select>
                <span class="focus-border"></span>

            </div>
        </div>

        <div class="col-lg-3">
           <div class="input-effect">
            <input class="primary-input form-control<?php echo e($errors->has('location') ? ' is-invalid' : ''); ?>" type="text" value="<?php echo e(old('location')); ?>" name="location">
            <label>Location</label>
            <span class="focus-border"></span>
            <?php if($errors->has('location')): ?>
            <span class="invalid-feedback" role="alert">
                <strong><?php echo e($errors->first('location')); ?></strong>
            </span>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>

<div class="row mt-40">
    <div class="col-lg-12">
        <div class="main-title">
            <h4>Bank Info Details</h4>
        </div>
    </div>
</div>
<div class="row mb-30">
    <div class="col-lg-12">
        <hr>
    </div>
</div>
<div class="row mb-20">
    <div class="col-lg-3">
       <div class="input-effect">
        <input class="primary-input form-control<?php echo e($errors->has('bank_account_name') ? ' is-invalid' : ''); ?>" type="text"  name="bank_account_name" value="<?php echo e(old('bank_account_name')); ?>">
        <label>Bank Account Name</label>
        <span class="focus-border"></span>

    </div>
</div>

<div class="col-lg-3">
   <div class="input-effect">
    <input class="primary-input form-control<?php echo e($errors->has('bank_account_no') ? ' is-invalid' : ''); ?>" type="text"  name="bank_account_no" value="<?php echo e(old('bank_account_no')); ?>">
    <label>Account No</label>
    <span class="focus-border"></span>

</div>
</div>

<div class="col-lg-3">
   <div class="input-effect">
    <input class="primary-input form-control<?php echo e($errors->has('bank_name') ? ' is-invalid' : ''); ?>" type="text"  name="bank_name" value="<?php echo e(old('bank_name')); ?>">
    <label>Bank Name</label>
    <span class="focus-border"></span>

</div>
</div>

<div class="col-lg-3">
   <div class="input-effect">
    <input class="primary-input form-control<?php echo e($errors->has('bank_brach') ? ' is-invalid' : ''); ?>" type="text"  name="bank_brach" value="<?php echo e(old('bank_brach')); ?>">
    <label>Brach Name</label>
    <span class="focus-border"></span>

</div>
</div>

</div>

<div class="row mt-40">
    <div class="col-lg-12">
        <div class="main-title">
            <h4>Social Links Details</h4>
        </div>
    </div>
</div>
<div class="row mb-30">
    <div class="col-lg-12">
        <hr>
    </div>
</div>
<div class="row mb-20">
    <div class="col-lg-3">
       <div class="input-effect">
        <input class="primary-input form-control<?php echo e($errors->has('facebook_url') ? ' is-invalid' : ''); ?>" type="text" name="facebook_url" value=<?php echo e(old('facebook_url')); ?>>
        <label>Facebook Url</label>
        <span class="focus-border"></span>

    </div>
</div>

<div class="col-lg-3">
   <div class="input-effect">
    <input class="primary-input form-control<?php echo e($errors->has('twiteer_url') ? ' is-invalid' : ''); ?>" type="text"  name="twiteer_url" value="<?php echo e(old('twiteer_url')); ?>">
    <label>Twitter Url</label>
    <span class="focus-border"></span>

</div>
</div>

<div class="col-lg-3">
   <div class="input-effect">
    <input class="primary-input form-control<?php echo e($errors->has('linkedin_url') ? ' is-invalid' : ''); ?>" type="text"  name="linkedin_url" value="<?php echo e(old('linkedin_url')); ?>">
    <label>Linkedin Url</label>
    <span class="focus-border"></span>

</div>
</div>

<div class="col-lg-3">
   <div class="input-effect">
    <input class="primary-input form-control<?php echo e($errors->has('instragram_url') ? ' is-invalid' : ''); ?>" type="text"  name="instragram_url" value="<?php echo e(old('instragram_url')); ?>">
    <label>Instragram Url</label>
    <span class="focus-border"></span>

</div>
</div>

</div>

<div class="row mt-40">
    <div class="col-lg-12">
        <div class="main-title">
            <h4>Document Info</h4>
        </div>
    </div>
</div>
<div class="row mb-30">
    <div class="col-lg-12">
        <hr>
    </div>
</div>

<div class="row mb-20">
   <div class="col-lg-4">
    <div class="row no-gutters input-right-icon">
        <div class="col">
            <div class="input-effect">
                <input class="primary-input" type="text" id="placeholderResume" placeholder="<?php echo e(isset($editData->resume) && $editData->resume != ""? showPicName($editData->resume):'Resume'); ?>"
                readonly>
                <span class="focus-border"></span>
            </div>
        </div>
        <div class="col-auto">
            <button class="primary-btn-small-input" type="button">
                <label class="primary-btn small fix-gr-bg" for="resume">browse</label>
                <input type="file" class="d-none" name="resume" id="resume">
            </button>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="row no-gutters input-right-icon">
        <div class="col">
            <div class="input-effect">
                <input class="primary-input" type="text" id="placeholderJoiningLetter" placeholder="<?php echo e(isset($editData->joining_letter) && $editData->joining_letter != ""? showPicName($editData->joining_letter):'Joining Letter'); ?>"
                readonly>
                <span class="focus-border"></span>
            </div>
        </div>
        <div class="col-auto">
            <button class="primary-btn-small-input" type="button">
                <label class="primary-btn small fix-gr-bg" for="joining_letter">browse</label>
                <input type="file" class="d-none" name="joining_letter" id="joining_letter">
            </button>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="row no-gutters input-right-icon">
        <div class="col">
            <div class="input-effect">
                <input class="primary-input" type="text" id="placeholderOthersDocument" placeholder="<?php echo e(isset($editData->other_document) && $editData->other_document != ""? showPicName($editData->other_document):'Others Documents'); ?>"
                readonly>
                <span class="focus-border"></span>
            </div>
        </div>
        <div class="col-auto">
            <button class="primary-btn-small-input" type="button">
                <label class="primary-btn small fix-gr-bg" for="other_document">browse</label>
                <input type="file" class="d-none" name="other_document" id="other_document">
            </button>
        </div>
    </div>
</div>
</div>
<div class="row mt-40">
    <div class="col-lg-12 text-center">
        <button class="primary-btn fix-gr-bg">
            <span class="ti-check"></span>
            save Staff
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

<div class="modal" id="LogoPic">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Crop Image And Upload</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="resize"></div>
                <button class="btn rotate float-lef" data-deg="90" > 
                <i class="ti-back-right"></i></button>
                <button class="btn rotate float-right" data-deg="-90" > 
                <i class="ti-back-left"></i></button>
                <hr>
                
                <button class="primary-btn fix-gr-bg pull-right" id="upload_logo">Crop</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/croppie.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/editStaff.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>