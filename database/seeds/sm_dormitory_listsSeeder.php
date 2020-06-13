<?php

use App\SmDormitoryList;
use Illuminate\Database\Seeder;

class sm_dormitory_listsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


//    SmDormitoryList::query()->truncate();

        $dormitory = [
            'Sir Isaac Newton Hostel',
            'Louis Pasteur Hostel',
            'Galileo Hostel',
            'Marie Curie Hostel',
            'Albert Einstein Hostel',
            'Charles Darwin Hostel',
            'Nikola Tesla Hostel'
        ];


        foreach ($dormitory as $data) {
            DB::table('sm_dormitory_lists')->insert([
                [
                    'dormitory_name'=>$data,
                    'type'=>'B',
                    'address'=>'25/13, Sukrabad Rd, Tallahbag, Dhaka 1215',
                    'intake'=>120,
                    'description'=>'Hostels provide lower-priced, sociable accommodation where guests can rent a bed, usually a bunk bed, in a dormitory and share a bathroom, lounge and sometimes a kitchen.',
                ]
            ]);
        }


    }
}
