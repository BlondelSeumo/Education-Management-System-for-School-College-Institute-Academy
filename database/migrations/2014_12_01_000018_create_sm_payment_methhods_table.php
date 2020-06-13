<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmPaymentMethhodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_payment_methhods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('method', 255);
            $table->string('type')              ->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();

            $table->integer('gateway_id')->nullable()->unsigned();
            $table->foreign('gateway_id')->references('id')->on('sm_payment_gateway_settings')->onDelete('restrict');

            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');
        });

        
        DB::table('sm_payment_methhods')->insert([
            [
                'method' => 'Cash',
                'type' => 'System'
            ],
            [
                'method' => 'Cheque',
                'type' => 'System'
            ],
            [
                'method' => 'Bank',
                'type' => 'System'
            ],
            [
                'method' => 'Paypal',
                'type' => 'System'
            ],
            [
                'method' => 'Stripe',
                'type' => 'System'
            ],
            [
                'method' => 'Paystack',
                'type' => 'System'
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
        Schema::dropIfExists('sm_payment_methhods');
    }
}
