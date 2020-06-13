<?php

use App\SmLeaveDefine;
use App\Role;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class sm_leave_definesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $roles = Role::where('active_status', '=', '1')->where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 10)->get();
        foreach ($roles as $key => $value) {
            $store= new SmLeaveDefine();
            $store->role_id= $value->id;
            $store->type_id=$faker->numberBetween(1,5);
            $store->days=$faker->numberBetween(1,10);
            $store->save();
        }
        /* for($i=1; $i<=5; $i++){
            $store= new SmLeaveDefine();
            $store->role_id=4;
            $store->type_id=$faker->numberBetween(1,5);
            $store->days=$faker->numberBetween(1,10);
            $store->save();
        } */
    }
}
