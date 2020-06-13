<?php

use App\SmPaymentMethhod;
use Illuminate\Database\Seeder;

class sm_payment_methhodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // SmPaymentMethhod::query()->truncate();

        // DB::table('sm_payment_methhods')->insert([
        //     [
        //         'method' => 'Cash',
        //         'type' => 'System'
        //     ],
        //     [
        //         'method' => 'Cheque',
        //         'type' => 'System'
        //     ],
        //     [
        //         'method' => 'Bank',
        //         'type' => 'System'
        //     ],
        //     [
        //         'method' => 'Paypal',
        //         'type' => 'System'
        //     ],
        //     [
        //         'method' => 'Stripe',
        //         'type' => 'System'
        //     ],
        //     [
        //         'method' => 'Paystack',
        //         'type' => 'System'
        //     ]
        // ]);
    }
}
