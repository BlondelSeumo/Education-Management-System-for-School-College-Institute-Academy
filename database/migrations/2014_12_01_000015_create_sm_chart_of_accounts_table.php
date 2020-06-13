<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SmChartOfAccount;
class CreateSmChartOfAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_chart_of_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('head', 50)->nullable();
            $table->string('type', 1)->nullable()->comment('E = expense, I = income');
            $table->integer('active_status')->nullable()->default(1);
            $table->timestamps();

            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');
        });

        // $store = new SmChartOfAccount();
        // $store->head = 'Donation';
        // $store->type = 'I';
        // $store->save();

        // $store = new SmChartOfAccount();
        // $store->head = 'Scholarship';
        // $store->type = 'E';
        // $store->save();

        // $store = new SmChartOfAccount();
        // $store->head = 'Product Sales';
        // $store->type = 'I';
        // $store->save();

        // $store = new SmChartOfAccount();
        // $store->head = 'Utility Bills';
        // $store->type = 'E';
        // $store->save();



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_chart_of_accounts');
    }
}
