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
                    <h3 class="mb-30">Class Report</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <div class="student-meta-box mb-40">
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="value text-left text-uppercase">
                                        Class Informations
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="value text-left text-uppercase">
                                        Quantity
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        Number of Students
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        50
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        Total Subjects assigned
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        08
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="student-meta-box mb-40">
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="value text-left text-uppercase">
                                        Subjects
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="value text-left text-uppercase">
                                        Teachers
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        General Knowledge
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        Travor James
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        Applied Checmistry
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        Mark Weins
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="student-meta-box mb-40">
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="value text-left text-uppercase">
                                        Class Teacher
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="value text-left text-uppercase">
                                        Information
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        General Knowledge
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        Travor James
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        Applied Checmistry
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="name text-left">
                                        Mark Weins
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="student-meta-box">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left text-uppercase">
                                                Fees Types
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left text-uppercase">
                                                Collection
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name text-left">
                                                General Knowledge
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name text-left">
                                                Travor James
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name text-left">
                                                General Knowledge
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name text-left">
                                                Travor James
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="value text-left text-uppercase bb-15 pb-7">
                                                Fees Types
                                            </div>

                                            <!-- <div id="commonBarChart" height="150px"></div> -->
                                            <div id="donutChart" height="200px"></div>
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
<!-- End Modal Area -->
@endsection
