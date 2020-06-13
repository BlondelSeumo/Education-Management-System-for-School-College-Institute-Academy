<?php

use Illuminate\Database\Seeder;

class sm_leave_typesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sm_leave_types')->insert([
            [
               'type'=>'Casual Leave',
               'total_days'=>10,
               'active_status'=>1,
            ],  
            [
               'type'=>'Sick Leave',
               'total_days'=>14,
               'active_status'=>1,
            ], 
            [
               'type'=>'Annual/Vacation Leave',
               'total_days'=>10,
               'active_status'=>1,
            ],
            [
               'type'=>'Earned Leave',
               'total_days'=>10,
               'active_status'=>1,
            ], 
            [
               'type'=>'Public holidays',
               'total_days'=>20,
               'active_status'=>1,
            ],   
            [
               'type'=>'Maternity/Paternity',
               'total_days'=>7,
               'active_status'=>1,
            ], 
            [
               'type'=>'Administrative leave',
               'total_days'=>5,
               'active_status'=>1,
            ],  
        ]);
    }
}
