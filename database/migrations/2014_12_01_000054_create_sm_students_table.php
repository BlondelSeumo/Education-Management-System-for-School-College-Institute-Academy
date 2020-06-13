<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admission_no')->nullable();
            $table->integer('roll_no')->nullable();
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('full_name', 200)->nullable();
            $table->date('date_of_birth')->nullable();

            $table->string('caste', 100)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('mobile', 50)->nullable();
            $table->date('admission_date')->nullable();
            $table->string('student_photo')->nullable();

            $table->string('height', 50)->nullable();
            $table->string('weight', 50)->nullable();
            $table->string('current_address', 500)->nullable();
            $table->string('permanent_address', 500)->nullable();

            $table->string('driver_id', 100)->nullable();
            $table->string('national_id_no', 50)->nullable();
            $table->string('local_id_no', 50)->nullable();
            $table->string('bank_account_no', 50)->nullable();
            $table->string('bank_name', 50)->nullable();
            $table->string('previous_school_details', 500)->nullable();
            $table->string('aditional_notes', 500)->nullable();
            $table->string('document_title_1', 100)->nullable();
            $table->string('document_file_1', 100)->nullable();
            $table->string('document_title_2', 100)->nullable();
            $table->string('document_file_2', 100)->nullable();
            $table->string('document_title_3', 100)->nullable();
            $table->string('document_file_3', 100)->nullable();
            $table->string('document_title_4', 100)->nullable();
            $table->string('document_file_4', 100)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();

            $table->integer('bloodgroup_id')->nullable()->unsigned();
            $table->foreign('bloodgroup_id')->references('id')->on('sm_base_setups')->onDelete('restrict');

            $table->integer('religion_id')->nullable()->unsigned();
            $table->foreign('religion_id')->references('id')->on('sm_base_setups')->onDelete('restrict');

            $table->integer('route_list_id')->nullable()->unsigned();
            $table->foreign('route_list_id')->references('id')->on('sm_routes')->onDelete('restrict');

            $table->integer('dormitory_id')->nullable()->unsigned();
            $table->foreign('dormitory_id')->references('id')->on('sm_dormitory_lists')->onDelete('restrict');

            $table->integer('vechile_id')->nullable()->unsigned();
            $table->foreign('vechile_id')->references('id')->on('sm_vehicles')->onDelete('restrict');

            $table->integer('room_id')->nullable()->unsigned();
            $table->foreign('room_id')->references('id')->on('sm_room_lists')->onDelete('restrict');

            $table->integer('student_category_id')->nullable()->unsigned();
            $table->foreign('student_category_id')->references('id')->on('sm_student_categories')->onDelete('restrict');

            $table->integer('class_id')->unsigned();
            $table->foreign('class_id')->references('id')->on('sm_classes')->onDelete('restrict');

            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sm_sections')->onDelete('restrict');

            $table->integer('session_id')->unsigned();
            $table->foreign('session_id')->references('id')->on('sm_sessions')->onDelete('restrict');

            $table->integer('parent_id')->nullable()->unsigned();
            $table->foreign('parent_id')->references('id')->on('sm_parents')->onDelete('restrict');

            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');

            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');

            $table->integer('gender_id')->nullable()->unsigned();
            $table->foreign('gender_id')->references('id')->on('sm_base_setups')->onDelete('restrict');


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
        Schema::dropIfExists('sm_students');
    }
}
