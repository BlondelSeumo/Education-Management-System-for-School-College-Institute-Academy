<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\SmAddIncome;

class sm_add_incomesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SmAddIncome::query()->truncate();
        $faker = Faker::create();
        for ($i = 1; $i <= 3; $i++) {
            $store = new SmAddIncome();
            $store->name = 'Office Rent';
            $store->income_head_id = 1;
            $store->payment_method_id = 1;
            $store->date = '2019-0' . $i . '-05';
            $store->amount = 1300 + rand() % 10000;
            $store->save();

        }
    }
}
