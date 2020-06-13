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
                <button type="button" class="primary-btn small fix-gr-bg" data-toggle="modal" data-target="#addInvoice">
                    <span class="pr ti-plus"></span>
                    add invoice
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="white-box">
                    <form>
                        <div class="row">
                            <div class="col-lg-6">
                                <select class="niceSelect w-100 bb">
                                    <option data-display="Select Class">Select Class</option>
                                    <option value="1">Front Office</option>
                                    <option value="2">Advertisement</option>
                                    <option value="4">Online Front Site</option>
                                    <option value="5">Google Ads</option>
                                    <option value="6">Admission Campaign</option>
                                </select>
                            </div>

                            <div class="col-lg-6">
                                <select class="niceSelect w-100 bb">
                                    <option data-display="Select Section">Select Section</option>
                                    <option value="1">Front Office</option>
                                    <option value="2">Advertisement</option>
                                    <option value="4">Online Front Site</option>
                                    <option value="5">Google Ads</option>
                                    <option value="6">Admission Campaign</option>
                                </select>
                            </div>

                            <div class="col-lg-12 mt-30 text-right">
                                <button class="primary-btn small fix-gr-bg" type="submit">
                                    <span class="pr ti-search"></span>
                                    search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4 mt-30-md">
                <div class="white-box">
                    <form>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                    <input class="primary-input form-control" type="text" name="search_by_keyword" value="">
                                    <label for="">Search By Keyword</label>
                                    <span class="focus-border"></span>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>error</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="text-right mt-30">
                                    <button class="primary-btn small tr-bg" type="submit">
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

<section class="adminssion-query">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-0">Invoice List</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="table_id" class="display school-table" cellspacing="0" width="100%">
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
</section>

<!-- Start Modal Area -->
<div class="modal fade invoice-details" id="addInvoice">
    <div class="modal-dialog large-modal modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Invoice</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row mb-20">
                        <div class="col-lg-4">
                            <div class="invoice-details-left">
                                <div class="mb-20">
                                    <label for="companyLogo" class="company-logo">
                                        <i class="ti-image"></i> Company Logo
                                    </label>
                                    <input id="companyLogo" type="file"/>
                                </div>

                                <div class="business-info">
                                    <h3>Google inc.</h3>
                                    <p>Mohamed Salah Qayser</p>
                                    <p>163, Golf green road, Rocky beach</p>
                                    <p>Los angeles, United States</p>
                                    <p>myemail@mycompany.com</p>
                                </div>
                            </div>
                        </div>

                        <div class="offset-lg-4 col-lg-4">
                            <div class="invoice-details-right">
                                <h1 class="text-uppercase">invoice</h1>

                                <div class="d-flex justify-content-between">
                                    <p class="fw-500 primary-color">Invoice Number#:</p>
                                    <p>0001</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="fw-500 primary-color">Invoice Data:</p>
                                    <p>07/07/2018</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="fw-500 primary-color">Reference::</p>
                                    <p>#698536</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="fw-500 primary-color">Due Date:</p>
                                    <p>07/07/2018</p>
                                </div>

                                <span class="primary-btn fix-gr-bg large mt-30">$2052.00</span>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="customer-info">
                                <h2>Bill To:</h2>
                            </div>

                            <div class="client-info">
                                <h3>Google inc.</h3>
                                <p>Mohamed Salah Qayser</p>
                                <p>163, Golf green road, Rocky beach</p>
                                <p>Los angeles, United States</p>
                                <p>myemail@mycompany.com</p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-30 mb-50">
                        <div class="col-lg-12">
                            <table class="d-table table-responsive custom-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="40%">Description</th>
                                        <th width="20%">Quantity</th>
                                        <th width="20%">Price</th>
                                        <th width="20%">Amount</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>Item 01</td>
                                        <td>03</td>
                                        <td>60.00</td>
                                        <td>180.00</td>
                                    </tr>
                                    <tr>
                                        <td>Item 01</td>
                                        <td>03</td>
                                        <td>60.00</td>
                                        <td>180.00</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-600 primary-color">Subtotal</td>
                                        <td>2400.00</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-600 primary-color">Discount <span>(10%)</span> </td>
                                        <td> <span>(-)</span> 240.00</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-600 primary-color">Shipping</td>
                                        <td>10.00</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-600 primary-color">GST <span>(5%)</span> </td>
                                        <td>108.00</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="fw-600 text-dark">Total</td>
                                        <td class="fw-600 text-dark">2052.00</td>
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
