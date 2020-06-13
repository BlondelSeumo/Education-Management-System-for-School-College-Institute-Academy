<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmHumanDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_human_departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();
            
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');
        });

        DB::table('sm_human_departments')->insert([
            [
               'name'=>'Academic',
            ],
            [
               'name'=>'Admin', 
            ],
            [
               'name'=>'Arts', 
            ],
            [
               'name'=>'Commerce', 
            ],
            [
               'name'=>'Library', 
            ],
            [
               'name'=>'Sports', 
            ],
            [
               'name'=>'Science', 
            ],
            [
               'name'=>'Exam', 
            ],
            [
               'name'=>'Finance', 
            ],
            [
               'name'=>'Health', 
            ],
            [
               'name'=>'Technology', 
            ],
            [
               'name'=>'Music and Theater', 
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_human_departments');
    }
}


