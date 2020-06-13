<?php

use App\SmFeesGroup;
use Illuminate\Database\Seeder;

class sm_fees_groupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        SmFeesGroup::query()->truncate();
        DB::table('sm_fees_groups')->insert([
            [
                'name' => 'Transport Fee',
                'type' => 'System',
                'description' => 'System Automatic created this fee group',
            ],
            [
                'name' => 'Dormitory Fee',
                'type' => 'System',
                'description' => 'System Automatic created this fee group',
            ],
            [
                'name' => 'Library Fee',
                'type' => 'System',
                'description' => 'System Automatic created this fee group',
            ],
            [
                'name' => 'Processing Fee',
                'type' => 'System',
                'description' => 'System Automatic created this fee group',
            ],
            [
                'name' => 'Tuition Fee',
                'type' => 'System',
                'description' => 'System Automatic created this fee group',
            ],
            [
                'name' => 'Development Fee',
                'type' => 'System',
                'description' => 'System Automatic created this fee group',
            ]

        ]);

    }
}
