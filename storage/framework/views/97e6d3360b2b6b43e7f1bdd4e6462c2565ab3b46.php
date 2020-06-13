<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.admission_query'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.admin_section'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.admission_query'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.select_criteria'); ?></h3>
                    </div>
                </div>
                <div class="col-lg-4 text-md-right text-left col-md-6 mb-30-lg">
                        <?php
                        
                        $modules = [];
                        $module_links = [];
                        $permissions = App\SmRolePermission::where('role_id', Auth::user()->role_id)->get();
                        foreach ($permissions as $permission) {
                            $module_links[] = $permission->module_link_id;
                            $modules[] = $permission->moduleLink->module_id;
                        }
                        $modules = array_unique($modules);
                        
                        ?>
                
                    <?php if(in_array(13, $module_links) || Auth::user()->role_id == 1): ?>
                        <button class="primary-btn-small-input primary-btn small fix-gr-bg" type="button" data-toggle="modal" data-target="#addQuery">
                            <span class="ti-plus pr-2"></span>
                            <?php echo app('translator')->getFromJson('lang.add'); ?>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
            

            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'admission-query-search', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

            <div class="row">
                <div class="col-lg-12">
                <div class="white-box">
                    <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                         <input name="date_from" readonly class="primary-input date" type="text" autocomplete="off" value="<?php echo e(isset($date_from)? ($date_from != ""? $date_from:''):''); ?>">
                                         <label><?php echo app('translator')->getFromJson('lang.date_from'); ?></label>
                                        <span class="focus-border"></span>
                                     </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                         <input name="date_to" readonly class="primary-input date" type="text" autocomplete="off" value="<?php echo e(isset($date_to)? ($date_to != ""? $date_to:''):''); ?>">
                                         <label><?php echo app('translator')->getFromJson('lang.date_to'); ?></label>
                                        <span class="focus-border"></span>
                                        
                                     </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                         <select name="source" class="niceSelect w-100 bb form-control">
                                            <option data-display="Select source" value=""><?php echo app('translator')->getFromJson('lang.select_source'); ?></option>
                                             <?php $__currentLoopData = $sources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($source->id); ?>" <?php echo e(isset($source_id)? ($source_id == $source->id? 'selected':''):''); ?>><?php echo e($source->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                       
                                     </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                         <select class="niceSelect w-100 bb form-control" name="status">
                                            <option data-display="<?php echo app('translator')->getFromJson('lang.select_status'); ?>" value=""><?php echo app('translator')->getFromJson('lang.Status'); ?></option>
                                            <option  value="1" <?php echo e(isset($status_id)? ($status_id ==  '1'? 'selected':''):''); ?>><?php echo app('translator')->getFromJson('lang.active'); ?></option>
                                            <option  value="2" <?php echo e(isset($status_id)? ($status_id == '2'? 'selected':''):''); ?>><?php echo app('translator')->getFromJson('lang.inactive'); ?></option>
                                        </select>
                                       
                                     </div>
                                </div>
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        <?php echo app('translator')->getFromJson('lang.search'); ?>
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
                                <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.query_list'); ?></h3>
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
                                        <td colspan="10">
                                            <?php if(session()->has('message-success')): ?>
                                            <div class="alert alert-success">
                                                
                                                <?php echo app('translator')->getFromJson('lang.inserted_message'); ?>
                                            </div>
                                            <?php elseif(session()->has('message-danger')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo app('translator')->getFromJson('lang.error_message'); ?>
                                            </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th><?php echo app('translator')->getFromJson('lang.name'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.phone'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.source'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.query_date'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.last_follow_up_date'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.next_follow_up_date'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.actions'); ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $admission_queries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admission_query): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($admission_query->name); ?></td>
                                        <td><?php echo e($admission_query->phone); ?></td>
                                        <td><?php echo e($admission_query->source != ""? $admission_query->sourceSetup->name:''); ?></td>
                                        <td><?php echo e(App\SmGeneralSettings::DateConvater($admission_query->date)); ?>  </td>
                                        <td>
                                    <?php echo e($admission_query->last_follow_up_date != ""? App\SmGeneralSettings::DateConvater($admission_query->last_follow_up_date):''); ?>


                                        </td>
                                        <td>
                                            <?php echo e($admission_query->next_follow_up_date != ""? App\SmGeneralSettings::DateConvater($admission_query->next_follow_up_date):''); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                    <?php echo app('translator')->getFromJson('lang.select'); ?>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <?php if(in_array(13, $module_links) || Auth::user()->role_id == 1): ?>
                                                       <a class="dropdown-item" href="<?php echo e(route('add_query', [$admission_query->id])); ?>"><?php echo app('translator')->getFromJson('lang.add_query'); ?></a>
                                                    <?php endif; ?>
                                                    <?php if(in_array(14, $module_links) || Auth::user()->role_id == 1): ?>
                                                     <a class="dropdown-item modalLink" data-modal-size="large-modal" title="<?php echo app('translator')->getFromJson('lang.edit'); ?> <?php echo app('translator')->getFromJson('lang.admission_query'); ?>"  href="<?php echo e(route('admission_query_edit', [$admission_query->id])); ?>" ><?php echo app('translator')->getFromJson('lang.edit'); ?></a>
                                                    <?php endif; ?>
                                                    <?php if(in_array(15, $module_links) || Auth::user()->role_id == 1): ?>
                                                     <a class="dropdown-item deleteAdmissionQueryModal" href="#" data-toggle="modal" data-target="#deleteAdmissionQueryModal" data-id="<?php echo e($admission_query->id); ?>"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
                                                    <?php endif; ?>
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

<div class="modal fade admin-query" id="deleteAdmissionQueryModal" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.delete_admission_query'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4><?php echo app('translator')->getFromJson('lang.are_you_sure_to_delete'); ?></h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->getFromJson('lang.cancel'); ?></button>
                     <?php echo e(Form::open(['route' => 'admission_query_delete', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                     <input type="hidden" name="id" value="" id="query_id">
                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->getFromJson('lang.delete'); ?></button>
                     <?php echo e(Form::close()); ?>

                </div>
            </div>

        </div>
    </div>
</div>



<!-- Start Sibling Add Modal -->
<div class="modal fade admin-query" id="addQuery">
    <div class="modal-dialog large-modal modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.admission_query'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'admission_query_store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'admission-query-store'])); ?>

            <div class="modal-body">
                <div class="container-fluid">
                    <form action="">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="input-effect">
                                            <input class="primary-input read-only-input form-control" type="text" name="name" id="name">
                                            <label><?php echo app('translator')->getFromJson('lang.name'); ?><span>*</span></label>
                                            <span class="text-danger" role="alert" id="nameError">
                                                
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-effect">
                                            <input class="primary-input read-only-input form-control" type="text" name="phone" id="phone">
                                            <label><?php echo app('translator')->getFromJson('lang.phone'); ?><span>*</span></label>
                                            <span class="text-danger" role="alert" id="phoneError">
                                               
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-effect">
                                            <input class="primary-input read-only-input form-control" type="text" name="email">
                                            <label><?php echo app('translator')->getFromJson('lang.email'); ?><span></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-25">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="3" name="address" id="address"></textarea>
                                            <label><?php echo app('translator')->getFromJson('lang.address'); ?><span></span> </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="3" name="description" id="description"></textarea>
                                            <label><?php echo app('translator')->getFromJson('lang.description'); ?><span></span> </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-25">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input date form-control" id="startDate" type="text"
                                                        name="date" readonly="true" value="<?php echo e(date('m/d/Y')); ?>">
                                                    <label><?php echo app('translator')->getFromJson('lang.date'); ?></label>
                                                    
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
                                                    <input class="primary-input date form-control" id="endDate" type="text"
                                                         name="next_follow_up_date" autocomplete="off" readonly="true" value="<?php echo e(date('m/d/Y')); ?>">
                                                    <label><?php echo app('translator')->getFromJson('lang.next_follow_up_date'); ?></label>
                                                    
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
                                        <div class="input-effect">
                                            <input class="primary-input read-only-input form-control" type="text" name="assigned">
                                            <label><?php echo app('translator')->getFromJson('lang.assigned'); ?><span></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-25">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <select class="niceSelect w-100 bb" name="reference">
                                            <option data-display="Reference" value=""><?php echo app('translator')->getFromJson('lang.reference'); ?></option>
                                            <?php $__currentLoopData = $references; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reference): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($reference->id); ?>"><?php echo e($reference->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <select class="niceSelect w-100 bb" name="source" id="source">
                                            <option data-display="Source *" value=""><?php echo app('translator')->getFromJson('lang.source'); ?>*</option>
                                            <?php $__currentLoopData = $sources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($source->id); ?>"><?php echo e($source->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <span class="text-danger" role="alert" id="sourceError">
                                            
                                        </span>
                                    </div>
                                    <div class="col-lg-3">
                                        <select class="niceSelect w-100 bb" name="class" id="class">
                                            <option data-display="Class" value=""><?php echo app('translator')->getFromJson('lang.class'); ?></option>
                                            <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($class->id); ?>"><?php echo e($class->class_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-effect">
                                            <input class="primary-input read-only-input form-control" type="number" name="no_of_child">
                                            <label><?php echo app('translator')->getFromJson('lang.number_of_child'); ?><span></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 text-center mt-40">
                                <div class="mt-40 d-flex justify-content-between">
                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->getFromJson('lang.cancel'); ?></button>

                                    <button class="primary-btn fix-gr-bg" id="save_button_query" type="submit"><?php echo app('translator')->getFromJson('lang.save'); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php echo e(Form::close()); ?>


        </div>
    </div>
</div>
<!-- End Sibling Add Modal -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>