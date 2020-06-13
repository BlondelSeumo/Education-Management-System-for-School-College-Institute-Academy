<?php

use Illuminate\Database\Seeder;
use App\SmItemCategory;

class sm_item_categoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $store = new SmItemCategory();
        $store->category_name = 'Raw Materials Inventory';
        $store->save();

        $store = new SmItemCategory();
        $store->category_name = 'Transit Inventory';
        $store->save();

        $store = new SmItemCategory();
        $store->category_name = 'Buffer Inventory';
        $store->save();

        $store = new SmItemCategory();
        $store->category_name = 'Application Inventory';
        $store->save();

        $store = new SmItemCategory();
        $store->category_name = 'Enterprice Inventory';
        $store->save();

        $store = new SmItemCategory();
        $store->category_name = 'Others Inventory';
        $store->save();
    }
}
