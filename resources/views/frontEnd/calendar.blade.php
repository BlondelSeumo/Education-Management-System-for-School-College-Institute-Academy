
@extends('backEnd.master')
@section('mainContent')

<section class="student-details">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between">
                            <div class="main-title">
                                <h3 class="mb-30">To Do List</h3>
                            </div>
                            <div class="">
                                <button type="button" class="primary-btn fix-gr-bg icon-only">
                                    <span class="ti-plus"></span>
                                </button>
                            </div>
                        </div>

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

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
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
        </div>
    </div>
</section>

@endsection
