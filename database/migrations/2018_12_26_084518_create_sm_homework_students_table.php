<?php

use App\SmHomework;
use App\SmHomeworkStudent;
use App\SmStudent;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmHomeworkStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_homework_students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('marks')->length(50)->nullable();
            $table->string('teacher_comments',255)->nullable();
            $table->string('complete_status')->length(10)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();

            $table->integer('student_id')->nullable()->unsigned();
            $table->foreign('student_id')->references('id')->on('sm_students')->onDelete('restrict');

            $table->integer('homework_id')->nullable()->unsigned();
            $table->foreign('homework_id')->references('id')->on('sm_homeworks')->onDelete('restrict');

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
        public
        function down()
        {
            Schema::dropIfExists('sm_homework_students');
        }
    }
