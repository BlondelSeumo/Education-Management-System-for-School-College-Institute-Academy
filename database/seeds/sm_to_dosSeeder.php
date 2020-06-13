<?php

use App\SmToDo;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class sm_to_dosSeeder extends Seeder
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
            $store= new SmToDo();
            $store->todo_title=$faker->realText($maxNbChars = 30, $indexSize = 1);
            $store->date=$faker->dateTime()->format('Y-m-d');
            $store->created_by=1;
            $store->save();
        }
    }
}
