<?php

use Illuminate\Database\Seeder;
use App\Continet;

class continentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


    //    Continet::query()->truncate();
       
        $s = new Continet();
        $s->code = 'AF';
        $s->name = 'Africa';
        $s->save();

        $s = new Continet();
        $s->code = 'AN';
        $s->name = 'Antarctica';
        $s->save();

        $s = new Continet();
        $s->code = 'AS';
        $s->name = 'Asia';
        $s->save();

        $s = new Continet();
        $s->code = 'EU';
        $s->name = 'Europe';
        $s->save();

        $s = new Continet();
        $s->code = 'NA';
        $s->name = 'North America';
        $s->save();

        $s = new Continet();
        $s->code = 'OC';
        $s->name = 'Oceania';
        $s->save();

        $s = new Continet();
        $s->code = 'SA';
        $s->name = 'South America';
        $s->save();
    }
}
