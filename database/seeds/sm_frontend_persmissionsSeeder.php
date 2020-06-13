<?php

use App\SmFrontendPersmission;
use Illuminate\Database\Seeder;

class sm_frontend_persmissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SmFrontendPersmission::query()->truncate();
        $s                  = new SmFrontendPersmission();
        $s->name            = 'Home Page';
        $s->parent_id       = 0;
        $s->is_published    = 1;
        $s->save(); //ID=1


        $s                  = new SmFrontendPersmission();
        $s->name            = 'About Page';
        $s->parent_id       = 1;
        $s->is_published    = 1;
        $s->save();//ID=2


        $s                  = new SmFrontendPersmission();
        $s->name            = 'Image Banner';
        $s->parent_id       = 1;
        $s->is_published    = 1;
        $s->save();

        $s                  = new SmFrontendPersmission();
        $s->name            = 'Latest News';
        $s->parent_id       = 1;
        $s->is_published    = 1;
        $s->save();


        $s                  = new SmFrontendPersmission();
        $s->name            = 'Notice Board';
        $s->parent_id       = 1;
        $s->is_published    = 1;
        $s->save();


        $s                  = new SmFrontendPersmission();
        $s->name            = 'Event List';
        $s->parent_id       = 1;
        $s->is_published    = 1;
        $s->save();
        $s                  = new SmFrontendPersmission();
        $s->name            = 'Academics';
        $s->parent_id       = 1;
        $s->is_published    = 1;
        $s->save();

        $s                  = new SmFrontendPersmission();
        $s->name            = 'Testimonial';
        $s->parent_id       = 1;
        $s->is_published    = 1;
        $s->save();

        $s                  = new SmFrontendPersmission();
        $s->name            = 'Custom Links';
        $s->parent_id       = 1;
        $s->is_published    = 1;
        $s->save();

        $s                  = new SmFrontendPersmission();
        $s->name            = 'Social Icons';
        $s->parent_id       = 1;
        $s->is_published    = 1;
        $s->save();

        $s                  = new SmFrontendPersmission();
        $s->name            = 'About Image';
        $s->parent_id       = 2;
        $s->is_published    = 1;
        $s->save();

        $s                  = new SmFrontendPersmission();
        $s->name            = 'Statistic Number Section';
        $s->parent_id       = 2;
        $s->is_published    = 1;
        $s->save();


        $s                  = new SmFrontendPersmission();
        $s->name            = 'Our History';
        $s->parent_id       = 2;
        $s->is_published    = 1;
        $s->save();

        $s                  = new SmFrontendPersmission();
        $s->name            = 'Our Mission and Vision';
        $s->parent_id       = 2;
        $s->is_published    = 1;
        $s->save();


        $s                  = new SmFrontendPersmission();
        $s->name            = 'Testimonial';
        $s->parent_id       = 2;
        $s->is_published    = 1;
        $s->save();

    }
}
