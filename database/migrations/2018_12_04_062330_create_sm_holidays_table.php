<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmHolidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_holidays', function (Blueprint $table) {
            $table->increments('id');
            $table->string('holiday_title',100)->nullable();
            $table->string('details',500)->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->string('upload_image_file',200)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();


            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');
        });

        // DB::table('sm_holidays')->insert([
        //     [
        //         'holiday_title'=>'Summer Vacation',
        //         'from_date'=>'2019-05-02',
        //         'to_date'=>'2019-05-08',
        //     ],
        //     [
        //         'holiday_title'=>'Public Holiday',
        //         'from_date'=>'2019-05-010',
        //         'to_date'=>'2019-05-11',
        //     ],
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_holidays');
    }
}
