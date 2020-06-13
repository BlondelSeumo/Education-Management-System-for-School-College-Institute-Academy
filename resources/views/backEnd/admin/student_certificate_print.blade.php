<html>

	<head>
		<title>Student Certificate</title>

		<link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css" />
		<link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/style.css" />
		<style rel="stylesheet">
			.tdWidth{
				width: 33.33%;
			}
			.bgImage{
				height:auto; 
				background-repeat:no-repeat;
				background-image: url({{asset($certificate->file)}});
				  
			}
			table{
				margin-top: 160px;
				text-align: center; 
			}
			tr{ 
			}
			td{
				padding: 25px !important;
			}
			.DivBody{    
				height: 680px !important;
				/*-ms-transform: rotate(20deg); 
				  -webkit-transform: rotate(90deg); 
				  transform: rotate(90deg);*/
				  
			}
			.tdBody{
				text-align: justify !important;				
			    height: 140px;
			    padding-top: 0px;
			    padding-bottom: 0px;
			    padding-left: 65px;
			    padding-right: 65px;

			}
			img{
				position: absolute;
			}
			table{
				position: relative;
				top:100;			
			}
		</style>
	</head>

	<body>

		@foreach($students as $student)
		<div class="DivBody">
			<img src="{{asset($certificate->file)}}" style="height: 670px; width: 1030px">
			<table width="80%" align="center">
				<tr>
					<td style="text-align: left;" class="tdWidth">{{$certificate->header_left_text}}:</td>
					<td style="text-align: center;" class="tdWidth"></td>
					<td style="text-align: right;" class="tdWidth">Date: {{$certificate->date}}</td>
				</tr>
				<tr>
					<td colspan="3" class="tdBody">{{App\SmStudentCertificate::certificateBody($certificate->body, $student->id)}}</td>
				</tr>
				<tr>
					<td style="text-align: left;" class="tdWidth">{{$certificate->footer_left_text}}</td>
					<td style="text-align: center;" class="tdWidth">{{$certificate->footer_center_text}}</td>
					<td style="text-align: right;" class="tdWidth">{{$certificate->footer_right_text}}</td>
				</tr>
			</table>
		</div>
		@endforeach	
























		{{-- <div class="container student-certificate mt-50">
			@foreach($students as $student)
			<div class="row justify-content-center">
				 <div class="col-lg-12 text-center">
                     <div class="mb-5">
					 	<img class="img-fluid" src="{{asset($certificate->file)}}"  >
                      </div>
                  </div>
				<div class="col-lg-8">
					<div class="mb-3 text-center">
						<img class="img-fluid" src="{{asset('public/backEnd/img/logo.png')}}">
						<h2 class="mb-1 mt-3">Infix Kindergarden School</h2>
						<p>632, Santa monica, Rocky Beach, Los Angeles, United States </p>
					</div>
					
					<div class="">
						<div class="mb-2"  style="float:left;">
							<div class="signature">{{$certificate->header_left_text}}:</div>
						</div>
						<div class=""  style="float:right;">
							<div class="signature">date: {{$certificate->date}}</div>
						</div>
					</div>

					<div class="certificate-middle text-center pt-5">
						<h1 class="mb-2">Certificate</h1>
						<p>
							{{App\SmStudentCertificate::certificateBody($certificate->body, $student->id)}}
						</p>
					</div>

					<div class="mt-80">
						<div class="" style="float:left;">
							<div class="signature bb-15">{{$certificate->footer_left_text}}</div>
						</div>
						<div class="" style="display: inline-block; margin:0 auto; width:240px;">
							<div class="signature bb-15">{{$certificate->footer_center_text}}</div>
						</div>
						<div class="" style="float:right">
							<div class="signature bb-15">{{$certificate->footer_right_text}}</div>
						</div>
					</div>
					
				</div>
			</div>
			@endforeach
		</div> --}}
	</body>
</html>