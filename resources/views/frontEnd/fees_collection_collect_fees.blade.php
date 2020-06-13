@extends('backEnd.master')
@section('mainContent')

@php  $setting = App\SmGeneralSettings::find(1);  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   @endphp 

<section class="student-details mb-40">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-30">Student Fees</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="student-meta-box">
                    <div class="student-meta-top staff-meta-top"></div>
                    <img class="student-meta-img img-100" src="{{asset('public/backEnd/img/student/student-meta-img.png')}}" alt="">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="single-meta mt-20">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                Name
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                Salmon Shashimi
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                Name
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                Salmon Shashimi
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                Name
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                Salmon Shashimi
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="offset-lg-2 col-lg-5 col-md-6">
                                <div class="single-meta mt-20">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                Name
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                Salmon Shashimi
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                Name
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                Salmon Shashimi
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                Name
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                Salmon Shashimi
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="adminssion-query">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="d-flex justify-content-between">
                    <div class="main-title">
                        <h3 class="mb-30">Add Fees</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table class="display school-table school-table-style" cellspacing="0" width="100%">
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
                            <th>Balance</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>
                                <button class="primary-btn small tr-bg">paid</button>
                            </td>

                            <td>350.00</td>
                            <td>#563148</td>
                            <td>Cash</td>
                            <td>21st Oct, 2018</td>
                            <td>1500.00</td>
                            <td>200.00</td>
                            <td>98562341</td>
                            <td></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        Add Fees
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" type="button">view</button>
                                        <button class="dropdown-item" type="button">edit</button>
                                        <button class="dropdown-item" type="button">delete</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Class 2</td>
                            <td></td>
                            <td></td>
                            <td>
                                <button class="primary-btn small tr-bg">paid</button>
                            </td>




                            <td>#563148</td>
                            <td>Cash</td>
                            <td>21st Oct, 2018</td>
                            <td>1500.00</td>
                            <td>200.00</td>
                            <td>98562341</td>
                            <td></td>

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        Add Fees
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">view</a>
                                        <a class="dropdown-item" href="#">edit</a>
                                        <a class="dropdown-item" href="#">delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>1</td>
                            <td>2</td>
                            <td>45</td>
                            <td>5</td>
                            <td>6</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>


                    </tbody>

                    <tfoot>
                        <tr>
                            <td class="fw-600 primary-color"></td>
                            <td class="fw-600 primary-color"></td>
                            <td class="fw-600 primary-color">Grand Total ($)</td>
                            <td class="fw-600 primary-color"></td>
                            <td class="fw-600 primary-color">2100.00</td>
                            <td class="fw-600 primary-color"></td>
                            <td class="fw-600 primary-color"></td>
                            <td class="fw-600 primary-color">1800.00</td>
                            <td class="fw-600 primary-color">450.00</td>
                            <td class="fw-600 primary-color">1800.00</td>
                            <td class="fw-600 primary-color">1000.00</td>
                            <td class="fw-600 primary-color"></td>
                            <td class="fw-600 primary-color"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- End Modal Area -->
@endsection

