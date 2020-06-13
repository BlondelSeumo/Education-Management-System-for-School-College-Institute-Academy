<?php

use App\SmDateFormat;
use Illuminate\Database\Seeder;

class sm_date_formatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


//        SmDateFormat::query()->truncate();

        // $data = [

        //     ['jS M, Y', '7th May, 2019'],
        //     ['MM/DD/YY', '02/17/2009'],
        //     ['DD/MM/YY', '17/02/2009'],
        //     ['Month D, Yr', 'February 17, 2009'],
        //     ['DDMonYY', '17Feb2009'],
        //     ['YYMonDD', '2009Feb17'],
        //     ['D Month, Yr', '17 February, 2009'],
        //     ['F j, Y, g:i a', 'May 7, 2019, 6:20 pm'],
        //     ['m.d.y', '02.05.19'],
        //     ['j, n, Y', '5, 2, 2019'],
        //     ['Ymd', '20190205'],
        //     ['h-i-s, j-m-y, it is w Day', '06-20-25, 5-02-10, 2028 2025 5 Fripm10'],
        //     ['it is the jS day', 'it is the 5th day'],
        //     ['D M j G:i:s T Y', 'Fri Feb 5 18:20:25 PST 2010'],
        //     ['H:m:s m is month', '18:02:25 m is month']
        // ];

        // foreach ($data as $dateFormate) {
        //     $store = new SmDateFormat();
        //     $store->format = $dateFormate[0];
        //     $store->normal_view = $dateFormate[1];
        //     $store->save();
        // }
    }
}
