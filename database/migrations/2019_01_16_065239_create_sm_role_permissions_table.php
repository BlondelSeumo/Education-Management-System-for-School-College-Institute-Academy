<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SmRolePermission;

class CreateSmRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_role_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();


            $table->integer('module_link_id')->nullable()->unsigned();
            $table->foreign('module_link_id')->references('id')->on('sm_module_links')->onDelete('restrict');

            $table->integer('role_id')->nullable()->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');

            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');
        });

        for($j = 1; $j <= 8; ++$j){

            if($j != 2 && $j != 3){

                for($i = 1; $i <= 396; ++$i){

                    if($i != 78 && $i != 212 && $i != 213){



                        $assign = new SmRolePermission();
                        $assign->module_link_id = $i;
                        $assign->role_id = $j;
                        $assign->created_by = 1;
                        $assign->updated_by = 1;
                        $assign->save();

                    }

                }

            }

        }



        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_role_permissions');
    }
}
