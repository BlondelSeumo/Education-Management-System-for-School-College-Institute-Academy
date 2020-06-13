<?php

use App\SmAdmissionQuery;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class sm_admission_queriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        SmAdmissionQuery::query()->truncate();
        $faker = Faker::create();

        for ($i = 0; $i < 3; $i++) {
            $aq = new SmAdmissionQuery();
            $aq->name = $faker->name;
            $aq->phone = $faker->phoneNumber;
            $aq->email = $faker->email;
            $aq->address = $faker->address;
            $aq->description = $faker->sentence($nbWords = 3, $variableNbWords = true);
            $aq->date = $faker->dateTime()->format('Y-m-d');
            $aq->follow_up_date = $faker->dateTime()->format('Y-m-d');
            $aq->next_follow_up_date = $faker->dateTime()->format('Y-m-d');
            $aq->assigned = $faker->name;
            $aq->reference = rand(1, 5);
            $aq->source = rand(1, 5);
            $aq->class = rand(1, 9);
            $aq->no_of_child = rand(1, 4);
            $aq->save();
        }
    }
}
