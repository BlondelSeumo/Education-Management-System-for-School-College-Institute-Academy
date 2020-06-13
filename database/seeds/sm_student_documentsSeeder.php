<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\SmStudent;
use App\SmStudentDocument;

class sm_student_documentsSeeder extends Seeder
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
        foreach($studentList as $student){
            $s = new SmStudentDocument();
            $s->title = $faker->sentence($nbWords =3, $variableNbWords = true);
            // $s->student_staff_id = $student->id;
            $s->student_staff_id = $faker->numberBetween(1, 100);
            $s->type = 'stu';
            $s->file = 'public/uploads/student/document/1.pdf';
            $s->active_status = 1;
            $s->school_id = 1;
            $s->save();
        }
    }
}
