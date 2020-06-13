<!DOCTYPE html>
<html lang="">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="icon" href="{{asset('public/backEnd/')}}/img/favicon.png" type="image/png"/>
    <title>INFIX EDU ERP</title>
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
    <style>
        h2, h5 {
            color: whitesmoke
        }

        .card-body {
            padding: 5.25rem;
        }

        .single-report-admit .card-header {
            background-position: right;
            margin-top: -5px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 20px;
        }

    </style>
</head>

<body class="admin">
<div class="container">
    <div class="col-md-6 offset-3 mt-40" >

            <ul id="progressbar">
                <li class="active">welcome</li>
                <li class="active">verification</li> 
                <li class="active">Environment</li>
                <li class="active">System Setup</li>
            </ul>


        <div class="card">
            <div class="single-report-admit">
                <div class="card-header">
                    <h2 style="text-align: center">System Setup</h2>
                </div>
            </div>
            <div class="card-body">
                @if($errors)
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger"><ul><li>{{ $error }}</li></ul></div>
                    @endforeach
                @endif
                <form method="post" action="{{url('confirm-installing')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="institution_name">Institution Name:</label>
                        <input type="text" class="form-control" name="institution_name" required value="{{old('institution_name')}}">
                    </div>
                    <div class="form-group"> 
                        <input type="hidden" class="form-control" name="institution_code" required value="{{time()}}"> 
                        <input type="hidden" name="institution_address" value="201 Conference Center Way, Bridgeport, WV, 26330"> 
                        <input type="hidden" name="session_year" value="{{date('Y')}}"> 
                    </div> 

                    <div class="form-group">
                        <label for="system_admin_email">System Admin Email:</label>
                        <input type="text" class="form-control" name="system_admin_email" required autocomplete="off" value="{{old('system_admin_email')}}">
                    </div>
                    <div class="form-group">
                        <label for="system_admin_password">System Admin Password:</label>
                        <input type="password" class="form-control" name="system_admin_password" required autocomplete="off" value="{{old('system_admin_password')}}">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password:</label>
                        <input type="password" class="form-control" name="password_confirmation" required  autocomplete="false" value="{{old('password_confirmation')}}">
                    </div>


                    <div class="form-group">
                        <label for="install_mode">Install Mode:</label>
                        <select class="form-control" name="install_mode" required>
                            <option value="1">With Sample Data</option>
                            <option value="2">Without Sample Data</option> 
                        </select>
                    </div>


                    <input type="submit" value="Let's Go" class="offset-3 col-sm-6  primary-btn fix-gr-bg mt-40"
                           style="background-color: rebeccapurple;color: whitesmoke">
                </form>
            </div>
        </div>
    </div>

</div>
</body>
</html>

