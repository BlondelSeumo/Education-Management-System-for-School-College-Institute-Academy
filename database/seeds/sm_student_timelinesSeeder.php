<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\SmStudent;
use App\SmStudentTimeline;

class sm_student_timelinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $studentList = SmStudent::all();
        foreach ($studentList as $student) {
            $st = new SmStudentTimeline();
            $st->staff_student_id = $student->id;
            $st->title = $faker->sentence($nbWords = 3, $variableNbWords = true);
            $st->date = $faker->dateTime()->format('Y-m-d');
            $st->description = $faker->sentence($nbWords = 3, $variableNbWords = true);
            $st->file = 'public/uploads/student/timeline/1.pdf';
            $st->type = 'stu';
            $st->visible_to_student = 1;
            $st->active_status = 1;
            $st->save();
        }
    }
}
