<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateSmModulePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_module_permissions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('dashboard_id')->nullable();

            $table->string('name')->nullable();

            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');
            $table->timestamps();
        });


        $dashboards=['admin/staff Dashboard','Student dashboard','Parent Dashboard'];


        $modules=['Dashboard','Admin Section','Student Information','Teacher','Fees Collection','Accounts','Human resource','Leave Application','Examination','Academics','HomeWork','Communicate','Library','Inventory','Transport','Dormitory','Reports','System Settings','Common'];


         $sql = "INSERT INTO `sm_module_permissions` (`id`, `dashboard_id`, `name`, `active_status`, `created_by`, `updated_by`, `school_id`, `created_at`, `updated_at`) VALUES
        (1, 1, 'Dashboard', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (2, 1, 'Admin Section', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (3, 1, 'Student Information', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (4, 1, 'Teacher', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (5, 1, 'Fees Collection', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (6, 1, 'Accounts', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (7, 1, 'Human Resource', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (8, 1, 'Leave Application', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (9, 1, 'Examination', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (10, 1, 'Academics', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (11, 1, 'Homework', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (12, 1, 'Communicate', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (13, 1, 'Library', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (14, 1, 'Inventory', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (15, 1, 'Transport', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (16, 1, 'Dormitory', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (17, 1, 'Reports', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (18, 1, 'System Settings', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (19, 1, 'Style', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (20, 1, 'API Permission', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (21, 1, 'Front Settings', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),



        -- student panel 
        (22, 2, 'My Profile', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (23, 2, 'Fees', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (24, 2, 'Class Routine', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (25, 2, 'Homework', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (26, 2, 'Download Center', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (27, 2, 'Attendance', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (28, 2, 'Examinations', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (29, 2, 'Online Exam', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (30, 2, 'Notice Board', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (31, 2, 'Subjects', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (32, 2, 'Teacher', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (33, 2, 'Library', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (34, 2, 'Transfort', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (35, 2, 'Dormitory', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),



        -- parents panel 
        (36, 3, 'My Children', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (37, 3, 'Fees', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (38, 3, 'Class Routine', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (39, 3, 'Homework', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (40, 3, 'Attendance', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (41, 3, 'Exam Result', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (42, 3, 'Notice Board', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (43, 3, 'Subjects', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (44, 3, 'Teacher', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (45, 3, 'Transfort', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        (46, 3, 'Dormitory', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22')";

        DB::insert($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_module_permissions');
    }
}
