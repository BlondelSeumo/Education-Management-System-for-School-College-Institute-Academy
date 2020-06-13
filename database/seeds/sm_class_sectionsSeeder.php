<?php

use Illuminate\Database\Seeder;
use App\SmClassSection;

class sm_class_sectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SmClassSection::query()->truncate(); 
        
        for($class_id=1; $class_id<=5; $class_id++){
            for($section_id=1; $section_id<=5; $section_id++){
                $s= new SmClassSection();
                $s->class_id = $class_id;
                $s->section_id = $section_id;
                $s->save();
            }
        }
    }
}
