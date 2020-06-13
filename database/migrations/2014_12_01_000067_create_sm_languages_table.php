<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SmLanguage;

class CreateSmLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('language_name')->nullable();
            $table->string('native')->nullable();
            $table->string('language_universal')->nullable();
            $table->tinyInteger('active_status')->default(0);
            $table->timestamps();

            $table->integer('lang_id')->nullable()->default(1)->unsigned();
            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('restrict');

            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');
        });

 


        $store = new SmLanguage();
        $store->language_name = 'English';
        $store->native = 'English';
        $store->language_universal = 'en';
        $store->lang_id = 19;
        $store->active_status = 1;
        $store->save();

        $store = new SmLanguage();
        $store->language_name = 'Bengali';
        $store->native = 'বাংলা';
        $store->language_universal = 'bn';
        $store->lang_id = 9;  
        $store->save();

        $store = new SmLanguage();
        $store->language_name = 'Spanish';
        $store->native = 'Español';
        $store->language_universal = 'es';
        $store->lang_id = 20; 
        $store->save();


        $store->save();
        $store = new SmLanguage();
        $store->language_name = 'French';
        $store->native = 'Français';
        $store->language_universal = 'fr';
        $store->lang_id = 28; 
        $store->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_languages');
    }
}
