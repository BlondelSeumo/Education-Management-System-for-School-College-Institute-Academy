<?php

use App\SmAssignSubject;
use App\SmClass;
use App\SmClassSection;
use App\SmExamSchedule;
use App\SmSection;
use Illuminate\Database\Seeder;

class sm_exam_schedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        SmExamSchedule::query()->truncate();

        $classes = SmClass::where('active_status',1)->get();
        foreach ($classes as $class) {
            $sections = SmClassSection::where('class_id', $class->class_id)->get();
            foreach ($sections as $section) {
                $subjects = SmAssignSubject::where('class_id', $class->class_id)->where('section_id', $section->section_id)->get();
                foreach ($subjects as $subject) {
                    $s = new SmExamSchedule();
                    $s->class_id = $class->class_id;
                    $s->section_id = $section->section_id;
                    $s->subject_id = $subject->subject_id;
                    $s->exam_term_id = 1;
                    $s->exam_id = 1;
                    $s->exam_period_id = $section->section_id;
                    $s->save();
                }


            }
        }
    }
}
