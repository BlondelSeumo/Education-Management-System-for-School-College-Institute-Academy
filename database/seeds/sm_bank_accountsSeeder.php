<?php

use Illuminate\Database\Seeder;
use App\SmBankAccount;
use Faker\Factory as Faker;

class sm_bank_accountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=1; $i<=3; $i++){
            $store= new SmBankAccount();
            $store->account_name=$faker->name;
            $store->opening_balance=2000;
            $store->note=$faker->realText($maxNbChars = 100, $indexSize = 1);
            $store->created_by=1;
            $store->save();

        }
    }
}
