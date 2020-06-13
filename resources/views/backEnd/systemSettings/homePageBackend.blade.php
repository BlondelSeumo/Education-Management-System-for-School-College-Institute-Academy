@extends('backEnd.master')
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>Home Page</h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">Front Settings</a>
                    <a href="#">Home Page</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">  Home Page Update </h3>
                            </div> 
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'admin-home-page-update', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }} 
                            <div class="white-box">

                                <div class="row">
                                    <div class="col-lg-12">
                                        @if(session()->has('message-success'))
                                            <div class="alert alert-success">
                                                @lang('lang.operation_success_message')
                                            </div> 
                                        @endif


                                    </div>
                                </div>



                                            <div class="row mt-20">  
                                                <div class="col-lg-6 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="title" autocomplete="off" value="{{isset($links)?$links->title:''}}">
                                                        <label>Title</label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div> 
                                                <div class="col-lg-6 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="long_title" autocomplete="off"  value="{{isset($links)?$links->long_title:''}}" >
                                                        <label>Heading </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>
                                            </div>   
                                            <div class="row mt-20">  
                                                <div class="col-lg-12 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="short_description" autocomplete="off" value="{{isset($links)?$links->short_description:''}}">
                                                        <label>Short Description </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                            </div>   

 
                                            <div class="row mt-20">  
                                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                                <div class="col-lg-4 mt-40"> 
                                                    <img src="{{isset($links)?$links->image:''}}" style="width: 100%; height: auto;" alt="{{isset($links)?$links->title:''}}" id="blah">
                                              
                                                    
                                                    <div class="row no-gutters input-right-icon mt-20">
                                                        <div class="col">
                                                            <div class="input-effect">
                                                                <input class="primary-input" type="text" id="placeholderFileFourName" placeholder="Upload Background Image (1420x670)"
                                                                    readonly="">
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button class="primary-btn-small-input" type="button">
                                                                <label class="primary-btn small fix-gr-bg" for="imgInp">@lang('lang.browse')</label>
                                                                <input type="file" class="d-none" name="image" id="imgInp">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div> 

                                                <div class="col-lg-4 mt-40"> </div>
                                                <div class="col-lg-4 mt-40"> 
                                                    <p>Set permission in <b>HOME</b></p>

                                        @if (count($errors) > 0)
                                                <div class="alert alert-danger">
                                                 
                                                        @foreach ($errors->all() as $error)
                                                            <p>{{ $error }}</p>
                                                        @endforeach
                                                  
                                                </div>
                                        @endif
                                        
                                                    <hr>
                                                    @foreach($permisions as $row)
                                                    <input type="checkbox" id="P{{$row->id}}" class="common-checkbox form-control{{ $errors->has('permisions') ? ' is-invalid' : '' }}"  name="permisions[]" value="{{$row->id}}" {{($row->is_published==1)? 'checked': ''}}>
                                                    <label for="P{{$row->id}}"> {{$row->name}} </label> 
                                                    @endforeach
                                                    <span></span>

                                                </div>

                                            </div>    
                                            <div class="row mt-40">
                                                <div class="col-lg-12 text-center">
                                                    <button class="primary-btn fix-gr-bg">
                                                        <span class="ti-check"></span> 
                                                            @lang('lang.update') 
                                                    </button>
                                                </div>
                                            </div>


                            </div>
                            {{ Form::close() }}
                        </div> 
                </div>
 
            </div>
        </div>
    </section>

 
@endsection

