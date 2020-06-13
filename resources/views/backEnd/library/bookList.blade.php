@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-50 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.book_list')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.library')</a>
                <a href="#">@lang('lang.book_list')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
    <div class="row mt-50">
        <div class="col-lg-12">
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
                                          {{ session()->get('message-success') }}
                                      </div>
                                    @elseif(session()->has('message-danger'))
                                      <div class="alert alert-danger">
                                          {{ session()->get('message-danger') }}
                                      </div>
                                    @endif
                                </td>
                            </tr> 
                            @endif
                            <tr>
                                <th>@lang('lang.book_title')</th>
                                <th>@lang('lang.book') @lang('lang.no')</th>
                                <th>@lang('lang.isbn') @lang('lang.no')</th>
                                <th>@lang('lang.category')</th>
                                <th>@lang('lang.subject')</th>
                                <th>@lang('lang.publisher') @lang('lang.name')</th>
                                <th>@lang('lang.author_name')</th>
                                <th>@lang('lang.quantity')</th>
                                <th>@lang('lang.price')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                        </thead>

                        <tbody>
                        
                            @foreach($books as $value)
                            <tr>
                                <td>{{$value->book_title}}</td>
                                <td>{{$value->book_number}}</td>
                                <td>{{$value->isbn_no}}</td>
                                <td>
                                @if(!empty($value->book_category_id))
                                    {{(@$value->book_category_id != "")? $value->category_name:'' }}
                                @endif
                                </td>
                                <td>
                                @if(!empty($value->subject_id))
                                    {{(@$value->subject_id != "")? $value->subject_name:'' }} 
                                @endif
                                </td>
                                <td>{{$value->publisher_name}}</td>
                                <td>{{$value->author_name}}</td>
                                <td>{{$value->quantity}}</td>
                               <td>{{$value->book_price}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            @lang('lang.select')
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                           @if(in_array(302, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                                            <a class="dropdown-item" href="{{url('edit-book/'.$value->id)}}">@lang('lang.edit')</a>
@endif
 @if(in_array(303, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                                        <a class="deleteUrl dropdown-item" data-modal-size="modal-md" title="Delete Book" href="{{url('delete-book-view/'.$value->id)}}">@lang('lang.delete')</a>
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
@endsection
