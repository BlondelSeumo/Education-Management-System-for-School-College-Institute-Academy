@extends('backEnd.master')
@section('mainContent')

    <section class="mb-40">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h3 class="mb-30">Welcome Super Admin</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>Students</h3>
                                    <p class="mb-0">Total Students count</p>
                                </div>
                                <h1 class="gradient-color2">20,453</h1>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>Teachers</h3>
                                    <p class="mb-0">Total Teachers count</p>
                                </div>
                                <h1 class="gradient-color2">2,150</h1>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 mt-30-md">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>Parents</h3>
                                    <p class="mb-0">Total Parents count</p>
                                </div>
                                <h1 class="gradient-color2">1,500</h1>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 mt-30-md">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>Staffs</h3>
                                    <p class="mb-0">Total Staffs count</p>
                                </div>
                                <h1 class="gradient-color2">2,500</h1>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="" id="incomeExpenseDiv">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-9">
                    <div class="main-title">
                        <h3 class="mb-30">Income and Expenses for November 2018</h3>
                    </div>
                </div>
                <div class="offset-lg-2 col-lg-2 text-right col-md-3">
                    <button type="button" class="primary-btn small tr-bg icon-only" id="barChartBtn">
                        <span class="pr ti-move"></span>
                    </button>

                    <button type="button" class="primary-btn small fix-gr-bg icon-only ml-10" id="barChartBtnRemovetn">
                        <span class="pr ti-close"></span>
                    </button>
                </div>
                <div class="col-lg-12">
                    <div class="white-box" id="barChartDiv">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="text-center">
                                    <h1>$50,300</h1>
                                    <p>Total Income</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="text-center">
                                    <h1>$22,365</h1>
                                    <p>Total Expenses</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="text-center">
                                    <h1>$15,000</h1>
                                    <p>Total Profit</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="text-center">
                                    <h1>$46,750</h1>
                                    <p>Total Revenue</p>
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

    <section class="mt-50" id="incomeExpenseSessionDiv">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-9">
                    <div class="main-title">
                        <h3 class="mb-30">Income and Expenses for the Session 2018/19</h3>
                    </div>
                </div>
                <div class="offset-lg-2 col-lg-2 text-right col-md-3">
                    <button type="button" class="primary-btn small tr-bg icon-only" id="areaChartBtn">
                        <span class="pr ti-move"></span>
                    </button>

                    <button type="button" class="primary-btn small fix-gr-bg icon-only ml-10" id="areaChartBtnRemovetn">
                        <span class="pr ti-close"></span>
                    </button>
                </div>
                <div class="col-lg-12">
                    <div class="white-box" id="areaChartDiv">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="text-center">
                                    <h1>$50,300</h1>
                                    <p>Total Income</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="text-center">
                                    <h1>$22,365</h1>
                                    <p>Total Expenses</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="text-center">
                                    <h1>$15,000</h1>
                                    <p>Total Profit</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="text-center">
                                    <h1>$46,750</h1>
                                    <p>Total Revenue</p>
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

    <section class="mt-50">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h3 class="mb-30">Notice Board</h3>
                    </div>
                </div>

                <div class="col-lg-12">
                    <table class="school-table-style w-100">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td>Notice 01</td>
                            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.
                            </td>
                            <td>
                                <a href="#" class="primary-btn small tr-bg">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Notice 01</td>
                            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.
                            </td>
                            <td>
                                <a href="#" class="primary-btn small tr-bg">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Notice 01</td>
                            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.
                            </td>
                            <td>
                                <a href="#" class="primary-btn small tr-bg">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Notice 01</td>
                            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.
                            </td>
                            <td>
                                <a href="#" class="primary-btn small tr-bg">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Notice 01</td>
                            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.
                            </td>
                            <td>
                                <a href="#" class="primary-btn small tr-bg">View</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-50">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">Calendar</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="white-box">
                                <div class='common-calendar'></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mt-50-md">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">To Do List</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="white-box school-table">
                                <div class="single-to-do d-flex justify-content-between">
                                    <div>
                                        <input type="checkbox" id="midterm1" class="common-checkbox" name="midterm1">
                                        <label for="midterm1">
                                            <h5 class="d-inline">Midterm Exam Schedule</h5>
                                            <p class="ml-35">20th Nov, 2018</p>
                                        </label>
                                    </div>

                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            Edit
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">view</a>
                                            <a class="dropdown-item" href="#">edit</a>
                                            <a class="dropdown-item" href="#">delete</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-to-do d-flex justify-content-between">
                                    <div>
                                        <input type="checkbox" id="midterm2" class="common-checkbox" name="midterm2">
                                        <label for="midterm2">
                                            <h5 class="d-inline">Midterm Exam Schedule</h5>
                                            <p class="ml-35">20th Nov, 2018</p>
                                        </label>
                                    </div>

                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            Edit
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">view</a>
                                            <a class="dropdown-item" href="#">edit</a>
                                            <a class="dropdown-item" href="#">delete</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-to-do d-flex justify-content-between">
                                    <div>
                                        <input type="checkbox" id="midterm3" class="common-checkbox" name="midterm3">
                                        <label for="midterm3">
                                            <h5 class="d-inline">Midterm Exam Schedule</h5>
                                            <p class="ml-35">20th Nov, 2018</p>
                                        </label>
                                    </div>

                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            Edit
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">view</a>
                                            <a class="dropdown-item" href="#">edit</a>
                                            <a class="dropdown-item" href="#">delete</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-to-do d-flex justify-content-between">
                                    <div>
                                        <input type="checkbox" id="midterm4" class="common-checkbox" name="midterm4">
                                        <label for="midterm4">
                                            <h5 class="d-inline">Midterm Exam Schedule</h5>
                                            <p class="ml-35">20th Nov, 2018</p>
                                        </label>
                                    </div>

                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            Edit
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">view</a>
                                            <a class="dropdown-item" href="#">edit</a>
                                            <a class="dropdown-item" href="#">delete</a>
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

@endsection
