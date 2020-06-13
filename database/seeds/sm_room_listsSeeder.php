<?php

use App\SmDormitoryList;
use App\SmRoomList;
use App\SmRoomType;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class sm_room_listsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        $dormitories = SmDormitoryList::all(); //7
        $rooms = SmRoomType::all(); //6

        foreach ($dormitories as $dormitory) {
            foreach ($rooms as $room) {
                $store = new SmRoomList();
                $store->name = $faker->text(100);
                $store->dormitory_id = $dormitory->id;
                $store->room_type_id = $room->id;
                $store->number_of_bed = rand(40,100);
                $store->cost_per_bed = rand(5000,7000);
                $store->description = $faker->text(200);
                $store->save();
            }
        }

    }
}
