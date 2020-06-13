<script type="text/javascript" src="{{asset('public/backEnd/js/main.js')}}"></script>
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <h1>{{$course->title}}</h1>
            <img src="{{asset($course->image)}}" class="mt-3 mr-3" style="float: left">
            <h3 class="mt-3">Overview: </h3>
            <p>{{$course->overview}}</p>
            <h3 class="mt-3">Outline: </h3>
            <p>{{$course->outline}}</p>
            <h3 class="mt-3">Prerequisites: </h3>
            <p>{{$course->prerequisites}}</p>
            <h3 class="mt-3">Resources: </h3>
            <p>{{$course->resources}}</p>
            <h3 class="mt-3">Stats: </h3>
            <p>{{$course->stats}}</p>
        </div>
    </div>

