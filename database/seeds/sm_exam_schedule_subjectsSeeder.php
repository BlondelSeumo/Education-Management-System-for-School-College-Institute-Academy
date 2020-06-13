<?php
use App\SmExamScheduleSubject;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class sm_exam_schedule_subjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        SmExamScheduleSubject::query()->truncate();
//        $faker = Faker::create();
//        for($i=1; $i<=10; $i++){
//            $store= new SmExamScheduleSubject();
//            $store->exam_schedule_id=1;
//            $store->subject_id=$faker->numberBetween(1,4);
//            $store->date=$faker->dateTime()->format('Y-m-d');
//            $store->start_time=$faker->time($format = 'H:i A', $max = 'now');
//            $store->end_time=$faker->time($format = 'H:i A', $max = 'now');
//            $store->room= $i.'00'.$i;;
//            $store->full_mark=100;
//            $store->pass_mark=40;
//            $store->save();
//
//        }
    }
}
