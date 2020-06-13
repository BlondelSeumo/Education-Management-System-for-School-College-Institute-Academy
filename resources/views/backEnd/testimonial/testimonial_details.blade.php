<script type="text/javascript" src="{{asset('public/backEnd/js/main.js')}}"></script>
<div class="container-fluid">
    <div class="row">

        <div class="col-md-9">
            <h3>{{$testimonial->name}}</h3>
            <h6 >{{$testimonial->designation}}, {{$testimonial->institution_name}}</h6>
            <p class="mt-3">{{$testimonial->designation}}</p>
        </div>
        <div class="col-md-3">
            <img src="{{asset($testimonial->image)}}" width="100px" height="100px">
        </div>
    </div>
