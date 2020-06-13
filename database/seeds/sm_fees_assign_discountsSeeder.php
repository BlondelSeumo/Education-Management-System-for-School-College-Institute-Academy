<?php

use App\SmFeesAssignDiscount;
use App\SmStudent;
use Illuminate\Database\Seeder;

class sm_fees_assign_discountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        SmFeesAssignDiscount::query()->truncate();
        $students = SmStudent::where('active_status', 1)->get();
        foreach ($students as $student) {
            $store = new SmFeesAssignDiscount();
            $store->fees_discount_id = 1;
            $store->student_id = $student->id;
            $store->save();
        }
    }
}
