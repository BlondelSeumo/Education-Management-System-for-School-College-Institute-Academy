<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\SmHourlyRate;

class sm_hourly_ratesSeeder extends Seeder
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
            $store= new SmHourlyRate();
            $store->grade="A+";
            $store->rate=20;
            $store->save();

        }
    }
}
