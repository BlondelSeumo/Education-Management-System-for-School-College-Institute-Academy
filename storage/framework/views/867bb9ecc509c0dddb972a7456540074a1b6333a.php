<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.backup_settings'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.system_settings'); ?></a>
                <a href="<?php echo e(url('sms-settings')); ?>"><?php echo app('translator')->getFromJson('lang.backup_settings'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.upload_from_local_directory'); ?></h3>
                        </div>
                        <?php if(isset($session)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'session/'.$session->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'backup-store',
                        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">

                                <div class="row no-gutters input-right-icon mb-20">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control <?php echo e($errors->has('content_file') ? ' is-invalid' : ''); ?>" readonly="true" type="text"
                                            placeholder="<?php echo e(isset($editData->file) && $editData->file != ""? showPicName($editData->file):'Upload File'); ?> "  id="placeholderUploadContent" name="content_file">
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
                                            <label class="primary-btn small fix-gr-bg" for="upload_content_file"><?php echo app('translator')->getFromJson('lang.browse'); ?></label>
                                            <input type="file" class="d-none form-control" name="content_file" id="upload_content_file">
                                        </button>

                                    </div>
                                </div>

                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">

                    
                   

                                        <button class="primary-btn fix-gr-bg">
                                            <span class="ti-check"></span>
                                            <?php if(isset($session)): ?>
                                                <?php echo app('translator')->getFromJson('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->getFromJson('lang.save'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->getFromJson('lang.file'); ?>
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
                            <h3 class="mb-0"> <?php echo app('translator')->getFromJson('lang.database_backup_list'); ?></h3>
                        </div>
                    </div>
                    <div class="offset-lg-12 col-lg-12 text-right col-md-12 mb-20">


                    
                    

                        <a href="<?php echo e(url('get-backup-files/1')); ?>" class="primary-btn small fix-gr-bg  demo_view">
                            <span class="ti-arrow-circle-down pr-2"></span>
                            Images <?php echo app('translator')->getFromJson('lang.backup'); ?>
                        </a>
                        <a href="<?php echo e(url('get-backup-files/2')); ?>" class="primary-btn small fix-gr-bg  demo_view">
                            <span class="ti-arrow-circle-down pr-2"></span>
                            Full Project <?php echo app('translator')->getFromJson('lang.backup'); ?>
                       </a>
                        <a href="<?php echo e(url('get-backup-db')); ?>" class="primary-btn small fix-gr-bg demo_view"> <span class="ti-arrow-circle-down pr-2"></span> Database <?php echo app('translator')->getFromJson('lang.backup'); ?> </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                        <table class="display school-table school-table-style" cellspacing="0" width="100%">
                            <thead>


                                <?php if(session()->has('message-success') != "" ||
                                    session()->get('message-danger') != ""): ?>
                                    <tr>
                                        <td colspan="5">
                                            <?php if(session()->has('message-success')): ?>
                                                <div class="alert alert-success">
                                                    <?php echo e(session()->get('message-success')); ?>

                                                </div>
                                                <?php elseif(session()->has('message-danger')): ?>
                                                    <div class="alert alert-danger">
                                                <?php echo e(session()->get('message-danger')); ?>

                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>

                                <tr>
                                    <th>Size</th>
                                    <th><?php echo app('translator')->getFromJson('lang.created_date_time'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.backup_files'); ?></th>
                                    <th>File Type</th>
                                    <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $sms_dbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sms_db): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php
                                        if(file_exists($sms_db->source_link)){
                                        $size = filesize($sms_db->source_link);
                                            $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                                            $power = $size > 0 ? floor(log($size, 1024)) : 0;
                                            echo number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
                                        }else{
                                            echo 'File already deleted.';
                                        }
                                        ?>
                                    </td>
                                    <td> 
                                        <?php echo e($sms_db->created_at != ""? App\SmGeneralSettings::DateConvater($sms_db->created_at):''); ?>


                                    </td>
                                    <td><?php echo e($sms_db->file_name); ?></td>
                                    <td>
                                        <?php
                                        if($sms_db->file_type == 0){
                                            echo 'Database';
                                        }else if($sms_db->file_type==1){
                                            echo 'Images';
                                        }else{
                                            echo 'Whole Project';
                                        }
                                        ?>
                                    </td>
                                    <td>

                    
                    

                                        <a  class="primary-btn small tr-bg  " href="<?php echo e(url('/download-files/'.$sms_db->id)); ?>"  >
                                            <span class="pl ti-download"></span> <?php echo app('translator')->getFromJson('lang.download'); ?>
                                        </a>

                                        <?php
                                        if($sms_db->file_type == 10){
                                        ?> 
                                           
                                            <a  class="primary-btn small tr-bg  " href="<?php echo e(url('/restore-database/'.$sms_db->id)); ?>"  >
                                                <span class="pl ti-upload"></span>  <?php echo app('translator')->getFromJson('lang.restore'); ?>
                                           </a>
                                        <?php
                                        } 
                                        ?>


                                       <a data-target="#deleteDatabase<?php echo e($sms_db->id); ?>" data-toggle="modal" class="primary-btn small tr-bg  " href="<?php echo e(url('/'.$sms_db->id)); ?>"  >
                                            <span class="pl ti-close"></span>  <?php echo app('translator')->getFromJson('lang.delete'); ?>
                                        </a>

                                    </td>
                                </tr>



                                  <div class="modal fade admin-query" id="deleteDatabase<?php echo e($sms_db->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"> <?php echo app('translator')->getFromJson('lang.delete'); ?>  <?php echo app('translator')->getFromJson('lang.item'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4> <?php echo app('translator')->getFromJson('lang.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"> <?php echo app('translator')->getFromJson('lang.cancel'); ?></button>
                                                    <a href="<?php echo e(route('delete_database', [$sms_db->id])); ?>" class="text-light">
                                                    <button class="primary-btn fix-gr-bg" type="submit"> <?php echo app('translator')->getFromJson('lang.delete'); ?></button>
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
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>