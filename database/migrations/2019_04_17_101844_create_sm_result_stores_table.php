<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateSmResultStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_result_stores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_roll_no')->default(1); 
            $table->integer('student_addmission_no')->default(1); 
            $table->integer('is_absent')->default(0)->comment('1=Absent, 0=Present'); 
            $table->float('total_marks')->default(0); 
            $table->float('total_gpa_point')->nullable(); 
            $table->string('total_gpa_grade',255)->default(0); 
            $table->timestamps();


            $table->integer('exam_type_id')->nullable()->unsigned();
            $table->foreign('exam_type_id')->references('id')->on('sm_exam_types')->onDelete('restrict');

            $table->integer('subject_id')->nullable()->unsigned();
            $table->foreign('subject_id')->references('id')->on('sm_subjects')->onDelete('restrict');


            $table->integer('exam_setup_id')->nullable()->unsigned();
            $table->foreign('exam_setup_id')->references('id')->on('sm_exam_setups')->onDelete('restrict');

            $table->integer('student_id')->nullable()->unsigned();
            $table->foreign('student_id')->references('id')->on('sm_students')->onDelete('restrict');

            $table->integer('class_id')->nullable()->unsigned();
            $table->foreign('class_id')->references('id')->on('sm_classes')->onDelete('restrict');


            $table->integer('section_id')->nullable()->unsigned();
            $table->foreign('section_id')->references('id')->on('sm_sections')->onDelete('restrict');

            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');
        });

        // $sql ="INSERT INTO `sm_result_stores` (`id`, `school_id`, `class_id`, `section_id`, `subject_id`, `exam_type_id`, `exam_setup_id`, `student_id`, `student_roll_no`, `student_addmission_no`, `is_absent`, `total_marks`, `total_gpa_point`, `total_gpa_grade`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
        //     (1, 1, 1, 1, 1, 1, 1, 1, 20, 20, 0, 87.00, 5.00, 'A+', 1, 1, '2019-05-31 08:42:29', '2019-05-31 08:42:29'),
        //     (2, 1, 1, 1, 1, 1, 1, 11, 30, 30, 0, 87.00, 5.00, 'A+', 1, 1, '2019-05-31 08:42:29', '2019-05-31 08:42:29'),
        //     (3, 1, 1, 1, 1, 1, 1, 21, 40, 40, 0, 88.00, 5.00, 'A+', 1, 1, '2019-05-31 08:42:29', '2019-05-31 08:42:29'),
        //     (4, 1, 1, 1, 1, 1, 1, 31, 50, 50, 0, 72.00, 4.00, 'A', 1, 1, '2019-05-31 08:42:29', '2019-05-31 08:42:29'),
        //     (5, 1, 1, 1, 1, 1, 1, 41, 60, 60, 0, 76.00, 4.00, 'A', 1, 1, '2019-05-31 08:42:29', '2019-05-31 08:42:29'),
        //     (6, 1, 1, 1, 1, 1, 1, 51, 70, 70, 0, 78.00, 4.00, 'A', 1, 1, '2019-05-31 08:42:29', '2019-05-31 08:42:29'),
        //     (7, 1, 1, 1, 1, 1, 1, 61, 80, 80, 0, 76.00, 4.00, 'A', 1, 1, '2019-05-31 08:42:29', '2019-05-31 08:42:29'),
        //     (8, 1, 1, 1, 1, 1, 1, 71, 90, 90, 0, 84.00, 5.00, 'A+', 1, 1, '2019-05-31 08:42:29', '2019-05-31 08:42:29'),
        //     (9, 1, 1, 1, 2, 1, 1, 1, 20, 20, 0, 92.00, 5.00, 'A+', 1, 1, '2019-05-31 08:43:09', '2019-05-31 08:43:09'),
        //     (10, 1, 1, 1, 2, 1, 1, 11, 30, 30, 0, 91.00, 5.00, 'A+', 1, 1, '2019-05-31 08:43:09', '2019-05-31 08:43:09'),
        //     (11, 1, 1, 1, 2, 1, 1, 21, 40, 40, 0, 84.00, 5.00, 'A+', 1, 1, '2019-05-31 08:43:09', '2019-05-31 08:43:09'),
        //     (12, 1, 1, 1, 2, 1, 1, 31, 50, 50, 0, 76.00, 4.00, 'A', 1, 1, '2019-05-31 08:43:09', '2019-05-31 08:43:09'),
        //     (13, 1, 1, 1, 2, 1, 1, 41, 60, 60, 0, 74.00, 4.00, 'A', 1, 1, '2019-05-31 08:43:09', '2019-05-31 08:43:09'),
        //     (14, 1, 1, 1, 2, 1, 1, 51, 70, 70, 0, 90.00, 5.00, 'A+', 1, 1, '2019-05-31 08:43:09', '2019-05-31 08:43:09'),
        //     (15, 1, 1, 1, 2, 1, 1, 61, 80, 80, 0, 81.00, 5.00, 'A+', 1, 1, '2019-05-31 08:43:09', '2019-05-31 08:43:09'),
        //     (16, 1, 1, 1, 2, 1, 1, 71, 90, 90, 0, 75.00, 4.00, 'A', 1, 1, '2019-05-31 08:43:09', '2019-05-31 08:43:09'),
        //     (17, 1, 1, 1, 3, 1, 1, 1, 20, 20, 0, 83.00, 5.00, 'A+', 1, 1, '2019-05-31 08:43:50', '2019-05-31 08:43:50'),
        //     (18, 1, 1, 1, 3, 1, 1, 11, 30, 30, 0, 86.00, 5.00, 'A+', 1, 1, '2019-05-31 08:43:50', '2019-05-31 08:43:50'),
        //     (19, 1, 1, 1, 3, 1, 1, 21, 40, 40, 0, 80.00, 5.00, 'A+', 1, 1, '2019-05-31 08:43:50', '2019-05-31 08:43:50'),
        //     (20, 1, 1, 1, 3, 1, 1, 31, 50, 50, 0, 76.00, 4.00, 'A', 1, 1, '2019-05-31 08:43:50', '2019-05-31 08:43:50'),
        //     (21, 1, 1, 1, 3, 1, 1, 41, 60, 60, 0, 72.00, 4.00, 'A', 1, 1, '2019-05-31 08:43:50', '2019-05-31 08:43:50'),
        //     (22, 1, 1, 1, 3, 1, 1, 51, 70, 70, 0, 72.00, 4.00, 'A', 1, 1, '2019-05-31 08:43:50', '2019-05-31 08:43:50'),
        //     (23, 1, 1, 1, 3, 1, 1, 61, 80, 80, 0, 74.00, 4.00, 'A', 1, 1, '2019-05-31 08:43:50', '2019-05-31 08:43:50'),
        //     (24, 1, 1, 1, 3, 1, 1, 71, 90, 90, 0, 74.00, 4.00, 'A', 1, 1, '2019-05-31 08:43:50', '2019-05-31 08:43:50')";
        //     DB::insert($sql);

         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_result_stores');
    }
}
