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

        <div class="row mb-30">
            <div class="col-lg-12">
                <div class="white-box">
                    <form>
                        <div class="row">
                            <div class="col-lg-3">
                                <select class="niceSelect w-100 bb">
                                    <option data-display="Academic Year*">Academic Year *</option>
                                    <option value="1">Front Office</option>
                                    <option value="2">Advertisement</option>
                                    <option value="4">Online Front Site</option>
                                    <option value="5">Google Ads</option>
                                    <option value="6">Admission Campaign</option>
                                </select>
                            </div>

                            <div class="col-lg-3 mt-30-md">
                                <select class="niceSelect w-100 bb">
                                    <option data-display="Select Class">Select Class</option>
                                    <option value="1">Front Office</option>
                                    <option value="2">Advertisement</option>
                                    <option value="4">Online Front Site</option>
                                    <option value="5">Google Ads</option>
                                    <option value="6">Admission Campaign</option>
                                </select>
                            </div>

                            <div class="col-lg-3 mt-30-md">
                                <select class="niceSelect w-100 bb">
                                    <option data-display="Promotion Academic Year*">Promotion Academic Year*</option>
                                    <option value="1">All</option>
                                    <option value="2">Active</option>
                                    <option value="3">Passive</option>
                                    <option value="4">Dead</option>
                                    <option value="5">Won</option>
                                    <option value="6">Lost</option>
                                </select>
                            </div>

                            <div class="col-lg-3 mt-30-md">
                                <select class="niceSelect w-100 bb">
                                    <option data-display="promoted Class*">promoted Class*</option>
                                    <option value="1">All</option>
                                    <option value="2">Active</option>
                                    <option value="3">Passive</option>
                                    <option value="4">Dead</option>
                                    <option value="5">Won</option>
                                    <option value="6">Lost</option>
                                </select>
                            </div>

                            <div class="offset-lg-7 col-lg-2 mt-30">
                                <div class="d-flex radio-btn-flex ml-40">
                                    <div class="mr-30">
                                        <input type="radio" name="radio" id="normal" class="common-radio"/>
                                        <label for="normal">Normal</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="radio" id="advances" class="common-radio"/>
                                        <label for="advances">Advances</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 mt-30 text-right">
                                <button class="primary-btn small fix-gr-bg">
                                    <span class="pr ti-search"></span>
                                    search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row mb-30">
            <div class="col-lg-12">
                <div class="white-box">
                    <form>
                        <div class="row">
                            <div class="col-lg-6 mb-30">
                                <p class="text-uppercase fw-500 mb-10">Exam Name</p>
                                <div class="d-flex radio-btn-flex">
                                    <div class="mr-30">
                                        <input type="radio" name="radio" id="firstTrimester" class="common-radio"/>
                                        <label for="firstTrimester">1st Trimester</label>
                                    </div>
                                    <div class="mr-30">
                                        <input type="radio" name="radio" id="secondTrimester" class="common-radio"/>
                                        <label for="secondTrimester">2nd Trimester</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="radio" id="thirdTrimester" class="common-radio"/>
                                        <label for="thirdTrimester">3rd Trimester</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-30">
                                <p class="text-uppercase fw-500 mb-10">Mark Percentage</p>
                                <div class="d-flex radio-btn-flex">
                                    <div class="mr-30">
                                        <input type="radio" name="radio" id="Written" class="common-radio"/>
                                        <label for="Written">Written</label>
                                    </div>
                                    <div class="mr-30">
                                        <input type="radio" name="radio" id="Practical" class="common-radio"/>
                                        <label for="Practical">Practical</label>
                                    </div>
                                    <div class="mr-30">
                                        <input type="radio" name="radio" id="Assignment" class="common-radio"/>
                                        <label for="Assignment">Assignment</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="radio" id="Lab Test" class="common-radio"/>
                                        <label for="Lab Test">Lab Test</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <select class="niceSelect w-100 bb">
                                    <option data-display="English Pass Mark">English Pass Mark</option>
                                    <option value="1">Front Office</option>
                                    <option value="2">Advertisement</option>
                                    <option value="4">Online Front Site</option>
                                    <option value="5">Google Ads</option>
                                    <option value="6">Admission Campaign</option>
                                </select>
                            </div>

                            <div class="col-lg-3 mt-30-md">
                                <select class="niceSelect w-100 bb">
                                    <option data-display="Maths Pass Mark">Maths Pass Mark</option>
                                    <option value="1">Front Office</option>
                                    <option value="2">Advertisement</option>
                                    <option value="4">Online Front Site</option>
                                    <option value="5">Google Ads</option>
                                    <option value="6">Admission Campaign</option>
                                </select>
                            </div>

                            <div class="col-lg-3 mt-30-md">
                                <select class="niceSelect w-100 bb">
                                    <option data-display="Science Pass Mark">Science Pass Mark</option>
                                    <option value="1">All</option>
                                    <option value="2">Active</option>
                                    <option value="3">Passive</option>
                                    <option value="4">Dead</option>
                                    <option value="5">Won</option>
                                    <option value="6">Lost</option>
                                </select>
                            </div>

                            <div class="col-lg-3 mt-30-md">
                                <select class="niceSelect w-100 bb">
                                    <option data-display="History Pass Mark">History Pass Mark</option>
                                    <option value="1">All</option>
                                    <option value="2">Active</option>
                                    <option value="3">Passive</option>
                                    <option value="4">Dead</option>
                                    <option value="5">Won</option>
                                    <option value="6">Lost</option>
                                </select>
                            </div>

                            <div class="col-lg-12 mt-30 text-center">
                                <button class="primary-btn fix-gr-bg">
                                    Promotion Mark Setting
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="adminssion-query">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-0">Promotion List</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="table_id" class="display school-table pb-120" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Admission No.</th>
                            <th>Section</th>
                            <th>Mark Summary</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Salmon Shashimi</td>
                            <td>98562341</td>
                            <td>Section A</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        Edit
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
                            <td>Salmon Shashimi</td>
                            <td>98562341</td>
                            <td>Section A</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        Edit
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
                            <td>Salmon Shashimi</td>
                            <td>98562341</td>
                            <td>Section A</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        Edit
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
                            <td>Salmon Shashimi</td>
                            <td>98562341</td>
                            <td>Section A</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        Edit
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" type="button">view</button>
                                        <button class="dropdown-item" type="button">edit</button>
                                        <button class="dropdown-item" type="button">delete</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>

            <div class="col-lg-12 mt-30 text-center exam-cus-btns">
                <button class="primary-btn fix-gr-bg mr-10">
                    Promotion to Class 02
                </button>

                <button class="primary-btn medium tr-bg">
                    Enroll to Class 01
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Start Modal Area -->
<div class="modal fade student-details" id="addHomework">
    <div class="modal-dialog large-modal modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Evaluate Homework</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <form action="">
                        <div class="row">
                            <div class="col-lg-7">
                                <select class="multipleSelect" multiple name="language">
                                    <option value="Bangladesh1">Bangladesh 1</option>
                                    <option selected value="Barbados1">Barbados 1</option>
                                    <option selected value="Belarus1">Belarus 1</option>
                                    <option value="Belgium1">Belgium 1</option>
                                    <option value="Bangladesh2">Bangladesh 2</option>
                                    <option value="Barbados2">Barbados 2</option>
                                    <option value="Belarus2">Belarus 2</option>
                                    <option value="Belgium2">Belgium 2</option>
                                    <option value="Bangladesh3">Bangladesh 3</option>
                                    <option value="Barbados3">Barbados 3</option>
                                    <option value="Belarus3">Belarus 3</option>
                                    <option value="Belgium3">Belgium 3</option>
                                    <option value="Bangladesh4">Bangladesh 4</option>
                                    <option value="Barbados4">Barbados 4</option>
                                    <option value="Belarus4">Belarus 4</option>
                                    <option value="Belgium4">Belgium 4</option>
                                    <option value="Bangladesh5">Bangladesh 5</option>
                                    <option value="Barbados5">Barbados 5</option>
                                    <option value="Belarus5">Belarus 5</option>
                                    <option value="Belgium5">Belgium 5</option>
                                </select>
                            </div>

                            <div class="col-lg-5">
                                <h4 class="stu-sub-head">Summery</h4>
                                <div class="student-meta-box">
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                Created by
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                Travor James
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                Evaluated by
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                Travor James
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                Homework Date
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                31st Oct, 2018
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                Submission Date
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                31st Oct, 2018
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                Evaluation Date
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                31st Oct, 2018
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                Section
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                A
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                Class
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                Subject
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                General Knowledge
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                Description
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                Sample description
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-30">
                                <button type="button" class="primary-btn small fix-gr-bg">
                                    <span class="pr ti-download"></span>
                                    download
                                </button>
                                </div>
                            </div>
                            </div>

                            <div class="col-lg-12 text-center mt-40">
                                <button class="primary-btn fix-gr-bg">
                                    <span class="ti-check"></span>
                                    save information
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Modal Area -->
@endsection
