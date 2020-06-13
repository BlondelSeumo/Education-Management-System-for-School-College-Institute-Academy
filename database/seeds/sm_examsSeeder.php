<?php

use App\SmExam;
use Illuminate\Database\Seeder;

class sm_examsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        SmExam::query()->truncate();

         DB::table('sm_exams')->insert([
             [
                 'exam_type_id' => 1,
                 'school_id' => 1,
                 'class_id' => 1,
                 'section_id' => 1,
                 'subject_id' => 1,
                 'exam_mark' => '100',

                 'active_status' => 1,

             ],
             [
                 'exam_type_id' => 2,
                 'school_id' => 1,
                 'class_id' => 1,
                 'section_id' => 1,
                 'subject_id' => 1,
                 'exam_mark' => '100',
                 'active_status' => 1,

             ],
             [
                 'exam_type_id' => 3,
                 'school_id' => 1,
                 'class_id' => 1,
                 'section_id' => 1,
                 'subject_id' => 1,
                 'exam_mark' => '100',
                 'active_status' => 1,

             ]
         ]);

    }
}
