@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.admission_query')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.admin_section')</a>
                <a href="#">@lang('lang.admission_query')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.select_criteria')</h3>
                    </div>
                </div>
                <div class="col-lg-4 text-md-right text-left col-md-6 mb-30-lg">
                        <?php
                        
                        $modules = [];
                        $module_links = [];
                        $permissions = App\SmRolePermission::where('role_id', Auth::user()->role_id)->get();
                        foreach ($permissions as $permission) {
                            $module_links[] = $permission->module_link_id;
                            $modules[] = $permission->moduleLink->module_id;
                        }
                        $modules = array_unique($modules);
                        
                        ?>
                
                    @if(in_array(13, $module_links) || Auth::user()->role_id == 1)
                        <button class="primary-btn-small-input primary-btn small fix-gr-bg" type="button" data-toggle="modal" data-target="#addQuery">
                            <span class="ti-plus pr-2"></span>
                            @lang('lang.add')
                        </button>
                    @endif
                </div>
            </div>
            

            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'admission-query-search', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
            <div class="row">
                <div class="col-lg-12">
                <div class="white-box">
                    <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                         <input name="date_from" readonly class="primary-input date" type="text" autocomplete="off" value="{{isset($date_from)? ($date_from != ""? $date_from:''):''}}">
                                         <label>@lang('lang.date_from')</label>
                                        <span class="focus-border"></span>
                                     </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                         <input name="date_to" readonly class="primary-input date" type="text" autocomplete="off" value="{{isset($date_to)? ($date_to != ""? $date_to:''):''}}">
                                         <label>@lang('lang.date_to')</label>
                                        <span class="focus-border"></span>
                                        
                                     </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                         <select name="source" class="niceSelect w-100 bb form-control">
                                            <option data-display="Select source" value="">@lang('lang.select_source')</option>
                                             @foreach($sources as $source)
                                                <option value="{{$source->id}}" {{isset($source_id)? ($source_id == $source->id? 'selected':''):''}}>{{$source->name}}</option>
                                            @endforeach
                                        </select>
                                       
                                     </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                         <select class="niceSelect w-100 bb form-control" name="status">
                                            <option data-display="@lang('lang.select_status')" value="">@lang('lang.Status')</option>
                                            <option  value="1" {{isset($status_id)? ($status_id ==  '1'? 'selected':''):''}}>@lang('lang.active')</option>
                                            <option  value="2" {{isset($status_id)? ($status_id == '2'? 'selected':''):''}}>@lang('lang.inactive')</option>
                                        </select>
                                       
                                     </div>
                                </div>
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        @lang('lang.search')
                                    </button>
                                </div>
                            </div>

                    </div>
                    

                </div>
            </div>

            {{ Form::close() }}

            <div class="row mt-40">
                

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">@lang('lang.query_list')</h3>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    @if(session()->has('message-success') != "" ||
                                    session()->get('message-danger') != "")
                                    <tr>
                                        <td colspan="10">
                                            @if(session()->has('message-success'))
                                            <div class="alert alert-success">
                                                {{--  {{ session()->get('message-success') }}--}}
                                                @lang('lang.inserted_message')
                                            </div>
                                            @elseif(session()->has('message-danger'))
                                            <div class="alert alert-danger">
                                                @lang('lang.error_message')
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>@lang('lang.name')</th>
                                        <th>@lang('lang.phone')</th>
                                        <th>@lang('lang.source')</th>
                                        <th>@lang('lang.query_date')</th>
                                        <th>@lang('lang.last_follow_up_date')</th>
                                        <th>@lang('lang.next_follow_up_date')</th>
                                        <th>@lang('lang.actions')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($admission_queries as $admission_query)
                                    <tr>
                                        <td>{{$admission_query->name}}</td>
                                        <td>{{$admission_query->phone}}</td>
                                        <td>{{$admission_query->source != ""? $admission_query->sourceSetup->name:''}}</td>
                                        <td  data-sort="{{strtotime($admission_query->date)}}" >{{App\SmGeneralSettings::DateConvater($admission_query->date)}}  </td>
                                        <td  data-sort="{{strtotime($admission_query->last_follow_up_date)}}" >
                                    {{$admission_query->last_follow_up_date != ""? App\SmGeneralSettings::DateConvater($admission_query->last_follow_up_date):''}}

                                        </td>
                                        <td  data-sort="{{strtotime($admission_query->next_follow_up_date)}}" >
                                            {{$admission_query->next_follow_up_date != ""? App\SmGeneralSettings::DateConvater($admission_query->next_follow_up_date):''}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                    @lang('lang.select')
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @if(in_array(13, $module_links) || Auth::user()->role_id == 1)
                                                       <a class="dropdown-item" href="{{route('add_query', [$admission_query->id])}}">@lang('lang.add_query')</a>
                                                    @endif
                                                    @if(in_array(14, $module_links) || Auth::user()->role_id == 1)
                                                     <a class="dropdown-item modalLink" data-modal-size="large-modal" title="@lang('lang.edit') @lang('lang.admission_query')"  href="{{route('admission_query_edit', [$admission_query->id])}}" >@lang('lang.edit')</a>
                                                    @endif
                                                    @if(in_array(15, $module_links) || Auth::user()->role_id == 1)
                                                     <a class="dropdown-item deleteAdmissionQueryModal" href="#" data-toggle="modal" data-target="#deleteAdmissionQueryModal" data-id="{{$admission_query->id}}">@lang('lang.delete')</a>
                                                    @endif
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
</section>

<div class="modal fade admin-query" id="deleteAdmissionQueryModal" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('lang.delete_admission_query')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                     {{ Form::open(['route' => 'admission_query_delete', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                     <input type="hidden" name="id" value="" id="query_id">
                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                     {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</div>



<!-- Start Sibling Add Modal -->
<div class="modal fade admin-query" id="addQuery">
    <div class="modal-dialog large-modal modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('lang.admission_query')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'admission_query_store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'admission-query-store']) }}
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="input-effect">
                                            <input class="primary-input read-only-input form-control" type="text" name="name" id="name">
                                            <label>@lang('lang.name')<span>*</span></label>
                                            <span class="text-danger" role="alert" id="nameError">
                                                
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-effect">
                                            <input class="primary-input read-only-input form-control" type="text" name="phone" id="phone">
                                            <label>@lang('lang.phone')<span>*</span></label>
                                            <span class="text-danger" role="alert" id="phoneError">
                                               
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-effect">
                                            <input class="primary-input read-only-input form-control" type="text" name="email">
                                            <label>@lang('lang.email')<span></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-25">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="3" name="address" id="address"></textarea>
                                            <label>@lang('lang.address')<span></span> </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="3" name="description" id="description"></textarea>
                                            <label>@lang('lang.description')<span></span> </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-25">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input date form-control" id="startDate" type="text"
                                                        name="date" readonly="true" value="{{date('m/d/Y')}}">
                                                    <label>@lang('lang.date')</label>
                                                    {{-- <span class="text-danger">{{ $errors->has('date') ? $errors->first('date') : ' ' }}</span> --}}
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="start-date-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input date form-control" id="endDate" type="text"
                                                         name="next_follow_up_date" autocomplete="off" readonly="true" value="{{date('m/d/Y')}}">
                                                    <label>@lang('lang.next_follow_up_date')</label>
                                                    {{-- <span class="text-danger">{{ $errors->has('next_follow_up_date') ? $errors->first('next_follow_up_date') : ' ' }}</span> --}}
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="end-date-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-effect">
                                            <input class="primary-input read-only-input form-control" type="text" name="assigned">
                                            <label>@lang('lang.assigned')<span></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-25">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <select class="niceSelect w-100 bb" name="reference">
                                            <option data-display="Reference" value="">@lang('lang.reference')</option>
                                            @foreach($references as $reference)
                                                <option value="{{$reference->id}}">{{$reference->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <select class="niceSelect w-100 bb" name="source" id="source">
                                            <option data-display="Source *" value="">@lang('lang.source')*</option>
                                            @foreach($sources as $source)
                                                <option value="{{$source->id}}">{{$source->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" role="alert" id="sourceError">
                                            
                                        </span>
                                    </div>
                                    <div class="col-lg-3">
                                        <select class="niceSelect w-100 bb" name="class" id="class">
                                            <option data-display="Class" value="">@lang('lang.class')</option>
                                            @foreach($classes as $class)
                                                <option value="{{$class->id}}">{{$class->class_name}}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-effect">
                                            <input class="primary-input read-only-input form-control" type="number" name="no_of_child">
                                            <label>@lang('lang.number_of_child')<span></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 text-center mt-40">
                                <div class="mt-40 d-flex justify-content-between">
                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>

                                    <button class="primary-btn fix-gr-bg" id="save_button_query" type="submit">@lang('lang.save')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{ Form::close() }}

        </div>
    </div>
</div>
<!-- End Sibling Add Modal -->


@endsection
