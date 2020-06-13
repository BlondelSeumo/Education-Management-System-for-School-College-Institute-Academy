<?php

use Illuminate\Database\Seeder;
use App\SmItemStore;
class sm_item_storesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=5; $i++){
            $s = new SmItemStore();
            $s->store_name = 'Store '.$i;
            $s->store_no = 100*$i;
            $s->description = 'Store '.$i;
            $s->save();
        }
    }
}
