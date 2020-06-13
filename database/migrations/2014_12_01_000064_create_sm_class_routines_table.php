<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmClassRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_class_routines', function (Blueprint $table) {
            $table->increments('id');
           

            $table->string('monday',20)->nullable();
            $table->string('monday_start_from',20)->nullable();
            $table->string('monday_end_to',20)->nullable();
            $table->integer('monday_room_id')->unsigned()->nullable();

            $table->string('tuesday',20)->nullable();
            $table->string('tuesday_start_from',20)->nullable();
            $table->string('tuesday_end_to',20)->nullable();
            $table->integer('tuesday_room_id')->unsigned()->nullable();

            $table->string('wednesday',20)->nullable();
            $table->string('wednesday_start_from',20)->nullable();
            $table->string('wednesday_end_to',20)->nullable();
            $table->integer('wednesday_room_id')->unsigned()->nullable();

            $table->string('thursday',20)->nullable();
            $table->string('thursday_start_from',20)->nullable();
            $table->string('thursday_end_to',20)->nullable();
            $table->integer('thursday_room_id')->unsigned()->nullable();

            $table->string('friday',20)->nullable();
            $table->string('friday_start_from',20)->nullable();
            $table->string('friday_end_to',20)->nullable();
            $table->integer('friday_room_id')->unsigned()->nullable();

            $table->string('saturday',20)->nullable();
            $table->string('saturday_start_from',20)->nullable();
            $table->string('saturday_end_to',20)->nullable();
            $table->integer('saturday_room_id')->unsigned()->nullable();

            $table->string('sunday',20)->nullable();
            $table->string('sunday_start_from',20)->nullable();
            $table->string('sunday_end_to',20)->nullable();
            $table->integer('sunday_room_id')->unsigned()->nullable();

            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();


            $table->integer('class_id')->nullable()->unsigned();
            $table->foreign('class_id')->references('id')->on('sm_classes')->onDelete('restrict');


            $table->integer('section_id')->nullable()->unsigned();
            $table->foreign('section_id')->references('id')->on('sm_sections')->onDelete('restrict');

            $table->integer('subject_id')->nullable()->unsigned();
            $table->foreign('subject_id')->references('id')->on('sm_subjects')->onDelete('restrict');


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
        Schema::dropIfExists('sm_class_routines');
    }
}
