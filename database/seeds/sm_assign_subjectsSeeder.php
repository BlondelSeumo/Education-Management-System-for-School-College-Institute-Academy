<?php

use App\SmAssignSubject;
use App\SmClass;
use App\SmClassSection;
use App\SmStaff;
use Illuminate\Database\Seeder;

class sm_assign_subjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        SmAssignSubject::query()->truncate();
        $teacher = SmStaff::where('role_id', 4)->first();
        $data = SmClassSection::all();
        $subject_id = [1, 2, 3];
        foreach ($data as $datum) {
            $class_id = $datum->class_id;
            $section_id = $datum->section_id;
            foreach ($subject_id as $subject) {

                DB::table('sm_assign_subjects')->insert([
                    [
                        'class_id' => $class_id,
                        'section_id' => $section_id,
                        'teacher_id' => $teacher->id,
                        'subject_id' => $subject,
                    ]
                ]);
            }
        }

    }
}
