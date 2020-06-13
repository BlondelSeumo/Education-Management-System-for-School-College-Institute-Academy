<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmTeacherUploadContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_teacher_upload_contents', function (Blueprint $table) {
        $table->increments('id');
        $table->string('content_title')->length(100)->nullable();
        $table->string('content_type')->nullable()->comment("as assignment, st study material, sy sullabus, ot others download");
        $table->integer('available_for_admin')->default(0);
        $table->integer('available_for_all_classes')->default(0);
        $table->date('upload_date')->nullable();
        $table->string('description')->length(500)->nullable();
        $table->string('upload_file')->length(200)->nullable();
        $table->tinyInteger('active_status')->default(1);
        $table->timestamps();

        $table->integer('class')->nullable()->unsigned();
        $table->foreign('class')->references('id')->on('sm_classes')->onDelete('restrict');

        $table->integer('section')->nullable()->unsigned();
        $table->foreign('section')->references('id')->on('sm_sections')->onDelete('restrict');

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
        Schema::dropIfExists('sm_teacher_upload_contents');
    }
}
