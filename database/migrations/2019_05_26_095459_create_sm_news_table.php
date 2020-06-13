<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Faker\Factory as Faker;
class CreateSmNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('news_title');
            $table->integer('view_count')->nullable();
            $table->integer('active_status')->nullable();
            $table->string('image')->nullable();
            $table->string('image_thumb')->nullable();
            $table->text('news_body')->nullable();
            $table->date('publish_date')->nullable();
            $table->string('order')->nullable();
            $table->timestamps();

            $table->integer('category_id')->nullable()->unsigned();
            $table->foreign('category_id')->references('id')->on('sm_news_categories')->onDelete('restrict');

            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');
        });

        $faker = Faker::create();
        $i=1;
        $cid=[1,1,1,1,2,2,2,2,3,3,3,3];
        foreach (range(1,12) as $index) {
            DB::table('sm_news')->insert([
                'news_title' => $faker->text(40) .' - '.$i,
                'view_count' => $faker->randomDigit,
                'active_status' =>1,
                'news_body' =>$faker->text(500),
                'image'=>'public/uploads/news/news'.$i.'.jpg',
                'publish_date' => '2019-06-02',
                'category_id' => $cid[$i-1],
                'order'=>$i++,
            ]);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_news');
    }
}
