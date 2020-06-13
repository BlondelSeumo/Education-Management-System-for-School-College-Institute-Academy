@extends('backEnd.master')
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.issued_Book_List')</h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.library')</a>
                    <a href="#">@lang('lang.issued_Book_List')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.select_criteria')</h3>
                    </div>
                </div>
                <div class="col-lg-4 text-md-right text-left col-md-6 mb-30-lg">
                    <a href="{{route('addStaff')}}" class="primary-btn small fix-gr-bg">
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'search-issued-book', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        <div class="row">
                            <div class="col-lg-4">
                                <select class="niceSelect w-100 bb form-control" name="book_id" id="book_id">
                                    <option data-display="@lang('lang.select_Book_Name')"
                                            value="">@lang('lang.select') </option>
                                    @foreach($books as $key=>$value)
                                        <option
                                            value="{{$value->id}}" {{isset($book_id)? ($book_id == $value->id? 'selected':''):''}}>{{$value->book_title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-4 mt-30-md">
                                <div class="col-lg-12">
                                    <div class="input-effect">
                                        <input class="primary-input" type="text" name="book_number"
                                               value="{{isset($book_number)? $book_number:''}}">
                                        <label>@lang('lang.search_By_Book_ID')</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-30-md">
                                <select class="niceSelect w-100 bb form-control" name="subject_id" id="subject_id">
                                    <option data-display="@lang('lang.select_subjects')"
                                            value="">@lang('lang.select') </option>
                                    @foreach($subjects as $key=>$value)
                                        <option
                                            value="{{$value->id}}" {{isset($subject_id)? ($subject_id == $value->id? 'selected':''):''}}>{{$value->subject_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12 mt-20 text-right">
                                <button type="submit" class="primary-btn small fix-gr-bg">
                                    <span class="ti-search pr-2"></span>
                                    @lang('lang.search')
                                </button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">@lang('lang.all_issued_book')</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>@lang('lang.book') @lang('lang.title')</th>
                                    <th>@lang('lang.book') @lang('lang.no')</th>
                                    <th>@lang('lang.isbn') @lang('lang.no')</th>
                                    <th>@lang('lang.member') @lang('lang.name')</th>
                                    <th>@lang('lang.author')</th>
                                    <th>@lang('lang.subject')</th>
                                    <th>@lang('lang.issue_date')</th>
                                    <th>@lang('lang.return_date')</th>
                                    <th>@lang('lang.Status')</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($issueBooks as $value)
                                    <tr>
                                        <td>{{$value->book_title}}</td>
                                        <td>{{$value->book_number}}</td>
                                        <td>{{$value->isbn_no}}</td>
                                        @if($value->member_type == 2)
                                            @php
                                                $getMemberDetail =
                                                App\SmBook::getMemberDetails($value->student_staff_id);
                                            @endphp
                                        @else

                                            @php
                                                $getMemberDetail =
                                                App\SmBook::getMemberStaffsDetails($value->student_staff_id);
                                            @endphp
                                        @endif

                                        <td>@if(!empty($getMemberDetail))
                                                {{$getMemberDetail->full_name}}
                                            @endif</td>

                                        <td>{{$value->author_name}}</td>
                                        <td>{{$value->subject_name}}</td>
                                       
                                        <td  data-sort="{{strtotime($value->given_date)}}" >{{ $value->given_date != ""? App\SmGeneralSettings::DateConvater($value->given_date):''}} </td>                                        
                                        <td  data-sort="{{strtotime($value->due_date)}}" >{{$value->due_date != ""? App\SmGeneralSettings::DateConvater($value->due_date):''}}</td>
                                        <td>
                                            @if($value->issue_status == 'I')

                                                <button class="primary-btn small bg-success text-white border-0">
                                                    Issued
                                                </button>
                                            @endif
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
@endsection
