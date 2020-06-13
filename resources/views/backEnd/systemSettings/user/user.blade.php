@extends('backEnd.master')
@section('mainContent')
<section class="mb-40">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4">
                <div class="main-title">
                    <h3 class="mb-30">Select Criteria </h3>
                </div>
            </div>
            <div class="offset-lg-6 col-lg-2 text-right">
                <a href="{{route('user_create')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    add
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <form>
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date" id="startDate" type="text"
                                                    placeholder="Start Date">
                                                <span class="focus-border"></span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date" id="endDate" type="text" placeholder="End Date">
                                                <span class="focus-border"></span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="end-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <select class="niceSelect w-100 bb">
                                        <option data-display="Source">Source</option>
                                        <option value="1">Front Office</option>
                                        <option value="2">Advertisement</option>
                                        <option value="4">Online Front Site</option>
                                        <option value="5">Google Ads</option>
                                        <option value="6">Admission Campaign</option>
                                    </select>
                                </div>

                                <div class="col-lg-3">
                                    <select class="niceSelect w-100 bb">
                                        <option data-display="Status">Status</option>
                                        <option value="1">All</option>
                                        <option value="2">Active</option>
                                        <option value="3">Passive</option>
                                        <option value="4">Dead</option>
                                        <option value="5">Won</option>
                                        <option value="6">Lost</option>
                                    </select>
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
                    <h3 class="mb-0">User Details</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="">Name
                                    </label>
                                </div>
                            </th>
                            <th>Phone</th>
                            <th>Source</th>
                            <th>Query Date</th>
                            <th>Last Follow up Date</th>
                            <th>Next Follow up Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="">Salmon
                                        Shashimi
                                    </label>
                                </div>
                            </td>
                            <td>+44633331234</td>
                            <td>Front Offic</td>
                            <td>31st Oct, 2018</td>
                            <td>23rd Oct, 2018</td>
                            <td>31st Oct, 2018</td>
                            <td>Active</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        Edit
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" type="button" data-toggle="modal" data-target="#editStudent">edit</button>
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

@endsection