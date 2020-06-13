<?php

use App\SmClassRoom;
use Illuminate\Database\Seeder;

class sm_class_roomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        SmClassRoom::query()->truncate();
        DB::table('sm_class_rooms')->insert([
            [
                'room_no' => 'Room 101',
                'capacity' => 60,

            ],
            [
                'room_no' => 'Room 102',
                'capacity' => 55,

            ],
            [
                'room_no' => 'Room 103',
                'capacity' => 55,

            ],
            [
                'room_no' => 'Room 104',
                'capacity' => 60,

            ],

            [
                'room_no' => 'Room 201',
                'capacity' => 60,

            ],
            [
                'room_no' => 'Room 202',
                'capacity' => 55,

            ],
            [
                'room_no' => 'Room 203',
                'capacity' => 55,

            ],
            [
                'room_no' => 'Room 204',
                'capacity' => 60,

            ],

        ]);

    }
}
