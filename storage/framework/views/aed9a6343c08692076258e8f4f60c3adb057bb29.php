<?php $__env->startSection('mainContent'); ?>
<style type="text/css">
    #productTable tbody tr{
        border-bottom: 1px solid #FFFFFF !important;
    }
</style>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.item_receive'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.inventory'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.item_receive'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
       <?php if(isset($editData)): ?>
       <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'item-list/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

       <?php else: ?>
       <?php if(in_array(333, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
       <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'save-item-receive-data',
       'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'item-receive-form'])); ?>

       <?php endif; ?>
       <?php endif; ?>
       <div class="row">
            
        <div class="col-lg-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h3 class="mb-30"><?php if(isset($editData)): ?>
                                <?php echo app('translator')->getFromJson('lang.edit'); ?>
                            <?php else: ?>

                            <?php endif; ?>
                            <?php echo app('translator')->getFromJson('lang.receive_details'); ?>
                        </h3>
                    </div>

                    <div class="white-box">
                        <div class="add-visitor">
                            <div class="row">
                                

                                <div class="col-lg-12 mb-30">
                                    <div class="alert alert-danger" id="errorMessage1">
                                        <div id="supplierError"></div>
                                        <div id="storeError"></div>                     
                                    </div>
                                    <div class="input-effect">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('supplier_id') ? ' is-invalid' : ''); ?>" name="supplier_id" id="supplier_id">
                                            <option data-display=" <?php echo app('translator')->getFromJson('lang.select_supplier'); ?> *" value=""> <?php echo app('translator')->getFromJson('lang.select'); ?></option>
                                            <?php if(isset($suppliers)): ?>
                                            <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"
                                                <?php if(isset($editData)): ?>
                                                <?php if($editData->category_name == $value->id): ?>
                                                    <?php echo app('translator')->getFromJson('lang.selected'); ?>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                                ><?php echo e($value->company_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('supplier_id')): ?>
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong><?php echo e($errors->first('supplier_id')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-30">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('store_id') ? ' is-invalid' : ''); ?>" name="store_id" id="store_id">
                                                <option data-display="Select Store/WareHouse *" value="">Select</option>
                                                <?php if(isset($itemStores)): ?>
                                                <?php $__currentLoopData = $itemStores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value->id); ?>"
                                                    <?php if(isset($editData)): ?>
                                                    <?php if($editData->category_name == $value->id): ?>
                                                        <?php echo app('translator')->getFromJson('lang.selected'); ?>
                                                    <?php endif; ?>
                                                    <?php endif; ?>
                                                    ><?php echo e($value->store_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('store_id')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong><?php echo e($errors->first('store_id')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb-30">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('reference_no') ? ' is-invalid' : ''); ?>"
                                                type="text" name="reference_no" autocomplete="off" value="<?php echo e(isset($editData)? $editData->reference_no : ''); ?>">
                                                <label><?php echo app('translator')->getFromJson('lang.reference'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?> <span></span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('reference_no')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('reference_no')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 no-gutters input-right-icon mb-30">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input date form-control<?php echo e($errors->has('from_date') ? ' is-invalid' : ''); ?>"  id="receive_date" type="text"
                                                    name="receive_date" value="<?php echo e(isset($editData)? date('m/d/Y', strtotime($editData->receive_date)): date('m/d/Y')); ?>" autocomplete="off">
                                                    <label><?php echo app('translator')->getFromJson('lang.receive_date'); ?> <span></span> </label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('receive_date')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('receive_date')); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>

                                            </div>
                                            <div class="col-auto">
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="receive_date_icon"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb-20">
                                            <div class="input-effect">
                                                <textarea class="primary-input form-control" cols="0" rows="4" name="description" id="description"><?php echo e(isset($editData) ? $editData->description : ''); ?></textarea>
                                                <label><?php echo app('translator')->getFromJson('lang.description'); ?> <span></span> </label>
                                                <span class="focus-border textarea"></span>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
              <div class="row xm_3">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.item_receive'); ?></h3>
                    </div>
                </div>

                <div class="offset-lg-6 col-lg-2 text-right col-md-6">
                    <button type="button" class="primary-btn small fix-gr-bg" onclick="addRow();" id="addRowBtn">
                        <span class="ti-plus pr-2"></span>
                        <?php echo app('translator')->getFromJson('lang.add'); ?>
                    </button>
                </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
               <div class="white-box">
                    <div class="alert alert-danger" id="errorMessage2">
                        <div id="itemError"></div>
                        <div id="priceError"></div>
                        <div id="quantityError"></div>                     
                    </div>
                   <table class="table" id="productTable">
                    <thead>
                      <tr>
                          <th> <?php echo app('translator')->getFromJson('lang.product_name'); ?> </th>
                          <th> <?php echo app('translator')->getFromJson('lang.unit_price'); ?> </th>
                          <th> <?php echo app('translator')->getFromJson('lang.quantity'); ?> </th>
                          <th><?php echo app('translator')->getFromJson('lang.sub_total'); ?></th>
                          <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr id="row1" class="0">
                        <td class="border-top-0">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>"> 
                            <div class="input-effect">
                                <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('category_name') ? ' is-invalid' : ''); ?>" name="item_id[]" id="productName1">
                                    <option data-display="Select Item " value="">Select</option>
                                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"
                                        <?php if(isset($editData)): ?>
                                        <?php if($editData->category_name == $value->id): ?>
                                            <?php echo app('translator')->getFromJson('lang.selected'); ?>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        ><?php echo e($value->item_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('item_id')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('item_id')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('unit_price') ? ' is-invalid' : ''); ?>"
                                    type="text" id="unit_price1" name="unit_price[]" autocomplete="off" value="<?php echo e(isset($editData)? $editData->unit_price : ''); ?>" onkeyup="getTotalByPrice(1)">

                                    <span class="focus-border"></span>
                                    <?php if($errors->has('unit_price')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('unit_price')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('quantity') ? ' is-invalid' : ''); ?>"
                                    type="text" id="quantity1" name="quantity[]" autocomplete="off" onkeyup="getTotal(1);" value="<?php echo e(isset($editData)? $editData->quantity : ''); ?>">

                                    <span class="focus-border"></span>
                                    <?php if($errors->has('quantity')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('quantity')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('sub_total') ? ' is-invalid' : ''); ?>"
                                    type="text" name="total[]" id="total1" autocomplete="off" value="<?php echo e(isset($editData)? $editData->sub_total : '0.00'); ?>">

                                    <span class="focus-border"></span>
                                    <?php if($errors->has('sub_total')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('sub_total')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <input type="hidden" name="totalValue[]" id="totalValue1" autocomplete="off" class="form-control" />
                            </td>
                            <td>
                                 <button class="primary-btn icon-only fix-gr-bg" type="button">
                                     <span class="ti-trash"></span>
                                </button>
                               
                            </td>
                        </tr>
                        <tfoot>
                            <tr>
                               <th class="border-top-0" colspan="2">Total</th>
                               <th class="border-top-0">
                                   <input type="text" class="primary-input form-control" readonly=""  id="subTotalQuantity" name="subTotalQuantity" placeholder="0.00"/>

                                   <input type="hidden" class="form-control" id="subTotalQuantityValue" name="subTotalQuantityValue" />

                               </th>

                               <th class="border-top-0">
                                   <input type="text" class="primary-input form-control" id="subTotal" name="subTotal" placeholder="0.00" readonly=""/>

                                   <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />

                               </th>
                               <th class="border-top-0"></th>
                           </tr>
                       </tfoot>

                   </tbody>
               </table>
           </div>
       </div>
   </div>

   <div class="row mt-30">
    <div class="col-lg-12">
        <div class="white-box">

            <div class="row">
              <div class="col-lg-2 mt-30-md">
               <div class="col-lg-12">
                <div class="input-effect">


                    <input type="checkbox" id="full_paid" class="common-checkbox form-control<?php echo e($errors->has('full_paid') ? ' is-invalid' : ''); ?>" name="full_paid" value="1">                    
                    <label for="full_paid"><?php echo app('translator')->getFromJson('lang.full_paid'); ?></label>
                </div>
            </div>
        </div>  

        <div class="col-lg-3 mt-30-md">
           <div class="col-lg-12">
            <div class="input-effect">
            <input class="primary-input" type="number" value="0" name="totalPaid" id="totalPaid" onkeyup="paidAmount();">
                <input type="hidden" id="totalPaidValue" name="totalPaidValue">
                <label><?php echo app('translator')->getFromJson('lang.total_paid'); ?></label>
                <span class="focus-border"></span>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mt-30-md">
       <div class="col-lg-12">
        <div class="input-effect">
            <input class="primary-input" type="text" value="0.00" id="totalDue" readonly>
            <input type="hidden" id="totalDueValue" name="totalDueValue">
            <label><?php echo app('translator')->getFromJson('lang.total_due'); ?></label>
            <span class="focus-border"></span>
        </div>
    </div>
</div>
<div class="col-lg-3">
  <select class="niceSelect w-100 bb form-control" name="payment_method" id="payment_method">
    <option data-display="Select Payment Method" value="">SELECT Payment Method </option>
    <?php $__currentLoopData = $paymentMethhods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($value->id); ?>"><?php echo e($value->method); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>
  <?php 
                                  $tooltip = "";
                                  if(in_array(333, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
<div class="col-lg-12 mt-20 text-center">
 <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
    <span class="ti-check"></span>
     <?php echo app('translator')->getFromJson('lang.receive'); ?>
</button>
</div>
</div>


</div>
</div>
</div>
</div>
</div>
<?php echo e(Form::close()); ?>

</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>