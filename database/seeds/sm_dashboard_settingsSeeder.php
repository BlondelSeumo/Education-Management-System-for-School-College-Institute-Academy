<?php

use App\SmDashboardSetting;
use Illuminate\Database\Seeder;

class sm_dashboard_settingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SmDashboardSetting::query()->truncate();

    }
}
