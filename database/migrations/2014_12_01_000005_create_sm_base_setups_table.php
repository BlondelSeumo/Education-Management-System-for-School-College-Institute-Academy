<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmBaseSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_base_setups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('base_setup_name', 100);
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps(); 
            
			$table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('updated_by')->nullable()->default(1)->unsigned();
			$table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');
			
            $table->integer('base_group_id')->nullable()->default(1)->unsigned();
            $table->foreign('base_group_id')->references('id')->on('sm_base_groups')->onDelete('restrict');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');
        });



        DB::table('sm_base_setups')->insert([
        	[
        		'base_group_id'=>1,
        		'base_setup_name'=>'Male',
        	],
        	[
        		'base_group_id'=>1,
        		'base_setup_name'=>'Female',
        	],
        	[
        		'base_group_id'=>1,
        		'base_setup_name'=>'Others',
        	],


        	[
        		'base_group_id'=>2,
        		'base_setup_name'=>'Islam',
        	],
        	[
        		'base_group_id'=>2,
        		'base_setup_name'=>'Hinduism',
        	],
        	[
        		'base_group_id'=>2,
        		'base_setup_name'=>'Sikhism',
        	],
        	[
        		'base_group_id'=>2,
        		'base_setup_name'=>'Buddhism',
        	],
        	[
        		'base_group_id'=>2,
        		'base_setup_name'=>'Protestantism',
        	],

        	[
        		'base_group_id'=>3,
        		'base_setup_name'=>'A+',
        	],
        	[
        		'base_group_id'=>3,
        		'base_setup_name'=>'O+',
        	],
        	[
        		'base_group_id'=>3,
        		'base_setup_name'=>'B+',
        	],
        	[
        		'base_group_id'=>3,
        		'base_setup_name'=>'AB+',
        	],
        	[
        		'base_group_id'=>3,
        		'base_setup_name'=>'A-',
        	],
        	[
        		'base_group_id'=>3,
        		'base_setup_name'=>'O-',
        	],
        	[
        		'base_group_id'=>3,
        		'base_setup_name'=>'B-',
        	],
        	[
        		'base_group_id'=>3,
        		'base_setup_name'=>'AB-',
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
        Schema::dropIfExists('sm_base_setups');
    }
}
