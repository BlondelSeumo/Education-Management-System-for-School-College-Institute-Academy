<?php

use App\SmContentType;
use Illuminate\Database\Seeder;

class sm_content_typesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        SmContentType::query()->truncate();
        $s = new SmContentType();
        $s->type_name = 'Home';
        $s->save();
        $s = new SmContentType();
        $s->type_name = 'About';
        $s->save();
        $s = new SmContentType();
        $s->type_name = 'Contact';
        $s->save();
        $s = new SmContentType();
        $s->type_name = 'Services';
        $s->save();
    }
}
