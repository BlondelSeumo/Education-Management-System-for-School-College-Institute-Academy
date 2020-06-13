<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmItemIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_item_issues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('issue_to')->nullable()->unsigned();
            $table->integer('issue_by')->nullable()->unsigned();
            $table->date('issue_date')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('quantity')->nullable()->unsigned();
            $table->string('issue_status')->nullable();
            $table->string('note',500)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();
            
            $table->integer('role_id')->nullable()->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');
            
            $table->integer('item_category_id')->nullable()->unsigned();
            $table->foreign('item_category_id')->references('id')->on('sm_item_categories')->onDelete('restrict');

            $table->integer('item_id')->nullable()->unsigned();
            $table->foreign('item_id')->references('id')->on('sm_items')->onDelete('restrict');

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
        Schema::dropIfExists('sm_item_issues');
    }
}
