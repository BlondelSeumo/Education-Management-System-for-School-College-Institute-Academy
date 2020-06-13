<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmSmsGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_sms_gateways', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gateway_name', 255)->nullable();
            $table->string('clickatell_username', 255)->nullable();
            $table->string('clickatell_password', 255)->nullable();
            $table->string('clickatell_api_id', 255)->nullable();
            $table->string('twilio_account_sid', 255)->nullable();
            $table->string('twilio_authentication_token', 255)->nullable();
            $table->string('twilio_registered_no', 255)->nullable();
            $table->string('msg91_authentication_key_sid', 255)->nullable();
            $table->string('msg91_sender_id', 255)->nullable();
            $table->string('msg91_route', 255)->nullable();
            $table->string('msg91_country_code', 255)->nullable();
            $table->tinyInteger('active_status')->default(0);
            $table->timestamps();


            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');  
        });
        DB::table('sm_sms_gateways')->insert([
            [
                'gateway_name' => 'Clickatell',
                'clickatell_username'=>'demo1',
                'clickatell_password'=>'122334'
            ],
            [
                'gateway_name' => 'Twilio',
                'clickatell_username'=>'demo2',
                'clickatell_password'=>'12336'
            ],
            [
                'gateway_name' => 'Msg91',
                'clickatell_username'=>'demo3',
                'clickatell_password'=>'23445'
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
        Schema::dropIfExists('sm_sms_gateways');
    }
}
