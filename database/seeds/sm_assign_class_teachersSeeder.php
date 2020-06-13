<?php

use App\SmAssignClassTeacher;
use App\SmClassTeacher;
use App\SmStaff;
use App\SmClass;
use App\SmSection;
use Illuminate\Database\Seeder;

class sm_assign_class_teachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
        for ($class_id = 1; $class_id <= 3; $class_id++) {
            for ($section_id = 1; $section_id <= 5; $section_id++) {
                $store = new SmAssignClassTeacher();
                $store->class_id = $class_id;
                $store->section_id = $section_id;
                $store->save();
                

            }
        }

        //$assign_class_teachers = SmAssignClassTeacher::all();
        // foreach ($assign_class_teachers as $row) {
            for ($i = 1; $i <= 3; $i++) {
                $class_teacher = new SmClassTeacher();
                $class_teacher->assign_class_teacher_id = $i;
                $class_teacher->teacher_id = rand(2,3);
                $class_teacher->save();
            }

        // }

       


    }
}
