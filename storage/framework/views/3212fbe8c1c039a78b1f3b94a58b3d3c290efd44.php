<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.admin'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.admin'); ?></a>
                <a href="<?php echo e(route('admission_query')); ?>"><?php echo app('translator')->getFromJson('lang.admission_query'); ?></a>
                <a href="<?php echo e(route('add_query', [$admission_query->id])); ?>"><?php echo app('translator')->getFromJson('lang.follow_up'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="main-title">
                            <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.follow_up_admission_query'); ?></h3>
                        </div>
                    </div>
                </div>
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'query_followup_store', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                <div class="row">
                    <div class="col-lg-12">

                        <div class="white-box">
                            <?php if(session()->has('message-success')): ?>
                              <div class="alert alert-success">
                                  <?php echo e(session()->get('message-success')); ?>

                              </div>
                            <?php elseif(session()->has('message-danger')): ?>
                              <div class="alert alert-danger">
                                  <?php echo e(session()->get('message-danger')); ?>

                              </div>
                            <?php endif; ?>
                            <div class="row mt-30">
                                <input type="hidden" name="id" id="id" value="<?php echo e($admission_query->id); ?>">
                                <div class="col-lg-4">
                                    <div class="no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control<?php echo e($errors->has('follow_up_date') ? ' is-invalid' : ''); ?>" id="startDate" type="text"
                                                     name="follow_up_date" readonly="true" value="<?php echo e(date('m/d/Y', strtotime($admission_query->next_follow_up_date))); ?>">
                                                <label><?php echo app('translator')->getFromJson('lang.follow_up_date'); ?></label>
                                                <?php if($errors->has('follow_up_date')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('follow_up_date')); ?></strong>
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
                                <div class="col-lg-4">
                                    <div class="no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control<?php echo e($errors->has('next_follow_up_date') ? ' is-invalid' : ''); ?>" id="endDate" type="text"
                                                     name="next_follow_up_date" autocomplete="off" readonly="true" readonly="true" value="<?php echo e(old('next_follow_up_date')); ?>">
                                                <label><?php echo app('translator')->getFromJson('lang.next_follow_up_date'); ?><span>*</span></label>
                                                <?php if($errors->has('next_follow_up_date')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('next_follow_up_date')); ?></strong>
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
                                </div>
                                <div class="col-lg-4">
                                    <select class="niceSelect w-100 bb" name="status">
                                        <option value="1" <?php echo e($admission_query->active_status == '1'? 'selected':''); ?>><?php echo app('translator')->getFromJson('lang.active'); ?></option>
                                        <option value="2" <?php echo e($admission_query->active_status == '2'? 'selected':''); ?>><?php echo app('translator')->getFromJson('lang.inactive'); ?></option>
                                    </select>
                                </div> 
                            </div>
                            <div class="row mt-25">
                                <div class="col-lg-6">
                                    <div class="input-effect">
                                        <textarea class="primary-input form-control<?php echo e($errors->has('response') ? ' is-invalid' : ''); ?>" cols="0" rows="3" name="response" id="address"><?php echo e(old('response')); ?></textarea>
                                        <label><?php echo app('translator')->getFromJson('lang.response'); ?> <span>*</span> </label>
                                        <span class="focus-border textarea"></span>
                                        <?php if($errors->has('response')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('response')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-effect">
                                        <textarea class="primary-input form-control" cols="0" rows="3" name="note" id="description"><?php echo e(old('note')); ?></textarea>
                                        <label><?php echo app('translator')->getFromJson('lang.note'); ?> <span></span> </label>
                                        <span class="focus-border textarea"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-30">
                                <div class="col-lg-12 text-center">
                                    <button class="primary-btn fix-gr-bg">
                                        <span class="ti-check"></span>
                                        <?php echo app('translator')->getFromJson('lang.save'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

                <div class="row mt-40">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4 no-gutters">
                                <div class="main-title">
                                    <h3 class="mb-0"> <?php echo app('translator')->getFromJson('lang.follow_up_list'); ?></h3>
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
                                            <td colspan="4">
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
                                            <th><?php echo app('translator')->getFromJson('lang.query_by'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('lang.response'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('lang.note'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $follow_up_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $follow_up_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($follow_up_list->user!=""?$follow_up_list->user->full_name:""); ?></td>
                                            <td><?php echo e($follow_up_list->response); ?></td>
                                            <td><?php echo e($follow_up_list->note); ?></td>
                                            
                                            <td valign="top">
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                        <?php echo app('translator')->getFromJson('lang.select'); ?>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#deletefollowUpQuery<?php echo e($follow_up_list->id); ?>"  href=""><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade admin-query" id="deletefollowUpQuery<?php echo e($follow_up_list->id); ?>" >
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.delete_follow_up_query'); ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <h4><?php echo app('translator')->getFromJson('lang.are_you_sure_to_delete'); ?></h4>
                                                        </div>

                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->getFromJson('lang.cancel'); ?></button>
                                                            <a href="<?php echo e(route('delete_follow_up', [$follow_up_list->id])); ?>" class="text-light primary-btn fix-gr-bg"><?php echo app('translator')->getFromJson('lang.delete'); ?>
                                                             </a>
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
            <div class="col-lg-4 mt-45">
                <div class="student-meta-box">
                    <div class="white-box radius-t-y-0 student-details">
                        <div class="single-meta mt-10">
                            <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.details'); ?> </h3>
                        </div>
                        <div class="single-meta mt-10">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    <?php echo app('translator')->getFromJson('lang.created_by'); ?>:
                                </div>
                                <div class="value">
                                    <?php echo e($admission_query->user !=""?$admission_query->user->full_name:""); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    <?php echo app('translator')->getFromJson('lang.query_date'); ?>:
                                </div>
                                <div class="value">
                                    <?php echo e(!empty($admission_query->date)? App\SmGeneralSettings::DateConvater($admission_query->date):''); ?>

                                   
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    <?php echo app('translator')->getFromJson('lang.last_follow_up_date'); ?>:
                                </div>
                                <div class="value">
                                    <?php echo e(!empty($admission_query->last_follow_up_date)? App\SmGeneralSettings::DateConvater($admission_query->last_follow_up_date):''); ?>

                                    </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    <?php echo app('translator')->getFromJson('lang.next_follow_up_date'); ?>:
                                </div>
                                <div class="value">
                                    <?php echo e(!empty($admission_query->next_follow_up_date)? App\SmGeneralSettings::DateConvater($admission_query->next_follow_up_date):''); ?>

                                    </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    <?php echo app('translator')->getFromJson('lang.phone'); ?>:
                                </div>
                                <div class="value">
                                    <?php echo e($admission_query->phone); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    <?php echo app('translator')->getFromJson('lang.address'); ?>:
                                </div>
                                <div class="value">
                                    <?php echo e($admission_query->address); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    <?php echo app('translator')->getFromJson('lang.reference'); ?>:
                                </div>
                                <div class="value">
                                    <?php echo e($admission_query->reference != ""? $admission_query->referenceSetup->name:""); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    <?php echo app('translator')->getFromJson('lang.description'); ?>:
                                </div>
                                <div class="value">
                                    <?php echo e($admission_query->description); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    <?php echo app('translator')->getFromJson('lang.source'); ?>:
                                </div>
                                <div class="value">
                                    <?php echo e($admission_query->source != ""? $admission_query->sourceSetup->name:""); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    <?php echo app('translator')->getFromJson('lang.assigned'); ?>:
                                </div>
                                <div class="value">
                                    <?php echo e($admission_query->assigned); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    <?php echo app('translator')->getFromJson('lang.email'); ?>:
                                </div>
                                <div class="value">
                                    <?php echo e($admission_query->email); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    <?php echo app('translator')->getFromJson('lang.class'); ?>:
                                </div>
                                <div class="value">
                                    <?php echo e($admission_query->class != ""? $admission_query->className->class_name:""); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    <?php echo app('translator')->getFromJson('lang.number_of_child'); ?>:
                                </div>
                                <div class="value">
                                    <?php echo e($admission_query->no_of_child); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>