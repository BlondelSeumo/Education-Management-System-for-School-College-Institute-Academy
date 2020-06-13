<?php

<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes
use App\SmQuestionBankMuOption;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class sm_question_bank_mu_optionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=1; $i<=5; $i++){
            $store= new SmQuestionBankMuOption();
            $store->question_bank_id=$i;
            $store->title=$faker->realText($maxNbChars = 30, $indexSize = 1);
            $store->status=1;
            $store->created_by=1;
            $store->save();
        }
    }
}
