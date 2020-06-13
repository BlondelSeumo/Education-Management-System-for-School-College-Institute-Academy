<?php

use App\SmClassTeacher;
use App\SmStaff;
use Illuminate\Database\Seeder;

class sm_class_teachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=10; $i++){
            $store= new SmClassTeacher();
            $store->assign_class_teacher_id=$i;
            $staffs=SmStaff::where('role_id',4)->get();
            foreach ($staffs as $staff)
            {
                $store->teacher_id=$staff->id;
            }
            $store->save();
        }
    }
}
