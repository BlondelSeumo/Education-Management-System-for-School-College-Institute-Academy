<!DOCTYPE html>
<html lang="">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="icon" href="{{asset('public/backEnd/')}}/img/favicon.png" type="image/png"/>
    <title>School Management System</title>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/jquery-ui.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/jquery.data-tables.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/themify-icons.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/flaticon.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/nice-select.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/magnific-popup.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fastselect.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/software.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fullcalendar.min.css">
    <link rel="stylesheet" media="print"
          href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/js/select2/select2.css"/>
    <!-- main css -->
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/style.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/infix.css"/>
    <style type="text/css">
      p{
        padding: 0;
        padding-left: 10px;
        margin: 0;
      }
      h2{
        color: whitesmoke;
      }
      table tbody tr td{
        text-align: right;
      }
      td{
        text-align: right;
      }
      .requirements table tr td {
        text-align: right;
      padding-right: 15px;
    }


    </style>
  

</head>


<body class="admin">
<div class="container">
    <div class="col-md-6 offset-3 mb-20  mt-40">

            <ul id="progressbar">
                <li class="active">welcome</li>
                <li class="active">verification</li>
{{--                <li class="active">DB Config</li>--}}
                <li class="active">Environment</li>
                <li>System Setup</li>
            </ul>


        <div class="card">
            <div class="single-report-admit">
            <div class="card-header">
                <h2 class="text-center text-uppercase" style="color: whitesmoke">ENVIRONMENT SETUP</h2>
            </div>
            </div>
            <div class="card-body environment-setup" style="padding: 10px;"> 

                @if(Session::has('message-success'))
                    <p class="text-success text-center mt-20 mb-20">{{ Session::get('message-success') }}</p>
                @endif
                @if(Session::has('message-danger'))
                    <p class="text-danger text-center mt-20 mb-20">{{ Session::get('message-danger') }}</p>
                @endif


                <h4 style="text-align: center">Basic Requirements </h4>
                <p class="mb-20"> Please make sure your server meets the following requirements:</p>


                @foreach($folders as $f)
                <p>** {{Session::get('domain')}}{{$f}}</p>
                @endforeach
                <p class="text-danger">Please make sure above folders has permission 777.</p>


                <h4 style="text-align: center" class="mt-20">Advance Requirements </h4>
                <div class="requirements">
                   <table class="table">
                       <thead>
                       <th>Status</th>
                       <th>Current Available</th>
                       <th>Required</th>
                       </thead>
                       <tbody>
                       <tr>
                           <td> <span class=' @if(phpversion()>=7.1) text-success ti-check-box @else text-danger ti-na @endif' ></span></td>
                           <td> <p class="@if(phpversion()>=7.1) text-success @else text-danger @endif"> PHP >={{phpversion()}}</p> </td>
                           <td>PHP >= 7.1.3</td>
                       </tr>

                       <tr>
                           <td> <span class='@if( OPENSSL_VERSION_NUMBER < 0x009080bf) ti-na text-danger @else ti-check-box  text-success @endif'></span>  </td>
                           <td> <p class="@if( OPENSSL_VERSION_NUMBER < 0x009080bf)  text-danger @else  text-success @endif"> OpenSSL Version</p>  </td>
                           <td>OpenSSL PHP Extension</td>
                       </tr>

                       <tr>
                           <td> <span class='@if(PDO::getAvailableDrivers()) ti-check-box  text-success @else  ti-na text-danger  @endif'></span>  </td>
                           <td> <p class="@if(PDO::getAvailableDrivers())  text-success @else  text-danger  @endif"> PDO PHP Extension</p>  </td>
                           <td>PDO PHP Extension</td>
                       </tr>
                       <tr>
                           <td> <span class="@if(extension_loaded('mbstring')) ti-check-box  text-success @else  ti-na text-danger  @endif"></span>  </td>
                           <td> <p class="@if(extension_loaded('mbstring'))  text-success @else  text-danger  @endif"> Mbstring PHP Extension</p>  </td>
                           <td>Mbstring PHP Extension</td>
                       </tr>
                       <tr>
                           <td> <span class="@if(extension_loaded('tokenizer')) ti-check-box  text-success @else  ti-na text-danger  @endif"></span>  </td>
                           <td> <p class="@if(extension_loaded('tokenizer'))  text-success @else  text-danger  @endif"> Tokenizer PHP Extension</p>  </td>
                           <td>Tokenizer PHP Extension</td>
                       </tr>
                       <tr>
                           <td> <span class="@if(extension_loaded('xml')) ti-check-box  text-success @else  ti-na text-danger  @endif"></span>  </td>
                           <td> <p class="@if(extension_loaded('xml'))  text-success @else  text-danger  @endif"> XML PHP Extension</p>  </td>
                           <td>XML PHP Extension</td>
                       </tr>
                       <tr>
                           <td> <span class="@if(extension_loaded('json')) ti-check-box  text-success @else  ti-na text-danger  @endif"></span>  </td>
                           <td> <p class="@if(extension_loaded('json'))  text-success @else  text-danger  @endif"> JSON PHP Extension</p>  </td>
                           <td>JSON PHP Extension</td>
                       </tr> 

                       </tbody>
                   </table>


                </div>

                <form action="{{url('checking-environment')}}" method="get">
                    {{csrf_field()}}
                    <input type="submit" class="offset-3 col-sm-6  primary-btn fix-gr-bg mt-20 mb-20" style="background-color: rebeccapurple;color: whitesmoke" value="Next Step" name="next">
                </form>
            </div>
        </div>
    </div>

</div>
</body>
</html>


