<?php

use App\SmAssignSubject;
use App\SmQuestionGroup;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\SmQuestionBank;

class sm_question_banksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $i = 1;
        $question_details = SmAssignSubject::all();
        foreach ($question_details as $question_detail) {

            $store = new SmQuestionBank();
            $store->q_group_id = 1;
            $store->class_id = $question_detail->class_id;
            $store->section_id = $question_detail->section_id;
            $store->type = 'M';
            $store->question = $faker->realText($maxNbChars = 80, $indexSize = 1);
            $store->marks = 100;
            $store->trueFalse = 'T';
            $store->suitable_words = $faker->realText($maxNbChars = 50, $indexSize = 1);
            $store->number_of_option = 4;
            $store->save();
        }
    }
}
