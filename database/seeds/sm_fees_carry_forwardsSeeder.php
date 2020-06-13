<?php

use App\SmFeesCarryForward;
use App\SmStudent;
use Illuminate\Database\Seeder;

class sm_fees_carry_forwardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        SmFeesCarryForward::query()->truncate();
        $students = SmStudent::where('active_status', 1)->get();
        foreach ($students as $student){
            $store = new SmFeesCarryForward();
            $store->student_id = $student->id;
            $store->balance = rand(1000,5000);
            $store->save();
        }
    }
}
