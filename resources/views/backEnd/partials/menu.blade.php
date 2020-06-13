<style>
    #livesearch a{  text-align: left; display: block; }
    .languageChange .list{    padding-top: 40px !important;}
    .infix_theme_rtl .list{    padding-top: 40px !important;}
    .infix_theme_style .list{    padding-top: 40px !important;}
</style>
<nav class="navbar navbar-expand-lg up_navbar">
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class='up_dash_menu'>
                <button type="button" id="sidebarCollapse" class="btn d-lg-none nav_icon">
                    <i class="ti-more"></i>
                </button>

                <ul class="nav navbar-nav mr-auto search-bar">
                    <li class="">
                        <div class="input-group" id="serching">
                        <span>
                            <i class="ti-search" aria-hidden="true" id="search-icon"></i>
                        </span>
                            <input type="text" class="form-control primary-input input-left-icon" placeholder="Search"
                                   id="search" onkeyup="showResult(this.value)"/>
                            <span class="focus-border"></span>
                        </div>
                        <div id="livesearch"></div>
                    </li>
                </ul>

                <button class="btn btn-dark d-inline-block d-lg-none ml-auto nav_icon" type="button"
                        data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                    <i class="ti-menu"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="nav navbar-nav mr-auto nav-buttons flex-sm-row">
                        <li class="nav-item">
                            <a class="primary-btn white mr-10" href="{{url('/')}}/home">@lang('lang.website')</a>
                        </li>
                        @if (Auth::user()->role_id == 1)
                        <li class="nav-item">
                            <a class="primary-btn white mr-10"
                               href="{{url('/admin-dashboard')}}">@lang('lang.dashboard')</a>
                        </li>                            
                        @endif
                        @if (Auth::user()->role_id == 3)
                        <li class="nav-item">
                            <a class="primary-btn white mr-10"
                               href="{{url('/parent-dashboard')}}">@lang('lang.dashboard')</a>
                        </li>                            
                        @endif
                        @if (Auth::user()->role_id == 2)
                        <li class="nav-item">
                            <a class="primary-btn white mr-10"
                               href="{{url('/student-dashboard')}}">@lang('lang.dashboard')</a>
                        </li>                            
                        @endif
                        @if (Auth::user()->role_id == 1)
                        <li class="nav-item">
                            <a class="primary-btn white" href="{{url('/student-report')}}">@lang('lang.reports')</a>
                        </li>
                        @endif
                        {{-- @if(Session::get('info_check') == "yes" && Request()->path() == "admin-dashboard" && Auth()->user()->id == 1)
                        @php
                            $open_notification = 'open_notification';
                        @endphp

                        @else
                            @php
                                $open_notification = '';
                            @endphp
                        @endif --}}

                        
                   {{--      @if(Session::get('info_check') == "yes" && Request()->path() == "admin-dashboard" && Auth()->user()->id == 1)
                        <li class="nav-item">
                            <div class="custom_notification open_notification ml-2">
                                <a href="#" class="notification_icon primary-btn white">info <i class="ti-info"></i></a>
                                
                                <div class="notification_iner">
                                    <div class="notification_header d-flex justify-content-between align-center">
                                        <p>notification </p>
                                        <i class="close_modal ti-close"></i>
                                    </div>
                                    <div class="notification_content">
                                        <p class="text-left">All user has default password <b>123456</b></p>

                                    </div>
                                </div>
                                

                            </div>
                        </li>
                        @endif --}}
                    </ul>





                    @if(@$styles && Auth::user()->role_id == 1)
                        <style>
                            .nice-select.open .list { min-width: 200px;  left: 0;  padding: 5px; } 
                            .nice-select .nice-select-search { min-width: 190px; }
                        </style>
                        <ul class="nav navbar-nav mr-auto nav-setting flex-sm-row d-none d-lg-block colortheme">
                            <li class="nav-item active">
                                <select class="niceSelect infix_theme_style" id="infix_theme_style">
                                    <option data-display="Select Styles" value="0">Select Styles</option>
                                    @foreach($styles as $style)

                                        <option value="{{$style->id}}" {{$style->is_active == 1?'selected':''}}>{{$style->style_name}}</option>

                                    @endforeach
                                </select>
                            </li>
                        </ul>

                   
                    
                        <ul class="nav navbar-nav mr-auto nav-setting flex-sm-row d-none d-lg-block colortheme">
                            <li class="nav-item active">
                                <select class="niceSelect infix_theme_rtl" id="infix_theme_rtl">
                                    <option data-display="Select Alignment" value="0">Select Alignment</option>
                                    @php 
                                    $config = App\SmGeneralSettings::find(1);
                                    $is_rtl = $config->ttl_rtl;

                                    @endphp 
                                        <option value="2" {{$is_rtl==2?'selected':''}}>LTL</option> 
                                        <option value="1" {{$is_rtl==1?'selected':''}}>RTL</option> 
                                </select>
                            </li>
                        </ul>

                        @endif



                <!-- Start Right Navbar -->
                    <ul class="nav navbar-nav right-navbar">
                        @if (@Auth::user()->role_id == 1)
                        <li class="nav-item"> 
                            <select class="niceSelect languageChange" name="languageChange" id="languageChange"> 
                                <option data-display="Select Language" value="0">Select Language</option>
                                @php  
                                    $languages=DB::table('sm_languages')->get(); 
                                @endphp
                                @foreach($languages as $lang)
                                    <option data-display="{{$lang->native}}" value="{{ $lang->language_universal}}" {{$lang->active_status == 1? 'selected':''}}>{{$lang->native}}</option>
                                @endforeach 
                            </select> 
                        </li>
                            
                        @endif

                        <li class="nav-item notification-area  d-none d-lg-block">
                            <div class="dropdown">
                                <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="badge">{{count($notifications) < 10? count($notifications):$notifications->count()}}</span>
                                    <span class="flaticon-notification"></span>
                                </button>
                                <div class="dropdown-menu">
                                    <div class="white-box">
                                        <div class="p-h-20">
                                            <p class="notification">@lang('lang.you_have')
                                                <span>{{count($notifications) < 10? count($notifications):count($notifications)}} @lang('lang.new')</span>
                                                @lang('lang.notification')</p>
                                        </div>
                                        @foreach($notifications as $notification)


                                            <a class="dropdown-item pos-re"
                                               href="{{url('view/single/notification/'.$notification->id)}}">
                                                <div class="single-message single-notifi">
                                                    <div class="d-flex">
                                                        <span class="ti-bell"></span>
                                                        <div class="d-flex align-items-center ml-10">
                                                            <div class="mr-60">
                                                                <p class="message">{{$notification->message}}</p>
                                                            </div>
                                                            <div class="mr-10 text-right bell_time">
                                                                <p class="time text-uppercase">{{date("h.i a", strtotime($notification->created_at))}}</p>
                                                                <p class="date">
                                                                   
{{$notification->date != ""? App\SmGeneralSettings::DateConvater($notification->date):''}}

                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach

                                        <a href="{{url('view/all/notification/'.Auth()->user()->id)}}"
                                           class="primary-btn text-center text-uppercase mark-all-as-read">
                                            @lang('lang.mark_all_as_read')
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item setting-area">
                            <div class="dropdown">
                                <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                    <img class="rounded-circle" src="{{asset($profile)}}" alt="">
                                </button>
                                <div class="dropdown-menu profile-box">
                                    <div class="white-box">
                                        <a class="dropdown-item" href="#">
                                            <div class="">
                                                <div class="d-flex">

                                                    <img class="client_img"
                                                         src="{{asset($profile)}}"
                                                         alt="">
                                                    <div class="d-flex ml-10">
                                                        <div class="">
                                                            <h5 class="name text-uppercase">{{Auth::user()->full_name}}</h5>
                                                            <p class="message">{{Auth::user()->email}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                        <ul class="list-unstyled">
                                            <li>
                                                @if(Auth::user()->role_id == "2")
                                                    <a href="{{route('student_view', Auth::user()->student->id)}}">
                                                        <span class="ti-user"></span>
                                                        @lang('lang.view_profile')
                                                    </a>
                                                @elseif(Auth::user()->role_id == "10")
                                                    <a href="#">
                                                        <span class="ti-user"></span>
                                                        @lang('lang.view_profile')
                                                    </a>

                                                @elseif(Auth::user()->role_id != "3")
                                                    <a href="{{route('viewStaff', Auth::user()->staff->id)}}">
                                                        <span class="ti-user"></span>
                                                        @lang('lang.view_profile')
                                                    </a>
                                                @endif
                                            </li>

                                            <li>
                                                <a href="{{url('change-password')}}">
                                                    <span class="ti-key"></span>
                                                    @lang('lang.password')
                                                </a>
                                            </li>
                                            <li>

                                                <a href="{{ Auth::user()->role_id == 2? route('student-logout'): route('logout')}}"
                                                   onclick="event.preventDefault();

                                                     document.getElementById('logout-form').submit();">
                                                    <span class="ti-unlock"></span>
                                                    logout
                                                </a>

                                                <form id="logout-form"
                                                      action="{{ Auth::user()->role_id == 2? route('student-logout'): route('logout') }}"
                                                      method="POST" style="display: none;">

                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!-- End Right Navbar -->
                </div>
            </div>
        </div>
    </div>
</nav>


@section('script')


@endsection
