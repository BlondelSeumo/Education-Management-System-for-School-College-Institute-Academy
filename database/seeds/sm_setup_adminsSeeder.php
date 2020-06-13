<?php

use Illuminate\Database\Seeder;
use App\SmSetupAdmin;

class sm_setup_adminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
  
        $dataArr= [
            [1, 3, 'Newspaper', 'Inform from Newspaper'],
            [2, 3, 'Online Marketing', 'Inform From Online Marketing'],
            [3, 3, 'Facebook', 'Inform From Facebook'],
            [4, 1, 'Admission', 'Admission Test'],
            [5, 1, 'Transfer Certificate', 'Transfer Certificate'],
            [6, 1, 'Re-Admission', 'Re-Admission'],
            [7, 1, 'Confirmation Inquiry', 'You give students a question, its answer and the method of reaching this answer. Their goal is to build investigation and critical-thinking skills, learning how the specific method works.'],
            [8, 1, 'Structured Inquiry', 'You give students an open question and an investigation method. They must use the method to craft an evidence-backed conclusion.'],
            [9, 1, 'Guided Inquiry', 'You give students an open question. Typically in groups, they design investigation methods to reach a conclusion.'],
            [10, 1, 'Open Inquiry', 'You give students time and support. They pose original questions that they investigate through their own methods, and eventually present their results to discuss and expand.'],
            [11, 2, 'General complaint', 'A student may submit a complaint regarding staff, faculty, or other student. Complainant must submit their concern via the preliminary complaint form.'],
            [12, 2, 'ADA grievance/accommodation', 'ADA grievance/accommodation'],
            [13, 2, 'Academic Misconduct allegation', 'A student should be informed of any academic misconduct allegation by their instructor.'],
            [14, 2, 'Sexual Assault', 'Sexual harassment is a serious problem for students at all educational levels.'],
            [15, 2, 'Domestic and Interpersonal Violence', 'Domestic and Interpersonal Violence'],
            [16, 2, 'Sexual Harassment, and Other Discrimination', 'Sexual Harassment, and Other Discrimination'],
            [17, 2, 'Appeals regarding grades and student conduct', 'A student may only appeal a capricious grade, or student conduct expulsion or suspension.'],
            [18, 4, 'Teacher', 'Reference by teacher'],
            [19, 4, 'Student', 'Student'],
            [20, 4, 'Institution Committee', 'Institution Committee']
        ];
        foreach ($dataArr as $data) { 
            $store = new SmSetupAdmin();
            $store->id                  =  $data[0];
            $store->type                =  $data[1];
            $store->name                =  $data[2];
            $store->description         =  $data[3]; 
            $store->save();
        }



    }
}
