<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\SmAddExpense;

class sm_add_expensesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 1; $i <= 9; $i++) {
            $store = new SmAddExpense();
            $store->name = 'Utility Bills';
            $store->expense_head_id = 4;
            $store->payment_method_id = 1;
            $store->date = '2019-0' . $i . '-05';
            $store->amount = 1200 + rand() % 10000;
            $store->description = 'Sample Data ' . $i;
            $store->save();
        }

    }
}
