<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SmGeneralSettings;
class CreateSmGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_general_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('school_name')           ->nullable();
            $table->string('site_title')            ->nullable();
            $table->string('school_code')           ->nullable();
            $table->string('address')               ->nullable();
            $table->string('phone')                 ->nullable();
            $table->string('email')                 ->nullable();
            $table->string('currency')              ->nullable()->default('USD');
            $table->string('currency_symbol')       ->nullable()->default('$');
            $table->string('logo')                  ->nullable(); 
            $table->string('favicon')               ->nullable(); 
            $table->string('system_version')        ->nullable()->default('1.0');
            $table->integer('active_status')        ->nullable()->default(1);
            $table->string('currency_code')         ->nullable()->default('USD');
            $table->string('language_name')         ->nullable()->default('en');
            $table->string('session_year')          ->nullable()->default('2019');
            $table->string('system_purchase_code')  ->nullable();
            $table->date('system_activated_date')   ->nullable();
            $table->string('envato_user')           ->nullable();
            $table->string('envato_item_id')        ->nullable(); 
            $table->string('system_domain')         ->nullable();
            $table->string('copyright_text')        ->nullable();
            $table->integer('api_url')        ->default(1);
            $table->integer('ttl_rtl')        ->default(2);
            $table->timestamps();


            $table->integer('time_zone_id')->nullable();


            $table->integer('session_id')->nullable()->unsigned();
            $table->foreign('session_id')->references('id')->on('sm_academic_years')->onDelete('restrict');

            $table->integer('language_id')->nullable()->default(1)->unsigned();
            $table->foreign('language_id')->references('id')->on('sm_languages')->onDelete('restrict');

            $table->integer('date_format_id')->nullable()->default(1)->unsigned();
            $table->foreign('date_format_id')->references('id')->on('sm_date_formats')->onDelete('restrict');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');  
        });
 
         DB::table('sm_general_settings')->insert([ 
          [
              'copyright_text'=>'Copyright &copy; 2019 All rights reserved | This template is made with <span class="ti-heart"> </span> by Codethemes',
              'logo'=>'public/uploads/settings/logo.png',
              'favicon'=>'public/uploads/settings/favicon.png',
              'currency'=>'USD',
              'school_name'=>'Infix Edu',
              'site_title'=>'Infix Edu',
              'time_zone_id'=>51 
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
        Schema::dropIfExists('sm_general_settings');
    }
}
