<script type="text/javascript" src="{{asset('public/backEnd/js/main.js')}}"></script>
<div class="container-fluid">
   {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'saveToDoData',
   'method' => 'POST', 'enctype' => 'multipart/form-data', 'onsubmit' => 'return validateToDoForm()']) }}

   <div class="row">
    <div class="col-lg-12">
        <div class="row mt-25">
            <div class="col-lg-12" id="sibling_class_div">
                <div class="input-effect">
                    <input  class="primary-input form-control" type="text" name="todo_title" id="todo_title">
                    <label>To Do Title <span></span> </label>
                    <span class="focus-border"></span>
                   <span class="modal_input_validation red_alert"></span>
                </div>
            </div>
        </div>

        <div class="row mt-30">
            <div class="col-lg-12" id="">
                <div class="no-gutters input-right-icon">
                    <div class="col">
                        <div class="input-effect">
                            <input class="read-only-input primary-input date form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" id="startDate" type="text" autocomplete="off" readonly="true" name="date" value="{{date('m/d/Y')}}">
                            <label>Date <span></span> </label>
                            @if ($errors->has('date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-auto">
                        <button class="" type="button">
                            <i class="ti-calendar" id="start-date-icon"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    <div class="col-lg-12 text-center">
        <div class="mt-40 d-flex justify-content-between">
            <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancel</button>
            <input class="primary-btn fix-gr-bg" type="submit" value="save">
        </div>
    </div>
</div>
{{ Form::close() }}
</div>