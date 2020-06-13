<?php

use App\SmClass;
use Illuminate\Database\Seeder;

class sm_classesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SmClass::query()->truncate();

        DB::table('sm_classes')->insert([
            [
                'class_name' => 'One',
            ],
            [
                'class_name' => 'Two',
            ],
            [
                'class_name' => 'Three',
            ],
            [
                'class_name' => 'Four',
            ],
            [
                'class_name' => 'Five',
            ],
            [
                'class_name' => 'Six',
            ],
            [
                'class_name' => 'Seven',
            ],
            [
                'class_name' => 'Eight',
            ],
            [
                'class_name' => 'Nine',
            ],
            [
                'class_name' => 'Ten',
            ],
        ]);
    }
}
