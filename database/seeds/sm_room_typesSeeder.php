<?php

use App\SmRoomType;
use Illuminate\Database\Seeder;

class sm_room_typesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data =[
            ['Single','A room assigned to one person. May have one or more beds.'],
            ['Double','A room assigned to two people. May have one or more beds.'],
            ['Triple','A room assigned to three people. May have two or more beds'],
            ['Quad','A room assigned to four people. May have two or more beds.'],
            ['Queen','A room with a queen-sized bed. May be occupied by one or more people'],
            ['King','A room with a king-sized bed. May be occupied by one or more people.']
        ];

        foreach ($data as $row) {
            $store = new SmRoomType();
            $store->type =$row[0];
            $store->description =$row[1];
            $store->save();
        }
    }
}
