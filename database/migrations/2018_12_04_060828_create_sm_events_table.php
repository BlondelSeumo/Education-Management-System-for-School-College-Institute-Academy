<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('event_title',100)->nullable();
            $table->string('event_location',200)->nullable();
            $table->string('event_des',500)->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->string('uplad_image_file',200)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();



            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');
        });
        DB::table('sm_events')->insert([
            [
                'event_title' => 'Biggest Robotics Competition in Campus',    //      1
                'event_location' => 'Main Campus',
                'event_des' => 'Amet enim curabitur urna. Faucibus tincidunt pellentesque varius blandit fermentum tristique vulputate sodales tempus est hendrerit est tincidunt ligula lorem tellus eu malesuada tortor, lacinia posuere. Conubia Egestas sed senectus.',
                'from_date' => '2019-06-12',
                'to_date' => '2019-06-21',
                'uplad_image_file' => 'public/uploads/events/event1.jpg',
            ],
            [
                'event_title' => 'Great Science Fair in main campus',    //      1
                'event_location' => 'Main Campus',
                'event_des' => 'Magna odio in. Facilisi arcu nec augue lacus augue maecenas hendrerit euismod cras vulputate dignissim pellentesque sociis est. Ut congue Leo dignissim. Fermentum curabitur pede bibendum aptent, quam, ultrices Nam convallis sed condimentum. Adipiscing mollis lorem integer eget neque, vel.',
                'from_date' => '2019-06-12',
                'to_date' => '2019-06-21',
                'uplad_image_file' => 'public/uploads/events/event2.jpg',
            ],
            [
                'event_title' => 'Seminar on Internet of Thing in Campus',    //      1
                'event_location' => 'Main Campus',
                'event_des' => 'Libero erat porta ridiculus semper mi eleifend. Nisl nulla. Tempus, rhoncus per. Varius. Pharetra nisi potenti ut ultrices sociosqu adipiscing at. Suscipit vulputate senectus. Nostra. Aliquam fringilla eleifend accumsan dui.',
                'from_date' => '2019-06-12',
                'to_date' => '2019-06-21',
                'uplad_image_file' => 'public/uploads/events/event3.jpg',
            ],
            [
                'event_title' => 'Art Competition in Campus',    //      1
                'event_location' => 'Main Campus',
                'event_des' => 'Dui nunc faucibus Feugiat penatibus molestie taciti nibh nulla pellentesque convallis praesent. Fusce. Vivamus egestas Rutrum est eu dictum volutpat morbi et. Placerat justo elementum dictumst magna nisl ut mollis varius velit facilisi. Duis tellus ullamcorper aenean massa nibh mi.',
                'from_date' => '2019-06-12',
                'to_date' => '2019-06-21',
                'uplad_image_file' => 'public/uploads/events/event4.jpg',
            ],
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_events');
    }
}
