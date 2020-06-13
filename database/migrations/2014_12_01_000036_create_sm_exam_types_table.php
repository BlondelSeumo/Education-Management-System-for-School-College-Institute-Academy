<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmExamTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_exam_types', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('active_status')->default(1);
            $table->string('title',255);
            $table->timestamps();

            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');
        
        });

        // DB::table('sm_exam_types')->insert([

        //     [
        //         'school_id'=> 1,
        //         'active_status'=> 1,
        //         'title' => 'First Term'
        //     ],
        //     [
        //         'school_id'=> 1,
        //         'active_status'=> 1,
        //         'title' => 'Second Term'
        //     ],
        //     [
        //         'school_id'=> 1,
        //         'active_status'=> 1,
        //         'title' => 'Third Term'
        //     ],
   
        //    ]);
   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_exam_types');
    }
}
