<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\SmStudentGroup;

class sm_student_groupsSeeder extends Seeder
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
            $store= new SmStudentGroup();
            $store->group=$faker->word;
            $store->save();

        }
    }
}
