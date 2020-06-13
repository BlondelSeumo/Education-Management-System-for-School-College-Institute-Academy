@extends('backEnd.master')
@section('mainContent')

<section class="student-details">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">Add Base Setup</h3>
                        </div>

                        <div class="white-box">
                            <div class="row">
                                <div class="col-lg-12">
                                    <select class="niceSelect w-100 bb">
                                        <option data-display="Purpose *">Purpose * </option>
                                        <option value="1">Marketing</option>
                                        <option value="2">parent Teacher Meeting</option>
                                        <option value="3">Student Meeting</option>
                                        <option value="4">Staff Meeting</option>
                                        <option value="5">Principal Meeting</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-35">
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

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">Base Setup List</h3>
                        </div>
                    </div>
                </div>

                <div class="row base-setup">
                    <div class="col-lg-12">
                        <table class="display school-table school-table-data" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="33%">Base Type</th>
                                    <th width="33%">Label</th>
                                    <th width="33%">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td colspan="3" class="pr-0">
                                        <div id="accordion" role="tablist">
                                            <div class="card">
                                                <div class="card-header d-flex justify-content-between" role="tab" id="headingOne">
                                                    <div class="row w-100 align-items-center">
                                                        <div class="col-lg-4">
                                                            <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            Designation
                                                            </a>
                                                        </div>
                                                        <div class="offset-lg-4 col-lg-3 pl-35">
                                                            <button class="primary-btn small tr-bg">
                                                                edit
                                                                <span class="ti-arrow-down pl"></span>
                                                            </button>
                                                        </div>
                                                        <div class="col-lg-1 text-right">
                                                            <a class="primary-btn icon-only tr-bg" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                <span class="ti-arrow-down"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="row pb-10 border-bottom">
                                                            <div class="offset-lg-4 col-lg-4">Teacher</div>
                                                            <div class="col-lg-4">
                                                                <button class="primary-btn small tr-bg">
                                                                    edit
                                                                    <span class="ti-arrow-down pl"></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="row pv-10 border-bottom">
                                                            <div class="offset-lg-4 col-lg-4">Teacher</div>
                                                            <div class="col-lg-4">
                                                                <button class="primary-btn small tr-bg">
                                                                    edit
                                                                    <span class="ti-arrow-down pl"></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="row pt-10">
                                                            <div class="offset-lg-4 col-lg-4">Teacher</div>
                                                            <div class="col-lg-4">
                                                                <button class="primary-btn small tr-bg">
                                                                    edit
                                                                    <span class="ti-arrow-down pl"></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header d-flex justify-content-between" role="tab" id="headingTwo">
                                                    <div class="row w-100 align-items-center">
                                                        <div class="col-lg-4">
                                                            <a data-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                            Gender
                                                            </a>
                                                        </div>
                                                        <div class="offset-lg-4 col-lg-3 pl-35">
                                                            <button class="primary-btn small tr-bg">
                                                                edit
                                                                <span class="ti-arrow-down pl"></span>
                                                            </button>
                                                        </div>
                                                        <div class="col-lg-1 text-right">
                                                            <a class="primary-btn icon-only tr-bg" data-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                                <span class="ti-arrow-down"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="row pb-10 border-bottom">
                                                            <div class="offset-lg-4 col-lg-4">Teacher</div>
                                                            <div class="col-lg-4">
                                                                <button class="primary-btn small tr-bg">
                                                                    edit
                                                                    <span class="ti-arrow-down pl"></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="row pv-10 border-bottom">
                                                            <div class="offset-lg-4 col-lg-4">Teacher</div>
                                                            <div class="col-lg-4">
                                                                <button class="primary-btn small tr-bg">
                                                                    edit
                                                                    <span class="ti-arrow-down pl"></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="row pt-10">
                                                            <div class="offset-lg-4 col-lg-4">Teacher</div>
                                                            <div class="col-lg-4">
                                                                <button class="primary-btn small tr-bg">
                                                                    edit
                                                                    <span class="ti-arrow-down pl"></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade admin-query student-details" id="viewList">
    <div class="modal-dialog large-modal modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Admission Query</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="student-meta-box">
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-2 col-md-5">
                                    <div class="value text-left">
                                        Name
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-7">
                                    <div class="name">
                                        Salmon Shashimi
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-5">
                                    <div class="value text-left">
                                        Class Section
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-7">
                                    <div class="name">
                                        Salmon Shashimi
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-2 col-md-5">
                                    <div class="value text-left">
                                        Name
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-7">
                                    <div class="name">
                                        Salmon Shashimi
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-5">
                                    <div class="value text-left">
                                        Class Section
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-7">
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

@endsection
