<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmExamSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_exam_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();

            $table->integer('exam_period_id')->nullable()->unsigned();
            $table->foreign('exam_period_id')->references('id')->on('sm_class_times')->onDelete('restrict');

            $table->integer('room_id')->nullable()->unsigned();
            $table->foreign('room_id')->references('id')->on('sm_room_lists')->onDelete('restrict');

            $table->integer('subject_id')->nullable()->unsigned();
            $table->foreign('subject_id')->references('id')->on('sm_subjects')->onDelete('restrict');

            $table->integer('exam_term_id')->nullable()->unsigned();
            $table->foreign('exam_term_id')->references('id')->on('sm_exam_types')->onDelete('restrict');

            $table->integer('exam_id')->nullable()->unsigned();
            $table->foreign('exam_id')->references('id')->on('sm_exams')->onDelete('restrict');

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

        // $sql ="INSERT INTO sm_exam_schedules 
        //     (id, class_id, section_id, exam_term_id, exam_id, exam_period_id, subject_id, date, room_id, active_status, created_by, updated_by, created_at, updated_at) 
        //     VALUES
        //     (1, 1, 1, 1, NULL, 8, 1, '2019-05-31', 3, 1, 1, 1, '2019-05-31 08:29:51', '2019-05-31 08:29:51'),
        //     (2, 1, 1, 1, NULL, 9, 2, '2019-05-25', 7, 1, 1, 1, '2019-05-31 08:30:02', '2019-05-31 08:30:02'),
        //     (3, 1, 1, 1, NULL, 8, 3, '2019-06-08', 1, 1, 1, 1, '2019-05-31 08:30:16', '2019-05-31 08:30:16'),
        //     (4, 1, 2, 1, NULL, 8, 1, '2019-05-26', 1, 1, 1, 1, '2019-05-31 08:30:50', '2019-05-31 08:30:50'),
        //     (5, 1, 2, 1, NULL, 10, 2, '2019-05-26', 1, 1, 1, 1, '2019-05-31 08:31:10', '2019-05-31 08:31:10'),
        //     (6, 1, 2, 1, NULL, 9, 3, '2019-06-01', 4, 1, 1, 1, '2019-05-31 08:31:25', '2019-05-31 08:31:25'),
        //     (7, 1, 3, 1, NULL, 8, 1, '2019-04-28', 3, 1, 1, 1, '2019-05-31 08:32:09', '2019-05-31 08:32:09'),
        //     (8, 1, 3, 1, NULL, 8, 2, '2019-05-18', 4, 1, 1, 1, '2019-05-31 08:32:22', '2019-05-31 08:32:22'),
        //     (9, 1, 3, 1, NULL, 8, 3, '2019-05-31', 3, 1, 1, 1, '2019-05-31 08:32:37', '2019-05-31 08:32:37')";
        // DB::insert($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_exam_schedules');
    }
}
