<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_countries', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';
            $table->increments('id');
            $table->string('code',255)->nullable();
            $table->string('name',255)->nullable();
            $table->string('native',255)->nullable();
            $table->string('phone',255)->nullable();
            $table->string('continent',255)->nullable();
            $table->string('capital',255)->nullable();
            $table->string('currency',255)->nullable();
            $table->string('languages',255)->nullable()->charset('utf8')->collate('utf8_general_ci');
            $table->timestamps();

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
        Schema::dropIfExists('sm_countries');
    }
}
