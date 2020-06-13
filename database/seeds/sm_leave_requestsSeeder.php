<?php

use App\SmLeaveRequest;
use App\SmStaff;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class sm_leave_requestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $faker = Faker::create();
//        $staffs = SmStaff::where('role_id', 4)->get();
//        foreach ($staffs as $staff) {
//
//            $store = new SmLeaveRequest();
//            $store->type_id = 1;
//            $store->leave_define_id = 1;
//            $store->staff_id = $staff->id;
//            $store->role_id = 4;
//            $store->apply_date = $faker->dateTime()->format('Y-m-d');
//            $store->leave_from = $faker->dateTime()->format('Y-m-d');
//            $store->leave_to = $faker->dateTime()->format('Y-m-d');;
//            $store->reason = $faker->realText($maxNbChars = 100, $indexSize = 2);
//            $store->note = $faker->realText($maxNbChars = 50, $indexSize = 2);
//            $store->file = "public/uploads/leave_request/sample.pdf";
//            $store->approve_status = "P";
//            $store->save();
//        }
    }
}
