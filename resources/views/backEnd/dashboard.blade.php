@extends('backEnd.master')


@section('mainContent')

<section class="mb-40">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.welcome')</h3>
{{--                    {{Session::get('LoginData')->school_name}}--}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @if(session()->has('message-success'))
                <div class="alert alert-success">
                 {{ session()->get('message-success') }}
             </div>
             @elseif(session()->has('message-danger'))
             <div class="alert alert-danger">
              {{ session()->get('message-danger') }}
          </div>
          @endif
      </div>
  </div>
  <div class="row">
@if(in_array(2, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)

    <div class="col-lg-3 col-md-6">
        <a href="#" class="d-block">
            <div class="white-box single-summery">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3>@lang('lang.student')</h3>
                        <p class="mb-0">@lang('lang.total') @lang('lang.students')</p>
                    </div>
                    <h1 class="gradient-color2">
                        @if(isset($totalStudents))
                        {{count($totalStudents)}}
                        @endif
                    </h1>
                </div>
            </div>
        </a>
    </div>
@endif
@if(in_array(3, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)

    <div class="col-lg-3 col-md-6">
        <a href="#" class="d-block">
            <div class="white-box single-summery">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3>@lang('lang.teachers')</h3>
                        <p class="mb-0">@lang('lang.total') @lang('lang.teachers')</p>
                    </div>
                    <h1 class="gradient-color2">
                        @if(isset($totalStudents))
                        {{count($totalTeachers)}}
                        @endif</h1>
                    </div>
                </div>
            </a>
        </div>
        @endif
        @if(in_array(4, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)

        <div class="col-lg-3 col-md-6 mt-30-md">
            <a href="#" class="d-block">
                <div class="white-box single-summery">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h3>@lang('lang.parents')</h3>
                            <p class="mb-0">@lang('lang.total') @lang('lang.parents')</p>
                        </div>
                        <h1 class="gradient-color2">
                            @if(isset($totalParents))
                            {{count($totalParents)}}
                            @endif</h1>
                        </div>
                    </div>
                </a>
            </div>
            @endif
            @if(in_array(5, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)

            <div class="col-lg-3 col-md-6 mt-30-md">
                <a href="#" class="d-block">
                    <div class="white-box single-summery">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>@lang('lang.staffs')</h3>
                                <p class="mb-0">@lang('lang.total') @lang('lang.staffs')</p>
                            </div>
                            <h1 class="gradient-color2">
                             @if(isset($totalStaffs))
                             {{count($totalStaffs)}}
                             @endif 
                         </h1>
                     </div> 
                 </div>
             </a>
         </div>
         @endif
     </div>
 </div>
</section>
@if(in_array(6, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)

<section class="" id="incomeExpenseDiv">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8 col-md-9">
                <div class="main-title">
                    <h3 class="mb-30"> @lang('lang.income_and_expenses_for') {{date('M Y')}}</h3>
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
                                <h1>{{$currency}}{{number_format($m_total_income)}}</h1>
                                <p>@lang('lang.total_income')</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="text-center">
                                <h1>{{$currency}}{{number_format($m_total_expense)}}</h1>
                                <p>@lang('lang.total_expenses')</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="text-center">
                                <h1>{{$currency}}{{number_format($m_total_income - $m_total_expense)}}</h1>
                                <p>@lang('lang.total_profit')</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="text-center">
                                <h1>{{$currency}}{{number_format($m_total_income)}}</h1>
                                <p>@lang('lang.total_revenue')</p>
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
@endif
@if(in_array(7, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)

<section class="mt-50" id="incomeExpenseSessionDiv">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8 col-md-9">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.income_and_expenses_for') {{date('Y')}}</h3>
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
                                <h1>{{$currency}}{{number_format($y_total_income)}}</h1>
                                <p>@lang('lang.total_income')</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="text-center">
                                <h1>{{$currency}}{{number_format($y_total_expense)}}</h1>
                                <p>@lang('lang.total_expenses')</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="text-center">
                                <h1>{{$currency}}{{number_format($y_total_income - $y_total_expense)}}</h1>
                                <p>@lang('lang.total_profit')</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="text-center">
                                <h1>{{$currency}}{{number_format($y_total_income)}}</h1>
                                <p>@lang('lang.total_revenue')</p>
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
@endif
@if(in_array(8, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)

<section class="mt-50">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.notice_board')</h3>
                </div>
            </div>

            <div class="col-lg-12">
                <table class="school-table-style w-100">
                    <thead>
                        <tr>
                            <th>@lang('lang.date')</th>
                            <th>@lang('lang.title')</th>
                            <th>@lang('lang.actions')</th>
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
                                       
{{$notice->publish_on != ""? App\SmGeneralSettings::DateConvater($notice->publish_on):''}}

                                    </td>
                                    <td>{{$notice->notice_title}}</td>
                                    <td>
                                    <a href="{{url('view/notice/'.$notice->id)}}" title="View notice"  class="primary-btn small tr-bg modalLink" data-modal-size="modal-lg">@lang('lang.view')</a>
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
@endif

<section class="mt-50">
    <div class="container-fluid p-0">
        <div class="row">
            @if(in_array(9, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">@lang('lang.calendar')</h3>
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
@endif
            <div class="col-lg-3 mt-50-md">
                @if(in_array(10, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1)

              <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.to_do_list')</h3>
                    </div>
                </div>
                <div class="col-lg-6 text-right col-md-6">

                    <a href="#" data-toggle="modal" class="primary-btn small fix-gr-bg" data-target="#add_to_do" title="Add To Do" data-modal-size="modal-md">
                        <span class="ti-plus pr-2"></span>
                        @lang('lang.add')
                    </a>
                </div>
            </div>
@endif

            <div class="modal fade admin-query" id="add_to_do">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add To Do</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                           <div class="container-fluid">
                               {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'saveToDoData',
                               'method' => 'POST', 'enctype' => 'multipart/form-data', 'onsubmit' => 'return validateToDoForm()']) }}

                               <div class="row">
                                <div class="col-lg-12">
                                    <div class="row mt-25">
                                        <div class="col-lg-12" id="sibling_class_div">
                                            <div class="input-effect">
                                                <input  class="primary-input form-control" type="text" name="todo_title" id="todo_title">
                                                <label>@lang('lang.to_do_title') <span></span> </label>
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
                                                        <input class="read-only-input primary-input date form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" id="startDate" type="text" autocomplete="off" readonly="true" name="date" value="{{date('m/d/Y')}}">
                                                        <label>@lang('lang.date') <span></span> </label>
                                                        @if ($errors->has('date'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('date') }}</strong>
                                                            </span>
                                                        @endif
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
                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                        <input class="primary-btn fix-gr-bg" type="submit" value="save">
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
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
                                <button class="primary-btn small fix-gr-bg" id="toDoList">@lang('lang.incomplete')</button>
                            </div>
                            <div class="col-md-6">
                                <button class="primary-btn small tr-bg" id="toDoListsCompleted">@lang('lang.completed')</button>
                            </div>
                        </div>

                        <input type="hidden" id="url" value="{{url('/')}}">
                        
                        
                        <div class="toDoList">
                        @if(count($toDoLists)>0)
                        
                            @foreach($toDoLists as $toDoList) 
                            <div class="single-to-do d-flex justify-content-between toDoList" id="to_do_list_div{{$toDoList->id}}">
                                <div>
                                    <input type="checkbox" id="midterm{{$toDoList->id}}" class="common-checkbox complete_task" name="complete_task" value="{{$toDoList->id}}">
                                    
                                    <label for="midterm{{$toDoList->id}}">

                                        <input type="hidden" id="id" value="{{$toDoList->id}}">
                                    <input type="hidden" id="url" value="{{url('/')}}">
                                        <h5 class="d-inline">{{$toDoList->todo_title}}</h5>
                                        <p class="ml-35">
                                          
{{$toDoList->date != ""? App\SmGeneralSettings::DateConvater($toDoList->date):''}}

                                        </p>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="single-to-do d-flex justify-content-between">
                                @lang('lang.no_do_lists_assigned_yet')
                            </div>
                        
                        @endif
                        </div>


                        <div class="toDoListsCompleted">
                        @if(count($toDoListsCompleteds)>0)
                        
                            @foreach($toDoListsCompleteds as $toDoListsCompleted) 
                        
                            <div class="single-to-do d-flex justify-content-between" id="to_do_list_div{{$toDoListsCompleted->id}}">
                                <div>
                                        <h5 class="d-inline">{{$toDoListsCompleted->todo_title}}</h5>
                                        <p class=""> 

   {{$toDoListsCompleted->date != ""? App\SmGeneralSettings::DateConvater($toDoListsCompleted->date):''}}

                                        </p>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="single-to-do d-flex justify-content-between">
                                @lang('lang.no_do_lists_assigned_yet')
                            </div>
                        
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>






@php
    $chart_data = "";

    for($i = 1; $i <= date('d'); $i++){

    $i = $i < 10? '0'.$i:$i;
        $income = App\SmAddIncome::monthlyIncome($i);
        $expense = App\SmAddIncome::monthlyExpense($i);

        $chart_data .= "{ day: '" . $i . "', income: " . $income . ", expense:" . $expense . " },";
    }

@endphp


@php
    $chart_data_yearly = "";

    for($i = 1; $i <= date('m'); $i++){

    $i = $i < 10? '0'.$i:$i;

        $yearlyIncome = App\SmAddIncome::yearlyIncome($i);
        
        $yearlyExpense = App\SmAddIncome::yearlyExpense($i);

        $chart_data_yearly .= "{ y: '" . $i . "', income: " . $yearlyIncome . ", expense:" . $yearlyExpense . " },";
    }

@endphp


@endsection

@section('script')

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

@endsection

