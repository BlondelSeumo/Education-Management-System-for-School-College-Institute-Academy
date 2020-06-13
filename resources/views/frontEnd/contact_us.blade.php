@extends('backEnd.master')
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>Contact Page</h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">Front Settings</a>
                    <a href="#">Contact Page</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            @if(isset($update))
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">
                                    @if(isset($update))
                                        @lang('lang.edit')
                                    @else
                                        @lang('lang.add')
                                    @endif New
                                </h3>
                            </div>
                            @if(isset($update))
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'contact-page/update',
                                'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            @else
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'visitor_store',
                                'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            @endif
                            <div class="white-box">
                                @if(session()->has('message-success'))
                                    <div class="alert alert-success">
                                        {{session()->get('message-success')}}
                                    </div>
                                @elseif(session()->has('message-danger'))
                                    <div class="alert alert-danger">
                                        {{session()->get('message-danger')}}
                                    </div>
                                @endif
                                <div class="add-visitor {{isset($update)? '':'isDisabled'}}">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="input-effect">
                                                        <input
                                                            class="primary-input form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                            type="text" name="title" autocomplete="off"
                                                            value="{{isset($update)? ($contact_us != ''? $contact_us->title:''):''}}">
                                                        <label>Title<span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('title'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                
                                                <div class="col-lg-4">
                                                    <div class="input-effect">
                                                        <input
                                                            class="primary-input form-control{{ $errors->has('button_text') ? ' is-invalid' : '' }}"
                                                            type="text" name="button_text" autocomplete="off"
                                                            value="{{isset($update)? ($contact_us != ''? $contact_us->button_text:''):'' }}">
                                                        <label>Button Text<span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('button_text'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('button_text') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="input-effect">
                                                        <input
                                                            class="primary-input form-control{{ $errors->has('button_text') ? ' is-invalid' : '' }}"
                                                            type="text" name="button_url" autocomplete="off"
                                                            value="{{isset($update)? ($contact_us != ''? $contact_us->button_url:''):'' }}">
                                                        <label>Button Url<span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('button_url'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('button_url') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                
                                                
                                                <div class="col-lg-4">
                                                    <div class="input-effect mt-25">
                                                        <input
                                                            class="primary-input form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                                            type="text" name="address" autocomplete="off"
                                                            value="{{isset($update)? ($contact_us != ''? $contact_us->address:''):'' }}">
                                                        <label>Address<span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('address'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('address') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="input-effect mt-25">
                                                        <input
                                                            class="primary-input form-control{{ $errors->has('address_text') ? ' is-invalid' : '' }}"
                                                            type="text" name="address_text" autocomplete="off"
                                                            value="{{isset($update)? ($contact_us != ''? $contact_us->address_text:''):'' }}">
                                                        <label>Address text<span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('address_text'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('address_text') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="input-effect mt-25">
                                                        <input
                                                            class="primary-input form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                            type="text" name="phone" autocomplete="off"
                                                            value="{{isset($update)? ($contact_us != ''? $contact_us->phone:''):'' }}">
                                                        <label>phone<span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('phone'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>


                                            </div>
                                        </div>

                                        
                                        <div class="col-lg-12">
                                            <div class="row">
                                                
                                                
                                                <div class="col-lg-4">
                                                    <div class="input-effect mt-25">
                                                        <input
                                                            class="primary-input form-control{{ $errors->has('phone_text') ? ' is-invalid' : '' }}"
                                                            type="text" name="phone_text" autocomplete="off"
                                                            value="{{isset($update)? ($contact_us != ''? $contact_us->phone_text:''):'' }}">
                                                        <label>phone text<span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('phone_text'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('phone_text') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="input-effect mt-25">
                                                        <input
                                                            class="primary-input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                            type="text" name="email" autocomplete="off"
                                                            value="{{isset($update)? ($contact_us != ''? $contact_us->email:''):'' }}">
                                                        <label>email<span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="input-effect mt-25">
                                                        <input
                                                            class="primary-input form-control{{ $errors->has('email_text') ? ' is-invalid' : '' }}"
                                                            type="text" name="email_text" autocomplete="off"
                                                            value="{{isset($update)? ($contact_us != ''? $contact_us->email_text:''):'' }}">
                                                        <label>email text<span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('email_text'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email_text') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                        </div>  
                                        <div class="col-lg-12">
                                            <div class="row">
                                                
                                                
                                                <div class="col-lg-4">
                                                    <div class="input-effect mt-25">
                                                        <input
                                                            class="primary-input form-control{{ $errors->has('latitude') ? ' is-invalid' : '' }}"
                                                            type="text" name="latitude" autocomplete="off"
                                                            value="{{isset($update)? ($contact_us != ''? $contact_us->latitude:''):'' }}">
                                                        <label>Latitude<span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('latitude'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('latitude') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="input-effect mt-25">
                                                        <input
                                                            class="primary-input form-control{{ $errors->has('longitude') ? ' is-invalid' : '' }}"
                                                            type="text" name="longitude" autocomplete="off"
                                                            value="{{isset($update)? ($contact_us != ''? $contact_us->longitude:''):'' }}">
                                                        <label>Longitude<span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('longitude'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('longitude') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="input-effect mt-25">
                                                        <input
                                                            class="primary-input form-control{{ $errors->has('google_map_address') ? ' is-invalid' : '' }}"
                                                            type="text" name="google_map_address" autocomplete="off"
                                                            value="{{isset($update)? ($contact_us != ''? $contact_us->google_map_address:''):'' }}">
                                                        <label>Google Map Address<span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('google_map_address'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('google_map_address') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>


                                            </div>
                                        </div>      
                                    </div>
                                
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="input-effect mt-25">
                                                <div class="input-effect">
                                                    <textarea class="primary-input form-control" cols="0" rows="5" name="description" id="description">{{isset($update)? ($contact_us != ''? $contact_us->description:''):'' }}</textarea>
                                                    <label>Description <span>*</span> </label>
                                                    @if($errors->has('description'))
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $errors->first('description') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row no-gutters input-right-icon mt-35">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" id="placeholderInput" type="text"
                                                           placeholder="Image"
                                                           readonly>
                                                    <span class="focus-border"></span>
                                                    @if($errors->has('image'))
                                                        <span class="invalid-feedback mb-10" role="alert">
                                                            <strong>{{ $errors->first('image') }}</strong>
                                                        </span>
                                                        @endif
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                           for="browseFile">@lang('lang.browse')</label>
                                                    <input type="file" class="d-none" id="browseFile" name="image">
                                                </button>

                                            </div>
                                            

                                        </div>
                                    <span class="mt-10">Image(1420px*450px)</span>



                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg">
                                                <span class="ti-check"></span>
                                                @if(isset($update))
                                                    @lang('lang.update')
                                                @else
                                                    @lang('lang.save')
                                                @endif
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
            </div>
            @endif

            <div class="row">

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mt-30 mb-30">info</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">

                            <table class="display school-table school-table-style" cellspacing="0" width="100%">

                                <thead>
                                <tr>
                                    <th width="10%">Title</th>
                                    <th width="20%">Description</th>
                                    <th width="10%">Button Text</th>
                                    <th width="10%">Button url</th>
                                    <th width="10%">Image</th>
                                    <th width="10%">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                
                                    <tr>
                                        <td width="10%">{{$contact_us != ""? $contact_us->title:""}}</td>
                                        <td width="20%">{{$contact_us != ""? $contact_us->description:""}}</td>
                                        <td width="10%">{{$contact_us != ""? $contact_us->button_text:""}}</td>
                                        <td width="10%">{{$contact_us != ""? $contact_us->button_url:""}}</td>
                                        
                                        <td width="10%">
                                            @if($contact_us != "")
                                                <a class="primary-btn small fix-gr-bg" data-toggle="modal" data-target="#showimageModal"  href="#">view</a>
                                            @endif
                                        </td>
                                        <td width="10%"><a href="{{url('contact-page/edit')}}" class="primary-btn small fix-gr-bg">edit</a></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>


    <div class="modal fade admin-query" id="showimageModal">
    <div class="modal-dialog modal-dialog-centered large-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View Image</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body p-0">
                <div class="container student-certificate">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 text-center">
                            <div class="mb-5">
                                <img class="img-fluid" src="{{asset($contact_us != ''? $contact_us->image:'')}}">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
