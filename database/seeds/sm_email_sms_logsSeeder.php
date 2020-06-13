<?php

use App\SmEmailSmsLog;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class sm_email_sms_logsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        SmEmailSmsLog::query()->truncate();
        $faker = Faker::create();
        for ($i = 1; $i <= 10; $i++) {
            $s = new SmEmailSmsLog();
            $s->title = $faker->title;
            $s->description = $faker->text(200);
            $s->send_date = $faker->date($format = 'Y-m-d', $max = 'now');
            $s->send_through = 'E';
            $s->send_to = 'G';
        }
    }
}
