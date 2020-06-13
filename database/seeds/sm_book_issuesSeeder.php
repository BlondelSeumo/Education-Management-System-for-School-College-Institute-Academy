<?php

use App\SmBookIssue;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\SmStudent;
use App\SmBook;

class sm_book_issuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // SmBookIssue::query()->truncate();
        $faker = Faker::create();
        $studentList = SmStudent::all();
        foreach ($studentList as $student) {
            $store = new SmBookIssue();
            $store->member_id = $student->id;
            $store->book_id = $faker->numberBetween(1, 11);
            $store->quantity = rand(1, 5);
            $store->given_date = $faker->dateTime()->format('Y-m-d');
            $store->due_date = $faker->dateTime()->format('Y-m-d');
            $store->issue_status = "I";
            $store->note = $faker->sentence($nbWords = 3, $variableNbWords = true);

            $store->save();
        }
    }
}
