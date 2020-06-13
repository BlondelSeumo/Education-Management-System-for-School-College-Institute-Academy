@extends('backEnd.master')
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.add_book')</h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.library')</a>
                    @if(isset($editData))
                        <a href="#">@lang('lang.edit_book')</a>
                    @else
                        <a href="#">@lang('lang.add_book')</a>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
          <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-6">
                    <div class="main-title">
                        <h3 class="mb-30">
                            @if(isset($editData))
                                @lang('lang.edit')
                            @else
                                @lang('lang.add')
                            @endif
                            @lang('lang.book')</h3>
                    </div>
                </div>
            </div>
            @if(isset($editData))
                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'update-book-data/'.$editData->id, 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
            @else
            @if(in_array(300, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
       
                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'save-book-data',
                'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
            @endif
            @endif

            <div class="row">
                <div class="col-lg-12">
                    @include('backEnd.partials.alertMessage')
                    <div class="white-box">
                        <div class="">
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                            <div class="row mb-30">
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <input
                                            class="primary-input form-control{{ $errors->has('book_title') ? ' is-invalid' : '' }}"
                                            type="text" name="book_title" autocomplete="off"
                                            value="{{isset($editData)? $editData->book_title :(old('book_title')!=''? old('book_title'):'')}}">
                                        <label>@lang('lang.book_title') <span>*</span> </label>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('book_title'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('book_title') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <select
                                            class="niceSelect w-100 bb form-control{{ $errors->has('book_category_id') ? ' is-invalid' : '' }}"
                                            name="book_category_id" id="book_category_id">
                                            <option data-display="@lang('lang.select_book_category') *"
                                                    value="">@lang('lang.select')</option>
                                            @foreach($categories as $key=>$value)
                                                @if(isset($editData))
                                                    <option
                                                        value="{{$value->id}}" {{$value->id == $editData->book_category_id? 'selected':''}}>{{$value->category_name}}</option>
                                                @else
                                                    <option
                                                        value="{{$value->id}}" {{old('book_category_id')!=''? (old('book_category_id') == $value->id? 'selected':''):''}} >{{$value->category_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('book_category_id'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('book_category_id') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <select
                                            class="niceSelect w-100 bb form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}"
                                            name="subject" id="subject">
                                            <option data-display="@lang('lang.select_subjects')*"
                                                    value="">@lang('lang.select')</option>
                                            @foreach($subjects as $key=>$value)
                                                @if(isset($editData))
                                                    <option value="{{$value->id}}" {{$value->id == $editData->subject? 'selected':''}}>{{$value->subject_name}}</option>
                                                    @else
                                                    <option value="{{$value->id}}" {{old('subject')!=''? (old('subject') == $value->id? 'selected':''):''}} >{{$value->subject_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('subject'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <input
                                            class="primary-input form-control{{ $errors->has('type') ? ' is-invalid' : '' }}"
                                            type="text" name="book_number" autocomplete="off"
                                            value="{{isset($editData)? $editData->book_number: old('book_number')}}">
                                        <label>@lang('lang.book') @lang('lang.no')</label>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('book_number'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('book_number') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>


                            </div>

                            <div class="row mb-30">
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <input
                                            class="primary-input form-control{{ $errors->has('isbn_no') ? ' is-invalid' : '' }}"
                                            type="number" name="isbn_no" autocomplete="off"
                                            value="{{isset($editData)? $editData->isbn_no: old('isbn_no')}}">
                                        <label>@lang('lang.isbn') @lang('lang.no')</label>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('isbn_no'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('isbn_no') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <input
                                            class="primary-input form-control{{ $errors->has('publisher_name') ? ' is-invalid' : '' }}"
                                            type="text" name="publisher_name" autocomplete="off"
                                            value="{{isset($editData)? $editData->publisher_name: old('publisher_name')}}">
                                        <label>@lang('lang.publisher') @lang('lang.name')</label>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('publisher_name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('publisher_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <input
                                            class="primary-input form-control{{ $errors->has('author_name') ? ' is-invalid' : '' }}"
                                            type="text" name="author_name" autocomplete="off"
                                            value="{{isset($editData)? $editData->author_name: old('author_name')}}">
                                        <label>@lang('lang.author_name')</label>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('author_name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('author_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <input
                                            class="primary-input form-control{{ $errors->has('rack_number') ? ' is-invalid' : '' }}"
                                            type="text" name="rack_number" autocomplete="off"
                                            value="{{isset($editData)? $editData->rack_number: old('rack_number')}}">
                                        <label>@lang('lang.rack') @lang('lang.number')</label>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('rack_number'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rack_number') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-30">

                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <input
                                            class="primary-input form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}"
                                            type="number" name="quantity" autocomplete="off"
                                            value="{{isset($editData)? $editData->quantity : old('quantity')}}">
                                        <label>@lang('lang.quantity')</label>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('quantity'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-effect">
                                        <input
                                            class="primary-input form-control{{ $errors->has('book_price') ? ' is-invalid' : '' }}"
                                            type="number" name="book_price" autocomplete="off"
                                            value="{{isset($editData)? $editData->book_price : old('book_price')}}">
                                        <label>@lang('lang.book_price')</label>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('book_price'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('book_price') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="row md-20">
                                <div class="col-lg-12">
                                    <div class="input-effect">
                                        <textarea class="primary-input form-control" cols="0" rows="4" name="details"
                                                  id="details">{{isset($editData) ? $editData->details : old('details')}}</textarea>
                                        <label>@lang('lang.description') <span></span> </label>
                                        <span class="focus-border textarea"></span>

                                    </div>
                                </div>
                            </div>
                        </div>
                          @php 
                                  $tooltip = "";
                                  if(in_array(300, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ){
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

                                    @lang('lang.book')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
        </div>
      
    </section>
@endsection
