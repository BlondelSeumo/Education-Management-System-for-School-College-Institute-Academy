<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmExamMarksRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_exam_marks_registers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('obtained_marks',50)->nullable();
            $table->date('exam_date')->nullable();
            $table->string('comments',500)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();

            $table->integer('exam_id')->unsigned();
            $table->foreign('exam_id')->references('id')->on('sm_exams')->onDelete('restrict');

            $table->integer('student_id')->nullable()->unsigned();
            $table->foreign('student_id')->references('id')->on('sm_students')->onDelete('restrict');

            $table->integer('subject_id')->nullable()->unsigned();
            $table->foreign('subject_id')->references('id')->on('sm_subjects')->onDelete('restrict');


            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');
        });

       //  Schema::table('sm_exam_marks_registers', function($table) {
       //     $table->foreign('exam_id')->references('id')->on('sm_exams');
       //     $table->foreign('student_id')->references('id')->on('sm_students');
       //     $table->foreign('subject_id')->references('id')->on('sm_subjects');
           
       // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_exam_marks_registers');
    }
}
