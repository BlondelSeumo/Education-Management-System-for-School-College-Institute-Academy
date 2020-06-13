@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.library_book_issue')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.library')</a>
                <a href="{{url('member-list')}}">@lang('lang.member') @lang('lang.list')</a>
                <a href="#">@lang('lang.issue_books')</a>
            </div>
        </div>
    </div>
</section>
<section class="mb-40 student-details">
  <div class="container-fluid p-0">
     
  <div class="row">
    <div class="col-lg-3">
      <!-- Start Student Meta Information -->
      <div class="main-title">
        <h3 class="mb-20">@lang('lang.issue_books')</h3>
      </div>
      <div class="student-meta-box mt-30">
        <div class="student-meta-top"></div>
        @if(@$memberDetails->member_type == 2)
          <img class="student-meta-img img-100" src="{{asset(@$getMemberDetails->student_photo)}}" alt="">
        @else
          <img class="student-meta-img img-100" src="{{asset(@$getMemberDetails->staff_photo)}}" alt="">
        @endif
        <div class="white-box">
          <div class="single-meta mt-10">
            <div class="d-flex justify-content-between">
              <div class="name">
                  @lang('lang.staff_name')
              </div>
              <div class="value">
                @if(isset($getMemberDetails))
                {{$getMemberDetails->full_name}}
                @endif
              </div>
            </div>
          </div>
          <div class="single-meta">
            <div class="d-flex justify-content-between">
              <div class="name">
                  @lang('lang.member') @lang('lang.id')
              </div>
              <div class="value">
               @if(isset($memberDetails))
               {{$memberDetails->member_ud_id}}
               @endif
             </div>
           </div>
         </div>
         <div class="single-meta">
          <div class="d-flex justify-content-between">
            <div class="name">
                @lang('lang.member_type')
            </div>
            <div class="value">
             @if(isset($memberDetails))
             {{$memberDetails->memberTypes->name}}
             @endif
           </div>
         </div>
       </div>
       <div class="single-meta">
        <div class="d-flex justify-content-between">
          <div class="name">
              @lang('lang.mobile')
          </div>
          <div class="value">
           @if(isset($getMemberDetails))
           {{$getMemberDetails->mobile}}
           @endif

         </div>
       </div>
     </div>
   </div>
 </div>
 <!-- End Student Meta Information -->
 @if(in_array(312, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
 <div class="row mt-30">
  <div class="col-lg-12">
    <div class="main-title">
      <h3 class="mb-30">
          @lang('lang.issue_book')
      </h3>
    </div>
    @if(isset($editData))
    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'book-category-list/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
    @else
    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'save-issue-book-data',
    'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
    @endif
    <div class="white-box">
      <div class="add-visitor">
        <div class="row">
         <div class="col-lg-12 mb-20">
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
            <select class="niceSelect w-100 bb form-control{{ $errors->has('book_id') ? ' is-invalid' : '' }}" name="book_id" id="classSelectStudent">
              <option data-display="Select Book *" value="">@lang('lang.select_book')</option>
              @foreach($books as $key=>$value)
              <option value="{{$value->id}}">{{$value->book_title}}</option>
              @endforeach
            </select>
            <span class="focus-border"></span>
            @if ($errors->has('book_id'))
            <span class="invalid-feedback invalid-select" role="alert">
              <strong>{{ $errors->first('book_id') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="col-lg-12 mb-20">
          <div class="no-gutters input-right-icon">
            <div class="col">
              <div class="input-effect">
                <input class="primary-input date form-control{{ $errors->has('due_date') ? ' is-invalid' : '' }}" id="due_date" type="text"
                placeholder="@lang('lang.return_date')" name="due_date" autocomplete="off" value="{{date('m/d/Y')}}">
                <span class="focus-border"></span>
                @if ($errors->has('due_date'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('due_date') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="col-auto">
              <button class="" type="button">
                <i class="ti-calendar" id="book_return_date_icon"></i>
              </button>
            </div>
          </div>
        </div>
        <input type="hidden" name="member_id" value="{{@$memberDetails->student_staff_id}}">
        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
      </div>
      <div class="row mt-40">
        <div class="col-lg-12 text-center">
          <button class="primary-btn fix-gr-bg">
            <span class="ti-check"></span>
              @lang('lang.issue_book')
          </button>
        </div>
      </div>
    </div>
  </div>
  {{ Form::close() }}
</div>
</div>
@endif
</div>

<div class="col-lg-9">
 <div class="row">
  <div class="col-lg-4 no-gutters">
    <div class="main-title">
      <h3 class="mb-0"> @lang('lang.issued_book')</h3>
    </div>
  </div>
</div>

<div class="row">
 <div class="col-lg-12">
  <table id="table_id" class="display school-table" cellspacing="0" width="100%">
    <thead>
      @if(session()->has('message-success-return') != "" ||
        session()->get('message-danger-return') != "")
        <tr>
            <td colspan="6">
                 @if(session()->has('message-success-return'))
                  <div class="alert alert-success">
                      {{ session()->get('message-success-return') }}
                  </div>
                @elseif(session()->has('message-danger-return'))
                  <div class="alert alert-danger">
                      {{ session()->get('message-danger-return') }}
                  </div>
                @endif
            </td>
        </tr>
         @endif
      <tr>
        <th width="15%">@lang('lang.book_title')</th>
        <th width="15%">@lang('lang.book_number')</th>
        <th width="15%">@lang('lang.issue_date')</th>
        <th width="15%">@lang('lang.return_date')</th>
        <th width="15%">@lang('lang.status')</th>
        <th width="15%">@lang('lang.action')</th>
      </tr>
    </thead>

    <tbody>
      @if(isset($totalIssuedBooks))
      @foreach($totalIssuedBooks as $value)
      <tr>
        <td>{{$value->books->book_title}}</td>
        <td>{{$value->books->book_number}}</td>
        <td  data-sort="{{strtotime($value->given_date)}}" >
          {{$value->given_date != ""? App\SmGeneralSettings::DateConvater($value->given_date):''}}

        </td>
        <td  data-sort="{{strtotime($value->due_date)}}" >
         {{$value->due_date != ""? App\SmGeneralSettings::DateConvater($value->due_date):''}}

        </td>
        <td>
          @if($value->issue_status == 'I')
          <button class="primary-btn small bg-warning text-white border-0">@lang('lang.issued')</button>
          @else
         <button class="primary-btn small bg-success text-white border-0">@lang('lang.returned')</button>
          @endif
        </td>
        <td>
          <div class="dropdown">
            @if($value->issue_status == 'I')

             @if(in_array(313, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )

            <a title="Return Book" data-modal-size="modal-md" href="{{url('return-book-view/'.$value->id)}}" class="modalLink primary-btn fix-gr-bg">@lang('lang.return')</a>
            
            @endif
            @endif
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
