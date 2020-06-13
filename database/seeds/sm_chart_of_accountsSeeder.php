<?php

use Illuminate\Database\Seeder;
use App\SmChartOfAccount;
class sm_chart_of_accountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // SmChartOfAccount::query()->truncate();
        $store = new SmChartOfAccount();
        $store->head = 'Donation';
        $store->type = 'I';
        $store->save();

        $store = new SmChartOfAccount();
        $store->head = 'Scholarship';
        $store->type = 'E';
        $store->save();

        $store = new SmChartOfAccount();
        $store->head = 'Product Sales';
        $store->type = 'I';
        $store->save();

        $store = new SmChartOfAccount();
        $store->head = 'Utility Bills';
        $store->type = 'E';
        $store->save();
    }
}
