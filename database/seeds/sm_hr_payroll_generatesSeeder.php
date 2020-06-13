<?php

use App\SmHrPayrollGenerate;
use App\SmStaff;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class sm_hr_payroll_generatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $increment = 100;

        $staffs = SmStaff::where('active_status', 1)->where('role_id', 4)->get();
        foreach ($staffs as $staff) { 
        $store = new SmHrPayrollGenerate();
            $store->staff_id = $staff->id;
            $store->basic_salary = 3000 + $increment;
            $store->total_earning = 5000 + $increment;
            $store->total_deduction = 300 + $increment;
            $store->gross_salary = 4000 + $increment;
            $store->tax = $increment++;
            $store->net_salary = $store->basic_salary + $store->gross_salary - $store->total_deduction + $store->total_earning + $store->tax;
            $store->payroll_month = $faker->monthName($max = 'now');
            $store->payroll_year = $faker->year($max = 'now');
            $store->payroll_status = 'G';
            $store->payment_mode = 1;
            $store->note = $faker->realText($maxNbChars = 100, $indexSize = 1);
            $store->save();
        }
    }
}
