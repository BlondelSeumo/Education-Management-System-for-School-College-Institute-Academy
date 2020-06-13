<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmDesignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_designations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();

            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');
        });


            DB::table('sm_designations')->insert([
                [
                'title'=>'Headmaster', 
                ],
                [
                'title'=>'Assistant Head Master', 
                ],
                [
                'title'=>'Assistant Teacher', 
                ],
                [
                'title'=>'Senior Teacher', 
                ],
                [
                'title'=>'Senior Assistant Teacher', 
                ], 
                [
                'title'=>'Faculty', 
                ], 
                [
                'title'=>'Accountant', 
                ], 
                [
                'title'=>'Librarian', 
                ], 
                [
                'title'=>'Admin', 
                ], 
                [
                'title'=>'Receptionist', 
                ], 
                [
                'title'=>'Principal', 
                ], 
                [
                'title'=>'Director', 
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
        Schema::dropIfExists('sm_designations');
    }
}
