<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('staff_no')->nullable();
            $table->string('first_name',100)->nullable();
            $table->string('last_name',100)->nullable();
            $table->string('full_name',200)->nullable();
            $table->string('fathers_name',100)->nullable();
            $table->string('mothers_name',100)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->string('email',50)->nullable();
            $table->string('mobile',50)->nullable();
            $table->string('emergency_mobile',50)->nullable();
            $table->string('marital_status',30)->nullable();
            $table->string('merital_status',30)->nullable();
            $table->string('staff_photo')->nullable();
            $table->string('current_address',500)->nullable();
            $table->string('permanent_address',500)->nullable();
            $table->string('qualification',200)->nullable();
            $table->string('experience',200)->nullable();
            $table->string('epf_no',20)->nullable();
            $table->string('basic_salary',200)->nullable();
            $table->string('contract_type',200)->nullable();
            $table->string('location',50)->nullable();
            $table->string('casual_leave',15)->nullable();
            $table->string('medical_leave',15)->nullable();
            $table->string('metarnity_leave',15)->nullable();
            $table->string('bank_account_name',50)->nullable();
            $table->string('bank_account_no',50)->nullable();
            $table->string('bank_name',20)->nullable();
            $table->string('bank_brach',30)->nullable();
            $table->string('facebook_url',100)->nullable();
            $table->string('twiteer_url',100)->nullable();
            $table->string('linkedin_url',100)->nullable();
            $table->string('instragram_url',100)->nullable();
            $table->string('joining_letter',500)->nullable();
            $table->string('resume',500)->nullable();
            $table->string('other_document',500)->nullable(); 
            $table->string('notes',500)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->string('driving_license',255)->nullable();
            $table->date('driving_license_ex_date')->nullable();
            $table->timestamps();


            $table->integer('designation_id')->nullable()->unsigned();
            $table->foreign('designation_id')->references('id')->on('sm_designations')->onDelete('restrict');

            $table->integer('department_id')->nullable()->unsigned();
            $table->foreign('department_id')->references('id')->on('sm_human_departments')->onDelete('restrict');

            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');

            $table->integer('role_id')->nullable()->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');

            $table->integer('gender_id')->nullable()->unsigned();
            $table->foreign('gender_id')->references('id')->on('sm_base_setups')->onDelete('restrict');


            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');

        }); 


        DB::table('sm_staffs')->insert([ 
            [
                'user_id'          =>1,
                'role_id'          =>1,
                'staff_no'         =>1, 
                'designation_id'   =>1, 
                'department_id'    =>1, 
                'first_name'       =>'Super', 
                'last_name'        =>'Admin', 
                'full_name'        =>'Super Admin',  
                'date_of_birth'    =>date('Y-m-d'), 
                'date_of_joining'  =>date('Y-m-d'),   
                'gender_id'        =>1, 
                'email'            =>'admin@infixedu.com', 
                'mobile'           =>'123456789', 
                'emergency_mobile' =>'1234567890', 
                'marital_status'   =>'Married', 
                'staff_photo'      =>'public/uploads/staff/staff.jpg',
                'qualification'    =>'B.Sc in Computer Science', 
                'experience'       =>'4 Years', 
                'basic_salary'     =>45000,
                'casual_leave'     =>'12',
                'medical_leave'    =>'15', 
                'metarnity_leave'  =>'45',  
                'driving_license'  =>'56776987453', 
                'driving_license_ex_date'=>date('Y-m-d'), 
            ]   
           ]);


 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_staffs');
    }
}
