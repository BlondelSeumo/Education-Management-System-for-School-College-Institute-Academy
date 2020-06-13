<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmStudentPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_student_promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('result_status', 10)->nullable();
            $table->timestamps();

            $table->integer('previous_class_id')->nullable()->unsigned();
            $table->foreign('previous_class_id')->references('id')->on('sm_classes')->onDelete('restrict');

            $table->integer('current_class_id')->nullable()->unsigned();
            $table->foreign('current_class_id')->references('id')->on('sm_classes')->onDelete('restrict');

            $table->integer('previous_session_id')->nullable()->unsigned();
            $table->foreign('previous_session_id')->references('id')->on('sm_sessions')->onDelete('restrict');

            $table->integer('current_session_id')->nullable()->unsigned();
            $table->foreign('current_session_id')->references('id')->on('sm_sessions')->onDelete('restrict');

            $table->integer('student_id')->nullable()->unsigned();
            $table->foreign('student_id')->references('id')->on('sm_students')->onDelete('restrict');

            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');
        });

       //  Schema::table('sm_student_promotions', function($table) {
       //     $table->foreign('student_id')->references('id')->on('sm_students');
           
       // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_student_promotions');
    }
}
