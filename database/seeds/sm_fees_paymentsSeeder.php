<?php

use App\SmFeesPayment;
use App\SmFeesType;
use App\SmStudent;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class sm_fees_paymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = SmStudent::where('active_status', 1)->get();
        foreach ($students as $student) {
            $fees_types = SmFeesType::where('active_status', 1)->get();
            foreach ($fees_types as $fees_type) {
                $store = new SmFeesPayment();
                $store->student_id = $student->id;
                $store->fees_type_id = $fees_type->id;
                $store->fees_discount_id = 1;
                $store->discount_month = date('m');
                $store->discount_amount = 100;
                $store->fine = 50;
                $store->amount = 250;
                $store->payment_mode = "C";
                $store->save();

            }
        }
    }
}
