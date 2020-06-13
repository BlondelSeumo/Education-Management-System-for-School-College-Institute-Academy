<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmInventoryPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_inventory_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_receive_sell_id')->nullable()->unsigned();
            $table->date('payment_date')->nullable();
            $table->float('amount', 10, 2)->nullable();
            $table->string('reference_no', 50)->nullable();
            $table->string('payment_type')->length(11)->nullable()->comment('R for receive S for sell');
            $table->integer('payment_method')->nullable()->unsigned();
            $table->string('notes')->length(500)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();

            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

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
        Schema::dropIfExists('sm_inventory_payments');
    }
}
