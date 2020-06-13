<?php

use App\SmAcademicYear;
use Illuminate\Database\Seeder;

class sm_academic_yearsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SmAcademicYear::query()->truncate();

        for($year = date('Y'); $year<=date('Y')+5; $year++){
            $starting_date = $year.'-01-01';
            $ending_date = $year.'-12-31';
            $s = new SmAcademicYear();
            $s->year = $year;
            $s->title = 'Academic Year '.$year;
            $s->starting_date = $starting_date;
            $s->ending_date = $ending_date;
            $s->save();
        }
    }
}
