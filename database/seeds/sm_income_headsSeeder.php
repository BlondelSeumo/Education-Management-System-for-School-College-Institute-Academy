<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\SmIncomeHead;

class sm_income_headsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SmIncomeHead::query()->truncate();
        $faker = Faker::create();
        for($i=1; $i<=10; $i++){
            $store= new SmIncomeHead();
            $store->name=$faker->word;
            $store->description=$faker->realText($maxNbChars = 200, $indexSize = 1);
            $store->save();

        }
    }
}
