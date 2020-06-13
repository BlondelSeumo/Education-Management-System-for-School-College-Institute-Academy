<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SmFrontendPersmission;

class CreateSmFrontendPersmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_frontend_persmissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255)->nullable();
            $table->integer('parent_id')->default(0);
            $table->integer('is_published')->default(0);
            $table->timestamps();
        });

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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_frontend_persmissions');
    }
}
