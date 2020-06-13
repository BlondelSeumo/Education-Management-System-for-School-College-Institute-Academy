@extends('backEnd.master')
@section('mainContent')
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">Select Criteria </h3>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <form>
                            <div class="row">
                                <div class="col-lg-6">
                                    <select class="niceSelect w-100 bb">
                                        <option data-display="Select Class">Select Month</option>
                                        <option value="1"> May </option>
                                        <option value="2"> June </option>
                                    </select>
                                </div>

                                <div class="col-lg-6 mt-30-md">
                                    <select class="niceSelect w-100 bb">
                                        <option data-display="Select Class">Select Package</option>
                                        <option value="1">Infix Edu</option>
                                        <option value="2">Infix Clasified</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>

            <div class="row mt-40">
                

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-20">Purchase List</h3>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                    		<div class="white-box">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                              
                                    <tr>
                                        <th>SL No.</th> 
                                        <th>Package</th>
                                        <th>Purchase Date</th>
                                        <th>Expaire Date</th>
                                        <th>Price</th>
                                        <th>Paid Amount</th>
                                        <th>Due Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($ProductPurchase as $p)
                                    <tr>
                                        <td>{{$p->id}}</td>
                                        <td>{{$p->package}}</td> 
                                        <td>{{$p->purchase_date}}</td> 
                                        <td>{{$p->expaire_date}}</td> 
                                        <td>{{$p->price}}</td> 
                                        <td>{{$p->paid_amount}}</td> 
                                        <td>{{$p->due_amount}}</td> 
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                    Edit
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#">View</a>
                                                    <a class="dropdown-item" href="#">Download</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            
    </div>
</section>
  

@endsection
