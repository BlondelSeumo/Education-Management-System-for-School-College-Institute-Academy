<script src="{{asset('public/backEnd/')}}/js/main.js"></script>

{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'admission_query_update', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'admission-query-update']) }}
<input type="hidden" name="id" value="{{$admission_query->id}}">
<div class="modal-body">
    <div class="container-fluid">
        <form action="">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="input-effect">
                                <input class="primary-input read-only-input form-control" type="text" name="name" id="name" value="{{$admission_query->name}}">
                                <label>@lang('lang.name') <span>*</span></label>
                                <span class="text-danger" role="alert" id="nameError">
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-effect">
                                <input class="primary-input read-only-input form-control" type="text" name="phone" id="phone" value="{{$admission_query->phone}}">
                                <label>@lang('lang.phone') <span>*</span></label>
                                <span class="text-danger" role="alert" id="phoneError">
                                   
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-effect">
                                <input class="primary-input read-only-input form-control" type="text" name="email" value="{{$admission_query->email}}">
                                <label>@lang('lang.email') <span></span></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-25">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-effect">
                                <textarea class="primary-input form-control" cols="0" rows="3" name="address" id="address">{{$admission_query->address}}</textarea>
                                <label>@lang('lang.address') <span></span> </label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-effect">
                                <textarea class="primary-input form-control" cols="0" rows="3" name="description" id="description">{{$admission_query->description}}</textarea>
                                <label>@lang('lang.description') <span></span> </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-25">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="no-gutters input-right-icon">
                                <div class="col">
                                    <div class="input-effect">
                                        <input class="primary-input date form-control" id="startDate" type="text"
                                             name="date" readonly="true" value="{{$admission_query->date != ""? date('m/d/Y', strtotime($admission_query->date)) : date('m/d/Y')}}">
                                        <label>@lang('lang.date')</label>
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
                                        <input class="primary-input date form-control" id="endDate" type="text"
                                             name="next_follow_up_date" autocomplete="off" readonly="true"  value="{{$admission_query->next_follow_up_date != ""? date('m/d/Y', strtotime($admission_query->next_follow_up_date)) : date('m/d/Y')}}">
                                        <label>@lang('lang.next_follow_up_date')</label>
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
                            <div class="input-effect">
                                <input class="primary-input read-only-input form-control" type="text" name="assigned" value="{{$admission_query->assigned}}">
                                <label>@lang('lang.assigned') <span></span></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-25">
                    <div class="row">
                        <div class="col-lg-3">
                            <select class="niceSelect w-100 bb" name="reference">
                                <option data-display="@lang('lang.reference')" value="">@lang('lang.reference')</option>
                                @foreach($references as $reference)
                                    <option value="{{$reference->id}}" {{$reference->id == $admission_query->reference? 'selected':''}}>{{$reference->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-lg-3">
                            <select class="niceSelect w-100 bb" name="source" id="source">
                                <option data-display="@lang('lang.source') *" value="">@lang('lang.source') *</option>
                                @foreach($sources as $source)
                                    <option value="{{$source->id}}" {{$source->id == $admission_query->source? 'selected':''}}>{{$source->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" role="alert" id="sourceError">
                                
                            </span>
                        </div>
                        <div class="col-lg-3">
                            <select class="niceSelect w-100 bb" name="class" id="class">
                                <option data-display="@lang('lang.class')" value="">@lang('lang.class')</option>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}" {{$class->id == $admission_query->class? 'selected':''}}>{{$class->class_name}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-lg-3">
                            <div class="input-effect">
                                <input class="primary-input form-control" type="text" name="no_of_child" value="{{$admission_query->no_of_child}}">
                                <label>@lang('lang.number_of_child') <span></span></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 text-center mt-40">
                    <div class="mt-40 d-flex justify-content-between">
                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>

                        <button class="primary-btn fix-gr-bg" id="save_button_query" type="submit">@lang('lang.update')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
{{ Form::close() }}

   
<!-- End Sibling Add Modal -->
