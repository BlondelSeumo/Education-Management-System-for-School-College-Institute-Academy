<?php

use Illuminate\Database\Seeder;

class sm_student_categoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sm_student_categories')->insert([

            [
                'category_name'=> 'Normal', 
            ],     
            [
                'category_name'=> 'Obsessive Compulsive Disorder', 
            ],     
            [
                'category_name'=> 'Attention Deficit Hyperactivity Disorder (ADHD)', 
            ],     
            [
                'category_name'=> 'Oppositional Defiant Disorder (ODD)', 
            ], 
            [
                'category_name'=> 'Anxiety Disorder', 
            ], 
            [
                'category_name'=> 'Conduct Disorders', 
            ]
   
           ]);
    }
}
