<?php

use App\SmFeesDiscount;
use Illuminate\Database\Seeder;

class sm_fees_discountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        SmFeesDiscount::query()->truncate();
        $store = new SmFeesDiscount();
        $store->name = 'Merit Scholarship';
        $store->code = 'SS-01';
        $store->type = 'year';
        $store->amount = 1000;
        $store->description = 'Merit Scholarship';
        $store->save();


        $store = new SmFeesDiscount();
        $store->name = 'Siblings Scholarship';
        $store->code = 'SB-01';
        $store->type = 'once';
        $store->amount = 1000;
        $store->description = 'Siblings Scholarship';
        $store->save();
    }
}
