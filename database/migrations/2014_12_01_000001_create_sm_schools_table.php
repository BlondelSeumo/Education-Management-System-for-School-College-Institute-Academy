<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('school_name',200)->nullable();
            $table->tinyInteger('created_by')->default(1);
            $table->tinyInteger('updated_by')->default(1);
            $table->timestamps();
        });

        DB::table('sm_schools')->insert([
                [
                    'school_name' => 'InfixEdu',
                    'created_by' => 1,
                    'updated_by' => 1,
                ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_schools');
    }
}
