<?php

use App\SmFeesMaster;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class sm_fees_mastersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(); 
        for($fees_group_id=1; $fees_group_id<=6; $fees_group_id++){
            for($fees_type_id=1; $fees_type_id<=$fees_group_id; $fees_type_id++){
                $store= new SmFeesMaster();
                $store->fees_group_id=$fees_group_id;
                $store->fees_type_id=$fees_type_id;
                $store->date=date('Y-m-d');
                $store->amount=1000+rand()%1000;
                $store->save();
            } 
        }
    }
}
