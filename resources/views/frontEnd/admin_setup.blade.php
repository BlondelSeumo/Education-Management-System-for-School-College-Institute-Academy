@extends('backEnd.master')
@section('mainContent')

<section class="student-details">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs mb-50 ml-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#purposeTab" role="tab" data-toggle="tab">purpose</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#complaintTab" role="tab" data-toggle="tab">complaint</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sourceTab" role="tab" data-toggle="tab">source</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#referenceTab" role="tab" data-toggle="tab">Reference</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Start Purpose Tab -->
                    <div role="tabpanel" class="tab-pane fade show active" id="purposeTab">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="main-title">
                                            <h3 class="mb-30">Add Purpose</h3>
                                        </div>

                                        <div class="white-box">
                                            <div class="">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <select class="niceSelect w-100 bb">
                                                            <option data-display="Purpose *">Purpose <span>*</span> </option>
                                                            <option value="1">Marketing</option>
                                                            <option value="2">parent Teacher Meeting</option>
                                                            <option value="3">Student Meeting</option>
                                                            <option value="4">Staff Meeting</option>
                                                            <option value="5">Principal Meeting</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mt-25">
                                                    <div class="col-lg-12">
                                                        <div class="input-effect">
                                                            <textarea class="primary-input form-control" cols="0" rows="3"></textarea>
                                                            <label>Description</label>
                                                            <span class="focus-border textarea"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-40">
                                                    <div class="col-lg-12 text-center">
                                                        <button class="primary-btn fix-gr-bg">
                                                            <span class="ti-check"></span>
                                                            save content
                                                        </button>
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
                                            <h3 class="mb-0">Purpose List</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="display school-table school-table-data" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Purpose Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>Meet the child</td>
                                                    <td>
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
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Purpose Tab -->

                    <!-- Start Complaint Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="complaintTab">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="main-title">
                                            <h3 class="mb-30">Add Complaint</h3>
                                        </div>

                                        <div class="white-box">
                                            <div class="">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <select class="niceSelect w-100 bb">
                                                            <option data-display="Complaint *">Complaint *</option>
                                                            <option value="1">Marketing</option>
                                                            <option value="2">parent Teacher Meeting</option>
                                                            <option value="3">Student Meeting</option>
                                                            <option value="4">Staff Meeting</option>
                                                            <option value="5">Principal Meeting</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mt-25">
                                                    <div class="col-lg-12">
                                                        <div class="input-effect">
                                                            <span class="focus-border textarea"></span>
                                                            <textarea class="primary-input form-control" cols="0" rows="3"></textarea>
                                                            <label>Description</label>
                                                            <span class="focus-border textarea"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-40">
                                                    <div class="col-lg-12 text-center">
                                                        <button class="primary-btn fix-gr-bg">
                                                            <span class="ti-check"></span>
                                                            save content
                                                        </button>
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
                                            <h3 class="mb-0">Complaint List</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="display school-table school-table-data" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Complaint Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>Meet the child</td>
                                                    <td>
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
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Complaint Tab -->

                    <!-- Start Source Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="sourceTab">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="main-title">
                                            <h3 class="mb-30">Add Source</h3>
                                        </div>

                                        <div class="white-box">
                                            <div class="">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <select class="niceSelect w-100 bb">
                                                            <option data-display="Source *">Source *</option>
                                                            <option value="1">Marketing</option>
                                                            <option value="2">parent Teacher Meeting</option>
                                                            <option value="3">Student Meeting</option>
                                                            <option value="4">Staff Meeting</option>
                                                            <option value="5">Principal Meeting</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mt-25">
                                                    <div class="col-lg-12">
                                                        <div class="input-effect">
                                                            <span class="focus-border textarea"></span>
                                                            <textarea class="primary-input form-control" cols="50" rows="3"></textarea>
                                                            <label>Description</label>
                                                            <span class="focus-border textarea"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-40">
                                                    <div class="col-lg-12 text-center">
                                                        <button class="primary-btn fix-gr-bg">
                                                            <span class="ti-check"></span>
                                                            save content
                                                        </button>
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
                                            <h3 class="mb-0">Source List</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="display school-table school-table-data" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Source Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>Meet the child</td>
                                                    <td>
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
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Source Tab -->

                    <!-- Start Reference Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="referenceTab">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="main-title">
                                            <h3 class="mb-30">Add Reference</h3>
                                        </div>

                                        <div class="white-box">
                                            <div class="">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <select class="niceSelect w-100 bb">
                                                            <option data-display="Reference *">Reference *</option>
                                                            <option value="1">Marketing</option>
                                                            <option value="2">parent Teacher Meeting</option>
                                                            <option value="3">Student Meeting</option>
                                                            <option value="4">Staff Meeting</option>
                                                            <option value="5">Principal Meeting</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mt-25">
                                                    <div class="col-lg-12">
                                                        <div class="input-effect">
                                                            <span class="focus-border textarea"></span>
                                                            <textarea class="primary-input form-control" cols="0" rows="3"></textarea>
                                                            <label>Description</label>
                                                            <span class="focus-border textarea"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-40">
                                                    <div class="col-lg-12 text-center">
                                                        <button class="primary-btn fix-gr-bg">
                                                            <span class="ti-check"></span>
                                                            save content
                                                        </button>
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
                                            <h3 class="mb-0">Reference List</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="display school-table school-table-data" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Reference Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>Meet the child</td>
                                                    <td>
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
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Reference Tab -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
