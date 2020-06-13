<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->string('message')->nullable();
            $table->tinyInteger('is_read')->default(0);
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();


            $table->integer('user_id')->default(1)->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('RESTRICT');

            $table->integer('role_id')->default(1)->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('RESTRICT');

            $table->integer('created_by')->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('RESTRICT');

            $table->integer('updated_by')->default(1)->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('RESTRICT');

            $table->integer('school_id')->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('RESTRICT');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_notifications');
    }
}
