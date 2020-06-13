<?php

use App\SmAssignSubject;
use App\SmExamSetup;
use Illuminate\Database\Seeder;

class sm_exam_setupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = SmAssignSubject::all();
        foreach ($data as $row) {
            $class_id = $row->class_id;
            $section_id = $row->section_id;
            $subject_id = $row->subject_id;
            $s = new SmExamSetup();
            $s->class_id = $class_id;
            $s->section_id = $section_id;
            $s->subject_id = $subject_id;
            $s->exam_term_id = 1;
            $s->exam_title = 'Exam';
            $s->exam_mark = 100;
            $s->save();
        }

    }
}
