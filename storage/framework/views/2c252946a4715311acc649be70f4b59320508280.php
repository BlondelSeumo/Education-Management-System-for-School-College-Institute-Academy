<?php $__env->startSection('mainContent'); ?>
<?php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } ?>
<?php
    function showPicName($data){
        $name = explode('/', $data);
        return $name[3];
    }
?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.add_expense'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?> </a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.accounts'); ?> </a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.add_expense'); ?> </a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($add_expense)): ?>
        <?php if(in_array(144, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                       
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(url('add-expense')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->getFromJson('lang.add'); ?>
                </a>
            </div>
        </div>

        <?php endif; ?>
        <?php endif; ?>
        <div class="row">
            
           
 
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">

                            <h3 class="mb-30">
                                <?php if(isset($add_expense)): ?>
                                    <?php echo app('translator')->getFromJson('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->getFromJson('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->getFromJson('lang.expense'); ?>
                            </h3>
                        </div>
                        <?php if(isset($add_expense)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true,  'url' => 'add-expense/'.$add_expense->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data' , 'id' => 'add-expense-update'])); ?>

                        <?php else: ?>
                        <?php if(in_array(144, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'add-expense',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'add-expense'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        
                        <div class="white-box">
                            <div class="add-visitor">
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
                                         
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                                                type="text" name="name" autocomplete="off" value="<?php echo e(isset($add_expense)? $add_expense->name: old('name')); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($add_expense)? $add_expense->id: ''); ?>">
                                            <label><?php echo app('translator')->getFromJson('lang.name'); ?>  <span>*</span></label>
                                            <span class="focus-border"></span>
                                             <?php if($errors->has('name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row  mt-40">
                                    <div class="col-lg-12">

                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('expense_head') ? ' is-invalid' : ''); ?>" name="expense_head">
                                            <option data-display="A/C Head *" value=""><?php echo app('translator')->getFromJson('lang.a_c_Head'); ?> *</option>
                                            <?php $__currentLoopData = $expense_heads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense_head): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset($add_expense)): ?>
                                                <option value="<?php echo e($expense_head->id); ?>"
                                                    <?php echo e($add_expense->expense_head_id == $expense_head->id? 'selected': ''); ?>><?php echo e($expense_head->head); ?></option>
                                                <?php else: ?>
                                                <option value="<?php echo e($expense_head->id); ?>" <?php echo e(old('expense_head') == $expense_head->id? 'selected': ''); ?>><?php echo e($expense_head->head); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                       <?php if($errors->has('expense_head')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('expense_head')); ?></strong>
                                        </span>
                                        <?php endif; ?> 
                                    </div>
                                </div>
                                
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('payment_method') ? ' is-invalid' : ''); ?>" name="payment_method" id="payment_method">
                                            <option data-display="<?php echo app('translator')->getFromJson('lang.payment_method'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.payment_method'); ?> *</option>
                                            <?php $__currentLoopData = $payment_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(isset($add_expense)): ?>
                                            <option value="<?php echo e($payment_method->id); ?>"
                                                <?php echo e($add_expense->payment_method_id == $payment_method->id? 'selected': ''); ?>><?php echo e($payment_method->method); ?></option>
                                            <?php else: ?>
                                            
                                             <option value="<?php echo e($payment_method->id); ?>" <?php echo e(old('payment_method') == $payment_method->id? 'selected': ''); ?>><?php echo e($payment_method->method); ?></option>
                                               
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('payment_method')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('payment_method')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row mt-25" id="bankAccount">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('accounts') ? ' is-invalid' : ''); ?>" name="accounts">
                                            <option data-display="<?php echo app('translator')->getFromJson('lang.accounts'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.accounts'); ?>  *</option>
                                            <?php $__currentLoopData = $bank_accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank_account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(isset($add_expense)): ?>
                                            <option value="<?php echo e($bank_account->id); ?>"
                                                <?php echo e($add_expense->account_id == $bank_account->id? 'selected': ''); ?>><?php echo e($bank_account->account_name); ?></option>
                                            <?php else: ?>
                                            <option value="<?php echo e($bank_account->id); ?>"><?php echo e($bank_account->account_name); ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select> 
                                        <?php if($errors->has('accounts')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('accounts')); ?></strong>
                                        </span>
                                        <?php endif; ?> 
                                    </div>
                                </div>

                                <div class="row no-gutters input-right-icon mt-40">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control<?php echo e($errors->has('date') ? ' is-invalid' : ''); ?>" id="startDate" type="text"
                                                placeholder="<?php echo app('translator')->getFromJson('lang.date'); ?> " name="date" value="<?php echo e(isset($add_expense)? date('m/d/Y',strtotime($add_expense->date)) : date('m/d/Y')); ?>">
                                            <span class="focus-border"></span>
                                              <?php if($errors->has('date')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('date')); ?></strong>
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
                                <div class="row  mt-40">
                                    <div class="col-lg-12">

                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('amount') ? ' is-invalid' : ''); ?>"
                                                type="number" name="amount" autocomplete="off" value="<?php echo e(isset($add_expense)? $add_expense->amount:old('amount')); ?>">
                                            <label><?php echo app('translator')->getFromJson('lang.amount'); ?>  <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('amount')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('amount')); ?></strong>
                                            </span>
                                            <?php endif; ?> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                     <div class="col">
                                        <div class="row no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input" type="text" id="placeholderFileOneName" placeholder="<?php echo e(isset($add_expense)? ($add_expense->file != ""? showPicName($add_expense->file):'File') : ''); ?>"readonly
                                                        >
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg" for="document_file_1"><?php echo app('translator')->getFromJson('lang.browse'); ?> </label>
                                                    <input type="file" class="d-none" name="file" id="document_file_1">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4" name="description"><?php echo e(isset($add_expense)? $add_expense->description: old('description')); ?></textarea>
                                            <label><?php echo app('translator')->getFromJson('lang.description'); ?>  <span></span></label>
                                            <span class="focus-border textarea"></span>
                                        </div>
                                    </div>
                                </div>
                                  <?php 
                                  $tooltip = "";
                                  if(in_array(144, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($add_expense)): ?>
                                                <?php echo app('translator')->getFromJson('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->getFromJson('lang.save'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->getFromJson('lang.expense'); ?>
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
                            <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.expense'); ?>  <?php echo app('translator')->getFromJson('lang.list'); ?> </h3>
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
                                    <td colspan="7">
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
                                    <th><?php echo app('translator')->getFromJson('lang.name'); ?> </th>
                                    <th><?php echo app('translator')->getFromJson('lang.payment_method'); ?> </th>
                                    <th><?php echo app('translator')->getFromJson('lang.date'); ?> </th>
                                    <th><?php echo app('translator')->getFromJson('lang.a_c_Head'); ?> </th>
                                    <th><?php echo app('translator')->getFromJson('lang.amount'); ?> (<?php echo e($currency); ?>)</th>
                                    <th><?php echo app('translator')->getFromJson('lang.action'); ?> </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $add_expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $add_expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($add_expense->name); ?></td>
                                    <td><?php echo e($add_expense->paymentMethod !=""?$add_expense->paymentMethod->method:""); ?> <?php echo e($add_expense->payment_method_id == "3"? '('.$add_expense->account->account_name.')':''); ?></td>
                                    <td  data-sort="<?php echo e(strtotime($add_expense->date)); ?>">
                                        <?php echo e($add_expense->date != ""? App\SmGeneralSettings::DateConvater($add_expense->date):''); ?>



                                       
                                    </td>
                                    <td><?php echo e(isset($add_expense->ACHead->head)? $add_expense->ACHead->head: ''); ?></td>
                                    <td><?php echo e($add_expense->amount); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->getFromJson('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                <?php if(in_array(145, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

                                                <a class="dropdown-item" href="<?php echo e(url('add-expense', [$add_expense->id])); ?>"><?php echo app('translator')->getFromJson('lang.edit'); ?> </a>
                                                <?php endif; ?>
                                                <?php if(in_array(146, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteAddExpenseModal<?php echo e($add_expense->id); ?>"
                                                    href="#"><?php echo app('translator')->getFromJson('lang.delete'); ?> </a>
                                           <?php endif; ?>
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteAddExpenseModal<?php echo e($add_expense->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.delete'); ?> <?php echo app('translator')->getFromJson('lang.item'); ?> </h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->getFromJson('lang.are_you_sure_to_delete'); ?> </h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->getFromJson('lang.cancel'); ?> </button>
                                                     <?php echo e(Form::open(['url' => 'add-expense/'.$add_expense->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

                                                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->getFromJson('lang.delete'); ?> </button>
                                                     <?php echo e(Form::close()); ?>

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