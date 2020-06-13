<?php

use Illuminate\Database\Seeder;
use App\SmSection;

class sm_sectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // SmSection::query()->truncate();

        DB::table('sm_sections')->insert([

         [
             'section_name'=>'A', 
         ], 

         [
             'section_name'=>'B', 
         ], 

         [
             'section_name'=>'C', 
         ], 

         [
             'section_name'=>'D', 
         ], 
         [
             'section_name'=>'E', 
         ], 


        ]);
    }
}
