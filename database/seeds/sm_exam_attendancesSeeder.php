<?php

use App\SmExamAttendance;
use Illuminate\Database\Seeder;

class sm_exam_attendancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        SmExamAttendance::query()->truncate();
        for($i=1; $i<=3; $i++){
            $store= new SmExamAttendance();
            $store->exam_id=$i;
            $store->subject_id=$i;
            $store->class_id=$i;
            $store->section_id=1;
            $store->created_by=1;
            $store->save();
        }
    }
}
