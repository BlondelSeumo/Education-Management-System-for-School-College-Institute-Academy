<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-50 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.book_list'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.library'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.book_list'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
    <div class="row mt-50">
        <div class="col-lg-12">
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
                                <th><?php echo app('translator')->getFromJson('lang.book_title'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.book'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.isbn'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.category'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.subject'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.publisher'); ?> <?php echo app('translator')->getFromJson('lang.name'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.author_name'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.quantity'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.price'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                        
                            <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($value->book_title); ?></td>
                                <td><?php echo e($value->book_number); ?></td>
                                <td><?php echo e($value->isbn_no); ?></td>
                                <td>
                                <?php if(!empty($value->book_category_id)): ?>
                                    <?php echo e((@$value->book_category_id != "")? $value->category_name:''); ?>

                                <?php endif; ?>
                                </td>
                                <td>
                                <?php if(!empty($value->subject_id)): ?>
                                    <?php echo e((@$value->subject_id != "")? $value->subject_name:''); ?> 
                                <?php endif; ?>
                                </td>
                                <td><?php echo e($value->publisher_name); ?></td>
                                <td><?php echo e($value->author_name); ?></td>
                                <td><?php echo e($value->quantity); ?></td>
                               <td><?php echo e($value->book_price); ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            <?php echo app('translator')->getFromJson('lang.select'); ?>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                           <?php if(in_array(302, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                                            <a class="dropdown-item" href="<?php echo e(url('edit-book/'.$value->id)); ?>"><?php echo app('translator')->getFromJson('lang.edit'); ?></a>
<?php endif; ?>
 <?php if(in_array(303, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                                        <a class="deleteUrl dropdown-item" data-modal-size="modal-md" title="Delete Book" href="<?php echo e(url('delete-book-view/'.$value->id)); ?>"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>