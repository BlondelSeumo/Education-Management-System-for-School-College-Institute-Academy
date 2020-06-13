<?php

use Illuminate\Database\Seeder;
use App\SmItem;

class sm_itemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=5; $i++){
            $s = new SmItem();
            $s->item_name = 'Item name '.$i;
            $s->category_name =$i;
            $s->total_in_stock = 23*$i;
            $s->save();
        }
    }
}
