<?php $__env->startSection('mainContent'); ?>
<?php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } ?>

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.item_sell'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.inventory'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.item_sell'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8 col-md-6">
                
            </div>
             <?php if(in_array(340, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
            <div class="col-lg-4 text-md-right text-left col-md-6 mb-30-lg">
                <a href="<?php echo e(url('item-sell')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->getFromJson('lang.new'); ?> <?php echo app('translator')->getFromJson('lang.item_sell'); ?>
                </a>
            </div>
            <?php endif; ?>
        </div>

 <div class="row mt-40">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.item_sell'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></h3>
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
                                <th><?php echo app('translator')->getFromJson('lang.reference'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.role'); ?> <?php echo app('translator')->getFromJson('lang.name'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.buyer'); ?> <?php echo app('translator')->getFromJson('lang.name'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.date'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.grand_total'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.total_quantity'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.paid'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.balance'); ?> (<?php echo e($currency); ?>)</th>
                                <th><?php echo app('translator')->getFromJson('lang.Status'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if(isset($allItemSellLists)): ?>
                            <?php $__currentLoopData = $allItemSellLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($value->reference_no); ?></td>
                                <td><?php echo e($value->roles->name); ?></td>
                                <?php if($value->role_id == 2): ?>
                                <?php
                                $getBuyerDetails = $value->studentDetails;
                                ?>


                                <?php elseif($value->role_id == 3): ?>

                                <?php
                                $getBuyerDetails = $value->parentsDetails;
                                ?>

                                <?php else: ?>

                                <?php
                                $getBuyerDetails = $value->staffDetails;
                                ?>
                                <?php endif; ?>

                                <td>
                                <?php if(!empty($getBuyerDetails)): ?>
                                <?php echo e($value->role_id == 3? $getBuyerDetails->fathers_name:$getBuyerDetails->full_name); ?>

                                <?php endif; ?>
                                </td>
                                <td  data-sort="<?php echo e(strtotime($value->sell_date)); ?>" >
                                   <?php echo e($value->sell_date != ""? App\SmGeneralSettings::DateConvater($value->sell_date):''); ?> 
                                </td>
                                
                                <td><?php echo e(number_format( (float) $value->grand_total, 2, '.', '')); ?></td>
                                <td><?php echo e($value->total_quantity); ?></td>
                                <td><?php echo e(number_format( (float) $value->total_paid, 2, '.', '')); ?></td>
                                <td><?php echo e(number_format( (float) $value->total_due, 2, '.', '')); ?></td>
                                <td>
                                    <?php if($value->paid_status == 'P'): ?>
                                    <button class="primary-btn small bg-success text-white border-0"><?php echo app('translator')->getFromJson('lang.paid'); ?></button>
                                    <?php elseif($value->paid_status == 'PP'): ?>
                                    <button class="primary-btn small bg-warning text-white border-0"><?php echo app('translator')->getFromJson('lang.partial_paid'); ?></button>
                                    <?php elseif($value->paid_status == 'U'): ?>
                                    <button class="primary-btn small bg-danger text-white border-0"><?php echo app('translator')->getFromJson('lang.unpaid'); ?></button>
                                    <?php else: ?>
                                    <button class="primary-btn small bg-info text-white border-0"><?php echo app('translator')->getFromJson('lang.refund'); ?></button>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            <?php echo app('translator')->getFromJson('lang.select'); ?>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="<?php echo e(url('view-item-sell', $value->id)); ?>"><?php echo app('translator')->getFromJson('lang.view'); ?></a>
                                            <?php
                                            $itemPaymentdetails = App\SmInventoryPayment::itemPaymentdetails($value->id);
                                            ?>

                                            <?php if($value->paid_status != 'R'): ?>
                                            <?php if($itemPaymentdetails == 0): ?>
                                             <?php if(in_array(341, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                                            <a class="dropdown-item" href="<?php echo e(url('edit-item-sell', 
                                            $value->id)); ?>"><?php echo app('translator')->getFromJson('lang.edit'); ?></a>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php endif; ?>

                                             <?php if($value->paid_status != 'R'): ?>
                                             <?php if($value->total_due > 0): ?>
                                              <?php if(in_array(343, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                                             <a class="dropdown-item modalLink" title="Add Payment" data-modal-size="modal-md" href="<?php echo e(url('add-payment-sell', $value->id)); ?>"><?php echo app('translator')->getFromJson('lang.add'); ?> <?php echo app('translator')->getFromJson('lang.payment'); ?></a>
                                             <?php endif; ?>
                                             <?php endif; ?>
                                             <?php endif; ?>

                                             <?php if($value->paid_status != 'P'): ?>
                                               <?php if(in_array(344, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                                             <a class="dropdown-item modalLink" data-modal-size="modal-lg" title="View Payments" href="<?php echo e(url('view-sell-payments', $value->id)); ?>"><?php echo app('translator')->getFromJson('lang.view'); ?> <?php echo app('translator')->getFromJson('lang.payment'); ?></a>
                                              <?php endif; ?>
                                              <?php endif; ?>

                                                <?php if($value->paid_status != 'R'): ?>
                                                <?php if($value->total_paid == 0): ?>
                                                 <?php if(in_array(342, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                                                <a class="dropdown-item deleteUrl" data-modal-size="modal-md" title="Delete Sold Item" href="<?php echo e(url('delete-item-sale-view', $value->id)); ?>"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if($value->paid_status != 'R'): ?>
                                                <?php if($value->total_paid>0): ?>

                                                <a class="dropdown-item deleteUrl" data-modal-size="modal-md" title="Cancel Item Sell" href="<?php echo e(url('cancel-item-sell-view', $value->id)); ?>"><?php echo app('translator')->getFromJson('lang.cancel'); ?></a>
                                                <?php endif; ?>
                                                <?php endif; ?>

                                           
                                        </div>
                                    </div>
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