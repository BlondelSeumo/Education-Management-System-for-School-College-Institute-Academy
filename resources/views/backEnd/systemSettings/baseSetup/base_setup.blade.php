@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.base_setup')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.system_settings')</a>
                <a href="#">@lang('lang.base_setup')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        @if(isset($base_setup))
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('base_setup')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.add')
                </a>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">@if(isset($base_setup))
                                    @lang('lang.edit')

                                @else
                                    @lang('lang.add')

                                @endif
                                @lang('lang.base_setup')
                            </h3>
                        </div>
                        @if(isset($base_setup))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'base_setup_update',
                        'method' => 'POST']) }}
                        @else
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'base_setup_store',
                        'method' => 'POST']) }}
                        @endif
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @if(session()->has('message-success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session()->get('message-success') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @elseif(session()->has('message-danger'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session()->get('message-danger') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('base_group') ? ' is-invalid' : '' }}"
                                            name="base_group">
                                            <option data-display="@lang('lang.base_group') *" value="">@lang('lang.base_group')*</option>
                                            @foreach($base_groups as $base_group)
                                            @if(isset($base_setup))
                                            <option value="{{$base_group->id}}"
                                                {{$base_group->id == $base_setup->base_group_id? 'selected': ''}}>{{$base_group->name}}</option>
                                            @else
                                            <option value="{{$base_group->id}}">{{$base_group->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @if($errors->has('base_group'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('base_group') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row  mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                type="text" name="name" value="{{isset($base_setup)? $base_setup->base_setup_name: ''}}">
                                            <input type="hidden" name="id" value="{{isset($base_setup)? $base_setup->id: ''}}">
                                            <label>@lang('lang.name') <span>*</span></label>
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
                                            @if(isset($base_setup))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                            @lang('lang.base_setup')
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
                            <h3 class="mb-0">@lang('lang.base_setup') @lang('lang.list')</h3>
                        </div>
                    </div>
                </div>

                <div class="row base-setup">
                    <div class="col-lg-12">
                        <table class="display school-table school-table-data" cellspacing="0" width="100%">
                            <thead>
                                @if(session()->has('message-success-delete') != "" ||
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
                                {{-- {{ $tables }} --}}
                                 @endif
                                <tr>
                                    <th width="33%">@lang('lang.base') @lang('lang.type')</th>
                                    <th width="33%">@lang('lang.label')</th>
                                    <th width="33%">@lang('lang.action')</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr>
                                    <td colspan="3" class="pr-0">
                                        <div id="accordion" role="tablist">
                                            @php $i = 0; @endphp
                                            @foreach($base_groups as $base_group)

                                            <div class="card">
                                                <div class="card-header d-flex justify-content-between" role="tab" id="headingOne{{$base_group->id}}">
                                                    <div class="row w-100 align-items-center">
                                                        <div class="col-lg-6">
                                                            <a data-toggle="collapse" href="#collapseOne{{$base_group->id}}" aria-expanded="true" aria-controls="collapseOne{{$base_group->id}}">
                                                            {{$base_group->name}}
                                                            </a>
                                                        </div>
                                                        <div class="col-lg-6 text-right">
                                                            <a class="primary-btn icon-only tr-bg" data-toggle="collapse" href="#collapseOne{{$base_group->id}}" aria-expanded="true" aria-controls="collapseOne">
                                                                <span class="ti-arrow-down"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                $base_setups = $base_group->baseSetups;
                                                @endphp
                                                <div id="collapseOne{{$base_group->id}}" class="collapse {{$i++ == 0? 'show':''}}" role="tabpanel" aria-labelledby="headingOne{{$base_group->id}}" data-parent="#accordion">
                                                    <div class="card-body">
                                                        @foreach($base_setups as $base_setup)
                                                        <div class="row py-3 border-bottom align-items-center">
                                                            <div class="offset-lg-4 col-lg-4">{{$base_setup->base_setup_name}}</div>
                                                            <div class="col-lg-4">
                                                                <div class="dropdown">
                                                                    <button type="button" class="btn dropdown-toggle"
                                                                        data-toggle="dropdown">
                                                                        @lang('lang.select')
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a class="dropdown-item" href="{{route('base_setup_edit', [$base_setup->id])}}">@lang('lang.edit')</a>
                                                                        <a class="dropdown-item deleteBaseSetupModal" href="#" data-toggle="modal" data-target="#deleteBaseSetupModal" data-id="{{$base_setup->id}}">@lang('lang.delete')</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            @endforeach
                                            
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


<div class="modal fade admin-query" id="deleteBaseSetupModal" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('lang.delete') @lang('lang.base_setup')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                     {{ Form::open(['route' => 'base_setup_delete', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                     <input type="hidden" name="id" value="" id="base_setup_id">
                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                     {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</div>



@endsection
