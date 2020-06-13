<script src="<?php echo e(asset('public/backEnd/')); ?>/js/main.js"></script>

<?php
function showPicName($data){
$name = explode('/', $data);
return $name[3];
}
?>
<div class="container-fluid mt-30">
    <div class="student-details">
        <div class="student-meta-box">
            <div class="single-meta">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
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
                                    <?php if(isset($homeworkDetails)): ?>
                                    
                                   
<?php echo e($homeworkDetails->homework_date != ""? App\SmGeneralSettings::DateConvater($homeworkDetails->homework_date):''); ?>


                                    <?php endif; ?>
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
                                    <?php if(isset($homeworkDetails)): ?>
                                    
                                    
<?php echo e($homeworkDetails->submission_date != ""? App\SmGeneralSettings::DateConvater($homeworkDetails->submission_date):''); ?>


                                    <?php endif; ?>
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
                                    <?php if($homeworkDetails->evaluation_date != ""): ?>
                                  
                                    
<?php echo e($homeworkDetails->evaluation_date != ""? App\SmGeneralSettings::DateConvater($homeworkDetails->evaluation_date):''); ?>


                                    <?php endif; ?>
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
                                   <?php if(isset($homeworkDetails)): ?>
                                   <?php echo e($homeworkDetails->users->full_name); ?>

                                   <?php endif; ?>
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
                                <?php if(isset($homeworkDetails)): ?>
                                <?php echo e($homeworkDetails->users->full_name); ?>

                                <?php endif; ?>
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
                               <?php if(isset($homeworkDetails)): ?>
                               <?php echo e($homeworkDetails->classes->class_name); ?>

                               <?php endif; ?>
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
                            <?php if(isset($homeworkDetails)): ?>
                            <?php echo e($homeworkDetails->sections->section_name); ?>

                            <?php endif; ?>
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
                            <?php if(isset($homeworkDetails)): ?>
                            <?php echo e($homeworkDetails->subjects->subject_name); ?>

                            <?php endif; ?>
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
                            
                            <?php echo e($homeworkDetails->marks); ?>

                           
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
                            <?php if($homeworkDetails->file != ""): ?>
                             <a href="<?php echo e(url('evaluation-document/'.showPicName($homeworkDetails->file))); ?>">
                                    Download <span class="pl ti-download"></span>
                            <?php endif; ?>
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
                            <?php if(isset($homeworkDetails)): ?>
                            <?php echo e($homeworkDetails->description); ?>

                            <?php endif; ?>
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
