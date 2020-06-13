@extends('backEnd.master')
@section('mainContent')
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3>@if(isset($section)) 
                                    Edit 
                                
                                @else 
                                    Add 
                                
                                @endif 
                                Section
                            </h3>
                        </div>
                        @if(isset($section))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'section_update', 'method' => 'POST']) }}
                        @else
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'section_store', 'method' => 'POST']) }}
                        @endif
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row  mt-25">
                                    <div class="col-lg-12">
                                        @if(session()->has('message-success'))
                                          <div class="alert alert-success">
                                              {{ session()->get('message-success') }}
                                          </div>
                                        @elseif(session()->has('message-danger'))
                                          <div class="alert alert-danger">
                                              {{ session()->get('message-danger') }}
                                          </div>
                                        @endif
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" autocomplete="off" value="{{isset($section)? $section->section_name: ''}}">
                                            <input type="hidden" name="id" value="{{isset($section)? $section->id: ''}}">
                                            <label>Name <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
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
                        {{ Form::close() }}
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3>Section List</h3>
                        </div>
                    </div>

                    <div class="offset-lg-4 col-md-4 d-flex justify-content-end">
                        <select class="niceSelect tr-bg mr-10">
                            <option data-display="Column View">Column View</option>
                            <option value="Name">Name</option>
                            <option value="Position">Phone</option>
                            <option value="Source">Source</option>
                            <option value="Query Date">Query Date</option>
                            <option value="Last Follow Up Date">Last Follow Up Date</option>
                            <option value="Next Follow Up Date">Next Follow Up Date</option>
                            <option value="Status">Status</option>
                            <option value="Action">Action</option>
                            <option value="Restore Visibility">Restore Visibility</option>
                        </select>
                        <select class="niceSelect tr-bg">
                            <option data-display="Actions">Actions</option>
                            <option value="1">Print</option>
                            <option value="2">Export to CSV</option>
                            <option value="3">Export to Excel</option>
                            <option value="4">Export to Pdf</option>
                            <option value="5">Copy Table</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                               @if(session()->has('message-success-delete') != " " ||
                                session()->get('message-danger-delete') != "")
                                <tr>
                                    <td colspan="3">
                                         @if(session()->has('message-success-delete'))
                                          <div class="alert alert-success">
                                              {{ session()->get('message-success-delete') }}
                                          </div>
                                        @elseif(session()->has('message-danger-delete'))
                                          <div class="alert alert-danger">
                                              {{ session()->get('message-danger-delete') }}
                                          </div>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <th>Class</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($sections as $section)
                                <tr>
                                    <td>{{$section->section_name}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                Select
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{route('section_edit', [$section->id])}}">edit</a>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteSectionModal{{$section->id}}"  href="#">delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                 <div class="modal fade" id="deleteSectionModal{{$section->id}}" role="dialog">
                                    <div class="modal-dialog">
                                    
                                      <!-- Modal content-->
                                      <div class="modal-content modalContent">
                                        <div class="modal-body removeBtn">
                                          <p>Are you sure to delete an item.?</p>
                                        </div>
                                        <div class="modal-footer compareFooter deleteButtonDiv">
                                            <button type="button" class="modalbtn btn-primary"><a href="{{route('section_delete', [$section->id])}}" class="text-light">Yes</a></button>
                                            <button type="button" class="modalbtn btn-danger" data-dismiss="modal">No</button>
                                        </div>
                                      </div>
                                      
                                    </div>
                                  </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
