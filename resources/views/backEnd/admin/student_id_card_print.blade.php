@php  
$setting = App\SmGeneralSettings::find(1);
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>Student ID Card</title>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/style.css" />
    <style media="print">
		body.admin {
			background: #fff;
		}
		.student-meta-box {
			border: 1px solid #eee;
    		border-radius: 10px;
		}
		.p-3.radius-t-y-0 {
			position: absolute;
			top: 125px;
			left: 24px;
			right: 24px;
			bottom: 30px;
			box-shadow: none;
		}
		div.page {
            page-break-after: always;
            page-break-inside: avoid;
        }
    </style>
</head>
<body class="mt-4">
	<div class="container">
		<div class="row justify-content-center">
			@foreach($students as $student)
			<div class="col-lg-5 page">
				<div class="student-details">
					<div class="student-meta-box">
						<div class="position-relative">
							<img class="w-100 img-fluid" src="{{asset('public/backEnd/img/student/id-card-bg.png')}}">
							<h3 class="" style="position:absolute; left: 20px; top: 45px; color: #fff">View Student ID Card</h3>
						</div>
						<!-- <div class="text-center p-3">
							<img class="img-fluid" src="{{asset('public/backEnd/img/student/student-id-bg.png')}}">
						</div> -->

						<div class="p-3 radius-t-y-0 pb-4" style="border:1px solid #ddd">
							<div class="text-center mb-4">
								<img class="img-180" src="{{asset('public/backEnd/img/student/id-card-img.jpg')}}" alt="">
							</div>
							@if($id_card->student_name == 1)
                            <div class="single-meta">
                                <div class="d-flex align-items-center">
                                    <div style="float: left">
                                        <div class="value text-left">
                                            Student Name
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                    <div style="float: right">
                                        <div class="name">
                                            {{$student->full_name}}
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                            </div>
                            @endif

                            @if($id_card->admission_no == 1)
                            <div class="single-meta">
                                <div class="d-flex align-items-center">
                                    <div style="float: left">
                                        <div class="value text-left">
                                            Admission No.
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                    <div style="float: right">
                                        <div class="name text-left">
                                            {{$student->admission_no}}
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                            </div>
                            @endif

                            @if($id_card->class == 1)
                            <div class="single-meta">
                                <div class="d-flex align-items-center">
                                    <div style="float: left">
                                        <div class="value text-left">
                                            Class
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                    <div style="float: right">
                                        <div class="name">
                                            {{$student->className!=""?$student->className->class_name:""}} ({{$student->section!=""?$student->section->section_name:""}})
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                            </div>
                            @endif 

                            @if($id_card->father_name == 1)
                            <div class="single-meta">
                                <div class="d-flex align-items-center">
                                    <div style="float: left">
                                        <div class="value text-left">
                                            Father's Name
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                    <div style="float: right">
                                        <div class="name">
                                            {{$student->parents !=""?$student->parents->fathers_name:""}}
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                            </div>
                            @endif

                            @if($id_card->mother_name == 1)
                            <div class="single-meta">
                                <div class="d-flex align-items-center">
                                    <div style="float: left">
                                        <div class="value text-left">
                                            Mother's Name
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                    <div style="float: right">
                                        <div class="name">
                                           {{$student->parents!=""?$student->parents->mothers_name:""}}
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                            </div>
                            @endif

                            @if($id_card->blood == 1)
                            <div class="single-meta">
                                <div class="d-flex align-items-center">
                                    <div style="float: left">
                                        <div class="value text-left">
                                            Blood Group
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                    <div style="float: right">
                                        <div class="name">
                                            {{$student->bloodGroup !=""?$student->bloodGroup->base_setup_name:""}}
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                            </div>
                            @endif

                            @if($id_card->phone == 1)
                            <div class="single-meta">
                                <div class="d-flex align-items-center">
                                    <div style="float: left">
                                        <div class="value text-left">
                                            Phone
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                    <div style="float: right">
                                        <div class="name">
                                            {{$student->mobile}}
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                            </div>
                            @endif

                            @if($id_card->dob == 1)
                            <div class="single-meta">
                                <div class="d-flex align-items-center">
                                    <div style="float: left">
                                        <div class="value text-left">
                                            Date of birth
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                    <div style="float: right">
                                        <div class="name">
                                            {{$student->birth_of_birth != ""? App\SmGeneralSettings::DateConvater($student->birth_of_birth):''}}

                                          
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                            </div>
                            @endif


                            <div class="single-meta">
                                <div class="d-flex align-items-center">
                                    <div style="float: left">
                                        <div class="value text-left">
                                            {{$id_card->designation}}
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                    <div style="float: right">
                                        <img class="img-fluid" src="{{asset($id_card->signature)}}">
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                            </div>

                            <div class="bottom-part text-center mt-5">
                                <img class="img-fluid w-25" src="{{asset($id_card->logo)}}">
                                <p class="mb-0 mt-3">{{$id_card->address}} </p>
                            </div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<script src="{{asset('public/backEnd/')}}/vendors/js/jquery-3.2.1.min.js"></script>
</body>
</html>
<!-- @foreach($students as $student)
	<h6>{{$student->full_name}}</h6>
@endforeach

@php

	echo '<pre>';
		print_r($id_card);

@endphp -->
