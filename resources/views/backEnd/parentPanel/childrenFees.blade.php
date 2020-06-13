@extends('backEnd.master')
@section('mainContent')
@php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } @endphp
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Fees</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">Dashboard</a>
                <a href="#">Fees</a>
                <a href="{{route('student_fees')}}">Pay Fees</a>
            </div>
        </div>
    </div>
</section>

<input type="hidden" id="url" value="{{URL::to('/')}}">
<input type="hidden" id="student_id" value="{{$student->id}}">
<section class="">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="d-flex justify-content-between">
                    <div class="main-title">
                        <h3 class="mb-30">Student Information</h3>
                    </div>
                </div>
            </div>
        </div>
              @if(session()->has('message-success'))
                <div class="alert alert-success">
                  {{ session()->get('message-success') }}
              </div>
              @elseif(session()->has('message-danger'))
              <div class="alert alert-danger">
                  {{ session()->get('message-danger') }}
              </div>
              @endif

        <div class="row">
            <div class="col-md-3 col-lg-3">
                <!-- Start Student Meta Information -->
                <div class="student-meta-box">
                    <div class="student-meta-top"></div>
                    <img class="student-meta-img img-100" src="{{asset($student->student_photo)}}" alt="">
                    <div class="white-box radius-t-y-0">
                        <div class="single-meta mt-10">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Student Name
                                </div>
                                <div class="value">
                                    {{$student->first_name.' '.$student->last_name}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Admission Number
                                </div>
                                <div class="value">
                                    {{$student->admission_no}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Roll Number
                                </div>
                                <div class="value">
                                     {{$student->roll_no}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Class
                                </div>
                                <div class="value">
                                    @if($student->className!="" && $student->session!="")
                                   {{$student->className->class_name}} ({{$student->session->session}})
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Section
                                </div>
                                <div class="value">
                                    {{$student->section !=""?$student->section->section_name:""}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Gender
                                </div>
                                <div class="value">
                                    {{$student->gender !=""?$student->gender->base_setup_name:""}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Student Meta Information -->

            </div>

            <div class="col-md-9 col-lg-9">
                <table class="display school-table school-table-style-parent-fees" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Fees Group</th>
                            <th>Fees Code</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Amount ({{$currency}})</th>
                            <th>Payment ID</th>
                            <th>Mode</th>
                            <th>Date</th>
                            <th>Discount ({{$currency}})</th>
                            <th>Fine ({{$currency}})</th>
                            <th>Paid ({{$currency}})</th>
                            <th>Balance ({{$currency}})</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $grand_total = 0;
                            $total_fine = 0;
                            $total_discount = 0;
                            $total_paid = 0;
                            $total_grand_paid = 0;
                            $total_balance = 0;
                        @endphp
                        @foreach($fees_assigneds as $fees_assigned)
                            @php
                                if($fees_assigned->feesGroupMaster->fees_group_id != 1 && $fees_assigned->feesGroupMaster->fees_group_id != 2){
                                    $grand_total += $fees_assigned->feesGroupMaster->amount;
                                }else{
                                    if($fees_assigned->feesGroupMaster->fees_group_id == 1){
                                        $grand_total += $student->route->far;
                                    }else{
                                        $grand_total += $student->room->cost_per_bed;
                                    }
                                }
                                
                            @endphp

                            @php
                                $discount_amount = App\SmFeesAssign::discountSum($fees_assigned->student_id, $fees_assigned->feesGroupMaster->feesTypes->id, 'discount_amount');
                                $total_discount += $discount_amount;
                                $student_id = $fees_assigned->student_id;
                            @endphp
                            @php
                                $paid = App\SmFeesAssign::discountSum($fees_assigned->student_id, $fees_assigned->feesGroupMaster->feesTypes->id, 'amount');
                                $total_grand_paid += $paid;
                            @endphp
                            @php
                                $fine = App\SmFeesAssign::discountSum($fees_assigned->student_id, $fees_assigned->feesGroupMaster->feesTypes->id, 'fine');
                                $total_fine += $fine;
                            @endphp
                             
                            @php
                                $total_paid = $discount_amount + $paid;
                            @endphp
                        <tr>
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                            <td>{{$fees_assigned->feesGroupMaster->feesGroups->name}}</td>
                            <td>{{$fees_assigned->feesGroupMaster->feesTypes->name}}</td>
                            <td>
                                
{{$fees_assigned->feesGroupMaster->date != ""? App\SmGeneralSettings::DateConvater($fees_assigned->feesGroupMaster->date):''}}

                            </td>
                            <td>
                                @if($fees_assigned->feesGroupMaster->fees_group_id != 1 && $fees_assigned->feesGroupMaster->fees_group_id != 2)
                                    @if($fees_assigned->feesGroupMaster->amount == $total_paid)
                                    <button class="primary-btn small bg-success text-white border-0">Paid</button>
                                    @elseif($total_paid != 0)
                                    <button class="primary-btn small bg-warning text-white border-0">Partial</button>
                                    @elseif($total_paid == 0)
                                    <button class="primary-btn small bg-danger text-white border-0">Unpaid</button>
                                    @endif
                                @else
                                    @if($fees_assigned->feesGroupMaster->fees_group_id == 1)
                                        @if($student->route->far == $total_paid)
                                        <button class="primary-btn small bg-success text-white border-0">Paid</button>
                                        @elseif($total_paid != 0)
                                        <button class="primary-btn small bg-warning text-white border-0">Partial</button>
                                        @elseif($total_paid == 0)
                                        <button class="primary-btn small bg-danger text-white border-0">Unpaid</button>
                                        @endif
                                    @elseif($fees_assigned->feesGroupMaster->fees_group_id == 2)
                                        @if($student->room->cost_per_bed == $total_paid)
                                        <button class="primary-btn small bg-success text-white border-0">Paid</button>
                                        @elseif($total_paid != 0)
                                        <button class="primary-btn small bg-warning text-white border-0">Partial</button>
                                        @elseif($total_paid == 0)
                                        <button class="primary-btn small bg-danger text-white border-0">Unpaid</button>
                                        @endif
                                    @endif    
                                @endif    
                            </td>
                            <td>
                                @php
                                    if($fees_assigned->feesGroupMaster->fees_group_id != 1 && $fees_assigned->feesGroupMaster->fees_group_id != 2){
                                        echo $fees_assigned->feesGroupMaster->amount;
                                    }else{
                                        if($fees_assigned->feesGroupMaster->fees_group_id == 1){
                                            echo $student->route->far;
                                        }else{
                                            echo $student->room->cost_per_bed;
                                        }
                                    }
                                    
                                @endphp
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td> {{$discount_amount}} </td>
                            <td>{{$fine}}</td>
                            <td>{{$paid}}</td>
                            <td>
                                @php 

                                    if($fees_assigned->feesGroupMaster->fees_group_id != 1 && $fees_assigned->feesGroupMaster->fees_group_id != 2){
                                        $rest_amount = $fees_assigned->feesGroupMaster->amount - $total_paid;
                                    }else{
                                        if($fees_assigned->feesGroupMaster->fees_group_id == 1){
                                           $rest_amount = $student->route->far - $total_paid;
                                        }else{
                                           $rest_amount = $student->room->cost_per_bed - $total_paid;
                                        }
                                    }

                                    $total_balance +=  $rest_amount;
                                    echo $rest_amount;
                                @endphp
                            </td>
                            <td>
                                @if($rest_amount != 0) 
                                <form method="POST" action="{{ url('pay-with-paystack') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
 

                                    <input type="hidden" name="email" value="otemuyiwa@gmail.com"> {{-- required --}}
                                    <input type="hidden" name="orderID" value="345">
                                    <input type="hidden" name="amount" value="{{$rest_amount * 100}}"> {{-- required in kobo --}}
                                    <input type="hidden" name="quantity" value="3">
                                    <input type="hidden" name="fees_type_id" value="{{$fees_assigned->feesGroupMaster->fees_type_id}}">
                                    <input type="hidden" name="payment_mode" value="">
                                    <input type="hidden" name="student_id" value="{{$student->id}}">
                                    <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}" >  
                                     <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">  
                                    <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                                    {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

                                     <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}
 
                                    <button type="submit" class="primary-btn small fix-gr-bg">Paystack<i class="ti-arrow-right"></i></button> 
                                </form>
                                @endif
                            </td>
                        </tr>
                            @php 
                                $payments = App\SmFeesAssign::feesPayment($fees_assigned->feesGroupMaster->feesTypes->id, $fees_assigned->student_id);
                                

                                $i = 0;
                            @endphp 

                            @foreach($payments as $payment)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right"><img src="{{asset('public/backEnd/img/table-arrow.png')}}"></td>
                                <td>
 
                                   
                                    @php
                                        $created_by = App\User::find($payment->created_by); 
                                    @endphp
 
                                    @if($created_by != "")
                                            <a href="#" data-toggle="tooltip" data-placement="right" title="{{'Collected By: '.$created_by->full_name}}">{{$payment->fees_type_id.'/'.$payment->id}}</a></td>
                                            @endif
                                    
 
                                <td>
                                @if($payment->payment_mode == "C")
                                        {{'Cash'}}
                                @elseif($payment->payment_mode == "Cq")
                                    {{'Cheque'}}
                                @elseif('DD')
                                    {{'DD'}}
                                @elseif('PS')
                                    {{'Paystack'}}
                                    @endif 
                                </td>
                                <td>
                                   
{{$payment->payment_date != ""? App\SmGeneralSettings::DateConvater($payment->payment_date):''}}

                                </td>
                                <td>{{$payment->discount_amount}}</td>
                                <td>{{$payment->fine}}</td>
                                <td>{{$payment->amount}}</td>
                                <td></td>
                                <td>
                                </td>
                            </tr>
                            @endforeach 

                        @endforeach
                        @foreach($fees_discounts as $fees_discount)
                        <tr>
                            <td>Discount</td>
                            <td>{{$fees_discount->feesDiscount !=""?$fees_discount->feesDiscount->name:""}}</td>
                            <td></td>
                            <td>@if(in_array($fees_discount->id, $applied_discount))
                                @php
                                    $createdBy = App\SmFeesAssign::createdBy($student_id, $fees_discount->id);
                                @endphp

                                @if($createdBy != "")

                                    $created_by = App\User::find($createdBy->created_by);


                                
                                    @if(!empty( $created_by ))
                                        <a href="#" data-toggle="tooltip" data-placement="right" title="{{'Collected By: '.$created_by->full_name}}">Discount of ${{$fees_discount->feesDiscount->amount}} Applied : {{$createdBy->id.'/'.$createdBy->created_by}}</a>
                                    @endif
                                    
                                @endif
                                
                                @else
                                Discount of ${{$fees_discount->feesDiscount !=""?$fees_discount->feesDiscount->amount:""}} Assigned
                                @endif
                            </td>
                            <td>{{$fees_discount->name}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Grand Total ({{$currency}})</th>
                            <th></th>
                            <th>{{$grand_total}}</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>{{$total_discount}}</th>
                            <th>{{$total_fine}}</th>
                            <th>{{$total_grand_paid}}</th>
                            <th>{{$total_balance}}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="modal fade admin-query" id="deleteFeesPayment" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Item</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4>Are you sure to delete this item?</h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancel</button>
                     {{ Form::open(['url' => 'fees-payment-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                     <input type="hidden" name="id" id="feep_payment_id">
                    <button class="primary-btn fix-gr-bg" type="submit">Delete</button>
                     {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
