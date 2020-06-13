<?php
    if (Auth::user() == "") {
        header('location:' . url('/login'));
        exit();
       
    }
        $modules = [];
        $module_links = [];

        $permissions = App\SmRolePermission::where('role_id', Auth::user()->role_id)->get();
        foreach ($permissions as $permission) {
            $module_links[] = $permission->module_link_id;
            $modules[] = $permission->moduleLink->module_id;
        }

        $main_modules = [];

        $module_permissions = App\SmModulePermissionAssign::where('role_id', Auth::user()->role_id)->get();
        foreach ($module_permissions as $permission) {
            $main_modules[] = $permission->module_id;
        }


       

?>

<input type="hidden" name="url" id="url" value="<?php echo e(url('/')); ?>">
<nav id="sidebar">
    <div class="sidebar-header update_sidebar">
        <a href="<?php echo e(url('/')); ?>">
            <img src="<?php echo e(asset($generalSetting->logo)); ?>" alt="">
        </a>
        <a id="close_sidebar" class="d-lg-none">
            <i class="ti-close"></i>
        </a>
    </div>

    <ul class="list-unstyled components">
        <?php if(Auth::user()->role_id != 2 && Auth::user()->role_id != 3 && Auth::user()->role_id != 10 ): ?>

            
            <li>
                <a href="<?php echo e(url('/admin-dashboard')); ?>" id="admin-dashboard">

                    <span class="flaticon-speedometer"></span>
                    <?php echo app('translator')->getFromJson('lang.dashboard'); ?>
                </a>
            </li>



            <?php if(in_array(2, $main_modules)): ?>

            <?php if(@in_array(2, $modules) || Auth::user()->role_id == 1): ?>
                <li>
                    <a href="#subMenuAdmin" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="flaticon-analytics"></span>
                        <?php echo app('translator')->getFromJson('lang.admin_section'); ?>
                    </a>
                    <ul class="collapse list-unstyled" id="subMenuAdmin">
                        <?php if(@in_array(12, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('admission_query')); ?>"><?php echo app('translator')->getFromJson('lang.admission_query'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(16, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('visitor')); ?>"><?php echo app('translator')->getFromJson('lang.visitor_book'); ?> </a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(21, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('complaint')); ?>"><?php echo app('translator')->getFromJson('lang.complaint'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(27, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('postal-receive')); ?>"><?php echo app('translator')->getFromJson('lang.postal_receive'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(32, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('postal-dispatch')); ?>"><?php echo app('translator')->getFromJson('lang.postal_dispatch'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(36, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('phone-call')); ?>"><?php echo app('translator')->getFromJson('lang.phone_call_log'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(41, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('setup-admin')); ?>"><?php echo app('translator')->getFromJson('lang.admin_setup'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(49, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('student-certificate')); ?>"><?php echo app('translator')->getFromJson('lang.student_certificate'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(53, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('generate_certificate')); ?>"><?php echo app('translator')->getFromJson('lang.generate_certificate'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(45, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('student-id-card')); ?>"><?php echo app('translator')->getFromJson('lang.student_id_card'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(57, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('generate_id_card')); ?>"><?php echo app('translator')->getFromJson('lang.generate_id_card'); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

            <?php endif; ?>
            <?php endif; ?>



            <?php if(in_array(3, $main_modules)): ?>
            <?php if(@in_array(3, $modules) || Auth::user()->role_id == 1): ?>
                <li>
                    <a href="#subMenuStudent" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="flaticon-reading"></span>
                        <?php echo app('translator')->getFromJson('lang.student_information'); ?>
                    </a>
                    <ul class="collapse list-unstyled" id="subMenuStudent">
                        <?php if(@in_array(62, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('student_admission')); ?>"><?php echo app('translator')->getFromJson('lang.student_admission'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(64, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('student_list')); ?>"><?php echo app('translator')->getFromJson('lang.student_list'); ?></a>
                            </li>
                        <?php endif; ?>


                        <?php if(@in_array(68, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('student_attendance')); ?>"><?php echo app('translator')->getFromJson('lang.student_attendance'); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(@in_array(70, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('student_attendance_report')); ?>"><?php echo app('translator')->getFromJson('lang.student_attendance_report'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(71, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('student_category')); ?>"><?php echo app('translator')->getFromJson('lang.student_category'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(76, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('student_group')); ?>"><?php echo app('translator')->getFromJson('lang.student_group'); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(@in_array(81, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('student_promote')); ?>"><?php echo app('translator')->getFromJson('lang.student_promote'); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(@in_array(83, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('disabled_student')); ?>"><?php echo app('translator')->getFromJson('lang.disabled_student'); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php endif; ?>



            <?php if(in_array(4, $main_modules)): ?>
            <?php if(@in_array(4, $modules) || Auth::user()->role_id == 1): ?>
                <li>
                    <a href="#subMenuTeacher" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="flaticon-professor"></span>
                        <?php echo app('translator')->getFromJson('lang.teacher'); ?>
                    </a>

                    <ul class="collapse list-unstyled" id="subMenuTeacher">
                        <?php if(@in_array(88, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('upload-content')); ?>"><?php echo app('translator')->getFromJson('lang.upload_content'); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(@in_array(92, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('assignment-list')); ?>"><?php echo app('translator')->getFromJson('lang.assignment'); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(@in_array(96, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('study-metarial-list')); ?>"><?php echo app('translator')->getFromJson('lang.study_material'); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(@in_array(100, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('syllabus-list')); ?>"><?php echo app('translator')->getFromJson('lang.syllabus'); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(@in_array(105, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('other-download-list')); ?>"><?php echo app('translator')->getFromJson('lang.other_download'); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php endif; ?>


            <?php if(in_array(5, $main_modules)): ?>
            <?php if(@in_array(5, $modules) || Auth::user()->role_id == 1): ?>
                <li>
                    <a href="#subMenuFeesCollection" data-toggle="collapse" aria-expanded="false"
                       class="dropdown-toggle">
                        <span class="flaticon-wallet"></span>
                        <?php echo app('translator')->getFromJson('lang.fees_collection'); ?>
                    </a>
                    <ul class="collapse list-unstyled" id="subMenuFeesCollection">
                        <?php if(@in_array(109, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('collect_fees')); ?>"><?php echo app('translator')->getFromJson('lang.collect_fees'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(113, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('search_fees_payment')); ?>"><?php echo app('translator')->getFromJson('lang.search_fees_payment'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(116, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('search_fees_due')); ?>"><?php echo app('translator')->getFromJson('lang.search_fees_due'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(118, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('fees-master')); ?>"><?php echo app('translator')->getFromJson('lang.fees_master'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(123, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('fees_group')); ?>"><?php echo app('translator')->getFromJson('lang.fees_group'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(127, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('fees_type')); ?>"><?php echo app('translator')->getFromJson('lang.fees_type'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(131, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('fees_discount')); ?>"><?php echo app('translator')->getFromJson('lang.fees_discount'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(136, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('fees_forward')); ?>"><?php echo app('translator')->getFromJson('lang.fees_forward'); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php endif; ?>

            <?php if(in_array(6, $main_modules)): ?>
            <?php if(@in_array(6, $modules) || Auth::user()->role_id == 1): ?>
                <li>
                    <a href="#subMenuAccount" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="flaticon-accounting"></span>
                        <?php echo app('translator')->getFromJson('lang.accounts'); ?>
                    </a>
                    <ul class="collapse list-unstyled" id="subMenuAccount">

                        <?php if(@in_array(138, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('profit')); ?>"><?php echo app('translator')->getFromJson('lang.profit'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(139, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('add_income')); ?>"><?php echo app('translator')->getFromJson('lang.income'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(143, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('add-expense')); ?>"><?php echo app('translator')->getFromJson('lang.expense'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(147, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('search_account')); ?>"><?php echo app('translator')->getFromJson('lang.search'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(148, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('chart-of-account')); ?>"><?php echo app('translator')->getFromJson('lang.chart_of_account'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(152, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('payment_method')); ?>"><?php echo app('translator')->getFromJson('lang.payment_method'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(156, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('bank-account')); ?>"><?php echo app('translator')->getFromJson('lang.bank_account'); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php endif; ?>

            <?php if(in_array(7, $main_modules)): ?>
            <?php if(@in_array(7, $modules) || Auth::user()->role_id == 1): ?>
                <li>
                    <a href="#subMenuHumanResource" data-toggle="collapse" aria-expanded="false"
                       class="dropdown-toggle">
                        <span class="flaticon-consultation"></span>
                        <?php echo app('translator')->getFromJson('lang.human_resource'); ?>
                    </a>
                    <ul class="collapse list-unstyled" id="subMenuHumanResource">
                        <?php if(@in_array(161, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('staff_directory')); ?>"><?php echo app('translator')->getFromJson('lang.staff_directory'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(165, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('staff_attendance')); ?>"><?php echo app('translator')->getFromJson('lang.staff_attendance'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(169, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('staff_attendance_report')); ?>"><?php echo app('translator')->getFromJson('lang.staff_attendance_report'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(170, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('payroll')); ?>"><?php echo app('translator')->getFromJson('lang.payroll'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(178, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('payroll-report')); ?>"><?php echo app('translator')->getFromJson('lang.payroll_report'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(180, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('designation')); ?>"><?php echo app('translator')->getFromJson('lang.designation'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(184, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('department')); ?>"><?php echo app('translator')->getFromJson('lang.department'); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php endif; ?>

            <?php if(in_array(8, $main_modules)): ?>

            <?php if(@in_array(8, $modules) || Auth::user()->role_id == 1): ?>
                <li>
                    <a href="#subMenuLeaveManagement" data-toggle="collapse" aria-expanded="false"
                       class="dropdown-toggle">
                        <span class="flaticon-slumber"></span>
                        <?php echo app('translator')->getFromJson('lang.leave'); ?>
                    </a>
                    <ul class="collapse list-unstyled" id="subMenuLeaveManagement">
                        <?php if(@in_array(189, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('approve-leave')); ?>"><?php echo app('translator')->getFromJson('lang.approve_leave_request'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(196, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('pending-leave')); ?>"><?php echo app('translator')->getFromJson('lang.pending_leave_request'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(193, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('apply-leave')); ?>"><?php echo app('translator')->getFromJson('lang.apply_leave'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(199, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('leave-define')); ?>"><?php echo app('translator')->getFromJson('lang.leave_define'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(203, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('leave-type')); ?>"><?php echo app('translator')->getFromJson('lang.leave_type'); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php endif; ?>

            <?php if(in_array(9, $main_modules)): ?>



            <?php if(@in_array(9, $modules) || Auth::user()->role_id == 1): ?>
                <li>
                    <a href="#subMenuExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="flaticon-test"></span>
                        <?php echo app('translator')->getFromJson('lang.examination'); ?>
                    </a>
                    <ul class="collapse list-unstyled" id="subMenuExam">
                        <?php if(@in_array(208, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('exam-type')); ?>"><?php echo app('translator')->getFromJson('lang.add_exam_type'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(214, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('exam')); ?>"> <?php echo app('translator')->getFromJson('lang.exam_setup'); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(@in_array(217, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('exam_schedule')); ?>"><?php echo app('translator')->getFromJson('lang.exam_schedule'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(222, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('marks_register')); ?>"><?php echo app('translator')->getFromJson('lang.marks_register'); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(@in_array(220, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('exam_attendance')); ?>"><?php echo app('translator')->getFromJson('lang.exam_attendance'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(225, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('marks-grade')); ?>"><?php echo app('translator')->getFromJson('lang.marks_grade'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(229, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('send_marks_by_sms')); ?>"><?php echo app('translator')->getFromJson('lang.send_marks_by_sms'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(230, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('question-group')); ?>"><?php echo app('translator')->getFromJson('lang.question_group'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(234, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('question-bank')); ?>"><?php echo app('translator')->getFromJson('lang.question_bank'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(238, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('online-exam')); ?>"><?php echo app('translator')->getFromJson('lang.online_exam'); ?></a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </li>
            <?php endif; ?>
            <?php endif; ?>

            <?php if(in_array(10, $main_modules)): ?>



            <?php if(@in_array(10, $modules) || Auth::user()->role_id == 1 || Auth::user()->role_id == 4): ?>
                <li>
                    <a href="#subMenuAcademic" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="flaticon-graduated-student"></span>
                        <?php echo app('translator')->getFromJson('lang.academics'); ?>
                    </a>
                    <ul class="collapse list-unstyled" id="subMenuAcademic">
                        <?php if(@in_array(246, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('class_routine_new')); ?>"><?php echo app('translator')->getFromJson('lang.class_routine'); ?></a>

                            </li>
                        <?php endif; ?>

                    <!-- only for teacher -->
                        <?php if(Auth::user()->role_id == 4): ?>
                            <li>
                                <a href="<?php echo e(url('view-teacher-routine')); ?>">View Class Routine</a>
                            </li>
                        <?php endif; ?>

                        <?php if(@in_array(250, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('assign_subject')); ?>"><?php echo app('translator')->getFromJson('lang.assign_subject'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(253, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('assign-class-teacher')); ?>"><?php echo app('translator')->getFromJson('lang.assign_class_teacher'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(257, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('subject')); ?>"><?php echo app('translator')->getFromJson('lang.subjects'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(261, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('class')); ?>"><?php echo app('translator')->getFromJson('lang.class'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(265, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('section')); ?>"><?php echo app('translator')->getFromJson('lang.section'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(269, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('class-room')); ?>"><?php echo app('translator')->getFromJson('lang.class_room'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(273, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('class-time')); ?>"><?php echo app('translator')->getFromJson('lang.cl_ex_time_setup'); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php endif; ?>

            <?php if(in_array(11, $main_modules)): ?>

            <?php if(@in_array(11, $modules) || Auth::user()->role_id == 1): ?>
                <li>
                    <a href="#subMenuHomework" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="flaticon-book"></span>
                        <?php echo app('translator')->getFromJson('lang.home_work'); ?>
                    </a>
                    <ul class="collapse list-unstyled" id="subMenuHomework">
                        <?php if(@in_array(278, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('add-homeworks')); ?>"> <?php echo app('translator')->getFromJson('lang.add_homework'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(280, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('homework-list')); ?>"><?php echo app('translator')->getFromJson('lang.homework_list'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(284, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('evaluation-report')); ?>"><?php echo app('translator')->getFromJson('lang.evaluation_report'); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php endif; ?>

            <?php if(in_array(12, $main_modules)): ?>


            <?php if(@in_array(12, $modules) || Auth::user()->role_id == 1): ?>
                <li>
                    <a href="#subMenuCommunicate" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="flaticon-email"></span>
                        <?php echo app('translator')->getFromJson('lang.communicate'); ?>
                    </a>
                    <ul class="collapse list-unstyled" id="subMenuCommunicate">
                        <?php if(@in_array(287, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('notice-list')); ?>"><?php echo app('translator')->getFromJson('lang.notice_board'); ?></a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if(@in_array(291, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('send-email-sms-view')); ?>"><?php echo app('translator')->getFromJson('lang.send_email'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(293, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('email-sms-log')); ?>"><?php echo app('translator')->getFromJson('lang.email_sms_log'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(294, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('event')); ?>"><?php echo app('translator')->getFromJson('lang.event'); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php endif; ?>

            <?php if(in_array(13, $main_modules)): ?>


            <?php if(@in_array(13, $modules) || Auth::user()->role_id == 1): ?>
                <li>
                    <a href="#subMenulibrary" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="flaticon-book-1"></span>
                        <?php echo app('translator')->getFromJson('lang.library'); ?>
                    </a>
                    <ul class="collapse list-unstyled" id="subMenulibrary">
                        <?php if(@in_array(299, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('add-book')); ?>"> <?php echo app('translator')->getFromJson('lang.add_book'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(301, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('book-list')); ?>"> <?php echo app('translator')->getFromJson('lang.book_list'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(304, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('book-category-list')); ?>"><?php echo app('translator')->getFromJson('lang.book_category'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(308, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('library-member')); ?>"><?php echo app('translator')->getFromJson('lang.library_member'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(311, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('member-list')); ?>"> <?php echo app('translator')->getFromJson('lang.member_list'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(314, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('all-issed-book')); ?>"><?php echo app('translator')->getFromJson('lang.all_issued_book'); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php endif; ?>

            <?php if(in_array(14, $main_modules)): ?>

            <?php if(@in_array(14, $modules) || Auth::user()->role_id == 1): ?>
                <li>
                    <a href="#subMenuInventory" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="flaticon-inventory"></span>
                        <?php echo app('translator')->getFromJson('lang.inventory'); ?>
                    </a>
                    <ul class="collapse list-unstyled" id="subMenuInventory">
                        <?php if(@in_array(316, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('item-category')); ?>"><?php echo app('translator')->getFromJson('lang.item_category'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(320, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('item-list')); ?>"><?php echo app('translator')->getFromJson('lang.item_list'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(324, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('item-store')); ?>"><?php echo app('translator')->getFromJson('lang.item_store'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(328, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('suppliers')); ?>"><?php echo app('translator')->getFromJson('lang.supplier'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(332, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('item-receive')); ?>"><?php echo app('translator')->getFromJson('lang.item_receive'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(334, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('item-receive-list')); ?>"><?php echo app('translator')->getFromJson('lang.item_receive_list'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(339, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('item-sell-list')); ?>"><?php echo app('translator')->getFromJson('lang.item_sell'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(345, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('item-issue')); ?>"><?php echo app('translator')->getFromJson('lang.item_issue'); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php endif; ?>

            <?php if(in_array(15, $main_modules)): ?>

            <?php if(@in_array(15, $modules) || Auth::user()->role_id == 1): ?>
                <li>
                    <a href="#subMenuTransport" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="flaticon-bus"></span>
                        <?php echo app('translator')->getFromJson('lang.transport'); ?>
                    </a>
                    <ul class="collapse list-unstyled" id="subMenuTransport">
                        <?php if(@in_array(349, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('transport-route')); ?>"><?php echo app('translator')->getFromJson('lang.routes'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(353, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('vehicle')); ?>"><?php echo app('translator')->getFromJson('lang.vehicle'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(357, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('assign-vehicle')); ?>"><?php echo app('translator')->getFromJson('lang.assign_vehicle'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(361, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('student_transport_report')); ?>"><?php echo app('translator')->getFromJson('lang.student_transport_report'); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php endif; ?>

            <?php if(in_array(16, $main_modules)): ?>

            <?php if(@in_array(16, $modules) || Auth::user()->role_id == 1): ?>
                <li>
                    <a href="#subMenuDormitory" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="flaticon-hotel"></span>
                        <?php echo app('translator')->getFromJson('lang.dormitory'); ?>
                    </a>
                    <ul class="collapse list-unstyled" id="subMenuDormitory">
                        <?php if(@in_array(363, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('room-list')); ?>"> <?php echo app('translator')->getFromJson('lang.dormitory_rooms'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(367, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('dormitory-list')); ?>"><?php echo app('translator')->getFromJson('lang.dormitory'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(371, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('room-type')); ?>"><?php echo app('translator')->getFromJson('lang.room_type'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(375, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('student_dormitory_report')); ?>"><?php echo app('translator')->getFromJson('lang.student_dormitory_report'); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php endif; ?>

            <?php if(in_array(17, $main_modules)): ?>

            <?php if(@in_array(17, $modules) || Auth::user()->role_id == 1): ?>
                <li>
                    <a href="#subMenusystemReports" data-toggle="collapse" aria-expanded="false"
                       class="dropdown-toggle">
                        <span class="flaticon-analysis"></span>
                        <?php echo app('translator')->getFromJson('lang.reports'); ?>
                    </a>
                    <ul class="collapse list-unstyled" id="subMenusystemReports">
                        <?php if(@in_array(376, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('student_report')); ?>"><?php echo app('translator')->getFromJson('lang.student_report'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(377, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('guardian_report')); ?>"><?php echo app('translator')->getFromJson('lang.guardian_report'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(378, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('student_history')); ?>"><?php echo app('translator')->getFromJson('lang.student_history'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(379, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('student_login_report')); ?>"><?php echo app('translator')->getFromJson('lang.student_login_report'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(381, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('fees_statement')); ?>"><?php echo app('translator')->getFromJson('lang.fees_statement'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(382, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('balance_fees_report')); ?>"><?php echo app('translator')->getFromJson('lang.balance_fees_report'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(383, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('transaction_report')); ?>"><?php echo app('translator')->getFromJson('lang.transaction_report'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(384, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('class_report')); ?>"><?php echo app('translator')->getFromJson('lang.class_report'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(385, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('class_routine_report')); ?>"><?php echo app('translator')->getFromJson('lang.class_routine'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(386, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('exam_routine_report')); ?>"><?php echo app('translator')->getFromJson('lang.exam_routine'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(387, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('teacher_class_routine_report')); ?>"><?php echo app('translator')->getFromJson('lang.teacher'); ?> <?php echo app('translator')->getFromJson('lang.class_routine'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(388, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('merit_list_report')); ?>"><?php echo app('translator')->getFromJson('lang.merit_list_report'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(389, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('online_exam_report')); ?>"><?php echo app('translator')->getFromJson('lang.online_exam_report'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(390, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('mark_sheet_report_student')); ?>"><?php echo app('translator')->getFromJson('lang.mark_sheet_report'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(391, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('tabulation_sheet_report')); ?>"><?php echo app('translator')->getFromJson('lang.tabulation_sheet_report'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(392, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('progress_card_report')); ?>">Progress Card Report</a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(393, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('student_fine_report')); ?>"><?php echo app('translator')->getFromJson('lang.student_fine_report'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(394, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('user_log')); ?>"><?php echo app('translator')->getFromJson('lang.user_log'); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php endif; ?>

            <?php if(in_array(18, $main_modules) || Auth::user()->role_id == 1): ?>


            <?php if(@in_array(18, $modules) || Auth::user()->role_id == 1): ?>
                <li>
                    <a href="#subMenusystemSettings" data-toggle="collapse" aria-expanded="false"
                       class="dropdown-toggle">
                        <span class="flaticon-settings"></span>
                        <?php echo app('translator')->getFromJson('lang.system_settings'); ?>
                    </a>
                    <ul class="collapse list-unstyled" id="subMenusystemSettings">
                        <?php if(@in_array(117, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('general-settings')); ?>"> <?php echo app('translator')->getFromJson('lang.general_settings'); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(in_array(118, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('email-settings')); ?>"><?php echo app('translator')->getFromJson('lang.email_settings'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(119, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('payment-method-settings')); ?>"><?php echo app('translator')->getFromJson('lang.payment_method_settings'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(120, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('role')); ?>"><?php echo app('translator')->getFromJson('lang.role'); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(@in_array(120, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('module-permission')); ?>"><?php echo app('translator')->getFromJson('lang.module'); ?> <?php echo app('translator')->getFromJson('lang.permission'); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(@in_array(120, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('login-access-control')); ?>"><?php echo app('translator')->getFromJson('lang.login_permission'); ?></a>
                            </li>
                        <?php endif; ?>


                        <?php if(@in_array(121, $module_links) || Auth::user()->role_id == 1): ?>

                        <?php endif; ?>
                        <?php if(@in_array(122, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(route('base_setup')); ?>"><?php echo app('translator')->getFromJson('lang.base_setup'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(123, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('academic-year')); ?>"><?php echo app('translator')->getFromJson('lang.academic_year'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(124, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('session')); ?>"><?php echo app('translator')->getFromJson('lang.session'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(125, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('holiday')); ?>"><?php echo app('translator')->getFromJson('lang.holiday'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(126, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('sms-settings')); ?>"><?php echo app('translator')->getFromJson('lang.sms_settings'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(127, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('weekend')); ?>"><?php echo app('translator')->getFromJson('lang.weekend'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(128, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('language-settings')); ?>"><?php echo app('translator')->getFromJson('lang.language_settings'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(@in_array(129, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('backup-settings')); ?>"><?php echo app('translator')->getFromJson('lang.backup_settings'); ?></a>
                            </li>
                        <?php endif; ?>



                        <?php if(@in_array(130, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('update-system')); ?>"><?php echo app('translator')->getFromJson('lang.update_system'); ?></a>
                            </li>
                        <?php endif; ?>


                        <?php if(Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('admin-data-delete')); ?>"><?php echo app('translator')->getFromJson('lang.SampleDataEmpty'); ?></a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </li>
            <?php endif; ?>

            <?php endif; ?>

            <?php if(in_array(19, $main_modules)): ?>


            <?php if(in_array(18, $modules) || Auth::user()->role_id == 1): ?>
                <li>
                    <a href="#subMenusystemStyle" data-toggle="collapse" aria-expanded="false"
                       class="dropdown-toggle">
                        <span class="flaticon-settings"></span>
                        <?php echo app('translator')->getFromJson('lang.style'); ?>
                    </a>
                    <ul class="collapse list-unstyled" id="subMenusystemStyle">
                        <?php if(in_array(117, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('background-setting')); ?>"><?php echo app('translator')->getFromJson('lang.background_settings'); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('color-style')); ?>"><?php echo app('translator')->getFromJson('lang.color'); ?> <?php echo app('translator')->getFromJson('lang.theme'); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php endif; ?>

            <?php if(in_array(20, $main_modules)): ?>

            <?php if(in_array(18, $modules) || Auth::user()->role_id == 1): ?>
                <li>
                    <a href="#subMenuApi" data-toggle="collapse" aria-expanded="false"
                       class="dropdown-toggle">
                        <span class="flaticon-settings"></span>
                        <?php echo app('translator')->getFromJson('lang.api'); ?>
                        <?php echo app('translator')->getFromJson('lang.permission'); ?>
                    </a>
                    <ul class="collapse list-unstyled" id="subMenuApi">
                        <?php if(in_array(117, $module_links) || Auth::user()->role_id == 1): ?>
                            <li>
                                <a href="<?php echo e(url('api/permission')); ?>"><?php echo app('translator')->getFromJson('lang.api'); ?> <?php echo app('translator')->getFromJson('lang.permission'); ?> </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php endif; ?>

            <?php if(in_array(21, $main_modules)): ?>

            <?php if(in_array(19, $modules) || Auth::user()->role_id == 1): ?>
                <li>
                    <a href="#subMenufrontEndSettings" data-toggle="collapse" aria-expanded="false"
                       class="dropdown-toggle">
                        <span class="flaticon-software"></span>
                        <?php echo app('translator')->getFromJson('lang.front_settings'); ?>
                    </a>
                    <ul class="collapse list-unstyled" id="subMenufrontEndSettings">
                        <li>
                            <a href="<?php echo e(url('admin-home-page')); ?>"> <?php echo app('translator')->getFromJson('lang.home_page'); ?> </a>
                        </li>

                        <li>
                            <a href="<?php echo e(url('news')); ?>"><?php echo app('translator')->getFromJson('lang.news_list'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('news-category')); ?>"><?php echo app('translator')->getFromJson('lang.news'); ?> <?php echo app('translator')->getFromJson('lang.category'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('testimonial')); ?>"><?php echo app('translator')->getFromJson('lang.testimonial'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('course-list')); ?>"><?php echo app('translator')->getFromJson('lang.course_list'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('contact-page')); ?>"><?php echo app('translator')->getFromJson('lang.contact'); ?> <?php echo app('translator')->getFromJson('lang.page'); ?> </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('contact-message')); ?>"><?php echo app('translator')->getFromJson('lang.contact'); ?> <?php echo app('translator')->getFromJson('lang.message'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('about-page')); ?>"> <?php echo app('translator')->getFromJson('lang.about_us'); ?> </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('custom-links')); ?>"> <?php echo app('translator')->getFromJson('lang.custom_links'); ?> </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>

    <!-- Student Panel -->
        <?php if(Auth::user()->role_id == 2): ?>
            <li>
                <a href="<?php echo e(route('student_dashboard')); ?>">
                    <span class="flaticon-resume"></span>
                    <?php echo app('translator')->getFromJson('lang.my_profile'); ?>
                </a>
            </li>
            <?php if(in_array(23, $main_modules)): ?>
            <li>
                <a href="#subMenuStudentFeesCollection" data-toggle="collapse" aria-expanded="false"
                   class="dropdown-toggle" href="#">
                    <span class="flaticon-wallet"></span>
                    <?php echo app('translator')->getFromJson('lang.fees'); ?>
                </a>
                <ul class="collapse list-unstyled" id="subMenuStudentFeesCollection">
                    <li>
                        <a href="<?php echo e(route('student_fees')); ?>"><?php echo app('translator')->getFromJson('lang.pay_fees'); ?></a>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array(24, $main_modules)): ?>

            <li>
                <a href="<?php echo e(route('student_class_routine')); ?>">
                    <span class="flaticon-calendar-1"></span>
                    <?php echo app('translator')->getFromJson('lang.class_routine'); ?>
                </a>
            </li>
            <?php endif; ?>
            <?php if(in_array(25, $main_modules)): ?>
            <li>
                <a href="<?php echo e(route('student_homework')); ?>">
                    <span class="flaticon-book"></span>
                    <?php echo app('translator')->getFromJson('lang.home_work'); ?>
                </a>
            </li>
            <?php endif; ?>
            <?php if(in_array(26, $main_modules)): ?>
            <li>
                <a href="#subMenuDownloadCenter" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
                   href="#">
                    <span class="flaticon-data-storage"></span>
                    <?php echo app('translator')->getFromJson('lang.download_center'); ?>
                </a>
                <ul class="collapse list-unstyled" id="subMenuDownloadCenter">
                    <li>
                        <a href="<?php echo e(route('student_assignment')); ?>"><?php echo app('translator')->getFromJson('lang.assignment'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('student_study_material')); ?>"><?php echo app('translator')->getFromJson('lang.student_study_material'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('student_syllabus')); ?>"><?php echo app('translator')->getFromJson('lang.syllabus'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('student_others_download')); ?>"><?php echo app('translator')->getFromJson('lang.other_download'); ?></a>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array(27, $main_modules)): ?>
            <li>
                <a href="<?php echo e(route('student_my_attendance')); ?>">
                    <span class="flaticon-authentication"></span>
                    <?php echo app('translator')->getFromJson('lang.attendance'); ?>
                </a>
            </li>
            <?php endif; ?>
            <?php if(in_array(28, $main_modules)): ?>
            <li>
                <a href="#subMenuStudentExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
                   href="#">
                    <span class="flaticon-test"></span>
                    <?php echo app('translator')->getFromJson('lang.examinations'); ?>
                </a>
                <ul class="collapse list-unstyled" id="subMenuStudentExam">
                    <li>
                        <a href="<?php echo e(route('student_result')); ?>"><?php echo app('translator')->getFromJson('lang.result'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('student_exam_schedule')); ?>"><?php echo app('translator')->getFromJson('lang.exam_schedule'); ?></a>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array(29, $main_modules)): ?>
            <li>
                <a href="#subMenuStudentOnlineExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
                   href="#">
                    <span class="flaticon-test-1"></span>
                    <?php echo app('translator')->getFromJson('lang.online_exam'); ?>
                </a>
                <ul class="collapse list-unstyled" id="subMenuStudentOnlineExam">
                    <li>
                        <a href="<?php echo e(route('student_online_exam')); ?>"><?php echo app('translator')->getFromJson('lang.active_exams'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('student_view_result')); ?>"><?php echo app('translator')->getFromJson('lang.view_result'); ?></a>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array(30, $main_modules)): ?>

            <li>
                <a href="<?php echo e(route('student_noticeboard')); ?>">
                    <span class="flaticon-poster"></span>
                    <?php echo app('translator')->getFromJson('lang.notice_board'); ?>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('student_subject')); ?>">
                    <span class="flaticon-reading-1"></span>
                    <?php echo app('translator')->getFromJson('lang.subjects'); ?>
                </a>
            </li>
            <?php endif; ?>
            <?php if(in_array(31, $main_modules)): ?>
            <li>
                <a href="<?php echo e(route('student_teacher')); ?>">
                    <span class="flaticon-professor"></span>
                    <?php echo app('translator')->getFromJson('lang.teacher'); ?>
                </a>
            </li>
            <?php endif; ?>
            <?php if(in_array(32, $main_modules)): ?>
            <li>
                <a href="#subMenuStudentLibrary" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
                   href="#">
                    <span class="flaticon-book-1"></span>
                    <?php echo app('translator')->getFromJson('lang.library'); ?>
                </a>
                <ul class="collapse list-unstyled" id="subMenuStudentLibrary">
                    <li>
                        <a href="<?php echo e(route('student_library')); ?>"> <?php echo app('translator')->getFromJson('lang.book_list'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('student_book_issue')); ?>"><?php echo app('translator')->getFromJson('lang.book_issue'); ?></a>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array(33, $main_modules)): ?>
            <li>
                <a href="<?php echo e(route('student_transport')); ?>">
                    <span class="flaticon-bus"></span>
                    <?php echo app('translator')->getFromJson('lang.transport'); ?>
                </a>
            </li>
            <?php endif; ?>
            <?php if(in_array(34, $main_modules)): ?>
            <li>
                <a href="<?php echo e(route('student_dormitory')); ?>">
                    <span class="flaticon-hotel"></span>
                    <?php echo app('translator')->getFromJson('lang.dormitory'); ?>
                </a>
            </li>
            <?php endif; ?>
        <?php endif; ?>
    <!-- End student panel -->

        <!-- Student Panel -->
        <?php if(Auth::user()->role_id == 3): ?>
            <li>
                <a href="#subMenuParentMyChildren" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-reading"></span>
                    <?php echo app('translator')->getFromJson('lang.my_children'); ?>
                </a>
                <ul class="collapse list-unstyled" id="subMenuParentMyChildren">
                    <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('my_children', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
            <?php if(in_array(37, $main_modules)): ?>
            <li>
                <a href="#subMenuParentFees" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-wallet"></span>
                    <?php echo app('translator')->getFromJson('lang.fees'); ?>
                </a>
                <ul class="collapse list-unstyled" id="subMenuParentFees">
                    <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('parent_fees', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array(38, $main_modules)): ?>
            <li>
                <a href="#subMenuParentClassRoutine" data-toggle="collapse" aria-expanded="false"
                   class="dropdown-toggle">
                    <span class="flaticon-calendar-1"></span>
                    <?php echo app('translator')->getFromJson('lang.class_routine'); ?>
                </a>
                <ul class="collapse list-unstyled" id="subMenuParentClassRoutine">
                    <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('parent_class_routine', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array(39, $main_modules)): ?>
            <li>
                <a href="#subMenuParentHomework" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-book"></span>
                    <?php echo app('translator')->getFromJson('lang.home_work'); ?>
                </a>
                <ul class="collapse list-unstyled" id="subMenuParentHomework">
                    <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('parent_homework', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array(40, $main_modules)): ?>
            <li>
                <a href="#subMenuParentAttendance" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-authentication"></span>
                    <?php echo app('translator')->getFromJson('lang.attendance'); ?>
                </a>
                <ul class="collapse list-unstyled" id="subMenuParentAttendance">
                    <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('parent_attendance', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array(41, $main_modules)): ?>
            <li>
                <a href="#subMenuParentExamination" data-toggle="collapse" aria-expanded="false"
                   class="dropdown-toggle">
                    <span class="flaticon-test"></span>
                    <?php echo app('translator')->getFromJson('lang.exam_result'); ?>
                </a>
                <ul class="collapse list-unstyled" id="subMenuParentExamination">
                    <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('parent_examination', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array(42, $main_modules)): ?>
            <li>
                <a href="<?php echo e(route('parent_noticeboard')); ?>">
                    <span class="flaticon-poster"></span>
                    <?php echo app('translator')->getFromJson('lang.notice_board'); ?>
                </a>
            </li>
            <?php endif; ?>
            <?php if(in_array(43, $main_modules)): ?>
            <li>
                <a href="#subMenuParentSubject" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-reading-1"></span>
                    <?php echo app('translator')->getFromJson('lang.subjects'); ?>
                </a>
                <ul class="collapse list-unstyled" id="subMenuParentSubject">
                    <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('parent_subjects', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array(44, $main_modules)): ?>

            <li>
                <a href="#subMenuParentTeacher" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-professor"></span>
                    <?php echo app('translator')->getFromJson('lang.teacher_list'); ?>
                </a>
                <ul class="collapse list-unstyled" id="subMenuParentTeacher">
                    <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('parent_teacher_list', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array(45, $main_modules)): ?>
            <li>
                <a href="#subMenuParentTransport" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-bus"></span>
                    <?php echo app('translator')->getFromJson('lang.transport'); ?>
                </a>
                <ul class="collapse list-unstyled" id="subMenuParentTransport">
                    <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('parent_transport', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array(46, $main_modules)): ?>
            <li>
                <a href="#subMenuParentDormitory" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-hotel"></span>
                    <?php echo app('translator')->getFromJson('lang.dormitory_list'); ?>
                </a>
                <ul class="collapse list-unstyled" id="subMenuParentDormitory">
                    <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('parent_dormitory', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
            <?php endif; ?>
        <?php endif; ?>


        <?php if(Auth::user()->role_id == 10): ?>

            <li>
                <a href="<?php echo e(url('/customer-dashboard')); ?>" id="customer-dashboard">

                    <span class="flaticon-speedometer"></span>
                    <?php echo app('translator')->getFromJson('lang.dashboard'); ?>
                </a>
            </li>

            <li>
                <a href="#SubMenuCustomerProfile" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-hotel"></span>
                    Profile
                </a>
                <ul class="collapse list-unstyled" id="SubMenuCustomerProfile">
                    <li>
                        <a href="#">View Profile</a>
                    </li>
                    <li>
                        <a href="#">Update Profile</a>
                    </li>
                    <li>
                        <a href="<?php echo e(url('/change-password')); ?>">Change Password</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#SubMenuCustomerHistory" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-hotel"></span>
                    History
                </a>
                <ul class="collapse list-unstyled" id="SubMenuCustomerHistory">
                    <li>
                        <a href="<?php echo e(url('/customer-purchases')); ?>">Purchases</a>
                    </li>
                    <li>
                        <a href="#">Payment</a>
                    </li>
                </ul>
            </li>

        <?php endif; ?>

    </ul>
</nav>
