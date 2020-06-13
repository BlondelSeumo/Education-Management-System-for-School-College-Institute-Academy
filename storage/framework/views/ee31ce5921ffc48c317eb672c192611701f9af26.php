<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
  <div class="container-fluid">
    <div class="row justify-content-between">
      <h1><?php echo app('translator')->getFromJson('lang.issue_item'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></h1>
      <div class="bc-pages">
        <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
        <a href="#"><?php echo app('translator')->getFromJson('lang.inventory'); ?></a>
        <a href="#"><?php echo app('translator')->getFromJson('lang.issue_item'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></a>
      </div>
    </div>
  </div>
</section>
<style type="text/css">
  #selectStaffsDiv, .forStudentWrapper{
    display: none;
  }
</style>
<section class="admin-visitor-area up_st_admin_visitor">
  <div class="container-fluid p-0">
    <div class="row">
     
      <div class="col-lg-3">
        <div class="row">
          <div class="col-lg-12">
            <div class="main-title">
              <h3 class="mb-30">
                  <?php echo app('translator')->getFromJson('lang.issue_a_item'); ?>
              </h3>
            </div>
            <?php if(isset($editData)): ?>
            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'holiday/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

            <?php else: ?>
             <?php if(in_array(346, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'save-item-issue-data',
            'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

            <?php endif; ?>
            <?php endif; ?>
            <div class="white-box">
              <div class="add-visitor">
                <div class="row">
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
                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('role_id') ? ' is-invalid' : ''); ?>" name="role_id" id="member_type">
                      <option data-display=" <?php echo app('translator')->getFromJson('lang.user_type'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.user_type'); ?> *</option>
                      <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if(isset($editData)): ?>
                      <option value="<?php echo e($value->id); ?>" <?php echo e($value->id == $editData->role_id? 'selected':''); ?>><?php echo e($value->name); ?></option>
                      <?php else: ?>
                      <option value="<?php echo e($value->id); ?>" <?php echo e(old('role_id')!=''? (old('role_id') == $value->id? 'selected':''):''); ?> ><?php echo e($value->name); ?></option>
                      <?php endif; ?>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('role_id')): ?>
                    <span class="invalid-feedback invalid-select" role="alert">
                      <strong><?php echo e($errors->first('role_id')); ?></strong>
                    </span>
                    <?php endif; ?>
                  </div>

                  <div class="forStudentWrapper col-lg-12">
                    <div class="row">
                      <div class="col-lg-12 mb-30">
                        <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                          <option data-display="<?php echo app('translator')->getFromJson('lang.select_class'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_class'); ?> *</option>
                          <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($class->id); ?>"  <?php echo e(( old("class") == $class->id ? "selected":"")); ?>><?php echo e($class->class_name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('class')): ?>
                        <span class="invalid-feedback invalid-select" role="alert">
                          <strong><?php echo e($errors->first('class')); ?></strong>
                        </span>
                        <?php endif; ?>
                      </div>

                      <div class="col-lg-12 mb-30" id="select_section_div">
                        <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
                          <option data-display="<?php echo app('translator')->getFromJson('lang.select_section'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_section'); ?> *</option>
                        </select>
                        <?php if($errors->has('section')): ?>
                        <span class="invalid-feedback invalid-select" role="alert">
                          <strong><?php echo e($errors->first('section')); ?></strong>
                        </span>
                        <?php endif; ?>
                      </div>


                      <div class="col-lg-12 mb-30" id="select_student_div">
                        <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('student') ? ' is-invalid' : ''); ?>" id="select_student" name="student">
                          <option data-display="<?php echo app('translator')->getFromJson('lang.select_student'); ?>*" value=""><?php echo app('translator')->getFromJson('lang.select_student_for_issue'); ?> *</option>
                        </select>
                        <?php if($errors->has('student')): ?>
                        <span class="invalid-feedback invalid-select" role="alert">
                          <strong><?php echo e($errors->first('student')); ?></strong>
                        </span>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12 mb-30" id="selectStaffsDiv">
                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('staff_id') ? ' is-invalid' : ''); ?>" name="staff_id" id="selectStaffs">
                      <option data-display="<?php echo app('translator')->getFromJson('lang.issue_to'); ?>" value=""><?php echo app('translator')->getFromJson('lang.issue_to'); ?></option>

                      <?php if(isset($staffsByRole)): ?>
                      <?php $__currentLoopData = $staffsByRole; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($value->id); ?>" <?php echo e($value->id == $editData->staff_id? 'selected':''); ?>><?php echo e($value->full_name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>

                      <?php endif; ?>
                    </select>
                    <?php if($errors->has('staff_id')): ?>
                    <span class="invalid-feedback invalid-select" role="alert">
                      <strong><?php echo e($errors->first('staff_id')); ?></strong>
                    </span>
                    <?php endif; ?>
                  </div>

                </div>

                <div class="row no-gutters input-right-icon mb-30 w-100">

                  <div class="col">
                    <div class="input-effect">
                      <input class="primary-input date form-control<?php echo e($errors->has('issue_date') ? ' is-invalid' : ''); ?>" id="startDate" type="text"
                      name="issue_date" value="<?php echo e(isset($editData)? date('m/d/Y', strtotime($editData->issue_date)): date('m/d/Y')); ?>">
                      <label><?php echo app('translator')->getFromJson('lang.issue_date'); ?> <span></span> </label>
                      <span class="focus-border"></span>
                      <?php if($errors->has('issue_date')): ?>
                      <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('issue_date')); ?></strong>
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

                <div class="row no-gutters input-right-icon mb-30 w-100">

                  <div class="col">
                    <div class="input-effect">
                      <input class="primary-input date form-control<?php echo e($errors->has('due_date') ? ' is-invalid' : ''); ?>" id="endDate" type="text"
                      name="due_date" value="<?php echo e(isset($editData)? date('m/d/Y', strtotime($editData->issue_date)): date('m/d/Y')); ?>">
                      <label><?php echo app('translator')->getFromJson('lang.return_date'); ?> <span></span> </label>
                      <span class="focus-border"></span>
                      <?php if($errors->has('due_date')): ?>
                      <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('due_date')); ?></strong>
                      </span>
                      <?php endif; ?>
                    </div>

                  </div>
                  <div class="col-auto">
                    <button class="" type="button">
                      <i class="ti-calendar" id="end-date-icon"></i>
                    </button>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-12 mb-30">
                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('item_category_id') ? ' is-invalid' : ''); ?>" name="item_category_id" id="item_category_id">
                      <option data-display="<?php echo app('translator')->getFromJson('lang.item_category'); ?>" value=""><?php echo app('translator')->getFromJson('lang.item_category'); ?></option>
                      <?php $__currentLoopData = $itemCat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($value->id); ?>" <?php echo e(old('item_category_id') == $value->id? 'selected': ''); ?>><?php echo e($value->category_name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('item_category_id')): ?>
                    <span class="invalid-feedback invalid-select" role="alert">
                      <strong><?php echo e($errors->first('item_category_id')); ?></strong>
                    </span>
                    <?php endif; ?>
                  </div>

                  <div class="col-lg-12 mb-30" id="selectItemsDiv">
                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('item_id') ? ' is-invalid' : ''); ?>" name="item_id" id="selectItems">
                      <option data-display="<?php echo app('translator')->getFromJson('lang.item'); ?><?php echo app('translator')->getFromJson('lang.name'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.item'); ?><?php echo app('translator')->getFromJson('lang.name'); ?> *</option>
                    </select>
                    <?php if($errors->has('item_id')): ?>
                    <span class="invalid-feedback invalid-select" role="alert">
                      <strong><?php echo e($errors->first('item_id')); ?></strong>
                    </span>
                    <?php endif; ?>
                  </div>

                  <div class="col-lg-12 mb-30">
                    <div class="input-effect">
                      <input class="primary-input form-control<?php echo e($errors->has('quantity') ? ' is-invalid' : ''); ?>"
                      type="number" name="quantity" autocomplete="off" value="<?php echo e(old('quantity')); ?>">
                      <label><?php echo app('translator')->getFromJson('lang.quantity'); ?> <span>*</span> </label>
                      <span class="focus-border"></span>
                      <?php if($errors->has('quantity')): ?>
                      <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('quantity')); ?></strong>
                      </span>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-lg-12 mb-30">
                    <div class="input-effect">
                      <textarea class="primary-input form-control" cols="0" rows="4" name="description" id="description"><?php echo e(isset($editData)? $editData->description:old('description')); ?></textarea>
                      <label><?php echo app('translator')->getFromJson('lang.note'); ?> <span></span> </label>
                      <span class="focus-border textarea"></span>

                    </div>
                  </div>
                </div>

                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                  <?php 
                                  $tooltip = "";
                                  if(in_array(346, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                <div class="row mt-40">
                  <div class="col-lg-12 text-center">
                    <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">

                      <span class="ti-check"></span>
                        <?php if(isset($editData)): ?>
                            <?php echo app('translator')->getFromJson('lang.update'); ?>
                        <?php else: ?>
                            <?php echo app('translator')->getFromJson('lang.save'); ?>
                        <?php endif; ?>
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
        <?php if(session()->has('message-success-delete')): ?>
        <div class="alert alert-success mt-50 mb-30">
         <?php echo e(session()->get('message-success-delete')); ?>

       </div>
       <?php elseif(session()->has('message-danger-delete')): ?>
       <div class="alert alert-danger">
        <?php echo e(session()->get('message-danger-delete')); ?>

      </div>
      <?php endif; ?>

      <div class="row">
        <div class="col-lg-4 no-gutters">
          <div class="main-title">
            <h3 class="mb-0"> <?php echo app('translator')->getFromJson('lang.issued_item_list'); ?></h3>
          </div>
        </div>
      </div>

      <div class="row">

        <div class="col-lg-12">
          <table id="table_id" class="display school-table" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th> <?php echo app('translator')->getFromJson('lang.item'); ?> <?php echo app('translator')->getFromJson('lang.name'); ?></th>
                <th> <?php echo app('translator')->getFromJson('lang.item'); ?>  <?php echo app('translator')->getFromJson('lang.category'); ?></th>
                <th> <?php echo app('translator')->getFromJson('lang.issue_to'); ?></th>
                <th> <?php echo app('translator')->getFromJson('lang.issue_date'); ?></th>
                <th> <?php echo app('translator')->getFromJson('lang.return_date'); ?></th>
                <th> <?php echo app('translator')->getFromJson('lang.quantity'); ?></th>
                <th> <?php echo app('translator')->getFromJson('lang.Status'); ?></th>
                <th> <?php echo app('translator')->getFromJson('lang.action'); ?></th>
              </tr>
            </thead>

            <tbody>
              <?php if(isset($issuedItems)): ?>
              <?php $__currentLoopData = $issuedItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>

                <td><?php echo e($value->items!=""?$value->items->item_name:""); ?></td>
                <td><?php echo e($value->categories!=""?$value->categories->category_name:""); ?></td>

                <?php if($value->role_id == 2): ?>
                <?php
                $getMemberDetail = 
                App\SmBook::getMemberDetails($value->issue_to);
                ?>
                <?php else: ?>

                <?php
                $getMemberDetail = 
                App\SmBook::getMemberStaffsDetails($value->issue_to);
                ?>
                <?php endif; ?>

                <td> <?php if(!empty($getMemberDetail)): ?>
                  <?php echo e($getMemberDetail->full_name); ?>

                  <?php endif; ?></td>
                  <td  data-sort="<?php echo e(strtotime($value->issue_date)); ?>" >
                   <?php echo e($value->issue_date != ""? App\SmGeneralSettings::DateConvater($value->issue_date):''); ?>


                  </td>
                  <td  data-sort="<?php echo e(strtotime($value->due_date)); ?>" >
                   <?php echo e($value->due_date != ""? App\SmGeneralSettings::DateConvater($value->due_date):''); ?>



                  </td>

                  <td><?php echo e($value->quantity); ?></td>
                  <td> 
                      <?php if($value->issue_status == 'I'): ?>
                     <button class="primary-btn small bg-success text-white border-0"> <?php echo app('translator')->getFromJson('lang.issued'); ?></button>
                     <?php else: ?>
                      <button class="primary-btn small bg-primary text-white border-0"><?php echo app('translator')->getFromJson('lang.returned'); ?></button>
                     <?php endif; ?>
                  </td>

                   <td>
                   <?php if($value->issue_status == 'I'): ?>
                    <div class="dropdown">
                      <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                          <?php echo app('translator')->getFromJson('lang.select'); ?>
                      </button>
 
                      <div class="dropdown-menu dropdown-menu-right">
                        <?php if(in_array(347, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                       <a class="dropdown-item modalLink" title="Return Item" data-modal-size="modal-md" href="<?php echo e(url('return-item-view/'.$value->id)); ?>"><?php echo app('translator')->getFromJson('lang.return'); ?></a>
                       <?php endif; ?>
                    </div>

                   </div>
                   <?php endif; ?>
                 </td>
               </tr>
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