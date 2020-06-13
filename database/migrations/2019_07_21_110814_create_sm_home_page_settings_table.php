<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SmHomePageSetting;
class CreateSmHomePageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_home_page_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255)->nullable();
            $table->string('long_title',255)->nullable();
            $table->text('short_description')->nullable();
            $table->string('link_label',255)->nullable();
            $table->string('link_url',255)->nullable();
            $table->string('image',255)->nullable();
            $table->timestamps();
        });

        $s = new SmHomePageSetting();
        $s->title = 'THE ULTIMATE EDUCATION ERP';
        $s->long_title = 'INFIX';
        $s->short_description = 'Managing various administrative tasks in one place is now quite easy and time savior with this INFIX and Give your valued time to your institute that will increase next generation productivity for our society.';
        $s->link_label = 'Learn More About Us';
        $s->link_url = 'http://infixedu.com/about';
        $s->image = 'public/backEnd/img/client/home-banner1.jpg';
        $s->save();
    } 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_home_page_settings');
    }
}
