<?php

use App\SmExpenseHead;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class sm_expense_headsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SmExpenseHead::query()->truncate();
        $faker = Faker::create();
        for ($i = 1; $i <= 10; $i++) {
            $store = new SmExpenseHead();
            $store->name = $faker->word;
            $store->description = $faker->realText($maxNbChars = 100, $indexSize = 1);
            $store->save();
        }
    }
}
