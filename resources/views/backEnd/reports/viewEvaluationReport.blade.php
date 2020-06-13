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

                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <table id="" class="school-table-data school-table shadow-none" cellspacing="0" width="100%">
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

                                @foreach($homework_students as $value)
                                <tr>
                                    <td width="8%">{{$value->studentInfo!=""?$value->studentInfo->admission_no:""}}</td>
                                    <td width="15%">{{$value->studentInfo!=""?$value->studentInfo->full_name:""}}</td>
                                    <td width="15%">{{$value->marks}}</td>

                                    <td width="15%">
                                        @if($value->teacher_comments == 'G')
                                        <a class=""><button class="primary-btn small fix-gr-bg"> Good </button></a>
                                        @else
                                        <a class=""><button class="primary-btn small tr-bg"> Not Good </button></a>
                                        @endif
                                    </td>

                                    <td width="15%">
                                        @if($value->complete_status == 'C')
                                        <a class=""><button class="primary-btn small fix-gr-bg"> Complete </button></a>
                                        @else
                                        <a class=""><button class="primary-btn small tr-bg"> Not Complete </button></a>
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>



                    <div class="col-lg-4">
                        <h4 class="stu-sub-head">Summery</h4>
                        <div class="student-meta-box">

                            <div class="single-meta">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="name">
                                            Homework Date
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="value text-left">
                                         @if(isset($homeworkDetails))
                                        
                                        
                                        
{{$homeworkDetails->homework_date != ""? App\SmGeneralSettings::DateConvater($homeworkDetails->homework_date):''}}

                                         @endif
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="name">
                                        Submission Date
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="value text-left">
                                     @if(isset($homeworkDetails))
                                    
                                    
{{$homeworkDetails->submission_date != ""? App\SmGeneralSettings::DateConvater($homeworkDetails->submission_date):''}}

                                     @endif
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="single-meta">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="value text-left">
                                    Evaluation Date 
                                </div>
                            </div>
                            <div class="col-lg-6">
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
                                <div class="col-lg-6 col-md-6">
                                    <div class="name">
                                        Evaluation Date
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="value text-left">
                                     @if(isset($homeworkDetails))
                                   
                                     
{{$homeworkDetails->evaluation_date != ""? App\SmGeneralSettings::DateConvater($homeworkDetails->evaluation_date):''}}

                                     @endif
                                 </div>
                             </div>
                         </div>
                     </div>


                     <div class="single-meta">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="name">
                                    Created By
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="value text-left">
                                 @if(isset($homeworkDetails))
                                 {{$homeworkDetails->users->full_name}}
                                 @endif
                             </div>
                         </div>
                     </div>
                 </div>

                 <div class="single-meta">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="name">
                                Evaluated By
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="value text-left">
                                @if(isset($homeworkDetails))
                                {{$homeworkDetails->users->full_name}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="single-meta">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="name">
                                Class
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="value text-left">
                             @if(isset($homeworkDetails))
                             {{$homeworkDetails->classes->class_name}}
                             @endif
                         </div>
                     </div>
                 </div>
             </div>

             <div class="single-meta">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="name">
                            Section
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="value text-left">
                          @if(isset($homeworkDetails))
                          {{$homeworkDetails->sections->section_name}}
                          @endif
                      </div>
                  </div>
              </div>
          </div>

          <div class="single-meta">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="name">
                        Subject
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="value text-left">
                      @if(isset($homeworkDetails))
                      {{$homeworkDetails->subjects->subject_name}}
                      @endif
                  </div>
              </div>
          </div>
      </div>

      <div class="single-meta">
            <div class="row">
                <div class="col-lg-6">
                    <div class="value text-left">
                        Marks
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="name">
                        
                        {{$homeworkDetails->marks}}
                       
                    </div>
                </div>
            </div>
        </div>

      <div class="single-meta">
          <div class="row">
              <div class="col-lg-6">
                  <div class="value text-left">
                      Attach File
                  </div>
              </div>
              <div class="col-lg-6">
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
            <div class="col-lg-6 col-md-6">
                <div class="name">
                    Description
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="value text-left">
                  @if(isset($homeworkDetails))
                  {{$homeworkDetails->description}}
                  @endif
              </div>
          </div>
      </div>
  </div>

</div>
</div>

</div>

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
