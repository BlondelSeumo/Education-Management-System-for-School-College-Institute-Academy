@php
function showPicName($data){
$name = explode('/', $data);
return $name[3];
}
@endphp
<div class="container-fluid mt-30">
    <div class="student-details">
        <div class="student-meta-box">
            <div class="single-meta">
            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'save-homework-evaluation-data', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                <div class="row">
                    <div class="col-lg-9 col-md-9">
                        <table id="" class="table table-condensed table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Admission No</th>
                                    <th>Student Name</th>
                                    <th>Marks</th>
                                    <th>Commnents</th>
                                    <th>Homework Status</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($students as $value)
                                @php
                                    $submitted_student =  App\SmHomework::evaluationHomework($value->id, $homeworkDetails->id);
                                @endphp

                                @if($submitted_student != "")
                                <tr>
                                    <td width="8%">{{$submitted_student->studentInfo->admission_no}}</td>
                                    <td width="10%">{{$submitted_student->studentInfo->full_name}}</td>
                                    <td width="10%">
                                        <div class="input-effect">
                                            <input class="primary-input form-control" type="text" name="marks[]" value="{{$submitted_student->marks}}">
                                            <span class="focus-border"></span>
                                            <label>marks</label>
                                            @if ($errors->has('marks'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('marks') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <input type="hidden" name="student_id[]" value="{{$submitted_student->studentInfo->id}}">
                                        <input type="hidden" name="homework_id" value="{{$homework_id}}">
                                        
                                    </td>

                                    <td>
                                        <div class="d-flex">
                                            <div class="mr-30">
                                                <input type="radio" id="buttonG{{$submitted_student->studentInfo->id}}" class="common-radio" name="teacher_comments[{{$submitted_student->studentInfo->id}}]" value="G" {{$submitted_student->teacher_comments == "G"? 'checked':''}}> &nbsp; &nbsp;<label for="buttonG{{$submitted_student->studentInfo->id}}">Good</label> &nbsp; &nbsp;
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" id="buttonNG{{$submitted_student->studentInfo->id}}" class="common-radio" name="teacher_comments[{{$submitted_student->studentInfo->id}}]" value="NG" {{$submitted_student->teacher_comments == "NG"? 'checked':''}}> &nbsp; &nbsp;<label for="buttonNG{{$submitted_student->studentInfo->id}}">Not Good</label>
                                            </div>
                                        </div>

                                    </td>

                                    <td>
                                        <div class="d-flex">
                                            <div class="mr-30">
                                                <input type="radio" id="buttonC{{$submitted_student->studentInfo->id}}" class="common-radio" name="homework_status[{{$submitted_student->studentInfo->id}}]" value="C" {{$submitted_student->complete_status == "C"? 'checked':''}}> &nbsp; &nbsp;<label for="buttonC{{$submitted_student->studentInfo->id}}">Completed</label> &nbsp; &nbsp;
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" id="buttonNC{{$submitted_student->studentInfo->id}}" class="common-radio" name="homework_status[{{$submitted_student->studentInfo->id}}]" value="NC" {{$submitted_student->complete_status == "NC"? 'checked':''}}>&nbsp; &nbsp; <label for="buttonNC{{$submitted_student->studentInfo->id}}">Not Completed</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <td width="8%">{{$value->admission_no}}</td>
                                    <td width="10%">{{$value->full_name}}</td>
                                    <td width="10%">
                                        <div class="input-effect">
                                            <input class="primary-input form-control" type="text" name="marks[]">
                                            <span class="focus-border"></span>
                                            <label>marks</label>
                                            @if ($errors->has('marks'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('marks') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <input type="hidden" name="student_id[]" value="{{$value->id}}">
                                        <input type="hidden" name="homework_id" value="{{$homework_id}}">
                                        
                                    </td>

                                    <td>

                                        <div class="d-flex">
                                            <div class="mr-30">
                                                <input type="radio" id="buttonG{{$value->id}}" class="common-radio" name="teacher_comments[{{$value->id}}]" value="G" checked> &nbsp; &nbsp;<label for="buttonG{{$value->id}}">Good</label> &nbsp; &nbsp;
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" id="buttonNG{{$value->id}}" class="common-radio" class="common-radio" name="teacher_comments[{{$value->id}}]" value="NG"> &nbsp; &nbsp;<label for="buttonNG{{$value->id}}">Not Good</label>
                                            </div>
                                        </div>
                                    </td>


                                    <td>
                                        <div class="d-flex">
                                        <div class="mr-30">

                                            <input type="radio" id="buttonC{{$value->id}}" class="common-radio" name="homework_status[{{$value->id}}]" value="C" checked> &nbsp; &nbsp;<label for="buttonC{{$value->id}}">Completed</label> &nbsp; &nbsp;
                                        </div>
                                        <div class="mr-30">
                                            <input type="radio" id="buttonNC{{$value->id}}" class="common-radio" name="homework_status[{{$value->id}}]" value="NC">&nbsp; &nbsp; <label for="buttonNC{{$value->id}}">Not Completed</label>
                                        </div>
                                    </div>

                                    </td>
                                </tr>

                                @endif

                                @endforeach
                            </tbody>
                        </table>

                        <div class="col-lg-12 mt-30">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control{{ $errors->has('evaluation_date') ? ' is-invalid' : '' }}" id="evaluation_date" type="text"
                                                placeholder="Evaluation Date" name="evaluation_date" value="{{date('m/d/Y')}}" autocomplete="off" readonly="true">
                                                <span class="focus-border"></span>
                                                @if ($errors->has('evaluation_date'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('evaluation_date') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="evaluation_date_icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button class="primary-btn fix-gr-bg pull-right">
                                        <span class="ti-check"></span>
                                        save Homework
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                       <div class="col-lg-12">
                           <div class="row">

                            <h4 class="stu-sub-head">Homework Summary</h4>

                        </div>
                    </div> 

                    <div class="single-meta">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="value text-left">
                                    Homework Date
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="name">
                                    @if(isset($homeworkDetails))
                                    
      {{$homeworkDetails->homework_date != ""? App\SmGeneralSettings::DateConvater($homeworkDetails->homework_date):''}}

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="single-meta">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="value text-left">
                                    Submission Date
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="name">
                                    @if(isset($homeworkDetails))
                                   
         {{$homeworkDetails->submission_date != ""? App\SmGeneralSettings::DateConvater($homeworkDetails->submission_date):''}}

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="single-meta">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="value text-left">
                                    Evaluation Date 
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="name">
                                    @if($homeworkDetails->evaluation_date != "")
                                  
 {{$homeworkDetails->evaluation_date != ""? App\SmGeneralSettings::DateConvater($homeworkDetails->evaluation_date):''}}
              
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="single-meta">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="value text-left">
                                    Created By
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="name">
                                   @if(isset($homeworkDetails))
                                   {{$homeworkDetails->users->full_name}}
                                   @endif
                               </div>
                           </div>
                       </div>
                   </div>

                   <div class="single-meta">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="value text-left">
                                Evaluated By
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="name">
                                @if(isset($homeworkDetails))
                                {{$homeworkDetails->users->full_name}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="single-meta">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="value text-left">
                                Class
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="name">
                               @if(isset($homeworkDetails))
                               {{$homeworkDetails->classes->class_name}}
                               @endif
                           </div>
                       </div>
                   </div>
               </div>

               <div class="single-meta">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="value text-left">
                            Section
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="name">
                            @if(isset($homeworkDetails))
                            {{$homeworkDetails->sections->section_name}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="single-meta">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="value text-left">
                            Subject
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="name">
                            @if(isset($homeworkDetails))
                            {{$homeworkDetails->subjects->subject_name}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="single-meta">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="value text-left">
                            Marks
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="name">
                            
                            {{$homeworkDetails->marks}}
                           
                        </div>
                    </div>
                </div>
            </div>

            <div class="single-meta">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="value text-left">
                            Attach File
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="name">
                            @if($homeworkDetails->file != "")
                             <a href="{{url('evaluation-document/'.showPicName($homeworkDetails->file))}}">
                                    Download <span class="pl ti-download"></span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="single-meta">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="value text-left">
                            Description
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="name">
                            @if(isset($homeworkDetails))
                            {{$homeworkDetails->description}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>

</div>
</div>
</div>
<script type="text/javascript">
    $('.school-table-data').DataTable({
        bLengthChange: false,
        language: {
            search: "<i class='ti-search'></i>",
            searchPlaceholder: 'Quick Search',
            paginate: {
                next: "<i class='ti-arrow-right'></i>",
                previous: "<i class='ti-arrow-left'></i>"
            }
        },
        buttons: [ ],
        columnDefs: [
        {
            visible: false
        }
        ],
        responsive: true
    });

    // for evaluation date

    $('#evaluation_date_icon').on('click', function() {
        $('#evaluation_date').focus();
    });

    $('.primary-input.date').datepicker({
        autoclose: true
    });

    $('.primary-input.date').on('changeDate', function(ev) {
        $(this).focus();
    });

</script>
