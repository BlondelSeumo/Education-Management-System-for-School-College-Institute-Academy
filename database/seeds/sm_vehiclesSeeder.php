<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;
use App\SmParent;
use App\GlobalVariable;
use Faker\Factory as Faker;
use App\SmVehicle;
use App\SmStaff;

class sm_vehiclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $drivers = SmStaff::where('role_id',9)->where('active_status',1)->get();
        foreach ($drivers as $driver) { 
            $s = new SmVehicle();
            $s->vehicle_no ='INFIX-'.$driver->id*100;
            $s->vehicle_model ='INFIX-M'.$driver->id*100;
            $s->made_year =date('Y');
            $s->driver_id =$driver->id;
            $s->note =$faker->sentence($nbWords =6, $variableNbWords = true);
            $s->save();
        }
    }
}
