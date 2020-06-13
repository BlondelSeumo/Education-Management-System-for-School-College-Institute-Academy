<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmHrPayrollGeneratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_hr_payroll_generates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('basic_salary')->length(50)->nullable();
            $table->integer('total_earning')->length(50)->nullable();
            $table->integer('total_deduction')->length(50)->nullable();
            $table->integer('gross_salary')->length(50)->nullable();
            $table->integer('tax')->length(50)->nullable();
            $table->integer('net_salary')->length(50)->nullable();
            $table->string('payroll_month')->length(20)->nullable();
            $table->string('payroll_year')->length(20)->nullable();
            $table->string('payroll_status')->length(5)->nullable()->comment('NG for not generated, G for generated, P for paid');
            $table->string('payment_mode')->length(15)->nullable();
            $table->date('payment_date')->nullable();
            $table->string('note')->length(500)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();



            $table->integer('staff_id')->nullable()->unsigned();
            $table->foreign('staff_id')->references('id')->on('sm_staffs')->onDelete('restrict');


            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');
        });

       //  Schema::table('sm_hr_payroll_generates', function($table) {
       //     $table->foreign('staff_id')->references('id')->on('sm_staffs');
           
       // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_hr_payroll_generates');
    }
}
