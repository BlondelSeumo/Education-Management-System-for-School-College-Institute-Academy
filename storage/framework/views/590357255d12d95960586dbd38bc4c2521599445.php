<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.update'); ?> <?php echo app('translator')->getFromJson('lang.general_settings'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="<?php echo e(url('general-settings')); ?>"><?php echo app('translator')->getFromJson('lang.general_settings'); ?> <?php echo app('translator')->getFromJson('lang.view'); ?></a>
              </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6">
                <div class="main-title">
                    <h3 class="mb-30">
                        <?php echo app('translator')->getFromJson('lang.update'); ?>
                   </h3>
                </div>
            </div>
        </div>
       
        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'update-general-settings-data', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

        










        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <div class="">
                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>"> 
                        <div class="row mb-40">
                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('school_name') ? ' is-invalid' : ''); ?>"
                                    type="text" name="school_name" autocomplete="off" value="<?php echo e(isset($editData)? $editData->school_name : old('school_name')); ?>">
                                    <label><?php echo app('translator')->getFromJson('lang.school_name'); ?> <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('school_name')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('school_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('site_title') ? ' is-invalid' : ''); ?>"
                                    type="text" name="site_title" autocomplete="off" value="<?php echo e(isset($editData)? $editData->site_title : old('site_title')); ?>">
                                    <label><?php echo app('translator')->getFromJson('lang.site_title'); ?> <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('site_title')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('site_title')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('session_id') ? ' is-invalid' : ''); ?>" name="session_id" id="session_id">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_session'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select'); ?></option>
                                        <?php $__currentLoopData = $academic_years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value->id); ?>"
                                        <?php if(isset($editData)): ?>
                                        <?php if($editData->session_id == $value->id): ?>
                                        selected
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        ><?php echo e($value->year); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('session_id')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('session_id')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('school_code') ? ' is-invalid' : ''); ?>"
                                    type="text" name="school_code" autocomplete="off" value="<?php echo e(isset($editData)? $editData->school_code: old('school_code')); ?>">
                                    <label><?php echo app('translator')->getFromJson('lang.school_code'); ?> <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('school_code')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('school_code')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>


                        </div>

                        <div class="row mb-40">
                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?>"
                                    type="number" name="phone" autocomplete="off" value="<?php echo e(isset($editData)? $editData->phone: old('phone')); ?>">
                                    <label><?php echo app('translator')->getFromJson('lang.phone'); ?> <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('phone')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                                    type="text" name="email" autocomplete="off" value="<?php echo e(isset($editData)? $editData->email: old('email')); ?>">
                                    <label><?php echo app('translator')->getFromJson('lang.email'); ?> <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                           <div class="col-lg-3">
                                <div class="input-effect">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('language_id') ? ' is-invalid' : ''); ?>" name="language_id" id="language_id">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.language'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select'); ?> <span>*</span></option>
                                        <?php if(isset($languages)): ?>
                                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value->id); ?>"
                                        <?php if(isset($editData)): ?>
                                        <?php if($editData->language_id == $value->id): ?>
                                        selected
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        ><?php echo e($value->language_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('language_id')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('language_id')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('date_format_id') ? ' is-invalid' : ''); ?>" name="date_format_id" id="date_format_id">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_date_format'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select'); ?> <span>*</span></option>
                                        <?php if(isset($dateFormats)): ?>
                                        <?php $__currentLoopData = $dateFormats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value->id); ?>"
                                        <?php if(isset($editData)): ?>
                                        <?php if($editData->date_format_id == $value->id): ?>
                                        selected
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        ><?php echo e($value->normal_view); ?> [<?php echo e($value->format); ?>]</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('date_format_id')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('date_format_id')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>

                        <div class="row mb-40">

                            

                            <div class="col-lg-3">
                                    <div class="input-effect">
                                         <select name="time_zone" class="niceSelect w-100 bb form-control <?php echo e($errors->has('time_zone') ? ' is-invalid' : ''); ?>" id="time_zone">
                                            <option data-display="<?php echo app('translator')->getFromJson('lang.select'); ?> <?php echo app('translator')->getFromJson('lang.time_zone'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select'); ?> <?php echo app('translator')->getFromJson('lang.time_zone'); ?> *</option>

                                            <?php $__currentLoopData = $time_zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time_zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($time_zone->id); ?>" <?php echo e($time_zone->id == $editData->time_zone_id? 'selected':''); ?>><?php echo e($time_zone->time_zone); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      

                                             
                                        </select>

                                        <span class="focus-border"></span>
                                            <?php if($errors->has('time_zone')): ?>
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong><?php echo e($errors->first('time_zone')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        
                                       
                                     </div>
                                </div>



                                <div class="col-lg-3">
                                    <div class="input-effect">
                                         <select name="currency" class="niceSelect w-100 bb form-control <?php echo e($errors->has('currency') ? ' is-invalid' : ''); ?>" id="currency">
                                            <option data-display="<?php echo app('translator')->getFromJson('lang.select_currency'); ?>" value=""><?php echo app('translator')->getFromJson('lang.select_currency'); ?></option>
                                             <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($currency->code); ?>" <?php echo e(isset($editData)? ($editData->currency  == $currency->code? 'selected':''):''); ?>><?php echo e($currency->name); ?> (<?php echo e($currency->code); ?>)</option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('currency')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('currency')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                       
                                     </div>
                                </div>


                            


                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('currency_symbol') ? ' is-invalid' : ''); ?>"
                                    type="text" name="currency_symbol" autocomplete="off" value="<?php echo e(isset($editData)? $editData->currency_symbol : old('currency_symbol')); ?>" id="currency_symbol" readonly="">
                                    <label><?php echo app('translator')->getFromJson('lang.currency_symbol'); ?> <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('currency_symbol')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('currency_symbol')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                        <div class="row md-30">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                <textarea class="primary-input form-control" cols="0" rows="4" name="address" id="address"><?php echo e(isset($editData) ? $editData->address : old('address')); ?></textarea>
                                    <label><?php echo app('translator')->getFromJson('lang.school_address'); ?> <span></span> </label>
                                    <span class="focus-border textarea"></span>

                                </div>
                            </div>
                        </div>
                        <div class="row md-30 mt-40">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                <textarea class="primary-input form-control" cols="0" rows="4" name="copyright_text" id="copyright_text"><?php echo e(isset($editData) ? $editData->copyright_text : old('copyright_text')); ?></textarea>
                                    <label><?php echo app('translator')->getFromJson('lang.copyright_text'); ?> <span></span> </label>
                                    <span class="focus-border textarea"></span>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-40">
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="primary-btn fix-gr-bg">
                                <span class="ti-check"></span>
                                <?php echo app('translator')->getFromJson('lang.update'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo e(Form::close()); ?>

    </div>
    
</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>