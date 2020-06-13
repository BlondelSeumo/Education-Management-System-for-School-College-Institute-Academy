<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmBackgroundSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_background_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255)->nullable();
            $table->string('type',255)->nullable();
            $table->string('image',255)->nullable();
            $table->string('color',255)->nullable();
            $table->integer('is_default')->default(0);
            $table->timestamps();
        });

        
        DB::table('sm_background_settings')->insert([
            [   
                'id'            => 1,
                'title'         => 'Dashboard Background',
                'type'          => 'image',
                'image'         => 'public/backEnd/img/body-bg.jpg',
                'color'         => '',
                'is_default'    => 1,

            ],

            [ 
                'id'            => 2,
                'title'         => 'Login Background',
                'type'          => 'image',
                'image'         => 'public/backEnd/img/login-bg.jpg',
                'color'         => '',
                'is_default'    => 0,

            ],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_background_settings');
    }
}
