<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmStudentIdCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_student_id_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('logo')->nullable();
            $table->string('designation')->nullable();
            $table->string('signature')->nullable(); 
            $table->text('address')->nullable();
            $table->string('admission_no')->default(0)->comment('0 for no 1 for yes');
            $table->string('student_name')->default(0)->comment('0 for no 1 for yes');
            $table->string('class')->default(0)->comment('0 for no 1 for yes');
            $table->string('father_name')->default(0)->comment('0 for no 1 for yes');
            $table->string('mother_name')->default(0)->comment('0 for no 1 for yes');
            $table->string('student_address')->default(0)->comment('0 for no 1 for yes');
            $table->string('phone')->default(0)->comment('0 for no 1 for yes');
            $table->string('dob')->default(0)->comment('0 for no 1 for yes');
            $table->string('blood')->default(0)->comment('0 for no 1 for yes');
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();



            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_student_id_cards');
    }
}
