<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        $this->call(sm_schoolsSeeder::class);
        $this->call(rolesSeeder::class);
        $this->call(sm_base_groupsSeeder::class);
        $this->call(sm_base_setupsSeeder::class);
        $this->call(usersSeeder::class);

        $this->call(sm_classesSeeder::class);
        $this->call(sm_sectionsSeeder::class);
        $this->call(sm_class_sectionsSeeder::class);
        $this->call(sm_subjectsSeeder::class);
        $this->call(sm_visitorsSeeder::class);
        $this->call(continentsSeeder::class);
        $this->call(countriesSeeder::class);
        $this->call(languagesSeeder::class);
        $this->call(sm_about_pagesSeeder::class);
        $this->call(sm_academic_yearsSeeder::class);
        $this->call(sm_date_formatsSeeder::class);
        $this->call(sm_designationsSeeder::class);
        $this->call(sm_human_departmentsSeeder::class);
        $this->call(sm_staffsSeeder::class);

        $this->call(sm_expense_headsSeeder::class);
        $this->call(sm_payment_methhodsSeeder::class);
        $this->call(sm_add_expensesSeeder::class);
        $this->call(sm_income_headsSeeder::class);
        $this->call(sm_add_incomesSeeder::class);
        $this->call(sm_bank_accountsSeeder::class);

        $this->call(sm_admission_queriesSeeder::class);
        $this->call(sm_admission_query_followupsSeeder::class);
        $this->call(sm_assign_class_teachersSeeder::class);
        $this->call(sm_assign_subjectsSeeder::class);
        $this->call(sm_class_teachersSeeder::class);


        $this->call(sm_vehiclesSeeder::class);
        $this->call(sm_routesSeeder::class);
        $this->call(sm_assign_vehiclesSeeder::class);

        $this->call(sm_background_settingsSeeder::class);
        $this->call(sm_book_categoriesSeeder::class);
        $this->call(sm_booksSeeder::class);
        $this->call(sm_book_issuesSeeder::class);

        $this->call(sm_chart_of_accountsSeeder::class);
        $this->call(sm_class_roomsSeeder::class);
        $this->call(sm_class_routine_updatesSeeder::class);


        $this->call(sm_class_routinesSeeder::class);
        $this->call(sm_class_timesSeeder::class);
        $this->call(sm_complaintsSeeder::class);
        $this->call(sm_contact_messagesSeeder::class);



        $this->call(sm_contact_pagesSeeder::class);
        $this->call(sm_content_typesSeeder::class);
        $this->call(sm_countriesSeeder::class);
        $this->call(sm_coursesSeeder::class);
        $this->call(sm_currenciesSeeder::class);
        $this->call(sm_custom_linksSeeder::class);
        $this->call(sm_dashboard_settingsSeeder::class);
        $this->call(sm_email_settingsSeeder::class);
        $this->call(sm_email_sms_logsSeeder::class);

        $this->call(sm_dormitory_listsSeeder::class);
        $this->call(sm_room_typesSeeder::class);
        $this->call(sm_room_listsSeeder::class);


        $this->call(sm_sessionsSeeder::class);
        $this->call(sm_student_categoriesSeeder::class);
        $this->call(sm_studentsSeeder::class);

        $this->call(sm_exam_typesSeeder::class);
        $this->call(sm_exam_setupsSeeder::class);
        $this->call(sm_examsSeeder::class);
        $this->call(sm_exam_schedulesSeeder::class);
        $this->call(sm_exam_schedule_subjectsSeeder::class);

        $this->call(sm_fees_groupsSeeder::class);
        $this->call(sm_fees_typesSeeder::class);
        $this->call(sm_fees_mastersSeeder::class);
        $this->call(sm_fees_discountsSeeder::class);
        $this->call(sm_fees_assign_discountsSeeder::class);
        $this->call(sm_fees_assignsSeeder::class);
        $this->call(sm_fees_paymentsSeeder::class);
        $this->call(sm_fees_carry_forwardsSeeder::class);
        $this->call(sm_exam_marks_registersSeeder::class);

        $this->call(sm_frontend_persmissionsSeeder::class);
        $this->call(sm_holidaysSeeder::class);
        $this->call(sm_home_page_settingsSeeder::class);
        $this->call(sm_homework_studentsSeeder::class);
        $this->call(sm_homeworksSeeder::class);
        $this->call(sm_eventsSeeder::class);
        $this->call(sm_exam_attendance_childrenSeeder::class);
        $this->call(sm_exam_attendancesSeeder::class);
        $this->call(sm_hourly_ratesSeeder::class);
        $this->call(sm_hr_payroll_generatesSeeder::class);
        $this->call(sm_hr_payroll_earn_deducsSeeder::class);
        $this->call(sm_hr_salary_templatesSeeder::class);
        $this->call(sm_instructionsSeeder::class);
        $this->call(sm_inventory_paymentsSeeder::class);
        //*************** End ***********************
        $this->call(sm_item_categoriesSeeder::class);
        $this->call(sm_item_issuesSeeder::class);
        $this->call(sm_item_receive_childrenSeeder::class);
        $this->call(sm_item_receivesSeeder::class);
        $this->call(sm_item_sell_childrenSeeder::class);
        $this->call(sm_item_sellsSeeder::class);
        $this->call(sm_item_storesSeeder::class);
        $this->call(sm_itemsSeeder::class);
        $this->call(sm_language_phrasesSeeder::class);
        $this->call(sm_languagesSeeder::class);


        $this->call(sm_leave_typesSeeder::class);
        $this->call(sm_leave_definesSeeder::class);
        $this->call(sm_leave_requestsSeeder::class);


        $this->call(sm_library_membersSeeder::class);
        $this->call(sm_mark_storesSeeder::class);
        $this->call(sm_marks_gradesSeeder::class);
        $this->call(sm_marks_register_childrenSeeder::class);
        $this->call(sm_marks_registersSeeder::class);
        $this->call(sm_marks_send_smsSeeder::class);
        $this->call(sm_module_linksSeeder::class);
        $this->call(sm_modulesSeeder::class);
        $this->call(sm_newsSeeder::class);
        $this->call(sm_news_categoriesSeeder::class);
        $this->call(sm_notice_boardsSeeder::class);
        $this->call(sm_notificationsSeeder::class);

        $this->call(sm_question_groupsSeeder::class);
        $this->call(sm_question_levelsSeeder::class);
        $this->call(sm_question_banksSeeder::class);

        $this->call(sm_online_examsSeeder::class);
        $this->call(sm_online_exam_questionsSeeder::class);
        $this->call(sm_online_exam_question_assignsSeeder::class);
        $this->call(sm_online_exam_marksSeeder::class);

        $this->call(sm_parentsSeeder::class);
        $this->call(sm_payment_gateway_settingsSeeder::class);
        $this->call(sm_postal_dispatchesSeeder::class);
        $this->call(sm_postal_receivesSeeder::class);
        $this->call(sm_product_purchasesSeeder::class);


        $this->call(sm_result_storesSeeder::class);
        $this->call(sm_role_permissionsSeeder::class);
        $this->call(sm_seat_plan_childrenSeeder::class);
        $this->call(sm_seat_plansSeeder::class);
        $this->call(sm_send_messagesSeeder::class);
        $this->call(sm_setup_adminsSeeder::class);
        $this->call(sm_sms_gatewaysSeeder::class);
        $this->call(sm_staff_attendencesSeeder::class);
        $this->call(sm_student_attendancesSeeder::class);
        $this->call(sm_student_certificatesSeeder::class);
        $this->call(sm_student_documentsSeeder::class);
        $this->call(sm_student_excel_formatsSeeder::class);
        $this->call(sm_student_groupsSeeder::class);
        $this->call(sm_student_homeworksSeeder::class);
        $this->call(sm_student_id_cardsSeeder::class);
        $this->call(sm_student_promotionsSeeder::class);
        $this->call(sm_student_take_online_exam_questionsSeeder::class);
        $this->call(sm_student_take_online_examsSeeder::class);
        $this->call(sm_student_take_onln_ex_ques_optionsSeeder::class);
        $this->call(sm_student_timelinesSeeder::class);
        $this->call(sm_suppliersSeeder::class);
        $this->call(sm_system_versionsSeeder::class);
        $this->call(sm_teacher_upload_contentsSeeder::class);
        $this->call(sm_temporary_meritlistSeeder::class);
        $this->call(sm_temporary_meritlistsSeeder::class);
        $this->call(sm_testimonialsSeeder::class);
        $this->call(sm_to_dosSeeder::class);
        $this->call(sm_upload_contentsSeeder::class);
        $this->call(sm_user_logsSeeder::class);
    }
}
