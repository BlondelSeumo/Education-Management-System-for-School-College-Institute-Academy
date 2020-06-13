<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SmSystemVersion;
class CreateSmSystemVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_system_versions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('version_name', 255);
            $table->string('title', 255);
            $table->string('features', 255);
            $table->timestamps();
        });

        $s = new SmSystemVersion();
        $s->version_name = '3.2';
        $s->title = 'Upgrade System Integration';
        $s->features = 'features 1, features 2';
        $s->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_system_versions');
    }
}
