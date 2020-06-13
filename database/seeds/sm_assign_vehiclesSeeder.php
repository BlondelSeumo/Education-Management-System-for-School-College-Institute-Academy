<?php

use App\SmAssignVehicle;
use App\SmStaff;
use Illuminate\Database\Seeder;

class sm_assign_vehiclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;
        $drivers = SmStaff::where('role_id', 9)->where('active_status', 1)->get();
        foreach ($drivers as $driver) {
            $store = new SmAssignVehicle();
            $store->route_id = $i;
            $store->vehicle_id = $i;
            $store->save();
            $i++;
        }
    }
}
