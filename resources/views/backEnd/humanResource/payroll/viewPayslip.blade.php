<script src="{{asset('public/backEnd/')}}/js/main.js"></script>
<div class="container-fluid">
    <div class="student-details">
        <div class="text-center mb-4">
            <div class="d-flex justify-content-center">
                <div>
                    <img class="logo-img" src="http://localhost/naim/schoolmanagementsystem/public/backEnd/img/logo.png"
                        alt="">
                </div>
                <div class="ml-30">
                    <h2>@if(isset($schoolDetails)){{$schoolDetails->school_name}} @endif</h2>
                    <p class="mb-0">@if(isset($schoolDetails)){{$schoolDetails->address}} @endif</p>
                </div>
            </div>
            <h3 class="mt-3">Payslip for the period of {{$payrollDetails->payroll_month}} {{$payrollDetails->payroll_year}}</h3>
        </div>

        <div class="single-meta d-flex justify-content-between mb-4">
            <div class="value text-left">
                Payslip #@if(isset($payrollDetails)){{$payrollDetails->id}} @endif
            </div>
            <div class="name">
               
                Payment Date: @if(isset($payrollDetails))

                {{App\SmGeneralSettings::DateConvater($payrollDetails->payment_date)}}
               
                @endif
            </div>
        </div>


        <div class="student-meta-box">
            <div class="single-meta">
                <div class="row">
                    <div class="col-lg-3 col-md-5">
                        <div class="value text-left">
                            Staff ID
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-7">
                        <div class="name">
                            @if(isset($payrollDetails)){{$payrollDetails->staffs->staff_no}} @endif
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5">
                        <div class="value text-left">
                            Name
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-7">
                        <div class="name">
                            @if(isset($payrollDetails)){{$payrollDetails->staffDetails->full_name}} @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="single-meta">
                <div class="row">
                    <div class="col-lg-3 col-md-5">
                        <div class="value text-left">
                            Department
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-7">
                        <div class="name">
                            @if(isset($payrollDetails)){{$payrollDetails->staffDetails->departments->name}} @endif

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5">
                        <div class="value text-left">
                            Designation
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-7">
                        <div class="name">
                            @if(isset($payrollDetails)){{$payrollDetails->staffDetails->designations->title}} @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="single-meta">
                <div class="row">
                    <div class="col-lg-3 col-md-5">
                        <div class="value text-left">
                            Payment Mode
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-7">
                        <div class="name">
                            @if($payrollDetails->payment_mode != "")
                            {{$payrollDetails->paymentMethods->method}}
                            @endif

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5">
                        <div class="value text-left">
                            Basic Salary
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-7">
                        <div class="name">
                            @if(isset($payrollDetails)){{$payrollDetails->basic_salary}} @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-meta">
                <div class="row">
                    <div class="col-lg-3 col-md-5">
                        <div class="value text-left">
                            Gross Salary
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-7">
                        <div class="name">
                            @if(isset($payrollDetails)){{$payrollDetails->gross_salary}} @endif
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5">
                        <div class="value text-left">
                            Net Salary
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-7">
                        <div class="name">
                            @if(isset($payrollDetails)){{$payrollDetails->net_salary}} @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>