@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Notice Board</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">Dashboard</a>
                <a href="#">Communicate</a>
                <a href="#">Notice Board</a>
            </div>
        </div>
    </div>
</section>

<section class="mb-40 sms-accordion">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">All Notices</h3>
                </div>
            </div>
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
                        </div>
                    </a>
                    @php $i++; @endphp
                    <div id="notice{{$value->id}}" class="collapse {{$i ==  1 ? 'show' : ''}}" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    {{$value->notice_message}}
                                </div>
                                <div class="col-lg-4">
                                    <p class="mb-0">
                                        <span class="ti-calendar mr-10"></span>
                                        Publish Date : {{$value->publish_on != ""? App\SmGeneralSettings::DateConvater($value->publish_on):''}}




                                    </p>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach


                @endif

                @if($allNotices->count()<1)

                   <div class="card"> 
                        <div class="card-header d-flex justify-content-between">
                          Sorry ! There is no notice for you !
                        </div> 
                  </div>

                @endif
            </div>
        </div>
    </div>
</div>
</section>
@endsection
