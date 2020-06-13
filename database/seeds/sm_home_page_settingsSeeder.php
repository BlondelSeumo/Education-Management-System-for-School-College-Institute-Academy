<?php

use App\SmHomePageSetting;
use Illuminate\Database\Seeder;

class sm_home_page_settingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        SmHomePageSetting::query()->truncate();

        $s = new SmHomePageSetting();
        $s->title = 'THE ULTIMATE EDUCATION ERP';
        $s->long_title = 'INFIX';
        $s->short_description = 'Managing various administrative tasks in one place is now quite easy and time savior with this INFIX and Give your valued time to your institute that will increase next generation productivity for our society.';
        $s->link_label = 'Learn More About Us';
        $s->link_url = 'http://infixedu.com/about';
        $s->image = 'public/backEnd/img/client/home-banner1.jpg';
        $s->save();
    }
}
