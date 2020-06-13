@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.supplier') @lang('lang.list')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.inventory')</a>
                <a href="#">@lang('lang.supplier') @lang('lang.list')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
         @if(isset($editData))
          @if(in_array(329, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
           
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('suppliers')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.add')
                </a>
            </div>
        </div>
        @endif
        @endif
        <div class="row">
            
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">@if(isset($editData))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.supplier')
                            </h3>
                        </div>
                        @if(isset($editData))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'suppliers/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                        @else
                         @if(in_array(329, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'suppliers',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        @endif
                        @endif
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    @if(session()->has('message-success'))
                                    <div class="alert alert-success mb-20">
                                        {{ session()->get('message-success') }}
                                    </div>
                                    @elseif(session()->has('message-danger'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('message-danger') }}
                                    </div>
                                    @endif
                                   <div class="col-lg-12 mb-30">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}"
                                            type="text" name="company_name" autocomplete="off" value="{{isset($editData)? $editData->company_name : old('company_name') }}">
                                            <label> @lang('lang.company')  @lang('lang.name') <span>*</span> </label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('company_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('company_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-30">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control{{$errors->has('company_address') ? 'is-invalid' : '' }}" cols="0" rows="4" name="company_address" id="company_address">{{isset($editData) ? $editData->company_address : old('company_address')}}</textarea>
                                            <label> @lang('lang.company')  @lang('lang.address') <span></span> </label>
                                            <span class="focus-border textarea"></span>
                                            @if ($errors->has('company_address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('company_address') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-30">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('contact_person_name') ? ' is-invalid' : '' }}"
                                            type="text" name="contact_person_name" autocomplete="off" value="{{isset($editData)? $editData->contact_person_name : old('contact_person_name') }}">
                                            <label>@lang('lang.contact_person_name') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('contact_person_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('contact_person_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-30">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('contact_person_mobile') ? ' is-invalid' : '' }}"
                                            type="number" name="contact_person_mobile" autocomplete="off" value="{{isset($editData)? $editData->contact_person_mobile : old('contact_person_mobile') }}">
                                            <label>@lang('lang.contact_person') @lang('lang.mobile') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('contact_person_mobile'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('contact_person_mobile') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-30">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('contact_person_email') ? ' is-invalid' : '' }}"
                                            type="text" name="contact_person_email" autocomplete="off" value="{{isset($editData)? $editData->contact_person_email : old('contact_person_email') }}">
                                            <label>@lang('lang.contact_person') @lang('lang.email') </label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('contact_person_email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('contact_person_email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-30">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4" name="description" id="description">{{isset($editData) ? $editData->description : old('description')}}</textarea>
                                            <label>@lang('lang.description') <span></span> </label>
                                            <span class="focus-border textarea"></span>

                                        </div>
                                    </div>

                                </div>
                                	  @php 
                                  $tooltip = "";
                                  if(in_array(329, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            @if(isset($editData))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
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
                        <h3 class="mb-0"> @lang('lang.supplier')  @lang('lang.list')</h3>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                        <thead>
                            @if(session()->has('message-success-delete') != "" ||
                                session()->get('message-danger-delete') != "")
                                <tr>
                                    <td colspan="6">
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
                                <th> @lang('lang.supplier')  @lang('lang.name')</th>
                                <th> @lang('lang.company')  @lang('lang.name')</th>
                                <th> @lang('lang.company')  @lang('lang.address')</th>
                                <th> @lang('lang.email')</th>
                                <th> @lang('lang.mobile')</th>
                                <th> @lang('lang.action')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(isset($suppliers))
                            @foreach($suppliers as $value)
                            <tr>

                                <td>{{$value->contact_person_name}}</td>
                                <td>{{$value->company_name}}</td>
                                <td>{{$value->company_address}}</td>
                                <td>{{$value->contact_person_email}}</td>
                                <td>{{$value->contact_person_mobile}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            @lang('lang.select')
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
 @if(in_array(330, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                                            <a class="dropdown-item" href="{{url('suppliers/'.$value->id.'/edit')}}"> @lang('lang.edit')</a>
@endif
 @if(in_array(331, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                                            <a class="deleteUrl dropdown-item" data-modal-size="modal-md" title="Delete Supplier" href="{{url('delete-supplier-view/'.$value->id)}}"> @lang('lang.delete')</a>
@endif
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
