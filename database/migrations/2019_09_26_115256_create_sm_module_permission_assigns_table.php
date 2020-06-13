<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SmModulePermissionAssign;

class CreateSmModulePermissionAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_module_permission_assigns', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();


            $table->integer('module_id')->nullable()->unsigned();
            $table->foreign('module_id')->references('id')->on('sm_module_permissions')->onDelete('restrict');
                     
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

                for($i = 1; $i <= 21; ++$i){

                    $assign = new SmModulePermissionAssign();
                    $assign->module_id = $i;
                    $assign->role_id = $j;
                    $assign->created_by = 1;
                    $assign->updated_by = 1;
                    $assign->save();

                }

            }

        }

        for($i = 22; $i <= 35; ++$i){

            $assign = new SmModulePermissionAssign();
            $assign->module_id = $i;
            $assign->role_id = 2;
            $assign->created_by = 1;
            $assign->updated_by = 1;
            $assign->save();

        }

        for($i = 36; $i <= 46; ++$i){

            $assign = new SmModulePermissionAssign();
            $assign->module_id = $i;
            $assign->role_id = 3;
            $assign->created_by = 1;
            $assign->updated_by = 1;
            $assign->save();

        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_module_permission_assigns');
    }
}
