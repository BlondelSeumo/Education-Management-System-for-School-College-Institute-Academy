<!DOCTYPE html>
<html>
<head>
    <title>Fees Payment</title>
    <style>
    
        .school-table-style {
            padding: 10px 0px!important;
        }
        .school-table-style tr th {
            font-size: 8px!important;
            text-align: left!important;
        }
        .school-table-style tr td {
            font-size: 9px!important;
            text-align: left!important;
            padding: 10px 0px!important;
        }
        .logo-image {
            width: 10%;
        }
    </style>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/style.css" />
</head>
<body>
@php  $setting = App\SmGeneralSettings::find(1);  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   @endphp 
 
    <table style="width: 100%;">
        <tr>
             
            <td style="width: 30%"> 
                <img src="{{url($setting->logo)}}" alt="{{url($setting->logo)}}"> 
            </td> 
            <td  style="width: 70%">  
                <h3>{{$setting->school_name}}</h3>
                <h4>{{$setting->address}}</h4>
            </td> 
        </tr> 
    </table>
    <hr>
    <table class="school-table school-table-style" cellspacing="0" width="100%">
        <tr>
            <td>Student Name</td>
            <td>{{$student->full_name}}</td>
            <td>Roll Number</td>
            <td>{{$student->roll_no}}</td>
        </tr>
        <tr>
            <td> Father's Name</td>
            <td>{{$student->parents->fathers_name}}</td>
            <td>Class</td>
            <td>{{$student->className->class_name}}</td>
        </tr>
        <tr>
            <td> Section</td>
            <td>{{$student->section->section_name}}</td>
            <td>Admission Number</td>
            <td>{{$student->admission_no}}</td>
        </tr>
    </table>
    <div class="text-center"> 
        <h4 class="text-center mt-1"><span>Fees Payment</span></h4>
    </div>
	<table class="school-table school-table-style" cellspacing="0" width="100%">
        <thead>
            <tr align="center">
                <th>Date</th>
                <th>Fees Group</th>
                <th>Fees Code</th>
                <th>Mode</th>
                <th>Amount ({{$currency}})</th>
                <th>Discount ({{$currency}})</th>
                <th>Fine ({{$currency}})</th>
            </tr>
        </thead>

        <tbody>
            
            <tr align="center">
                <td>
                   
{{$payment->payment_date != ""? App\SmGeneralSettings::DateConvater($payment->payment_date):''}}

                </td>
                <td>{{$group}}</td>
                <td>{{$payment->feesType->code}}</td>
                <td>
                @if($payment->payment_mode == "C")
                        {{'Cash'}}
                @elseif($payment->payment_mode == "Cq")
                    {{'Cheque'}}
                @else
                    {{'DD'}}
                @endif 
                </td>
                <td>{{$payment->amount}}</td>
                <td>{{$payment->discount_amount}}</td>
                <td>{{$payment->fine}}</td>
                <td></td>
            </tr>
            
        </tbody>
    </table>
</body>
</html>
