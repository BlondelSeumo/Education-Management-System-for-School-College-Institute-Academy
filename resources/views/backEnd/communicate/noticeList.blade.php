@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.notice_board')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.communicate')</a>
                <a href="#">@lang('lang.notice_board')</a>
            </div>
        </div>
    </div>
</section>

<section class="mb-40 sms-accordion">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.all') @lang('lang.notices')</h3>
                </div>
            </div>
             @if(in_array(288, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
            <div class="offset-lg-6 col-lg-2 text-right col-md-6">
                <a href="{{url('add-notice')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.add') @lang('lang.notice')
                </a>
            </div>
            @endif
        </div>
              @if(session()->has('message-success-delete'))
             <div class="alert alert-success">
             {{ session()->get('message-success-delete') }}
              </div>
              @elseif(session()->has('message-danger-delete'))
              <div class="alert alert-danger">
                  {{ session()->get('message-danger-delete') }}
              </div>
              @endif
        <div class="row">
            <div class="col-lg-12">
                <div id="accordion">
                   @php $i = 0; @endphp
                   @if(isset($allNotices))
                   @foreach($allNotices as $value)
                   <div class="card">
                     <a class="card-link" data-toggle="collapse" href="#notice{{$value->id}}">
                        <div class="card-header d-flex justify-content-between">

                            {{$value->notice_title}}

                            <div>
 @if(in_array(289, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                             <a href="{{url('edit-notice/'.$value->id)}}">
                                <button type="submit" class="primary-btn small tr-bg mr-10">@lang('lang.edit') </button>
                             </a>
                             @endif
                              @if(in_array(290, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                                <a class="deleteUrl" data-modal-size="modal-md" title="Delete Notice" href="{{url('delete-notice-view/'.$value->id)}}"><button class="primary-btn small tr-bg">@lang('lang.delete') </button></a>
                            @endif
                            </div>
                        </div>
                    </a>
                    @php $i++; @endphp
                    <div id="notice{{$value->id}}" class="collapse {{$i ==  1 ? 'show' : ''}}" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    {!! $value->notice_message !!}
                                </div>
                                <div class="col-lg-4">
                                    <p class="mb-0">
                                        <span class="ti-calendar mr-10"></span>
                                        @lang('lang.publish')  @lang('lang.date') :
                                        
                                         
                                         {{$value->publish_on != ""? App\SmGeneralSettings::DateConvater($value->publish_on):''}}


                                    </p>
                                    <p class="mb-0">
                                        <span class="ti-calendar mr-10"></span>
                                        @lang('lang.notice')  @lang('lang.date') : 
                                        
                                        {{$value->notice_date != ""? App\SmGeneralSettings::DateConvater($value->notice_date):''}}

                                    </p>
                                    <p>
                                        <span class="ti-user mr-10"></span>
                                        @lang('lang.created_by') : {{$value->users !=""?$value->users->full_name:""}}
                                    </p>

                                    <?php 
                                    $rolesData = explode(',', $value->inform_to);
                                    if (!empty($rolesData)) {
                                        ?>
                                        <h4>@lang('lang.message') @lang('lang.to')</h4>
                                        <?php
                                        foreach ($rolesData as $key => $value) {
                                            $RoleName = App\SmNoticeBoard::getRoleName($value);
                                            ?>
                                             
                                        <?php if (!empty($RoleName)) { ?>
                                            <p class="mb-0">
                                            <span class="ti-user mr-10"></span><?php echo $RoleName->name; ?></p>
                                           <?php 
                                        } ?>

                                            <?php

                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
</section>
@endsection
