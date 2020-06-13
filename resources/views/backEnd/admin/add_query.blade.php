@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.admin')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.admin')</a>
                <a href="{{route('admission_query')}}">@lang('lang.admission_query')</a>
                <a href="{{route('add_query', [$admission_query->id])}}">@lang('lang.follow_up')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="main-title">
                            <h3 class="mb-30">@lang('lang.follow_up_admission_query')</h3>
                        </div>
                    </div>
                </div>
                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'query_followup_store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                <div class="row">
                    <div class="col-lg-12">

                        <div class="white-box">
                            @if(session()->has('message-success'))
                              <div class="alert alert-success">
                                  {{ session()->get('message-success') }}
                              </div>
                            @elseif(session()->has('message-danger'))
                              <div class="alert alert-danger">
                                  {{ session()->get('message-danger') }}
                              </div>
                            @endif
                            <div class="row mt-30">
                                <input type="hidden" name="id" id="id" value="{{$admission_query->id}}">
                                <div class="col-lg-4">
                                    <div class="no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control{{ $errors->has('follow_up_date') ? ' is-invalid' : '' }}" id="startDate" type="text"
                                                     name="follow_up_date" readonly="true" value="{{date('m/d/Y', strtotime($admission_query->next_follow_up_date))}}">
                                                <label>@lang('lang.follow_up_date')</label>
                                                @if ($errors->has('follow_up_date'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('follow_up_date') }}</strong>
                                                    </span>
                                                @endif
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
                                                <input class="primary-input date form-control{{ $errors->has('next_follow_up_date') ? ' is-invalid' : '' }}" id="endDate" type="text"
                                                     name="next_follow_up_date" autocomplete="off" readonly="true" readonly="true" value="{{old('next_follow_up_date')}}">
                                                <label>@lang('lang.next_follow_up_date')<span>*</span></label>
                                                @if ($errors->has('next_follow_up_date'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('next_follow_up_date') }}</strong>
                                                    </span>
                                                @endif
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
                                    <select class="niceSelect w-100 bb" name="status">
                                        <option value="1" {{$admission_query->active_status == '1'? 'selected':''}}>@lang('lang.active')</option>
                                        <option value="2" {{$admission_query->active_status == '2'? 'selected':''}}>@lang('lang.inactive')</option>
                                    </select>
                                </div> 
                            </div>
                            <div class="row mt-25">
                                <div class="col-lg-6">
                                    <div class="input-effect">
                                        <textarea class="primary-input form-control{{ $errors->has('response') ? ' is-invalid' : '' }}" cols="0" rows="3" name="response" id="address">{{old('response')}}</textarea>
                                        <label>@lang('lang.response') <span>*</span> </label>
                                        <span class="focus-border textarea"></span>
                                        @if ($errors->has('response'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('response') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-effect">
                                        <textarea class="primary-input form-control" cols="0" rows="3" name="note" id="description">{{old('note')}}</textarea>
                                        <label>@lang('lang.note') <span></span> </label>
                                        <span class="focus-border textarea"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-30">
                                <div class="col-lg-12 text-center">
                                    <button class="primary-btn fix-gr-bg">
                                        <span class="ti-check"></span>
                                        @lang('lang.save')
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
                                    <h3 class="mb-0"> @lang('lang.follow_up_list')</h3>
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
                                            <td colspan="4">
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
                                            <th>@lang('lang.query_by')</th>
                                            <th>@lang('lang.response')</th>
                                            <th>@lang('lang.note')</th>
                                            <th>@lang('lang.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($follow_up_lists as $follow_up_list)
                                        <tr>
                                            <td>{{$follow_up_list->user!=""?$follow_up_list->user->full_name:""}}</td>
                                            <td>{{$follow_up_list->response}}</td>
                                            <td>{{$follow_up_list->note}}</td>
                                            
                                            <td valign="top">
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                        @lang('lang.select')
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#deletefollowUpQuery{{$follow_up_list->id}}"  href="">@lang('lang.delete')</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade admin-query" id="deletefollowUpQuery{{$follow_up_list->id}}" >
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">@lang('lang.delete_follow_up_query')</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                        </div>

                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                            <a href="{{route('delete_follow_up', [$follow_up_list->id])}}" class="text-light primary-btn fix-gr-bg">@lang('lang.delete')
                                                             </a>
                                                        </div>
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
            <div class="col-lg-4 mt-45">
                <div class="student-meta-box">
                    <div class="white-box radius-t-y-0 student-details">
                        <div class="single-meta mt-10">
                            <h3 class="mb-30">@lang('lang.details') </h3>
                        </div>
                        <div class="single-meta mt-10">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    @lang('lang.created_by'):
                                </div>
                                <div class="value">
                                    {{$admission_query->user !=""?$admission_query->user->full_name:""}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    @lang('lang.query_date'):
                                </div>
                                <div class="value">
                                    {{ !empty($admission_query->date)? App\SmGeneralSettings::DateConvater($admission_query->date):''}}
                                   
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    @lang('lang.last_follow_up_date'):
                                </div>
                                <div class="value">
                                    {{ !empty($admission_query->last_follow_up_date)? App\SmGeneralSettings::DateConvater($admission_query->last_follow_up_date):''}}
                                    </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    @lang('lang.next_follow_up_date'):
                                </div>
                                <div class="value">
                                    {{ !empty($admission_query->next_follow_up_date)? App\SmGeneralSettings::DateConvater($admission_query->next_follow_up_date):''}}
                                    </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    @lang('lang.phone'):
                                </div>
                                <div class="value">
                                    {{$admission_query->phone}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    @lang('lang.address'):
                                </div>
                                <div class="value">
                                    {{$admission_query->address}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    @lang('lang.reference'):
                                </div>
                                <div class="value">
                                    {{$admission_query->reference != ""? $admission_query->referenceSetup->name:""}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    @lang('lang.description'):
                                </div>
                                <div class="value">
                                    {{$admission_query->description}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    @lang('lang.source'):
                                </div>
                                <div class="value">
                                    {{$admission_query->source != ""? $admission_query->sourceSetup->name:""}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    @lang('lang.assigned'):
                                </div>
                                <div class="value">
                                    {{$admission_query->assigned}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    @lang('lang.email'):
                                </div>
                                <div class="value">
                                    {{$admission_query->email}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    @lang('lang.class'):
                                </div>
                                <div class="value">
                                    {{$admission_query->class != ""? $admission_query->className->class_name:""}}
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    @lang('lang.number_of_child'):
                                </div>
                                <div class="value">
                                    {{$admission_query->no_of_child}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
