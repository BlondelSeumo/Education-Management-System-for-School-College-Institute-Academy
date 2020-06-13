@extends('backEnd.master')
@section('mainContent')

<section class="mb-40">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">Select Criteria </h3>
                </div>
            </div>
            <div class="col-lg-4 text-md-right text-left col-md-6 mb-30-lg">
                <button type="button" class="primary-btn small fix-gr-bg">
                    <span class="pr ti-plus"></span>
                    add homework
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <form>
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="col-lg-4">
                                    <select class="niceSelect w-100 bb">
                                        <option data-display="Select Class">Select Class</option>
                                        <option value="1">Front Office</option>
                                        <option value="2">Advertisement</option>
                                        <option value="4">Online Front Site</option>
                                        <option value="5">Google Ads</option>
                                        <option value="6">Admission Campaign</option>
                                    </select>
                                </div>

                                <div class="col-lg-4 mt-30-md">
                                    <select class="niceSelect w-100 bb">
                                        <option data-display="Select Section">Select Section</option>
                                        <option value="1">Front Office</option>
                                        <option value="2">Advertisement</option>
                                        <option value="4">Online Front Site</option>
                                        <option value="5">Google Ads</option>
                                        <option value="6">Admission Campaign</option>
                                    </select>
                                </div>

                                <div class="col-lg-4 mt-30-md">
                                    <select class="niceSelect w-100 bb">
                                        <option data-display="Subject">Subject</option>
                                        <option value="1">All</option>
                                        <option value="2">Active</option>
                                        <option value="3">Passive</option>
                                        <option value="4">Dead</option>
                                        <option value="5">Won</option>
                                        <option value="6">Lost</option>
                                    </select>
                                </div>

                                <div class="col-lg-12 mt-30 text-right">
                                    <button class="primary-btn small fix-gr-bg">
                                        <span class="pr ti-search"></span>
                                        search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="student-details">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-30">Student Terminal Report</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="single-report-admit">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex">
                                            <div>
                                                <img class="logo-img" src="http://localhost/naim/schoolmanagementsystem/public/backEnd/img/logo.png" alt="">
                                            </div>
                                            <div class="ml-30">
                                                <h3 class="text-white">School Management System</h3>
                                                <p class="text-white mb-0">House 25, Road 27, Block B, 54th Floor, New York, United States of America</p>
                                            </div>
                                        </div>
                                        <div>
                                            <img class="report-admit-img" src="{{asset('public/backEnd/img/student/report/report1.jpg')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <h3>Salmon Shashimi</h3>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <p class="mb-0">
                                                        Academic Year : <span class="primary-color fw-500">2018-19</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        Position in Class : <span class="primary-color fw-500">1st</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        Position in Class : <span class="primary-color fw-500">CSE04506185</span>
                                                    </p>
                                                </div>

                                                <div class="col-lg-3">
                                                    <p class="mb-0">
                                                        Class : <span class="primary-color fw-500">01</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        Section : <span class="primary-color fw-500">A</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        Roll No : <span class="primary-color fw-500">9865236542</span>
                                                    </p>
                                                </div>

                                                <div class="col-lg-3">
                                                    <p class="mb-0">
                                                        Academic Year : <span class="primary-color fw-500">2018-19</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        Position in Class : <span class="primary-color fw-500">1st</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        Position in Class : <span class="primary-color fw-500">CSE04506185</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="w-100 mt-30 mb-20">
                                            <thead>
                                                <tr>
                                                    <th>Subjects</th>
                                                    <th>Exam</th>
                                                    <th>Attendance</th>
                                                    <th>Class Test</th>
                                                    <th>Assignment</th>
                                                    <th>Total</th>
                                                    <th>Position</th>
                                                    <th>Grade</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Mathemetics</td>
                                                    <td>42</td>
                                                    <td>08</td>
                                                    <td>15</td>
                                                    <td>20</td>
                                                    <td>83</td>
                                                    <td>7th</td>
                                                    <td>A+</td>
                                                    <td>Excellent</td>
                                                </tr>
                                                <tr>
                                                    <td>Mathemetics</td>
                                                    <td>42</td>
                                                    <td>08</td>
                                                    <td>15</td>
                                                    <td>20</td>
                                                    <td>83</td>
                                                    <td>7th</td>
                                                    <td>A+</td>
                                                    <td>Excellent</td>
                                                </tr>
                                                <tr>
                                                    <td>Mathemetics</td>
                                                    <td>42</td>
                                                    <td>08</td>
                                                    <td>15</td>
                                                    <td>20</td>
                                                    <td>83</td>
                                                    <td>7th</td>
                                                    <td>A+</td>
                                                    <td>Excellent</td>
                                                </tr>
                                                <tr>
                                                    <td>Mathemetics</td>
                                                    <td>42</td>
                                                    <td>08</td>
                                                    <td>15</td>
                                                    <td>20</td>
                                                    <td>83</td>
                                                    <td>7th</td>
                                                    <td>A+</td>
                                                    <td>Excellent</td>
                                                </tr>
                                                <tr>
                                                    <td>Mathemetics</td>
                                                    <td>42</td>
                                                    <td>08</td>
                                                    <td>15</td>
                                                    <td>20</td>
                                                    <td>83</td>
                                                    <td>7th</td>
                                                    <td>A+</td>
                                                    <td>Excellent</td>
                                                </tr>
                                            </tbody>
                                        </table>
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
