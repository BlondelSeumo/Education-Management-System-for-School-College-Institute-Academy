<?php $__env->startSection('mainContent'); ?>

<section class="mb-40">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.welcome'); ?></h3>

                </div>
            </div>
        </div>
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
      </div>
  </div>
  <div class="row">
<?php if(in_array(2, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>

    <div class="col-lg-3 col-md-6">
        <a href="#" class="d-block">
            <div class="white-box single-summery">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3><?php echo app('translator')->getFromJson('lang.student'); ?></h3>
                        <p class="mb-0"><?php echo app('translator')->getFromJson('lang.total'); ?> <?php echo app('translator')->getFromJson('lang.students'); ?></p>
                    </div>
                    <h1 class="gradient-color2">
                        <?php if(isset($totalStudents)): ?>
                        <?php echo e(count($totalStudents)); ?>

                        <?php endif; ?>
                    </h1>
                </div>
            </div>
        </a>
    </div>
<?php endif; ?>
<?php if(in_array(3, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>

    <div class="col-lg-3 col-md-6">
        <a href="#" class="d-block">
            <div class="white-box single-summery">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3><?php echo app('translator')->getFromJson('lang.teachers'); ?></h3>
                        <p class="mb-0"><?php echo app('translator')->getFromJson('lang.total'); ?> <?php echo app('translator')->getFromJson('lang.teachers'); ?></p>
                    </div>
                    <h1 class="gradient-color2">
                        <?php if(isset($totalStudents)): ?>
                        <?php echo e(count($totalTeachers)); ?>

                        <?php endif; ?></h1>
                    </div>
                </div>
            </a>
        </div>
        <?php endif; ?>
        <?php if(in_array(4, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>

        <div class="col-lg-3 col-md-6 mt-30-md">
            <a href="#" class="d-block">
                <div class="white-box single-summery">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h3><?php echo app('translator')->getFromJson('lang.parents'); ?></h3>
                            <p class="mb-0"><?php echo app('translator')->getFromJson('lang.total'); ?> <?php echo app('translator')->getFromJson('lang.parents'); ?></p>
                        </div>
                        <h1 class="gradient-color2">
                            <?php if(isset($totalParents)): ?>
                            <?php echo e(count($totalParents)); ?>

                            <?php endif; ?></h1>
                        </div>
                    </div>
                </a>
            </div>
            <?php endif; ?>
            <?php if(in_array(5, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>

            <div class="col-lg-3 col-md-6 mt-30-md">
                <a href="#" class="d-block">
                    <div class="white-box single-summery">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3><?php echo app('translator')->getFromJson('lang.staffs'); ?></h3>
                                <p class="mb-0"><?php echo app('translator')->getFromJson('lang.total'); ?> <?php echo app('translator')->getFromJson('lang.staffs'); ?></p>
                            </div>
                            <h1 class="gradient-color2">
                             <?php if(isset($totalStaffs)): ?>
                             <?php echo e(count($totalStaffs)); ?>

                             <?php endif; ?> 
                         </h1>
                     </div> 
                 </div>
             </a>
         </div>
         <?php endif; ?>
     </div>
 </div>
</section>
<?php if(in_array(6, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>

<section class="" id="incomeExpenseDiv">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8 col-md-9">
                <div class="main-title">
                    <h3 class="mb-30"> <?php echo app('translator')->getFromJson('lang.income_and_expenses_for'); ?> <?php echo e(date('M Y')); ?></h3>
                </div>
            </div>
            <div class="offset-lg-2 col-lg-2 text-right col-md-3">
                <button type="button" class="primary-btn small tr-bg icon-only" id="barChartBtn">
                    <span class="pr ti-move"></span>
                </button>

                <button type="button" class="primary-btn small fix-gr-bg icon-only ml-10"  id="barChartBtnRemovetn">
                    <span class="pr ti-close"></span>
                </button>
            </div>
            <div class="col-lg-12">
                <div class="white-box" id="barChartDiv">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="text-center">
                                <h1>$<?php echo e(number_format($m_total_income)); ?></h1>
                                <p><?php echo app('translator')->getFromJson('lang.total_income'); ?></p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="text-center">
                                <h1>$<?php echo e(number_format($m_total_expense)); ?></h1>
                                <p><?php echo app('translator')->getFromJson('lang.total_expenses'); ?></p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="text-center">
                                <h1>$<?php echo e(number_format($m_total_income - $m_total_expense)); ?></h1>
                                <p><?php echo app('translator')->getFromJson('lang.total_profit'); ?></p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="text-center">
                                <h1>$<?php echo e(number_format($m_total_income)); ?></h1>
                                <p><?php echo app('translator')->getFromJson('lang.total_revenue'); ?></p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div id="commonBarChart" style="height: 350px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if(in_array(7, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>

<section class="mt-50" id="incomeExpenseSessionDiv">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8 col-md-9">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.income_and_expenses_for'); ?> <?php echo e(date('Y')); ?></h3>
                </div>
            </div>
            <div class="offset-lg-2 col-lg-2 text-right col-md-3">
                <button type="button" class="primary-btn small tr-bg icon-only" id="areaChartBtn">
                    <span class="pr ti-move"></span>
                </button>

                <button type="button" class="primary-btn small fix-gr-bg icon-only ml-10"  id="areaChartBtnRemovetn">
                    <span class="pr ti-close"></span>
                </button>
            </div>
            <div class="col-lg-12">
                <div class="white-box" id="areaChartDiv">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="text-center">
                                <h1>$<?php echo e(number_format($y_total_income)); ?></h1>
                                <p><?php echo app('translator')->getFromJson('lang.total_income'); ?></p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="text-center">
                                <h1>$<?php echo e(number_format($y_total_expense)); ?></h1>
                                <p><?php echo app('translator')->getFromJson('lang.total_expenses'); ?></p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="text-center">
                                <h1>$<?php echo e(number_format($y_total_income - $y_total_expense)); ?></h1>
                                <p><?php echo app('translator')->getFromJson('lang.total_profit'); ?></p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="text-center">
                                <h1>$<?php echo e(number_format($y_total_income)); ?></h1>
                                <p><?php echo app('translator')->getFromJson('lang.total_revenue'); ?></p>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div id="commonAreaChart" style="height: 350px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if(in_array(8, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>

<section class="mt-50">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.notice_board'); ?></h3>
                </div>
            </div>

            <div class="col-lg-12">
                <table class="school-table-style w-100">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('lang.date'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.title'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.actions'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                      <?php $role_id = Auth()->user()->role_id; ?>
                      <?php if (isset($notices)) {
                            foreach ($notices as $notice) {
                                $inform_to = explode(',', $notice->inform_to);
                                if (in_array($role_id, $inform_to)) {
                                    ?>
                                <tr>
                                    <td>
                                       
<?php echo e($notice->publish_on != ""? App\SmGeneralSettings::DateConvater($notice->publish_on):''); ?>


                                    </td>
                                    <td><?php echo e($notice->notice_title); ?></td>
                                    <td>
                                    <a href="<?php echo e(url('view/notice/'.$notice->id)); ?>" title="View notice"  class="primary-btn small tr-bg modalLink" data-modal-size="modal-lg"><?php echo app('translator')->getFromJson('lang.view'); ?></a>
                                    </td>
                                </tr>
                                    <?php 
                                }
                            }
                        }

                        ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</section>
<?php endif; ?>

<section class="mt-50">
    <div class="container-fluid p-0">
        <div class="row">
            <?php if(in_array(9, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.calendar'); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="white-box">
                            <div class='common-calendar'>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php endif; ?>
            <div class="col-lg-3 mt-50-md">
                <?php if(in_array(10, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>

              <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.to_do_list'); ?></h3>
                    </div>
                </div>
                <div class="col-lg-6 text-right col-md-6">

                    <a href="#" data-toggle="modal" class="primary-btn small fix-gr-bg" data-target="#add_to_do" title="Add To Do" data-modal-size="modal-md">
                        <span class="ti-plus pr-2"></span>
                        <?php echo app('translator')->getFromJson('lang.add'); ?>
                    </a>
                </div>
            </div>
<?php endif; ?>

            <div class="modal fade admin-query" id="add_to_do">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add To Do</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                           <div class="container-fluid">
                               <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'saveToDoData',
                               'method' => 'POST', 'enctype' => 'multipart/form-data', 'onsubmit' => 'return validateToDoForm()'])); ?>


                               <div class="row">
                                <div class="col-lg-12">
                                    <div class="row mt-25">
                                        <div class="col-lg-12" id="sibling_class_div">
                                            <div class="input-effect">
                                                <input  class="primary-input form-control" type="text" name="todo_title" id="todo_title">
                                                <label><?php echo app('translator')->getFromJson('lang.to_do_title'); ?> <span></span> </label>
                                                <span class="focus-border"></span>
                                               <span class="modal_input_validation red_alert"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-30">
                                        <div class="col-lg-12" id="">
                                            <div class="no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="input-effect">
                                                        <input class="read-only-input primary-input date form-control<?php echo e($errors->has('date') ? ' is-invalid' : ''); ?>" id="startDate" type="text" autocomplete="off" readonly="true" name="date" value="<?php echo e(date('m/d/Y')); ?>">
                                                        <label><?php echo app('translator')->getFromJson('lang.date'); ?> <span></span> </label>
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
                                        </div>
                                    </div>

                                <div class="col-lg-12 text-center">
                                    <div class="mt-40 d-flex justify-content-between">
                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->getFromJson('lang.cancel'); ?></button>
                                        <input class="primary-btn fix-gr-bg" type="submit" value="save">
                                    </div>
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box school-table">
                        <div class="row to-do-list mb-20">
                            <div class="col-md-6">
                                <button class="primary-btn small fix-gr-bg" id="toDoList"><?php echo app('translator')->getFromJson('lang.incomplete'); ?></button>
                            </div>
                            <div class="col-md-6">
                                <button class="primary-btn small tr-bg" id="toDoListsCompleted"><?php echo app('translator')->getFromJson('lang.completed'); ?></button>
                            </div>
                        </div>

                        <input type="hidden" id="url" value="<?php echo e(url('/')); ?>">
                        
                        
                        <div class="toDoList">
                        <?php if(count($toDoLists)>0): ?>
                        
                            <?php $__currentLoopData = $toDoLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $toDoList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <div class="single-to-do d-flex justify-content-between toDoList" id="to_do_list_div<?php echo e($toDoList->id); ?>">
                                <div>
                                    <input type="checkbox" id="midterm<?php echo e($toDoList->id); ?>" class="common-checkbox complete_task" name="complete_task" value="<?php echo e($toDoList->id); ?>">
                                    
                                    <label for="midterm<?php echo e($toDoList->id); ?>">

                                        <input type="hidden" id="id" value="<?php echo e($toDoList->id); ?>">
                                    <input type="hidden" id="url" value="<?php echo e(url('/')); ?>">
                                        <h5 class="d-inline"><?php echo e($toDoList->todo_title); ?></h5>
                                        <p class="ml-35">
                                          
<?php echo e($toDoList->date != ""? App\SmGeneralSettings::DateConvater($toDoList->date):''); ?>


                                        </p>
                                    </label>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <div class="single-to-do d-flex justify-content-between">
                                <?php echo app('translator')->getFromJson('lang.no_do_lists_assigned_yet'); ?>
                            </div>
                        
                        <?php endif; ?>
                        </div>


                        <div class="toDoListsCompleted">
                        <?php if(count($toDoListsCompleteds)>0): ?>
                        
                            <?php $__currentLoopData = $toDoListsCompleteds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $toDoListsCompleted): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        
                            <div class="single-to-do d-flex justify-content-between" id="to_do_list_div<?php echo e($toDoListsCompleted->id); ?>">
                                <div>
                                        <h5 class="d-inline"><?php echo e($toDoListsCompleted->todo_title); ?></h5>
                                        <p class=""> 

   <?php echo e($toDoListsCompleted->date != ""? App\SmGeneralSettings::DateConvater($toDoListsCompleted->date):''); ?>


                                        </p>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <div class="single-to-do d-flex justify-content-between">
                                <?php echo app('translator')->getFromJson('lang.no_do_lists_assigned_yet'); ?>
                            </div>
                        
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>






<?php
    $chart_data = "";

    for($i = 1; $i <= date('d'); $i++){

    $i = $i < 10? '0'.$i:$i;
        $income = App\SmAddIncome::monthlyIncome($i);
        $expense = App\SmAddIncome::monthlyExpense($i);

        $chart_data .= "{ day: '" . $i . "', income: " . $income . ", expense:" . $expense . " },";
    }

?>


<?php
    $chart_data_yearly = "";

    for($i = 1; $i <= date('m'); $i++){

    $i = $i < 10? '0'.$i:$i;

        $yearlyIncome = App\SmAddIncome::yearlyIncome($i);
        
        $yearlyExpense = App\SmAddIncome::yearlyExpense($i);

        $chart_data_yearly .= "{ y: '" . $i . "', income: " . $yearlyIncome . ", expense:" . $yearlyExpense . " },";
    }

?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script type="text/javascript">




function barChart(idName) {
        window.barChart = Morris.Bar({
            element: 'commonBarChart',
            data: [ <?php echo $chart_data; ?> ],
            xkey: 'day',
            ykeys: ['income', 'expense'],
            labels: ['Income', 'Expense'],
            barColors: ['#8a33f8', '#f25278'],
            resize: true,
            redraw: true,
            gridTextColor: '#415094',
            gridTextSize: 12,
            gridTextFamily: '"Poppins", sans-serif',
            barGap: 4,
            barSizeRatio: 0.3
        });
    }



    const monthNames = ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
    ];

    function areaChart() {
        window.areaChart = Morris.Area({
            element: 'commonAreaChart',
            data: [ <?php echo $chart_data_yearly; ?> ],
            xkey: 'y',
            parseTime: false,
            ykeys: ['income', 'expense'],
            labels: ['Income', 'Expense'],
            xLabelFormat: function (x) {
                var index = parseInt(x.src.y);
                return monthNames[index];
            },
            xLabels: "month",
            labels: ['Income', 'Expense'],
            hideHover: 'auto',
            lineColors: ['rgba(124, 50, 255, 0.5)', 'rgba(242, 82, 120, 0.5)'],
            });
    }

</script>
<?php


$events = array();
foreach($holidays as $k => $holiday) {

    $events[$k]['title'] = $holiday->holiday_title;
   
    $events[$k]['start'] = $holiday->from_date;
   
    $events[$k]['end'] = $holiday->to_date;

}
 

?>



<script type="text/javascript">
    /*-------------------------------------------------------------------------------
       Full Calendar Js 
    -------------------------------------------------------------------------------*/
    if ($('.common-calendar').length) {
        $('.common-calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            height: 650,
            events: <?php echo json_encode($events);?> ,
        });
    }


</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>