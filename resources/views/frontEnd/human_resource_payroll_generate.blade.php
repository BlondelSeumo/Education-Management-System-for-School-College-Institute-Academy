@extends('backEnd.master')
@section('mainContent')

<section class="student-details mb-40">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-30">Staff Details and Attendance</h3>
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
                            <div class="col-lg-8">
                                <div class="single-meta mt-20">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6">
                                            <div class="value text-left">
                                                Name
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="name">
                                                Salmon Shashimi
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="value text-left">
                                                Class Section
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="name">
                                                Salmon Shashimi
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6">
                                            <div class="value text-left">
                                                Name
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="name">
                                                Salmon Shashimi
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="value text-left">
                                                Class Section
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="name">
                                                Salmon Shashimi
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="single-meta mt-20">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3">
                                            <div class="value text-left">
                                                Month
                                            </div>
                                        </div>
                                        <div class="col-lg-10 col-md-9 d-flex">
                                            <div class="value ml-30">
                                                P
                                            </div>
                                            <div class="value ml-30">
                                                L
                                            </div>
                                            <div class="value ml-30">
                                                A
                                            </div>
                                            <div class="value ml-30">
                                                F
                                            </div>
                                            <div class="value ml-30">
                                                V
                                            </div>
                                            <div class="value ml-30">
                                                H
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3">
                                            <div class="name text-left">
                                                January
                                            </div>
                                        </div>
                                        <div class="col-lg-10 col-md-9 d-flex">
                                            <div class="name ml-30">
                                                0
                                            </div>
                                            <div class="name ml-30">
                                                0
                                            </div>
                                            <div class="name ml-30">
                                                0
                                            </div>
                                            <div class="name ml-30">
                                                0
                                            </div>
                                            <div class="name ml-30">
                                                0
                                            </div>
                                            <div class="name ml-30">
                                                0
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

<section class="">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="d-flex justify-content-between mb-20">
                    <div class="main-title">
                        <h3>Earnings</h3>
                    </div>

                    <div>
                        <button class="primary-btn icon-only fix-gr-bg" id="addEarnings">
                            <span class="ti-plus"></span>
                        </button>
                    </div>
                </div>

                <div class="white-box">
                    <table class="w-100 table-responsive">
                        <tbody id="addEarningsTableBody">
                            <tr>
                                <td width="70%" class="pr-30">
                                    <div class="input-effect mt-10">
                                        <input class="primary-input form-control" type="text" id="searchByFileName">
                                        <label for="searchByFileName">Type</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                                <td width="20%" class="pr-30">
                                    <div class="input-effect mt-10">
                                        <input class="primary-input form-control" type="text" id="searchByFileName">
                                        <label for="searchByFileName">Value</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-4 no-gutters">
                <div class="d-flex justify-content-between mb-20">
                    <div class="main-title">
                        <h3>Deductions</h3>
                    </div>

                    <div>
                        <button class="primary-btn icon-only fix-gr-bg">
                            <span class="ti-plus"></span>
                        </button>
                    </div>
                </div>

                <div class="white-box">
                <table class="w-100 table-responsive">
                        <tbody>
                            <tr>
                                <td width="80%" class="pr-30">
                                    <div class="input-effect mt-10">
                                        <input class="primary-input form-control" type="text" id="searchByFileName">
                                        <label for="searchByFileName">Type</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                                <td width="20%">
                                    <div class="input-effect mt-10">
                                        <input class="primary-input form-control" type="text" id="searchByFileName">
                                        <label for="searchByFileName">Value</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-4 no-gutters">
                <div class="d-flex justify-content-between mb-20">
                    <div class="main-title">
                        <h3>Payroll Summary</h3>
                    </div>

                    <div>
                        <button class="primary-btn small tr-bg">
                           calculate
                        </button>
                    </div>
                </div>

                <div class="white-box">
                <table class="w-100 table-responsive">
                        <tbody class="d-block">
                            <tr class="d-block">
                                <td width="100%" class="pr-30 d-block">
                                    <div class="input-effect mt-10">
                                        <input class="primary-input form-control" type="text" id="basicSalary">
                                        <label for="basicSalary">Basic Salary</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Modal Area -->
@endsection
