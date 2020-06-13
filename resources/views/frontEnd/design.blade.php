@extends('backEnd.master')
@section('mainContent')

<section class="mb-40 sms-accordion">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                Collapsible Group Item #1
                            </a>
                            <div>
                                <button type="submit" class="primary-btn small tr-bg mr-10">Edit </button>
                                <button type="submit" class="primary-btn small tr-bg">Delete </button>
                            </div>
                        </div>
                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8">
                                        Lorem ipsum dolor
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="mb-0">
                                            <span class="ti-calendar mr-10"></span>
                                            Publish Date : 01/23/2019
                                        </p>
                                        <p class="mb-0">
                                            <span class="ti-calendar mr-10"></span>
                                            Notice Date : 01/23/2019
                                        </p>
                                        <p>
                                            <span class="ti-user mr-10"></span>
                                            Created By : Super Admin
                                        </p>

                                        <h4>Message To</h4>

                                        <p class="mb-0">
                                            <span class="ti-user mr-10"></span>
                                            Teacher
                                        </p>
                                        <p class="mb-0">
                                            <span class="ti-user mr-10"></span>
                                            Accountant
                                        </p>
                                        <p class="mb-0">
                                            <span class="ti-user mr-10"></span>
                                            Librarian
                                        </p>
                                        <p class="mb-0">
                                            <span class="ti-user mr-10"></span>
                                            Super Admin
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header  d-flex justify-content-between">
                            <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                                Collapsible Group Item #2
                            </a>
                            <div>
                                <button type="submit" class="primary-btn small tr-bg mr-10">Edit </button>
                                <button type="submit" class="primary-btn small tr-bg">Delete </button>
                            </div>
                        </div>
                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8">
                                        Lorem ipsum dolor
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="mb-0">
                                            <span class="ti-calendar mr-10"></span>
                                            Publish Date : 01/23/2019
                                        </p>
                                        <p class="mb-0">
                                            <span class="ti-calendar mr-10"></span>
                                            Notice Date : 01/23/2019
                                        </p>
                                        <p>
                                            <span class="ti-user mr-10"></span>
                                            Created By : Super Admin
                                        </p>

                                        <h4>Message To</h4>

                                        <p class="mb-0">
                                            <span class="ti-user mr-10"></span>
                                            Teacher
                                        </p>
                                        <p class="mb-0">
                                            <span class="ti-user mr-10"></span>
                                            Accountant
                                        </p>
                                        <p class="mb-0">
                                            <span class="ti-user mr-10"></span>
                                            Librarian
                                        </p>
                                        <p class="mb-0">
                                            <span class="ti-user mr-10"></span>
                                            Super Admin
                                        </p>
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

<!-- Start Ck Editor -->
<section class="adminssion-query">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title">
                    <h3 class="mb-30">CK Editor</h3>
                    <div class="white-box">
                        <textarea name="aaa" id="ckEditor" cols="" rows="5"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Ck Editor -->

<!-- Start Assign Class Room Editor -->
<section class="mt-40">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title">
                    <h3 class="mb-30">Assign Class Room</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="10%">Name</th>
                            <th width="10%">Roll</th>
                            <th width="10%">Age</th>
                            <th width="15%">Room Number</th>
                            <th width="20%">Capacity</th>
                            <th width="20%">Student No.</th>
                            <th width="10%" class="text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                        <tr>
                            <td>Bablu</td>
                            <td>0365847</td> 
                            <td>43</td>
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
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input" type="text" placeholder="Enter Room Number" name="monday_room" value="{{isset($class_routine->monday_room_id)? $class_routine->monday_room_id:''}}">
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input" type="text" placeholder="Enter Student No" name="monday_room" value="{{isset($class_routine->monday_room_id)? $class_routine->monday_room_id:''}}">
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-right">
                                <button class="primary-btn icon-only bg-danger">
                                    <span class="ti-minus text-white"></span>
                                </button>
                                <button class="primary-btn icon-only fix-gr-bg ml-10">
                                    <span class="ti-plus"></span>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn fix-gr-bg">
                                        <span class="ti-check"></span>
                                        Save Content
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- End Assign Class Room Editor -->

<!-- Start Modal Area -->
<div class="modal fade invoice-details" id="addInvoice">
    <div class="modal-dialog large-modal modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data Table in Modal</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="" class="display school-table-data school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Class</th>
                                        <th>Fee Type</th>
                                        <th>Amount</th>
                                        <th>Due amount</th>
                                        <th>Payment Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>Salman Shashimi</td>
                                        <td>Class 01</td>
                                        <td>Tution Fee</td>
                                        <td>500.00</td>
                                        <td>200.00</td>
                                        <td>
                                            <a href="#" class="primary-btn small tr-bg">
                                                partially paid
                                            </a>
                                        </td>
                                        <td>25th Oct, 2018</td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Area -->
@endsection
