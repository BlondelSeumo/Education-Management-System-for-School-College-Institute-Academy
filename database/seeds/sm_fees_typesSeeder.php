<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\SmFeesType;

class sm_fees_typesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        SmFeesType::query()->truncate();
        $array = ['Overheads/operating costs','Educational materials','The use of textbooks','Apps for e-learning','e-textbooks','Some extra-curricular activities','Laptop computer','Computer software','Uniforms for school and PE','Transportation to and from school','Lunch','Personal school supplies'];

        $faker = Faker::create();
        foreach ($array as $value) {
            $store= new SmFeesType();
            $store->name=$value;
            $store->code=$faker->ean8;
            $store->description=$faker->realText($maxNbChars = 200, $indexSize = 1);  
            $store->save();

        }
    }
}
