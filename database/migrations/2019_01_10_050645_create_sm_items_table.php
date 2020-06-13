<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SmItem;
class CreateSmItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_name',100)->nullable();
            $table->float('total_in_stock')->nullable();
            $table->string('description',500)->nullable();
            $table->timestamps();

            $table->integer('category_name')->nullable()->unsigned();
            $table->foreign('category_name')->references('id')->on('sm_item_categories')->onDelete('restrict');   

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
        Schema::dropIfExists('sm_items');
    }
}
