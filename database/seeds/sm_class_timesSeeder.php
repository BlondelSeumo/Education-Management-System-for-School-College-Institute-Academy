<?php

use App\SmClassTime;
use Illuminate\Database\Seeder;

class sm_class_timesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        SmClassTime::query()->truncate();
        DB::table('sm_class_times')->insert([
            [
                'type' => 'class',
                'period' => '1st class',
                'start_time' => '09:00:00',
                'end_time' => '09:45:00',
                'is_break' => 0,
            ],   

            [
                'type' => 'class',
                'period' => '2nd class',
                'start_time' => '09:45:00',
                'end_time' => '10:30:00',
                'is_break' => 0,
            ], 

            [
                'type' => 'class',
                'period' => '3rd class',
                'start_time' => '10:30:00',
                'end_time' => '11:15:00',
                'is_break' => 0,
            ], 

            [
                'type' => 'class',
                'period' => '4th class',
                'start_time' => '11:15:00',
                'end_time' => '12:00:00',
                'is_break' => 0,
            ], 
            [
                'type' => 'class',
                'period' => '5th class',
                'start_time' => '12:00:00',
                'end_time' => '12:45:00',
                'is_break' => 0,
            ],  
            [
                'type' => 'class',
                'period' => 'Tiffin Break',
                'start_time' => '12:45:00',
                'end_time' => '14:00:00',
                'is_break' => 1,
            ], 
            [
                'type' => 'class',
                'period' => '6th class',
                'start_time' => '14:45:00',
                'end_time' => '15:39:00',
                'is_break' => 0,
            ], 


            [
                'type' => 'exam',
                'period' => '1st period',
                'start_time' => '09:00:00',
                'end_time' => '12:00:00',
                'is_break' => 0,
            ], 
            [
                'type' => 'exam',
                'period' => '2nd period',
                'start_time' => '01:00:00',
                'end_time' => '03:00:00',
                'is_break' => 0,
            ], 
            [
                'type' => 'exam',
                'period' => '3rd period',
                'start_time' => '04:00:00',
                'end_time' => '06:00:00',
                'is_break' => 0,
            ]
        ]);
    }
}
