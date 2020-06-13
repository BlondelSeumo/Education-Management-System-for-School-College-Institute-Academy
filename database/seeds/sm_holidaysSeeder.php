<?php

use App\SmHoliday;
use Illuminate\Database\Seeder;

class sm_holidaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SmHoliday::query()->truncate();

        DB::table('sm_holidays')->insert([
            [
                'holiday_title' => 'Winter Vacation',
                'from_date' => '2019-01-22',
                'to_date' => '2019-01-28',
            ],
            [
                'holiday_title' => 'Summer Vacation',
                'from_date' => '2019-05-02',
                'to_date' => '2019-05-08',
            ],
            [
                'holiday_title' => 'Public Holiday',
                'from_date' => '2019-05-10',
                'to_date' => '2019-05-11',
            ],
        ]);


    }
}
