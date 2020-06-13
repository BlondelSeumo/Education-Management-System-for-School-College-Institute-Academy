<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmHrSalaryTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_hr_salary_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('salary_grades',50)->nullable();
            $table->string('salary_basic',50)->nullable();
            $table->string('overtime_rate',50)->nullable();
            $table->integer('house_rent')->length(50)->nullable();
            $table->integer('provident_fund')->length(50)->nullable();
            $table->integer('gross_salary')->length(50)->nullable();
            $table->integer('total_deduction')->length(50)->nullable();
            $table->integer('net_salary')->length(50)->nullable();
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
        Schema::dropIfExists('sm_hr_salary_templates');
    }
}
